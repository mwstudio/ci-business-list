<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['main_content'] = 'index';
        $this->load->view('page', $data);
    }
}
