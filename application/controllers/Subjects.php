<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Subjects
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 19 September, 2023
 */
class Subjects extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['subject']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('subjects/subjects', '', TRUE);
        $data['pageTitle'] = "Subjects";

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
     * "lslt_" = "load Subjects List Table"
     */
    public function lslt_(){
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of subjects in db
        $totalSubjects = $this->db->count_all('subjects');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalSubjects, "subjects/lslt_", $limit, ['onclick'=>'return lslt_(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library subject
        
        //get all subjects from db
        $data['allsubjects'] = $this->subject->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalSubjects > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allsubjects'])) . " of " . $totalSubjects : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
           
        $json['subjectsListTable'] = $this->load->view('subjects/subjectslisttable', $data, TRUE);//get view with populated subjects table
        

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
        
        $this->form_validation->set_rules('subjectName', 'subject name', ['required', 'trim', 'max_length[20]'],['required' => 'The %s field is required.']);
                        
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($subjectName,)
             */
            $insertedId = $this->subject->add(set_value('subjectName'));
            
            $subjectName = set_value('subjectName');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$subjectName} as a new subject to the Subjects.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Subject", $insertedId, $desc, "subjects", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status'=>1, 'msg'=>"Subject successfully added"] 
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
   
    // edit these details ($subjectName.$subjectId)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        log_message("error","we are here after");
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        
        $this->form_validation->set_rules('_sId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('subjectName', 'Subject Name', ['required', 'trim', 'max_length[20]'], ['required'=>'required']);
        
        if($this->form_validation->run() !== FALSE){
            $subjectId = set_value('_sId');
            $subjectName = set_value('subjectName');
           
            //update subject in db
            $updated = $this->subject->edit($subjectId, $subjectName);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of Subject with Name '$subjectName' was updated";
            
            $this->genmod->addevent("Subject Update", $subjectId, $desc, 'subjects', $this->session->admin_id);
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
        $subjectId = $this->input->post('i', TRUE);
        
        if($subjectId){
            $this->db->where('id', $subjectId)->delete('subjects');
            
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}