<?php
/*
Author: Daniel Gutierrez
Date: 9/18/12
Version: 1.0
*/

class Menu_model extends CI_Model{
	
	function create(){
		
	}
	
	function read(){
		//Just a prototype
		$menu = array();
		
		$menu[0] = new stdClass();
		$menu[0]->url = "";
		$menu[0]->name = "Home";
		
		$menu[1] = new stdClass();
		$menu[1]->url = "users";
		$menu[1]->name = "Users";

		$menu[2] = new stdClass();
		$menu[2]->url = "packages";
		$menu[2]->name = "Packages";

		$menu[3] = new stdClass();
		$menu[3]->url = "business";
		$menu[3]->name = "Business";

		$menu[4] = new stdClass();
		$menu[4]->url = "about";
		$menu[4]->name = "About";
		
		return $menu;
	}
	
	function menu_admin(){
		//Just a prototype

		$menu = new stdClass();
		$menu->url = "admin";
		$menu->name = "Admin";

		return $menu;
	}
	
	function update(){
		
	}
	
	function delete(){
		
	}
	
	
		
}

?>