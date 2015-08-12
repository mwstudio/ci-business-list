<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Business extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Business_model');
        $this->load->model('Business_contact_model');
        $this->load->model('Business_review_model');
        $this->load->module("users");
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    function index() {
        $data['business'] = $this->Business_model->with('contact')->with('user')->with('review')->get_all();
        
        foreach ($data['business'] as $key=>$item) {
            $data['rate'] = 0;
            $data['total_review'] = 0;
            
            foreach ($item->review as $review) {
                $data['total_review'] += 1; 
                $data['rate'] += $review->rating;
            }
            
            if($data['rate'] != 0 || $data['total_review'] != 0):
                $data['avg'] = $data['rate']/$data['total_review'];
                $data['business'][$key]->rating = round($data['avg']);
                $data['business'][$key]->total_review = $data['total_review'];
            else:
                $data['business'][$key]->rating = 0;
            endif;
        }
        //exit;
        //echo json_encode($data);exit;
        $data['main_content'] = 'index';
        $this->load->view('page', $data);
    }

    function details($id){
        if(!isset($id))
            redirect('/business');

        $data['business'] = $this->Business_model->with('contact')->with('user')->with('review')->get($id);
        //echo json_encode($data);exit;
        $data['rate'] = 0;
        $data['total_review'] = 0;
        
        foreach ($data['business']->review as $review) {
            $data['total_review'] += 1; 
            $data['rate'] += $review->rating;
        }
        if($data['rate'] != 0 || $data['total_review'] != 0):
        $data['avg'] = $data['rate']/$data['total_review'];
        $data['rating'] = round($data['avg']);
        else:
                $data['rating'] = 0;
        endif;

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
            $create_business = $this->Business_model->insert($data['business']);

            $data['contact']['business_id'] = $this->db->insert_id();
            $create_business_contact = $this->Business_contact_model->insert($data['contact']);
            
            if($create_business && $create_business_contact):
                redirect('/business/success');
            else:
                print_r(validation_errors());
            endif;
        endif;

        $data['main_content'] = 'add';
        $this->load->view('page', $data);
    }

    function comment(){
        if($this->input->is_ajax_request()):
            
            if($_POST):
                if(!$this->users->_is_logged_in()){
                    echo json_encode(array("error"=>"login", "success" =>FALSE, "post" => $_POST));
                    exit;
                }
                if(!$this->input->post('id') || !$this->input->post('value')){
                    echo json_encode(array("error"=>"arg", "success" =>FALSE, "post" => $_POST));
                    exit;
                }

                $data = $this->_post_data();
                $rated = $this->Business_review_model->insert($data['review'], TRUE);
                if($rated)
                    echo json_encode(array("error"=>FALSE, "success" =>TRUE, "post" => null));
            endif;

        else:

            if(!$this->users->_is_logged_in())
                redirect('/signin/?redirect='.current_url());

            
            $data = $this->_post_data();
            $rated = $this->Business_review_model->insert($data['review'], TRUE);
            if($rated)
                redirect('/business');

        endif;
    }

    function _catagory_json(){
        
        $data['cats'] = array();
        $cat = 3;
        for($i=1;$i<=$cat;$i++):
            $data['cats'][] = 'category_'.$i;
        endfor;

        foreach ($data['cats'] as $key) {
            $data['categories'][] = array(
                'category' => $this->input->post($key,TRUE),
                'sub_category' => $this->input->post('sub_'.$key,TRUE)
            );
        }
        
        return(json_encode($data['categories']));
    }

    function _post_data(){
        
        $data['business']['user_id'] = $this->session->userdata('userid');
        $data['business']['category'] = $this->_catagory_json();
        $data['business']['company_name'] = $this->input->post('company_name', TRUE);
        $data['business']['description'] = $this->input->post('description', TRUE);
        
        $data['contact']['website'] = $this->input->post('website', TRUE);
        $data['contact']['phone'] = $this->input->post('phone', TRUE);
        $data['contact']['location'] = $this->input->post('location', TRUE);
        $data['contact']['sub_location'] = $this->input->post('sub_location', TRUE);
        $data['contact']['street'] = $this->input->post('street', TRUE);
        $data['contact']['email'] = $this->input->post('email', TRUE);
        $data['contact']['contact_person'] = $this->input->post('contact_person', TRUE);

        $data['review']['business_id'] = $this->input->post('business_id', TRUE);
        $data['review']['rating'] = $this->input->post('rating', TRUE);
        $data['review']['title'] = $this->input->post('title', TRUE);
        $data['review']['comment'] = $this->input->post('comment', TRUE);
        $data['review']['name'] = $this->input->post('name', TRUE);
        $data['review']['email'] = $this->input->post('email', TRUE);
        $data['review']['phone'] = $this->input->post('phone', TRUE);
        $data['review']['user_id'] = $this->session->userdata('userid');

        return $data;
    }
}
