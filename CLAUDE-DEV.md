# CLAUDE-DEV.md

Backend/developer reference for this repo. Read `CLAUDE.md` first for the high-level architecture; this file goes deeper on the schema and features added recently, and on how to work safely in this codebase.

## Database reference (features built this cycle)

The full schema is in `db/younme_schema.sql` (structure only); initial master data is in `db/younme_seed_master.sql`. Both are gitignored like every `db/*.sql` — run manually on each environment.

### `user_absensi` — one row per user per day
Key columns: `user_id_session`, `tanggal`, `status` (`Hadir`/`Sakit`/`Izin`), `jam_masuk`, `jam_masuk_ketentuan` (the cutoff *in effect at check-in time*, frozen — not recomputed later), `jam_keluar`, `foto_masuk`/`lat_masuk`/`lng_masuk`/`alamat_masuk` (+ `_keluar` equivalents), `keterangan` (auto-filled "Terlambat X menit" for late Hadir, or the manual reason text for Sakit/Izin). Unique on `(user_id_session, tanggal)` — one record per person per day, enforced both in code (`get_where` existence check before insert) and at the DB level.

Photos live in `./uploads/absensi/`, filenames are server-generated (`md5(user_id_session . microtime())`), never derived from user input — don't change that without re-checking the path-traversal reasoning in `Aspanel::simpan_foto_absensi()`.

### `pengaturan_absensi` — singleton (always `id = 1`)
Just `jam_masuk` (the daily cutoff time). Read via `Aspanel::jam_masuk_ketentuan_absensi()`, written via `/absensi-pengaturan` (level 1/2 only).

### `kategori_gaji` — salary category definitions
`nama_kategori`, `satuan_gaji` (ENUM `Harian`/`Bulanan`/`Project`/`Persentase`), `nominal_gaji` (DECIMAL — a Rupiah amount for the first three units, a raw percentage number like `2.5` for `Persentase`). Managed at `/rekap-gaji/kategori` (level 1/2/3, the same roles that see the Fin & Acc sidebar submenu).

### `user_kategori_gaji` — many-to-many join
A user can hold several categories at once (e.g. a monthly base + a sales commission). `Crud_kategori_gaji::assign()` replaces a user's whole set on every save (delete-all-then-reinsert) rather than diffing — simpler, and fine because the multi-select always submits the complete desired state.

## Calculation logic — `Gaji_model.php`

`hitung_detail_gaji($user_id_session, $kategoriRow, $periode)` turns one assigned category into an actual Rupiah amount for one month:

| Satuan | Formula | Data source |
|---|---|---|
| Bulanan | `nominal_gaji` flat | — |
| Harian | `nominal_gaji × count(Hadir days in periode)` | `user_absensi` |
| Project | `nominal_gaji × count(distinct projects with event_date in periode)` | `crew_projects` ⋈ `project` ⋈ `user.crews_idsession` |
| Persentase | `pencapaian_sales(periode) × nominal_gaji / 100` | see below |

`hitung_pencapaian_sales()` is a private method on the same model reimplementing the exact "achieved" rule used elsewhere (`Aspanel::getEstimasiRevenue`): project's Kesatu payment Paid (any date) **and** Kedua payment Paid within the target month. If that business rule ever changes, it needs to change in both places — they're independent copies, not shared code (the Persentase-specific one lives in the model; the dashboard/ranking ones live as private methods on `Aspanel`).

Two entry points call this model with identical results by design:
- `Crud_kategori_gaji::rekap()` — admin "Setting Salary" page, any user, editable assignment.
- `Aspanel::gaji_saya()` — self-service "Rekap Gaji" page reachable from home, always the logged-in user, view-only.

If you touch the model, sanity-check both pages still agree on the same user/period (that's exactly the regression check used when this was refactored — compare the two pages' totals for the same `user_id_session` + `periode`).

## Testing approach used in this codebase (no automated test suite)

Everything gets verified by hand against the **local** dev DB (`younme`) — production is never touched directly. The recurring pattern for anything requiring login as a specific user:

1. Capture the target user's current password hash first: `SELECT password FROM user WHERE username = ?`.
2. Overwrite it with a known bcrypt hash for testing (`php -r "echo password_hash('Test1234!', PASSWORD_BCRYPT);"`).
3. Test via direct HTTP requests (PowerShell `Invoke-WebRequest`, scraping the CSRF token out of the rendered form before each POST) or the browser tool.
4. **Always restore the original hash afterward** — this has been forgotten at least once mid-session and caused a real "wrong password" scare for the user. Also delete any rows/uploaded files created purely for the test; check for real user-entered data in the same tables first (categories/assignments the user created themselves during exploration) and never delete those.

CSRF is enforced globally (`config.php`: `csrf_protection = TRUE`, `csrf_regenerate = FALSE` — token stays stable across requests in a session, so it only needs to be scraped once per login). Field name is `csrf_test_name`, cookie name is `csrf_cookie_name`.

## Known sharp edges

- **Route ordering** — see `CLAUDE.md`. This has caused at least two real bugs this cycle (a swapped-parameter-order bug in `absensi_rekap_detail` caught by testing, and route-shadowing risk when adding `rekap-gaji/(:any)/(:any)`).
- **`user.crews_idsession`** can be empty string or the literal string `'-'` for users with no crew record — joins against `crew_projects.crew_id` naturally return zero rows in that case, no special-casing needed.
- **Timezone**: `Aspanel`'s constructor calls `date_default_timezone_set('Asia/Jakarta')`. `created_at DEFAULT CURRENT_TIMESTAMP` columns use MySQL's own timezone setting, which is *not* guaranteed to agree with that — don't rely on `created_at` for anything Jakarta-local-time-sensitive without checking.
- **Legacy `db_erp` vs current `younme`**: earlier in this project's life there were two local databases; some columns believed missing (`project.closing_user_idsession`) turned out to exist in `younme` but not the older `db_erp` dump. If a column seems to be missing, double-check which local DB you're actually looking at before assuming the schema needs a migration.
