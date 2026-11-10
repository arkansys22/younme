# PROGRESS.md — Younme ERP

Catatan kerja Younme (wedding organizer). Basis kode: ERP Mantenbaru (CodeIgniter 3) yang di-rebrand untuk Younme.
Riwayat kerja Mantenbaru sengaja tidak dibawa ke sini.

---

## 2026-11-10 — Fix: halaman panel masih terbuka setelah sesi habis

- **Penyebab:** tidak ada pengecekan login terpusat; banyak method yang lupa cek sesi (mis. `Aspanel::revenue_lebih_lengkap`,
  `client_lebih_lengkap*`, `get_expense_data`, `Crud_finance_operational::get_data`, `Crud_sales_marketing::get_data`,
  `Crud_coa::get_detail`, ...) sehingga tetap terbuka tanpa login. Halaman panel juga tidak diberi header anti-cache,
  jadi tombol Back / tab yang dipulihkan browser menampilkan salinan lama setelah logout / sesi habis.
- **Fix:** hook baru `application/hooks/Login_guard.php` (didaftarkan paling atas di `config/hooks.php`): belum login →
  diarahkan ke `login` (halaman klien `c_*` → `client/login`), AJAX dapat 401 JSON; sudah login → header `no-store`.
  Halaman publik (welcome, login, link klien `c_lihat`/`c_concept`/`c_tamu_pdf`, naskah, `view_penawaran`,
  `download_proposal`, 404) di-whitelist di `$publik` — **halaman baru yang harus bisa dibuka tanpa login wajib didaftarkan di sana.**
- **Sisi browser** (`backend/sidebar.php`): tab yang tidak dipakai selama `sess_expiration` otomatis dimuat ulang (→ login
  kalau sesi habis), halaman dari back-forward cache dimuat ulang, dan fetch/AJAX yang ditolak karena sesi habis pindah ke login.

## 2026-11-09 — Rebrand awal dari ERP Mantenbaru

- **Branding:** semua teks "Mantenbaru/Maid" yang hardcode diganti. Judul & meta halaman home/login memakai "Younme";
  kop PDF (susunan acara, data pengantin), footer & navbar pricelist, template pesan WA, dan email verifikasi memakai
  `nama_website()` (diatur lewat menu Pengaturan Website).
- **Email verifikasi (`User::sendemail`):** kredensial SMTP yang sebelumnya tertulis di kode dipindah ke env var
  `SMTP_HOST/SMTP_PORT/SMTP_USER/SMTP_PASS` (lihat `.env.example`). Belum diisi = email tidak terkirim.
- **Welcome page:** nomor WA cadangan lama dihapus; tombol "Chat Admin" hanya tampil kalau nomor WA sudah diisi di Pengaturan Website.
- **Pricelist:** banner tidak lagi diambil dari server Mantenbaru, sekarang `assets/uploads/pricelist/banner.png` di server sendiri (upload manual).
- **Testimoni** di `clients/c_lihat.php` diganti placeholder; link ulasan Google dikosongkan (`#`). Isi dengan data Younme.
- **Logo & favicon:** placeholder netral "YOUNME" (`logo-default.png`, `logo-default-putih.png`, `favicon.ico`). Ganti lewat Pengaturan Website.
- **Bug fix:** 6 method sisa template lama di `Aspanel.php` (`profil`, `user_update`, `user_storage_bin`, `user_delete`,
  `identitaswebsite`, `logactivity`) dihapus — memanggil fungsi `cek_session_akses*` & view yang tidak ada, tidak ada route/link yang mengarah ke sana.
- **Database baru `younme`:** `db/younme_schema.sql` (56 tabel, kosong) + `db/younme_seed_master.sql`
  (level user, agama, jenis kelamin, status, wilayah Indonesia, pengaturan website awal, 1 akun developer awal).

## Next Steps

- [ ] Buat database: import `db/younme_schema.sql` lalu `db/younme_seed_master.sql` di phpMyAdmin.
- [ ] Set env `DB_NAME=younme` (+ `DB_HOST/DB_USER/DB_PASS`) di `httpd.conf` XAMPP; login `developer` lalu **ganti password**.
- [ ] Isi Pengaturan Website: nama, logo, favicon, WhatsApp, rekening, Instagram, email, domain.
- [ ] Ganti testimoni di `clients/c_lihat.php` & aset frontend lama (lihat ROADMAP.md).
- [ ] Hapus manual file data Mantenbaru yang masih ada di folder (lihat ROADMAP.md).
