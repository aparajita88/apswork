<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( BASEPATH .'database/DB'. EXT );
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
//$route['users/admin/(:any)'] = "admin/$1";
$route['default_controller'] = "home/index";
$route['admin'] = "users/adminLogin";
$route['login'] = "login/Login";
$route['country_management'] = "countries/index";
$route['city_management'] = "citis/index";
$route['404_override'] = '';
/*
$db =& DB();
//For CMS pages
$query = $db->get('cms_pages');
$result = $query->result();
foreach( $result as $row )
{
	$route[ $row->slug ]= 'cms/pagedata/'.$row->pageId;
}



// For category/brand product listing
$db->join('product_brand','product_brand.productBrandId=product_brand_to_category.productBrandId','INNER');
$db->join('product_category','product_category.productCategoryId=product_brand_to_category.productCategoryId','INNER');
$db->group_by('product_brand_to_category.productBrandId, product_brand_to_category.productCategoryId');
$db->select('product_brand_to_category.productBrandId, product_brand_to_category.productCategoryId, product_brand.slug as brndSlug, product_category.slug as catSlug');
$queryBrndCat = $db->get('product_brand_to_category');
$resultBrndCat = $queryBrndCat->result();
foreach( $resultBrndCat as $rowBrndCat )
{
 	$route[ $rowBrndCat->catSlug.'/'.$rowBrndCat->brndSlug ]= 'cms/pagedata/'.$row->pageId;
}


// For Categories Product listing
$db->select('productCategoryId, slug');
$queryCat = $db->get('product_category');
$resultCat = $queryCat->result();

foreach( $resultCat as $rowCat )
{
 	$route[ $rowCat->slug ]= 'products/getCatProducts/'.$rowCat->productCategoryId;
}
*/


/* End of file routes.php */
/* Location: ./application/config/routes.php */
