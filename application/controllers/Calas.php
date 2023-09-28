<?php

defined('BASEPATH') OR exit('');
/**
 * Cala Controller
 *
 * This controller handles cala operations, including 
 *
 * @package     YourPackageName
 * @subpackage  Controllers
 * @category    Examination
 * @author      Tavonga <mafuratavonga@gmail.com>
 * @date        21 September 2023
 */
class Calas extends CI_Controller{

    /**
     * Constructor method for the Students controller.
     */
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['examination','cala']);
    }
    
    /**
     * Index method.
     *
     * This method loads the default cala view.
     */
    public function index(){
        $data['pageContent'] = $this->load->view('calas/calas', '', TRUE);
        $data['pageTitle'] = "Calas";

        $this->load->view('main', $data);
    }

    /**
    * "lslt" = Load Students List Table method.
    *
    * This method loads and displays a table of students with pagination and sorting options.
    */
    public function lslt(){
        try {

            // Ensure this method is accessed via AJAX
            $this->genlib->ajaxOnly();
            
            $this->load->helper('text');
            
            // Set the sort order and format
            $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
            $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

            // Get the selected class from the request, default to an empty string if not provided
            $selectedClass = $this->input->get('selectedClass', TRUE) ?? '';
            
            // Count the total number of students in the database based on the selected class
            if (!empty($selectedClass)) {
                // If a class is selected, count students in that class
                $totalStudents = $this->examination->countExamStudsByClass($selectedClass);
            } else {
                // If no specific class is selected, count all students
                $totalStudents = $this->examination->countExamStuds();
            }
            $this->load->library('pagination');
            
            $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
                    
            $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
            $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

            
            //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
            $config = $this->genlib->setPaginationConfig($totalStudents, "calas/lslt", $limit, ['onclick'=>'return lslt(this.href);']);
            
            $this->pagination->initialize($config);//initialize the library class
            
            // Retrieve students data from the model with the selected class
            $data['allStudents'] = $this->examination->getStudentsWithSubjects($orderBy, $orderFormat, $start, $limit, $selectedClass);
            $data['range'] = $totalStudents > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allStudents'])) . " of " . $totalStudents : "";
            $data['links'] = $this->pagination->create_links();//page links
            $data['sn'] = $start+1;


            // Check if the data retrieval was successful
            if ($data['allStudents'] === FALSE) {
                throw new Exception("Failed to retrieve student data.");
            }
            
            // Generate the students list table and send it as a JSON response
            $json['studentsListTable'] = $this->load->view('calas/calaslisttable', $data, TRUE);//get view with populated students table
            
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        } catch (Exception $e) {
            // Handle exceptions here and provide meaningful error messages
            $errorJson = [
                'status' => 0,
                'error' => $e->getMessage(),
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($errorJson));
        }
    } 

    public function getGradesForSelect(){
        $this->genlib->ajaxOnly();
    
        // Define sorting parameters
        $orderBy = 'name';
        $orderFormat = 'ASC';
    
    
        try {
            $grades = $this->examination->getGradesByFormName($orderBy, $orderFormat);
    
            if ($grades === FALSE) {
                throw new Exception("Unable to fetch grades from the database.");
            }
    
            // Grades found, set status to 1 and return the list of grades
            $json['status'] = 1;
            $json['grades'] = $grades;
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }
    
        // Set response content type and output JSON response
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }



    /**
     * Get Student Info and All Subjects method.
     *
     * This method retrieves student information and all subjects, then sends them as a response.
     */
    public function getInfoNSubjects() {
        $this->genlib->ajaxOnly();
        
        $studentId = $this->input->get('studentId',TRUE);
    
        try {
            // Retrieve student name and surname by ID from the model
            $studentInfo = $this->examination->getStudentNameAndSurnameById($studentId);

            // Check if the student info was retrieved successfully
            if ($studentInfo === FALSE) {
                throw new Exception("Student not found.");
            }

            // Retrieve all subjects from the model
            $allSubjects = $this->examination->getAllSubjects();

            // Check if the subjects were retrieved successfully
            if ($allSubjects === FALSE) {
                throw new Exception("Failed to retrieve subjects.");
            }

            // Create a JSON response with student info and subjects
            $json['status'] = 1;
            $json['studentInfo'] = $studentInfo;
            $json['subjects'] = $allSubjects;
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }

        // Set response content type and output JSON response
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }


    /**
     * Get all subjects and their IDs.
     */
    public function getAllSubjects() {
        $this->genlib->ajaxOnly();

        try {
            // Call the getSubjects method from the Cala model to retrieve all subjects
            $subjects = $this->cala->getSubjects();

            // Check if the subjects were retrieved successfully
            if ($subjects === FALSE) {
                throw new Exception("Failed to retrieve subjects.");
            }

            $json['status'] = 1;
            $json['subjects'] = $subjects;
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }

        // Set response content type and output JSON response
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /**
     * Get students' data method.
     *
     * This method retrieves students' data and sends it as a response.
     */
    public function getStudentsData() {
        $this->genlib->ajaxOnly();
    
        try {
            // Call the createMissingStudentSubjectMarks method to ensure all data is synchronized
            $class_name = $this->input->get('class',TRUE); 
            $subjectId = $this->input->get('subject',TRUE);

            $subjectName = $this->genmod->getTableCol('subjects', 'name', 'id', $subjectId);

            $isDataSynchronized = $this->cala->createMissingStudentSubjectMarks($class_name);
    
            if (!$isDataSynchronized) {
                throw new Exception("Failed to synchronize student data.");
            }
    
            // Now, retrieve the students' data
            $studentsData = $this->cala->getStudentData($class_name,$subjectId);
    
            // Check if the students' data was retrieved successfully
            if ($studentsData === FALSE) {
                throw new Exception("Failed to retrieve students' data.");
            }
            $class = $this->genmod->getTableCol('grades', 'name', 'id', $class_name);

            $json['class'] = $class;
            $json['status'] = 1;
            $json['studentsData'] = $studentsData;
            $json['subject'] = $subjectName;
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }
    
        // Set response content type and output JSON response
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    

    /**
     * Update Student Components method.
     *
     * This method receives data from AJAX and updates the components in the student_subject_marks table.
     */
    public function updateStudentComponents() {
        $this->genlib->ajaxOnly();
    
        try {
            // Retrieve data from the AJAX request
            $capturedData = json_decode($this->input->post('capturedData'), TRUE);
    
            // Check if capturedData is an array
            if (!is_array($capturedData)) {
                throw new Exception("Invalid data format.");
            }
    
            // Initialize a variable to keep track of successful updates
            $successCount = 0;
    
            // Loop through each captured data row and update components
            foreach ($capturedData as $row) {
                $id = $row['id'];
                $componentA = $row['componentA'];
                $componentB = $row['componentB'];
                $componentC = $row['componentC'];
                $componentD = $row['componentD'];
                $componentE = $row['componentE'];
                $average = $row['average'];
    
                // Call the updateMarks method to update the components
                $isUpdated = $this->cala->updateMarks($id, $componentA, $componentB, $componentC, $componentD, $componentE,$average);
    
                // Check if the update was successful
                if ($isUpdated) {
                    $successCount++;
                }
            }
    
            // Check if at least one update was successful
            if ($successCount > 0) {
                $json['status'] = 1;
                $json['message'] = "$successCount student components updated successfully.";
            } else {
                throw new Exception("No student components were updated.");
            }
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }
    
        // Set response content type and output JSON response
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
        
    
    
    

}