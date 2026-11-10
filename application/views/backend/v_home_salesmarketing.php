<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	    <title>Younme Wedding Organizer</title>
	    <meta name="title" content="Vendor Pernikahan Terlengkap | Younme Wedding Organizer">
	    <meta name="site_url" content="<?php echo base_url()?>">
	    <meta name="description" content="">
	    <meta name="keywords" content="younme, vendor pernikahan, wedding organizer, wedding planner">

	    <meta NAME="ROBOTS" CONTENT="NOINDEX">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="web_author" content="dhawyarkan.com">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	    <meta name="apple-mobile-web-app-capable" content="yes" />
	    <meta property="og:site_name" content="Younme">
	    <meta property="og:title" content="Vendor Pernikahan Terlengkap | Younme Wedding Organizer">
	    <meta property="og:description" content="">
	    <meta property="og:url" content="<?php echo base_url()?>">
	    <meta property="og:image" content="<?php echo base_url()?>asset/frontend/aspanel/img/logo.png">
	    <meta property="og:image:url" content="<?php echo base_url()?>asset/frontend/aspanel/img/logo.png">
	    <meta property="og:type" content="article">
	    <link rel="icon" href="<?= favicon_url() ?>" type="image/x-icon">
	    <link href="<?php echo base_url()?>assets/backend/style.css" rel="stylesheet" type="text/css"/>

		<script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    x-data="{ page: 'dashboard', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
  >

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
	            <!-- ====== Data Stats Start -->
	            <div class="data-stats-slider-outer relative col-span-12 rounded-sm border border-stroke bg-white py-10 shadow-default dark:border-strokedark dark:bg-boxdark" >
	                <div class="dataStatsSlider swiper !-mx-px">
	                  <div class="swiper-wrapper">

					  <div class="swiper-slide border-r border-stroke px-10 last:border-r-0 dark:border-strokedark">
						<div class="flex items-center justify-between">
							<div class="flex items-center gap-2.5">
								<h4 class="text-xl font-bold">
									Clients
								</h4>
							</div>
						</div>

						<div class="mt-5.5 flex flex-col gap-1.5">
							<!-- Client Bulan Ini -->
							<div class="flex items-center justify-between gap-1">
								<p class="text-sm font-medium">Client Tahun Ini</p>
									<p id="client_tahun_ini" class="text-sm font-medium"><?= count($client_tahun_ini); ?></p>
							</div>

							<!-- Client Bulan Lalu -->
							<div class="flex items-center justify-between gap-1">
								<p class="text-sm font-medium">Client Tahun Lalu</p>
									<p id="client_tahun_lalu" class="text-sm font-medium"><?= count($client_tahun_lalu); ?></p>
							</div>

							<div class="flex items-center justify-between gap-1">
								<p class="text-sm font-medium">Client Tahun Depan</p>
									<p id="client_tahun_depan" class="text-sm font-medium"><?= count($client_tahun_depan); ?></p>
							</div>

							<!-- Total Client -->
							<div class="flex items-center justify-between gap-1">
								<p class="text-sm font-medium">Total Semua Client</p>
									<p id="total_client" class="text-sm font-medium"><?= $total_client; ?></p>
							</div>
							<div class="flex items-center justify-between gap-1">
								<p class="text-sm font-medium">
									<a href="<?= base_url('client/lebih_lengkap') ?>">
				                        <span class="text-sm font-medium text-primary">
				                          Lebih Lengkap >>
				                        </span>
				                    </a>				                      
								</p>
							</div>				
						</div>
	                    </div>

	                    <div class="swiper-slide border-r border-stroke px-10 last:border-r-0 dark:border-strokedark">
							<div class="flex items-center justify-between">
								<div class="flex items-center gap-2.5">
									<h4 class="text-xl font-bold">
										Top 5 Sales Bulan Ini
									</h4>
								</div>
							</div>

							<div class="mt-5.5 flex flex-col gap-1.5">
								<?php if (empty($top_sales_ranking)): ?>
								<p class="text-sm font-medium">Belum ada pencapaian bulan ini</p>
								<?php else: ?>
								<?php foreach ($top_sales_ranking as $i => $rank): ?>
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">#<?= $i + 1 ?> <a href="<?= site_url('sales-achievement/' . $rank->user_id_session) ?>" class="hover:underline hover:text-primary"><?= $rank->nama ?></a></p>
									<p class="text-sm font-medium">Rp <?= number_format($rank->total_pencapaian, 0, ',', '.') ?></p>
								</div>
								<?php endforeach; ?>
								<?php endif; ?>
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">
										<a href="<?= site_url('sales-ranking') ?>">
											<span class="text-sm font-medium text-primary">
												Lihat Bulan Lainnya >>
											</span>
										</a>
									</p>
								</div>
							</div>
	                    </div>

	                    <div class="swiper-slide border-r border-stroke px-10 last:border-r-0 dark:border-strokedark">
							<div class="flex items-center justify-between">
								<div class="flex items-center gap-2.5">
									<h4 class="text-xl font-bold">
										Estimasi Revenue Bulan Ini
									</h4>
								</div>
							</div>

							<div class="mt-5.5 flex flex-col gap-1.5">
								<!-- Total Revenue Bulan Ini -->
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Target</p>
										<p id="target_nominal" class="text-sm font-medium">Rp 0</p>
								</div>
								<!-- Pemasukan Bulan Lalu -->
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Pencapaian</p>
										<p id="estimasi_revenue_bulan_ini" class="text-sm font-medium">Rp 0</p>
								</div>
								<!-- Total Revenue Semua -->
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Kekurangan Target</p>
										<p id="hasil_target" class="text-sm font-medium">Rp 0</p>
								</div>
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Estimasi Komisi</p>
										<p id="estimasi_komisi_bulan_ini" class="text-sm font-medium">Rp 0</p>
								</div>					
							</div>
						</div>
	                   	<div class="swiper-slide border-r border-stroke px-10 last:border-r-0 dark:border-strokedark">
	                      	<div class="flex items-center justify-between">
		                        <div class="flex items-center gap-2.5">
		                          <h4
		                            class="text-xl font-bold"
		                          >
		                            Pencapaian Revenue
		                          </h4>
		                        </div>		                        
	                      	</div>
	                      	<div class="mt-5.5 flex flex-col gap-1.5">
								<!-- Total Revenue Bulan Ini -->
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Tahun Ini</p>
										<p id="estimasi_revenue_tahun_ini" class="text-sm font-medium">
											Rp 0
										</p>
								</div>

								<!-- Pemasukan Bulan Lalu -->
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Tahun Lalu</p>
										<p id="estimasi_revenue_tahun_lalu" class="text-sm font-medium">
											Rp 0
										</p>
								</div>
								<!-- Total Revenue Semua -->
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Keseluruhan</p>
										<p id="estimasi_revenue_all_time" class="text-sm font-medium">Rp 0</p>
								</div>
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Komisi Total</p>
										<p id="estimasi_komisi_total" class="text-sm font-medium">Rp 0</p>
								</div>
								<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">
										<a href="<?= site_url('sales-achievement/' . $this->session->id_session) ?>">
				                        <span class="text-sm font-medium text-primary">
				                          Lebih Lengkap >>
				                        </span>
				                    </a>
									</p>
								</div>

							</div>


	                    </div>
	                                      
		                    <?php $this->load->view('backend/partial_pendapatan_crew', ['pendapatan_tampilan' => 'slide']) ?>
	                  </div>
	                </div>

	                <div class="swiper-button-prev">
	                  <svg
	                    class="fill-current"
	                    width="23"
	                    height="23"
	                    viewBox="0 0 23 23"
	                    fill="none"
	                    xmlns="http://www.w3.org/2000/svg"
	                  >
	                    <path
	                      d="M15.8562 2.80185C16.0624 2.80185 16.2343 2.8706 16.4062 3.0081C16.7155 3.31748 16.7155 3.79873 16.4062 4.1081L9.1874 11.4987L16.4062 18.855C16.7155 19.1644 16.7155 19.6456 16.4062 19.955C16.0968 20.2644 15.6155 20.2644 15.3062 19.955L7.5374 12.0487C7.22803 11.7394 7.22803 11.2581 7.5374 10.9487L15.3062 3.04248C15.4437 2.90498 15.6499 2.80185 15.8562 2.80185Z"
	                      fill=""
	                    />
	                  </svg>
	                </div>

	                <div class="swiper-button-next">
	                  <svg
	                    class="fill-current"
	                    width="23"
	                    height="23"
	                    viewBox="0 0 23 23"
	                    fill="none"
	                    xmlns="http://www.w3.org/2000/svg"
	                  >
	                    <path
	                      d="M8.08721 20.1957C7.88096 20.1957 7.70908 20.127 7.53721 19.9895C7.22783 19.6801 7.22783 19.1988 7.53721 18.8895L14.756 11.4988L7.53721 4.14258C7.22783 3.8332 7.22783 3.35195 7.53721 3.04258C7.84658 2.7332 8.32783 2.7332 8.63721 3.04258L16.406 10.9488C16.7153 11.2582 16.7153 11.7395 16.406 12.0488L8.63721 19.9551C8.49971 20.0926 8.29346 20.1957 8.08721 20.1957Z"
	                      fill=""
	                    />
	                  </svg>
	                </div>
	            </div>
	            <!-- ====== Data Stats End -->

				<?php $this->load->view('backend/partial_pendapatan_crew', ['pendapatan_tampilan' => 'dialog']) ?>

				<div class="col-span-12">
					<div class="flex flex-wrap justify-center gap-4">
						<?php if (isset($tampilkan_button_event) && $tampilkan_button_event): ?>
							<a href="<?= base_url('panel/staff') ?>">
								<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none flex flex-col items-center justify-center">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
									</svg>
									Event
								</button>
							</a>
						<?php endif; ?>
						<a href="<?= base_url('absensi') ?>">
							<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none flex flex-col items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z" />
								</svg>
								Absensi
							</button>
						</a>
						<a href="<?= base_url('gaji-saya') ?>">
							<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none flex flex-col items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182.553-.44 1.278-.659 2.003-.659.725 0 1.45.22 2.003.659l.442.35M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
								</svg>
								Rekap Gaji
							</button>
						</a>
						<!-- <button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 3
						</button>
						<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 4
						</button>
						<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 5
						</button>
						<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 6
						</button>
						<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 7
						</button>
						<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 8
						</button>
						<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 9
						</button>
						<button class="w-40 h-40 bg-[#ed126b] text-white font-semibold rounded-none hover:bg-pink-800 focus:outline-none">
							Button 10
						</button> -->
					</div><br>
				  
				</div>

	            

            </div>
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <script defer src="<?php echo base_url()?>assets/backend/bundle.js"></script>
	<script>
    function fetchRevenueData() {
        fetch('<?= base_url('Aspanel/get_revenue_data') ?>')
            .then(response => response.json())
            .then(data => {
               	document.querySelector('#target_nominal').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.target_nominal)}`;
                document.querySelector('#estimasi_revenue_bulan_ini').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.estimasi_revenue_bulan_ini)}`;
                document.querySelector('#hasil_target').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.hasil_target)}`;
                document.querySelector('#estimasi_komisi_bulan_ini').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.estimasi_komisi_bulan_ini)}`;

                document.querySelector('#estimasi_revenue_tahun_ini').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.estimasi_revenue_tahun_ini)}`;
                document.querySelector('#estimasi_revenue_tahun_lalu').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.estimasi_revenue_tahun_lalu)}`;
                document.querySelector('#estimasi_revenue_all_time').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.estimasi_revenue_all_time)}`;
                document.querySelector('#estimasi_komisi_total').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.estimasi_komisi_total)}`;

                 document.querySelector('#revenue_bulan_ini').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.revenue_bulan_ini)}`;
                document.querySelector('#revenue_bulan_lalu').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.revenue_bulan_lalu)}`;
                document.querySelector('#total_revenue_all').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.total_revenue_all)}`;
                document.querySelector('#total_net_revenue').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.total_net_revenue)}`;
                document.querySelector('#expense_bulan_ini').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.expense_bulan_ini)}`;
                document.querySelector('#expense_bulan_lalu').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.expense_bulan_lalu)}`;
                document.querySelector('#total_expense_all').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.total_expense_all)}`;
                document.querySelector('#total_gross_profit').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.total_gross_profit)}`;
                document.querySelector('#total_net_profit').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.total_net_profit)}`;
                
                const percentChangeElement = document.querySelector('#percent_change');
                if (data.percent_change !== null) {
                    percentChangeElement.textContent = `${data.percent_change > 0 ? '+' : ''}${data.percent_change.toFixed(2)}% dibanding bulan lalu`;
                    percentChangeElement.style.color = data.percent_change > 0 ? 'green' : 'red';
                } else {
                    percentChangeElement.textContent = '0% dibanding bulan lalu';
                    percentChangeElement.style.color = 'black';
                }
            })
            .catch(error => console.error('Error fetching revenue data:', error));
    }

    // Panggil fungsi fetchRevenueData setiap 30 detik
    setInterval(fetchRevenueData, 30000);

    // Panggil fungsi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', fetchRevenueData);

    function fetchClientData() {
        fetch('<?= base_url('Aspanel/get_client_data') ?>')
            .then(response => response.json())
            .then(data => {
                document.querySelector('#client_bulan_ini').textContent = data.client_bulan_ini;
                document.querySelector('#client_bulan_lalu').textContent = data.client_bulan_lalu;
                document.querySelector('#client_bulan_depan').textContent = data.client_bulan_depan;
                document.querySelector('#total_client').textContent = data.total_client;
            })
            .catch(error => console.error('Error fetching client data:', error));
    }

    // Panggil fungsi fetchClientData setiap 30 detik
    setInterval(fetchClientData, 30000);

    // Panggil fungsi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', fetchClientData);
	</script>

</body>

</html>
