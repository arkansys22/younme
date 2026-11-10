<?php
function cek_session_akses_developer($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '1'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_administrator($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '2'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_staff_accounting($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '3'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_staff_admin($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '4'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_staff_sales($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '9'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_affiliate_super($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '10'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_affiliate_promax($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '11'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_affiliate_vip($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '12'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_client($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '5'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_guest($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '6'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_staff($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '7'){
    redirect(base_url().'panel');
  }
}

function cek_session_akses_partner($id){
  $ci = & get_instance();
  $session = $ci->db->query("SELECT 1 FROM user WHERE id_session = ?", array($id))->num_rows();
  if ($session == '0' AND $ci->session->userdata('level') != '8'){
    redirect(base_url().'panel');
  }
}

function hari_ini($w){
    $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $hari_ini = $seminggu[$w];
    return $hari_ini;
}


function hari($date){

    $daftar_hari = array(
     'Sunday' => 'Minggu',
     'Monday' => 'Senin',
     'Tuesday' => 'Selasa',
     'Wednesday' => 'Rabu',
     'Thursday' => 'Kamis',
     'Friday' => 'Jumat',
     'Saturday' => 'Sabtu'
    );
    $namahari = $daftar_hari[date('l', strtotime($date))];

    return $namahari;
}

// Format tanggal gaya Indonesia lengkap dengan nama hari, mis. "Selasa, 8
// September 2026" -- dipakai buat tanggal acara di form/dokumen cetak.
// Beda dari tgl_indo() (yang formatnya "8 Sep 2026 00:00:00", cocok buat
// timestamp log activity, bukan tanggal acara).
function format_tanggal_acara($tanggal)
{
    if (empty($tanggal)) {
        return '-';
    }

    $bulan_lengkap = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    $timestamp = strtotime($tanggal);
    return hari($tanggal) . ', ' . date('j', $timestamp) . ' ' . $bulan_lengkap[(int) date('n', $timestamp)] . ' ' . date('Y', $timestamp);
}

function tgl_indo($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        $waktu = substr($tgl,11,8);
        return $tanggal.' '.$bulan.' '.$tahun.' '.$waktu;
}



function time_ago($datetime)
{
    $time = strtotime($datetime);
    $now  = time();
    $diff = $now - $time;

    if ($diff < 60) {
        return $diff . ' detik lalu';
    }

    $minutes = floor($diff / 60);
    if ($minutes < 60) {
        return $minutes . ' menit lalu';
    }

    $hours = floor($minutes / 60);
    if ($hours < 24) {
        return $hours . ' jam lalu';
    }

    $days = floor($hours / 24);
    if ($days < 30) {
        return $days . ' hari lalu';
    }

    $months = floor($days / 30);
    if ($months < 12) {
        return $months . ' bulan lalu';
    }

    $years = floor($months / 12);
    return $years . ' tahun lalu';
}

// Status online satu user, dipakai di halaman-halaman daftar user (user/index,
// recycle bin, dst). "Online" HANYA kalau `user_login_status` masih 'online'
// DAN `last_activity`-nya dalam $threshold_menit terakhir -- bukan cuma
// percaya ke `user_login_status` sendirian, karena kolom itu di-set 'online'
// sekali waktu login dan TIDAK otomatis balik ke 'offline' kalau user cuma
// nutup browser tanpa Logout (lihat User::logout() & hooks Track_online).
// Kalau tidak online, tampilkan kapan terakhir online (relatif, pakai
// time_ago()), atau "Belum pernah login" kalau last_activity masih kosong.
function status_online($user_login_status, $last_activity, $threshold_menit = 5)
{
    if (!empty($last_activity) && $user_login_status === 'online') {
        $selisih_menit = (time() - strtotime($last_activity)) / 60;
        if ($selisih_menit <= $threshold_menit) {
            return ['is_online' => true, 'label' => 'Online'];
        }
    }

    if (empty($last_activity)) {
        return ['is_online' => false, 'label' => 'Belum pernah login'];
    }

    return ['is_online' => false, 'label' => 'Terakhir online ' . time_ago($last_activity)];
}

// Daftar item ceklist default buat form serah terima vendor Dekorasi &
// Catering (lihat Crud_vendor_checklist) -- cuma titik awal, staff WO tetap
// bisa tambah/hapus/edit item pas ngisi form-nya sendiri.
function default_checklist_vendor($type)
{
    $templates = [
        'Dekorasi' => [
            'Backdrop pelaminan terpasang sesuai desain yang disepakati',
            'Rangkaian bunga & dekorasi lengkap',
            'Lighting/pencahayaan dekorasi berfungsi baik',
            'Meja & kursi tamu sudah tertata',
            'Photo booth / area foto sudah siap',
            'Karpet/red carpet terpasang rapi',
            'Area dekorasi bersih dari sisa material/sampah',
        ],
        'Catering' => [
            'Menu makanan sesuai pesanan',
            'Jumlah porsi sesuai jumlah tamu yang dipesan',
            'Meja prasmanan tertata rapi',
            'Peralatan makan (piring, sendok, gelas) lengkap',
            'Petugas catering/waiter hadir sesuai kesepakatan',
            'Makanan disajikan dalam kondisi hangat/segar',
            'Area catering bersih setelah acara selesai',
        ],
    ];

    return $templates[$type] ?? [];
}

function getBulan($bln){
            switch ($bln){
                case 1:
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Agustus";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "Oktober";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "Desember";
                    break;
            }
        }

function format_nominal_salary($nominal, $satuan)
{
    if ($satuan === 'Persentase') {
        $angka = rtrim(rtrim(number_format((float) $nominal, 2, ',', '.'), '0'), ',');
        return $angka . '%';
    }

    return 'Rp ' . number_format((float) $nominal, 0, ',', '.') . ' / ' . strtolower($satuan);
}

if (!function_exists('terbilang')) {
    function terbilang($angka, $isFinal = true) {
        $angka = abs($angka);
        $huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $temp = "";

        if ($angka < 12) {
            $temp = $huruf[$angka];
        } else if ($angka < 20) {
            $temp = $huruf[$angka - 10] . " belas";
        } else if ($angka < 100) {
            $temp = $huruf[floor($angka / 10)] . " puluh " . terbilang($angka % 10, false);
        } else if ($angka < 200) {
            $temp = "seratus " . terbilang($angka - 100, false);
        } else if ($angka < 1000) {
            $temp = $huruf[floor($angka / 100)] . " ratus " . terbilang($angka % 100, false);
        } else if ($angka < 2000) {
            $temp = "seribu " . terbilang($angka - 1000, false);
        } else if ($angka < 1000000) {
            $temp = terbilang(floor($angka / 1000), false) . " ribu " . terbilang($angka % 1000, false);
        } else if ($angka < 1000000000) {
            $temp = terbilang(floor($angka / 1000000), false) . " juta " . terbilang($angka % 1000000, false);
        } else if ($angka < 1000000000000) {
            $temp = terbilang(floor($angka / 1000000000), false) . " milyar " . terbilang(fmod($angka, 1000000000), false);
        } else if ($angka < 1000000000000000) {
            $temp = terbilang(floor($angka / 1000000000000), false) . " triliun " . terbilang(fmod($angka, 1000000000000), false);
        }

        // Append "rupiah" only for the final number
        if ($isFinal) {
            $temp .= " rupiah";
        }

        return ucfirst(strtolower(trim($temp)));
    }

    function get_location_from_ip($ip) {
      $urls = [
          "http://ip-api.com/json/{$ip}",
          "https://ipwhois.app/json/{$ip}",
          "http://ipinfo.io/{$ip}/json"
      ];

      $mh = curl_multi_init();
      $curl_handles = [];

      foreach ($urls as $url) {
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_TIMEOUT, 2);
          $curl_handles[] = $ch;
          curl_multi_add_handle($mh, $ch);
      }

      $running = null;
      do {
          curl_multi_exec($mh, $running);
          usleep(100);
      } while ($running > 0);

      $results = [];
      foreach ($curl_handles as $ch) {
          $results[] = json_decode(curl_multi_getcontent($ch), true);
          curl_multi_remove_handle($mh, $ch);
      }

      curl_multi_close($mh);

      $city = '';
      $country = '';

      foreach ($results as $response) {
          if (!empty($response['city']) && !empty($response['country'])) {
              $city = $response['city'];
              $country = $response['country'];
              break;
          }
      }

      return trim("{$city}, {$country}", ', ');
  }

/**
 * Daftar variabel yang bisa disisipkan ke "Nama Kegiatan" di Susunan Acara per klien
 * (clients/susunan-acara/...), format tokennya {{token}}. Dipakai untuk render tombol
 * pilihan variabel di form tambah/edit kegiatan -- lihat juga susunan_acara_variabel_values()
 * dan render_susunan_acara_text().
 */
function susunan_acara_variabel_list()
{
    return [
        // Data Mempelai
        ['group' => 'Data Mempelai', 'token' => 'cpw_nama',            'label' => 'Nama Lengkap CPW'],
        ['group' => 'Data Mempelai', 'token' => 'cpw_panggilan',       'label' => 'Nama Panggilan CPW'],
        ['group' => 'Data Mempelai', 'token' => 'cpw_bapak',           'label' => 'Nama Bapak CPW'],
        ['group' => 'Data Mempelai', 'token' => 'cpw_bapak_panggilan', 'label' => 'Panggilan Bapak CPW'],
        ['group' => 'Data Mempelai', 'token' => 'cpw_ibu',             'label' => 'Nama Ibu CPW'],
        ['group' => 'Data Mempelai', 'token' => 'cpw_ibu_panggilan',   'label' => 'Panggilan Ibu CPW'],
        ['group' => 'Data Mempelai', 'token' => 'cpp_nama',            'label' => 'Nama Lengkap CPP'],
        ['group' => 'Data Mempelai', 'token' => 'cpp_panggilan',       'label' => 'Nama Panggilan CPP'],
        ['group' => 'Data Mempelai', 'token' => 'cpp_bapak',           'label' => 'Nama Bapak CPP'],
        ['group' => 'Data Mempelai', 'token' => 'cpp_bapak_panggilan', 'label' => 'Panggilan Bapak CPP'],
        ['group' => 'Data Mempelai', 'token' => 'cpp_ibu',             'label' => 'Nama Ibu CPP'],
        ['group' => 'Data Mempelai', 'token' => 'cpp_ibu_panggilan',   'label' => 'Panggilan Ibu CPP'],

        // Acara
        ['group' => 'Acara', 'token' => 'nama_klien',         'label' => 'Nama Klien'],
        ['group' => 'Acara', 'token' => 'tanggal_pernikahan', 'label' => 'Tanggal Pernikahan'],
        ['group' => 'Acara', 'token' => 'lokasi_acara',       'label' => 'Lokasi Acara'],
        ['group' => 'Acara', 'token' => 'mahar',              'label' => 'Mahar'],
        ['group' => 'Acara', 'token' => 'seserahan',          'label' => 'Simbolis Seserahan'],
        ['group' => 'Acara', 'token' => 'izin_ke',            'label' => 'Permohonan Izin Dilakukan ke'],

        // Petugas & Koordinator (umum, dipakai di akad maupun resepsi/pemberkatan)
        ['group' => 'Petugas & Koordinator', 'token' => 'koordinator_wanita', 'label' => 'Koordinator Keluarga Wanita'],
        ['group' => 'Petugas & Koordinator', 'token' => 'koordinator_pria',   'label' => 'Koordinator Keluarga Pria'],
        ['group' => 'Petugas & Koordinator', 'token' => 'jubir_wanita',       'label' => 'Jubir Keluarga Wanita'],
        ['group' => 'Petugas & Koordinator', 'token' => 'jubir_pria',         'label' => 'Jubir Keluarga Pria'],
        ['group' => 'Petugas & Koordinator', 'token' => 'penghulu',           'label' => 'Penghulu'],
        ['group' => 'Petugas & Koordinator', 'token' => 'wali',               'label' => 'Wali'],
        ['group' => 'Petugas & Koordinator', 'token' => 'saksi_wanita',       'label' => 'Saksi Pengantin Wanita'],
        ['group' => 'Petugas & Koordinator', 'token' => 'saksi_pria',         'label' => 'Saksi Pengantin Pria'],
        ['group' => 'Petugas & Koordinator', 'token' => 'qori',               'label' => 'Qori/Qoriah'],
        ['group' => 'Petugas & Koordinator', 'token' => 'nasihat_pernikahan', 'label' => 'Nasihat Pernikahan'],
        ['group' => 'Petugas & Koordinator', 'token' => 'pengapit',           'label' => 'Pengapit Pengantin Wanita'],
        ['group' => 'Petugas & Koordinator', 'token' => 'pembawa_melati',     'label' => 'Pembawa Kalung Melati'],
        ['group' => 'Petugas & Koordinator', 'token' => 'pembawa_mahar',      'label' => 'Pembawa Mas Kawin/Mahar'],
        ['group' => 'Petugas & Koordinator', 'token' => 'pembawa_cincin',     'label' => 'Pembawa Cincin Kawin'],

        // Petugas & Koordinator (khusus Pemberkatan/non-Muslim)
        ['group' => 'Petugas & Koordinator (Pemberkatan)', 'token' => 'pendeta',              'label' => 'Pendeta'],
        ['group' => 'Petugas & Koordinator (Pemberkatan)', 'token' => 'gereja',                'label' => 'Gereja'],
        ['group' => 'Petugas & Koordinator (Pemberkatan)', 'token' => 'pemimpin_doa',          'label' => 'Pemimpin Doa'],
        ['group' => 'Petugas & Koordinator (Pemberkatan)', 'token' => 'sambutan_pernikahan',   'label' => 'Sambutan Pernikahan'],
    ];
}

/**
 * Nilai aktual tiap token untuk SATU klien. Untuk bapak/ibu, kalau kolom pengganti
 * (freplacementname/mreplacementname, dst) terisi -- artinya orang tuanya sudah tiada dan
 * diwakilkan orang lain -- dipakai nama pengganti itu, bukan nama aslinya. Ini nyamain
 * logika yang sudah ada di clients/edit.php (toggleReplacementFields).
 */
function susunan_acara_variabel_values($clients)
{
    $cpwBapakNama      = !empty($clients->f_bride_freplacementname) ? $clients->f_bride_freplacementname : ($clients->f_bride_fathername ?? '');
    $cpwBapakPanggilan = !empty($clients->f_bride_freplacementcname) ? $clients->f_bride_freplacementcname : ($clients->f_bride_fathercname ?? '');
    $cpwIbuNama        = !empty($clients->f_bride_mreplacementname) ? $clients->f_bride_mreplacementname : ($clients->f_bride_mothername ?? '');
    $cpwIbuPanggilan   = !empty($clients->f_bride_mreplacementcname) ? $clients->f_bride_mreplacementcname : ($clients->f_bride_mothercname ?? '');

    $cppBapakNama      = !empty($clients->m_bride_freplacementname) ? $clients->m_bride_freplacementname : ($clients->m_bride_fathername ?? '');
    $cppBapakPanggilan = !empty($clients->m_bride_freplacementcname) ? $clients->m_bride_freplacementcname : ($clients->m_bride_fathercname ?? '');
    $cppIbuNama        = !empty($clients->m_bride_mreplacementname) ? $clients->m_bride_mreplacementname : ($clients->m_bride_mothername ?? '');
    $cppIbuPanggilan   = !empty($clients->m_bride_mreplacementcname) ? $clients->m_bride_mreplacementcname : ($clients->m_bride_mothercname ?? '');

    return [
        'cpw_nama'            => $clients->f_bride_fname ?? '',
        'cpw_panggilan'       => $clients->f_bride_cname ?? '',
        'cpw_bapak'           => $cpwBapakNama,
        'cpw_bapak_panggilan' => $cpwBapakPanggilan,
        'cpw_ibu'             => $cpwIbuNama,
        'cpw_ibu_panggilan'   => $cpwIbuPanggilan,
        'cpp_nama'            => $clients->m_bride_fname ?? '',
        'cpp_panggilan'       => $clients->m_bride_cname ?? '',
        'cpp_bapak'           => $cppBapakNama,
        'cpp_bapak_panggilan' => $cppBapakPanggilan,
        'cpp_ibu'             => $cppIbuNama,
        'cpp_ibu_panggilan'   => $cppIbuPanggilan,
        'nama_klien'          => $clients->client_name ?? '',
        'tanggal_pernikahan'  => !empty($clients->wedding_date) ? trim(hari($clients->wedding_date) . ', ' . tgl_indo($clients->wedding_date)) : '',
        'lokasi_acara'        => $clients->location ?? '',
        'mahar'               => $clients->mahr ?? '',
        'seserahan'           => $clients->handover ?? '',
        'izin_ke'             => $clients->pmizin ?? '',

        'koordinator_wanita'  => $clients->female_coor ?? '',
        'koordinator_pria'    => $clients->male_coor ?? '',
        'jubir_wanita'        => $clients->f_spokesman ?? '',
        'jubir_pria'          => $clients->m_spokesman ?? '',
        'penghulu'            => $clients->wedding_officiant ?? '',
        'wali'                => $clients->guardian ?? '',
        'saksi_wanita'        => $clients->f_witness ?? '',
        'saksi_pria'          => $clients->m_witness ?? '',
        'qori'                => $clients->qori ?? '',
        'nasihat_pernikahan'  => $clients->advice_doa ?? '',
        'pengapit'            => $clients->clamp ?? '',
        'pembawa_melati'      => $clients->jasmine_carrier ?? '',
        'pembawa_mahar'       => $clients->mahr_carrier ?? '',
        'pembawa_cincin'      => $clients->ring_carrier ?? '',

        'pendeta'             => $clients->pastor ?? '',
        'gereja'              => $clients->church ?? '',
        'pemimpin_doa'        => $clients->prayer ?? '',
        'sambutan_pernikahan' => $clients->wedding_speech ?? '',
    ];
}

/**
 * Ganti semua token {{token}} di $text jadi nilai aktualnya untuk $clients. Dipakai HANYA
 * saat menampilkan (daftar kegiatan & mode presentasi) -- nama_kegiatan yang tersimpan di
 * DB tetap berupa template mentah (dengan token-nya), supaya tetap bisa diedit ulang.
 */
function render_susunan_acara_text($text, $clients)
{
    $values = susunan_acara_variabel_values($clients);

    $search = [];
    $replace = [];
    foreach ($values as $token => $value) {
        $search[] = '{{' . $token . '}}';
        $replace[] = $value;
    }

    return str_replace($search, $replace, $text);
}


// Teks satu item detail pembayaran Custom pada invoice. Item baru berbentuk
// ['nominal' => '5000000', 'teks' => '...'] (urutan menentukan "pertama",
// "kedua", dst); item lama berupa teks biasa. Hasilnya HTML yang sudah di-escape
// (teks custom ditebalkan), jadi langsung di-echo tanpa htmlspecialchars lagi.
if (!function_exists('format_detail_pembayaran_custom')) {
    function format_detail_pembayaran_custom($item, $index) {
        if (!is_array($item)) {
            return htmlspecialchars((string) $item);
        }
        $urutan = ['pertama', 'kedua', 'ketiga', 'keempat', 'kelima', 'keenam', 'ketujuh', 'kedelapan', 'kesembilan', 'kesepuluh'];
        $nomor = $urutan[$index] ?? ('ke-' . ($index + 1));
        $teks = 'Pembayaran ' . $nomor;
        if (trim($item['teks'] ?? '') !== '') {
            $teks .= ' <b>' . htmlspecialchars(trim($item['teks'])) . '</b>';
        }
        if (($item['nominal'] ?? '') !== '') {
            $teks .= ' sebesar Rp ' . number_format((int) $item['nominal'], 0, ',', '.');
        }
        return $teks;
    }
}

// Waktu agenda (kolom *_waktu di tabel agenda) untuk ditampilkan di samping tanggal,
// mis. " • 10.00 WIB". Kosong kalau waktunya belum diisi.
if (!function_exists('format_waktu_agenda')) {
    function format_waktu_agenda($waktu) {
        $waktu = trim((string) $waktu);
        if ($waktu === '') {
            return '';
        }
        $ts = strtotime($waktu);
        return $ts === false ? '' : ' &bull; ' . date('H.i', $ts) . ' WIB';
    }
}

// Lokasi agenda (kolom *_lokasi & *_lokasi_url) sebagai HTML ter-escape: nama lokasi yang
// bisa diklik kalau ada URL (hanya http/https). Kosong kalau keduanya kosong.
if (!function_exists('format_lokasi_agenda')) {
    function format_lokasi_agenda($nama, $url) {
        $nama = trim((string) $nama);
        $url = trim((string) $url);
        if (!preg_match('#^https?://#i', $url)) {
            $url = '';
        }
        if ($nama === '' && $url === '') {
            return '';
        }
        if ($url === '') {
            return htmlspecialchars($nama);
        }
        $label = $nama !== '' ? $nama : 'Lihat lokasi';
        return '<a href="' . htmlspecialchars($url) . '" target="_blank" rel="noopener" class="text-primary underline">' . htmlspecialchars($label) . '</a>';
    }
}

// Tanggal agenda dianggap terisi kalau tidak kosong dan bukan "0000-00-00" (nilai yang
// tersimpan kalau input tanggal dikosongkan di Edit Agenda).
if (!function_exists('agenda_tanggal_terisi')) {
    function agenda_tanggal_terisi($tanggal) {
        $tanggal = trim((string) $tanggal);
        return $tanggal !== '' && strpos($tanggal, '0000-00-00') !== 0;
    }
}

// URL lokasi agenda yang aman dipakai di href: hanya http/https, selain itu string kosong.
if (!function_exists('url_lokasi_valid')) {
    function url_lokasi_valid($url) {
        $url = trim((string) $url);
        return preg_match('#^https?://#i', $url) ? $url : '';
    }
}

// Jadwal pembayaran metode "Default" pada invoice: daftar baris pembayaran pertama sampai terakhir,
// tiap baris ['teks' => HTML tanpa nominal, 'nominal' => int]. Jumlah baris tergantung sisa hari ke
// tanggal acara (<30 hari: 2 baris, <60 hari: 4 baris, selain itu 5 baris). Dipakai view_invoice
// dan form tambah/edit invoice.
if (!function_exists('jadwal_pembayaran_default')) {
    function jadwal_pembayaran_default($total, $event_date) {
        $event = new DateTime($event_date);
        $hari = (new DateTime())->diff($event)->days;

        $p1 = 1000000;
        $sisa = max(0, $total - $p1);
        $b = (clone $event)->modify('-60 days');
        $c = (clone $event)->modify('-30 days');
        $d = (clone $event)->modify('-14 days');

        $baris = [['teks' => 'Pembayaran pertama <b>kunci harga</b>', 'nominal' => $p1]];
        if ($hari < 30) {
            $baris[] = ['teks' => 'Pembayaran kedua <b>pelunasan</b>', 'nominal' => (int) round($sisa)];
        } elseif ($hari < 60) {
            $baris[] = ['teks' => 'Pembayaran kedua <b>kunci tanggal</b> sebesar 15% dari total biaya pada H+14 setelah pembayaran pertama', 'nominal' => (int) round($sisa * 0.15)];
            $baris[] = ['teks' => 'Pembayaran ketiga sebesar 45% dari total biaya pada <b>H-30 acara (' . tgl_indo($c->format('Y-m-d')) . ')</b>', 'nominal' => (int) round($sisa * 0.45)];
            $baris[] = ['teks' => 'Pembayaran keempat sebesar 40% dari total biaya pada <b>H-14 acara (' . tgl_indo($d->format('Y-m-d')) . ')</b>', 'nominal' => (int) round($sisa * 0.40)];
        } else {
            $baris[] = ['teks' => 'Pembayaran kedua <b>kunci tanggal</b> sebesar 15% dari total biaya pada H+14 setelah pembayaran pertama', 'nominal' => (int) round($sisa * 0.15)];
            $baris[] = ['teks' => 'Pembayaran ketiga sebesar 35% dari total biaya pada <b>H-60 acara (' . tgl_indo($b->format('Y-m-d')) . ')</b>', 'nominal' => (int) round($sisa * 0.35)];
            $baris[] = ['teks' => 'Pembayaran keempat sebesar 35% dari total biaya pada <b>H-30 acara (' . tgl_indo($c->format('Y-m-d')) . ')</b>', 'nominal' => (int) round($sisa * 0.35)];
            $baris[] = ['teks' => 'Pembayaran kelima sebesar 15% dari total biaya pada <b>H-14 acara (' . tgl_indo($d->format('Y-m-d')) . ')</b>', 'nominal' => (int) round($sisa * 0.15)];
        }
        return $baris;
    }
}

// Teks/nominal yang diubah manual untuk metode Default disimpan di payment.detail sebagai
// {"default": [{"teks":"","nominal":""}, {"teks":"teks baru","nominal":"5000000"}, ...], "jumlah": N};
// "" = pakai hitungan otomatis. (Bentuk lama: item berupa string = pengganti satu baris penuh.)
// Hanya dipakai kalau "jumlah" sama dengan jumlah baris jadwal saat ini (jadwal bisa berubah
// seiring mendekatnya tanggal acara).
if (!function_exists('override_pembayaran_default')) {
    function override_pembayaran_default($detail_json, $jumlah_baris) {
        $d = json_decode((string) $detail_json, true);
        if (is_array($d) && isset($d['default'], $d['jumlah']) && is_array($d['default']) && (int) $d['jumlah'] === (int) $jumlah_baris) {
            return array_values($d['default']);
        }
        return [];
    }
}

// HTML satu baris jadwal Default untuk invoice: teks + " Rp nominal", dengan override manual.
if (!function_exists('format_baris_pembayaran_default')) {
    function format_baris_pembayaran_default($baris, $override) {
        if (is_string($override)) { // bentuk lama: pengganti satu baris penuh
            return trim($override) !== '' ? htmlspecialchars(trim($override)) : null;
        }
        $teks = is_array($override) && trim((string) ($override['teks'] ?? '')) !== ''
            ? htmlspecialchars(trim($override['teks'])) : $baris['teks'];
        $nominal = is_array($override) && preg_replace('/\D/', '', (string) ($override['nominal'] ?? '')) !== ''
            ? (int) preg_replace('/\D/', '', $override['nominal']) : (int) $baris['nominal'];
        return $teks . ' Rp ' . number_format($nominal, 0, ',', '.');
    }
}
// Tanggal pembayaran per urutan pembayaran pada sebuah invoice, diambil dari kwitansi yang
// sudah dibayar: baris payment berstatus 'Paid' dengan metodep "Pembayaran <Kesatu|Kedua|...> <Nama>"
// yang dariinvoice-nya = invoice ini. Kwitansi lama yang dariinvoice-nya kosong ikut dihitung
// kalau project itu hanya punya SATU invoice (tidak ambigu). Hasil: [urutan (1,2,..) => [tanggal, ...]].
if (!function_exists('tanggal_bayar_per_pembayaran')) {
    function tanggal_bayar_per_pembayaran($payment_id_session, $id_session) {
        $urutan = ['kesatu' => 1, 'kedua' => 2, 'ketiga' => 3, 'keempat' => 4, 'kelima' => 5,
                   'keenam' => 6, 'ketujuh' => 7, 'kedelapan' => 8];
        $CI =& get_instance();

        $jumlah_invoice = $CI->db->where('id_session', $id_session)
            ->where_in('metodep', ['Default', 'Custom'])
            ->count_all_results('payment');

        $CI->db->select('metodep, date')->where('status', 'Paid')->where('id_session', $id_session);
        if ($jumlah_invoice === 1) {
            $CI->db->group_start()
                ->where('dariinvoice', $payment_id_session)
                ->or_where('dariinvoice', '')
                ->or_where('dariinvoice IS NULL', null, false)
                ->group_end();
        } else {
            $CI->db->where('dariinvoice', $payment_id_session);
        }
        $rows = $CI->db->order_by('date', 'asc')->get('payment')->result();

        $hasil = [];
        foreach ($rows as $r) {
            if (preg_match('/^Pembayaran\s+(\S+)/i', (string) $r->metodep, $m) && isset($urutan[strtolower($m[1])])
                && !empty($r->date) && strpos($r->date, '0000-00-00') !== 0) {
                $hasil[$urutan[strtolower($m[1])]][] = $r->date;
            }
        }
        return $hasil;
    }
}
// " — Dibayar 17 April 2026" untuk di belakang baris pembayaran; kosong kalau belum dibayar.
if (!function_exists('format_tanggal_dibayar')) {
    function format_tanggal_dibayar($tanggal_list) {
        if (empty($tanggal_list)) {
            return '';
        }
        $teks = [];
        foreach (array_unique($tanggal_list) as $t) {
            $teks[] = trim(tgl_indo($t));
        }
        return ' <span style="color:#16a34a;font-weight:600;">&mdash; Dibayar pada ' . htmlspecialchars(implode(', ', $teks)) . '</span>';
    }
}

// Grand total sebuah invoice dari item proposalnya (sama dengan hitungan di view_invoice):
// subtotal (harga promo jika ada x qty) dikurangi promo (custom = nilai promo, default = total
// diskon item, tidak = 0). Kalau invoice tidak punya item (mis. "Penambahan"), dipakai $fallback.
if (!function_exists('grand_total_invoice')) {
    function grand_total_invoice($potensial_id_session, $fallback = 0) {
        $CI =& get_instance();
        $items = $CI->db->get_where('penawaran_klien', ['penawaran_klien_potensial_idsession' => $potensial_id_session])->result();
        $sub = 0;
        $diskonItem = 0;
        foreach ($items as $p) {
            $harga = (float) str_replace('.', '', $p->penawaran_klien_harga);
            $hargaPromo = (float) str_replace('.', '', $p->penawaran_klien_hargapromo);
            $hargaFinal = ($hargaPromo > 0) ? $hargaPromo : $harga;
            $sub += $hargaFinal * (float) $p->penawaran_klien_qty;
            $diskonItem += (float) str_replace('.', '', $p->penawaran_klien_diskon);
        }
        $pc = $CI->db->get_where('potensial_clients', ['id_session' => $potensial_id_session])->row();
        $promo = 0;
        if ($pc && ($pc->promo ?? 'tidak') == 'custom') {
            $promo = (float) str_replace('.', '', $pc->promo_value ?? 0);
        } elseif ($pc && ($pc->promo ?? 'tidak') == 'default') {
            $promo = $diskonItem;
        }
        $grand = $sub - $promo;
        return $grand > 0 ? (int) round($grand) : (int) $fallback;
    }
}

// Pembayaran TAMBAHAN pada metode Default (tombol "+ Tambah Pembayaran"): disimpan di payment.detail
// pada kunci "tambahan" = [{"teks":"...","nominal":"5000000"}, ...]. Nomornya melanjutkan jadwal otomatis
// (jadwal 4 baris -> tambahan pertama = pembayaran kelima).
if (!function_exists('tambahan_pembayaran_default')) {
    function tambahan_pembayaran_default($detail_json) {
        $d = json_decode((string) $detail_json, true);
        $hasil = [];
        if (is_array($d) && isset($d['tambahan']) && is_array($d['tambahan'])) {
            foreach ($d['tambahan'] as $t) {
                if (is_array($t)) {
                    $hasil[] = ['teks' => trim((string) ($t['teks'] ?? '')), 'nominal' => (int) preg_replace('/\D/', '', (string) ($t['nominal'] ?? ''))];
                }
            }
        }
        return $hasil;
    }
}

if (!function_exists('kata_urutan_pembayaran')) {
    function kata_urutan_pembayaran($nomor) { // 1 => pertama
        $kata = ['pertama', 'kedua', 'ketiga', 'keempat', 'kelima', 'keenam', 'ketujuh', 'kedelapan', 'kesembilan', 'kesepuluh'];
        return $kata[$nomor - 1] ?? ('ke-' . $nomor);
    }
}

// HTML satu baris pembayaran tambahan: "Pembayaran keenam <teks> Rp nominal".
if (!function_exists('format_tambahan_pembayaran_default')) {
    function format_tambahan_pembayaran_default($item, $nomor) {
        $teks = trim((string) $item['teks']);
        return 'Pembayaran ' . kata_urutan_pembayaran($nomor) . ($teks !== '' ? ' ' . htmlspecialchars($teks) : '')
            . ' Rp ' . number_format((int) $item['nominal'], 0, ',', '.');
    }
}

// Urutan pembayaran (1 = Kesatu, 2 = Kedua, ...) yang SUDAH dibayar lewat kwitansi berstatus Paid di
// sebuah project; dipakai untuk menyembunyikan pilihan "Pembayaran ke" di form kwitansi.
// $dariinvoice: batasi ke kwitansi milik invoice itu. Tanpa $dariinvoice, project yang punya lebih dari
// satu invoice dianggap ambigu -> kosong (disaring per invoice setelah invoice dipilih).
// $kecuali_id: id baris payment yang diabaikan (kwitansi yang sedang diedit).
if (!function_exists('urutan_pembayaran_dibayar')) {
    function urutan_pembayaran_dibayar($id_session, $dariinvoice = '', $kecuali_id = null) {
        $urutan = ['kesatu' => 1, 'kedua' => 2, 'ketiga' => 3, 'keempat' => 4, 'kelima' => 5,
                   'keenam' => 6, 'ketujuh' => 7, 'kedelapan' => 8];
        $CI =& get_instance();
        $jumlah_invoice = $CI->db->where('id_session', $id_session)->where_in('metodep', ['Default', 'Custom'])->count_all_results('payment');

        $CI->db->select('metodep, dariinvoice')->where('id_session', $id_session)->where('status', 'Paid')->like('metodep', 'Pembayaran ', 'after');
        if ($kecuali_id) {
            $CI->db->where('id <>', (int) $kecuali_id);
        }
        $rows = $CI->db->get('payment')->result();

        if ($dariinvoice === '' && $jumlah_invoice > 1) {
            return [];
        }
        $hasil = [];
        foreach ($rows as $r) {
            if ($dariinvoice !== '' && $r->dariinvoice !== $dariinvoice && !($jumlah_invoice <= 1 && (string) $r->dariinvoice === '')) {
                continue;
            }
            if (preg_match('/^Pembayaran\s+(\S+)/i', (string) $r->metodep, $m) && isset($urutan[strtolower($m[1])])) {
                $hasil[$urutan[strtolower($m[1])]] = true;
            }
        }
        return array_keys($hasil);
    }
}

// ===== Pengaturan umum website (tabel identitas, diatur di menu "Pengaturan Website") =====

// Nilai satu kolom pengaturan website (nama_website, whatsapp, url, logo, mini_logo, favicon, ...);
// tanpa argumen mengembalikan seluruh baris. Dibaca sekali per request.
if (!function_exists('pengaturan_website')) {
    function pengaturan_website($kolom = '', $default = '') {
        static $baris = null;
        if ($baris === null) {
            $CI =& get_instance();
            // Query mentah, BUKAN query builder: helper ini sering dipanggil di tengah penyusunan query lain
            // (mis. sql_like_kode() sebagai argumen where()), dan get_where() akan ikut memakai & menghabiskan
            // select/where yang sedang disusun di builder yang sama.
            $baris = $CI->db->table_exists('identitas')
                ? $CI->db->query('SELECT * FROM identitas WHERE id_identitas = 1')->row()
                : false;
        }
        if ($kolom === '') {
            return $baris ?: null;
        }
        $nilai = $baris ? trim((string) ($baris->$kolom ?? '')) : '';
        return $nilai !== '' ? $nilai : $default;
    }
}

// URL gambar hasil upload ("pengaturan/xxx.png" -> assets/uploads/...), atau gambar bawaan kalau
// belum diupload / filenya hilang. Nilai lama di kolom (tanpa awalan "pengaturan/") diabaikan.
if (!function_exists('url_gambar_pengaturan')) {
    function url_gambar_pengaturan($kolom, $bawaan) {
        $nilai = pengaturan_website($kolom);
        if ($nilai !== '' && strpos($nilai, 'pengaturan/') === 0 && strpos($nilai, '..') === false
            && is_file(FCPATH . 'assets/uploads/' . $nilai)) {
            return base_url('assets/uploads/' . $nilai);
        }
        return base_url($bawaan);
    }
}

if (!function_exists('favicon_url')) {
    function favicon_url() { return url_gambar_pengaturan('favicon', 'assets/backend/favicon.ico'); }
}
if (!function_exists('logo_login_url')) {      // halaman login (latar terang)
    function logo_login_url() { return url_gambar_pengaturan('logo', 'assets/backend/logo-default.png'); }
}
// Logo sidebar & header (latar gelap): Logo Sidebar upload; kalau belum ada tapi Logo (halaman login) sudah
// diupload, logo itu dipakai (lihat logo_sidebar_gaya()); kalau tidak keduanya, logo bawaan netral (logo-default-putih.png).
if (!function_exists('logo_sidebar_url')) {
    function logo_sidebar_url() {
        if (!logo_sidebar_pakai_logo_login()) {
            return url_gambar_pengaturan('mini_logo', 'assets/backend/logo-default-putih.png');
        }
        return url_gambar_pengaturan('logo', 'assets/backend/logo-default-putih.png');
    }
}
if (!function_exists('logo_sidebar_pakai_logo_login')) {
    function logo_sidebar_pakai_logo_login() {
        $cek = function ($kolom) {
            $v = pengaturan_website($kolom);
            return strpos($v, 'pengaturan/') === 0 && strpos($v, '..') === false && is_file(FCPATH . 'assets/uploads/' . $v);
        };
        return !$cek('mini_logo') && $cek('logo');
    }
}
// Gaya tambahan untuk <img> logo sidebar: logo login (latar terang) diberi alas putih agar terbaca di sidebar gelap.
if (!function_exists('logo_sidebar_gaya')) {
    function logo_sidebar_gaya() {
        return logo_sidebar_pakai_logo_login() ? ' background:#fff; padding:6px 10px; border-radius:8px; box-sizing:border-box; object-fit:contain;' : '';
    }
}
if (!function_exists('nama_website')) {
    function nama_website() { return pengaturan_website('nama_website', 'Younme'); }
}

// Daftar nomor rekening perusahaan (Pengaturan Website); array kosong kalau belum ada / tabel belum dimigrasi.
if (!function_exists('daftar_rekening')) {
    function daftar_rekening() {
        static $daftar = null;
        if ($daftar === null) {
            $CI =& get_instance();
            $daftar = $CI->db->table_exists('rekening_website')
                ? $CI->db->order_by('urutan', 'asc')->order_by('id', 'asc')->get('rekening_website')->result()
                : [];
        }
        return $daftar;
    }
}

// ===== Kode awal nomor transaksi: invoice (bawaan IMB) & kwitansi (bawaan MBP) =====
// Bisa diubah di Pengaturan Website. Dokumen lama tetap memakai kode lama, jadi pengenalan jenis
// transaksi (invoice / kwitansi) selalu memakai SEMUA kode yang pernah dipakai (bawaan + riwayat + sekarang).

if (!function_exists('kode_invoice')) {
    function kode_invoice() { return pengaturan_website('kode_invoice', 'IMB'); }
}
if (!function_exists('kode_kwitansi')) {
    function kode_kwitansi() { return pengaturan_website('kode_kwitansi', 'MBP'); }
}

// Semua kode yang dikenali: kode sekarang + bawaan + riwayat kode lama (unik, kode sekarang di depan).
if (!function_exists('semua_kode_transaksi')) {
    function semua_kode_transaksi($jenis) { // 'invoice' | 'kwitansi'
        $sekarang = $jenis === 'invoice' ? kode_invoice() : kode_kwitansi();
        $bawaan = $jenis === 'invoice' ? 'IMB' : 'MBP';
        $riwayat = array_filter(array_map('trim', explode(',', pengaturan_website('kode_' . $jenis . '_riwayat', ''))));
        return array_values(array_unique(array_merge([$sekarang, $bawaan], $riwayat)));
    }
}

if (!function_exists('adalah_transaksi_invoice')) {
    function adalah_transaksi_invoice($transactions_id) {
        foreach (semua_kode_transaksi('invoice') as $k) {
            if (strpos((string) $transactions_id, $k) === 0) { return true; }
        }
        return false;
    }
}
if (!function_exists('adalah_transaksi_kwitansi')) {
    function adalah_transaksi_kwitansi($transactions_id) {
        foreach (semua_kode_transaksi('kwitansi') as $k) {
            if (strpos((string) $transactions_id, $k) === 0) { return true; }
        }
        return false;
    }
}

// Potongan SQL "(kolom LIKE 'awal<KODE>%' OR ...)" untuk semua kode sebuah jenis transaksi;
// dipakai di query builder: ->where(sql_like_kode('payment_id_session', $id_session, 'invoice'), null, false)
if (!function_exists('sql_like_kode')) {
    function sql_like_kode($kolom, $awal, $jenis) {
        $CI =& get_instance();
        $bagian = [];
        foreach (semua_kode_transaksi($jenis) as $k) {
            $bagian[] = $kolom . " LIKE '" . $CI->db->escape_like_str($awal . $k) . "%' ESCAPE '!'";
        }
        return '(' . implode(' OR ', $bagian) . ')';
    }
}

// Alamat website untuk ditampilkan: tanpa "https://" dan tanpa "/" di akhir. Kosong kalau tidak ada.
if (!function_exists('tampil_url_website')) {
    function tampil_url_website($url) {
        $url = trim((string) $url);
        return $url === '' ? '' : rtrim(preg_replace('#^https?://#i', '', $url), '/');
    }
}

// "@username" dari link/handle sosial media (mis. https://www.instagram.com/contoh/ -> @contoh).
if (!function_exists('handle_sosmed')) {
    function handle_sosmed($url) {
        $url = trim((string) $url);
        if ($url === '') {
            return '';
        }
        $path = trim((string) parse_url(preg_match('#^https?://#i', $url) ? $url : 'https://' . $url, PHP_URL_PATH), '/');
        $user = $path === '' ? '' : ltrim(basename($path), '@');
        return $user === '' ? tampil_url_website($url) : '@' . $user;
    }
}

// Blok identitas perusahaan untuk dokumen (invoice dll): baris-baris teks dari Pengaturan Website
// (alamat, nomor WhatsApp, alamat website, Instagram, TikTok). Isian yang kosong dilewati.
// Mengembalikan array baris yang SUDAH di-escape.
if (!function_exists('baris_identitas_perusahaan')) {
    function baris_identitas_perusahaan() {
        $baris = [];
        foreach (preg_split('/\r\n|\r|\n/', (string) pengaturan_website('alamat')) as $a) {
            if (trim($a) !== '') {
                $baris[] = htmlspecialchars(trim($a));
            }
        }
        if (teks_whatsapp() !== '') {
            $baris[] = teks_whatsapp(' / ');
        }
        if (pengaturan_website('url') !== '') {
            $baris[] = htmlspecialchars(tampil_url_website(pengaturan_website('url')));
        }
        if (pengaturan_website('instagram') !== '') {
            $baris[] = 'Instagram: ' . htmlspecialchars(handle_sosmed(pengaturan_website('instagram')));
        }
        if (pengaturan_website('tiktok') !== '') {
            $baris[] = 'TikTok: ' . htmlspecialchars(handle_sosmed(pengaturan_website('tiktok')));
        }
        return $baris;
    }
}

// Baris alamat (dari Pengaturan Website, satu baris per baris teks), sudah di-escape.
if (!function_exists('baris_alamat_perusahaan')) {
    function baris_alamat_perusahaan() {
        $hasil = [];
        foreach (preg_split('/\r\n|\r|\n/', (string) pengaturan_website('alamat')) as $a) {
            if (trim($a) !== '') {
                $hasil[] = htmlspecialchars(trim($a));
            }
        }
        return $hasil;
    }
}

// Nomor WhatsApp dari Pengaturan Website: bisa lebih dari satu (satu per baris di kolom identitas.whatsapp;
// pemisah lama koma / titik koma / "|" juga dikenali). Mengembalikan array nomor (unik, tanpa yang kosong).
if (!function_exists('daftar_whatsapp')) {
    function daftar_whatsapp() {
        $nomor = [];
        foreach (preg_split('/[\r\n,;|]+/', (string) pengaturan_website('whatsapp')) as $n) {
            $n = trim($n);
            if ($n !== '') {
                $nomor[$n] = $n;
            }
        }
        return array_values($nomor);
    }
}

// Semua nomor WhatsApp dalam satu teks (sudah di-escape), dipisah $pemisah. Kosong kalau tidak ada.
if (!function_exists('teks_whatsapp')) {
    function teks_whatsapp($pemisah = ' / ') {
        return implode($pemisah, array_map('htmlspecialchars', daftar_whatsapp()));
    }
}

// Pegawai/penerima yang dikaitkan ke transaksi Operational Finance (kolom operational_acc.staff_id_session):
// 6201.01 (Biaya Gaji, Lembur & THR) -> Staff; 6100.02 (Biaya komisi) -> Penerima Komisi; kategori lain -> null.
if (!function_exists('staff_id_transaksi_operasional')) {
    function staff_id_transaksi_operasional($kategori, $staff, $komisi) {
        if ($kategori === '6201.01' && !empty($staff)) {
            return $staff;
        }
        if ($kategori === '6100.02' && !empty($komisi)) {
            return $komisi;
        }
        return null;
    }
}

// ===== Halaman awal (homepage / welcome) dari Pengaturan Website =====

// Latar halaman awal versi desktop; bawaan assets/backend/welcome.png.
if (!function_exists('bg_beranda_url')) {
    function bg_beranda_url() { return url_gambar_pengaturan('bg_beranda', 'assets/backend/welcome.png'); }
}

// Latar versi HP; kalau belum diupload memakai latar desktop yang sudah diupload, lalu bawaan welcomehp.png.
if (!function_exists('bg_beranda_hp_url')) {
    function bg_beranda_hp_url() {
        foreach (['bg_beranda_hp', 'bg_beranda'] as $kolom) {
            $nilai = pengaturan_website($kolom);
            if (strpos($nilai, 'pengaturan/') === 0 && strpos($nilai, '..') === false && is_file(FCPATH . 'assets/uploads/' . $nilai)) {
                return base_url('assets/uploads/' . $nilai);
            }
        }
        return base_url('assets/backend/welcomehp.png');
    }
}

// Latar halaman login (staff & client): gambar upload, atau gambar bawaan masing-masing halaman ($bawaan).
if (!function_exists('bg_login_url')) {
    function bg_login_url($bawaan) { return url_gambar_pengaturan('bg_login', $bawaan); }
}

// Teks footer homepage & halaman login (sudah di-escape). Kosong di pengaturan -> "Copyright © <tahun ini> <nama website>".
// {tahun} di teks buatan sendiri diganti tahun berjalan.
if (!function_exists('teks_footer_beranda')) {
    function teks_footer_beranda() {
        $teks = pengaturan_website('teks_footer');
        if ($teks === '') {
            $teks = 'Copyright © {tahun} ' . nama_website();
        }
        return htmlspecialchars(str_replace('{tahun}', date('Y'), $teks));
    }
}

// Nomor WhatsApp untuk tombol "Chat Admin": nomor pertama di Pengaturan Website, format internasional
// tanpa tanda (08xx -> 628xx). Kosong kalau belum diisi.
if (!function_exists('nomor_wa_chat_admin')) {
    function nomor_wa_chat_admin() {
        $semua = daftar_whatsapp();
        // "+62 (0)812.." -> buang nol dalam kurung (nol awal setelah kode negara)
        $angka = $semua ? preg_replace('/\D+/', '', preg_replace('/\(\s*0\s*\)/', '', $semua[0])) : '';
        if ($angka === '') {
            return '';
        }
        if (strpos($angka, '00') === 0) {
            $angka = substr($angka, 2);
        }
        if (strpos($angka, '0') === 0) {
            $angka = '62' . substr($angka, 1);
        } elseif (strpos($angka, '62') !== 0) {
            $angka = '62' . $angka; // ditulis tanpa 0 / kode negara (mis. 812...)
        }
        return $angka;
    }
}

// ===== Hak Akses per Level (lihat config/hak_akses.php, Hak_akses_model, hooks/Hak_akses_guard.php) =====

// Menu yang boleh dilihat user yang sedang login: null = tidak dibatasi (level belum diatur / Developer),
// array menu_key = hanya menu itu.
if (!function_exists('menu_diizinkan')) {
    function menu_diizinkan() {
        $CI =& get_instance();
        $id_session = $CI->session->userdata('id_session');
        if (empty($id_session)) {
            return null;
        }
        $debug = $CI->db->db_debug;
        $CI->db->db_debug = false;
        $CI->load->model('Hak_akses_model');
        $menu = $CI->Hak_akses_model->menu_level($CI->session->userdata('level_asli') ?: $CI->session->userdata('level'));
        $CI->db->db_debug = $debug;
        return $menu;
    }
}

// Level akun yang sebenarnya (bukan level efektif sementara dari Hak Akses, lihat libraries/Session/MY_Session.php)
if (!function_exists('level_akun')) {
    function level_akun() {
        $CI =& get_instance();
        return method_exists($CI->session, 'level_nyata') ? $CI->session->level_nyata() : (string) $CI->session->userdata('level');
    }
}

// Syarat level untuk sebuah grup sidebar: level yang sudah diatur Hak Akses selalu lolos (isi grup disaring per menu lewat
// izin_menu()); level yang belum diatur memakai syarat level bawaan.
if (!function_exists('sidebar_level_ok')) {
    function sidebar_level_ok(array $levels) {
        return menu_diizinkan() !== null || in_array((string) level_akun(), $levels, true);
    }
}

// Apakah menu $key boleh ditampilkan di sidebar untuk user ini?
if (!function_exists('izin_menu')) {
    function izin_menu($key) {
        $menu = menu_diizinkan();
        return $menu === null || in_array($key, $menu, true);
    }
}

// Salah satu dari beberapa menu boleh (untuk grup menu berisi sub-menu).
if (!function_exists('izin_menu_salah_satu')) {
    function izin_menu_salah_satu(array $keys) {
        $menu = menu_diizinkan();
        return $menu === null || count(array_intersect($keys, $menu)) > 0;
    }
}
}
