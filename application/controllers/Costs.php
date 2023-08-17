<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Costs
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 14 August, 2023
 */
class Costs extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['cost']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('costs/costs', '', TRUE);
        $data['pageTitle'] = "Costs";

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
     * "lclt" = "load Cost List Table"
     */
    public function lclt(){
       
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of Costs in db
        $totalCosts = $this->db->count_all('costs');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalCosts, "costs/lclt", $limit, ['onclick'=>'return lclt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all Costs from db
        $data['allCosts'] = $this->cost->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalCosts > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allCosts'])) . " of " . $totalCosts : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['costsListTable'] = $this->load->view('costs/costslisttable', $data, TRUE);//get view with populated costs table
        

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

        
        $this->form_validation->set_rules('costName', 'Cost Name', ['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('costAmount', 'Cost Amount', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        $this->form_validation->set_rules('costCategory', 'Cost Category', ['required', 'trim', 'max_length[20]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('costDescription', 'Cost Description', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('costCurrency', 'Cost Currency', ['required', 'trim', 'max_length[15]'],['required' => 'The %s field is required.']);
       
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($costName, $costAmount, $costCategory, $costDescription, $costCurrency)
             */

            $insertedId = $this->cost->add(set_value('costName'), set_value('costAmount'), set_value('costCategory'), 
                    set_value('costDescription'), set_value('costCurrency'));
            
            $costName = set_value('costName');
            $costAmount = set_value('costAmount');
            $costCategory= set_value('costCategory');
            $costCurrency = set_value('costCurrency');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$costName} as a new Cost with  Amount '{$costAmount}',Currency '{$costCurrency}' and Category '{$costCategory}'to the Costs.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Cost", $insertedId, $desc, "costs", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status'=>1, 'msg'=>"Cost successfully added"] 
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
    // edit these details ($costId, $costName, $costAmount, $costCategory, $costDescription,$costCurrency)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
    

        $this->form_validation->set_rules('_cId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('costName', 'Cost Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('costAmount', 'Cost Amount', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        $this->form_validation->set_rules('costCategory', 'Cost Category', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('costDescription', 'Cost Description', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        $this->form_validation->set_rules('costCurrency','Cost Currency',['required','trim','max_length[15]'],['required'=>'required']);
        

        if($this->form_validation->run() !== FALSE){
            $costId = set_value('_cId');
            $costName = set_value('costName');
            $costAmount = set_value('costAmount');
            $costCategory = set_value('costCategory');
            $costDescription = set_value('costDescription');
            $costCurrency = set_value('costCurrency');

           
            //update Cost in db
            $updated = $this->cost->edit($costId, $costName, $costAmount, $costCategory,$costDescription,$costCurrency);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of Cost with  Name '$costName' was updated";
            
            $this->genmod->addevent("Cost Update", $costId, $desc, 'costs', $this->session->admin_id);
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
        $costId = $this->input->post('i', TRUE);
        
        if($costId){
            $this->db->where('id', $costId)->delete('costs');
            
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function getCategoriesForSelect(){
        $this->genlib->ajaxOnly();
    
        $orderBy = 'name'; // Order Teachers by name
        $orderFormat = 'ASC';
    
        $this->load->model(['category']); // Load the Teacher model
    
        // Call the getAll function from the Teacher model to fetch Teachers
        $categories = $this->category->getAll($orderBy, $orderFormat);
    
        if ($categories !== FALSE) {
            $json['status'] = 1;
            $json['categories'] = $categories; // Return the list of Teachers
        } else {
            $json['status'] = 0;
            $json['message'] = "No Categories found.";
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}