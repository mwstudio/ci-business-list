<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Business_model extends MY_Model {

    public $_table = 'tbl_business';
    public $primary_key = 'id';

    public $protected_attributes = array( 'id' );

    public $belongs_to = array(
      'contact' => array(
        'model' => 'Business_contact_model', 
        'primary_key' => 'id' 
      ),
      'user' => array(
        'model' => 'users/User_model', 
        'primary_key' => 'user_id'
      ),
    );

    public $has_many = array(
        'review' => array(
            'model' => 'Business_review_model', 
            'primary_key' => 'business_id' 
          ),
    );
    
    public $before_create = array( 'created_at' );
    public $before_update = array( 'updated_at' );

    public function created_at($row)
    {
        $row['created'] = date('Y-m-d H:i:s');
        return $row;
    }

    public function updated_at($row)
    {
        $row['modified'] = date('Y-m-d H:i:s');
        return $row;
    }

    protected $soft_delete = TRUE;

    public $validate = array(

        array( 'field' => 'company_name', 
               'label' => 'company name',
               'rules' => 'trim|required|min_length[3]|max_length[150]' ),
        
        array( 'field' => 'description', 
               'label' => 'description',
               'rules' => 'trim|required|min_length[3]|max_length[250]' ),
        
    );
    
}
