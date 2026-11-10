<?php
// Ambil agama dari tabel project berdasarkan id_session klien
$project = $this->db->get_where('project', ['id_session' => $client->id_session])->row();
$religion = $project->religion ?? ''; // Pastikan tidak error jika religion kosong

$islam = strtolower($religion) === 'islam'; // Cek apakah agama Islam

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pengantin & Susunan Acara</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Biar border menyatu */
            table-layout: fixed; /* Biar lebar kolom tetap */
        }
        th, td {
            border: 1px solid black; /* Semua tabel punya border sama */
            padding: 5px;
            text-align: left;
        }
        .no-border {
            border: none; /* Buat tabel yang gak butuh border */
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

<div class="container">
<table width="100%" style="border: none; background-color: transparent; margin-bottom: 10px;">
    <tr>
        <td style="text-align: left; vertical-align: top; border: none;">
            <?php
            if ($islam) {
                if (!empty($client->wedding_ceremony) && empty($client->reception_afterward)) {
                    echo '<h1 style="font-weight: bold; font-size: 14px; margin: 0;">ACARA AKAD</h1>';
                } elseif (empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 style="font-weight: bold; font-size: 14px; margin: 0;">ACARA RESEPSI</h1>';
                } elseif (!empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 style="font-weight: bold; font-size: 14px; margin: 0;">ACARA AKAD RESEPSI</h1>';
                }
            } else {
                if (!empty($client->wedding_ceremony) && empty($client->reception_afterward)) {
                    echo '<h1 style="font-weight: bold; font-size: 14px; margin: 0;">ACARA PEMBERKATAN</h1>';
                } elseif (empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 style="font-weight: bold; font-size: 14px; margin: 0;">ACARA RESEPSI</h1>';
                } elseif (!empty($client->wedding_ceremony) && !empty($client->reception_afterward)) {
                    echo '<h1 style="font-weight: bold; font-size: 14px; margin: 0;">ACARA PEMBERKATAN RESEPSI</h1>';
                }
            }
            ?>
            <p style="font-size: 12px; margin: 0;"><?= $client->location; ?></p>
            <p style="font-size: 12px; margin: 0;">
                <?= hari($client->wedding_date) ?>, <?= tgl_indo($client->wedding_date) ?>
            </p>
        </td>
        <td style="text-align: right; font-weight: bold; font-size: 14px; vertical-align: top; border: none;">
            <?= $client->client_name; ?>
        </td>
    </tr>
</table>

<table width="100%" style="border: none; background-color: transparent; margin-bottom: 10px;">
    <tr>
        <td style="text-align: left; vertical-align: top; border: none;">
            <h1 style="font-weight: bold; font-size: 14px; margin: 0;"><?= strtoupper(nama_website()) ?> ORGANIZER</h1>
            <p style="font-size: 12px; margin: 0;">SUSUNAN PANITIA</p>
        </td>
    </tr>
</table>
    <table>
        <tr>
        <th colspan="2" style="text-align: center;">Data Calon Pengantin Wanita</th>
        </tr>
        <tr>
                <td>CPW (Anak ke <?= $client->f_bride_nchild; ?> dari <?= $client->f_bride_hsibling; ?> bersaudara)</td>
                <td><?= $client->f_bride_fname; ?> (<?= $client->f_bride_cname; ?>)</td>
            </tr>
            <tr>
                <td>Bapak CPW (<?= $client->f_bride_fathercname; ?>)</td>
                <td><?= $client->f_bride_fathername; ?>
                <?php if (!empty($client->f_bride_freplacementname)): ?>
                <br>Pengganti: <?= $client->f_bride_freplacementname; ?> (<?= $client->f_bride_freplacementcname; ?>)
                <?php endif; ?></td>
            </tr>
            <tr>
                <td>Ibu CPW (<?= $client->f_bride_mothercname; ?>)</td>
                <td><?= $client->f_bride_mothername; ?>
                <?php if (!empty($client->f_bride_mreplacementname)): ?>
                <br>Pengganti: <?= $client->f_bride_mreplacementname; ?> (<?= $client->f_bride_mreplacementcname; ?>)
                <?php endif; ?>
            </td>
            </tr>
            <tr>
                <td>Nama Saudara Kandung</td>
                <td>
                <?= nl2br($client->f_bride_sibling); ?>
                </td>
            </tr>
    </table><br>

    <table>
    <tr>
        <th colspan="2" style="text-align: center;">Data Calon Pengantin Pria</th>
        </tr>
    <tr>
                <td>CPP (Anak ke <?= $client->m_bride_nchild; ?> dari <?= $client->m_bride_hsibling; ?> bersaudara)</td>
                <td><?= $client->m_bride_fname; ?> (<?= $client->m_bride_cname; ?>)</td>
            </tr>
            <tr>
                <td>Bapak CPP (<?= $client->m_bride_fathercname; ?>)</td>
                <td><?= $client->m_bride_fathername; ?>
                <?php if (!empty($client->m_bride_freplacementname)): ?>
                <br>Pengganti: <?= $client->m_bride_freplacementname; ?> (<?= $client->m_bride_freplacementcname; ?>)
                <?php endif; ?>
            </td>
            </tr>
            <tr>
                <td>Ibu CPP (<?= $client->m_bride_mothercname; ?>)</td>
                <td><?= $client->m_bride_mothername; ?>
                <?php if (!empty($client->m_bride_mreplacementname)): ?>
                <br>Pengganti: <?= $client->m_bride_mreplacementname; ?> (<?= $client->m_bride_mreplacementcname; ?>)
                <?php endif; ?>
            </td>
            </tr>
            <tr>
                <td>Nama Saudara Kandung</td>
                <td>
                <?= nl2br($client->m_bride_sibling); ?>
                </td>
            </tr>

             <?php if ($islam): ?>
            <tr>
                <td>Mahar</td>
                <td><?= $client->mahr; ?></td>
            </tr>
            <tr>
                <td>Simbolis</td>
                <td><?= $client->handover; ?></td>
            </tr>
             <?php else: ?>

            <?php endif; ?>


    </table><br>

    <?php if ($islam): ?>
    <table>
    <tr>
        <th colspan="2" style="text-align: center;">Petugas & Koordinator Pernikahan</th>
        </tr>
            <tr>
                <td>Koor. Keluarga</td>
                <td><?= $client->female_coor; ?>(CPW),<br>
                <?= $client->male_coor; ?>(CPP)</td>

            </tr>
            <tr>
                <td>Jubir Kel. CPW (Bapak)</td>
                <td><?= $client->f_spokesman; ?></td>
            </tr>
            <tr>
                <td>Jubir Kel. CPP (Bapak)</td>
                <td><?= $client->m_spokesman; ?></td>
            </tr>
            <tr>
                <td>Penghulu</td>
                <td><?= $client->wedding_officiant; ?></td>
            </tr>
            <tr>
                <td>Wali CPW (Bapak)</td>
                <td><?= $client->guardian; ?></td>
            </tr>
            <tr>
                <td>Saksi CPW (Bapak)</td>
                <td><?= $client->f_witness; ?></td>
            </tr>
            <tr>
                <td>Saksi CPP (Bapak)</td>
                <td><?= $client->m_witness; ?></td>
            </tr>
            <tr>
                <td>Qori/Saritilawah</td>
                <td><?= $client->qori; ?></td>
            </tr>
            <tr>
                <td>Sambutan/Doa Pernikahan (Bapak)</td>
                <td><?= $client->advice_doa; ?></td>
            </tr>
            <tr>
                <td>Pengapit CPW dari Kel. CPW</td>
                <td><?= $client->clamp; ?></td>
            </tr>
            <tr>
                <td>Pembawa Nampan Kalung Bunga Melati</td>
                <td><?= $client->jasmine_carrier; ?></td>
            </tr>
            <tr>
                <td>Pembawa Mas Kawin/Mahar</td>
                <td><?= $client->mahr_carrier; ?></td>
            </tr>
            <tr>
                <td>Pembawa Cincin Kawin</td>
                <td><?= $client->ring_carrier; ?></td>
            </tr>
    </table>
    <?php else: ?>
    <table>
    <tr>
        <th colspan="2" style="text-align: center;">Petugas & Koordinator Pernikahan</th>
        </tr>
            <tr>
                <td>Koor. Keluarga</td>
                <td><?= $client->male_coor; ?>(CPP),<br>
                <?= $client->female_coor; ?>(CPW)</td>
            </tr>
            <tr>
                <td>Pendeta / Romo (<?= $client->church ?>)</td>
                <td><?= $client->pastor; ?></td>
            </tr>
            <tr>
                <td>Pemimpin Doa</td>
                <td><?= $client->prayer; ?></td>
            </tr>
            <tr>
                <td>Sambutan Pernikahan</td>
                <td><?= $client->wedding_speech; ?></td>
            </tr>
    </table>
    <?php endif; ?>
</div>

</body>
</html>