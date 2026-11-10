<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Aspanel extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Potensial_model');
		$this->load->model('Clients_model');
		$this->load->model('project_model');
		$this->load->model('Payment_model');
		$this->load->model('finance_project_model');
		$this->load->model('Gaji_model');
		$this->load->model('Agenda_model');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
		{
		redirect(base_url('login'));
		}
	public function home($view = null)
	{
			if (!$this->session->userdata('crews_idsession')) {
				$user = $this->db->get_where('user', ['id_session' => $this->session->userdata('id_session')])->row();
				if ($user && isset($user->crews_idsession)) {
					$this->session->set_userdata('crews_idsession', $user->crews_idsession);
				}
			}

			$user = $this->db->get_where('user', ['id_session' => $this->session->userdata('id_session')])->row();
			$level = $this->session->userdata('level');
			$data['tampilkan_button_event'] = false;

			// Kartu pendapatan crew (partial_pendapatan_crew): dashboard Developer (1), Administrator (2), Staff Admin (4),
			// Staff/Freelance (7), Staff Sales (9), dan tampilan panel/staff milik level lain. Staff Accounting (3) memakai
			// v_home yang sama tapi tidak dihitung, jadi partial-nya tidak tampil.
			if (in_array($level, ['1', '2', '4', '7', '9'], true) || $view === 'staff') {
				$data['pendapatan_crew'] = $this->Gaji_model->get_ringkasan_pendapatan_crew($this->session->userdata('id_session'));
			}

			if ($user && in_array($level, ['1', '2', '3', '4','9'])) {
				if (!empty($user->crews_idsession) && $user->crews_idsession !== '-') {
					$data['tampilkan_button_event'] = true;
				}
			}

			if ($this->session->level == '1') {
				cek_session_akses_developer('panel', $this->session->id_session);
				$month_now = date('Y-m');
				$month_last = date('Y-m', strtotime('last month'));
				$data['client_tahun_ini'] = $this->Clients_model->get_clients_by_year(date('Y'));  // Client tahun ini
				$data['client_tahun_lalu'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('last year'))); // Client tahun lalu
				$data['client_tahun_depan'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('next year'))); // Client tahun depan
				$data['total_client'] = $this->Clients_model->get_total_clients(); // Total client
				$data['top_sales_ranking'] = $this->get_top_sales_ranking($month_now); // Top 5 pencapaian sales bulan ini

				
				// Revenue bulan ini
				$data['revenue_bulan_ini'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_now)
					->get('payment')
					->row();

				// Revenue bulan lalu
				$data['revenue_bulan_lalu'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_last)
					->get('payment')
					->row();

				// Total revenue all
				$data['total_revenue_all'] = $this->db->select_sum('total_paid')
					->get('payment')
					->row();


				// Estimasi Revenue bulan ini
				$data['estimasi_revenue_bulan_ini'] = $this->getEstimasiRevenue();

				// Revenue bulan lalu
				$data['revenue_bulan_lalu'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_last)
					->get('payment')
					->row();

				// Total revenue all
				$data['total_revenue_all'] = $this->db->select_sum('total_bill')
					->get('payment')
					->row();

				// Hitung persentase perubahan revenue
				$data['percent_change'] = null;
				if ($data['revenue_bulan_ini'] && $data['revenue_bulan_lalu'] && $data['revenue_bulan_lalu']->total_paid != 0) {
					$data['percent_change'] = (($data['revenue_bulan_ini']->total_paid - $data['revenue_bulan_lalu']->total_paid) / $data['revenue_bulan_lalu']->total_paid) * 100;
				}

				// Load view based on the URI segment
				if ($view === 'staff') {
					$this->db->select('project.event_date, project.location, project.client_name, crew_projects.role, crew_projects.project_id');
					$this->db->from('user');
					$this->db->join('crew_projects', 'user.crews_idsession = crew_projects.crew_id');
					$this->db->join('project', 'crew_projects.project_id = project.id_session');
					$this->db->where('user.id_session', $this->session->id_session);
					$this->db->order_by('project.event_date', 'DESC');
					$data['events'] = $this->db->get()->result_array();
					$this->load->view('backend/v_home_staff', $data);
				} else {
					$this->load->view('backend/v_home', $data);
				}
		
			} else if ($this->session->level == '2') {
				cek_session_akses_administrator('panel', $this->session->id_session);
				$month_now = date('Y-m');
				$month_last = date('Y-m', strtotime('last month'));
				$data['client_tahun_ini'] = $this->Clients_model->get_clients_by_year(date('Y'));  // Client tahun ini
				$data['client_tahun_lalu'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('last year'))); // Client tahun lalu
				$data['client_tahun_depan'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('next year'))); // Client tahun depan
				$data['total_client'] = $this->Clients_model->get_total_clients(); // Total client
				$data['top_sales_ranking'] = $this->get_top_sales_ranking($month_now); // Top 5 pencapaian sales bulan ini
				
				// Revenue bulan ini
				$data['revenue_bulan_ini'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_now)
					->get('payment')
					->row();

				// Revenue bulan lalu
				$data['revenue_bulan_lalu'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_last)
					->get('payment')
					->row();

				// Total revenue all
				$data['total_revenue_all'] = $this->db->select_sum('total_bill')
					->get('payment')
					->row();

				// Hitung persentase perubahan revenue
				$data['percent_change'] = null;
				if ($data['revenue_bulan_ini'] && $data['revenue_bulan_lalu'] && $data['revenue_bulan_lalu']->total_paid != 0) {
					$data['percent_change'] = (($data['revenue_bulan_ini']->total_paid - $data['revenue_bulan_lalu']->total_paid) / $data['revenue_bulan_lalu']->total_paid) * 100;
				}
				if ($view === 'staff') {
					$this->db->select('project.event_date, project.location, project.client_name, crew_projects.role, crew_projects.project_id');
					$this->db->from('user');
					$this->db->join('crew_projects', 'user.crews_idsession = crew_projects.crew_id');
					$this->db->join('project', 'crew_projects.project_id = project.id_session');
					$this->db->where('user.id_session', $this->session->id_session);
					$this->db->order_by('project.event_date', 'DESC');
					$data['events'] = $this->db->get()->result_array();
					$this->load->view('backend/v_home_staff', $data);
				} else {
					$this->load->view('backend/v_home', $data);
				}
		
			} else if ($this->session->level == '3') {
				cek_session_akses_staff_accounting('panel', $this->session->id_session);
				$month_now = date('Y-m');
				$month_last = date('Y-m', strtotime('last month'));
				$data['client_tahun_ini'] = $this->Clients_model->get_clients_by_year(date('Y'));  // Client tahun ini
				$data['client_tahun_lalu'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('last year'))); // Client tahun lalu
				$data['client_tahun_depan'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('next year'))); // Client tahun depan
				$data['total_client'] = $this->Clients_model->get_total_clients(); // Total client
				$data['top_sales_ranking'] = $this->get_top_sales_ranking($month_now); // Top 5 pencapaian sales bulan ini
				
				// Revenue bulan ini
				$data['revenue_bulan_ini'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_now)
					->get('payment')
					->row();

				// Revenue bulan lalu
				$data['revenue_bulan_lalu'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_last)
					->get('payment')
					->row();

				// Total revenue all
				$data['total_revenue_all'] = $this->db->select_sum('total_bill')
					->get('payment')
					->row();



				// Hitung persentase perubahan revenue
				$data['percent_change'] = null;
				if ($data['revenue_bulan_ini'] && $data['revenue_bulan_lalu'] && $data['revenue_bulan_lalu']->total_paid != 0) {
					$data['percent_change'] = (($data['revenue_bulan_ini']->total_paid - $data['revenue_bulan_lalu']->total_paid) / $data['revenue_bulan_lalu']->total_paid) * 100;
				}
				if ($view === 'staff') {
					$this->db->select('project.event_date, project.location, project.client_name, crew_projects.role, crew_projects.project_id');
					$this->db->from('user');
					$this->db->join('crew_projects', 'user.crews_idsession = crew_projects.crew_id');
					$this->db->join('project', 'crew_projects.project_id = project.id_session');
					$this->db->where('user.id_session', $this->session->id_session);
					$this->db->order_by('project.event_date', 'DESC');
					$data['events'] = $this->db->get()->result_array();
					$this->load->view('backend/v_home_staff', $data);
				} else {
					$this->load->view('backend/v_home', $data);
				}
		
			} else if ($this->session->level == '4') {
				cek_session_akses_staff_admin('panel', $this->session->id_session);
				$month_now = date('Y-m');
				$month_last = date('Y-m', strtotime('last month'));
				$data['client_tahun_ini'] = $this->Clients_model->get_clients_by_year(date('Y'));  // Client tahun ini
				$data['client_tahun_lalu'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('last year'))); // Client tahun lalu
				$data['client_tahun_depan'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('next year'))); // Client tahun depan
				$data['total_client'] = $this->Clients_model->get_total_clients(); // Total client
				$data['top_sales_ranking'] = $this->get_top_sales_ranking($month_now); // Top 5 pencapaian sales bulan ini
				
				
				// Estimasi Revenue bulan ini
				$data['estimasi_revenue_bulan_ini'] = $this->getEstimasiRevenue($this->session->id_session);

				// Revenue bulan lalu
				$data['revenue_bulan_lalu'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_last)
					->get('payment')
					->row();

				// Total revenue all
				$data['total_revenue_all'] = $this->db->select_sum('total_bill')
					->get('payment')
					->row();


				if ($view === 'staff') {
					$this->db->select('project.event_date, project.location, project.client_name, crew_projects.role, crew_projects.project_id');
					$this->db->from('user');
					$this->db->join('crew_projects', 'user.crews_idsession = crew_projects.crew_id');
					$this->db->join('project', 'crew_projects.project_id = project.id_session');
					$this->db->where('user.id_session', $this->session->id_session);
					$this->db->order_by('project.event_date', 'DESC');
					$data['events'] = $this->db->get()->result_array();
					$this->load->view('backend/v_home_staff', $data);
				} else {
					$this->load->view('backend/v_home_admin', $data);
				}
		
			}else if ($this->session->level == '9') {
				cek_session_akses_staff_sales('panel', $this->session->id_session);
				$month_now = date('Y-m');
				$month_last = date('Y-m', strtotime('last month'));
				$data['client_tahun_ini'] = $this->Clients_model->get_clients_by_year(date('Y'));  // Client tahun ini
				$data['client_tahun_lalu'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('last year'))); // Client tahun lalu
				$data['client_tahun_depan'] = $this->Clients_model->get_clients_by_year(date('Y', strtotime('next year'))); // Client tahun depan
				$data['total_client'] = $this->Clients_model->get_total_clients(); // Total client
				$data['top_sales_ranking'] = $this->get_top_sales_ranking($month_now); // Top 5 pencapaian sales bulan ini
				
				
				// Estimasi Revenue bulan ini
				$data['estimasi_revenue_bulan_ini'] = $this->getEstimasiRevenue($this->session->id_session);

				// Revenue bulan lalu
				$data['revenue_bulan_lalu'] = $this->db->select_sum('total_paid')
					->where('DATE_FORMAT(date, "%Y-%m") =', $month_last)
					->get('payment')
					->row();

				// Total revenue all
				$data['total_revenue_all'] = $this->db->select_sum('total_bill')
					->get('payment')
					->row();

				if ($view === 'staff') {
					$this->db->select('project.event_date, project.location, project.client_name, crew_projects.role, crew_projects.project_id');
					$this->db->from('user');
					$this->db->join('crew_projects', 'user.crews_idsession = crew_projects.crew_id');
					$this->db->join('project', 'crew_projects.project_id = project.id_session');
					$this->db->where('user.id_session', $this->session->id_session);
					$this->db->order_by('project.event_date', 'DESC');
					$data['events'] = $this->db->get()->result_array();
					$this->load->view('backend/v_home_staff', $data);
				} else {
					$this->load->view('backend/v_home_salesmarketing', $data);
				}
		
			} else if ($this->session->level == '5') {
				cek_session_akses_client('panel', $this->session->id_session);
				$data['aaa'] = '';
				$this->load->view('backend/v_home_clients', $data);
		
			} else if ($this->session->level == '7') {
				cek_session_akses_staff('panel', $this->session->id_session);

					// Fetch event data
					$this->db->select('project.event_date, project.location, project.client_name, crew_projects.role, crew_projects.project_id');
					$this->db->from('user');
					$this->db->join('crew_projects', 'user.crews_idsession = crew_projects.crew_id');
					$this->db->join('project', 'crew_projects.project_id = project.id_session');
					$this->db->where('user.id_session', $this->session->id_session);
					$this->db->order_by('project.event_date', 'DESC');
					$events = $this->db->get()->result_array();

				// Pass data to the view
				$data['events'] = $events;
				$this->load->view('backend/v_home_staff', $data);

					} else if ($this->session->level == '8') {
				cek_session_akses_partner('panel', $this->session->id_session);

					// Fetch event data
					$this->db->select('project.event_date, project.location, project.client_name, vendor.type, vendor.id_session');
					$this->db->from('user');
					$this->db->join('vendor', 'user.partner_idsession = vendor.vendor_id');
					$this->db->join('project', 'vendor.id_session = project.id_session');
					$this->db->where('user.id_session', $this->session->id_session);
					$this->db->order_by('project.event_date', 'DESC');
					$events = $this->db->get()->result_array();

				// Pass data to the view
				$data['events'] = $events;
				$this->load->view('backend/v_home_partner', $data);

			} else {
				redirect(base_url());
			}
	}


	private function getEstimasiRevenue($user_id = null, $periode = null)
	{
	    if ($periode == null) {
	        $periode = date('Y-m');
	    }
	 
	    $periode_escaped = $this->db->escape($periode);
	 
	    $this->db->select('COALESCE(SUM(project.value),0) AS total');
	    $this->db->from('project');
	 
	    if ($user_id != null) {
	        $this->db->where('project.closing_user_idsession', $user_id);
	    }

	    // Pembayaran Kesatu (DP) harus LUNAS (tanggal berapa pun) - bulan
	    // "achieved" project ditentukan oleh Pembayaran Kedua, bukan Kesatu.
	    $this->db->where("
	        EXISTS(
	            SELECT 1
	            FROM payment p1
	            WHERE p1.id_session = project.id_session
	            AND p1.metodep LIKE 'Pembayaran Kesatu%'
	            AND p1.status = 'Paid'
	        )
	    ", NULL, FALSE);

	    // Pembayaran Kedua (pelunasan) yang menentukan bulan pencapaian
	    $this->db->where("
	        EXISTS(
	            SELECT 1
	            FROM payment p2
	            WHERE p2.id_session = project.id_session
	            AND p2.metodep LIKE 'Pembayaran Kedua%'
	            AND p2.status = 'Paid'
	            AND DATE_FORMAT(p2.date, '%Y-%m') = $periode_escaped
	        )
	    ", NULL, FALSE);

	    return $this->db->get()->row();
	}

	// Top 5 user dengan pencapaian penjualan tertinggi bulan tsb — pakai
	// syarat "achieved" yang sama dengan getEstimasiRevenue (Pembayaran
	// Kedua yang menentukan bulan, Kesatu cukup Paid tanggal berapa pun)
	// supaya angkanya konsisten dengan widget "Pencapaian" pribadi tiap
	// user di halaman yang sama.
	private function get_top_sales_ranking($periode)
	{
	    $periode_escaped = $this->db->escape($periode);

	    $this->db->select('user.id_session AS user_id_session, user.nama AS nama, SUM(project.value) AS total_pencapaian', FALSE);
	    $this->db->from('project');
	    $this->db->join('user', 'user.id_session = project.closing_user_idsession');

	    $this->db->where("
	        EXISTS(
	            SELECT 1
	            FROM payment p1
	            WHERE p1.id_session = project.id_session
	            AND p1.metodep LIKE 'Pembayaran Kesatu%'
	            AND p1.status = 'Paid'
	        )
	    ", NULL, FALSE);

	    $this->db->where("
	        EXISTS(
	            SELECT 1
	            FROM payment p2
	            WHERE p2.id_session = project.id_session
	            AND p2.metodep LIKE 'Pembayaran Kedua%'
	            AND p2.status = 'Paid'
	            AND DATE_FORMAT(p2.date, '%Y-%m') = $periode_escaped
	        )
	    ", NULL, FALSE);

	    $this->db->group_by('project.closing_user_idsession, user.nama');
	    $this->db->order_by('total_pencapaian', 'DESC');
	    $this->db->limit(5);

	    return $this->db->get()->result();
	}

	// Pencapaian satu user, dipecah per bulan, untuk semua bulan yang
	// tercatat di database (bukan cuma bulan berjalan) — syarat "achieved"
	// sama dengan get_top_sales_ranking/getEstimasiRevenue.
	private function get_sales_achievement_per_month($user_id_session)
	{
	    $sql = "SELECT DATE_FORMAT(p2.date, '%Y-%m') AS periode, SUM(project.value) AS total
	            FROM project
	            JOIN payment p2 ON p2.id_session = project.id_session
	                AND p2.metodep LIKE 'Pembayaran Kedua%'
	                AND p2.status = 'Paid'
	            WHERE project.closing_user_idsession = ?
	            AND EXISTS (
	                SELECT 1 FROM payment p1
	                WHERE p1.id_session = project.id_session
	                AND p1.metodep LIKE 'Pembayaran Kesatu%'
	                AND p1.status = 'Paid'
	            )
	            GROUP BY periode
	            ORDER BY periode DESC";

	    return $this->db->query($sql, [$user_id_session])->result();
	}

	public function sales_achievement($user_id_session)
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url());
	        return;
	    }

	    $user = $this->db->get_where('user', ['id_session' => $user_id_session])->row();
	    if (!$user) {
	        redirect(base_url('panel'));
	        return;
	    }

	    $data['sales_user'] = $user;
	    $data['achievement_per_month'] = $this->get_sales_achievement_per_month($user_id_session);
	    $this->load->view('backend/v_sales_achievement', $data);
	}

	// Project (dengan info kedua transaksinya) yang menyusun pencapaian
	// satu user di satu periode — syarat sama dengan get_sales_achievement_per_month.
	private function get_sales_achievement_projects($user_id_session, $periode)
	{
	    $sql = "SELECT project.id_session, project.project_name, project.client_name,
	                   project.event_date, project.value,
	                   p1.transactions_id AS kesatu_transaction_id, p1.date AS kesatu_date,
	                   p2.transactions_id AS kedua_transaction_id, p2.date AS kedua_date
	            FROM project
	            JOIN payment p2 ON p2.id_session = project.id_session
	                AND p2.metodep LIKE 'Pembayaran Kedua%'
	                AND p2.status = 'Paid'
	                AND DATE_FORMAT(p2.date, '%Y-%m') = ?
	            JOIN payment p1 ON p1.id_session = project.id_session
	                AND p1.metodep LIKE 'Pembayaran Kesatu%'
	                AND p1.status = 'Paid'
	            WHERE project.closing_user_idsession = ?
	            ORDER BY project.event_date DESC";

	    return $this->db->query($sql, [$periode, $user_id_session])->result();
	}

	public function sales_achievement_detail($user_id_session, $periode)
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url());
	        return;
	    }

	    $user = $this->db->get_where('user', ['id_session' => $user_id_session])->row();
	    if (!$user) {
	        redirect(base_url('panel'));
	        return;
	    }

	    $data['sales_user'] = $user;
	    $data['periode'] = $periode;
	    $data['achievement_projects'] = $this->get_sales_achievement_projects($user_id_session, $periode);
	    $this->load->view('backend/v_sales_achievement_detail', $data);
	}

	// Top 5 sales untuk bulan mana pun (bukan cuma bulan berjalan) — dipakai
	// oleh link "Lihat Bulan Lainnya" di home. Reuse get_top_sales_ranking
	// yang sama dengan yang dipakai widget di home.
	public function sales_ranking($periode = null)
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url());
	        return;
	    }

	    if ($periode === null) {
	        $periode = date('Y-m');
	    }

	    $data['periode'] = $periode;
	    $data['periode_sebelumnya'] = date('Y-m', strtotime($periode . '-01 -1 month'));
	    $data['periode_berikutnya'] = date('Y-m', strtotime($periode . '-01 +1 month'));
	    $data['top_sales_ranking'] = $this->get_top_sales_ranking($periode);
	    $this->load->view('backend/v_sales_ranking', $data);
	}

	// Halaman absensi kehadiran: absen masuk/keluar hari ini + riwayat
	// kehadiran satu bulan (default bulan berjalan, bisa browse bulan lain).
	public function absensi($periode = null)
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    if ($periode === null) {
	        $periode = date('Y-m');
	    }

	    $user_id_session = $this->session->id_session;
	    $today = date('Y-m-d');

	    $data['periode'] = $periode;
	    $data['periode_sebelumnya'] = date('Y-m', strtotime($periode . '-01 -1 month'));
	    $data['periode_berikutnya'] = date('Y-m', strtotime($periode . '-01 +1 month'));
	    $data['jam_masuk_ketentuan'] = $this->jam_masuk_ketentuan_absensi();
	    $data['bisa_atur_absensi'] = in_array($this->session->level, ['1', '2']);
	    $data['absen_hari_ini'] = $this->db->get_where('user_absensi', [
	        'user_id_session' => $user_id_session,
	        'tanggal' => $today,
	    ])->row();
	    $data['riwayat_absensi'] = $this->db
	        ->where('user_id_session', $user_id_session)
	        ->where("DATE_FORMAT(tanggal, '%Y-%m') =", $periode)
	        ->order_by('tanggal', 'DESC')
	        ->get('user_absensi')
	        ->result();

	    $this->load->view('backend/v_absensi', $data);
	}

	// Jam masuk ketentuan (parameter keterlambatan) diatur lewat
	// /absensi-pengaturan. Singleton row (id=1) — kalau belum pernah
	// diset, fallback ke 08:00:00.
	private function jam_masuk_ketentuan_absensi()
	{
	    $pengaturan = $this->db->get_where('pengaturan_absensi', ['id' => 1])->row();
	    return $pengaturan ? $pengaturan->jam_masuk : '08:00:00';
	}

	// Keterangan otomatis: kalau jam_masuk melewati jam masuk ketentuan,
	// hasilkan "Terlambat X menit". Kalau tepat waktu, kosong (biar tabel
	// tidak penuh tulisan "Tepat waktu" di setiap baris).
	private function hitung_keterangan_absensi($jam_masuk, $jam_masuk_ketentuan)
	{
	    $selisih_detik = strtotime($jam_masuk) - strtotime($jam_masuk_ketentuan);
	    if ($selisih_detik <= 0) {
	        return null;
	    }

	    $selisih_menit = (int) round($selisih_detik / 60);
	    return 'Terlambat ' . $selisih_menit . ' menit';
	}

	public function absensi_pengaturan()
	{
	    if (!in_array($this->session->level, ['1', '2'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    $data['jam_masuk_ketentuan'] = $this->jam_masuk_ketentuan_absensi();
	    $this->load->view('backend/v_absensi_pengaturan', $data);
	}

	public function absensi_pengaturan_update()
	{
	    if (!in_array($this->session->level, ['1', '2'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    $jam_masuk = $this->input->post('jam_masuk');
	    if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', (string) $jam_masuk)) {
	        $this->session->set_flashdata('error', 'Format jam masuk tidak valid.');
	        redirect(base_url('absensi-pengaturan'));
	        return;
	    }

	    $data = [
	        'jam_masuk' => $jam_masuk . ':00',
	        'updated_at' => date('Y-m-d H:i:s'),
	        'updated_by' => $this->session->id_session,
	    ];

	    if ($this->db->get_where('pengaturan_absensi', ['id' => 1])->row()) {
	        $this->db->where('id', 1)->update('pengaturan_absensi', $data);
	    } else {
	        $data['id'] = 1;
	        $this->db->insert('pengaturan_absensi', $data);
	    }

	    $this->session->set_flashdata('success', 'Pengaturan jam masuk berhasil disimpan.');
	    redirect(base_url('absensi-pengaturan'));
	}

	// Rekap absensi semua user untuk satu bulan (developer/administrator
	// saja) — cuma user yang punya minimal 1 catatan absen di bulan itu
	// yang muncul, bisa browse ke bulan sebelum/sesudahnya.
	public function absensi_rekap($periode = null)
	{
	    if (!in_array($this->session->level, ['1', '2'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    if ($periode === null) {
	        $periode = date('Y-m');
	    }

	    $data['periode'] = $periode;
	    $data['periode_sebelumnya'] = date('Y-m', strtotime($periode . '-01 -1 month'));
	    $data['periode_berikutnya'] = date('Y-m', strtotime($periode . '-01 +1 month'));
	    $data['rekap_absensi'] = $this->get_rekap_absensi_bulanan($periode);

	    $this->load->view('backend/v_absensi_rekap', $data);
	}

	private function get_rekap_absensi_bulanan($periode)
	{
	    $sql = "SELECT user.id_session, user.nama,
	                   SUM(CASE WHEN ua.status = 'Hadir' THEN 1 ELSE 0 END) AS total_hadir,
	                   SUM(CASE WHEN ua.status = 'Sakit' THEN 1 ELSE 0 END) AS total_sakit,
	                   SUM(CASE WHEN ua.status = 'Izin' THEN 1 ELSE 0 END) AS total_izin,
	                   SUM(CASE WHEN ua.status = 'Hadir' AND ua.keterangan IS NOT NULL AND ua.keterangan != '' THEN 1 ELSE 0 END) AS total_terlambat
	            FROM user_absensi ua
	            JOIN user ON user.id_session = ua.user_id_session
	            WHERE DATE_FORMAT(ua.tanggal, '%Y-%m') = ?
	            GROUP BY ua.user_id_session, user.nama
	            ORDER BY user.nama ASC";

	    return $this->db->query($sql, [$periode])->result();
	}

	// Detail harian satu user untuk satu bulan, dilihat dari rekap — reuse
	// tampilan tabel yang sama dengan riwayat pribadi di halaman /absensi.
	public function absensi_rekap_detail($periode, $user_id_session)
	{
	    if (!in_array($this->session->level, ['1', '2'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    $user = $this->db->get_where('user', ['id_session' => $user_id_session])->row();
	    if (!$user) {
	        redirect(base_url('absensi-rekap'));
	        return;
	    }

	    $data['absensi_user'] = $user;
	    $data['periode'] = $periode;
	    $data['riwayat_absensi'] = $this->db
	        ->where('user_id_session', $user_id_session)
	        ->where("DATE_FORMAT(tanggal, '%Y-%m') =", $periode)
	        ->order_by('tanggal', 'DESC')
	        ->get('user_absensi')
	        ->result();

	    $this->load->view('backend/v_absensi_rekap_detail', $data);
	}

	// Rekap Gaji Saya: self-service, tombol di home di samping Absensi.
	// Beda dengan Setting Salary (admin Fin & Acc yang assign kategori ke
	// user), di sini staff cuma LIHAT rincian gaji dia sendiri bulan ini —
	// tidak bisa ubah kategori/assignment-nya sendiri. Akses & role sama
	// dengan tombol Absensi.
	public function gaji_saya($periode = null)
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    if ($periode === null) {
	        $periode = date('Y-m');
	    }

	    $user_id_session = $this->session->id_session;
	    $kategori_list = $this->Gaji_model->get_kategori_user($user_id_session);

	    $detail_gaji = [];
	    $total_gaji_periode = 0;
	    foreach ($kategori_list as $k) {
	        // Kategori Harian (mis. absensi) tidak ditampilkan lagi di laporan
	        // Rekap Gaji Saya -- diminta dihilangkan dari sini.
	        if ($k->satuan_gaji === 'Harian') {
	            continue;
	        }
	        $detail = $this->Gaji_model->hitung_detail_gaji($user_id_session, $k, $periode);
	        $detail_gaji[] = $detail;
	        $total_gaji_periode += $detail['jumlah'];
	    }

	    // Transaksi gaji nyata dari Finance Operational (kategori 6201.01)
	    // yang staff_id_session-nya user ini -- muncul di laporan meski user
	    // belum punya kategori salary apa pun di-assign lewat Setting Salary.
	    // Fee crew dari Finance Project (kalau belum terhitung lewat kategori Project)
	    foreach ($this->Gaji_model->get_detail_fee_crew_tambahan($user_id_session, $kategori_list, $periode) as $detail) {
	        $detail_gaji[] = $detail;
	        $total_gaji_periode += $detail['jumlah'];
	    }

	    foreach ($this->Gaji_model->get_detail_gaji_operational($user_id_session, $periode) as $detail) {
	        $detail_gaji[] = $detail;
	        $total_gaji_periode += $detail['jumlah'];
	    }

	    $data['periode'] = $periode;
	    $data['periode_sebelumnya'] = date('Y-m', strtotime($periode . '-01 -1 month'));
	    $data['periode_berikutnya'] = date('Y-m', strtotime($periode . '-01 +1 month'));
	    $data['detail_gaji'] = $detail_gaji;
	    $data['total_gaji_periode'] = $total_gaji_periode;

	    $this->load->view('backend/v_gaji_saya', $data);
	}

	public function absensi_masuk()
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    list($lat, $lng, $error) = $this->validasi_foto_lokasi_absensi();
	    if ($error) {
	        $this->session->set_flashdata('error', $error);
	        redirect(base_url('absensi'));
	        return;
	    }

	    $user_id_session = $this->session->id_session;
	    $today = date('Y-m-d');

	    $existing = $this->db->get_where('user_absensi', [
	        'user_id_session' => $user_id_session,
	        'tanggal' => $today,
	    ])->row();

	    if (!$existing) {
	        $filename = $this->simpan_foto_absensi($this->input->post('foto'), $user_id_session, 'masuk');
	        if (!$filename) {
	            $this->session->set_flashdata('error', 'Absen masuk gagal: foto tidak valid.');
	            redirect(base_url('absensi'));
	            return;
	        }

	        $jam_masuk = date('H:i:s');
	        $jam_masuk_ketentuan = $this->jam_masuk_ketentuan_absensi();
	        $keterangan = $this->hitung_keterangan_absensi($jam_masuk, $jam_masuk_ketentuan);

	        $this->db->insert('user_absensi', [
	            'user_id_session' => $user_id_session,
	            'tanggal' => $today,
	            'status' => 'Hadir',
	            'jam_masuk' => $jam_masuk,
	            'jam_masuk_ketentuan' => $jam_masuk_ketentuan,
	            'foto_masuk' => $filename,
	            'lat_masuk' => $lat,
	            'lng_masuk' => $lng,
	            'alamat_masuk' => $this->ambil_alamat_absensi_post(),
	            'keterangan' => $keterangan,
	        ]);
	        $this->session->set_flashdata('success', $keterangan
	            ? 'Absen masuk berhasil dicatat (' . $keterangan . ').'
	            : 'Absen masuk berhasil dicatat.');
	    }

	    redirect(base_url('absensi'));
	}

	public function absensi_keluar()
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    list($lat, $lng, $error) = $this->validasi_foto_lokasi_absensi();
	    if ($error) {
	        $this->session->set_flashdata('error', $error);
	        redirect(base_url('absensi'));
	        return;
	    }

	    $user_id_session = $this->session->id_session;
	    $today = date('Y-m-d');

	    $existing = $this->db->get_where('user_absensi', [
	        'user_id_session' => $user_id_session,
	        'tanggal' => $today,
	    ])->row();

	    if ($existing && !empty($existing->jam_masuk) && empty($existing->jam_keluar)) {
	        $filename = $this->simpan_foto_absensi($this->input->post('foto'), $user_id_session, 'keluar');
	        if (!$filename) {
	            $this->session->set_flashdata('error', 'Absen keluar gagal: foto tidak valid.');
	            redirect(base_url('absensi'));
	            return;
	        }

	        $this->db->where('id', $existing->id)
	            ->update('user_absensi', [
	                'jam_keluar' => date('H:i:s'),
	                'foto_keluar' => $filename,
	                'lat_keluar' => $lat,
	                'lng_keluar' => $lng,
	                'alamat_keluar' => $this->ambil_alamat_absensi_post(),
	            ]);
	        $this->session->set_flashdata('success', 'Absen keluar berhasil dicatat.');
	    }

	    redirect(base_url('absensi'));
	}

	// Catat tidak masuk (Sakit/Izin) untuk hari ini — beda dengan absen
	// masuk/keluar, tidak butuh foto/lokasi (user memang tidak di tempat),
	// cuma status + keterangan manual yang wajib diisi.
	public function absensi_izin()
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        redirect(base_url('panel'));
	        return;
	    }

	    $status = $this->input->post('status');
	    $keterangan = trim((string) $this->input->post('keterangan'));

	    if (!in_array($status, ['Sakit', 'Izin'], true)) {
	        $this->session->set_flashdata('error', 'Status tidak valid.');
	        redirect(base_url('absensi'));
	        return;
	    }
	    if ($keterangan === '') {
	        $this->session->set_flashdata('error', 'Keterangan wajib diisi.');
	        redirect(base_url('absensi'));
	        return;
	    }

	    $user_id_session = $this->session->id_session;
	    $today = date('Y-m-d');

	    $existing = $this->db->get_where('user_absensi', [
	        'user_id_session' => $user_id_session,
	        'tanggal' => $today,
	    ])->row();

	    if ($existing) {
	        $this->session->set_flashdata('error', 'Sudah ada catatan absensi untuk hari ini.');
	        redirect(base_url('absensi'));
	        return;
	    }

	    $this->db->insert('user_absensi', [
	        'user_id_session' => $user_id_session,
	        'tanggal' => $today,
	        'status' => $status,
	        'keterangan' => substr($keterangan, 0, 255),
	    ]);

	    $this->session->set_flashdata('success', $status . ' berhasil dicatat.');
	    redirect(base_url('absensi'));
	}

	// Absen masuk/keluar wajib menyertakan foto live (diambil langsung dari
	// kamera, bukan upload galeri) beserta titik koordinat lokasi saat foto
	// diambil. Validasi kelengkapan & format koordinat di sini; validasi &
	// penyimpanan foto ada di simpan_foto_absensi().
	private function validasi_foto_lokasi_absensi()
	{
	    $foto = $this->input->post('foto');
	    $lat = $this->input->post('lat');
	    $lng = $this->input->post('lng');

	    if (empty($foto) || $lat === null || $lat === '' || $lng === null || $lng === '') {
	        return [null, null, 'Foto live dan lokasi wajib diambil sebelum absen.'];
	    }

	    if (!is_numeric($lat) || !is_numeric($lng)) {
	        return [null, null, 'Titik koordinat lokasi tidak valid.'];
	    }

	    return [(float) $lat, (float) $lng, null];
	}

	// Nama kecamatan/kabupaten hasil reverse-geocode di browser (best-effort,
	// lewat layanan pihak ketiga yang bisa saja gagal/lambat) — opsional,
	// beda dengan foto/koordinat yang wajib ada.
	private function ambil_alamat_absensi_post()
	{
	    $alamat = trim((string) $this->input->post('alamat'));
	    return $alamat !== '' ? substr($alamat, 0, 255) : null;
	}

	// Decode foto base64 (data URI hasil capture kamera) dan simpan ke
	// ./uploads/absensi/. Nama file di-generate sendiri (bukan dari input
	// user) supaya tidak ada celah path traversal.
	private function simpan_foto_absensi($base64_image, $user_id_session, $tipe)
	{
	    if (!preg_match('/^data:image\/(jpeg|jpg|png);base64,/', $base64_image, $matches)) {
	        return false;
	    }

	    $data = base64_decode(substr($base64_image, strpos($base64_image, ',') + 1), true);
	    if ($data === false || strlen($data) === 0) {
	        return false;
	    }

	    $upload_path = './uploads/absensi/';
	    if (!is_dir($upload_path)) {
	        mkdir($upload_path, 0777, true);
	    }

	    $ext = $matches[1] === 'png' ? 'png' : 'jpg';
	    $filename = 'absensi_' . $tipe . '_' . md5($user_id_session . microtime()) . '.' . $ext;
	    file_put_contents($upload_path . $filename, $data);

	    return $filename;
	}

	// Pencapaian revenue per project: tiap project dihitung SEKALI, dan
	// diatribusikan ke tahun pembayaran Paid PERTAMANYA (bukan tiap tahun yang
	// kebetulan punya pembayaran) — supaya project dengan cicilan yang
	// menyeberang tahun (mis. DP 2025, pelunasan 2026) tidak ke-hitung penuh
	// di dua tahun sekaligus (tahun-ini + tahun-lalu jadi melebihi all-time).
	// Filter per-user pakai project.closing_user_idsession.
	// Dipakai widget "Pencapaian Revenue" (Tahun Ini/Tahun Lalu/Keseluruhan)
	// -- syarat "achieved" HARUS sama dengan getEstimasiRevenue/
	// get_top_sales_ranking/get_sales_achievement_per_month: Pembayaran
	// Kesatu (DP) Paid tanggal berapa pun, DAN Pembayaran Kedua (pelunasan)
	// Paid -- tahunnya ditentukan dari tanggal Kedua, bukan dari
	// MIN(tanggal paid) sembarang payment seperti versi lama (itu sebabnya
	// angkanya dulu tidak sinkron dengan widget lain di dashboard yang
	// sama-sama pakai closing_user_idsession).
	private function getProjectAchievement($user_id = null, $year = null)
	{
	    $this->db->select('COALESCE(SUM(project.value), 0) AS value', FALSE);
	    $this->db->from('project');

	    if ($user_id !== null) {
	        $this->db->where('project.closing_user_idsession', $user_id);
	    }

	    $this->db->where("
	        EXISTS(
	            SELECT 1
	            FROM payment p1
	            WHERE p1.id_session = project.id_session
	            AND p1.metodep LIKE 'Pembayaran Kesatu%'
	            AND p1.status = 'Paid'
	        )
	    ", NULL, FALSE);

	    if ($year !== null) {
	        $year_int = (int) $year;
	        $this->db->where("
	            EXISTS(
	                SELECT 1
	                FROM payment p2
	                WHERE p2.id_session = project.id_session
	                AND p2.metodep LIKE 'Pembayaran Kedua%'
	                AND p2.status = 'Paid'
	                AND YEAR(p2.date) = $year_int
	            )
	        ", NULL, FALSE);
	    } else {
	        $this->db->where("
	            EXISTS(
	                SELECT 1
	                FROM payment p2
	                WHERE p2.id_session = project.id_session
	                AND p2.metodep LIKE 'Pembayaran Kedua%'
	                AND p2.status = 'Paid'
	            )
	        ", NULL, FALSE);
	    }

	    return $this->db->get()->row();
	}

	public function logout()
		{

		if ($this->agent->is_browser()) // Agent untuk fitur di log activity
                {
                      $agent = 'Desktop ' .$this->agent->browser().' '.$this->agent->version();
                }
                elseif ($this->agent->is_robot())
                {
                      $agent = $this->agent->robot();
                }
                elseif ($this->agent->is_mobile())
                {
                      $agent = 'Mobile' .$this->agent->mobile().''.$this->agent->version();
                }
                else
                {
                      $agent = 'Unidentified User Agent';
                }


		$id = array('id_session' => $this->session->id_session);
						$data = array('user_login_status'=>'offline');
						$this->db->update('user', $data, $id);

			$ip = $this->input->ip_address();
			$location = get_location_from_ip($ip);
			$ip_with_location = $ip . "<br>(" . $location . ")";
	
			$data_log = array(

            'log_activity_user_id'=>$this->session->id_session,
            'log_activity_modul' => 'Logout',            
            'log_activity_status' => 'Logout ',
			'log_activity_waktu' => date('Y-m-d H:i:s'),
            'log_activity_platform'=> $agent,
            'log_activity_ip'=> $ip_with_location
            
        );

        $this->Potensial_model->insert_log_activity($data_log);


            // Unset user data
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');

            // Set message
            $this->session->set_flashdata('user_logout', 'You are now logged out');
						$this->session->sess_destroy();
            redirect(base_url());
    	}
	// Catatan: method profil/user_update/user_storage_bin/user_delete/identitaswebsite/logactivity (sisa template lama,
	// memanggil cek_session_akses_* yang tidak ada & view backend/profil|log yang tidak ada) dihapus karena selalu fatal error.

	public function get_revenue_data()
	{
	    $date_now = date('Y-m-d'); // Current date
	    $date_start_of_month = date('Y-m-01'); // Start of the current month
	    $date_start_of_last_month = date('Y-m-01', strtotime('first day of last month')); // Start of last month
	    $date_end_of_last_month = date('Y-m-t', strtotime('last month')); // End of last month
	 
	    // Semua metrik pencapaian (target, bulan ini, tahun ini, tahun lalu,
	    // all-time, komisi) adalah kuota/capaian PRIBADI tiap user yang login
	    // — termasuk developer/admin, yang juga punya baris target & project
	    // closing sendiri. Tidak ada mode "global" di widget ini; total
	    // company-wide (total_revenue_all dkk di bawah) memang sengaja selalu
	    // dihitung terpisah tanpa filter user.
	    $own_user_id = $this->session->id_session;

	    $bulan_ini = date('Y-m');
	    $this->db->select_sum('targetsales_nominal')
	        ->where('targetsales_periode', $bulan_ini)
	        ->where('user_id_session', $own_user_id);
	    $target = $this->db->get('targetsales')->row();
	    $target_nominal = (int) ($target->targetsales_nominal ?? 0);

	    // Revenue bulan ini
	    $estimasi_revenue_bulan_ini = $this->getEstimasiRevenue($own_user_id);
	    $estimasi = $estimasi_revenue_bulan_ini->total ?? 0;
	 
	    $estimasi_komisi_bulan_ini = $estimasi * 2.5 / 100;
	    $hasil_target = $estimasi - $target_nominal;
	 
	    $revenue_bulan_ini = $this->db->select_sum('total_paid')
	        ->where('DATE(date) >=', $date_start_of_month)
	        ->where('DATE(date) <=', $date_now)
	        ->where('status', 'Paid')
	        ->get('payment')
	        ->row();
	 
	    // Revenue bulan lalu
	    $revenue_bulan_lalu = $this->db->select_sum('total_paid')
	        ->where('DATE(date) >=', $date_start_of_last_month)
	        ->where('DATE(date) <=', $date_end_of_last_month)
	        ->where('status', 'Paid')
	        ->get('payment')
	        ->row();
	 
	    // Total revenue all
	    $total_revenue_all = $this->db->select_sum('total_paid')
	        ->where('status', 'Paid')
	        ->get('payment')
	        ->row();
	 
	    $total_pending_revenue = $this->db->select_sum('total_paid')
	        ->where('status', 'Pending')
	        ->get('payment')
	        ->row();
	 
	    $total_project_acc = $this->db->select_sum('nominal_transaksi')
	        ->get('project_acc')
	        ->row();
	 
	    $total_net_revenue = $total_revenue_all->total_paid - $total_project_acc->nominal_transaksi;
	 
	    // ====== ESTIMASI REVENUE TAHUN INI, TAHUN LALU, ALL TIME ======
	    // Dihitung per-project (bukan per-baris payment) supaya project dengan
	    // beberapa pembayaran Paid (DP + pelunasan, dst) tidak ke-double-count.
	    $tahun_ini = date('Y');
	    $tahun_lalu = date('Y') - 1;
	    $estimasi_revenue_tahun_ini = $this->getProjectAchievement($own_user_id, $tahun_ini);
	    $estimasi_revenue_tahun_lalu = $this->getProjectAchievement($own_user_id, $tahun_lalu);
	    $estimasi_revenue_all_time = $this->getProjectAchievement($own_user_id, null);
	 
	    $estimasi_komisi_total = ($estimasi_revenue_all_time->value ?? 0) * 2.5 / 100;
	 
	    $expense_bulan_ini = $this->db->select_sum('nominal_transaksi')
	        ->where('DATE(tanggal_transaksi) >=', $date_start_of_month)
	        ->where('DATE(tanggal_transaksi) <=', $date_now)
	        ->get('operational_acc')
	        ->row();
	 
	    $expense_bulan_lalu = $this->db->select_sum('nominal_transaksi')
	        ->where('DATE(tanggal_transaksi) >=', $date_start_of_last_month)
	        ->where('DATE(tanggal_transaksi) <=', $date_end_of_last_month)
	        ->get('operational_acc')
	        ->row();
	 
	    $total_expense_all = $this->db->select_sum('nominal_transaksi')
	        ->get('operational_acc')
	        ->row();
	 
	    $total_other = $this->db->select_sum('nominal_transaksi')
	        ->get('other_acc')
	        ->row();
	 
	    $total_gross_profit = ($total_revenue_all->total_paid - $total_project_acc->nominal_transaksi) - $total_expense_all->nominal_transaksi;
	 
	    $total_net_profit = $total_revenue_all->total_paid - $total_project_acc->nominal_transaksi - $total_expense_all->nominal_transaksi - $total_other->nominal_transaksi;
	 
	    // Hitung persentase perubahan revenue
	    $percent_change = null;
	    if ($revenue_bulan_ini && $revenue_bulan_lalu && $revenue_bulan_lalu->total_paid != 0) {
	        $percent_change = (($revenue_bulan_ini->total_paid - $revenue_bulan_lalu->total_paid) / $revenue_bulan_lalu->total_paid) * 100;
	    }
	 
	    echo json_encode([
	        'estimasi_revenue_bulan_ini' => $estimasi,
	        'target_nominal' => $target_nominal,
	        'hasil_target' => $hasil_target,
	        'estimasi_komisi_bulan_ini' => $estimasi_komisi_bulan_ini,
	        'estimasi_komisi_total' => $estimasi_komisi_total,
	        'estimasi_revenue_tahun_ini' => $estimasi_revenue_tahun_ini->value ?? 0,
	        'estimasi_revenue_tahun_lalu' => $estimasi_revenue_tahun_lalu->value ?? 0,
	        'estimasi_revenue_all_time' => $estimasi_revenue_all_time->value ?? 0,
	        'revenue_bulan_ini' => $revenue_bulan_ini->total_paid ?? 0,
	        'revenue_bulan_lalu' => $revenue_bulan_lalu->total_paid ?? 0,
	        'total_revenue_all' => $total_revenue_all->total_paid ?? 0,
	        'total_pending_revenue' => $total_pending_revenue->total_paid ?? 0,
	        'total_project_acc' => $total_project_acc->nominal_transaksi ?? 0,
	        'total_net_revenue' => $total_net_revenue,
	        'expense_bulan_ini' => $expense_bulan_ini->nominal_transaksi ?? 0,
	        'expense_bulan_lalu' => $expense_bulan_lalu->nominal_transaksi ?? 0,
	        'total_expense_all' => $total_expense_all->nominal_transaksi ?? 0,
	        'total_gross_profit' => $total_gross_profit,
	        'total_net_profit' => $total_net_profit,
	        'percent_change' => $percent_change
	    ]);
	}

	public function client_lebih_lengkap() {
	    $clients_per_year = $this->Clients_model->get_clients_per_year();
	    $data['clients_per_year'] = $clients_per_year;
	    $this->load->view('backend/client_lebih_lengkap', $data);
	}

	public function client_lebih_lengkap_detail($year, $month) {
	    // Ambil data client berdasarkan bulan dan tahun
	    $data['clients'] = $this->Clients_model->get_client_with_transaction_id($month, $year);

	    // Tambahkan informasi bulan dan tahun ke data
	    $data['year'] = $year;
	    $data['month'] = $month;

	    // Load view untuk menampilkan detail client
	    $this->load->view('backend/client_lebih_lengkap_detail', $data);
	}

	public function revenue_lebih_lengkap() {
	    $this->load->model('Payment_model');
	    $data['revenue_per_year'] = $this->Payment_model->get_revenue_per_year();
	    $this->load->view('backend/revenue_lebih_lengkap', $data);
	}

	public function revenue_lebih_lengkap_detail($year, $month) {
	    $this->load->model('Payment_model');
	    $data['revenues'] = $this->Payment_model->get_paid_revenues_with_transaction_id($month, $year);
	    $data['month'] = $month;
	    $data['year'] = $year;
	    $this->load->view('backend/revenue_lebih_lengkap_detail', $data);
	}


	public function expense_lebih_lengkap() {
		if ($this->session->level == '1') {
			cek_session_akses_developer('panel', $this->session->id_session);	    
		    $data['expense_per_year'] = $this->Payment_model->get_expense_per_year();
		    $this->load->view('backend/expense_lebih_lengkap', $data);
		}else if ($this->session->level == '3') {
			cek_session_akses_staff_accounting('panel', $this->session->id_session);
			$data['expense_per_year'] = $this->Payment_model->get_expense_per_year();
		    $this->load->view('backend/expense_lebih_lengkap', $data);
		}else{
				redirect(base_url());
		}
	}

	public function expense_lebih_lengkap_detail($year, $month) {
		if ($this->session->level == '1') {
			cek_session_akses_developer('panel', $this->session->id_session);
			$data['expense'] = $this->Payment_model->get_paid_expense_with_transaction_id($month, $year);
	    	$data['month'] = $month;
	    	$data['year'] = $year;
	    	$this->load->view('backend/expense_lebih_lengkap_detail', $data);
		}else if ($this->session->level == '3') {
			cek_session_akses_staff_accounting('panel', $this->session->id_session);
			$data['expense'] = $this->Payment_model->get_paid_expense_with_transaction_id($month, $year);
	    	$data['month'] = $month;
	    	$data['year'] = $year;
	    	$this->load->view('backend/expense_lebih_lengkap_detail', $data);
		}else{
				redirect(base_url());
		}

	    
	}



	public function get_expense_data()
	{

	    $total_expense = $this->db->select_sum('nominal_transaksi')
	        ->get('operational_acc')
	        ->row();

	    echo json_encode([
	        'total_expense' => $total_expense->nominal_transaksi ?? 0

	    ]);
	}

	// AJAX buat widget "Kalender Event" di dashboard -- dipanggil ulang tiap
	// ganti bulan (lihat backend/partial_kalender_event.php). Cuma role
	// internal (bukan client/vendor/crew) yang boleh akses, karena hasilnya
	// menampilkan SEMUA project, bukan cuma milik user yang login.
	public function get_calendar_events()
	{
	    if (!in_array($this->session->level, ['1', '2', '3', '4', '9'])) {
	        show_error('Akses ditolak.', 403);
	        return;
	    }

	    $month = $this->input->get('month');
	    if (!$month || !preg_match('/^\d{4}-\d{2}$/', $month)) {
	        $month = date('Y-m');
	    }

	    $projects = $this->project_model->get_events_by_month($month);
	    $agenda_items = $this->Agenda_model->get_agenda_items_by_month($month);

	    $per_tanggal = [];

	    // Hari H (tanggal acara project) -- ditandai tipe 'Hari H' supaya
	    // kebedakan dari milestone agenda lain di tanggal yang sama.
	    foreach ($projects as $p) {
	        $tanggal = date('Y-m-d', strtotime($p->event_date));
	        if (!isset($per_tanggal[$tanggal])) {
	            $per_tanggal[$tanggal] = [];
	        }
	        $per_tanggal[$tanggal][] = [
	            'tipe' => 'Hari H',
	            'id_session' => $p->id_session,
	            'client_name' => $p->client_name,
	            'project_name' => $p->project_name,
	            'location' => $p->location,
	        ];
	    }

	    // Milestone agenda per project (Fitting, Test Food, Final Fitting,
	    // Technical Meeting, dst) -- lihat Agenda_model::$kolom_agenda.
	    foreach ($agenda_items as $a) {
	        $tanggal = date('Y-m-d', strtotime($a->tanggal));
	        if (!isset($per_tanggal[$tanggal])) {
	            $per_tanggal[$tanggal] = [];
	        }
	        $per_tanggal[$tanggal][] = [
	            'tipe' => $a->tipe,
	            'waktu' => !empty($a->waktu) ? substr($a->waktu, 0, 5) : null,
	            'id_session' => $a->id_session,
	            'client_name' => $a->client_name,
	            'project_name' => $a->project_name,
	            'location' => !empty($a->lokasi) ? $a->lokasi : null,
	            'location_url' => (!empty($a->lokasi_url) && preg_match('#^https?://#i', $a->lokasi_url)) ? $a->lokasi_url : null,
	        ];
	    }

	    $events = [];
	    foreach ($per_tanggal as $tanggal => $list) {
	        $events[] = [
	            'tanggal' => $tanggal,
	            'jumlah' => count($list),
	            'projects' => $list,
	        ];
	    }

	    echo json_encode([
	        'month' => $month,
	        'events' => $events,
	    ]);
	}
	
}
