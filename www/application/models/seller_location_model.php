<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to seller location
 * @author swapnil nale
 *
 */
class seller_location_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	function get_sellerlocation_details(){
		$Query = " select * from ".SELLER_LOCATION;
   		return $this->ExecuteQuery($Query);
	}
	function get_sellerlocation_byId($id){
		$Query = " select * from ".SELLER_LOCATION.' where id='.$id;
   		return $this->ExecuteQuery($Query);
	}

}