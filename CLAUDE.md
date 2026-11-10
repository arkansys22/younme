# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

An ERP for a wedding-organizer business (Younme), built on **CodeIgniter 3** (PHP MVC framework, framework source vendored under `system/`). No frontend build step, no package.json — views are server-rendered PHP with Tailwind pulled in via CDN (`<script src="https://cdn.tailwindcss.com">`) on the newer pages.

Companion docs in this repo:
- `PROGRESS.md` — running log of feature work and bug fixes for Younme (fresh start; the Mantenbaru history was removed).
- `SECURITY_AUDIT.md` — short pre-deploy security checklist for Younme.
- `.env.example` — the env vars a deploy needs (`DB_HOST/DB_USER/DB_PASS/DB_NAME`, `CI_ENV`, `ENCRYPTION_KEY`, `APP_BASE_URL`).

## Commands

There is no build step and no app-level test suite (the `phpunit` scripts in `composer.json` belong to the vendored CodeIgniter framework itself, not this app).

- **Run locally**: serve the repo root through Apache/XAMPP (`http://localhost/<repo-folder>/`). No dev server command — this app expects a real Apache+MySQL stack (mod_rewrite for clean URLs via `.htaccess`).
- **Local DB config**: `application/config/database.php` reads `DB_HOST`/`DB_USER`/`DB_PASS`/`DB_NAME` from environment variables (falls back to `localhost`/empty if unset). Set these via Apache `SetEnv` in `httpd.conf` (or a vhost block) rather than editing the file, so the same `database.php` works unmodified in every environment. See `.env.example` for the full list of vars a deploy needs.
- **Lint a single file**: `php -l path/to/file.php` (there's no project-wide lint config; this catches syntax errors before you hand a change back).

## Architecture

### Routing — read `application/config/routes.php` before adding a URL

CodeIgniter 3's `:any` wildcard compiles to `.+` — **greedy, and it matches `/`**. Routes are tried in file order and the first match wins. This means:
- A route like `foo/(:any)` will swallow `foo/bar/baz` as a single capture group, `"bar/baz"`.
- Multi-segment routes (`foo/(:any)/(:any)`) must be declared **before** the shorter single-segment version, or the single-segment one eats the whole URI first.
- More specific literal routes (`foo/kategori`, `foo/assign/(:any)`) must be declared before generic catch-alls (`foo/(:any)`) for the same reason.

This file has bitten past changes more than once — when adding a new URL under an existing prefix, check where it needs to sit relative to siblings, not just append it at the end.

### Controllers: two shapes coexist

- **`Aspanel.php`** — the dashboard/self-service controller. Per-role `home()` branches (see `$this->session->level`), plus self-service features reachable from the home screen: attendance (`absensi*`), sales achievement drill-downs (`sales_achievement*`, `sales_ranking`), and personal payroll view (`gaji_saya`). Business-logic helper methods live as private methods on this controller (e.g. `getEstimasiRevenue`, `get_top_sales_ranking`) — check here first for revenue/achievement calculations before assuming logic lives in a model.
- **`Crud_*.php`** — one controller per admin-managed resource (`Crud_kategori_gaji`, `Crud_sales_marketing`, `Crud_finance_operational`, etc.), typically CRUD + a couple of computed views. Newer ones (`Crud_kategori_gaji`) delegate calculation logic to a model instead of keeping it on the controller — follow that pattern for new business-logic-heavy features rather than the older inline style.

Shared calculation logic that multiple controllers need belongs in a model (see `Gaji_model.php`, used by both `Aspanel::gaji_saya()` and `Crud_kategori_gaji::rekap()` so the payroll formulas can't drift out of sync between the two).

### Auth & roles

Session holds `level` (a numeric string) and `id_session` (the user's stable identifier — used as the FK value in place of an auto-increment ID throughout the schema, e.g. `project.closing_user_idsession`, `crew_projects.crew_id` via `user.crews_idsession`). The `user_level` table is the canonical lookup for level → readable name (`1`=Developer, `2`=Administrator, `3`=Staff Accounting, `4`=Staff Admin, `5`=Client, `6`=Guest, `7`=Staff/Crew, `8`=Partner, `9`=Staff Sales, `10-12`=Affiliate tiers) — join against it rather than hardcoding a label map.

Two access-control idioms appear side by side:
- Legacy: `cek_session_akses_developer($id)` etc. in `application/helpers/customs_helper.php` — despite the two-arg call sites you'll see (`cek_session_akses_developer('panel', $id)`), these functions only take one parameter; the extra arg is silently ignored by PHP. They resolve to "redirect away unless `$this->session->level` matches."
- Newer: inline `if (!in_array($this->session->level, ['1','2','3'])) { redirect(...); }` at the top of a method. Prefer this for new code — it's what recent features (`absensi`, `rekap-gaji`) use.

Sidebar menu items are gated by the same level checks directly in `application/views/backend/sidebar.php` (PHP `if` blocks around each `<li>`), so a menu entry and its controller's access check need to be kept in sync by hand.

### Views: two eras

- `application/views/backend/*.php` — the current style: Tailwind (CDN) + Alpine.js, dark-mode aware (`darkMode` in localStorage via Alpine `x-data`), consistent page skeleton (sidebar + header partials, `<main>` content card). New pages should copy this skeleton.
- Feature-named folders (`application/views/crews/`, `application/views/agenda/`, etc.) — older Bootstrap-ish CRUD scaffolding. Being phased out gradually as features get touched, not proactively.

Recurring UI patterns worth reusing rather than reinventing:
- Month-period browsing: `periode` (`YYYY-MM`) in the URL, prev/next links + an `<input type="month">` picker with an inline `onchange` redirect (see `v_sales_ranking.php`, `v_absensi_rekap.php`).
- "Pick a name, then see their data" pages default to showing nothing until a selection is made, rather than dumping every user's data at once — the dropdown navigates via `onchange` to `<route>/<id_session>`.
- Money formatting: `format_nominal_salary($nominal, $satuan)` in `customs_helper.php` renders "Rp X / satuan" or "X%" depending on unit — use it instead of ad hoc `number_format` when displaying a salary category's nominal.

### Domain vocabulary

- A **project** goes through payment installments named `Pembayaran Kesatu` (down payment) and `Pembayaran Kedua` (settlement) in the `payment` table (`metodep` column, `status = 'Paid'` when settled). A project counts as "achieved" for a given month when Kesatu is Paid (any date) **and** Kedua is Paid within that month — this exact rule is duplicated across several revenue/achievement queries (`getEstimasiRevenue`, `get_top_sales_ranking`, `Gaji_model::hitung_detail_gaji`'s Persentase branch); keep them in sync if the business rule ever changes.
- **Crew scheduling**: `crew_projects` joins a crew member to a project (`crew_projects.crew_id = user.crews_idsession`, `crew_projects.project_id = project.id_session`); `project.event_date` is the wedding date. This join is how "how many events is this person working this month" is computed (attendance dashboards, payroll's Project-unit salary).
- **Attendance** (`user_absensi`): one row per user per day, `status` is `Hadir`/`Sakit`/`Izin`. Check-in requires a live camera photo + geolocation (captured client-side via `getUserMedia`/`navigator.geolocation`, burned into the photo as an overlay before upload) — see `application/views/backend/v_absensi.php`. Lateness is computed server-side against `pengaturan_absensi` (a singleton settings row) at check-in time and frozen onto the attendance row (`jam_masuk_ketentuan`), so changing the setting later doesn't retroactively alter past records.
- **Payroll** (`kategori_gaji`, `user_kategori_gaji`): a salary category has a `satuan_gaji` (`Bulanan`/`Harian`/`Project`/`Persentase`) and a `nominal_gaji`. A user can hold multiple categories at once (many-to-many via `user_kategori_gaji`). Actual take for a given month is computed per category by `Gaji_model::hitung_detail_gaji()` — flat for Bulanan, `nominal × hari hadir` for Harian, `nominal × distinct projects that month` for Project, `pencapaian × nominal%` for Persentase — never sum raw `nominal_gaji` across categories with different units, only sum the computed monthly amounts.

## Production deploy gotchas

- Migrations under `db/*.sql` are gitignored (existing dumps in that folder always have been) and **must be run manually** on the production DB — check `PROGRESS.md`'s "Next Steps" section for which ones are still pending.
- Local dev DB config differences (credentials) live in Apache's `httpd.conf` via `SetEnv`, not in any tracked file — so `git pull` on the server never touches real credentials.
