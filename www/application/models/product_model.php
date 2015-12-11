<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to product management
 * @author Teamtweaks
 *
 */
class Product_model extends My_Model
{

	public function add_product($dataArr=''){
		$this->db->insert(PRODUCT,$dataArr);
	}

	public function add_subproduct_insert($dataArr=''){
		$this->db->insert(SUBPRODUCT,$dataArr);
	}

	public function edit_product($dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update(PRODUCT,$dataArr);
	}

	public function edit_subproduct_update($dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update(SUBPRODUCT,$dataArr);
	}

	public function view_product($condition=''){
		return $this->db->get_where(PRODUCT,$condition);
			
	}

	public function view_affliated($condition=''){
		return $this->db->get_where(USER_PRODUCTS,$condition);
			
	}

	public function view_affiliate_product($condition=''){
		return $this->db->get_where(USER_PRODUCTS,$condition);
			
	}

	public function view_product_details_affiliate($condition = '', $user_condition = ''){
		$select_qry = "(select 
			p.seller_product_id,
			p.image,p.sale_price,p.id,p.product_name,p.likes,p.web_link,p.created AS created_t,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".PRODUCT." p
		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition.")";

		$select_user_qry = "(select p.seller_product_id,p.image,p.sale_price,p.id,p.product_name,p.likes,p.web_link,p.created AS created_t,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$user_condition.")";

		$query = $select_qry." UNION ALL ".$select_user_qry." order by created_t desc";

