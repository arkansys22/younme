# ROADMAP.md — Younme ERP

## Pembersihan sisa Mantenbaru (manual, belum bisa dilakukan otomatis)

- [ ] Pindahkan/hapus `db/db_erpmaid_full_2026-11-05.sql` (6 MB, **data asli Mantenbaru**) dan `db/db_erp.sql` dari folder web.
- [ ] Hapus isi upload bawaan: `assets/uploads/client_susunan_acara/`, `assets/uploads/susunan_acara/`,
      `assets/uploads/vendor_checklist/`, `uploads/absensi/*.jpg` (sisakan `index.html`).
- [ ] Hapus/ganti aset berlogo Mantenbaru: `assets/backend/mb.png`, `assets/backend/src/images/logomantenbaru.png`,
      `assets/backend/src/images/logo/logo mantenbaru merah-02.png` & `-03.png`, `assets/frontend/assets/images/logomantenbaru-03.png`,
      `logo.png`, `logo.jpg`, `logo 2021-01-01.png`, serta foto klien di `assets/frontend/assets/images/` (mis. `rev1.jpg`, `arsyad.jpg`, `1-9.jpg`, `agenda*.jpg`).
      Kalau file `*_susunan_acara`, `buku_tamu/*`, `janur/*` di `assets/backend` adalah desain Mantenbaru, ganti juga.
- [ ] `.git`: kalau folder ini salinan repo Mantenbaru, putuskan remote lama (`git remote -v`) dan buat repo Younme baru; history lama masih berisi data/kredensial Mantenbaru.
- [ ] Rotasi password SMTP lama Mantenbaru yang sempat tertulis di `User.php` (sudah dihapus dari kode, tapi masih ada di history git).

## Fitur / konten Younme
- [ ] Domain, email pengirim, Instagram Younme -> isi di Pengaturan Website & env SMTP.
- [ ] Logo final Younme.
- [ ] Testimoni klien Younme, pricelist, banner pricelist.
- [ ] Review aturan bisnis "achieved" (Pembayaran Kesatu & Kedua) apakah sesuai alur pembayaran Younme.
