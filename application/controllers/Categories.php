<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Categories
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 14 August, 2023
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
     * "lclt" = "load Categories List Table"
     */
    public function lclt(){
       
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of Categories in db
        $totalCategories = $this->db->count_all('categories');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalCategories, "categories/lclt", $limit, ['onclick'=>'return lclt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all Categories from db
        $data['allCategories'] = $this->category->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalCategories > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allCategories'])) . " of " . $totalCategories : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['categoriesListTable'] = $this->load->view('categories/categorieslisttable', $data, TRUE);//get view with populated categories table
        

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

        
        $this->form_validation->set_rules('categorieName', 'Categorie Name', ['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('categorieDescription', 'Catehorie Description', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
       
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($categorieName, $categorieDescription)
             */

            $insertedId = $this->category->add(set_value('categorieName'), set_value('categorieDescription'));
            
            $categorieName = set_value('categorieName');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$categorieName} as a new Category to the Categories.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Category", $insertedId, $desc, "categories", $this->session->admin_id) : "";
            
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
    // edit these details ($categorieId, $categorieName,$categorieDescription)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
    

        $this->form_validation->set_rules('_cId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('categorieName', 'Categorie Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('categorieDescription', 'Categorie Description', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        

        if($this->form_validation->run() !== FALSE){
            $categorieId = set_value('_cId');
            $categorieName = set_value('categorieName');
            $categorieDescription = set_value('categorieDescription');

           
            //update Category in db
            $updated = $this->category->edit($categorieId, $categorieName, $categorieDescription);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of Category with  Name '$categorieName' was updated";
            
            $this->genmod->addevent("Category Update", $categorieId, $desc, 'categories', $this->session->admin_id);
        }
        
        else{
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
    
    public function delete(){

        $this->genlib->ajaxOnly();

        $json['status'] = 0;
        $categoryId = $this->input->post('i', TRUE);

        if ($categoryId) {
           
            $categoryInfo = $this->category->getCategorieInfo(['id' => $categoryId], ['name']);

            if ($categoryInfo !== false) {
                $categoryName = $categoryInfo->name;

                // Check if the category name is "Salary" (case-insensitive)
                if (strcasecmp($categoryName, 'Salary') == 0) {
                    $json['message'] = 'You cannot delete the "'.$categoryName.'" category.';
                } else {
                    // Delete the category if it's not "Salary"
                    $this->db->where('id', $categoryId)->delete('categories');
                    $json['status'] = 1;
                }
            } else {
                // Handle the case where the category with the provided ID does not exist
                $json['message'] = 'Category not found.';
            }
        }

        // Set the final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    
}