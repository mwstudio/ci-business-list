<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Packages_model extends MY_Model {
    public $_table = 'tbl_packages';
    public $primary_key = 'id';

    public $protected_attributes = array( 'id' );
}
