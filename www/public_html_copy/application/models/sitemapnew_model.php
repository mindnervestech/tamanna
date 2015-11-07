<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Sitemapnew_model extends My_Model
{
	public function get_things(){
		$get = 'SELECT seourl, id FROM '.PRODUCT;
		return $this->ExecuteQuery($get);
	}

	public function get_users(){
		$sel = 'SELECT user_name FROM '.USERS;
		return $this->ExecuteQuery($sel);
	}

	public function get_category(){
		$sel = 'SELECT seourl FROM '.CATEGORY;
		return $this->ExecuteQuery($sel);
	}

	public function get_static_page(){
		$sel = 'SELECT seourl FROM '.CMS.' WHERE hidden_page = "no"';
		return $this->ExecuteQuery($sel);
	}

	public function get_user_product(){
		$get_u_p = 'SELECT u.user_name, up.seller_product_id, up.seourl 
		FROM '.USERS.' u, '.USER_PRODUCTS.' up WHERE u.id = up.user_id';
		return $this->ExecuteQuery($get_u_p);
	}

}


?>