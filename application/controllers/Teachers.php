<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Teachers
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 13 August, 2023
 */
class Teachers extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['teacher']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('teachers/teachers', '', TRUE);
        $data['pageTitle'] = "Teachers";

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
     * "ltlt" = "load Teachers List Table"
     */
    public function ltlt(){
       
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of Teachers in db
        $totalTeachers = $this->db->count_all('teachers');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalTeachers, "teachers/ltlt", $limit, ['onclick'=>'return ltlt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all teachers from db
        $data['allTeachers'] = $this->teacher->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalTeachers > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allTeachers'])) . " of " . $totalTeachers : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['teachersListTable'] = $this->load->view('teachers/teacherslisttable', $data, TRUE);//get view with populated teachers table
        

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    } 

    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function add() {
        
        $this->genlib->ajaxOnly();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    
        $this->form_validation->set_rules('teacherName', 'Teacher Name', ['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('teacherSurname', 'Teacher Surname', ['required', 'trim', 'max_length[40]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('teacherGender', 'Teacher Gender', ['required', 'trim', 'max_length[10]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('teacherSubject', 'Teacher Subject',['required', 'trim', 'max_length[100]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('teacherDepartment', 'Teacher Department', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        
    
        if ($this->form_validation->run() !== FALSE) {

            // Check if the staff member with the provided name and surname exists
            $teacherName = set_value('teacherName');
            $teacherSurname = set_value('teacherSurname');
            if ($this->teacher->staffExists($teacherName, $teacherSurname)) {
                
                // The staff member exists, so you can proceed to add the teacher
                $this->db->trans_start(); // Start transaction
    
                /**
                 * Insert info into db
                 * Function header: add($teacherName, $teacherSurname, $teacherGender, $teacherSubject, $teacherDepartment)
                 */
    
                $insertedId = $this->teacher->add(
                    set_value('teacherName'),
                    set_value('teacherSurname'),
                    set_value('teacherGender'),
                    set_value('teacherSubject'),
                    set_value('teacherDepartment'),
                    set_value('teacherProfession')
                );

                $teacherSubject = set_value('teacherSubject');
                
    
                // Insert into eventlog
                // Function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
                $desc = "Addition of {$teacherName} {$teacherSurname} as a new Teacher for '{$teacherSubject}'to the Teachers.";
    
                $insertedId ? $this->genmod->addevent("Creation of new Teacher", $insertedId, $desc, "teachers", $this->session->admin_id) : "";
    
                $this->db->trans_complete();
    
                $json = $this->db->trans_status() !== FALSE ?
                    ['status' => 1, 'msg' => "Teacher successfully added"]
                    :
                    ['status' => 0, 'msg' => "Oops! Unexpected server error! Please contact the administrator for help. Sorry for the inconvenience"];
            } else {
                // The staff member does not exist, so prompt the user to create a staff member first
                $json = ['status' => 0, 'msg' => "Please create a staff member with the name '$teacherName' and surname '$teacherSurname' before adding a teacher."];
            }
        } else {
            // Form validation failed
            $json = $this->form_validation->error_array();
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
    // edit these details ($teacherId, $teacherName, $teacherSurname, $teacherPhone, $teacherAddress,$teacherSubject)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
    

        $this->form_validation->set_rules('_tId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('teacherName', 'Teacher Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('teacherSurname', 'Teacher Surname', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('teacherSubject', 'Teacher Subject', ['required', 'trim', 'max_length[100]'], ['required'=>'required']);
        $this->form_validation->set_rules('teacherDepartment', 'Teacher Department', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        

        if($this->form_validation->run() !== FALSE){
            $teacherId = set_value('_tId');
            $teacherName = set_value('teacherName');
            $teacherSurname = set_value('teacherSurname');
            $teacherSubject = set_value('teacherSubject');
            $teacherDepartment = set_value('teacherDepartment');
            $teacherProfession = set_value('teacherProfession');

           
            //update Teacher in db
            $updated = $this->teacher->edit($teacherId, $teacherName, $teacherSurname,$teacherSubject,$teacherDepartment,$teacherProfession);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of Teacher with Teacher Name '$teacherName' was updated";
            
            $this->genmod->addevent("Teacher Update", $teacherId, $desc, 'teachers', $this->session->admin_id);
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
        $teacherId = $this->input->post('i', TRUE);
        
        if($teacherId){
            $this->db->where('id', $teacherId)->delete('teachers');
            
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function getDetails(){
        $this->genlib->ajaxOnly();
    
        try {
            $json['status'] = 0;
            $staffId = $this->input->post('_sId', TRUE);
            if($staffId){
                $data['name'] = $this->genmod->getTableCol('staffs', 'name', 'staff_id', $staffId);
                $data['surname'] = $this->genmod->getTableCol('staffs', 'surname', 'staff_id', $staffId);
                $data['gender'] = $this->genmod->getTableCol('staffs', 'gender', 'staff_id', $staffId);
                $data['department'] = $this->genmod->getTableCol('staffs', 'department', 'staff_id', $staffId);
    
                if ($data['name'] !== FALSE && $data['surname'] !== FALSE && $data['gender'] !== FALSE && $data['department'] !== FALSE) {
                    // Data retrieval successful, set status to 1
                    $json['status'] = 1;
                    $json['data'] = $data;
                } else {
                    // Data retrieval failed, set an error message
                    $json['message'] = 'Error retrieving staff details.';
                }
    
                $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } else {
                // Invalid staff ID provided
                $json['message'] = 'Invalid staff ID provided.';
                $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
        } catch (Exception $e) {
            // Handle exceptions and log the error
            log_message('error', 'Error in getDetails: ' . $e->getMessage());
    
            // Set an error message in the JSON response
            $json['message'] = 'An error occurred while processing the request.';
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
    }
    
}