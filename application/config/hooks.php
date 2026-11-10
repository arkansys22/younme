<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

// Penjaga login terpusat: sesi habis / belum login -> ke halaman login (AJAX: 401), plus header no-store untuk
// halaman yang butuh login. Harus terdaftar PALING ATAS supaya jalan sebelum hook lain (lihat hooks/Login_guard.php).
$hook['post_controller_constructor'][] = array(
    'class'    => 'Login_guard',
    'function' => 'periksa',
    'filename' => 'Login_guard.php',
    'filepath' => 'hooks',
);

// Nge-update `user.last_activity` tiap kali user yang login membuka halaman
// apa pun -- fitur status online (lihat status_online() di customs_helper.php
// & application/hooks/Track_online.php) butuh ini supaya "Online" benar-benar
// berarti "baru saja aktif", bukan cuma "pernah login dan belum eksplisit
// logout".
$hook['post_controller_constructor'][] = array(
    'class'    => 'Track_online',
    'function' => 'touch_last_activity',
    'filename' => 'Track_online.php',
    'filepath' => 'hooks',
);

// Hak Akses per Level: batasi halaman yang boleh dibuka level yang sudah diatur (lihat hooks/Hak_akses_guard.php)
$hook['post_controller_constructor'][] = array(
    'class'    => 'Hak_akses_guard',
    'function' => 'periksa',
    'filename' => 'Hak_akses_guard.php',
    'filepath' => 'hooks',
);
