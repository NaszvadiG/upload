<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
	/**
	* class Member 
	*/
	class Member extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			if ($this->session->userdata('session_member') != 'true'){
				$_SESSION['flash_messsage'] = 'You are not allowed to access or your session has been expired';
				$this->session->mark_as_temp('flash_messsage', 1);
				redirect('/');
			}
			$this->load->model('member_model', 'mdl', TRUE); 
			$this->load->model('admin_model', 'mdl_admin', TRUE);
			$this->load->library('form_validation','bcrypt');
			$this->form_validation->set_error_delimiters('<div class="alert bg-red">', '</div>');
			date_default_timezone_set("Asia/Jakarta");
		}

		public function index()
		{	
			$id = $this->session->userdata('id');

			$data = array(
				'title' => 'Dasboard User',
				'hasil' => $this->mdl->show_api($id)->result_array(),
				'hasil2'=> $this->mdl->order_api(array('user_id'=>$id))->result_array(),
				'col' 	=>  array(
								'id_order',
								'name',
								'domain',
								'api_keys',
								'last_used',
								'ip',
								'status'
				),
				'col2' 	=>  array(
								'id_order',
								'domain',
								'api_keys',
								'date',
								'price',
								'status'
				)
				
			);

			$this->page('dashboard',$data);
		}

		public function submit_form()
		{
			$get_price = $this->mdl_admin->select_col('options', array('value'), '')->result_array()[0]['value'];
			$price = 0;
			if (!empty($get_price)) 
				$price = $get_price;
			
			$data = array(
				'domain'	=> $this->security->xss_clean($this->input->post('input_domain')),
				'price' 	=> $price,
				'status'	=> 0,
				'user_id'	=> $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$url = $this->mdl->add_order($data);
			$insert_api = $this->mdl->insert_api(
				array(
					'domain'	=> $data['domain'],
					'ip'		=> gethostbyname($data['domain']),
					'order_id'	=> $url,
					'active'	=> 0,
					'created_at'=> date('Y-m-d H:i:s')
				)
			);

			redirect('member/invoice/'.$url);
		}

		public function invoice($id)
		{
			$data = array(
				'title'	=> 'Invoice',
				'hasil3' => $this->mdl->invoice_mdl($id)->result_array(),
				'col3' => array(
					'domain',
					'api_keys',
					'price',
					'date'
				)
			);
			
			$this->page('invoice', $data);
		}

		public function tutorial()
		{
			$this->page('tutorial', array('title' => 'Tutorial'));
		}

		public function profile ()
		{
			$this->form_validation->set_rules('old_password','Old Password','required|min_length[6]');
			$this->form_validation->set_rules('newpasswd','New Password','required|min_length[6]');
			$this->form_validation->set_rules('passconf','Password Confirmation','required|min_length[6]|matches[newpasswd]');
			
			if($this->form_validation->run() == FALSE){
				$this->page('profile', array('title' => 'Profile'));
			}else{
				$old_password = $this->security->xss_clean($this->input->post('old_password'));
				$id_user = $this->session->userdata('id');
				$password_db = $this->mdl->get_password_by_id($id_user)->result_array()[0]['password'];

				if ($this->bcrypt->check_password($old_password, $password_db)) {
					$newpasswd = $this->security->xss_clean($this->input->post('newpasswd'));
					$encrypt = $this->bcrypt->hash_password($newpasswd);
					if ($this->mdl->password_update($id_user, $encrypt) > 0) {
						$this->session->set_flashdata('flash_messsage_success', 'Update password success!');
						redirect(site_url().'member/profile');
					}

					$this->session->set_flashdata('flash_messsage', 'Update password failed!');
					redirect(site_url().'member/profile');
				}else{
					$this->session->set_flashdata('flash_messsage', 'Update password failed!');
					redirect(site_url().'member/profile');
				}
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('/');
		}

		public function page($page, $data)
		{  
			if (!file_exists(APPPATH.'views/pages/member/'.$page.'.php'))
				show_404();

	        $this->load->view('templates/member/header', $data);
	        $this->load->view('templates/member/menubar', $data);
	        $this->load->view('templates/member/sidebar', $data);
	        $this->load->view('pages/member/'.$page, $data);
	        $this->load->view('templates/member/footer', $data);
	    }

}