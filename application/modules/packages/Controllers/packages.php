<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Packages_model');
        $this->load->module("users");
        $this->load->library('form_validation');
        $this->load->helper('url');
        
    }

    function index(){
        $data["packages"] = $this->Packages_model->get_all();
        if($this->users->my_package_id())
            $data['my_package_id'] = $this->users->my_package_id()->package_id;
        else
            $data['my_package_id'] = 0;
        $data['main_content'] = 'index';
        
        $this->load->view('page', $data);
    }

    function activate($package_id){
        if(!$package_id)
            redirect('/packages');

        if(!$this->users->_is_logged_in())
            redirect('/signin/?redirect='.current_url());

        $data['package_id'] = $package_id;
        $where['user_id'] = $this->session->userdata('userid');
        $update = $this->users->_package_activation($where, $data);
        
        if ($update) {
            redirect('/');
        }
    }
}
