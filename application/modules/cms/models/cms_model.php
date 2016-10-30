<?php

class cms_model extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
          	$this->load->database();
          	
    }
      public function get_email_templates(){
    	$this->db->order_by("dateAdded", "desc");
		$this->db->select("email_templates.*");
		$this->db->from('email_templates');
		
		$query=$this->db->get();
		if(!empty($query->result_array()[0])){
			return $query->result_array();	
		}else{
			return array();
		}
	}
	public function addTemplate($data=array())
	{
        $result = $this->db->insert('email_templates', $data); 
        return $result;
	}
	public function getTemplatebyId($id=''){
       $query = $this->db->get_where('email_templates', array('emailId' => $id));
        return $query->result_array();

	}
	public function editTemplate($data=array(),$id=''){
         $this->db->where('emailId', $id);
		$result = $this->db->update('email_templates', $data); 
        return $result;

}
    public function get_cms_content($var){
		
		$query=$this->db->query("SELECT cms_pages.content,cms_pages.title,cms_pages.meta_keywords,cms_pages.image, page_category.pageCategoryName,page_category.categoryDescription FROM cms_pages  
			left join page_category  on page_category.pageCategoryId = cms_pages.categoryId 
			WHERE page_category.pageCategoryName='$var'");
        return $query->result_array();
	}
	public function cms_content_about($var){
		$query=$this->db->query("SELECT page_category.categoryDescription FROM page_category
			WHERE page_category.pageCategoryName='$var'");
        return $query->result_array();
	}
	 public function get_cms_content_home($var,$index){
		
		$sql = "select * from page_category p1 INNER JOIN page_category p2 on p1.pageCategoryId=p2.parentCategoryId 
			where p1.pageCategoryName='".$var."'";
	    $query=$this->db->query($sql);
        $qry=$query->result_array();
        $s1="SELECT cms_pages.content,cms_pages.title,cms_pages.slug,cms_pages.image FROM cms_pages where cms_pages.status='1' and cms_pages.subpage_categoryid= '".$qry["$index"]['pageCategoryId']."'";
        $query=$this->db->query($s1);
        $qry1=$query->result_array();
        
        return $qry1;
	}
	public function get_cms_page_content($slug){
		$this->db->select("cms_pages.*");
		$this->db->from('cms_pages');
		$this->db->where('cms_pages.slug',$slug);
		$this->db->where('cms_pages.status','1');
		$query=$this->db->get();
		if(!empty($query->result_array()[0])){
			return $query->result_array()[0];	
		}else{
			return array();
		}
	}
	public function getAllPage()
	{
		$query=$this->db->query("SELECT cp.*, c.pageCategoryName FROM cms_pages cp 
			left join page_category c on cp.categoryId = c.pageCategoryId 
			WHERE cp.deleted='0'");
        return $query->result_array();
	}
	public function getAllPageBy5()
	{
		$query=$this->db->query("SELECT cp.*, c.pageCategoryName FROM cms_pages cp 
			left join page_category c on cp.categoryId = c.pageCategoryId 
			WHERE cp.deleted='0' ORDER BY dateModified DESC LIMIT 0, 5 ");
        return $query->result_array();
	}
	public function get_pages_bycategory($id){
	$query=$this->db->query("SELECT cp.*, c.pageCategoryName FROM cms_pages cp 
			left join page_category c on cp.categoryId = c.pageCategoryId 
			WHERE c.pageCategoryId='".$id."'");
        return $query->result_array();
		
	}
	public function getsubcatname($var){
		
	$sql = "SELECT  p1.pageCategoryName FROM page_category AS p1 where p1.pageCategoryId='".$var."'";
	 $query=$this->db->query($sql);
     return $query->result_array();
		 
	}

	public function addCategory($data=array())
	{
        $result = $this->db->insert('page_category', $data); 
        return $result;
	}
	
	public function editCategory($data=array(),$id='')
	{
		$this->db->where('pageCategoryId', $id);
		$result = $this->db->update('page_category', $data); 
        return $result;
	}
	
	public function deleteCategory($id='')
	{
		$result = $this->db->delete('page_category', array('pageCategoryId' => $id)); 
		return $result;
	}
	
	public function getCategory($data=array())
	{
		$category="";
		$this->db->order_by("dateAdded", "desc");
		$query = $this->db->get_where('page_category', array('parentCategoryId' => $category)); 
        return $query->result_array();
	}
	public function getsubCategory(){
		$this->db->order_by("dateAdded", "desc");
		$query = $this->db->get_where('page_category', array('parentCategoryId' => '434ee06d-b07c-05'));
        return $query->result_array();	
		
		
		
	}
	public function getsubpageCategory($data=array())
	{
		$query=$this->db->query("SELECT page_category.* from page_category
			WHERE page_category.parentCategoryId !='' ");
        return $query->result_array();
     
	}
	
	public function getCategorybyId($id='')
	{
		$query = $this->db->get_where('page_category', array('pageCategoryId' => $id));
        return $query->result_array();
	}
	
	public function addPage($data=array())
	{
        $result = $this->db->insert('cms_pages', $data); 
        return $result;
	}
	
	public function editPage($data=array(),$id='')
	{
		$this->db->where('pageId', $id);
		$result = $this->db->update('cms_pages', $data); 
        return $result;
	}
	
	public function deletePage($id='')
	{
		$result = $this->db->delete('cms_pages', array('pageId' => $id)); 
		return $result;
	}
	
	
	
	public function getPagebyId($id='')
	{
		$query = $this->db->get_where('cms_pages', array('pageId' => $id));
        return $query->result_array();
	}
	
	public function getMerchantList()
	{

            $query=$this->db->query("SELECT * FROM tenant WHERE tenantId!='1' AND status = 1 AND deleted='0'");
            return $query->result_array();

	}

	public function pageCount($tentId='')
	{
          
		$query=$this->db->query("SELECT * FROM cms_pages WHERE deleted='0' AND status=1");
            
		return $totRow=$query->num_rows();
	}
        

	public function getcmsListPagination($tentId='',$per_pg,$offset)
	{
		if($offset=="")
			$offset=0;
               
                $query=$this->db->query("select * from cms_pages  where deleted='0' ORDER BY dateModified DESC limit $offset , $per_pg");
		
		return $query->result_array();
	}
	
	public function getTotCmsPages()
	{
			$query=$this->db->query("select * from cms_pages  where deleted='0' ORDER BY dateModified DESC");
		
			return $query->result_array();
	}

	public function PageDelete($crsId)
	{
		$this->db->set("deleted", '1');
		$this->db->where("pageId", $crsId);
		$this->db->update("cms_pages");
	}

	public function PageEdit($crsId)
	{
		$query=$this->db->query("SELECT * FROM cms_pages WHERE pageId = '$crsId'");
		
		return $query->result_array();
	}

	public function updPageInfo($updData)
	{
		
		$this->db->where('pageId',$this->input->post('crs_id'));
		$this->db->update('cms_pages',$updData);
	}

    public function get_subcategories_forcategory($id){
		
	$query=$this->db->query("SELECT * FROM page_category WHERE parentCategoryId = '$id'");
		
		return $query->result_array();	
	}
	public function changeStatus($crsId,$val)
	{
		if($val==1)
		{
			$this->db->set("status", 0);
			$this->db->where("pageId", $crsId);
			$this->db->update("cms_pages");

			
		}
		else
		{
			$this->db->set("status", 1);
			$this->db->where("pageId", $crsId);
			$this->db->update("cms_pages");

			
		}
		$query=$this->db->query("select * from cms_pages where pageId='$crsId'");
		return $query->result_array();

		
	}

        public function attributeValueList($Id='')
	{

                 $query=$this->db->query("SELECT * FROM product_attribute_value WHERE productAttributeId='$Id' AND status = 1 AND deleted='0'");
		return $query->result_array();

	}
        public function attributeValueDelete($crsId)
	{
		$this->db->set("deleted", '1');
		$this->db->where("productAttributeValueId", $crsId);
		$this->db->update("product_attribute_value");
	}
        public function addAttributeValue($res)
	{
		$this->db->insert('product_attribute_value', $res);
	}
        


}
?>
