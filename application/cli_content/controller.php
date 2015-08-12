<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class {controller_name} extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('{controller_name}_model');
    }

    function index() {
        $data['{controller_name}'] = $this->{controller_name}_model->get_all();
        $data['main_content'] = 'index';
        $this->load->view('page', $data);
    }

    function details($id){
        if(!isset($id))
            redirect('/{controller_name}');

        $data['{controller_name}'] = $this->{controller_name}_model->get($id);
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
            $create = $this->{controller_name}_model->insert($data['{controller_name}']);
            if($create):
                redirect('/{controller_name}/success');
            else:
                print_r(validation_errors());
            endif;
        endif;

        $data['main_content'] = 'add';
        $this->load->view('page', $data);
    }

    

    function _post_data(){
        
        $data['{controller_name}'] = array();
        return $data;
    }
}
