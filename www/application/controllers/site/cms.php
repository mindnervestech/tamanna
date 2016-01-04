<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * CMS related functions
 * @author Teamtweaks
 *
 */

class Cms extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
    }
    
	public function index(){
    	$seourl = $this->uri->segment(2);
		$pageDetails = $this->product_model->get_all_details(CMS,array('seourl'=>$seourl,'status'=>'Publish'));
    	if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		if ($pageDetails->row()->meta_title != ''){
	    		$this->data['heading'] = $pageDetails->row()->meta_title;
				$this->data['meta_title'] = $pageDetails->row()->meta_title;
			}
			if ($pageDetails->row()->meta_tag != ''){
		    	$this->data['meta_keyword'] = $pageDetails->row()->meta_tag;
			}
			if ($pageDetails->row()->meta_description != ''){
		    	$this->data['meta_description'] = $pageDetails->row()->meta_description;
			}
    		$this->data['heading'] = $pageDetails->row()->meta_title;
    		$this->data['pageDetails'] = $pageDetails;
    		$this->load->view('site/cms/display_cms',$this->data);
    	}
    }
    
	public function page_by_id(){
    	$cid = $this->uri->segment(2);
		$pageDetails = $this->product_model->get_all_details(CMS,array('id'=>$cid,'status'=>'Publish'));
    	if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		if ($pageDetails->row()->meta_title != ''){
	    		$this->data['heading'] = $pageDetails->row()->meta_title;
				$this->data['meta_title'] = $pageDetails->row()->meta_title;
			}
			if ($pageDetails->row()->meta_tag != ''){
		    	$this->data['meta_keyword'] = $pageDetails->row()->meta_tag;
			}
			if ($pageDetails->row()->meta_description != ''){
		    	$this->data['meta_description'] = $pageDetails->row()->meta_description;
			}
    		$this->data['heading'] = $pageDetails->row()->meta_title;
    		$this->data['pageDetails'] = $pageDetails;
    		$this->load->view('site/cms/display_cms',$this->data);
    	}
    }
	public function contactus(){
			$this->data['heading'] = 'Socktail Customer Support | Contact Us - Socktail.com';
			$this->data['meta_title'] = 'Socktail Customer Support | Contact Us - Socktail.com';
			$this->data['meta_description'] = 'Contact Socktail Customer Support at contact@socktail.com for your inquiries or suggestions. We will be happy to help you.';
    	    $this->load->view('site/cms/contactus',$this->data);
	}
	public function whyus(){
			$this->data['heading'] = 'Why Buy on Socktail?';
			$this->data['meta_title'] = 'Why Buy on Socktail?';
			$this->data['meta_description'] = 'Socktail.com: Answers of Frequently Asked Quetions';
  
    	    $this->load->view('site/cms/whyus',$this->data);
	}
	public function showcase(){
			$this->data['heading'] = 'Sell on Socktail';
			$this->data['meta_title'] = 'Socktail Local Marketplace: Sell your creations on Socktail';
			$this->data['meta_description'] = 'Generate more leads by showcasing your products on Socktail - A One Stop Shop for Home Improvement';
  
    	    $this->load->view('site/cms/showcase',$this->data);
	}
	
}
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */