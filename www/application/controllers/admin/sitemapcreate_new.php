<?php
class Sitemapcreate_new extends MY_Controller {

   function __construct()
    {
        parent::__construct();
		$this->load->library('sitemap'); 
		$this->load->helper('download');
		$this->load->helper('xml');		
		 $this->load->helper('file');
		 $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('admin_model');
		$this->load->model('sitemapnew_model');
    }
    
    function index()
    {
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
				$i = 0;
				$sitemap_url = array();
				$url_priority = array();

				$thingsarray =  $this->sitemapnew_model->get_things();
				$result_count = $thingsarray->num_rows();
				if($result_count != 0){
					$result = $thingsarray->result();
					$url = base_url()."things/";					
					foreach($result as $things)
					{
						$sitemap_url[$i] = $url.$things->id."/".$things->seourl;
						$url_priority[$i] = '0.95';
						$i++;
					}
				}

				$usersarray = $this->sitemapnew_model->get_users();
				$result_count = $usersarray->num_rows();
				if($result_count != 0){
					$result = $usersarray->result();
					$url = base_url()."user/";
					foreach($result as $user)
					{
						$sitemap_url[$i] = $url.$user->user_name;
						$url_priority[$i] = '0.80';
						$i++;
					}
				}

				$categoryarray = $this->sitemapnew_model->get_category();
				$result_count = $categoryarray->num_rows();
				if($result_count != 0){
					$result = $categoryarray->result();
					$url = base_url()."shopby/";
					foreach($result as $category)
					{
						$sitemap_url[$i] = $url.$category->seourl;
						$url_priority[$i] = '0.85';
						$i++;
					}
				}

				$user_productyarray = $this->sitemapnew_model->get_user_product();
				$result_count = $user_productyarray->num_rows();
				if($result_count != 0){
					$result = $user_productyarray->result();
					$url = base_url()."user/";
					foreach($result as $user_product)
					{
						$sitemap_url[$i] = $url.$user_product->user_name."/things/".$user_product->seller_product_id."/".$user_product->seourl;
						$url_priority[$i] = '0.90';
						$i++;
					}
				}

				$static_page_array = $this->sitemapnew_model->get_static_page();
				$result_count = $static_page_array->num_rows();
				if($result_count != 0){
					$result = $static_page_array->result();
					$url = base_url()."pages/";
					foreach($result as $static_pages)
					{
						$sitemap_url[$i] = $url.$static_pages->seourl;
						$url_priority[$i] = '0.75';
						$i++;
					}
				}
				
				$sequence = 1;
				$current_date = date('Y-m-d');
				/*if(!is_dir("sitemapgenerate/")) {
			        mkdir("sitemapgenerate/");
			    }*/

			    $sitemapUrlCount = count($sitemap_url);
			    $pC = 0;
			    do{
			    	
					//$file = "sitemapgenerate/sitemap".$sequence.".xml";
                                        $file = "sitemap".$sequence.".xml";
					$pf = fopen ($file, "w");
					if (!$pf){
						echo "cannot create $file\n";
						return;
					}
					fwrite ($pf,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
						<urlset
				  		xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
				  		xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
				  		xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
						http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">
					");
			    	for ($k=0; $k < 25000; $k++) { 
							if($pC == 0){
							fwrite ($pf,"<url>\n<loc>".base_url()."</loc>\n<lastmod>$current_date</lastmod>\n<changefreq>daily</changefreq>\n<priority>1.0</priority>\n</url>\n");
							}					
							$sitemap_url_temp = $sitemap_url[$pC];
							$url_priority_temp = $url_priority[$pC];
							if($sitemap_url[$pC] == ''){break;}
							fwrite ($pf,"<url>\n<loc>$sitemap_url_temp</loc>\n<lastmod>$current_date</lastmod>\n<changefreq>daily</changefreq>\n<priority>$url_priority_temp</priority>\n</url>\n");
							$pC++;
				    	}
				    	fwrite ($pf, "</urlset>\n");
						fclose ($pf);
						$sequence++;									
			    }while($pC < $sitemapUrlCount);
			   
				redirect('admin/sitemapcreate_new/sitemapdetailsview');		
			}else {
				redirect('admin');
			}
		}
		
    }
	
	function sitemapdetailsview()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
				$this->data['heading'] = 'Sitemap creation successful';
				$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
				/*$this->zip_sitemape();
				$this->gz_sitemap();*/
		$this->load->view('admin/sitemapgeneration_new/sitemapdetailsview',$this->data);
		}else {
				redirect('admin');
			}
		}
	}
	
	function zip_sitemape(){
		if($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			if($this->checkPrivileges('admin','2') == TRUE){
				/*****************************************/
				/*if(!is_dir("sitemapgenerate_zip/")) {
			        mkdir("sitemapgenerate_zip/");
			    }*/
				$zip = new ZipArchive;
				//$res = $zip->open('sitemapgenerate_zip/sitemapZip.zip', ZipArchive::CREATE);
                                $res = $zip->open('sitemapZip.zip', ZipArchive::CREATE);
				if ($res === TRUE) {
					$sq = 1;
					foreach (glob("*sitemap*.xml") as $file) {
                                        //foreach (glob("sitemapgenerate/*.xml") as $file) { 
				        $zip->addFile($file, 'sitemap'.$sq.'.xml');
				        $sq++;
				    }
					
				    $zip->close();
				    return TRUE;
				} else {
				    redirect('admin');
				}

				/*****************************************/
			}else{
				redirect('admin');
			}
		}		
	}

	function gz_sitemap(){
		if($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			if($this->checkPrivileges('admin','2') == TRUE){
				/*if(!is_dir("sitemapgenerate_Gzip/")) {
			        mkdir("sitemapgenerate_Gzip/");
			    }*/
				$sq = 1;
				//foreach (glob("sitemapgenerate/*.xml") as $file) { 
                                  foreach (glob("*sitemap*.xml") as $file) { 
					$data = implode("", file($file));
					$gzdata = gzencode($data, 9);
					//$fp = fopen("sitemapgenerate_Gzip/sitemapGz".$sq.".xml.gz", "w");
                                        $fp = fopen("sitemapGz".$sq.".xml.gz", "w");
					fwrite($fp, $gzdata);
					fclose($fp);
					$sq++;
				}
			}else{
				redirect('admin');
			}
		}		
	}
			
}

?>