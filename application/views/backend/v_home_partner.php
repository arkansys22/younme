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
    x-data="{ page: 'panel', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
		darkMode = JSON.parse(localStorage.getItem('darkMode'));
		$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
>
	<!-- ===== Preloader Start ===== -->
	<div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => 	loaded = false, 500)})" class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
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
					<!-- ====== Data Stats Start -->
					<!-- <div class="data-stats-slider-outer relative col-span-12 rounded-sm border border-stroke bg-white py-10 shadow-default dark:border-strokedark dark:bg-boxdark" >
						<div class="dataStatsSlider swiper !-mx-px">
							<div class="swiper-wrapper">

							<div class="swiper-slide border-r border-stroke px-10 last:border-r-0 dark:border-strokedark">
								<div class="flex items-center justify-between">
									<div class="flex items-center gap-2.5">
									<div
										class="h-10.5 w-10.5 overflow-hidden rounded-full"
									>
										<img
										src="src/images/brand/brand-07.svg"
										alt="brand"
										/>
									</div>
									<h4
										class="text-xl font-bold"
									>
										Event Berikutnya
									</h4>
									</div>
									
								</div>
								<div class="mt-5.5 flex flex-col gap-1.5">
									<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Total Event</p>
									<p class="font-medium">
										$410.50
									</p>
									</div>
								</div>
							</div>

							<div class="swiper-slide border-r border-stroke px-10 last:border-r-0 dark:border-strokedark">
								<div class="flex items-center justify-between">
									<div class="flex items-center gap-2.5">
									<div
										class="h-10.5 w-10.5 overflow-hidden rounded-full"
									>
										<img
										src="src/images/brand/brand-07.svg"
										alt="brand"
										/>
									</div>
									<h4
										class="text-xl font-bold"
									>
										Event Selesai
									</h4>
									</div>
									
								</div>
								<div class="mt-5.5 flex flex-col gap-1.5">
									<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Total Event</p>
									<p class="font-medium">
										$410.50
									</p>
									</div>
								</div>
							</div>

							<div class="swiper-slide border-r border-stroke px-10 last:border-r-0 dark:border-strokedark">
								<div class="flex items-center justify-between">
									<div class="flex items-center gap-2.5">
									<div
										class="h-10.5 w-10.5 overflow-hidden rounded-full"
									>
										<img
										src="src/images/brand/brand-07.svg"
										alt="brand"
										/>
									</div>
									<h4
										class="text-xl font-bold"
									>
										Semua Event
									</h4>
									</div>
									
								</div>
								<div class="mt-5.5 flex flex-col gap-1.5">
									<div class="flex items-center justify-between gap-1">
									<p class="text-sm font-medium">Total Event</p>
									<p class="font-medium">
										$410.50
									</p>
									</div>
								</div>
							</div>
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
							d="M15.8562 2.80185C16.0622 2.80185 16.2343 2.8706 16.4062 3.0081C16.7155 3.31748 16.7155 3.79873 16.4062 4.1081L9.1874 11.4987L16.4062 18.855C16.7155 19.1644 16.7155 19.6456 16.4062 19.955C16.0968 20.2644 15.6155 20.2644 15.3062 19.955L7.5374 12.0487C7.22803 11.7394 7.22803 11.2581 7.5374 10.9487L15.3062 3.04228C15.4437 2.90498 15.6499 2.80185 15.8562 2.80185Z"
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
					</div> -->
					<div class="data-stats-slider-outer relative col-span-12 rounded-sm border border-stroke bg-white py-10 shadow-default dark:border-strokedark dark:bg-boxdark">
					<!-- ===== Main Content Start ===== -->
					<main>
					<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
						<div class="mx-auto max-w-7xl">
						<!-- Header / Filter -->
						<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
							<h2 class="text-title-md2 font-bold">Calendar</h2>
							<div class="flex gap-4">
							<select id="month-select" class="border rounded p-2">
								<?php for ($m = 1; $m <= 12; $m++): ?>
								<option value="<?php echo $m; ?>" <?php echo $m == date('n') ? 'selected' : ''; ?>>
									<?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
								</option>
								<?php endfor; ?>
							</select>
							<select id="year-select" class="border rounded p-2">
								<?php for ($y = date('Y') - 5; $y <= date('Y') + 5; $y++): ?>
								<option value="<?php echo $y; ?>" <?php echo $y == date('Y') ? 'selected' : ''; ?>>
									<?php echo $y; ?>
								</option>
								<?php endfor; ?>
							</select>
							</div>
						</div>

						<!-- ====== Calendar Section Start -->
						<div class="w-full rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark overflow-x-auto">
							<table class="w-full min-w-[700px] text-center">
							<thead>
								<tr class="grid grid-cols-7 bg-primary text-white text-xs sm:text-sm font-semibold">
								<th class="p-2 sm:p-4">Min</th>
								<th class="p-2 sm:p-4">Sen</th>
								<th class="p-2 sm:p-4">Sel</th>
								<th class="p-2 sm:p-4">Rab</th>
								<th class="p-2 sm:p-4">Kam</th>
								<th class="p-2 sm:p-4">Jum</th>
								<th class="p-2 sm:p-4">Sab</th>
								</tr>
							</thead>
							<tbody id="calendar-body">
								<!-- Calendar rows will be dynamically generated here -->
							</tbody>
							</table>
						</div>
						<!-- ====== Calendar Section End -->

						<script>
							const monthSelect = document.getElementById('month-select');
							const yearSelect = document.getElementById('year-select');
							const calendarBody = document.getElementById('calendar-body');

							// Event data passed from the controller
							const events = <?php echo json_encode($events); ?>;

							function generateCalendar(month, year) {
							const firstDay = new Date(year, month - 1, 1).getDay();
							const daysInMonth = new Date(year, month, 0).getDate();
							let calendarHTML = '';
							let date = 1;

							for (let i = 0; i < 6; i++) {
								let rowHTML = '<tr class="grid grid-cols-7 text-xs sm:text-sm">';
								for (let j = 0; j < 7; j++) {
								if (i === 0 && j < firstDay) {
									rowHTML += '<td class="border border-stroke p-2 sm:p-4 dark:border-strokedark"></td>';
								} else if (date > daysInMonth) {
									rowHTML += '<td class="border border-stroke p-2 sm:p-4 dark:border-strokedark"></td>';
								} else {
									const currentDate = `${year}-${String(month).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
									const event = events.find(e => e.event_date === currentDate);

									rowHTML += `<td class="border border-stroke p-2 sm:p-4 dark:border-strokedark ${event ? 'bg-green-200 dark:bg-green-700' : ''}">
												<span class="font-medium block">${date}</span>
												${event ? `<p class="text-[10px] text-gray-600 dark:text-gray-300 truncate">Client: ${event.client_name}</p><p class="text-[10px] text-gray-600 dark:text-gray-300 truncate">Lokasi: ${event.location}</p>` : ''}
												</td>`;
									date++;
								}
								}
								rowHTML += '</tr>';
								calendarHTML += rowHTML;
								if (date > daysInMonth) break;
							}

							calendarBody.innerHTML = calendarHTML;
							}

							monthSelect.addEventListener('change', () => {
							generateCalendar(monthSelect.value, yearSelect.value);
							});

							yearSelect.addEventListener('change', () => {
							generateCalendar(monthSelect.value, yearSelect.value);
							});

							// Initial load
							generateCalendar(monthSelect.value, yearSelect.value);
						</script>
						</div>
					</div>
					</main>
					<!-- ===== Main Content End ===== -->
					</div>

					<div class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5">
						<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
							<div class="data-table-common data-table-two max-w-full overflow-x-auto">
								<table class="table w-full table-auto" id="dataTableTwo">
								<thead>
									<tr>
									<th>
										<div class="flex items-center justify-between gap-1.5">
										<p>No</p>
										<div class="inline-flex flex-col space-y-[2px]">
											<span class="inline-block">
											<svg
												class="fill-current"
												width="10"
												height="5"
												viewBox="0 0 10 5"
												fill="none"
												xmlns="http://www.w3.org/2000/svg"
											>
												<path d="M5 0L0 5H10L5 0Z" fill="" />
											</svg>
											</span>
											<span class="inline-block">
											<svg
												class="fill-current"
												width="10"
												height="5"
												viewBox="0 0 10 5"
												fill="none"
												xmlns="http://www.w3.org/2000/svg"
											>
												<path
												d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
												fill=""
												/>
											</svg>
											</span>
										</div>
										</div>
									</th>
									<th class="w-1/4">
									<div class="flex items-center justify-between gap-1.5">
									<p>Tanggal & Lokasi Acara</p>
									<div class="inline-flex flex-col space-y-[2px]">
										<span class="inline-block"></span>
										<svg
											class="fill-current"
											width="10"
											height="5"
											viewBox="0 0 10 5"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path d="M5 0L0 5H10L5 0Z" fill="" />
										</svg>
										</span>
										<span class="inline-block">
										<svg
											class="fill-current"
											width="10"
											height="5"
											viewBox="0 0 10 5"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
											d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
											fill=""
											/>
										</svg>
										</span>
									</div>
									</div>
									</th>
									<th>
										<div class="flex items-center justify-between gap-1.5">
										<p>Nama Pengantin</p>
										<div class="inline-flex flex-col space-y-[2px]">
											<span class="inline-block">
											<svg
												class="fill-current"
												width="10"
												height="5"
												viewBox="0 0 10 5"
												fill="none"
												xmlns="http://www.w3.org/2000/svg"
											>
												<path d="M5 0L0 5H10L5 0Z" fill="" />
											</svg>
											</span>
											<span class="inline-block">
											<svg
												class="fill-current"
												width="10"
												height="5"
												viewBox="0 0 10 5"
												fill="none"
												xmlns="http://www.w3.org/2000/svg"
											>
												<path
												d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
												fill=""
												/>
											</svg>
											</span>
										</div>
										</div>
									</th>
									<th>
										<div class="flex items-center justify-between gap-1.5">
										<p>Aksi</p>
										<div class="inline-flex flex-col space-y-[2px]">
											<span class="inline-block">
											<svg
												class="fill-current"
												width="10"
												height="5"
												viewBox="0 0 10 5"
												fill="none"
												xmlns="http://www.w3.org/2000/svg"
											>
												<path d="M5 0L0 5H10L5 0Z" fill="" />
											</svg>
											</span>
											<span class="inline-block">
											<svg
												class="fill-current"
												width="10"
												height="5"
												viewBox="0 0 10 5"
												fill="none"
												xmlns="http://www.w3.org/2000/svg"
											>
												<path
												d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z"
												fill=""
												/>
											</svg>
											</span>
										</div>
										</div>
									</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($events as $index => $event): ?>
								<tr>
									<td><?php echo $index + 1; ?></td>
									<td>
									<p><?php echo hari($event['event_date']); ?>, <?php echo date('d M Y', strtotime($event['event_date'])); ?></p>
									<p><?php echo $event['location']; ?></p>
									</td>
									<td><?php echo $event['client_name']; ?></td>
									<td>
									<a href="<?php echo base_url('project/partner_lihat/' . $event['id_session']); ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Lihat</a>
									</td>
								</tr>
								<?php endforeach; ?>
								</tbody>
								</table>
							</div>
						</div>
						<!-- ====== Data Table Two End -->                
					</div>
				</div>
			</div>
		</main>
		<!-- ===== Main Content End ===== -->
	</div>
	<!-- ===== Content Area End ===== -->
	</div>
<script defer src="<?php echo base_url()?>assets/backend/bundle.js"></script>
</body>

</html>