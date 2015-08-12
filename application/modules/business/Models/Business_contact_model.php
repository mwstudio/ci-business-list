<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Business_contact_model extends MY_Model {

    public $_table = 'tbl_business_contact';
    public $primary_key = 'id';

    public $protected_attributes = array( 'id' );
    
    public $validate = array(

        array( 'field' => 'email', 
               'label' => 'email',
               'rules' => 'trim|required|min_length[3]|max_length[150]|valid_email' ),
        
        array( 'field' => 'contact_person', 
               'label' => 'contact person',
               'rules' => 'trim|required|min_length[3]|max_length[100]' ),
        
    );
    
}
