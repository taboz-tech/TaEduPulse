<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Categories
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 25th Jun, 2023
 */
class Categories extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['category']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('categories/categories', '', TRUE);

        $data['pageTitle'] = "Categories";

        $this->load->view('main', $data);
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
     * "lclt" = "load Categorie List Table"
     */
    public function lclt(){
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of categories in db
        $totalCategories = $this->db->count_all('categories');
        
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration
        
        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalCategories, "categories/lclt", $limit, ['onclick'=>'return lclt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all categories from db
        $data['allCategories'] = $this->category->getAll($orderBy, $orderFormat, $start, $limit);

        $data['range'] = $totalCategories > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allCategories'])) . " of " . $totalCategories : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['categoriesListTable'] = $this->load->view('categories/categorieslisttable', $data, TRUE);//get view with populated Categories table


        $this->output->set_content_type('application/json')->set_output(json_encode($json));
        
    }
    

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    
    public function add(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        
        $this->form_validation->set_rules('categorieName', 'Categorie name', ['required', 'trim', 'max_length[30]', 'is_unique[categories.name]'], ['required'=>"required"]);
        $this->form_validation->set_rules('categorieStatus', 'Categorie Status', ['required', 'trim', 'numeric', 'in_list[0,1]'], ['required' => 'The Categorie Status field is required.']);
        $this->form_validation->set_rules( 'categoriePercentage', 'Categorie Percentage', ['required', 'trim', 'numeric'], ['required' => 'The Categorie Percentage field is required.']);
        
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($categoriename, $categorieStatus, $categoriePercentage)
             */
            $insertedId = $this->category->add(set_value('categorieName'), set_value('categorieStatus'), set_value('categoriePercentage'));
            
            $categorieName = set_value('categorieName');
            $categorieStatus = set_value('categorieStatus');
            $categoriePercentage = "$".number_format(set_value('categoriePercentage'), 2);
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of '{$categorieName}' into Categories with a price percentage of {$categoriePercentage}";
            
            $insertedId ? $this->genmod->addevent("Creation of new categorie", $insertedId, $desc, "categories", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status'=>1, 'msg'=>"Category successfully added"] 
                    : 
                    ['status'=>0, 'msg'=>"Oops! Unexpected server error! Please contact administrator for help. Sorry for the embarrassment"];
        }
        
        else{
            //return all error messages
            $json = $this->form_validation->error_array();//get an array of all errors
            
            $json['msg'] = "One or more required fields are empty or not correctly filled";
            $json['status'] = 0;
        }
                    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
   
   
   /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
   

    public function edit(){
        $this->genlib->ajaxOnly();
    
        $this->load->library('form_validation');
    
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('_cId', 'Category ID', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('categorieName', 'Categorie Name', ['required', 'trim', 'max_length[25]', 'callback_crosscheckName['.$this->input->post('_cId', TRUE).']'], ['required'=>'required']);
        $this->form_validation->set_rules('categorieStatus', 'Categorie Status', ['required', 'trim', 'in_list[0,1]']);
        $this->form_validation->set_rules('categoriePercentage', 'Categorie Percentage', ['required', 'trim', 'numeric']);
    
        if($this->form_validation->run() !== FALSE){
            $categorieId = set_value('_cId');
            $categorieName = set_value('categorieName');
            $categorieStatus = set_value('categorieStatus');
            $categoriePercentage = set_value('categoriePercentage');

            //update Categorie in db
            $updated = $this->category->edit($categorieId, $categorieName, $categorieStatus, $categoriePercentage);

    
            $json['status'] = $updated ? 1 : 0;

            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of category with ID '$categorieId' was updated";
            $this->genmod->addevent("Category Update", $categorieId, $desc, 'categories', $this->session->admin_id);
        } else {
            $json['status'] = 0;
            $json = $this->form_validation->error_array();
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    


   /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function crosscheckName($categorieName, $categorieId){
        //check db to ensure name was previously used for the Categorie we are updating
        $categorieWithName = $this->genmod->getTableCol('categories', 'id', 'name', $categorieName);
        
        //if Categorie name does not exist or it exist but it's the name of current Categorie
        if(!$categorieWithName || ($categorieWithName == $categorieId)){
            return TRUE;
        }
        
        else{//if it exist
            $this->form_validation->set_message('crosscheckName', 'There is a categorie with this name');
                
            return FALSE;
        }
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function loadcat(){
        $this->genlib->ajaxOnly();
        $data['allCategories'] = $this->category->getCat();


    }
    
     /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function delete(){
        $this->genlib->ajaxOnly();
        
        $json['status'] = 0;
        $categorie_id = $this->input->post('i', TRUE);
        
        if($categorie_id){
            $this->db->where('id', $categorie_id)->delete('categories');
            
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}