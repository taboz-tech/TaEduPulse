<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Staff
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 13 August, 2023
 */
class Staffs extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['staff']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('staffs/staffs', '', TRUE);
        $data['pageTitle'] = "Staffs";

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
     * "lslt" = "load Staff List Table"
     */
    public function lslt(){
       
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of Staff in db
        $totalStaffs = $this->db->count_all('staffs');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalStaffs, "staffs/lslt", $limit, ['onclick'=>'return lslt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all staff from db
        $data['allStaffs'] = $this->staff->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalStaffs > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allStaffs'])) . " of " . $totalStaffs : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['staffsListTable'] = $this->load->view('staffs/staffslisttable', $data, TRUE);//get view with populated staff table
        

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

        
        $this->form_validation->set_rules('staffName', 'Staff Name', ['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffSurname', 'Staff Surname', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffGender', 'Staff Gender', ['required', 'trim', 'max_length[10]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffPhone', 'Staff Phone', ['required', 'trim', 'max_length[15]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffAddress', 'Staff Address', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffEmail', 'Staff Email',['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffDepartment', 'Staff Department', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        $this->form_validation->set_rules('staffNational_id','National ID','required|regex_match[/^\d{2}\d{6}[A-Z]\d{2}$/]',['required' => 'The %s field is required.','regex_match' => 'Invalid National ID format. It should consist of two digits, followed by six digits, a single uppercase letter, and two digits.']);
        $this->form_validation->set_rules('staffStaff_id', 'Staff ID', 'required|trim|max_length[20]', ['required' => 'The %s field is required.', 'max_length' => 'The %s field cannot exceed 20 characters.']);
        $this->form_validation->set_rules('staffSalary', 'Staff Salary', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);

        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($staffName, $staffSurname, $staffGender, $staffStaff_id, $staffPhone,$staffAddress,$staffDepartment,$staffNational_id,$staffEmail,$staffDob,$staffJob_tittle,$staffSalary)
             */

            $insertedId = $this->staff->add(set_value('staffName'), set_value('staffSurname'), set_value('staffGender'), 
                    set_value('staffStaff_id'), set_value('staffPhone'),set_value('staffAddress'),set_value('staffDepartment'),set_value('staffNational_id'),set_value('staffEmail'),set_value('staffDob'),set_value('staffJob_tittle'), set_value('staffSalary'));
            
            $staffName = set_value('staffName');
            $staffSurname = set_value('staffSurname');
            $staffNational_id = set_value('staffNational_id');
            $staffAddress= set_value('staffAddress');
            $staffEmail = set_value('staffEmail');
            $staffSalary = set_value('staffSalary');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$staffName} {$staffSurname} as  new Staff with  Address '{$staffAddress}',National ID '{$staffNational_id}', Salary of '{$staffSalary}' and Email '{$staffEmail}'to Staff.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Staff", $insertedId, $desc, "staffs", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status'=>1, 'msg'=>"Staff successfully added"] 
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
    // edit these details edit($staffId, $staffName, $staffSurname, $staffPhone, $staffAddress,$staffEmail,$staffDepartment,$staffNational_id,$staffGender,$staffDob,$staffJob_tittle)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
    

        $this->form_validation->set_rules('_sId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('staffName', 'Staff Name', ['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffSurname', 'Staff Surname', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffGender', 'Staff Gender', ['required', 'trim', 'max_length[10]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffPhone', 'Staff Phone', ['required', 'trim', 'max_length[15]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffAddress', 'Staff Address', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffEmail', 'Staff Email',['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('staffDepartment', 'Staff Department', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        $this->form_validation->set_rules('staffNational_id','National ID','required|regex_match[/^\d{2}\d{6}[A-Z]\d{2}$/]',['required' => 'The %s field is required.','regex_match' => 'Invalid National ID format. It should consist of two digits, followed by six digits, a single uppercase letter, and two digits.']);
        $this->form_validation->set_rules('staffSalary', 'Staff Salary', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        $this->form_validation->set_rules('staffAdvancePayment', 'Staff Advance Payment', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        $this->form_validation->set_rules('staffOvertime', 'Staff Overtime', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);

        if($this->form_validation->run() !== FALSE){
            $staffId = set_value('_sId');
            $staffName = set_value('staffName');
            $staffSurname = set_value('staffSurname');
            $staffPhone = set_value('staffPhone');
            $staffAddress = set_value('staffAddress');
            $staffEmail = set_value('staffEmail');
            $staffDepartment = set_value('staffDepartment');
            $staffNational_id = set_value('staffNational_id');
            $staffGender = set_value('staffGender');
            $staffDob = set_value('staffDob');
            $staffJob_tittle = set_value('staffJob_tittle');
            $staffSalary = set_value('staffSalary');
            $staffAdvancePayment = set_value('staffAdvancePayment');
            $staffOvertime = set_value('staffOvertime');

   
            //update Staff in db
            $updated = $this->staff->edit($staffId, $staffName, $staffSurname, $staffPhone, $staffAddress,$staffEmail,$staffDepartment,$staffNational_id,$staffGender,$staffDob,$staffJob_tittle,$staffSalary,$staffAdvancePayment,$staffOvertime);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of Staff with Staff Name '$staffName' was updated";
            
            $this->genmod->addevent("Staff Update", $staffId, $desc, 'staffs', $this->session->admin_id);
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
        $staffId = $this->input->post('i', TRUE);
        
        if($staffId){
            $this->db->where('id', $staffId)->delete('staffs');
            
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

    public function suspend(){
        $this->genlib->ajaxOnly();
        
        $staff_id = $this->input->post('_sId');
        $new_status = $this->genmod->gettablecol('staffs', 'status', 'id', $staff_id) == 1 ? 0 : 1;
        
        $done = $this->staff->suspend($staff_id, $new_status);
        
        $json['status'] = $done ? 1 : 0;
        $json['_ns'] = $new_status;
        $json['_sId'] = $staff_id;
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }


    public function lastStaffIdForMonth() {
        // Get the current month in YYMM format (e.g., "2209" for September 2022)
        $currentMonth = date('Ym');

        // Initialize JSON response with a status of 0
        $json['status'] = 0;

        try {
            // Call the model method to get the last student ID for the current month
            $lastStaffId = $this->staff->getLastStaffIdForMonth($currentMonth);

            if ($lastStaffId !== null) {
                // Extract the last three digits and increment them
                $lastThreeDigits = substr($lastStaffId, -3);
                $newLastThreeDigits = str_pad((int)$lastThreeDigits + 1, 3, '0', STR_PAD_LEFT);

                // Generate the new staff ID with "TAC" as the prefix
                $newStaffId = "TAC{$currentMonth}{$newLastThreeDigits}";

                // Set status to 1 to indicate success
                $json['status'] = 1;

                // Include the new staff ID and added one in the response
                $json['message'] = "New Student ID for {$currentMonth}: {$newStaffId}";
                $json['newStaffId'] = $newStaffId;
                $json['addedOne'] = $newLastThreeDigits;
            } else {
                // No student ID found for the current month, use "000" for the last three digits
                $newLastThreeDigits = "000";
                
                // Generate the new student ID with "TAB" as the prefix
                $newStudentId = "TAC{$currentMonth}{$newLastThreeDigits}";

                // Set status to 1 to indicate success
                $json['status'] = 1;

                // Include the new student ID in the response
                $json['message'] = "No staff IDs found for {$currentMonth}, creating a new one: {$newStudentId}";
                $json['newStaffId'] = $newStudentId;
            }
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }

        // Encode the response as JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}