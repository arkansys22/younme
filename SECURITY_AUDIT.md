# SECURITY_AUDIT.md — Checklist keamanan Younme

Hardening bawaan dari basis kode (sudah aktif): kredensial DB & encryption key dari env var, CSRF global, cookie httponly,
`db_debug` mati di production, password `password_hash` (migrasi otomatis dari sha1 saat login), `.git` diblokir di `.htaccess`.

Sebelum Younme online:
- [ ] Set `CI_ENV=production` di server.
- [ ] Set `DB_HOST/DB_USER/DB_PASS/DB_NAME/ENCRYPTION_KEY/APP_BASE_URL` (+ `SMTP_*` kalau pakai email verifikasi). Jangan taruh nilai asli di file yang di-commit.
- [ ] Ganti password akun seed `developer` (`GantiSekarang#2026`) atau hapus akun itu setelah membuat akun sendiri.
- [ ] Pastikan HTTPS aktif (kamera/GPS absensi & cookie secure butuh HTTPS).
- [ ] Pastikan folder `db/` tidak berisi dump data dan tidak bisa diakses dari web (`db/.htaccess`).
- [ ] Gunakan password DB yang BARU (bukan yang dipakai Mantenbaru).
