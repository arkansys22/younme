<?php
// Ambil agama dari tabel project berdasarkan id_session klien
$project = $this->db->get_where('project', ['id_session' => $client->id_session])->row();
$religion = $project->religion ?? ''; // Pastikan tidak error jika religion kosong

$islam = strtolower($religion) === 'islam'; // Cek apakah agama Islam

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengantin & Susunan Acara</title>
    <link rel="icon" href="<?= favicon_url() ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
    .no-print {
        display: none !important; /* Menyembunyikan elemen dengan class 'no-print' */
    }
    @page {
        margin: 0; /* Menghapus margin default browser */
    }
    }
        p.indent {
            text-indent: 40px; /* Indentasi awal paragraf */
        }
    table {
        width: 80%;
        margin: 0 auto; /* Agar tetap di tengah */
    }
</style>
</head>
<body class="p-5">

    <div class="max-w-[80%] mx-auto text-left">
    <!-- Bagian Header -->
    <div class="flex justify-between items-start mb-4">
        <div>
            <?php
            if ($islam) {
                if (!empty($client->wedding_ceremony) && empty($client->reception_afterward)) {
                    echo '<h1 class="font-bold text-sm">ACARA AKAD</h1>';
                } elseif (empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 class="font-bold text-sm">ACARA RESEPSI</h1>';
                } elseif (!empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 class="font-bold text-sm">ACARA AKAD RESEPSI</h1>';
                }
            } else {
                if (!empty($client->wedding_ceremony) && empty($client->reception_afterward)) {
                    echo '<h1 class="font-bold text-sm">ACARA PEMBERKATAN</h1>';
                } elseif (empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 class="font-bold text-sm">ACARA RESEPSI</h1>';
                } elseif (!empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 class="font-bold text-sm">ACARA PEMBERKATAN RESEPSI</h1>';
                }
            }
            ?>
            <p class="text-xs"><?= $client->location; ?></p>
            <p class="text-xs"><?= hari($client->wedding_date) ?>, <?= tgl_indo($client->wedding_date) ?></p>
        </div>
        <div class="text-right font-bold text-sm">
            <?= $client->client_name; ?>
        </div>
    </div>

    <!-- Bagian Organizer -->
    <div class="mb-4">
        <h2 class="font-bold text-sm"><?= strtoupper(nama_website()) ?> ORGANIZER</h2>
        <p class="text-xs">SUSUNAN PANITIA</p>
    </div>

    <div class = "w-[80%] mx-auto flex flex-col items-center">
    <!-- Bagian Tabel -->
    <table class="w-full border border-black text-left">
        <thead>
            <tr>
                <th colspan="2" class="border border-black text-center text-sm font-semibold p-1">
                    Data Calon Pengantin Wanita
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-black p-1 text-xs w-2/5">CPW (Anak ke <?= $client->f_bride_nchild; ?> dari <?= $client->f_bride_hsibling; ?> bersaudara)</td>
                <td class="border border-black p-1 text-xs">
                    <?= $client->f_bride_fname; ?> 
                    <?php if (!empty($client->f_bride_cname)): ?>
                        (<?= $client->f_bride_cname; ?>)
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <?php if (!empty($client->f_bride_fathercname)): ?>
                <td class="border border-black p-1 text-xs w-2/5">Bapak CPW (<?= $client->f_bride_fathercname; ?>)</td>
                <?php else: ?>
                <td class="border border-black p-1 text-xs w-2/5">Bapak CPW</td>
                <?php endif; ?>
                <td class="border border-black p-1 text-xs"><?= $client->f_bride_fathername; ?>
                <?php if (!empty($client->f_bride_freplacementname)): ?>
                <br>Pengganti: <?= $client->f_bride_freplacementname; ?> (<?= $client->f_bride_freplacementcname; ?>)
                <?php endif; ?>
            </td>
            </tr>
            <tr>
                <?php if (!empty($client->f_bride_mothercname)): ?>
                <td class="border border-black p-1 text-xs w-2/5">Ibu CPW (<?= $client->f_bride_mothercname; ?>)</td>
                <?php else: ?>
                <td class="border border-black p-1 text-xs w-2/5">Ibu CPW</td>
                <?php endif; ?>
                <td class="border border-black p-1 text-xs"><?= $client->f_bride_mothername; ?>
                <?php if (!empty($client->f_bride_mreplacementname)): ?>
                <br>Pengganti: <?= $client->f_bride_mreplacementname; ?> (<?= $client->f_bride_mreplacementcname; ?>)
                <?php endif; ?>
            </td>
            </tr>
            <tr>
                <td class="border border-black p-1 text-xs w-2/5">Nama Saudara Kandung</td>
                <td class="border border-black p-1 text-xs">
                <?= nl2br($client->f_bride_sibling); ?>
                </td>
            </tr>
        </tbody>
    </table><br>

    <table class="w-full border border-black text-left">
        <thead>
            <tr>
                <th colspan="2" class="border border-black text-center text-sm font-semibold p-1">
                    Data Calon Pengantin Pria
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-black p-1 text-xs w-2/5">CPP (Anak ke <?= $client->m_bride_nchild; ?> dari <?= $client->m_bride_hsibling; ?> bersaudara)</td>
                <td class="border border-black p-1 text-xs">
                    <?= $client->m_bride_fname; ?>
                    <?php if (!empty($client->m_bride_cname)): ?>
                        (<?= $client->m_bride_cname; ?>)
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <?php if (!empty($client->m_bride_fathercname)): ?>
                <td class="border border-black p-1 text-xs w-2/5">Bapak CPP (<?= $client->m_bride_fathercname; ?>)</td>
                <?php else: ?>
                <td class="border border-black p-1 text-xs w-2/5">Bapak CPP</td>
                <?php endif; ?>
                <td class="border border-black p-1 text-xs"><?= $client->m_bride_fathername; ?>
                <?php if (!empty($client->m_bride_freplacementname)): ?>
                <br>Pengganti: <?= $client->m_bride_freplacementname; ?> (<?= $client->m_bride_freplacementcname; ?>)
                <?php endif; ?>
            </td>
            </tr>
            <tr>
                <?php if (!empty($client->m_bride_mothercname)): ?>
                <td class="border border-black p-1 text-xs w-2/5">Ibu CPP (<?= $client->m_bride_mothercname; ?>)</td>
                <?php else: ?>
                <td class="border border-black p-1 text-xs w-2/5">Ibu CPP</td>
                <?php endif; ?>
                <td class="border border-black p-1 text-xs"><?= $client->m_bride_mothername; ?>
                <?php if (!empty($client->m_bride_mreplacementname)): ?>
                <br>Pengganti: <?= $client->m_bride_mreplacementname; ?> (<?= $client->m_bride_mreplacementcname; ?>)
                <?php endif; ?>
            </td>
            </tr>
            <tr>
                <td class="border border-black p-1 text-xs w-2/5">Nama Saudara Kandung</td>
                <td class="border border-black p-1 text-xs">
                <?= nl2br($client->m_bride_sibling); ?>
                </td>
            </tr>
            <?php if ($islam): ?>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Mahar</td>
                    <td class="border border-black p-1 text-xs"><?= $client->mahr; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Simbolis</td>
                    <td class="border border-black p-1 text-xs"><?= $client->handover; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table><br>

    <?php if ($islam): ?>
        <table class="w-full border border-black text-left">
            <thead>
                <tr>
                    <th colspan="2" class="border border-black text-center text-sm font-semibold p-1">
                        Petugas & Koordinator Pernikahan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Koor. Keluarga</td>
                    <td class="border border-black p-1 text-xs"><?= $client->female_coor; ?>(CPW),<br>
                    <?= $client->male_coor; ?>(CPP)</td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Jubir Kel. CPW (Bapak)</td>
                    <td class="border border-black p-1 text-xs"><?= $client->f_spokesman; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Jubir Kel. CPP (Bapak)</td>
                    <td class="border border-black p-1 text-xs"><?= $client->m_spokesman; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Penghulu</td>
                    <td class="border border-black p-1 text-xs"><?= $client->wedding_officiant; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Wali CPW (Bapak)</td>
                    <td class="border border-black p-1 text-xs"><?= $client->guardian; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Saksi CPW (Bapak)</td>
                    <td class="border border-black p-1 text-xs"><?= $client->f_witness; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Saksi CPP (Bapak)</td>
                    <td class="border border-black p-1 text-xs"><?= $client->m_witness; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Qori/Saritilawah</td>
                    <td class="border border-black p-1 text-xs"><?= $client->qori; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Sambutan/Doa Pernikahan (Bapak)</td>
                    <td class="border border-black p-1 text-xs"><?= $client->advice_doa; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Pengapit CPW dari Kel. CPW</td>
                    <td class="border border-black p-1 text-xs"><?= $client->clamp; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Pembawa Nampan Kalung Bunga Melati</td>
                    <td class="border border-black p-1 text-xs"><?= $client->jasmine_carrier; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Pembawa Mas Kawin/Mahar</td>
                    <td class="border border-black p-1 text-xs"><?= $client->mahr_carrier; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Pembawa Cincin Kawin</td>
                    <td class="border border-black p-1 text-xs"><?= $client->ring_carrier; ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <table class="w-full border border-black text-left">
            <thead>
                <tr>
                    <th colspan="2" class="border border-black text-center text-sm font-semibold p-1">
                        Petugas & Koordinator Pernikahan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Koor. Keluarga</td>
                    <td class="border border-black p-1 text-xs"><?= $client->male_coor; ?>(CPP),<br>
                    <?= $client->female_coor; ?>(CPW)</td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Pendeta (<?= $client->church ?>)</td>
                    <td class="border border-black p-1 text-xs"><?= $client->pastor ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Pemimpin Doa</td>
                    <td class="border border-black p-1 text-xs"><?= $client->prayer; ?></td>
                </tr>
                <tr>
                    <td class="border border-black p-1 text-xs w-2/5">Sambutan Pernikahan</td>
                    <td class="border border-black p-1 text-xs"><?= $client->wedding_speech; ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
    </div>

    <div class="mt-6 flex justify-between no-print">
        <div>
            <a href="<?= base_url('naskah/data_pengantin/pdf/' . $client->id_session); ?>" 
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
               Download PDF
            </a>
        </div>
        <div>
            <button onclick="window.print()" 
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Print
            </button>
        </div>
    </div>
    </div>
</body>
</html>
