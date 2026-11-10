<?php
// Ambil agama dari tabel project berdasarkan id_session klien
$project = $this->db->get_where('project', ['id_session' => $clients->id_session])->row();
$religion = $project->religion ?? ''; // Pastikan tidak error jika religion kosong

$islam = strtolower($religion) === 'islam'; // Cek apakah agama Islam
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Client</title>
    <link rel="icon" href="<?= favicon_url() ?>" type="image/x-icon">
    <link href="<?php echo base_url()?>assets/backend/style.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body
    x-data="{ page: 'clients', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
  >
  <!-- ===== Preloader Start ===== -->
  <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})" class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
    <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent">
    </div>
  </div>
  <!-- ===== Preloader End ===== -->
  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <?php $this->load->view('backend/sidebar')?>

    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <?php $this->load->view('backend/header')?>

      <!-- ===== Main Content Start ===== -->
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <div class="grid grid-cols-12 gap-4 md:gap-6 2xl:gap-9">
            <div class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5">
                <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Lihat Client</h1>
                <!-- Dropdown -->
                <div class="relative">
                  <div x-data="{ openDropDown: false }" class="inline-block">
                  <button
                  @click.prevent="openDropDown = !openDropDown"
                  class="inline-flex items-center gap-2.5 rounded-md bg-primary px-5.5 py-3 font-medium text-white hover:bg-opacity-95"
                  >
                  Menu
                  <svg
                  class="fill-current duration-200 ease-linear"
                  :class="openDropDown && 'rotate-180'"
                  width="12"
                  height="7"
                  viewBox="0 0 12 7"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  >
                  <path
                    d="M0.564864 0.879232C0.564864 0.808624 0.600168 0.720364 0.653125 0.667408C0.776689 0.543843 0.970861 0.543844 1.09443 0.649756L5.82517 5.09807C5.91343 5.18633 6.07229 5.18633 6.17821 5.09807L10.9089 0.649756C11.0325 0.526192 11.2267 0.543844 11.3502 0.667408C11.4738 0.790972 11.4562 0.985145 11.3326 1.10871L6.60185 5.55702C6.26647 5.85711 5.73691 5.85711 5.41917 5.55702L0.670776 1.10871C0.600168 1.0381 0.564864 0.967492 0.564864 0.879232Z"
                    fill=""
                  />
                  </svg>
                  </button>

                  <div
                  x-show="openDropDown"
                  @click.outside="openDropDown = false"
                  class="absolute right-0 mt-2 w-64 rounded-md border border-stroke bg-white py-3 shadow-card dark:border-strokedark dark:bg-boxdark"
                  >
                  <ul class="flex flex-col">
                  <li><a href="<?= site_url('clients/edit/'. $clients->id_session) ?>" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary dark:hover:bg-meta-4">Edit</a></li>
                  <li><a href="<?= site_url('project/lihat/'. $clients->id_session) ?>" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary dark:hover:bg-meta-4">Kembali</a></li>

                    <?php if ($islam) : ?>
                    <li><a href="<?= site_url('naskah/jubir_cpp/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Jubir CPP</a></li>
                    <li><a href="<?= site_url('naskah/jubir_cpw/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Jubir CPW</a></li>
                    <li><a href="<?= site_url('naskah/izin_menikah/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Izin Menikah</a></li>
                    <li><a href="<?= site_url('naskah/terima_kasih/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Ucapan Terimakasih</a></li>
                    <?php else : ?>
                    <li><a href="<?= site_url('naskah/terima_kasih2/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Ucapan Terimakasih</a></li>
                    <?php endif; ?>

                    <li><a href="<?= site_url('naskah/data_pengantin/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Data Pengantin</a></li>
                    <li><a href="<?= site_url('naskah/list_vendor/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">List Vendor</a></li>

                    <?php if (!$islam && $project->religion != 'Islam' && !empty($clients->wedding_ceremony)) : ?>
                    <li><a href="<?= $clients->wedding_ceremony ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Susunan Pemberkatan</a></li>
                    <?php elseif (!empty($clients->wedding_ceremony)) : ?>
                    <li><a href="<?= $clients->wedding_ceremony ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Susunan Akad</a></li>
                    <?php endif; ?>

                    <?php if (!empty($clients->reception_afterward)) : ?>
                    <li><a href="<?= $clients->reception_afterward ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Susunan Resepsi</a></li>
                    <?php endif; ?>

                  <li><a href="<?= site_url('clients/buku-tamu/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Buku Tamu</a></li>
                  <li><a href="<?= site_url('clients/nama-janur/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Nama Janur</a></li>
                  <li><a href="<?= site_url('clients/tamu/'. $clients->id_session) ?>" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">List Tamu</a></li>
                  <li><a href="<?= site_url('clients/susunan-acara/'. $clients->id_session) ?>" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Susunan Acara 1</a></li>
                  <?php if (!empty($clients->kategori_acara_2_id_session) || !empty($clients->waktu_acara_2_mulai)) : ?>
                  <li><a href="<?= site_url('clients/susunan-acara/acara2/'. $clients->id_session) ?>" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Susunan Acara 2</a></li>
                  <?php endif; ?>
                  <li><a href="<?= site_url('clients/c_lihat/'. $clients->id_session) ?>" target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Lihat Profile</a></li>
                  <li><a href="https://wa.me/<?= $clients->phone?>?text=Halo Kami dari <?= rawurlencode(nama_website()) ?> Organizer!%0A%0AKami%20ingin%20membagikan%20data%20profil%20pengantin%20yang%20sudah%20kami%20buat.%20Silakan%20klik%20link%20di%20bawah%20ini%20untuk%20melihat%20dan%20mengedit%20data%20sesuai%20kebutuhan%20acara%20kakak.%0A%0A<?= site_url('clients/c_lihat/'. $clients->id_session) ?>%0A%0AUntuk%20username%20dan%20password%20akan%20kami%20kirimkan%20di%20pesan%20berikutnya." target="_blank" class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">Share Profile</a></li>
                    <li>
                        <a href="https://wa.me/?text=<?= $project->project_name ?>%0A<?= hari($clients->wedding_date) ?>,%20<?= tgl_indo($clients->wedding_date) ?>%0A<?php if (!empty($clients->stand_by) && $clients->stand_by !== '00:00:00'): ?>%0AStandby%20di%20lokasi%20jam%20<?= date('H:i', strtotime($clients->stand_by)) ?>%0A<?php endif; ?><?php if (!empty($clients->uniform)): ?>Dresscode%20<?= $clients->uniform ?>%0A<?php endif; ?><?php if (!empty($clients->location)): ?>%0A<?= $clients->location ?><?php endif; ?><?php if (!empty($clients->maps)): ?>%0A<?= $clients->maps ?><?php endif; ?><?php if ($islam): ?><?php if (!empty($clients->wedding_ceremony)): ?>%0A%0ASusunan%20Acara%20Akad%0A<?= $clients->wedding_ceremony ?><?php endif; ?><?php else: ?><?php if (!empty($clients->wedding_ceremony)): ?>Susunan%20Acara%20Pemberkatan%0A<?= $clients->wedding_ceremony ?><?php endif; ?><?php endif; ?><?php if (!empty($clients->reception_afterward)): ?>%0A%0ASusunan%20Acara%20Resepsi%0A<?= $clients->reception_afterward ?><?php endif; ?>%0A%0A*Notes :%0A- Konten tiap event 2 buah%0A%20%20%20%20%201 konten polos, 1 konten dengan nama-nama vendor%0A- Kalau tidak dari template capcut%0A- Export Resolusi min 1080p, Frame rate 60, Code rate High" 
                      target="_blank" 
                      class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">
                        Share to Group WO
                      </a>
                    </li>
                    <li>
                        <a href="https://wa.me/?text=<?= $project->project_name ?>%0A<?= hari($clients->wedding_date) ?>,%20<?= tgl_indo($clients->wedding_date) ?>%0A<?php if (!empty($clients->stand_by) && $clients->stand_by !== '00:00:00'): ?><?php endif; ?><?php if (!empty($clients->location)): ?>%0A<?= $clients->location ?><?php endif; ?><?php if (!empty($clients->maps)): ?>%0A<?= $clients->maps ?><?php endif; ?><?php if ($islam): ?><?php if (!empty($clients->wedding_ceremony)): ?>%0A%0ASusunan%20Acara%20Akad%0A<?= $clients->wedding_ceremony ?><?php endif; ?><?php else: ?><?php if (!empty($clients->wedding_ceremony)): ?>Susunan%20Acara%20Pemberkatan%0A<?= $clients->wedding_ceremony ?><?php endif; ?><?php endif; ?><?php if (!empty($clients->reception_afterward)): ?>%0A%0ASusunan%20Acara%20Resepsi%0A<?= $clients->reception_afterward ?><?php endif; ?>%0A%0AData%20Pengantin%0A<?= site_url('naskah/data_pengantin/'. $clients->id_session) ?>" 
                      target="_blank" 
                      class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary">
                        Share to Group Vendor
                      </a>
                    </li>
                  </ul>
                  </div>
                  </div>
                </div>
                </div>
              <form action="<?= site_url('clients/update/'.$clients->id_session) ?>" method="post" class="bg-white dark:bg-boxdark p-6 shadow-md rounded">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <label class="block mb-2"><strong>Nama Client : </strong><?= $clients->client_name ?></label>        
                <label class="block mb-2"><strong>Agama : </strong><?= $project->religion ?></label>        
                <label class="block mb-2"><strong>Email : </strong><?= $clients->email ?></label>        
                <label class="block mb-2"><strong>No HP : </strong><?= $clients->phone ?></label>

                <!-- Data Mempelai Wanita -->
                <h3 class="text-lg font-bold mt-6 mb-2"><strong>Data Mempelai Wanita</strong></h3>
                <label class="block mb-2"><strong>Nama Lengkap : </strong><?= $clients->f_bride_fname ?></label>
                <label class="block mb-2"><strong>Nama Panggilan : </strong><?= $clients->f_bride_cname ?></label>
                <label class="block mb-2"><strong>Anak Keberapa : </strong><?= $clients->f_bride_nchild ?> dari <?= $clients->f_bride_hsibling ?> Bersaudara</label>
                <?php if (!empty($clients->f_bride_fathername)) : ?>
                  <label class="block mb-2"><strong>Nama Lengkap Ayah : </strong><?= $clients->f_bride_fathername ?></label>
                <?php endif; ?>
                <?php if (!empty($clients->f_bride_fathercname)) : ?>
                  <label class="block mb-2"><strong>Nama Panggilan Ayah : </strong><?= $clients->f_bride_fathercname ?></label>
                <?php endif; ?>
                <?php if (!empty($clients->f_bride_freplacementname)) : ?>
                  <label class="block mb-2"><strong>Nama Lengkap Pengganti : </strong><?= $clients->f_bride_freplacementname ?></label>
                <?php endif; ?>
                <?php if (!empty($clients->f_bride_freplacementcname)) : ?>
                  <label class="block mb-2"><strong>Nama Panggilan Pengganti : </strong><?= $clients->f_bride_freplacementcname ?></label>
                <?php endif; ?>
                <label class="block mb-2"><strong>Nama Lengkap Ibu : </strong><?= $clients->f_bride_mothername ?></label>
                <label class="block mb-2"><strong>Nama Panggilan Ibu : </strong><?= $clients->f_bride_mothercname ?></label>
                <?php if (!empty($clients->f_bride_mreplacementname)) : ?>
                <label class="block mb-2"><strong>Nama Lengkap Pengganti : </strong><?= $clients->f_bride_mreplacementname ?></label>
                <?php endif; ?>
                <?php if (!empty($clients->f_bride_mreplacementcname)) : ?>
                <label class="block mb-2"><strong>Nama Panggilan Pengganti : </strong><?= $clients->f_bride_mreplacementcname ?></label>
                <?php endif; ?>
                <label class="block mb-2"><strong>Nama Saudara Kandung : </strong><?= nl2br($clients->f_bride_sibling) ?></label>

                <!-- Data Mempelai Pria -->
                <h3 class="text-lg font-bold mt-6 mb-2"><strong>Data Mempelai Pria</strong></h3>
                <label class="block mb-2"><strong>Nama Lengkap : </strong><?= $clients->m_bride_fname ?></label>
                <label class="block mb-2"><strong>Nama Panggilan : </strong><?= $clients->m_bride_cname ?></label>
                <label class="block mb-2"><strong>Anak Keberapa : </strong><?= $clients->m_bride_nchild ?> dari <?= $clients->m_bride_hsibling ?> Bersaudara</label>
                <label class="block mb-2"><strong>Nama Lengkap Ayah : </strong><?= $clients->m_bride_fathername ?></label>
                <label class="block mb-2"><strong>Nama Panggilan Ayah : </strong><?= $clients->m_bride_fathercname ?></label>
                <?php if (!empty($clients->m_bride_freplacementname)) : ?>
                <label class="block mb-2"><strong>Nama Lengkap Pengganti : </strong><?= $clients->m_bride_freplacementname ?></label>
                <?php endif; ?>
                <?php if (!empty($clients->m_bride_freplacementcname)) : ?>
                <label class="block mb-2"><strong>Nama Panggilan Pengganti : </strong><?= $clients->m_bride_freplacementcname ?></label>
                <?php endif; ?>
                <label class="block mb-2"><strong>Nama Lengkap Ibu : </strong><?= $clients->m_bride_mothername ?></label>
                <label class="block mb-2"><strong>Nama Panggilan Ibu : </strong><?= $clients->m_bride_mothercname ?></label>
                <?php if (!empty($clients->m_bride_mreplacementname)) : ?>
                <label class="block mb-2"><strong>Nama Lengkap Pengganti : </strong><?= $clients->m_bride_mreplacementname ?></label>
                <?php endif; ?>
                <?php if (!empty($clients->m_bride_mreplacementcname)) : ?>
                <label class="block mb-2"><strong>Nama Panggilan Pengganti : </strong><?= $clients->m_bride_mreplacementcname ?></label>
                <?php endif; ?>
                <label class="block mb-2"><strong>Nama Saudara Kandung : </strong><?= nl2br($clients->m_bride_sibling) ?></label>

                <!-- Detail Pernikahan -->
                <h3 class="text-lg font-bold mt-6 mb-2"><strong>Detail Pernikahan</strong></h3>
                <label class="block mb-2"><strong>Tanggal Pernikahan : </strong><?= hari($clients->wedding_date) ?>, <?= tgl_indo($clients->wedding_date) ?></label>
                <label class="block mb-2"><strong>Lokasi : </strong><?= $clients->location ?></label>
                <label class="block mb-2"><strong>Maps : </strong>
                  <?php if (!empty($clients->maps)) : ?>
                  <a href="<?= $clients->maps ?>" target="_blank" class="text-blue-500 underline">Lihat Maps</a>
                  <?php else : ?>
                  <span>Belum tersedia</span>
                  <?php endif; ?>
                </label>
                <label class="block mb-2"><strong>Kategori Acara 1 : </strong><?= $kategori_acara ? htmlspecialchars($kategori_acara->nama_kategori) : 'Belum dipilih' ?></label>
                <label class="block mb-2"><strong>Jam Pertama Acara : </strong><?= !empty($clients->waktu_acara_mulai) ? substr($clients->waktu_acara_mulai, 0, 5) : 'Belum diisi' ?></label>
                <?php if (!empty($clients->kategori_acara_2_id_session) || !empty($clients->waktu_acara_2_mulai)) : ?>
                <label class="block mb-2"><strong>Kategori Acara 2 : </strong><?= $kategori_acara_2 ? htmlspecialchars($kategori_acara_2->nama_kategori) : 'Belum dipilih' ?></label>
                <label class="block mb-2"><strong>Jam Kedua Acara : </strong><?= !empty($clients->waktu_acara_2_mulai) ? substr($clients->waktu_acara_2_mulai, 0, 5) : 'Belum diisi' ?></label>
                <?php endif; ?>

                <?php if ($islam) : ?>
                <label class="block mb-2"><strong>Mahar : </strong><?= $clients->mahr ?></label>
                <label class="block mb-2"><strong>Simbolis Seserahan : </strong><?= $clients->handover ?></label>
                <label class="block mb-2"><strong>Permohonan Izin ke : </strong><?= $clients->pmizin ?></label>

                <!-- Petugas dan Koordinator Akad Nikah -->
                <h3 class="text-lg font-bold mt-6 mb-2"><strong>Petugas dan Koordinator</strong></h3>
                <label class="block mb-2"><strong>Koordinator Keluarga Wanita : </strong><?= $clients->female_coor ?></label>
                <label class="block mb-2"><strong>Koordinator Keluarga Pria : </strong><?= $clients->male_coor ?></label>
                <label class="block mb-2"><strong>Jubir Keluarga Wanita : </strong><?= $clients->f_spokesman ?></label>
                <label class="block mb-2"><strong>Jubir Keluarga Pria : </strong><?= $clients->m_spokesman ?></label>
                <label class="block mb-2"><strong>Penghulu : </strong><?= $clients->wedding_officiant ?></label>
                <label class="block mb-2"><strong>Wali : </strong><?= $clients->guardian ?></label>
                <label class="block mb-2"><strong>Saksi Calon Pengantin Wanita : </strong><?= $clients->f_witness ?></label>
                <label class="block mb-2"><strong>Saksi Calon Pengantin Pria : </strong><?= $clients->m_witness ?></label>
                <label class="block mb-2"><strong>Qoriah/Saritilawah : </strong><?= $clients->qori ?></label>
                <label class="block mb-2"><strong>Nasihat Pernikahan : </strong><?= $clients->advice_doa ?></label>
                <label class="block mb-2"><strong>Pengapit Calon Pengantin Wanita dari Keluarga : </strong><?= $clients->clamp ?></label>
                <label class="block mb-2"><strong>Pembawa Nampan Kalung Bunga Melati : </strong><?= $clients->jasmine_carrier ?></label>
                <label class="block mb-2"><strong>Pembawa Mas Kawin/Mahar : </strong><?= $clients->mahr_carrier ?></label>
                <label class="block mb-2"><strong>Pembawa Cincin Kawin : </strong><?= $clients->ring_carrier ?></label>

                <?php else : ?>
                <!-- Petugas dan Koordinator Resepsi -->
                <h3 class="text-lg font-bold mt-6 mb-2"><strong>Petugas dan Koordinator Resepsi</strong></h3>
                <label class="block mb-2"><strong>Koordinator Keluarga Wanita : </strong><?= $clients->female_coor ?></label>
                <label class="block mb-2"><strong>Koordinator Keluarga Pria : </strong><?= $clients->male_coor ?></label>
                <label class="block mb-2"><strong>Pendeta : </strong><?= $clients->pastor ?></label>
                <label class="block mb-2"><strong>Gereja : </strong><?= $clients->church ?></label>
                <label class="block mb-2"><strong>Pemimpin Doa : </strong><?= $clients->prayer ?></label>
                <label class="block mb-2"><strong>Sambutan Pernikahan : </strong><?= $clients->wedding_speech ?></label>
                <?php endif; ?>
                <!-- <div class="flex flex-wrap gap-2 mt-4 hidden md:flex">
                  <a href="<?= site_url('clients/edit/'. $clients->id_session) ?>" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                  <a href="javascript:history.back()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
                  <?php if ($islam) : ?>
                    <a href="<?= site_url('naskah/jubir_cpp/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Jubir CPP</a>
                    <a href="<?= site_url('naskah/jubir_cpw/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Jubir CPW</a>
                    <a href="<?= site_url('naskah/izin_menikah/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Izin Menikah</a>
                    <a href="<?= site_url('naskah/terima_kasih/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ucapan Terimakasih</a>
                    <a href="<?= site_url('naskah/data_pengantin/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Data Pengantin</a>
                    <a href="<?= site_url('naskah/list_vendor/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">List Vendor</a>
                    <a href="<?= $clients->wedding_ceremony ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Susunan Akad</a>
                    <a href="<?= $clients->reception_afterward ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Susunan Resepsi</a>
                    <a href="<?= $clients->list_photo ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">List Foto</a>
                    <a href="<?= site_url('clients/c_lihat/'. $clients->id_session) ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lihat Profile</a>
                    <a href="https://wa.me/<?= $clients->phone?>?text=Halo Kami dari <?= rawurlencode(nama_website()) ?> Organizer!%0A%0AKami%20ingin%20membagikan%20data%20profil%20pengantin%20yang%20sudah%20kami%20buat.%20Silakan%20klik%20link%20di%20bawah%20ini%20untuk%20melihat%20dan%20mengedit%20data%20sesuai%20kebutuhan.%20Anda%20bisa%20memperbarui%20informasi%20yang%20diperlukan%20agar%20data%20profil%20pengantin%20bisa%20sesuai%20dengan%20keinginan.%0A%0A<?= site_url('clients/c_lihat/'. $clients->id_session) ?>%0A%0AJika%20anda%20membutuhkan%20username%20dan%20password%20untuk%20mengedit%20data%20sesuai%20kebutuhan,%20jangan%20ragu%20untuk%20menghubungi%20kami.%20Terima%20kasih!" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Share Profile</a>
                  <?php else : ?>
                    <a href="<?= site_url('naskah/terima_kasih2/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ucapan Terimakasih</a>
                    <a href="<?= site_url('naskah/data_pengantin/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Data Pengantin</a>
                    <a href="<?= site_url('naskah/list_vendor/'. $clients->id_session) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">List Vendor</a>
                    <?php  if($project->religion == 'Islam'){ ?>
                    <a href="<?= $clients->wedding_ceremony ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Susunan Akad</a>
                    <?php }else{?>
                    <a href="<?= $clients->wedding_ceremony ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Susunan Pemberkatan</a>
                    <?php }?> 
                    <a href="<?= $clients->reception_afterward ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Susunan Resepsi</a>
                    <a href="<?= $clients->list_photo ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">List Foto</a>
                    <a href="<?= site_url('clients/c_lihat/'. $clients->id_session) ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lihat Profile</a>
                    <a href="https://wa.me/<?= $clients->phone?>?text=Halo Kami dari <?= rawurlencode(nama_website()) ?> Organizer!%0A%0AKami%20ingin%20membagikan%20data%20profil%20pengantin%20yang%20sudah%20kami%20buat.%20Silakan%20klik%20link%20di%20bawah%20ini%20untuk%20melihat%20dan%20mengedit%20data%20sesuai%20kebutuhan.%20Anda%20bisa%20memperbarui%20informasi%20yang%20diperlukan%20agar%20data%20profil%20pengantin%20bisa%20sesuai%20dengan%20keinginan.%0A%0A<?= site_url('clients/c_lihat/'. $clients->id_session) ?>%0A%0AJika%20anda%20membutuhkan%20username%20dan%20password%20untuk%20mengedit%20data%20sesuai%20kebutuhan,%20jangan%20ragu%20untuk%20menghubungi%20kami.%20Terima%20kasih!" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Share Profile</a>
                  <?php endif; ?>
                </div> -->
              </form>

              <!-- ====== Table Three Start -->
              <div class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default  dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1" >
                <div class="max-w-full overflow-x-auto">
                  <table class="w-full table-auto">
                    <thead>
                      <tr class="bg-gray-2 text-left dark:bg-meta-4">
                        <th
                          class="min-w-[220px] px-4 py-4 font-medium xl:pl-11"
                        >
                          Author
                        </th>
                        <th
                          class="min-w-[150px] px-4 py-4 font-medium"
                        >
                          Status
                        </th>
                        <th
                          class="min-w-[120px] px-4 py-4 font-medium"
                        >
                          Time
                        </th>
                        <th class="px-4 py-4 font-medium">
                          Device
                        </th>
                        <th class="px-4 py-4 font-medium">
                          IP
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach ($logactivity as $p): ?>
                      <tr>
                        <?php 
                        if ($p->log_activity_user_id === 'client'): ?>
                          <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                            <h5 class="font-medium">Client</h5>
                          </td>
                        <?php else: 
                          $company = $this->Crud_m->view_where('user', array('client_idsession' => $p->log_activity_user_id))->row();
                          if (!$company) {
                              $company = $this->Crud_m->view_where('user', array('id_session' => $p->log_activity_user_id))->row();
                          }
                          $level = $company ? $this->Crud_m->view_where('user_level', array('user_level_id' => $company->level))->row() : null; // user pembuat log bisa sudah dihapus
                        ?>
                          <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                            <h5 class="font-medium"><?= $company ? htmlspecialchars($company->username) : '-' ?></h5>
                            <p class="text-sm"><?= $level ? htmlspecialchars($level->user_level_nama) : '-' ?></p>
                          </td>
                        <?php endif; ?>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                          <p class="inline-flex rounded-full bg-success bg-opacity-10 px-3 py-1 text-sm font-medium text-success">
                            <?= $p->log_activity_status ?>
                          </p>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p><?= hari($p->log_activity_waktu) ?>, <?= tgl_indo($p->log_activity_waktu)?></p>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                         <p><?= $p->log_activity_platform ?></p>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                         <p><?= $p->log_activity_ip ?></p>
                        </td>
                      </tr>
                      <?php endforeach; ?>                            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
              <!-- ====== Table Three End -->
            </div>
          </div>
        </div>
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
  <script defer src="<?php echo base_url()?>assets/backend/bundle.js"></script>
</body>
</html>
