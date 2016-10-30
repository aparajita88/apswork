<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php

function create_guid() {
    $microTime = microtime();
    list($a_dec, $a_sec) = explode(" ", $microTime);
    $dec_hex = dechex($a_dec * 1000000);
    $sec_hex = dechex($a_sec);
    ensure_length($dec_hex, 5);
    ensure_length($sec_hex, 6);
    $guid = "";
    $guid .= $dec_hex;
    $guid .= create_guid_section(3);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= $sec_hex;
    $guid .= create_guid_section(6);
    return $guid;
}
function ensure_length(&$string, $length) {
    $strlen = strlen($string);
    if ($strlen < $length) {
        $string = str_pad($string, $length, "0");
    } else if ($strlen > $length) {
        $string = substr($string, 0, $length);
    }
}

function create_guid_section($characters) {
    $return = "";
    for ($i = 0; $i < $characters; $i++) {
        $return .= dechex(mt_rand(0, 15));
    }
    return $return;
}

function authenticate($typeid=array()) {
    $CI = & get_instance();
    $current_userId=$CI->session->userdata("userId");
    $current_userEmail=$CI->session->userdata("userEmail");
    if (!empty($current_userId) && !empty($current_userEmail)) {
        if (in_array($CI->session->userdata("userTypeId"),$typeid )){
			//Nothing to do
		}
		else{
			if(in_array('ut1',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/admin'</script>";
			}
			else if(in_array('ut3',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/login/Login'</script>";
			}
			else if(in_array('ut4',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/login/Login'</script>";
			}
			else if(in_array('ut5',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/receptionist'</script>";
			}
			else if(in_array('ut6',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/ituser'</script>";
			}
			else if(in_array('ut2',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/owner'</script>";
			}
			else if(in_array('ut7',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/manager'</script>";
			}
			else if(in_array('ut8',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/concierge'</script>";
			}
			else if(in_array('ut9',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/pantry'</script>";
			}
			else if(in_array('ut10',$typeid )){
				echo "<script>window.parent.location.href='".$CI->config->item('base_url')."index.php/areadirector'</script>";
			}
			
			
		}
    }else{
		echo "<script>window.parent.location.href='".$CI->config->item('base_url')."'</script>";
	}
        
}


function generate_cat_menu()
{
    $CI = & get_instance();
    $db =& DB();
//    $CI->load->model('brands/brand');
//    $result=$CI->brand->getBrandListForMenu();
    $mainCat = array();
    
    $db->where('deleted', '0');
    $db->where('status', 1);
    $db->where('isMenuItem', '1');
    $db->where('productCategoryParentId', 'CP0');
    $db->order_by('productCategoryName', 'DESC');
    $mainCat = $db->get('product_category')->result_array();
    //echo '<pre>';print_r($mainCat);
    $menu = array();
    
    foreach($mainCat as $parentCat=>$val)
    {
        //echo $val['productCategoryId']; exit();
        
        $db->where('deleted', '0');
        $db->where('status', 1);
        $db->where('isMenuItem', '1');
        $db->where('productCategoryParentId', $val['productCategoryId']);
        $db->order_by('productCategoryName', 'ASC');
        $subCat1 = $db->get('product_category')->result_array();
        
        //echo '<pre>';print_r($f_result);
        foreach($subCat1 as $subCat=>$subVal)
        {
            //$img=getProductPrimaryImage($fprod->productId);
            $mainCat[$parentCat]['subCat'][$subCat]=array(
                            'productCategoryId'      => $subVal['productCategoryId'],
                            'productCategoryName'    => $subVal['productCategoryName'],
                            'productCategoryParentId'=> $subVal['productCategoryParentId'],
			    'seoTitle'               => str_replace(' ','_',$subVal['seoTitle'])
                           );
            $db->flush_cache();
            $db->where('deleted', '0');
            $db->where('status', 1);
            $db->where('isMenuItem', '1');
            $db->where('productCategoryParentId', $subVal['productCategoryId']);
            $db->order_by('productCategoryName', 'ASC');
            $p_result = $db->get('product_category')->result_array();
            
            foreach($p_result as $subSubCat=>$subSubVal){
                $mainCat[$parentCat]['subCat'][$subCat]['subSubCat'][$subSubCat]=array(
                            'productCategoryId'      => $subSubVal['productCategoryId'],
                            'productCategoryName'    => $subSubVal['productCategoryName'],
                            'productCategoryParentId'=> $subSubVal['productCategoryParentId'],
			    'seoTitle'               => str_replace(' ','_',$subSubVal['seoTitle'])
                );
                
                
               $db->flush_cache();
            	$db->where('deleted', '0');
            	$db->where('status', 1);
            	$db->where('isMenuItem', '1');
            	$db->where('productCategoryParentId', $subSubVal['productCategoryId']);
            	$db->order_by('productCategoryName', 'ASC');
            	$subsubsubRes = $db->get('product_category')->result_array();
            	
            	foreach($subsubsubRes as $subSubSubCat=>$subSubSubVal)
            	{
            		$mainCat[$parentCat]['subCat'][$subCat]['subSubCat'][$subSubCat]['subSubSubCat'][$subSubSubCat]=array(
                            'productCategoryId'      => $subSubSubVal['productCategoryId'],
                            'productCategoryName'    => $subSubSubVal['productCategoryName'],
                            'productCategoryParentId'=> $subSubSubVal['productCategoryParentId'],
			    					 'seoTitle'               => str_replace(' ','_',$subSubSubVal['seoTitle'])
                   );
            	}
            }
        }
    }

    return $mainCat;
}


function generate_password( $length = 6 ) {
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0987654321";
$password = substr( str_shuffle( $chars ), 0, $length );
return $password;
}












function front_authenticate($type='') {
    $CI = & get_instance();
    $current_userId=$CI->session->userdata("user_id");
    $current_userName=$CI->session->userdata("userName");
    if (($current_userId!="" || $current_userName!="")&& $type==$CI->session->userdata("user_type")) {
        return true;
    }
    else{
        return false;
    }
        
}

function getCountry($modelName)
	{
	
	$CI = & get_instance();
	$CI->load->model($modelName);
	$countrylist=$CI->$modelName->getCountryList();
	
	return $countrylist;
	}

function getCountryAccount()
	{
	
	$CI = & get_instance();
	$CI->load->model('accountsetting');
	$countrylist=$CI->accountsetting->getCountryList();
	
	return $countrylist;
        }
        
function send_mail($to_email, $form_name, $form_email, $subject, $message, $bcc='') {

        /* To send HTML mail, you can set the Content-type header. */

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: ". $form_name ."<".$form_email."> \r\n";
        if ($bcc != "")
        $headers .= "Bcc: ".$bcc."\n";
        $output = $message; $output = wordwrap($output, 72);
        return(mail($to_email, $subject, $output, $headers));

}      

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, count($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }
    return $pass;
}



function getProductPrimaryImage($pid)
{
    $CI = & get_instance();
    $db =& DB();
    $proVal	= $db->get_where('product', array('productId'=>$pid,'status'=>1,'deleted'=>'0'))->row();
    $data1=(array)json_decode($proVal->images);
    if($data1)
    {
    foreach($data1 as $imgVal)
    {
        if(!empty($imgVal))
        {
                $photo = (array)$imgVal;
            if(!empty($photo['primary']))
            {
                    $data['image']['filename']=$photo['filename'];
                    $data['image']['alt']=$photo['alt'];
                    $data['image']['caption']=$photo['caption'];
                    $data['image']['primary']=$photo['primary'];
            }
            else 
            {
            	$data['image']['filename']="";
			      $data['image']['alt']="";
      			$data['image']['caption']="";
      			$data['image']['primary']="";
            }
        }
        else 
        {
        		$data['image']['filename']="";
      		$data['image']['alt']="";
      		$data['image']['caption']="";
      		$data['image']['primary']="";
        }

    }
    }
    else 
    {
    	$data['image']['filename']="";
      $data['image']['alt']="";
      $data['image']['caption']="";
      $data['image']['primary']="";
    }
    return $data;
}




function getrelatedProductImage($pid)
{
    $CI = & get_instance();
    $db =& DB();
    $proVal	= $db->get_where('product', array('productId'=>$pid,'status'=>1,'deleted'=>'0'))->row();
    $data1=(array)json_decode($proVal->images);
    if($data1)
    {
    foreach($data1 as $imgVal)
    {
        if(!empty($imgVal))
        {
                $photo = (array)$imgVal;
            if(!empty($photo['filename']))
            {
                    $data['image']['filename']=$photo['filename'];
                    $data['image']['alt']=$photo['alt'];
                    $data['image']['caption']=$photo['caption'];
                    $data['image']['primary']=$photo['primary'];
            }
            else 
            {
            	$data['image']['filename']="";
			      $data['image']['alt']="";
      			$data['image']['caption']="";
      			$data['image']['primary']="";
            }
        }
        else 
        {
        		$data['image']['filename']="";
      		$data['image']['alt']="";
      		$data['image']['caption']="";
      		$data['image']['primary']="";
        }

    }
    }
    else 
    {
    	$data['image']['filename']="";
      $data['image']['alt']="";
      $data['image']['caption']="";
      $data['image']['primary']="";
    }
    return $data;
}



function generate_top_menu()
{
	$CI = & get_instance();
   $db =& DB();
   
	/*$db->where('deleted', '0');
   $db->where('status', 1);
   $db->where('isMenuItem', '1');
   $db->where('productCategoryParentId', 'CP0');
   $db->order_by('productCategoryName', 'DESC');*/


   $db->where('product_category.deleted', '0');
   $db->where('product_category.status', 1);
   $db->where('product_category.isMenuItem', '1');
   $db->where('product_category.productCategoryParentId', 'CP0');
   $db->join('product_category_images','product_category_images.productCategoryId=product_category.productCategoryId','INNER');
   $db->select('product_category.*, product_category_images.productCategoryImage');
	$db->order_by('product_category.productCategoryName', 'DESC');

   $mainCat = $db->get('product_category')->result_array();
   $menu = array();
   if($mainCat)
   {
   	foreach($mainCat as $catKey=>$catVal)
   	{
   			$where=array(
               'product_brand_to_category.status'=>1,
               'product_brand_to_category.deleted'=>0,
               'product_brand.status'=>'1',
               'product_brand.deleted'=>'0',
               'product_brand_to_category.productCategoryId'=>$catVal['productCategoryId']
           	);

         	$db->where($where);
         	$db->join('product_brand','product_brand.productBrandId=product_brand_to_category.productBrandId','INNER');
         	$db->group_by('product_brand_to_category.productBrandId');
         	$db->select('product_brand_to_category.productBrandId, product_brand.productBrandName, product_brand.slug');
         	$brandArr=$db->get('product_brand_to_category')->result_array();
         	
         	$mainCat[$catKey]['Brands']=$brandArr;
         	
         	
         	$db->where('deleted', '0');
   			$db->where('status', 1);
   			$db->where('isMenuItem', '1');
   			$db->where('productCategoryParentId', $catVal['productCategoryId']);
   			$db->order_by('productCategoryName', 'DESC');
   			$db->select('productCategoryId, productCategoryName, slug');
   			$subCategoryArr=$db->get('product_category')->result_array();
   			
   			foreach($subCategoryArr as $subCatKey=>$subCatVal)
   			{
   				$db->where('deleted', '0');
   				$db->where('status', 1);
   				$db->where('isMenuItem', '1');
   				$db->where('productCategoryParentId', $subCatVal['productCategoryId']);
   				$db->order_by('productCategoryName', 'DESC');
   				$db->select('productCategoryId, productCategoryName, slug');
   				$subSubCategoryArr=$db->get('product_category')->result_array();
   				
   				$subCategoryArr[$subCatKey]['Sub']=$subSubCategoryArr;
   			}
   			
   			$mainCat[$catKey]['Categories']=$subCategoryArr;
   	}
   }
   
   return $mainCat;
}


function banners()
{
	$CI = & get_instance();
   $db =& DB();
   
	$db->where('deleted', '0');
   $db->where('status', '1');  
   $db->order_by('ordering', 'ASC');
   $banners = $db->get('banners')->result_array();

   return $banners;
}


/*function generate_top_menu()
{
    $CI = & get_instance();
    $db =& DB();
//    $CI->load->model('brands/brand');
//    $result=$CI->brand->getBrandListForMenu();
    
    $db->where('deleted', '0');
    $db->where('status', 1);
    $db->where('isMenuItem', '1');
    $db->order_by('productBrandName', 'ASC');
    $result = $db->get('product_brand')->result();
    $menu = array();
    
    foreach($result as $brand)
    {
        $featured = array(); 
        $products = array();
        
        $db->where('deleted', '0');
        $db->where('status', 1);
        $db->where('productIsFeatured', '1');
        $db->where('productBrandId', $brand->productBrandId);
        $db->limit(3);
        $f_result = $db->get('product')->result();
 
        foreach($f_result as $fprod)
        {
            $img=getProductPrimaryImage($fprod->productId);
            $featured[]=array(
                                    'productId'      => $fprod->productId,
                                    'productName'    => $fprod->productName,
                                    'price'          => $fprod->price,
                                    'salePrice'      => $fprod->productSalePrice,
                                    'productImage'   => $img['image']['filename'],
                                    );
        }
        $db->flush_cache();
        $db->where('deleted', '0');
        $db->where('status', 1);
        $db->where('productBrandId', $brand->productBrandId);
        $db->limit(10);
        $p_result = $db->get('product')->result();
        foreach($p_result as $p)
        {
            $products[]=array(
                                    'productId'      => $p->productId,
                                    'productName'    => $p->productName,

                                    );
        }
        
        $menu[]=array(
                    'brandName'  => $brand->productBrandName,
                    'brandId'    => $brand->productBrandId,
                    'products'   => $products,
                    'featured'   => $featured,
                    );
    }
    return $menu;
}*/



function getSavedSearch()
{
	$CI = & get_instance();
    	$db =& DB();
		
	$savedSearchArr=array();

	$db->where('deleted', '0');
        $db->where('status', 1);
        $db->limit(6);
        $fResult = $db->get('saved_search')->result();
 
        foreach($fResult as $fSub)
        {
		switch($fSub->searchSubject) 
			{
   			case 'PRODUCT':
					$db->flush_cache();
					$db->where('deleted', '0');
        				$db->where('status', 1);
					$db->where('productId', $fSub->subjectId);
					$db->order_by("dateModified", "DESC");
					$db->limit(3);
        				$pResult = $db->get('product')->result();
					
					foreach($pResult as $proRow)
					{
						$proImg=getProductPrimaryImage($proRow->productId);
            					$savedSearchArr[]=array(
                                    			'productId'      => $proRow->productId,
                                    			'productName'    => $proRow->productName,
                                    			'price'          => $proRow->price,
                                    			'salePrice'      => $proRow->productSalePrice,
                                    			'productImage'   => $proImg['image']['filename'],
                                    			);
					}
					break;
			case 'BRAND':
					$db->flush_cache();
					$db->where('deleted', '0');
					$db->where('status', 1);
					$db->where('productBrandId', $fSub->subjectId);
					$db->order_by("dateModified", "DESC");
					$db->limit(3);
					$bResult = $db->get('product')->result();
					foreach($bResult as $brdRow)
					{
						$proImg=getProductPrimaryImage($brdRow->productId);
            					$savedSearchArr[]=array(
                                    			'productId'      => $brdRow->productId,
                                    			'productName'    => $brdRow->productName,
                                    			'price'          => $brdRow->price,
                                    			'salePrice'      => $brdRow->productSalePrice,
                                    			'productImage'   => $proImg['image']['filename'],
                                    			);
					}
					break;
			case 'CATEGORY':
					$db->flush_cache();
					$db->where('product.deleted', '0');
					$db->where('product.status', 1);
					$db->where('product_to_category.productCategoryId', $fSub->subjectId);
					$db->join('product','product.productId=product_to_category.productId','INNER');
					$db->join('product_category','product_category.productCategoryId=product_to_category.productCategoryId','INNER');
					$db->group_by('product.productId');
             				
					$db->select('product.*');
					$db->order_by("dateModified", "DESC");
					$db->limit(3);
					$cResult =$db->get('product_to_category')->result();
					foreach($cResult as $catRow)
					{
						$proImg=getProductPrimaryImage($catRow->productId);
            					$savedSearchArr[]=array(
                                    			'productId'      => $catRow->productId,
                                    			'productName'    => $catRow->productName,
                                    			'price'          => $catRow->price,
                                    			'salePrice'      => $catRow->productSalePrice,
                                    			'productImage'   => $proImg['image']['filename'],
                                    			);
					}
				
					break;
			}
	}


	return $savedSearchArr;
}


function getGeneratedCatMenu($parent_id, $cats, $sub='')
{
	foreach ($cats[$parent_id] as $cat)
	{
		
		if (isset($cats[$cat->productCategoryId]) && sizeof($cats[$cat->productCategoryId]) > 0)
		{
			$sub2=1;
			getGeneratedCatMenu($cat->productCategoryId, $cats, $sub2);
		}
	}
}









// FUNCTIONALITIES FOR COMPARE START Date - 24-08-15

function checkOne($id)
{
	$CI = & get_instance();
	$db =& DB();
	$getCurrent=$CI->session->userdata('productCompare');
	if($getCurrent!="")
	{
		$newCurrent=$getCurrent.','.$id;
	}
	else
	{
		$newCurrent=$id;
	}


	$CI->session->set_userdata('productCompare', $newCurrent);


	$proId=explode(',', $CI->session->userdata('productCompare'));
	
	if(!empty($proId))
	{

	$comPLimitCnt=count($proId);		
		
	$html='<div class="compareMd">';
	foreach($proId as $pId)
	{
		$db->where('deleted', '0');
      $db->where('status', '1');
		$db->where('productId', $pId);
		$result = $db->get('product')->result_array();

		//echo $result[0]['productSalePrice'];
		//echo "<pre>";
		//print_r($result);
		//exit();
		$clickPId="'".$pId."'";

		if($result[0]['productSalePrice']>0)
			$ofPrice=$result[0]['productSalePrice'];
		else
			$ofPrice=$result[0]['price'];

		$proImage=getProductPrimaryImage($result[0]['productId']);

		if($proImage['image']['filename']!="")
			$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/'.$proImage['image']['filename'];
		else
			$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/place_holder_image.png';

	
		$html.='<div id="'.$result[0]['productId'].'" class="compareMdin compareMdin-success compareMdin-dismissible fade in" role="compare">
                <button class="close pull-right" aria-label="Close" onclick="closeOne('.$clickPId.')" type="button"><span aria-hidden="true">×</span></button>
                    <div class="compareMdinimg"><img src="'.$image.'" alt=""></div>
                    <div class="compareMdintext">'.$result[0]['productName'].'</div>
                </div>';
		


		/*$html.='<li id="'.$result[0]['productId'].'">
               <div class="comimg">
                   <img src="'.$image.'" />
               </div>
               <p>'.$result[0]['productName'].'</p>
               <p>Rs. '.$ofPrice.'</p> 
               
               <div onclick="closeOne('.$clickPId.')" class="cross02">
               <i class="icon-cancel"></i>
               </div>
               </li>';*/
	}
	
	$html.='<div class="compareMdin-compare"><a onclick="compare();" href="javascript:void(0)">Compare</a></div>
				<input type="hidden" name="comPCount" id="comPCount" value="'.$CI->session->userdata('productCompare').'">
				<input type="hidden" name="comPLimit" id="comPLimit" value="'.$comPLimitCnt.'">
           </div>';
	
	
	/*$html.='</ul>
	<a onclick="compare();" class="combutton">Compare Products</a>
	<input type="hidden" name="comPCount" id="comPCount" value="'.$CI->session->userdata('productCompare').'">
	<div onclick="closeAll();" class="cross03">
       <i class="icon-cancel"></i>
       </div>
       </div>';*/
	}
	else
	{
		$html="";
	}

	echo $html;

	
}




function uncheckOne($id)
{
	$CI = & get_instance();
	$db =& DB();
	$newVal=array();
	$getCurrent=$CI->session->userdata('productCompare');
	if($getCurrent!="")
	{
		if($id==$getCurrent)
		{
			$CI->session->unset_userdata('productCompare');
			$html='<input type="hidden" name="comPCount" id="comPCount" value="">
			<input type="hidden" name="comPLimit" id="comPLimit" value="0">';
		}
		else
		{
		$ex=explode(',', $getCurrent);
		
		if(in_array($id, $ex))
		{
			foreach($ex as $val)
			{
				if($val!=$id)
					$newVal[]=$val;
			}
			//echo "<pre>";
			//print_r($newVal);
			//exit();
			if(count($newVal)>1)
				$newCurrent=implode(',', $newVal);
			else
				$newCurrent=$newVal[0];


			$CI->session->set_userdata('productCompare', $newCurrent);
			
			$proId=explode(',', $CI->session->userdata('productCompare'));
			
			if(!empty($proId))
			{

			$comPLimitCnt=count($proId);				
				
			$html='<div class="compareMd">';
			foreach($proId as $pId)
			{
				$db->where('deleted', '0');
				$db->where('status', '1');
				$db->where('productId', $pId);
				$result = $db->get('product')->result_array();

				$clickPId="'".$pId."'";

				if($result[0]['productSalePrice']>0)
					$ofPrice=$result[0]['productSalePrice'];
				else
					$ofPrice=$result[0]['price'];

				$proImage=getProductPrimaryImage($result[0]['productId']);

				if($proImage['image']['filename']!="")
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/'.$proImage['image']['filename'];
				else
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/place_holder_image.png';

			
				$html.='<div id="'.$result[0]['productId'].'" class="compareMdin compareMdin-success compareMdin-dismissible fade in" role="compare">
                <button class="close pull-right" aria-label="Close" onclick="closeOne('.$clickPId.')" type="button"><span aria-hidden="true">×</span></button>
                    <div class="compareMdinimg"><img src="'.$image.'" alt=""></div>
                    <div class="compareMdintext">'.$result[0]['productName'].'</div>
                </div>';
			
				
				
				
				/*$html.='<li id="'.$result[0]['productId'].'">
				<div class="comimg">
				<img src="'.$image.'" />
				</div>
				<p>'.$result[0]['productName'].'</p>
				<p>Rs. '.$ofPrice.'</p> 
							   
				<div onclick="closeOne('.$clickPId.')" class="cross02">
				<i class="icon-cancel"></i>
				</div>
				</li>';*/
				}
				
				$html.='<div class="compareMdin-compare"><a onclick="compare();" href="javascript:void(0)">Compare</a></div>
				<input type="hidden" name="comPCount" id="comPCount" value="'.$CI->session->userdata('productCompare').'">
				<input type="hidden" name="comPLimit" id="comPLimit" value="'.$comPLimitCnt.'">
            </div>';
				
				
				
				/*$html.='</ul>
				<a onclick="compare();" class="combutton">Compare Products</a>
				<input type="hidden" name="comPCount" id="comPCount" value="'.$CI->session->userdata('productCompare').'">
				<div onclick="closeAll()" class="cross03">
				<i class="icon-cancel"></i>
				</div>
				</div>';*/
				}
				else
				{
					$CI->session->unset_userdata('productCompare');
					$html='<input type="hidden" name="comPCount" id="comPCount" value="">
					<input type="hidden" name="comPLimit" id="comPLimit" value="0">';
					
				}

		}
		else
		{
			$CI->session->unset_userdata('productCompare');
			$html='<input type="hidden" name="comPCount" id="comPCount" value="">
			<input type="hidden" name="comPLimit" id="comPLimit" value="0">';
		}

		}
	}
	else
	{
		$CI->session->unset_userdata('productCompare');
		$html='<input type="hidden" name="comPCount" id="comPCount" value="">
		<input type="hidden" name="comPLimit" id="comPLimit" value="0">';
	}


	echo $html;

	
}


function getOnSessionCompareProducts()
{
	$CI = & get_instance();
	$db =& DB();
	//$result=array('hell','hello world','hollow');
	if($CI->session->userdata('productCompare'))
	{
	$proId=explode(',', $CI->session->userdata('productCompare'));
			
			if(!empty($proId))
			{
				
			$comPLimitCnt=count($proId);
	
			$html='<div class="compareMd">';
			foreach($proId as $pId)
			{
				$db->where('deleted', '0');
				$db->where('status', '1');
				$db->where('productId', $pId);
				$result = $db->get('product')->result_array();

				$clickPId="'".$pId."'";

				if($result[0]['productSalePrice']>0)
					$ofPrice=$result[0]['productSalePrice'];
				else
					$ofPrice=$result[0]['price'];

				$proImage=getProductPrimaryImage($result[0]['productId']);

				if($proImage['image']['filename']!="")
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/'.$proImage['image']['filename'];
				else
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/place_holder_image.png';

			
				$html.='<div id="'.$result[0]['productId'].'" class="compareMdin compareMdin-success compareMdin-dismissible fade in" role="compare">
                <button class="close pull-right" aria-label="Close" onclick="closeOne('.$clickPId.')" type="button"><span aria-hidden="true">×</span></button>
                    <div class="compareMdinimg"><img src="'.$image.'" alt=""></div>
                    <div class="compareMdintext">'.$result[0]['productName'].'</div>
                </div>';
			
				
				
				
				/*$html.='<li id="'.$result[0]['productId'].'">
				<div class="comimg">
				<img src="'.$image.'" />
				</div>
				<p>'.$result[0]['productName'].'</p>
				<p>Rs. '.$ofPrice.'</p> 
							   
				<div onclick="closeOne('.$clickPId.')" class="cross02">
				<i class="icon-cancel"></i>
				</div>
				</li>';*/
				}
				
				$html.='<div class="compareMdin-compare"><a onclick="compare();" href="javascript:void(0)">Compare</a></div>
				<input type="hidden" name="comPCount" id="comPCount" value="'.$CI->session->userdata('productCompare').'">
				<input type="hidden" name="comPLimit" id="comPLimit" value="'.$comPLimitCnt.'">
            </div>';
				
				
				
				/*$html.='</ul>
				<a onclick="compare();" class="combutton">Compare Products</a>
				<input type="hidden" name="comPCount" id="comPCount" value="'.$CI->session->userdata('productCompare').'">
				<div onclick="closeAll()" class="cross03">
				<i class="icon-cancel"></i>
				</div>
				</div>';*/
				}
				else
				{
					$CI->session->unset_userdata('productCompare');
					$html='<input type="hidden" name="comPCount" id="comPCount" value="">
					<input type="hidden" name="comPLimit" id="comPLimit" value="0">';
					
				}
	
		}
		else 
		{
			$CI->session->unset_userdata('productCompare');
			$html='<input type="hidden" name="comPCount" id="comPCount" value="">
			<input type="hidden" name="comPLimit" id="comPLimit" value="0">';
		}
	
	/*echo '<pre>';
	print_r($result);
	exit();*/

	echo $html;
}


// FUNCTIONALITIES FOR COMPARE End


// Recently Viewed Product start

function getRecentlyViewedPros()
{
	$CI = & get_instance();
	$db =& DB();
	//$CI->load->helper('cookie');

	if($CI->input->cookie('recentlyViewed', TRUE)!="null" && $CI->input->cookie('recentlyViewed', TRUE)!="")
	{ 
		
		$res=$CI->input->cookie('recentlyViewed', TRUE);
		$cokExpoVal=explode(',', $res);
		if($cokExpoVal)
		{
			$i=1;
			$html='<div class="panel">
             <div class="panel-heading padd0">Recently Viewed</div>
             <div class="panel-body padd0">
             <ul class="productbox1">';
			foreach($cokExpoVal as $pId)
			{
				$db->where('deleted', '0');
				$db->where('status', '1');
				$db->where('productId', $pId);
				$result = $db->get('product')->result_array();

				$clickPId="'".$pId."'";

				if($result[0]['productSalePrice']>0)
					$ofPrice=$result[0]['productSalePrice'];
				else
					$ofPrice=$result[0]['price'];

				$proImage=getProductPrimaryImage($result[0]['productId']);

				if($proImage['image']['filename']!="")
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/'.$proImage['image']['filename'];
				else
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/place_holder_image.png';

			
				$html.='<li>
                      <div class="pull-left"><img src="'.$image.'" alt=""></div>
                      <div class="pull-left">
                        <div class="pname">'.$result[0]['productName'].'</div>
                        <div class="pull-left padd5">
                          <div class="pprice"><i class="fa fa-inr"></i> '.$ofPrice.'</div>
                          <div class=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png" alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png" alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png" alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png"  alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-d.png" alt=""></div>
                        </div>
                        <div class="pull-right"><a href="'.$CI->config->item("base_url").'index.php/products/details/'.$result[0]['productId'].'" class="btn btn-default">Shop Now</a> 
                        </div>
                      </div>
                    </li>';			
			
		
             if($i==3)
             	break;
             	 
             $i++;   
		
			}
			$html.='</ul>
			</div>
			</div>';
		}
	}
	else
		$html="";
		 
	echo $html;	
	
}

// Recently Viewed Product End


// Recommended Products Start
function getRecommendedProducts()
{
	$CI = & get_instance();
	$db =& DB();
	$html='';
	if($CI->input->cookie('recentlyViewed', TRUE)!="null" && $CI->input->cookie('recentlyViewed', TRUE)!="")
	{
		$blk=array();
		$res=$CI->input->cookie('recentlyViewed', TRUE);
		$cokExpoVal=explode(',', $res);
		foreach($cokExpoVal as $k=>$v)
		{
			$db->where('deleted', '0');
			$db->where('status', '1');
			$db->where('productId',$v);
			$result = $db->get('product')->result_array();
			foreach($result as $inK=>$inV)
			{
				$related_products = (array)json_decode($inV['relatedProduct']);
            if(!empty($related_products))
            {
            	foreach($related_products as $relKey=>$relVal)
            	{
            		if(!in_array($relVal, $blk))
            			$blk[]=$relVal;
            	}
            	
            }
			}
		}
		
		
		
		/*print_r($blk);
		exit();*/
		
		if($blk)
		{
			$html.='<div class="panel panel-default marbtm2">
                <div class="panel-heading">Recommended Products</div>
                <div class="panel-body">
                  <div id="recommended_products">';
         foreach($blk as $pId)
         {
         	$db->where('deleted', '0');
				$db->where('status', '1');
				$db->where('productId', $pId);
				$result = $db->get('product')->result_array();

				$clickPId="'".$pId."'";

				if($result[0]['productSalePrice']>0)
					$ofPrice=$result[0]['productSalePrice'];
				else
					$ofPrice=$result[0]['price'];

				$proImage=getProductPrimaryImage($result[0]['productId']);

				if($proImage['image']['filename']!="")
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/'.$proImage['image']['filename'];
				else
					$image=$CI->config->item("base_url").'assets/uploads/images/thumbnails/place_holder_image.png';
				
				$html.='<div class="item">
                      <div class="prdimg"><img src="'.$image.'" alt=""></div>
                      <div class="pname clearfix text-center">'.$result[0]['productName'].'</div>
                      <div class="clearfix padd8">
                        <div class="pull-left pprice"><i class="fa fa-inr"></i> '.$ofPrice.'</div>
                        <div class="pull-right"><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png" alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png" alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png" alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-a.png"  alt=""><img src="'.$CI->config->item("base_url").'assets/front/images/star-d.png" alt=""></div>
                      </div>
                      <div class="text-center">
                        <a href="'.$CI->config->item("base_url").'index.php/products/details/'.$result[0]['productId'].'" class="btn btn-default paddall">Shop Now</a>
                      </div>
                    </div>';	
         }
         $html.='</div>
			</div>
			</div>';
		}
	}
	
	echo $html;
	
}
// Recommended Products End

?>
