<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to ERP Younme Organizer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="icon" href="<?= favicon_url() ?>" type="image/x-icon">
	<link href="<?php echo base_url()?>assets/backend/style.css" rel="stylesheet" type="text/css"/>
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		body {
			background-image: url('<?= htmlspecialchars(bg_beranda_url(), ENT_QUOTES) ?>');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}

		@media (max-width: 768px) {
			body {
				background-image: url('<?= htmlspecialchars(bg_beranda_hp_url(), ENT_QUOTES) ?>');
			}
		}
	</style>
</head>
<body class="bg-white dark:bg-boxdark-2 text-black dark:text-white">
	<div class="min-h-screen flex flex-col justify-end">
		<footer class="text-center text-sm text-black mb-4">
			<div class="flex justify-center space-x-2 mb-4">
				<a href="<?= base_url('login') ?>" class="bg-[#ed126b] hover:bg-pink-600 text-white font-bold py-3 px-6 rounded text-xs flex items-center space-x-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5">
						<path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
					</svg>
					<span>Login</span>
				</a>
				<?php $wa_admin = nomor_wa_chat_admin(); // diisi lewat Pengaturan Website; kosong -> tombol Chat Admin disembunyikan ?>
				<?php if ($wa_admin): ?>
				<a href="https://wa.me/<?= $wa_admin ?>?text=<?= rawurlencode('Halo, saya ingin menanyakan cara login ke ' . nama_website() . '.') ?>" target="_blank" class="bg-[#25D366] hover:bg-green-600 text-white font-bold py-3 px-6 rounded text-xs flex items-center space-x-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5 transform scale-x-[-1]">
						<path fill-rule="evenodd" d="M5.337 21.718a6.707 6.707 0 0 1-.533-.074.75.75 0 0 1-.44-1.223 3.73 3.73 0 0 0 .814-1.686c.023-.115-.022-.317-.254-.543C3.274 16.587 2.25 14.41 2.25 12c0-5.03 4.428-9 9.75-9s9.75 3.97 9.75 9c0 5.03-4.428 9-9.75 9-.833 0-1.643-.097-2.417-.279a6.721 6.721 0 0 1-4.246.997Z" clip-rule="evenodd" />
					</svg>
					<span>Chat Admin</span>
				</a>
				<?php endif; ?>
			</div>
			<p><?= teks_footer_beranda() ?></p>
		</footer>
	</div>
	</body>
	</html>
