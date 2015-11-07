<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Order management
 * @author Teamtweaks
 *
 */

class Order extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('order_model');
		if ($this->checkPrivileges('order',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}

	/**
	 *
	 * This function loads the order list page
	 */
	public function index(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/order/display_order_list');
		}
	}

	/**
	 *
	 * This function loads the order list page
	 */
	public function display_order_paid(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Order List';
			$this->data['orderList'] = $this->order_model->view_order_details('Paid');
			$this->load->view('admin/order/display_orders',$this->data);
		}
	}

	public function display_order_pending(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Order List';
			$this->data['orderList'] = $this->order_model->view_order_details('Pending');
			$this->load->view('admin/order/display_orders_pending',$this->data);
		}
	}

	public function subviewDetails(){

		echo $this->input->post('dealId');

	}


	/**
	 *
	 * This function loads the order view page
	 */
	public function view_order(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Order';
			$user_id = $this->uri->segment(4,0);
			$deal_id = $this->uri->segment(5,0);
			$this->data['ViewList'] = $this->order_model->view_orders_new($user_id,$deal_id);
			$this->load->view('admin/order/view_orders',$this->data);
		}
	}

	/**
	 *
	 * This function delete the order record from db
	 */
	public function delete_order(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$order_id = $this->uri->segment(4,0);
			$condition = array('id' => $order_id);
			$old_order_details = $this->order_model->get_all_details(PRODUCT,array('id'=>$order_id));
			$this->update_old_list_values($order_id,array(),$old_order_details);
			$this->update_user_order_count($old_order_details);
			$this->order_model->commonDelete(PRODUCT,$condition);
			$this->setErrorMessage('success','Order deleted successfully');
			redirect('admin/order/display_order_list');
		}
	}

	public function order_review(){
		if ($this->checkLogin('A')==''){
			show_404();
		}else {
			$dealCode = $this->uri->segment(2,0);
			//$order_details = $this->order_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
			$this->db->select('p.*,pAr.attr_name as attr_type,sp.attr_name');
			$this->db->from(PAYMENT.' as p');
			$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
			$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
			$this->db->where('p.status = "Paid" and p.dealCodeNumber = "'.$dealCode.'"');
			$order_details = $this->db->get();
				
			if ($order_details->num_rows()==0){
				show_404();
			}else {
				foreach ($order_details->result() as $order_details_row){
					$this->data['prod_details'][$order_details_row->product_id] = $this->order_model->get_all_details(PRODUCT,array('id'=>$order_details_row->product_id));
				}
				$this->data['order_details'] = $order_details;
				$this->data['heading'] = 'View Order Comments';
				$sortArr1 = array('field'=>'date','type'=>'desc');
				$sortArr = array($sortArr1);
				$this->data['order_comments'] = $this->order_model->get_all_details(REVIEW_COMMENTS,array('deal_code'=>$dealCode),$sortArr);
				$this->load->view('admin/order/display_order_reviews',$this->data);
			}
		}
	}


	public function post_order_comment(){
		if ($this->checkLogin('A') != ''){
			$this->order_model->commonInsertUpdate(REVIEW_COMMENTS,'insert',array(),array(),'');
		}
	}

	public function update_payment_type(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$payment_type = $this->input->post('payment_type');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('payment_type'=>$payment_type),array('id'=>$id));
			}
		}
	}
	public function update_vendor(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$vendor = $this->input->post('vendor');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('Vendor'=>$vendor),array('id'=>$id));
			}
		}
	}
	public function update_sell_id(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$sell_id= $this->input->post('sell_id');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('sell_id'=>$sell_id),array('id'=>$id));
			}
		}
	}
	public function update_courier_name(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$courier_name= $this->input->post('courier_name');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('courier_name'=>$courier_name),array('id'=>$id));
			}
		}
	}
	public function update_tracking_id(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$tracking_id= $this->input->post('tracking_id');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('tracking_id'=>$tracking_id),array('id'=>$id));
			}
		}
	}
	public function update_status(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$status= $this->input->post('status');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('status'=>$status),array('id'=>$id));
			}
		}
	}
	public function update_shipping_status(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$shipping_status= $this->input->post('shipping_status');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('shipping_status'=>$shipping_status),array('id'=>$id));
			}
		}
	}
	public function update_received_payment(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$received_payment = $this->input->post('received_payment');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('received_payment'=>$received_payment),array('id'=>$id));
			}
		}
	}
	public function update_exp_dispatch(){
		if ($this->checkLogin('A') != ''){
			$id = $this->input->post('id');
			$exp_dispatch = $this->input->post('exp_dispatch');
			if ($id != ''){
				$this->order_model->update_details(PAYMENT,array('exp_dispatch'=>$exp_dispatch),array('id'=>$id));
			}
		}
	}

}

/* End of file order.php */
/* Location: ./application/controllers/admin/order.php */