		$productList = $this->ExecuteQuery($query);
		return $productList;
			
	}
	public function view_product_details($condition = ''){
		$select_qry = "select p.*,u.full_name,u.user_name,sh.short_url,u.email as selleremail,u.id as sellerid,u.thumbnail,u.feature_product, lv.list_value as listvalue from ".PRODUCT." p
		LEFT JOIN ".USERS." u on (u.id=p.user_id) 
		LEFT JOIN ".SHORTURL." sh on (sh.id=p.short_url_id)
                LEFT JOIN ".LIST_VALUES." lv on (lv.id=p.list_value)
		".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	public function view_product_details_user($condition = ''){
		$select_qry = "select 
			p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;

		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}

	public function view_follow_list($id=''){

		$getfollow = $this->db->query("SELECT ".LISTS_DETAILS.".*, ".USERS.".`user_name` as pname FROM ".LISTS_DETAILS." JOIN ".USERS." ON ".USERS.".`id` = ".LISTS_DETAILS.".`user_id` WHERE  FIND_IN_SET($id,".LISTS_DETAILS.".followers)");

		return $getfollow;
			
	}




	public function get_allcatProd_details($condition = ''){
		$select_qry = "select p.*,c.cat_name from ".PRODUCT." p
		LEFT JOIN ".CATEGORY." c on (c.id=p.category_id) where p.id=".$condition." and p.status='Active'";
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}

	public function product_feedback_view($seller_id){
		if ($seller_id == '')$seller_id=0;
		/*$select_qry = "select * from ".PRODUCT." where user_id='".$userid."'";
		 $attList = $this->ExecuteQuery($select_qry);
		 return  $attList->result_array();*/

		$this->db->select(array(PRODUCT_FEEDBACK.'.*',USERS.'.full_name',USERS.'.user_name',USERS.'.thumbnail',PRODUCT.'.product_name',PRODUCT.'.image'));
		$this->db->from(PRODUCT_FEEDBACK);
		$this->db->join(USERS, USERS.'.id = '.PRODUCT_FEEDBACK.'.voter_id');
		$this->db->join(PRODUCT, PRODUCT.'.id = '.PRODUCT_FEEDBACK.'.product_id');
		//$this->db->from(PRODUCT_FEEDBACK);
		$this->db->where(array(PRODUCT_FEEDBACK.'.seller_id'=>$seller_id,PRODUCT_FEEDBACK.'.status'=>'Active'));
		//$this->db->limit(7);
		$query = $this->db->get();
		$result = $query->result_array();
		//echo $this->db->last_query(); die;
		return $result;

	}

	public function get_product_details()
	{
		$this->db->select(USERS.'.id as userId,'.USERS.'.user_name as userName,'.PRODUCT.'.id as productId,'.PRODUCT.'.product_name,image as image,'.PRODUCT_FEEDBACK.'.*');
		$this->db->from(PRODUCT);
		$this->db->join(PRODUCT_FEEDBACK,PRODUCT_FEEDBACK.'.product_id='.PRODUCT.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.PRODUCT_FEEDBACK.'.voter_id','inner');
		$this->db->order_by(PRODUCT_FEEDBACK.'.id','desc');
		return $feedback_query = $this->db->get();
	}
	public function get_affiliate_products_by_category($categoryid='',$sort='desc'){
		$Query = "select p.*,u.user_name,u.full_name,u.thumbnail from ".USER_PRODUCTS." p
			LEFT JOIN ".USERS." u on u.id=p.user_id
			where p.status='Publish' and p.global_visible=1 and FIND_IN_SET('".$categoryid."',p.category_id) order by p.`created` ".$sort;
		return $this->ExecuteQuery($Query);
	}

	public function get_productfeed_details($condition='')
	{

		$this->db->select('u.id as userId,u.user_name as userName,s.email as seller_email,p.id as productId,p.product_name,image as image,pf.*');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_FEEDBACK.' as pf','pf.product_id=p.id','inner');
		$this->db->join(USERS.' as u','u.id='.'pf.voter_id','inner');
		$this->db->join(USERS.' as s','s.id='.'pf.seller_id','inner');
		$this->db->order_by('pf.id','desc');
		$this->db->where('pf.id',$condition);
		return $feedback_query = $this->db->get();

	}


	public function get_featured_details($pid='0'){
		$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
		$productList = $this->ExecuteQuery($Query);
		$productList->mode = 'sell_product';
		if ($productList->num_rows() != 1){
			$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
			$productList = $this->ExecuteQuery($Query);
			$productList->mode = 'user_product';
		}
		return $productList;
	}

	public function get_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			if (count($productIds)>0){
				$this->db->where_in('p.seller_product_id',$productIds);
				$this->db->where('p.status','Publish');
				$this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product');
				$this->db->from(PRODUCT.' as p');
				$this->db->join(USERS.' as u','u.id=p.user_id');
				$productList = $this->db->get();
			}
		}
		return $productList;
	}

	public function get_notsell_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			if (count($productIds)>0){
				$this->db->where_in('p.seller_product_id',$productIds);
				$this->db->where('p.status','Publish');
				$this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product');
				$this->db->from(USER_PRODUCTS.' as p');
				$this->db->join(USERS.' as u','u.id=p.user_id');
				$productList = $this->db->get();
			}
		}
		return $productList;
	}

	public function view_notsell_product_details($condition = ''){
		$select_qry = "select p.*,sh.short_url,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on u.id=p.user_id 
		LEFT JOIN ".SHORTURL." sh on sh.id=p.short_url_id
		".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}

	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE;
		return $attList = $this->ExecuteQuery($select_qry);

	}
	public function view_subproduct_details($prdId=''){
		$select_qry = "select * from ".SUBPRODUCT." where product_id = '".$prdId."'";
		return $attList = $this->ExecuteQuery($select_qry);

	}

	public function view_subproduct_details_join($prdId=''){
		$select_qry = "select a.*,b.attr_name as attr_type from ".SUBPRODUCT." a join ".PRODUCT_ATTRIBUTE." b on a.attr_id = b.id where a.product_id = '".$prdId."'";
		return $attList = $this->ExecuteQuery($select_qry);

	}

	public function view_shopping_cart_subproduct_val($userid='',$prdId=''){
		$select_qry = "select quantity,attribute_values from ".SHOPPING_CART." where product_id = '".$prdId."' and user_id='".$userid."'";
		return $shopAttrList = $this->ExecuteQuery($select_qry);

	}
	public function view_product_atrribute_details(){
		$select_qry = "select * from ".PRODUCT_ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);

	}

	public function view_category_details(){

		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){

			$catView .= $this->view_category_list($CatRow,'1');

			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";
			$SubList = $this->ExecuteQuery($sel_qry);

			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list($SubCatRow,'2');
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";
				$SubList1 = $this->ExecuteQuery($sel_qry1);
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list($SubCatRow1,'3');

					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";
					$SubList2 = $this->ExecuteQuery($sel_qry2);

					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list($SubCatRow2,'4');

					}
				}
			}
		}
			
		return $catView;
	}

	public function view_category_list($CatRow,$val){
		$SubcatView ='';
		$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
		return $SubcatView;
	}

	public function get_category_details($catList='', $ourpick_condition=''){
		$catListArr = explode(',', $catList);
		$select_qry = "select * from ".CATEGORY." where rootID=0 ".$ourpick_condition." and status='Active'";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){

			$catView .= $this->get_category_list($CatRow,'1',$catListArr);

			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."' ".$ourpick_condition." and status='Active' ";
			$SubList = $this->ExecuteQuery($sel_qry);

			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->get_category_list($SubCatRow,'2',$catListArr);
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."' ".$ourpick_condition." and status='Active' ";
				$SubList1 = $this->ExecuteQuery($sel_qry1);
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->get_category_list($SubCatRow1,'3',$catListArr);

					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."' ".$ourpick_condition." and status='Active' ";
					$SubList2 = $this->ExecuteQuery($sel_qry2);

					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->get_category_list($SubCatRow2,'4',$catListArr);

					}
				}
			}
		}
		return $catView;
	}

	public function get_category_list($CatRow,$val,$catListArr=''){
		$SubcatView ='';
		if (in_array($CatRow->id, $catListArr)){
			$checkStr = 'checked="checked"';
		}else {
			$checkStr = '';
		}
		$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" '.$checkStr.' class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
		return $SubcatView;
	}

	public function get_cat_list($ids=''){
		$this->db->where_in('id',explode(',', $ids));
		return $this->db->get(CATEGORY);
	}

	public function get_top_users_in_category($cat=''){
		$productArr = array();
		$userArr = array();
		$userCountArr = array();
		$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
		$usercondition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' AND p.global_visible=1 ";
		$productDetails = $this->view_product_details($condition);
		$user_productDetails = $this->view_product_details_user($usercondition);
		if ($productDetails->num_rows()>0){
			foreach ($productDetails->result() as $productRow){
				if (!in_array($productRow->id, $productArr)){
					array_push($productArr, $productRow->id);
					if ($productRow->user_id != ''){
						if (!in_array($productRow->user_id, $userArr)){
							array_push($userArr, $productRow->user_id);
							$userCountArr[$productRow->user_id] = 1;
						}else {
							$userCountArr[$productRow->user_id]++;
						}
					}
				}
			}
		}
		if ($user_productDetails->num_rows()>0){
			foreach ($user_productDetails->result() as $productRow){
				if (!in_array($productRow->id, $productArr)){
					array_push($productArr, $productRow->id);
					if ($productRow->user_id != ''){
						if (!in_array($productRow->user_id, $userArr)){
							array_push($userArr, $productRow->user_id);
							$userCountArr[$productRow->user_id] = 1;
						}else {
							$userCountArr[$productRow->user_id]++;
						}
					}
				}
			}
		}
		arsort($userCountArr);
		return $userCountArr;
	}

	public function get_recent_like_users($pid='',$limit='10',$sort='desc'){
		$Query = 'select pl.*, p.product_name, p.likes, u.full_name, u.user_name,u.thumbnail from '.PRODUCT_LIKES.' pl
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id 
					JOIN '.USERS.' u on u.id=pl.user_id and u.status="Active"
					where pl.product_id="'.$pid.'" order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	public function get_recent_like_users_things($pid='',$limit='10',$sort='desc'){
		$Query = 'select pl.*, p.product_name, p.likes, u.full_name, u.user_name,u.thumbnail from '.PRODUCT_LIKES.' pl
					JOIN '.USER_PRODUCTS.' p on p.seller_product_id=pl.product_id 
					JOIN '.USERS.' u on u.id=pl.user_id and u.status="Active"
					where pl.product_id="'.$pid.'" order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}


	public function get_recent_user_likes($uid='',$pid='',$limit='3',$sort='desc'){
		$condition = '';
		if ($pid!=''){
			$condition = ' and pl.product_id != "'.$pid.'" ';
		}
		$Query = 'select pl.*,u.user_name,u.full_name,u.thumbnail,p.product_name,p.id as PID,p.created,p.sale_price,p.image from '.PRODUCT_LIKES.' pl
					JOIN '.USERS.' u on u.id=pl.user_id 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id
					JOIN '.USERS.' u1 on u1.id=p.user_id and u1.group="Seller" and u1.status="Active"
					where pl.user_id = "'.$uid.'" '.$condition.' order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	public function get_recent_user_likes_things($uid='',$pid='',$limit='3',$sort='desc'){
		$condition = '';
		if ($pid!=''){
			$condition = ' and pl.product_id != "'.$pid.'" ';
		}
		$Query = 'select pl.*,u.user_name,u.full_name,u.thumbnail,p.product_name,p.id as PID,p.created,p.sale_price,p.image from '.PRODUCT_LIKES.' pl
					JOIN '.USERS.' u on u.id=pl.user_id 
					JOIN '.USER_PRODUCTS.' p on p.seller_product_id=pl.product_id
					JOIN '.USERS.' u1 on u1.id=p.user_id and u1.group="Seller" and u1.status="Active"
					where pl.user_id = "'.$uid.'" '.$condition.' order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}

	public function get_like_user_full_details($pid='0'){
		$Query = "select u.* from ".PRODUCT_LIKES.' p
					JOIN '.USERS.' u on u.id=p.user_id
					where p.product_id='.$pid;
		return $this->ExecuteQuery($Query);
	}

	public function getCategoryValues($selVal,$whereCond) {
		$sel = 'select '.$selVal.' from '.CATEGORY.' c LEFT JOIN '.CATEGORY.' sbc ON c.id = sbc.rootID '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}

	public function getCategoryResults($selVal,$whereCond) {
		$sel = 'select '.$selVal.' from '.CATEGORY.' '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}

	public function searchShopyByCategory($whereCond) {
		$sel = 'select p.* from '.PRODUCT.' p
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}

	public function searchShopyByCategoryuser($userWherCond) {
		/*$sel = 'select p.*, u.user_name, u.full_name, u.email, u.thumbnail,u.s_city, u.s_state,u.s_address, u.brand_name, u.brand_description,u.followers_count,u.about,u.s_phone_no from '.USER_PRODUCTS.' p
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$userWherCond.' ';*/
				
		$startlat = DEFAULT_LAT;
		$startlng = DEFAULT_LONG;
		if($this->session->userdata('location') != 'nolocation'){
			$startlat = $this->session->userdata('location')['lat'];
			$startlng = $this->session->userdata('location')['long'];
		}
		
		$sel = 'select p.*, u.user_name, u.full_name, u.email, u.thumbnail,u.s_city, u.s_state,u.s_address, u.brand_name, u.brand_description,u.followers_count,u.about,u.s_phone_no, s.cityname, FLOOR(SQRT(
				POW(69.1 * (s.latitude - '.$startlat.'), 2) +
				POW(69.1 * ('.$startlng.' - s.longitude) * COS(s.latitude / 57.3), 2))) AS distance from '.USER_PRODUCTS.' p
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
				LEFT JOIN '.SELLER_LOCATION.' s on s.id = u.location
		 		'.$userWherCond.'';
		/* 
		
		// query to set default 1000
				$sel = 'select p.*, u.user_name, u.full_name, u.email, u.thumbnail,u.s_city, u.s_state,u.s_address, u.brand_name, u.brand_description,u.followers_count,u.about,u.s_phone_no, s.cityname, COALESCE(FLOOR(SQRT(
				POW(69.1 * (s.latitude - '.$startlat.'), 2) +
				POW(69.1 * ('.$startlng.' - s.longitude) * COS(s.latitude / 57.3), 2))),1000) AS distance from '.USER_PRODUCTS.' p
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
				LEFT JOIN '.SELLER_LOCATION.' s on s.id = u.location
		 		'.$userWherCond.'';
		//
		
		$startlat = $this->session->userdata('location')['lat'];
		$startlng = $this->session->userdata('location')['long'];
		
		$sel = 'select p.*, u.user_name, u.full_name, u.email, u.thumbnail,u.s_city, u.s_state,u.s_address, u.brand_name, u.brand_description,u.followers_count,u.about,u.s_phone_no, s.cityname, SQRT(
				POW(69.1 * (s.latitude - '.$startlat.'), 2) +
				POW(69.1 * ('.$startlng.' - s.longitude) * COS(s.latitude / 57.3), 2)) AS distance from'.USER_PRODUCTS.' p
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
				LEFT JOIN '.SELLER_LOCATION.' s on s.id = u.location
		 		'.$userWherCond.' ORDER BY `distance` ASC';		
		*/
		/*
		// left join succed with location table
				$sel = 'select p.*, u.user_name, u.full_name, u.email, u.thumbnail,u.s_city, u.s_state,u.s_address, u.brand_name, u.brand_description,u.followers_count,u.about,u.s_phone_no, s.cityname from'.USER_PRODUCTS.' p
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
				LEFT JOIN '.SELLER_LOCATION.' s on s.id = u.location
		 		'.$userWherCond.';
		*/
		return $this->ExecuteQuery($sel);
	}


	public function add_user_product($uid='',$short_url=''){
		$returnStr = array();
		$seller_product_id = mktime();
		$checkId = $this->check_product_id($seller_product_id);
		while ($checkId->num_rows()>0){
			$seller_product_id = mktime();
			$checkId = $this->check_product_id($seller_product_id);
		}
		$url = base_url().'user/'.$this->data['userDetails']->row()->user_name.'/things/'.$seller_product_id.'/'.url_title($this->input->post('name'),'-');
		$this->simple_insert(SHORTURL,array('short_url'=>$short_url,'long_url'=>$url));
		$urlid = $this->get_last_insert_id();
		$returnStr['pid'] = $seller_product_id;
		$returnStr['image'] = '';
		$image_name = $this->input->post('image');
		if ($this->input->post('tag_url') && $this->input->post('photo_url')!=''){

			/****----------Move image to server-------------****/

			$image_url = trim(addslashes($this->input->post('photo_url')));
			$image_url = str_replace(" ", '%20', $image_url);

//			$img_data = file_get_contents($image_url);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
			curl_setopt($ch, CURLOPT_URL, $image_url);
			curl_setopt($ch, CURLOPT_REFERER, $image_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //Set curl to return the data instead of printing it to the browser.
			$img_data = curl_exec($ch);
			curl_close($ch);

			$img_full_name = substr($image_url, strrpos($image_url, '/')+1);
			$img_name_arr = explode('.', $img_full_name);
			$img_name = $img_name_arr[0];
			$ext = $img_name_arr[1];
			if ($ext == ''){
				$ext = 'jpg';
			}
			$new_name = str_replace(array(',','&','<','>','$','(',')','?'), '', $img_name.mktime().'.'.$ext);
			$new_img = 'images/product/'.$new_name;

			file_put_contents($new_img, $img_data);
			$returnStr['image'] = $new_name;

			/****----------Move image to server-------------****/

			$image_name = $new_name;

		}
		$dataArr = array(
			'product_name'	=>	$this->input->post('name'),
			'seourl'		=>	url_title($this->input->post('name'),'-'),
			'web_link'		=>	$this->input->post('link'),
			'category_id'	=>	$this->input->post('category'),
			'excerpt'		=>	$this->input->post('note'),
			'image'			=>	$image_name,
			'user_id'		=>	$uid,
			'seller_product_id' => $seller_product_id,
			//'sale_price' => $fancy_add-price,
			'sale_price' => $this->input->post('price'),
			'short_url_id'	=>	$urlid
		);
		$this->simple_insert(USER_PRODUCTS,$dataArr);
		return $returnStr;
	}

	public function check_product_id($pid=''){
		$checkId = $this->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
		if ($checkId->num_rows()==0){
			$checkId = $this->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
		}
		return $checkId;
	}

	public function get_products_by_category($categoryid='',$sort='desc'){
		$Query = "select p.*,u.user_name,u.full_name,u.thumbnail from ".PRODUCT." p
			LEFT JOIN ".USERS." u on u.id=p.user_id
			where p.status='Publish' and FIND_IN_SET('".$categoryid."',p.category_id) order by p.`created` ".$sort;
		return $this->ExecuteQuery($Query);
	}

	public function view_product_comments_details($condition = ''){
		$select_qry = "select p.product_name,c.product_id,u.full_name,u.user_name,u.thumbnail,c.comments ,u.email,c.id,c.status,c.dateAdded,c.user_id as CUID
		from ".PRODUCT_COMMENTS." c 
		LEFT JOIN ".USERS." u on u.id=c.user_id 
		LEFT JOIN ".PRODUCT." p on p.seller_product_id=c.product_id ".$condition;
		$productComment = $this->ExecuteQuery($select_qry);
		return $productComment;
			
	}
	
	public function view_custom_request_details($condition = ''){
		$select_qry = "select* from ".CUSTOM." " .$condition;
		$customRequest = $this->ExecuteQuery($select_qry);
		return $customRequest;
			
	}
	public function Update_Product_Comment_Count($product_id){

		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count + 1) WHERE seller_product_id='".$product_id."'";
		$this->ExecuteQuery($Query);
	}
	public function Update_Product_Comment_Count_Reduce($product_id){

		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count - 1) WHERE seller_product_id='".$product_id."'";
		return $this->ExecuteQuery($Query);
	}
	public function get_products_search_results($search_key='',$limit='5'){
		$Query = 'select p.* from '.PRODUCT.' p
				LEFT JOIN '.USERS.' u on u.id=p.user_id
				where p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and u.status="Active" and u.group="Seller"
				or p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and p.user_id=0
				limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	public function get_user_products_search_results($search_key='',$limit='5'){
		$Query = 'select p.*, u.user_name from '.USER_PRODUCTS.' p
				LEFT JOIN '.USERS.' u on u.id=p.user_id
				where p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.global_visible="1" and u.status="Active" limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	public function get_user_search_results($search_key='',$limit='5'){
		$Query = 'select * from '.USERS.' where full_name like "%'.$search_key.'%" and status="Active" OR user_name like "%'.$search_key.'%" and status="Active" limit '.$limit;
		return $this->ExecuteQuery($Query);
	}

	public function get_product_full_details($pid='0'){
		$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".PRODUCT." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
		$productDetails = $this->ExecuteQuery($Query);
		if ($productDetails->num_rows() == 0){
			$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".USER_PRODUCTS." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
			$productDetails = $this->ExecuteQuery($Query);
			$productDetails->prodmode = 'user';
		}else {
			$productDetails->prodmode = 'seller';
		}
		return $productDetails;
	}

	public function get_user_created_lists($pid='0'){
		$Query = "select * from ".LISTS_DETAILS." where FIND_IN_SET('".$pid."',product_id)";
		return $this->ExecuteQuery($Query);
	}
	//Get details from the control thr home

	public function view_controller_details(){
		$this->db->select('*');
		$this->db->from(CONTROLMGMT);
		$ControlList = $this->db->get();

		//echo '<pre>'; print_r($ControlList->result()); die;
		return $ControlList;
	}

	public function empty_pid_list(){
		$dataArr = array(
		'products'=>'',
		'product_count'=>'0'
		);
		$condArr = array('list_id'=>'2');
		$this->update_details(LIST_VALUES,$dataArr,$condArr);
	}

	public function get_upload_requests(){
		$Query = "select up.*,u.user_name,u.full_name from ".UPLOAD_REQ." up JOIN ".USERS." u on u.id=up.user_id";
		return $this->ExecuteQuery($Query);
	}
	
	/*This function updates the product to the Our Picks Category*/
	public function ourpick_update($product_id){
	$query = "UPDATE ".PRODUCT." SET category_id= CONCAT(category_id,',107')WHERE id='".$product_id."'";
		return $this->ExecuteQuery($query);

	}


	/*This function removes the product from Our Picks Category*/
	public function ourpick_remove($product_id){
	$query = "UPDATE ".PRODUCT." SET category_id= REPLACE(category_id,',107','')WHERE id='".$product_id."'";
		return $this->ExecuteQuery($query);

	}

	/*This function updates the user product to the Our Picks Category*/
	public function user_ourpick_update($product_id){
	$query = "UPDATE ".USER_PRODUCTS." SET category_id= CONCAT(category_id,',107')WHERE id='".$product_id."'";
		return $this->ExecuteQuery($query);

	}


	/*This function removes the user product from Our Picks Category*/
	public function user_ourpick_remove($product_id){
	$query = "UPDATE ".USER_PRODUCTS." SET category_id= REPLACE(category_id,',107','')WHERE id='".$product_id."'";
		return $this->ExecuteQuery($query);

	}

	public function globle_update_details($product_id,$status){
	$query = "UPDATE ".USER_PRODUCTS." SET global_visible='".$status."' WHERE seller_product_id='".$product_id."'";
		return $this->ExecuteQuery($query);

	}

	public function globalize_user_product($product_id,$global_status){
	$query = "UPDATE ".USER_PRODUCTS." SET global_visible='".$global_status."' WHERE id='".$product_id."'";
		return $this->ExecuteQuery($query);

	}
	
	/*public function get_latest_five_sellers(){
	$query = "SELECT user_name, thumbnail, id FROM ".USERS." WHERE `group` = 'Seller' AND status = 'Active' AND is_verified = 'Yes' AND request_status='Approved' ORDER BY created DESC limit 5";
		return $this->ExecuteQuery($query);

	}*/
	
	public function get_latest_five_sellers($followinglist,$cUid = '0'){
	
	$query = "SELECT user_name, thumbnail, id FROM ".USERS." WHERE `group` = 'Seller' AND status = 'Active' AND is_verified = 'Yes' AND request_status='Approved' AND id NOT IN (0".$followinglist.") AND id != ".$cUid." ORDER BY created DESC limit 5";
		return $this->ExecuteQuery($query);

	}
	
	public function get_Cat_Max_likePrd($tableName){
		$query = "SELECT category_id FROM ".$tableName." ORDER BY likes DESC Limit 5";
		return $this->ExecuteQuery($query);
	}
	
	public function get_latest_five_users($followinglist,$cUid = '0'){
	
	$query = "SELECT user_name, thumbnail, id FROM ".USERS." WHERE `group` = 'User' AND status = 'Active' AND is_verified = 'Yes' AND id NOT IN (0".$followinglist.") AND id != ".$cUid." ORDER BY created DESC limit 5";
		return $this->ExecuteQuery($query);

	}

/* vinit code start */
   public function getDiscountedDetails($pid='0', $salePrice='', $userId='', $catId=''){
        $prodID = $pid;
        $prodCouponQuery  = 'select * from '.COUPONCARDS.' where `card_status` = "not used" AND `coupon_type` = "product"
        AND `status` = "Active" AND dateto >= CURDATE()';
                     
        $userCouponQuery = 'select * from '.COUPONCARDS.' where `card_status` = "not used" AND `coupon_type` = "seller"
        AND `status` = "Active" AND dateto >= CURDATE()';
        
        $catCouponQuery = 'select * from '.COUPONCARDS.' where `card_status` = "not used" AND `coupon_type` = "category"
        AND `status` = "Active" AND dateto >= CURDATE()';
        
        
        $prodCoupRes = $this->ExecuteQuery($prodCouponQuery);
        $userCoupRes = $this->ExecuteQuery($userCouponQuery);
        $catCoupRes = $this->ExecuteQuery($catCouponQuery);
        
        $couponCode = '';
        $discVal = 0.00;
        $discPrice = '';
        $discDesc = '';
        // Logic for product coupon code. Take least value if multiple coupons on product
        if($prodCoupRes->num_rows() > 0){
            foreach($prodCoupRes->result() as $coupRow){
                $pidArr = @explode(',',$coupRow->product_id);
                if(in_array($prodID,$pidArr)==1){
                    $currDisc = $coupRow->price_value;
                    if($discVal == 0.00 || $currDisc < $discVal) {
                        $discVal = $currDisc;
                        $couponCode = $coupRow->code;
                        $discDesc = $coupRow->description;
                    }
                }
            }
        }
        if($couponCode =='' && $userCoupRes->num_rows() > 0){
            foreach($userCoupRes->result() as $coupRow){
                $userArr = @explode(',',$coupRow->user_id);
                if(in_array($userId,$userArr)==1){
                    $currDisc = $coupRow->price_value;
                    if($discVal == 0.00 || $currDisc < $discVal) {
                        $discVal = $currDisc;
                        $couponCode = $coupRow->code;
                        $discDesc = $coupRow->description;
                    }               
                }
            }
        }
        if($couponCode =='' && $catCoupRes->num_rows() > 0) {
            $prodCat = @explode(',',$catId);
            foreach($catCoupRes->result() as $coupRow){
                $coupCat = $coupRow->category_id;
                $coupCatArr = @explode(',', $coupCat);
                $combArr = array_merge($prodCat, $coupCatArr);
                $combArr1 = array_unique($combArr);
                $currDisc = $coupRow->price_value;
				if(count($combArr) != count($combArr1)){
				    if($discVal == 0.00 || $currDisc < $discVal) {
                        $discVal = $currDisc;
                        $couponCode = $coupRow->code;
                        $discDesc = $coupRow->description;
                    }    
                }
            }    
        }
        
        if($couponCode != '' && $discVal != 0.00){
            $origPrice = $salePrice;
            $discount = ($discVal * 0.01) * $origPrice;
            $discPrice = number_format($salePrice-$discount);
        }
        $dataArr = array(
		  'coupon_code'	=>	$couponCode,
		  'disc_percent'		=>	$discVal,
		  'disc_price'		=>	$discPrice,
          'disc_desc'   => $discDesc
        );
        return  $dataArr;   
                        
    }
    /* vinit code end */
    public function get_Sub_to_Root_cat($SubID = 0){

			$query = "SELECT node.id,node.cat_name AS node_name, node.seourl AS node_seourl, 
			up1.id AS up1_id, up1.cat_name AS up1_name, up1.seourl AS up1_seourl,
			up2.id AS up2_id, up2.cat_name AS up2_name, up2.seourl AS up2_seourl,
			up3.id AS up3_id, up3.cat_name AS up3_name, up3.seourl AS up3_seourl
						FROM ".CATEGORY." AS node
							LEFT OUTER 
						JOIN ".CATEGORY." AS up1 ON up1.id = node.rootID
							LEFT OUTER 
						JOIN ".CATEGORY." AS up2 ON up2.id = up1.rootID
							LEFT OUTER 
						JOIN ".CATEGORY." AS up3 ON up3.id = up2.rootID
							LEFT OUTER 
						JOIN ".CATEGORY." AS up4 ON up4.id = up3.rootID
						WHERE node.id =".$SubID;
			return $this->ExecuteQuery($query);			
			// $query = "select c.id as cid, c.cat_name as cname, c.rootID as crootID, sbc.id as sbcid, sbc.cat_name as sbcname, sbc.rootID as sbcrootID from ".CATEGORY." c LEFT JOIN ".CATEGORY." sbc ON c.id = sbc.rootID where sbc.id =".$SubID;
	}
	
	    public function get_custom_request(){
   	 	$Query = "select * from ".CUSTOM." order by created desc";
   	 	return $this->ExecuteQuery($Query);
   }
}

?>