<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pricelist</title>
    <link rel="icon" href="<?= favicon_url() ?>" type="image/x-icon">
    <link href="<?php echo base_url()?>assets/backend/style.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body
    x-data="{ page: 'projects', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
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
      <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <div class="grid grid-cols-12 gap-4 md:gap-6 2xl:gap-9">
            <div class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5">
                <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Lihat Pricelist <?= $pc->data_pricelist_judul ?></h1>
                <div
                  x-data="{openDropDown: false}"
                  class="relative inline-block"
                >
                  <a
                  href="#"
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
                    <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M1.4719 0.229332L6.00169 4.48868L10.5171 0.24288C10.9015 -0.133119 11.4504 -0.0312785 11.7497 0.267983C12.1344 0.652758 12.0332 1.2069 11.732 1.50812L11.7197 1.52041L6.97862 5.9781C6.43509 6.46442 5.57339 6.47872 5.03222 5.96853C5.03192 5.96825 5.03252 5.96881 5.03222 5.96853L0.271144 1.50833C0.123314 1.3605 -5.04223e-08 1.15353 -3.84322e-08 0.879226C-2.88721e-08 0.660517 0.0936127 0.428074 0.253705 0.267982C0.593641 -0.0719548 1.12269 -0.0699964 1.46204 0.220873L1.4719 0.229332ZM5.41917 5.55702C5.73691 5.85711 6.26647 5.85711 6.60185 5.55702L11.3326 1.10871C11.4562 0.985145 11.4738 0.790972 11.3502 0.667408C11.2267 0.543844 11.0325 0.526192 10.9089 0.649756L6.17821 5.09807C6.07229 5.18633 5.91343 5.18633 5.82517 5.09807L1.09443 0.649756C0.970861 0.543844 0.776689 0.543843 0.653125 0.667408C0.600168 0.720364 0.564864 0.808624 0.564864 0.879232C0.564864 0.967492 0.600168 1.0381 0.670776 1.10871L5.41917 5.55702Z"
                    fill=""
                    />
                  </svg>
                  </a>
                  <div
                  x-show="openDropDown"
                  @click.outside="openDropDown = false"
                  class="absolute left-0 top-full z-40 mt-2 w-full rounded-md border border-stroke bg-white py-3 shadow-card dark:border-strokedark dark:bg-boxdark"
                  >
                  <ul class="flex flex-col">
                    <li>
                    <a
                      href="<?= site_url('potensial-clients-pricelist/edit/'. $pc->data_pricelist_idsession) ?>"
                      class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary dark:hover:bg-meta-4"
                    >
                      Edit
                    </a>
                    </li>
                    <li>
                    <a
                        href="<?= site_url('potensial-clients-pricelist') ?>"
                      class="flex px-5 py-2 font-medium hover:bg-whiter hover:text-primary dark:hover:bg-meta-4"
                    >
                      Kembali
                    </a>
                    </li>
                  </ul>
                  </div>
                </div>
                </div>
              <form action="" method="post" class="bg-white dark:bg-boxdark p-6 shadow-md rounded">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <label class="block mb-2"><strong>Judul : </strong><?= $pc->data_pricelist_judul ?></label>
                <label class="block mb-2">
                    <strong>Link Pricelist Online : </strong>
                    <?php if (!empty($pc->data_pricelist_url)): ?>
                        <a href="<?= $pc->data_pricelist_url ?>" target="_blank">Buka Pricelist</a>
                    <?php else: ?>
                        <span class="text-gray-400">Belum Tersedia</span>
                    <?php endif; ?>
                </label>

       
                <label class="block mb-2"><strong>Harga Asli : </strong>Rp <?= number_format($pc->data_pricelist_harga) ?></label>        
                <label class="block mb-2"><strong>Harga Promo : </strong>Rp <?= number_format($pc->data_pricelist_hargapromo) ?></label>
                <label class="block mb-2"><strong>Kategori : </strong><?= $pc->data_pricelist_type ?></label>
                <label class="block mb-2"><strong>Visibilitas : </strong><?= $pc->data_pricelist_visibilitas ?></label>
                <label class="block mb-2"><strong>Terakhir Update : </strong><?= tgl_indo($pc->data_pricelist_lastupdate)?> ( <?= time_ago($pc->data_pricelist_lastupdate)?> )</label>
                <label class="block mb-2"><strong>Maks. Diskon : </strong>Rp <?= number_format($pc->data_pricelist_diskonmax) ?></label>
                <label class="block mb-2"><strong>Detail : </strong><?= $pc->data_pricelist_deskripsi ?></label>
                
                <!-- <br>
                <a href="<?= site_url('potensial-clients/edit/'. $pc->data_pricelist_idsession) ?>" class="ml-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 inline-block text-center w-auto">Edit</a>
                <a href="<?= site_url('potensial-clients') ?>" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 inline-block text-center w-auto">Kembali</a> -->
              </form>

              <div class="mt-4">

              <!-- TOMBOL -->
              <button onclick="openUploadPopup()" 
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Upload Gambar
              </button>

              <!-- PREVIEW HASIL UPLOAD -->
              <div class="mt-4 flex flex-wrap gap-4">

                <?php if (!empty($pc_img)) : ?>
                    
                    <?php foreach ($pc_img as $img) : ?>
                      <div class="relative">
                          <img 
                              src="<?= base_url('assets/uploads/pricelist/'.$img->data_pricelist_gambar_nama) ?>" 
                              class="rounded w-60 shadow">

                          <a 
                            href="<?= site_url('potensial-clients-pricelist/permanent_delete_gambar/'.$img->data_pricelist_idsession.'/'.$img->data_pricelist_gambar_nama) ?>"
                            onclick="return confirm('Yakin mau hapus gambar ini?')"
                            class="absolute top-1 right-1 bg-red-500 text-white px-2 rounded">
                            X
                        </a>
                      </div>
                  <?php endforeach; ?>

                <?php else : ?>
                    
                    <img 
                        src="<?= base_url('assets/uploads/pricelist/default.png') ?>" 
                        class="rounded w-60 shadow">

                <?php endif; ?>

              </div>

            </div>

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
                        <?php $company= $this->Crud_m->view_where('user', array('id_session'=> $p->log_activity_user_id))->row(); ?>
                        <?php $level = $company ? $this->Crud_m->view_where('user_level', array('user_level_id' => $company->level))->row() : null; // user pembuat log bisa sudah dihapus ?>
                        <td
                          class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11"
                        >
                          <h5 class="font-medium"><?= $company ? htmlspecialchars($company->username) : '-' ?></h5>
                          <p class="text-sm"><?= $level ? htmlspecialchars($level->user_level_nama) : '-' ?></p>
                        </td>                        
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                          <p
                            class="inline-flex rounded-full bg-success bg-opacity-10 px-3 py-1 text-sm font-medium text-success"
                          >
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

              <!-- ====== Table Three End -->



            </div>
          </div>
        </div>
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
  </div>
  <!-- POPUP UPLOAD -->
  <div id="uploadPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-boxdark p-6 rounded shadow-lg w-80">
      
      <h2 class="text-lg font-bold mb-4">Upload Gambars</h2>

      <input type="file" id="uploadImage" accept="image/*" class="mb-3 w-full">

      <p class="text-sm text-gray-500 mb-2">Max ukuran: 1MB</p>

      <!-- Preview -->
      <img id="previewImage" class="hidden mb-3 rounded w-full h-40 object-cover"/>

      <!-- Error -->
      <p id="errorMsg" class="text-red-500 text-sm mb-2 hidden"></p>

      <div class="flex justify-end">
        <button onclick="closeUploadPopup()" class="mr-2 bg-gray-400 text-white px-3 py-1 rounded">
          Batal
        </button>
        <button onclick="uploadAJAX()" class="bg-blue-500 text-white px-3 py-1 rounded">
          Upload
        </button>
      </div>

    </div>
  </div>

  <script>

    const uploadPopup = document.getElementById('uploadPopup');
    const uploadImage = document.getElementById('uploadImage');
    const previewImage = document.getElementById('previewImage');
    const errorMsg = document.getElementById('errorMsg');
    const resultImage = document.getElementById('resultImage');

    function openUploadPopup() {
        uploadPopup.classList.remove('hidden');
        uploadPopup.classList.add('flex');

        // reset input
        uploadImage.value = "";
    }

    function closeUploadPopup() {
        uploadPopup.classList.add('hidden');
        uploadPopup.classList.remove('flex');
        errorMsg.classList.add('hidden');
        previewImage.classList.add('hidden');
    }

    // preview + validasi
    uploadImage.addEventListener('change', function() {
        const file = this.files[0];

        if (!file) return;

        if (file.size > 1024 * 1024) {
            errorMsg.innerText = "Ukuran > 1MB!";
            errorMsg.classList.remove('hidden');
            this.value = "";
            return;
        }

        errorMsg.classList.add('hidden');

        const reader = new FileReader();
        reader.onload = e => {
            previewImage.src = e.target.result;
            previewImage.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    });

   function uploadAJAX() {
      const fileInput = document.getElementById('uploadImage');
      const file = fileInput.files[0];

      if (!file) {
          errorMsg.innerText = "Pilih gambar dulu!";
          errorMsg.classList.remove('hidden');
          return;
      }

      let formData = new FormData();
      formData.append('gambar', file);
      formData.append('id', "<?= $pc->data_pricelist_idsession ?>");
      formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');

      fetch("<?= site_url('potensial-clients-pricelist/upload_gambar') ?>", {
          method: "POST",
          body: formData
      })
      .then(res => res.json()) // parse JSON langsung
      .then(json => {
          if (json.status === 'success') {
              // tampilkan gambar
              const resultImage = document.getElementById('resultImage');
              resultImage.src = json.url + '?t=' + new Date().getTime();
              resultImage.classList.remove('hidden');
              closeUploadPopup();
          } else {
              console.error("UPLOAD ERROR:", json.message);
              errorMsg.innerText = json.message;
              errorMsg.classList.remove('hidden');
          }
      })
      .catch(err => {
        console.error("FETCH ERROR:", err);
        // Reload halaman jika terjadi error
        location.reload();
      });
  }


  </script>
  <script defer src="<?php echo base_url()?>assets/backend/bundle.js"></script>

</body>
</html>
