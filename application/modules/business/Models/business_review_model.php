<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Business_review_model extends MY_Model {
    public $_table = 'tbl_business_review';
    public $primary_key = 'id';

    public $protected_attributes = array( 'id' );
    
    public $validate = array(

        array( 'field' => 'comment', 
               'label' => 'comment',
               'rules' => 'trim|required|min_length[3]|max_length[300]' ),
        
        array( 'field' => 'email', 
               'label' => 'email',
               'rules' => 'trim|required|min_length[3]|max_length[100]|valid_email' ),
        
    );
}
