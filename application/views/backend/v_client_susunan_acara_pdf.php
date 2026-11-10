<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Susunan Acara — <?= htmlspecialchars($clients->client_name) ?></title>
    <style>
        /*
         * Header (kategori/nama klien/lokasi/tanggal + judul organizer) diulang di SETIAP
         * halaman lewat <thead> satu tabel besar yang membungkus semua isi (bukan lewat
         * position:fixed) -- pengulangan <thead> antar halaman jauh lebih stabil di dompdf
         * dibanding position:fixed + @page margin, yang terbukti tidak konsisten
         * (kadang hilang di halaman ke-2 dst walau lolos di uji coba lokal).
         */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .uppercase {
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .head-info td {
            border: none;
            padding: 0;
        }
        .head-info hr {
            border: none;
            border-top: 1px solid #000;
            margin: 8px 0 12px 0;
        }
        th, td.data {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
        th {
            text-align: center;
            font-weight: bold;
        }
        td.data.text-center {
            text-align: center;
        }
        td.data.text-right {
            text-align: right;
        }
        .col-no      { width: 5%; }
        .col-jam     { width: 10%; }
        .col-durasi  { width: 10%; }
        .col-kegiatan{ width: 50%; }
        .col-vendor  { width: 25%; }
    </style>
</head>
<body>

<table>
  <thead>
    <tr class="head-info">
      <td colspan="5" style="padding-bottom: 12px;">
        <table style="border: none; margin: 0;">
          <tr>
            <td style="text-align: left; vertical-align: top; border: none; padding: 0;">
              <h1 class="uppercase" style="font-weight: bold; font-size: 14px; margin: 0;">Acara <?= $kategori_acara ? htmlspecialchars($kategori_acara->nama_kategori) : '' ?></h1>
              <p style="font-size: 12px; margin: 4px 0 0 0;"><?= htmlspecialchars($clients->location) ?></p>
              <p style="font-size: 12px; margin: 0;">
                <?= !empty($clients->wedding_date) ? hari($clients->wedding_date) . ', ' . tgl_indo($clients->wedding_date) : '' ?>
              </p>
            </td>
            <td class="uppercase" style="text-align: right; font-weight: bold; font-size: 14px; vertical-align: top; border: none; padding: 0;">
              <?= htmlspecialchars($clients->client_name) ?>
            </td>
          </tr>
        </table>

        <hr>

        <p style="font-weight: bold; font-size: 13px; margin: 0;"><?= strtoupper(nama_website()) ?> ORGANIZER</p>
        <p class="uppercase" style="font-size: 12px; margin: 2px 0 0 0;">Susunan Acara <?= $kategori_acara ? htmlspecialchars($kategori_acara->nama_kategori) : '' ?></p>
      </td>
    </tr>
    <tr>
      <th class="col-no">No</th>
      <th class="col-jam">Jam</th>
      <th class="col-durasi">Durasi</th>
      <th class="col-kegiatan">Kegiatan</th>
      <th class="col-vendor">Vendor/PJ</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($kegiatan_list as $i => $item): ?>
    <?php
      $jam = '-';
      if (!empty($item->waktu_mulai)) {
          $jamParts = explode(':', $item->waktu_mulai);
          $jam = ((int) $jamParts[0]) . ':' . $jamParts[1];
      }
      $durasiParts = explode(':', $item->durasi);
      $durasi = ((int) $durasiParts[0]) . ':' . $durasiParts[1];
    ?>
    <tr>
      <td class="data col-no text-center"><?= $i + 1 ?></td>
      <td class="data col-jam text-center"><?= $jam ?></td>
      <td class="data col-durasi text-center"><?= $durasi ?></td>
      <td class="data col-kegiatan"><?= nl2br(htmlspecialchars($item->nama_kegiatan_display)) ?></td>
      <td class="data col-vendor"><?= nl2br(htmlspecialchars($item->vendor_pj)) ?></td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($kegiatan_list)): ?>
    <tr>
      <td class="data text-center" colspan="5">Belum ada kegiatan.</td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
