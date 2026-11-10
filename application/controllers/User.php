<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }
  public function logout(){
    $id_session = $this->session->userdata('id_session');
    if (!empty($id_session)) {
        // Tandai offline eksplisit + catat waktunya sebagai "terakhir online"
        // buat user yang benar-benar klik Logout (bukan cuma nutup browser).
        $this->db->where('id_session', $id_session);
        $this->db->update('user', [
            'user_login_status' => 'offline',
            'last_activity' => date('Y-m-d H:i:s'),
        ]);
    }

    $this->session->sess_destroy();
    redirect(base_url('login'));
  }
  public function login()
  {
      $this->load->library(['form_validation','session','user_agent']);

      $data['title'] = 'Sign In';
      $data['identitas'] = $this->Crud_m->get_by_id_identitas(1);

      $this->form_validation->set_rules('username','Username','trim|required', [
          'required' => '**Fill Your Username'
      ]);
      $this->form_validation->set_rules('password','Password','trim|required', [
          'required' => '**Fill Your Password'
      ]);

      if ($this->form_validation->run() === FALSE) {
          $this->load->view('backend/v_login', $data);
          return;
      }

      // 🔹 Detect device
      if ($this->agent->is_browser()) {
          $agent = 'Desktop '.$this->agent->browser().' '.$this->agent->version();
      } elseif ($this->agent->is_robot()) {
          $agent = $this->agent->robot();
      } elseif ($this->agent->is_mobile()) {
          $agent = 'Mobile '.$this->agent->mobile().' '.$this->agent->version();
      } else {
          $agent = 'Unidentified User Agent';
      }

      $username = $this->input->post('username', true);
      $input_password = $this->input->post('password', true);

      $cek = $this->As_m->get_user_by_username($username, 'user');
      $row = ($cek->num_rows() > 0) ? $cek->row_array() : null;

      $password_ok = $row && (
          password_verify($input_password, $row['password'])
          || $row['password'] === sha1($input_password)
      );

      if ($password_ok) {

          // Legacy sha1 hash matched — transparently upgrade it to bcrypt.
          if (strlen($row['password']) !== 60) {
              $this->db->where('id_user', $row['id_user'])
                       ->update('user', ['password' => password_hash($input_password, PASSWORD_DEFAULT)]);
          }

          // Level baru buatan Developer (menu Hak Akses) meniru level dasarnya: session->level = level dasar supaya semua
          // pengecekan level yang ada tetap berlaku; session->level_asli = id level aslinya (dipakai untuk pengaturan halaman).
          $this->load->model('Hak_akses_model');
          $level_dasar = $this->Hak_akses_model->dasar_level($row['level']);

          // ✅ FIX PALING PENTING → TAMBAH 'login'
          $this->session->set_userdata([
              'login'      => true, // ← INI YANG KAMU BUTUHKAN
              'username'   => $row['username'],
              'level'      => $level_dasar,
              'level_asli' => $row['level'],
              'id_user'    => $row['id_user'],
              'id_session' => $row['id_session']
          ]);

          $this->session->set_flashdata('user_loggedin', 'Selamat Anda Berhasil Login');

          // 🔹 Update status user
          $this->db->where('id_session', $row['id_session']);
          $this->db->update('user', [
              'user_login_status' => 'online',
              'last_activity' => date('Y-m-d H:i:s'),
          ]);

          // 🔹 Log activity
          $ip = $this->input->ip_address();
          $location = function_exists('get_location_from_ip') ? get_location_from_ip($ip) : 'Unknown';
          $ip_with_location = $ip . " (" . $location . ")";

          $this->db->insert('log_activity', [
              'log_activity_user_id' => $row['id_session'],
              'log_activity_modul'   => 'Login',
              'log_activity_status'  => 'Login',
              'log_activity_platform'=> $agent,
              'log_activity_ip'      => $ip_with_location
          ]);

          redirect('panel');

      } else {

          $this->session->set_flashdata('login_failed', 'Username dan password salah');
          redirect('login');
      }
  }
  public function datapengantinmoeslem(){
        $this->form_validation->set_rules('cpp_namaleng','','trim|required', array('trim' => '', 'required' => 'nama lengkap pengantin pria belum diisi'));


        $this->form_validation->set_rules('email','','trim|required|valid_email|is_unique[user.email]', array('trim' => '', 'required' => 'Email belum diisi','is_unique' => 'Email telah digunakan, silahkan gunakan email lain.'));
        $this->form_validation->set_rules('password','','trim|required', array('trim' => '', 'required' => 'Password belum diisi'));
        $this->form_validation->set_rules('konfirmpassword','','trim|required|matches[password]', array('trim' => '', 'required' => 'Konfirmasi Password belum diisi','matches'=>'Password tidak sama! Cek kembali password Anda'));
       
        if($this->form_validation->run() != false){
          if (isset($_POST['submit']))
          {
            $username = $this->input->post('username');
            $email = $this->input->post('email');            
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $cek = $this->Crud_m->cek_register($username,$email,'user');
              $total = $cek->num_rows();
            if ($total > 0)
              {
              $data['title'] = 'Periksa kembali email dan password Anda!';
              redirect(site_url('daftar'));
              }else{
                $saltid   = md5($email);
                $aktivasi   = 0;
                $data = array('username'=>$this->db->escape_str($this->input->post('username')),
                                'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                                'email'=>$this->db->escape_str($this->input->post('email')),
                                'user_status'=> $aktivasi,
                                'user_post_hari'=>hari_ini(date('w')),
                                'user_post_tanggal'=>date('Y-m-d'),
                                'user_post_jam'=>date('H:i:s'),
                                'level'=>'5',
                                'user_stat'=>'verified',
                                'id_session'=>md5($this->input->post('email')).'-'.date('YmdHis'));
                $id_user_detail = $this->Crud_m->tambah_user($data);
                $data_user_detail = array('id_user' => $id_user_detail);
                if($this->Crud_m->tambah_user_detail($data_user_detail))
                {
                  if($this->sendemail($email,$saltid,$username))
                                {
                                    $this->session->set_flashdata('msg','<div class="alert bg-5 text-center">Segera lakukan aktivasi akun dari email anda. Harap merefresh pesan masuk di email Anda.</div>');
                                    redirect(base_url('daftar')
                                    );
                            }else
                                {
                                  $this->session->set_flashdata('msg','<div class="alert bg-5 text-center">Email Verifikasi tidak terkirim</div>');
                                  redirect(base_url('daftar'));
                                }
                }
                $data['title'] = 'Sukses mendaftar';
                $data['identitas']= $this->Crud_m->get_by_id_identitas($id='1');
                $this->load->view('fronts/user/v_datapengantinmoeslem',$data);

                }
            }
            else
            {
              $data['identitas']= $this->Crud_m->get_by_id_identitas($id='1');
              $this->load->view('fronts/user/v_datapengantinmoeslem',$data);
            }

          } else{
          $data['title'] = 'Ops.. Masih ada yang kurang. Silahkan dicek kembali.';
          $data['identitas']= $this->Crud_m->get_by_id_identitas($id='1');
          $this->load->view('fronts/user/v_datapengantinmoeslem',$data);
        }
  }
  public function sendemail($email,$saltid,$username){
        // configure the email setting

            $config = array (
              'protocol'    => 'smtp',
              'smtp_host'   => getenv('SMTP_HOST') ?: '',
              'smtp_port'   => getenv('SMTP_PORT') ?: '465',
              'smtp_user'   => getenv('SMTP_USER') ?: '',
              'smtp_pass'   => getenv('SMTP_PASS') ?: '',
              'mailtype'    => 'html',
              'charset'     => 'iso-8859-1',
              'wordwrap'    => TRUE
              );           
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $url = base_url()."user/confirmation/".$saltid;
            $this->email->from(getenv('SMTP_USER') ?: 'no-reply@example.com', nama_website());
            $this->email->to($email);
            $this->email->subject('Verifikasi Email - ' . nama_website());
            $message = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'></head><body><p><strong>Hallo, $username</strong></p><p>Hanya tinggal 1 langkah lagi untuk bisa bergabung dengan ".nama_website().".</p><p>Silahkan mengklik link di bawah ini</p>".$url."<br/><p>Salam Hangat</p><p>".nama_website()." Team</p></body></html>";
            $this->email->message($message);
            return $this->email->send();
      }
  public function confirmation($key){
          if($this->Crud_m->verifyemail($key))
          {
            $this->session->set_flashdata('msg','<div class="alert bg-3 text-center">Selamat Anda telah Resmi Bergabung! Silahkan Login.</div>');
            redirect(base_url('login'));
          }	else {
            $this->session->set_flashdata('msg','<div class="alert bg-3 text-center">Ops. Anda gagal, silahkan coba lagi.</div>');
            redirect(base_url('login'));
          }
      }




}
