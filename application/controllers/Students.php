<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Students
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 29 July, 2023
 */
class Students extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['student']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('students/studentss', '', TRUE);
        $data['pageTitle'] = "Students";

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
     * "lslt" = "load Students List Table"
     */
    public function lslt(){
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of items in db
        $totalStudents = $this->db->count_all('students');
    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalStudents, "students/lslt", $limit, ['onclick'=>'return lslt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all items from db
        $data['allStudents'] = $this->student->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalStudents > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allStudents'])) . " of " . $totalStudents : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        $data['cum_total'] = $this->student->getItemsCumTotal();
        
        $json['studentsListTable'] = $this->load->view('students/studentslisttable', $data, TRUE);//get view with populated items table
        

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    } 

    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    

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
        
        $this->form_validation->set_rules('studentName', 'Student name', ['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentSurname', 'Student Surname', ['required', 'trim', 'max_length[40]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentId', 'Student Id', ['required', 'trim', 'max_length[20]','is_unique[student_id.code]'],['required' => 'There is already a student with this student id.']);
        $this->form_validation->set_rules('studentClass_name', 'Student Class_name', ['required', 'trim', 'max_length[15]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentGender', 'Student Gender', ['required', 'trim', 'max_length[10]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentParent_phone', 'Student Parent_phone', ['required', 'trim', 'max_length[15]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentAddress', 'Student Address', ['required', 'trim', 'max_length[80]'],['required' => 'The %s field is required.']);
                
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($studentName, $studentSurname, $studentStudent_id, $studentClass_name, $studentGender, $studentParent_name,$studentParent_phone,$studentAddress,$studentFees)
             */
            $insertedId = $this->student->add(set_value('studentName'), set_value('studentSurname'), set_value('studentStudent_id'), 
                    set_value('studentClass_name'), set_value('studentGender'),set_value('studentParent_name'),set_value('studentParent_phone'),set_value('studentAddress'),set_value('studentFees'));
            
            $studentName = set_value('studentName');
            $studentSurname = set_value('studentSurname');
            $studentStudent_id = set_value('studentStudent_id');
            $studentParent_name= set_value('studentParent_name');
            $studentAddress = set_value('studentAddress');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$studentName} {$studentSurname} as a new student with ID '{$studentStudent_id}', Parent Name '{$studentParent_name}'and Address '{$studentAddress}' to the Students.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Student", $insertedId, $desc, "students", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status'=>1, 'msg'=>"Student successfully added"] 
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
    
    
    /**
     * Primarily used to check whether a student already has a particular random student id  being generated for a new item
     * @param type $selColName
     * @param type $whereColName
     * @param type $colValue
     */
    public function gettablecol($selColName, $whereColName, $colValue){
        $a = $this->genmod->gettablecol('students', $selColName, $whereColName, $colValue);
        
        $json['status'] = $a ? 1 : 0;
        $json['colVal'] = $a;
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
     * 
     */
    public function gcoandqty(){
        $json['status'] = 0;
        
        $studentStudent_id = $this->input->get('_iC', TRUE);
        
        if($studentStudent_id){
            $student_info = $this->student->getItemInfo(['student_id'=>$studentStudent_id], ['name', 'surname', 'class_name', 'parent_name','parent_phone','address']);

            if($student_info){
                $json['studentName'] = $student_info->name;
                $json['studentSurname'] = $student_info->surname;
                $json['studentClass_name'] = $student_info->class_name;
                $json['studentParent_name'] = $student_info->parent_name;
                $json['studentParent_phone'] = $student_info->parent_phone;
                $json['studentAddress'] = $student_info->address;
                $json['status'] = 1;
            }
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
    
    
   
   /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    // edit these details ($studentId, $studentName, $studentSurname, $studentClass_name, $studentParent_name, $studentParent_phone,$studentFees)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        
        $this->form_validation->set_rules('_sId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('itemName', 'Item Name', ['required', 'trim', 'callback_crosscheckName['.$this->input->post('_sId', TRUE).']'], ['required'=>'required']);
        $this->form_validation->set_rules('itemCode', 'Item Code', ['required', 'trim', 
            'callback_crosscheckCode['.$this->input->post('_sId', TRUE).']'], ['required'=>'required']);
        $this->form_validation->set_rules('itemPrice', 'Item Unit Price', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('itemDesc', 'Item Description', ['trim']);
        
        if($this->form_validation->run() !== FALSE){
            $itemId = set_value('_sId');
            $itemDesc = set_value('itemDesc');
            $itemPrice = set_value('itemPrice');
            $itemName = set_value('itemName');
            $itemCode = $this->input->post('itemCode', TRUE);
            
            //update item in db
            $updated = $this->item->edit($itemId, $itemName, $itemDesc, $itemPrice);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of item with code '$itemCode' was updated";
            
            $this->genmod->addevent("Item Update", $itemId, $desc, 'items', $this->session->admin_id);
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
    
    public function crosscheckName($itemName, $itemId){
        //check db to ensure name was previously used for the item we are updating
        $itemWithName = $this->genmod->getTableCol('items', 'id', 'name', $itemName);
        
        //if item name does not exist or it exist but it's the name of current item
        if(!$itemWithName || ($itemWithName == $itemId)){
            return TRUE;
        }
        
        else{//if it exist
            $this->form_validation->set_message('crosscheckName', 'There is an item with this name');
                
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
    
    
    /**
     * 
     * @param type $item_code
     * @param type $item_id
     * @return boolean
     */
    public function crosscheckCode($item_code, $item_id){
        //check db to ensure item code was previously used for the item we are updating
        $item_with_code = $this->genmod->getTableCol('items', 'id', 'code', $item_code);
        
        //if item code does not exist or it exist but it's the code of current item
        if(!$item_with_code || ($item_with_code == $item_id)){
            return TRUE;
        }
        
        else{//if it exist
            $this->form_validation->set_message('crosscheckCode', 'There is an item with this code');
                
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
    
    
    public function delete(){
        $this->genlib->ajaxOnly();
        
        $json['status'] = 0;
        $item_id = $this->input->post('i', TRUE);
        
        if($item_id){
            $this->db->where('id', $item_id)->delete('items');
            
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}