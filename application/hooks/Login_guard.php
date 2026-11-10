<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Penjaga login terpusat. Sebelumnya tiap controller mengecek login sendiri-sendiri dan banyak method yang lupa
// (mis. Aspanel::revenue_lebih_lengkap, Crud_finance_operational::get_data, Crud_sales_marketing::get_data), sehingga
// setelah sesi habis halaman/data panel masih bisa dibuka. Hook ini jalan di post_controller_constructor SEBELUM
// Track_online & Hak_akses_guard:
//   - Belum login / sesi habis + halaman bukan publik -> AJAX dapat 401 JSON, selain itu diarahkan ke halaman login.
//   - Sudah login -> respons diberi header no-store supaya tombol Back / tab yang dipulihkan browser tidak menampilkan
//     salinan halaman panel dari cache setelah logout atau sesi habis.
// Kalau menambah halaman yang memang harus bisa dibuka TANPA login, daftarkan di $publik di bawah.
class Login_guard
{
    // controller (huruf kecil) => '*' (semua method) atau daftar method yang boleh dibuka tanpa login
    private $publik = [
        'welcome'                => '*',
        'user'                   => '*', // login, konfirmasi email, pendaftaran
        'client'                 => '*', // login/logout klien
        'errorcontroller'        => '*', // 404_override
        'aspanel'                => ['logout'],
        // Link yang dibagikan ke klien / calon klien (diakses pakai id_session di URL)
        'crud_clients'           => ['c_lihat', 'c_concept'],
        'crud_client_tamu'       => ['pdf_klien'],
        'crud_potensial_clients' => ['view_penawaran', 'download_proposal'],
        'crud_vendor'            => ['view', 'generate_pdf'], // naskah/list_vendor
        'data_pengantin'         => '*',
        'izin_menikah'           => '*',
        'jubir_cpp'              => '*',
        'jubir_cpw'              => '*',
        'terima_kasih'           => '*',
        'terima_kasih2'          => '*',
    ];

    public function periksa()
    {
        if (is_cli()) {
            return;
        }

        $CI =& get_instance();
        $kelas  = strtolower(get_class($CI)); // bukan $CI->router->class: saat 404_override, router masih menyimpan kelas yang diminta

        $method = strtolower($CI->router->method);

        if (!empty($CI->session->userdata('id_session'))) {
            if (!headers_sent()) {
                header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
                header('Pragma: no-cache');
                header('Expires: 0');
            }
            return;
        }

        if ($this->is_publik($kelas, $method)) {
            return;
        }

        if ($CI->input->is_ajax_request()) {
            $CI->output->set_status_header(401)->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Sesi berakhir. Silakan login ulang.']))->_display();
            exit;
        }

        // Halaman milik klien (c_edit, c_update, ...) -> login klien; selain itu login staff
        $tujuan = ($kelas === 'crud_clients' && strpos($method, 'c_') === 0) ? 'client/login' : 'login';
        $CI->session->set_flashdata('msg', '<div class="mb-3 rounded bg-yellow-100 px-3 py-2 text-center text-sm text-yellow-800">Sesi Anda telah berakhir. Silakan login kembali.</div>');
        redirect(base_url($tujuan));
        exit;
    }

    private function is_publik($kelas, $method)
    {
        if (!isset($this->publik[$kelas])) {
            return false;
        }
        $izin = $this->publik[$kelas];
        return $izin === '*' || in_array($method, $izin, true);
    }
}
