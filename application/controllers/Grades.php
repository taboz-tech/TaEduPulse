<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Grades
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 13 August, 2023
 */
class Grades extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['grade']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('grades/grades', '', TRUE);
        $data['pageTitle'] = "Grades";

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
     * "lclt" = "load Grades List Table"
     */
    public function lglt(){
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of grades in db
        $totalGrades = $this->db->count_all('grades');
    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalGrades, "grades/lglt", $limit, ['onclick'=>'return lglt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library grade
        
        //get all grades from db
        $data['allgrades'] = $this->grade->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalGrades > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allgrades'])) . " of " . $totalGrades : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
           
        $json['gradesListTable'] = $this->load->view('grades/gradeslisttable', $data, TRUE);//get view with populated grades table
        

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
        
        // Define a custom callback function for the gradeName validation
        $this->form_validation->set_rules(
            'gradeName',
            'Grade name',
            [
                'required',
                'trim',
                'max_length[20]',
                'callback_validate_grade_name'
            ],
            [
                'required' => 'The %s field is required.',
                'validate_grade_name' => 'The %s field should be in the format "Form X" where X is a number.'
            ]
        );
        
        $this->form_validation->set_rules('gradeTeacher_id', 'Grade Teacher_id', ['required'], ['required' => 'The %s field is required.']);
                        
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($gradeName, $gradeTeacher_id)
             */
            $insertedId = $this->grade->add(set_value('gradeName'), set_value('gradeTeacher_id'));
            
            $gradeName = set_value('gradeName');
            $gradeTeacher_id = set_value('gradeTeacher_id');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$gradeName} as a new grade with teacher_id '{$gradeTeacher_id}' to the Grades.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Grade", $insertedId, $desc, "grades", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status' => 1, 'msg' => "Grade successfully added"] 
                    : 
                    ['status' => 0, 'msg' => "Oops! Unexpected server error! Please contact administrator for help. Sorry for the embarrassment"];
        }
        
        else{
            // Return all error messages
            $json = $this->form_validation->error_array(); // Get an array of all errors
            
            $json['msg'] = "One or more required fields are empty or not correctly filled";
            $json['status'] = 0;
        }
                    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    

    public function validate_grade_name($gradeName) {
        // Use a regular expression to check if the format is "Form X" followed by optional additional text
        if (!preg_match('/^Form\s\d+(\s.+)?$/', $gradeName)) {
            return FALSE;
        }
        return TRUE;
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
    // edit these details ($studentId, $studentName, $studentSurname, $studentGrade_name, $studentParent_name, $studentParent_phone,$studentFees)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        
        $this->form_validation->set_rules('_gId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('gradeTeacher_id', 'Grade Teacher_id', ['required', 'trim'], ['required'=>'required']);
        // Define a custom callback function for the gradeName validation
        $this->form_validation->set_rules(
            'gradeName',
            'Grade name',
            [
                'required',
                'trim',
                'max_length[20]',
                'callback_validate_grade_name'
            ],
            [
                'required' => 'The %s field is required.',
                'validate_grade_name' => 'The %s field should be in the format "Form X" where X is a number.'
            ]
        );

        if($this->form_validation->run() !== FALSE){
            $gradeId = set_value('_gId');
            $gradeName = set_value('gradeName');
            $gradeTeacher_id = set_value('gradeTeacher_id');
           
            //update grade in db
            $updated = $this->grade->edit($gradeId, $gradeName, $gradeTeacher_id);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of grade with Name '$gradeName' was updated";
            
            $this->genmod->addevent("Grade Update", $gradeId, $desc, 'grades', $this->session->admin_id);
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
    public function getTeachersForSelect(){
        $this->genlib->ajaxOnly();
    
        $orderBy = 'name'; // Order Teachers by name
        $orderFormat = 'ASC';
    
        $this->load->model(['teacher']); // Load the Teacher model
    
        // Call the getAll function from the Teacher model to fetch Teachers
        $teachers = $this->teacher->getAll($orderBy, $orderFormat);
    
        if ($teachers !== FALSE) {
            $json['status'] = 1;
            $json['teachers'] = $teachers; // Return the list of Teachers
        } else {
            $json['status'] = 0;
            $json['message'] = "No Teachers found.";
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
        $gradeId = $this->input->post('i', TRUE);
        
        if($gradeId){
            $this->db->where('id', $gradeId)->delete('grades');
            
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}