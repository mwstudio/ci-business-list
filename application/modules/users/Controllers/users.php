<?php
/*
Author: Daniel Gutierrez
Date: 9/18/12
Version: 1.0
*/

class Users extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('user_contact_model');
		$this->load->model('user_package_model');
		
		$this->load->library('form_validation');
		$this->load->library('recaptcha');
	
	}
	
	function index(){
		
		$data["users"] = $this->user_model->with('contact')->with('package')->get_all();
		$data['main_content'] = 'users';
		$this->load->view('page', $data);
	}

	function _package_activation($where, $data){
		return $this->user_package_model->update($where, $data, TRUE);
	}

	function my_package_id(){
		$data['user_id'] = $this->session->userdata('userid');
		return $this->user_package_model->get_by($data);
	}

	function success(){
		$data['main_content'] = 'signup-success';
		$this->load->view('page', $data);	
	}
	
	function profile($username){
		
		$data["user"] = $this->user_model->with('contact')->with('package')->get_by('username',$username);
		
		if($data["user"]){
			$data['main_content'] = 'user';
			$this->load->view('page', $data);
		}else{
			show_404();
		}
		
	}

	function status($username, $status = null){
		if ($status == null || !$username)
			redirect('/users');

		$user = $this->user_model->get_by('username',$username);
		$status = $status == 0 ? 1 : 0;
		$primary_value = $user->id;

		if ($user) {
			$data = array(
				'status' => $status
			);
			$update = $this->user_model->update($primary_value, $data, TRUE);
			if ($update) {
				redirect('/users');
			}
		}
	}
	
	function _is_logged_in()
	{
		if($this->session->userdata('logged_in'))
			return true;
		return false;
	}

	function userdata(){
		if($this->_is_logged_in()){
			return $this->user_model->get($this->session->userdata('userid'));
		}else{
			return false;
		}
	}

	function signin(){
		//Redirect
		if($this->_is_logged_in()){
			redirect('');
		}
		
		if($_POST){
			//Data
			$data = array(
				'username' => $this->input->post('username', true),
				'password' => md5($this->input->post('password', true)),
			);
			
			$userdata 	= $this->user_model->get_by($data);	

			//Validation
			if($userdata){
				if($userdata->status == 0){
					$data['error'] = "Not validated!";
					$data['main_content'] = 'signin';
					$this->load->view('page', $data);
				}else{
					$data['userid'] = $userdata->id;
					$data['username'] = $userdata->username;
					$data['logged_in'] = true;
					$this->session->set_userdata($data);
					if($this->input->get('redirect'))
						redirect($this->input->get('redirect'));
					redirect('');
				}				
			}else{
				$data['error'] = "You shall not pass!";
				$data['main_content'] = 'signin';
				$this->load->view('page', $data);
			}

			return;
		}
		$data['main_content'] = 'signin';
		$this->load->view('page', $data);
	}
	
	function signup(){
		if($_POST){

				$data['user']['username']		= $this->input->post('username',true);
				$data['user']['password']		= md5($this->input->post('password',true));
				$data['user']['first_name']	= $this->input->post('first_name',true); 
				$data['user']['last_name']		= $this->input->post('last_name',true);
				$data['user']['status']	= $this->input->post('status',true);
				$data['user_contact']['email']	= $this->input->post('email',true);
				$data['user_contact']['phone']	= $this->input->post('phone',true);
				
				
				if($this->recaptcha->verification()):
					
					$create_user = $this->user_model->insert($data['user']);
					$last_user_id = $this->db->insert_id();

					$data['user_contact']['user_id'] = $last_user_id;
					$create_user_contact = $this->user_contact_model->insert($data['user_contact']);
					
					$data['user_package']['user_id'] = $last_user_id;
					$create_user_package = $this->user_package_model->insert($data['user_package']);

					if($create_user && $create_user_contact && $create_user_package){
							redirect('/users/success');
					}else{
						print_r(validation_errors());
						//error_log("Un usuario no se pudo registrar");
					}
				else:
					
					$data['main_content'] = 'signup';
					$this->load->view('page', $data);
				endif;
			
			return;
		}
		$data['main_content'] = 'signup';
		$this->load->view('page', $data);
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}
	
		
}

?>