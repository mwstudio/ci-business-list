<?php
/*
Author: Daniel Gutierrez
Date: 9/18/12
Version: 1.0
*/

class Home extends MY_Controller{

	function index(){
		$data['main_content'] = 'index';
		$this->load->view('page', $data);
	}
		
}

?>