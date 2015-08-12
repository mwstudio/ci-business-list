<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class test extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('test_model');
    }

    function index() {
        $data['test'] = $this->test_model->get_all();
        $data['main_content'] = 'index';
        $this->load->view('page', $data);
    }

    function details($id){
        if(!isset($id))
            redirect('/test');

        $data['test'] = $this->test_model->get($id);
        $data['main_content'] = 'details';
        $this->load->view('page', $data);
    }

    function success(){
        $data['main_content'] = 'success';
        $this->load->view('page', $data);   
    }

    function add(){
        
        if($_POST):
            $data = $this->_post_data();
            $create = $this->test_model->insert($data['test']);
            if($create):
                redirect('/test/success');
            else:
                print_r(validation_errors());
            endif;
        endif;

        $data['main_content'] = 'add';
        $this->load->view('page', $data);
    }

    

    function _post_data(){
        
        $data['test'] = array();
        return $data;
    }
}
