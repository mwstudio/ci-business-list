<?php
/*
Author: Daniel Gutierrez
Date: 9/18/12
Version: 1.0
*/

class User_model extends MY_Model {

    public $_table = 'tbl_user';
    public $primary_key = 'id';

    public $protected_attributes = array( 'id' );

    public $belongs_to = array(
      'contact' => array(
        'model' => 'User_contact_model', 
        'primary_key' => 'id' 
      ),
      'package' => array(
        'model' => 'User_package_model', 
        'primary_key' => 'id'
      ),
    );

    //public $belongs_to = array( 'tbl_user_package' );
    //public $has_many = array( 'gallery' );
    
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
        
        array( 'field' => 'first_name', 
               'label' => 'first name',
               'rules' => 'trim|required|min_length[3]|max_length[50]' ),
        
        array( 'field' => 'last_name', 
               'label' => 'last name',
               'rules' => 'trim|required|min_length[3]|max_length[50]' ),

        array( 'field' => 'username', 
               'label' => 'username',
               'rules' => 'trim|required|is_unique[tbl_user.username]' ),

        array( 'field' => 'password',
               'label' => 'password',
               'rules' => 'trim|required' ),
        
    );

    
	
		
}

?>