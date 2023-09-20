<?php

defined('BASEPATH') OR exit('');
/**
 * Emanination Registration Controller
 *
 * This controller handles registration operations, including 
 *
 * @package     YourPackageName
 * @subpackage  Controllers
 * @category    Examination
 * @author      Tavonga <mafuratavonga@gmail.com>
 * @date        19 September 2023
 */
class Examinations extends CI_Controller{

    /**
     * Constructor method for the Students controller.
     */
    
    public function __construct(){
        parent::__construct();
        
        // Check if the user is logged in before allowing access
        $this->genlib->checkLogin();
        
        // Load the 'student' model to interact with the database
        $this->load->model(['examination','transaction']);
    }
    
    /**
     * Index method.
     *
     * This method loads the default registration view.
     */
    public function index(){
        $data['pageContent'] = $this->load->view('examinations/examinations', '', TRUE);
        $data['pageTitle'] = "Examination";

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
            $config = $this->genlib->setPaginationConfig($totalStudents, "examinations/lslt", $limit, ['onclick'=>'return lslt(this.href);']);
            
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
            $json['studentsListTable'] = $this->load->view('examinations/examinationslisttable', $data, TRUE);//get view with populated students table
            
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



    public function registerStudent() {
        $this->genlib->ajaxOnly();
    
        // Load the form validation library
        $this->load->library('form_validation');
    
        // Define validation rules for the input fields
        $this->form_validation->set_rules('studentName', 'Student Name', 'required');
        $this->form_validation->set_rules('studentSurname', 'Student Surname', 'required');
        $this->form_validation->set_rules('zimsecRegNumber', 'ZIMSEC Registration Number', 'required|is_unique[exams_reg.zimsec_reg_num]');
        $this->form_validation->set_rules('studentId', 'Student ID', 'required');
        $this->form_validation->set_rules('selectedSubjects[]', 'Selected Subjects', 'required');
    
        try {
            if ($this->form_validation->run() == false) {
                throw new Exception(validation_errors());
            }
    
            // Get the values from the POST request
            $studentName = $this->input->post('studentName', TRUE);
            $studentSurname = $this->input->post('studentSurname', TRUE);
            $zimsecRegNumber = $this->input->post('zimsecRegNumber', TRUE);
            $studentId = $this->input->post('studentId', TRUE);
            $selectedSubjects = $this->input->post('selectedSubjects', TRUE);
    
            // Check if the ZIMSEC Registration Number is unique in the database
            $isUnique = $this->examination->isZimsecRegNumberUnique($zimsecRegNumber);
    
            if (!$isUnique) {
                throw new Exception('ZIMSEC Registration Number is already registered.');
            }
    
            $subjectFeeIncome = $this->examination->getIncomeByName('Subject_Fee');
            if (!$subjectFeeIncome) {
                throw  new Exception('Subject Fee income not found in the database.');
            }
            $subjectFeeAmount = $subjectFeeIncome->amount;
    
            $centreFeeIncome = $this->examination->getIncomeByName('Centre_Fee');
            if (!$centreFeeIncome) {
                throw new Exception('Centre Fee income not found in the database.');
            }
            $centreFeeAmount = $centreFeeIncome->amount;
    
            $studentInfo = $this->examination->getStudentInfoById($studentId);
            if (!$studentInfo) {
                throw new Exception('Student information not found.');
            }
    
            // Generate a random transaction reference
            do {
                $ref = strtoupper(generateRandomCode('numeric', 6, 10, ""));
            } while ($this->transaction->isRefExist($ref));
    
            // Calculate the total amount
            $totalAmount = (count($selectedSubjects) * $subjectFeeAmount) + $centreFeeAmount;
    
            // Call the add method in the Transaction model to create the transaction record
            $transactionId = $this->transaction->add(
                $ref,
                $studentName,
                $studentSurname,
                $studentInfo->class_name, // Use class_name from student info
                $studentInfo->student_id, // Use student_id from student info
                'Registration Fee', 
                $totalAmount,
                $totalAmount, // Cumulative Amount
                $totalAmount, // Amount Tendered
                0, // Change Due
                'Cash', // Mode of Payment
                $studentName . ' ' . $studentSurname, // Customer Name (student name + surname with a space)
                '', // Blank customer phone
                '', // Blank customer email
                2, // Transaction Type (1 for sale)
                1, // Payment Status
                'Exam', // Term (updated to 'Exam')
                'USD' // Currency (updated to 'USD')
            );
    
            if (!$transactionId) {
                throw new Exception('Failed to create the transaction.');
            }
    
            // Add your event log
            $eventDesc = "Registration fee of $" . number_format($totalAmount, 2) . " with reference number $ref was paid";
            $this->genmod->addevent("New Registration", $ref, $eventDesc, 'transactions', $this->session->admin_id);
    
            // Insert registration information into the exams_reg table
            $zimsecRegNumber = $zimsecRegNumber;
            $paymentStatus = 'Paid'; // Assuming the payment is confirmed
            $paymentTransId = $transactionId; // Use the transactionId from the previous step
            $regStatus = 'Confirmed'; // Assuming the registration is confirmed
    
            // Call the insertRegistration method from your model
            $inserted = $this->examination->insertRegistration($studentId, $zimsecRegNumber, $paymentStatus, $paymentTransId, $regStatus);
    
            if ($inserted) {
                // Registration data was successfully inserted
                $registrationId = $this->db->insert_id(); // Get the ID of the inserted registration
    
                // Insert selected subjects into the reg_subjects table
                foreach ($selectedSubjects as $subjectId) {
                    $this->examination->insertRegSubject($registrationId, $subjectId);
                }
    
                $json['status'] = 1;
                $json['message'] = 'Registration successful';
                $json['transactionId'] = $transactionId; // Include the transactionId in the response
            } else {
                // Failed to insert registration data
                throw new Exception('Failed to insert registration data.');
            }
        } catch (Exception $e) {
            // Handle exceptions and return an error response
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
    public function getInfoNSubjectsView() {
        $this->genlib->ajaxOnly();
        
        $studentId = $this->input->get('studentId',TRUE);
    
        try {

            $studentInfo = $this->examination->getStudentInfoWithSubjects($studentId);

            if ($studentInfo === FALSE) {
                throw new Exception("Student not found.");
            }

            $json['status'] = 1;
            $json['studentInfo'] = $studentInfo;
        } catch (Exception $e) {

            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    public function deleteRecord() {
        $this->genlib->ajaxOnly();
    
        $examsRegId = $this->input->post('exams_reg_id', TRUE);
        $paymentTransId = $this->genmod->getTableCol('exams_reg', 'payment_trans_id', 'id', $examsRegId);
    
        try {
            $paymentAmount = $this->genmod->getTableCol('transactions', 'totalAmount', 'transId', $paymentTransId);
    
            $refundAmount = $paymentAmount;
    
            $result = $this->transaction->updateRefundAmount($paymentTransId, $refundAmount);
    
            if ($result) {
                $deleteResult = $this->examination->delete($examsRegId);
    
                if ($deleteResult) {
                    $status = 1;
                    $message = 'Registration cancelled successfully and full refund processed';
                } else {
                    $status = 0;
                    $message = 'Failed to delete record after processing refund';
                }
            } else {
                $status = 0;
                $message = 'Failed to process refund';
            }
        } catch (Exception $e) {
            $status = 0;
            $message = 'Error: ' . $e->getMessage();
        }
    
        $response = array(
            'status' => $status,
            'message' => $message,
        );
    
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
        
    
    
    

}