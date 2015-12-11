<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Ideas extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('seller_location_model');
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
    
	
	public function search_shopby_things(){
		$searchResult = explode('?',$_SERVER['REQUEST_URI']);
		$searchCriteriaArr = explode('/',$searchResult[0]);
		$searchCriteria = $searchCriteriaArr[count($searchCriteriaArr)-1];
		
		$searchCriteriaBreadCump = explode('shopby/',$searchResult[0]);
		$searchCriteriaBreadCumpFinal = explode('shopby/',$searchCriteriaBreadCump[1]);
		
//		if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.1.253') {
//			$urlVal = str_replace('fancyclone/','', $_SERVER['REQUEST_URI']);
//		} else {
			$urlVal = $_SERVER['REQUEST_URI'];
//		}
		$urlVal = substr($urlVal, strpos($urlVal, '/shopby'));
		
		$completeQury = $urlVal = substr($urlVal,1);
		
		$urlValArrVal = explode('?',$urlVal);
		
		$urlVal = $urlValArrVal[0];
		
		$searchResultPg = explode('?pg=', $searchResult[1]);
		
		if($searchResult[1] != ''){
			$finalValQry1 = '?'.$searchResult[1];
			$finalValQry = $urlVal.$finalValQry1;
			$finalValQryArr =explode('&pg=',$finalValQry);
			$finalValQry = $finalValQryArr[0].'&pg';
		} else {
			$finalValQry = $urlVal	.'?pg';
		}
		
		$newPage = 1;
		if($this->input->get('pg') != ''){
				$paginationVal = $this->input->get('pg')*20;
				$limitPaging = ' limit '.$paginationVal.',20 ';
		} else {
				$limitPaging = ' limit 0,20';
		}
		
		
		
		$newPage = $this->input->get('pg')+1;
		$paginationDisplay  = '<a title="'.$newPage.'" class="btn-more" href="'.base_url().$finalValQry.'='.$newPage.'" style="display: none;">See More Products</a>'; 
		$this->data['paginationDisplay'] = $paginationDisplay;
		unset($_SERVER['REQUEST_URI']);				

				
		$this->session->unset_userdata('sSearchCondition','');
		$this->session->unset_userdata('sSearchQueryString','');
		$this->session->set_userdata('sSearchCondition',$urlValArrVal[0]);
		$this->session->set_userdata('sSearchQueryString',$urlValArrVal[1]);
		//print_r($_SESSION);die;	
		
		$breadCumps .= '<a class="shop-home" href="'.base_url().'design-ideas/all"  itemprop="url">Explore</a>';
		
			if($searchCriteria != 'all') {
				$condition = " where c.seourl = '".$searchCriteria."'";
				$catID = $this->product_model->getCategoryValues(' c.*,sbc.id as subcat_id,sbc.seourl as subcat_seourl,sbc.cat_name as subcat_sub_cat_name ',$condition);
				$listSubCat = $catID->result();
				$listSubCatSelBox = '<select style="display: none;" class="shop-select sub-category selectBox" edge="true">
	              <option value="">'.$catID->row()->cat_name.'</option>';
				foreach ($listSubCat as $listSub){ 
					$listSubCatSelBox.= '<option value="'.base_url().$urlVal.'/'.$listSub->subcat_seourl.'">'.$listSub->subcat_sub_cat_name.'</option>';
				}
				$listSubCatSelBox.= '</select>';
				
				$searchCriteriaBreadCumpArr = @explode('/',trim($searchCriteriaBreadCumpFinal[0]));
				
				if(count($searchCriteriaBreadCumpArr)>1) {
					$link_str = base_url().'design-ideas';
					for($i=0;$i<count($searchCriteriaBreadCumpArr);$i++) {
						if($searchCriteriaBreadCumpArr[$i]) {
							$condition = " where c.seourl = '".$searchCriteriaBreadCumpArr[$i]."' limit 0,1";
							$Paging = $this->product_model->getCategoryValues(' c.*',$condition);
							$link_str .= '/'.$Paging->row()->seourl;
	 				        $breadCumps .=  '/ <a href="'.$link_str.'" itemprop="url">'.$Paging->row()->cat_name.'</a>';
						}
					}
				} else {
 				        $breadCumps .=  '/ <a href="'.base_url().'design-ideas/'.$catID->row()->seourl.'" itemprop="url">'.$catID->row()->cat_name.'</a>';
					
				}
			} else {
$urlVal = str_replace('/all','',$urlVal);
$listSubCatSelBox = '<select style="display: none;" class="shop-select sub-category selectBox" edge="true">
             <option value="">All Category</option>';
foreach ($_SESSION['sMainCategories']->result() as $listSub){
if($listSub->cat_name != 'Our Picks'){
$listSubCatSelBox.= '<option
value="'.base_url().$urlVal.'/'.$listSub->seourl.'">'.$listSub->cat_name.'</option>';
}
}
$listSubCatSelBox.= '</select>';
			}
		//	$breadCumps .= '</ul>';
			$this->data['listSubCatSelBox'] = $listSubCatSelBox;
			$this->data['breadCumps'] = $breadCumps;
			
			
			
			if($this->input->get('p')){
				$selling_price = $this->input->get('p');
				$selling_price = explode('-', $selling_price);
				$selling_price1 = $selling_price[0];
				$selling_price2 = $selling_price[1];
				if($selling_price2 == ''){
					$userWherCond .= ' and ( p.sale_price > "'.$selling_price1.'")'; 
				}else{
                    $userWherCond .= ' and ( p.sale_price > "'.$selling_price1.'" and p.sale_price < "'.$selling_price2.'" )'; 
				}
			}

			if($this->input->get('q')){
				$userWherCond .= ' and p.product_name LIKE "%'.$this->input->get('q').'%"';
			}
			
			if($this->input->get('c')){
				$condition = " where list_value_seourl = '".$this->input->get('c')."'";
				$listID = $this->category_model->getAttrubteValues($condition);
				$userWherCond .= ' and FIND_IN_SET("'.$listID->row()->id.'",p.list_value)';
			}
			$sortbylocation = '';
			if($this->input->get('sort_by_location')){
				$sortbylocation = ' and u.s_city='.$this->input->get('sort_by_location');
			}
			
			if($this->input->get('sort_by_price')){
				($this->input->get('sort_by_price') == 'desc') ? $orderbyVal = $this->input->get('sort_by_price') : $orderbyVal ='';
				if($sortbylocation == ''){
					$orderBy = ' order by distance asc,p.sale_price '.$orderbyVal.'';
				}else{
					$orderBy = $sortbylocation.' order by p.sale_price';
				}
			}else {
				if($sortbylocation == ''){				
					$orderBy = ' order by distance asc,p.created desc';
				}else{
					$orderBy = $sortbylocation.' order by p.created desc';
				}

			}
			if($searchCriteria != 'all') {
				$userWherCond .= ' where FIND_IN_SET("'.$catID->row()->id.'",p.category_id) '.$userWherCond.' and p.status="Publish" and p.sale_price>0 and u.status="Active" and p.status="Publish" and p.global_visible=1';
				$userWherCond = $userWherCond.' '.$orderBy.' '.$limitPaging.' ';
				$totalProd = $userWherCond.' '.$orderBy.' '.$limitPaging.' ';
			} else {
				$userWherCond .= ' where p.id !="" '.$userWherCond.' and p.status="Publish" and u.status="Active" and p.status="Publish" and p.sale_price>0 and p.global_visible=1';
				$userWherCond = $userWherCond.' '.$orderBy.' '.$limitPaging.' ';
				$totalProd = $userWherCond.' '.$orderBy.' '.$limitPaging.' ';
			}
			$userproductList = $this->product_model->searchShopyByCategoryuser($userWherCond);
			
			$this->data['userproductList'] = $userproductList;
			$this->data['heading'] = 'Explore Products Available In Your City with Local Vendors';
			$this->data['meta_title'] = 'Buy Furniture from Local Vendors in Your City';
			$this->data['meta_description'] = 'Local Discovery of Furniture: Check What Products Are Available in Your City';
			if($searchCriteria != 'all') {
				if ($catID->row()->cat_name != ''){
					$this->data['heading'] = $catID->row()->cat_name;
				}
				if ($catID->row()->seo_title != ''){
					$this->data['meta_title'] = $catID->row()->seo_title;
				}
				if ($catID->row()->seo_keyword != ''){
			    	$this->data['meta_keyword'] = $catID->row()->seo_keyword;
				}
				if ($catID->row()->seo_description != ''){
			    	$this->data['meta_description'] = $catID->row()->seo_description;
				}
			}
			$this->data['locations'] = $this->seller_location_model->get_sellerlocation_details();
			$this->load->view('site/ideas/ideas',$this->data);
	}
	
	public function search_priceby(){
		$lid = $this->uri->segment('3','0');
		$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$lid));
		$searchArr = array_filter(explode(',', $list_details->row()->products));
		if (count($searchArr)>0){
			$condition = ' where p.id in ('.implode(',', $searchArr).') and p.quantity>0 and p.status="Publish" and u.group="Seller" and u.status="Active" or p.id in ('.implode(',', $searchArr).') and p.status="Publish" and p.quantity > 0 and p.user_id=0 limit 20';
			$usercondition = ' where p.id in ('.implode(',', $searchArr).') and p.status="Publish" and u.status="Active" or p.id in ('.implode(',', $searchArr).') and p.global_visible=1 order by p.created desc limit 20';
			$this->data['product_details'] = $product_details = $this->product_model->view_product_details($condition);
			$this->data['userproduct_details'] = $userproduct_details = $this->product_model->view_product_details_user($usercondition);
			$this->data['totalProducts'] = ($product_details->num_rows() + $userproduct_details->num_rows());
		}else {
			$this->data['product_details'] = '';
			$this->data['totalProducts'] = 0;
		}
		$this->load->view('site/product/list_home',$this->data);
	}
	
	public function ajax_load_more_price(){
		$pageloaded = $this->input->post('group_no');
		$limit = 20;
		$start = $limit*$pageloaded;
		$limitStr = $start.','.$limit;
		$lid = $this->input->post('lid');
		$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$lid));
		$searchArr = explode(',', $list_details->row()->products);
		$searchIds = '';
		if (count($searchArr)>0){
			foreach ($searchArr as $searchRow){
				if ($searchRow != ''){
					$searchIds .= $searchRow.',';
				}
			}
			$searchIds = substr($searchIds, 0,-1);
		}
		$Query = 'select p.*,u.user_name,u.full_name from '.PRODUCT.' p 
					JOIN '.USERS.' u on u.id=p.user_id 
					where p.id in ('.$searchIds.') and p.quantity>0 and p.status="Publish" and u.group="Seller" and u.status="Active" 
					or p.id in ('.$searchIds.') and p.status="Publish" and p.quantity > 0 and p.user_id=0 
					limit '.$limitStr;
		$this->data['product_details'] = $product_details = $this->product_model->Executequery($Query);
		$resultVal = '';
		if ($product_details->num_rows()>0){
			foreach ($product_details->result() as $productRow){
				$imgArr = explode(',', $productRow->image);
          		$img = 'dummyProductImage.jpg';
          		foreach ($imgArr as $imgVal){
          			if ($imgVal != ''){
						$img = $imgVal;
						break;
          			}
          		}
          		$fancyClass = 'fancy';
          		$fancyText = LIKE_BUTTON;
          		if (count($this->data['likedProducts'])>0 && $this->data['likedProducts']->num_rows()>0){
          			foreach ($this->data['likedProducts']->result() as $likeProRow){
          				if ($likeProRow->product_id == $productRow->seller_product_id){
          					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
          				}
          			}
          		}
				$resultVal .= '<li id="stream-first-item_" tid="'.$productRow->id.'">
				<div class="figure-item">
					<a href="things/'.$productRow->id.'/'.url_title($productRow->product_name,'-').'" class="figure-img" rel="thing-371468102820434791">
						<span class="figure grid" style="background-size: cover; background-image:url(images/product/'.$img.')" data-ori-url="images/product/'.$img.'" data-310-url="images/product/'.$img.'"><em class="back"></em></span>
							<span class="figure vertical">
								<em class="back"></em>
								
								<img src="images/product/'.$img.'" data-width="310" data-height="310">
								
							</span>
						<span class="figcaption">'.$productRow->product_name.'</span>
					</a>
					<em class="figure-detail">
						
						<span class="price">'.$this->data['currencySymbol'].''.$productRow->sale_price.' <small>'.$this->data['currencyType'].'</small></span>
						
						
						<span class="username"><em><i>.</i><a href="';if ($productRow->user_id != '0'){$resultVal .= base_url().'user/'.$productRow->user_name;}else {$resultVal .= base_url().'user/administrator';}$resultVal .= '">';if ($productRow->user_id != '0'){$resultVal .= $productRow->full_name;}else {$resultVal .= 'administrator';}$resultVal.='</a>  + '.$productRow->likes.'</em></span>
						
					</em>
					<ul class="function">
						<li class="list"><a href="#">Add to List</a></li>
						<li class="cmt"><a href="#">Comment</a></li>
						<li class="share"><button type="button" ';if ($this->data['loginCheck']==''){$resultVal .= 'require_login="true"'; }$resultVal .= ' data-timage="images/product/'.$img.'" class="btn-share" uid="'.$this->data['loginCheck'].'" tid="'.$productRow->id.'" tname="'.$productRow->product_name.'" username="';if ($productArr[$i]['user_id'] != '0'){$resultVal .= $productArr[$i]['full_name'];}else {$resultVal .= 'administrator';}$resultVal .= '" action="buy"><i class="ic-share"></i></button></li>
						<li class="view-cmt"><a href="#">5 comments</a></li>
					</ul>

					
					<a href="#" item_img_url="images/product/'.$img.'" tid="'.$productRow->seller_product_id.'" class="button '.$fancyClass.'" ';if ($this->data['loginCheck']==''){$resultVal .= 'require_login="true"'; }$resultVal .= '><span><i></i></span> '.$fancyText.'</a> 
					


					
				</div>
			</li>';
			}
		}
		echo $resultVal;
	}
	
	public function search_colorby(){
		$lid = $this->uri->segment('3','0');
		$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$lid));
		$searchArr = array_filter(explode(',', $list_details->row()->products));
		if (count($searchArr)>0){
			$condition = ' where p.id in ('.implode(',', $searchArr).') and p.quantity>0 and p.status="Publish" and u.group="Seller" and u.status="Active" or p.id in ('.implode(',', $searchArr).') and p.status="Publish" and p.quantity > 0 and p.user_id=0 limit 20';
			$usercondition = ' where FIND_IN_SET("'.$lid.'",p.list_value) and p.status="Publish" and u.status="Active" or FIND_IN_SET("'.$lid.'",p.list_value) and p.global_visible=1 order by p.created desc limit 20';
			$this->data['product_details'] = $product_details = $this->product_model->view_product_details($condition);
			$this->data['userproduct_details'] = $userproduct_details = $this->product_model->view_product_details_user($usercondition);
			$this->data['totalProducts'] = ($product_details->num_rows() + $userproduct_details->num_rows());
		}else {
			$this->data['product_details'] = '';
			$this->data['totalProducts'] = 0;
		}
		$this->load->view('site/product/list_color_home',$this->data);
	}
	
	public function search_priceby_followers(){
		$lid = $this->uri->segment('3','0');
		$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$lid));
		$fieldsArr = '*';
		$searchArr = explode(',', $list_details->row()->followers);
		$this->data['user_details'] = $user_details = $this->product_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
		if ($user_details->num_rows()>0){
			foreach ($user_details->result() as $userRow){
				$fieldsArr = array(PRODUCT_LIKES.'.*',PRODUCT.'.product_name',PRODUCT.'.image');
				$searchArr = array($userRow->id);
				$joinArr1 = array('table'=>PRODUCT,'on'=>PRODUCT_LIKES.'.product_id='.PRODUCT.'.seller_product_id','type'=>'');
				$joinArr = array($joinArr1);
				$sortArr1 = array('field'=>PRODUCT.'.created','type'=>'desc');
				$sortArr = array($sortArr1);
				$this->data['product_details'][$userRow->id] = $this->product_model->get_fields_from_many(PRODUCT_LIKES,$fieldsArr,PRODUCT_LIKES.'.user_id',$searchArr,$joinArr,$sortArr,'5');
			}
		}
		$this->load->view('site/product/list_priceby_followers',$this->data);
	}
	
	public function search_colorby_followers(){
		$lid = $this->uri->segment('3','0');
		$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$lid));
		$fieldsArr = '*';
		$searchArr = explode(',', $list_details->row()->followers);
		$this->data['user_details'] = $user_details = $this->product_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
		if ($user_details->num_rows()>0){
			foreach ($user_details->result() as $userRow){
				$fieldsArr = array(PRODUCT_LIKES.'.*',PRODUCT.'.product_name',PRODUCT.'.image');
				$searchArr = array($userRow->id);
				$joinArr1 = array('table'=>PRODUCT,'on'=>PRODUCT_LIKES.'.product_id='.PRODUCT.'.seller_product_id','type'=>'');
				$joinArr = array($joinArr1);
				$sortArr1 = array('field'=>PRODUCT.'.created','type'=>'desc');
				$sortArr = array($sortArr1);
				$this->data['product_details'][$userRow->id] = $this->product_model->get_fields_from_many(PRODUCT_LIKES,$fieldsArr,PRODUCT_LIKES.'.user_id',$searchArr,$joinArr,$sortArr,'5');
			}
		}
		$this->load->view('site/product/list_colorby_followers',$this->data);
	}
	
	public function follow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_giftguide_lists);
			if (!in_array($lid, $oldDetails)){
				array_push($oldDetails, $lid);
			}
			if (!in_array($this->checkLogin('U'), $followersArr)){
				array_push($followersArr, $this->checkLogin('U'));
				$followersCount++;
			}
			$this->product_model->update_details(USERS,array('following_giftguide_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LIST_VALUES,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}
	
	public function unfollow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_giftguide_lists);
			if (in_array($lid, $oldDetails)){
				if ($key = array_search($lid, $oldDetails) !== false){
					unset($oldDetails[$key]);
				}
			}
			if (in_array($this->checkLogin('U'), $followersArr)){
				if ($key = array_search($this->checkLogin('U'), $followersArr) !== false){
					unset($followersArr[$key]);
				}
				$followersCount--;
			}
			$this->product_model->update_details(USERS,array('following_giftguide_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LIST_VALUES,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}
	
	public function search_suggestions(){
		$search_key = $this->input->get('q');
		$returnStr['things'] = '<h4>Suggested Products</h4>';
		if ($search_key != ''){
			$productDetails = $this->product_model->get_products_search_results($search_key);
			$userproductDetails = $this->product_model->get_user_products_search_results($search_key);
			if ($productDetails->num_rows()>0 || $userproductDetails->num_rows()>0){
				$returnStr['things'] .='
					<ul class="thing" style="display: block;">
				';
				foreach ($productDetails->result()as $productRow){
					$returnStr['things'] .='
					<li>
						<a href="things/'.$productRow->id.'/'.url_title($productRow->product_name,'-').'">'.$productRow->product_name.'</a>
					</li>
					';
				} 
				foreach ($userproductDetails->result()as $userproductRow){
					$returnStr['things'] .='
					<li>
						<a href="user/'.$userproductRow->user_name.'/things/'.$userproductRow->seller_product_id.'/'.$userproductRow->seourl.'">'.$userproductRow->product_name.'</a>
					</li>
					';
				}
				$returnStr['things'] .='
					</ul>
				';
			}
			$userDetails = $this->product_model->get_user_search_results($search_key);
			if ($userDetails->num_rows()>0){
				$returnStr['things'] .='
					<h4>Suggested Users</h4><ul class="user" style="display: block;">
				';
				foreach ($userDetails->result()as $userRow){
					$userImg = 'user-thumb1.png';
					if ($userRow->thumbnail != ''){
						$userImg = $userRow->thumbnail;
					}
					$returnStr['things'] .='
					<li>
						<a href="user/'.$userRow->user_name.'"><img src="images/users/'.$userImg.'" alt="'.$userRow->full_name.'" class="photo"> <b>'.$userRow->full_name.'</b> ('.$userRow->user_name.')</a>
					</li>
					';
				} 
				$returnStr['things'] .='
					</ul>
				';
			}
		}
		$returnStr['things'] .= '
				<a href="'.base_url().'shopby/all?q='.$search_key.'" class="more hover">See full search results</a>
				';
		echo json_encode($returnStr);
	}
	
	
	/**
	 * Resetting product counts for all lists
	 */
	public function reset_counts(){
		
		// Empty the product ids and makes count as zero in list table
		$this->product_model->empty_pid_list();
		
		// Insert product ids and update count in list table
		$productList = $this->product_model->get_all_details(PRODUCT,array('sale_price >'=>'0'));
		$price_range_arr = array('1-20','21-100','101-200','201-500','501+');
		foreach ($price_range_arr as $price_range_row){
			$price_range['pid'][$price_range_row] = array();
			$price_range['count'][$price_range_row] = '0';
		}
		if ($productList->num_rows()>0){
			foreach ($productList->result() as $product_row){
				array_push($price_range['pid'][$product_row->price_range],$product_row->id);
				$price_range['count'][$product_row->price_range]++;
			}
		}
		foreach ($price_range_arr as $price_range_row){
			$dataArr = array(
			'products'=>implode($price_range['pid'][$price_range_row],','),
			'product_count'=>$price_range['count'][$price_range_row]
			);
			$condArr = array(
			'list_id'=>'2',
			'list_value'=>$price_range_row
			);
			$this->product_model->update_details(LIST_VALUES,$dataArr,$condArr);
		}
		echo 'Counts reset success';		
	}
	
}
/*End of file product.php */
/* Location: ./application/controllers/site/product.php */