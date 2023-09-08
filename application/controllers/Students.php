<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('');
/**
 * Students Controller
 *
 * This controller handles student management operations, including adding, editing, and deleting student records.
 *
 * @package     YourPackageName
 * @subpackage  Controllers
 * @category    Students
 * @author      Tavonga <mafuratavonga@gmail.com>
 * @date        29 July 2023
 */
class Students extends CI_Controller{

    /**
     * Constructor method for the Students controller.
     */
    
    public function __construct(){
        parent::__construct();
        
        // Check if the user is logged in before allowing access
        $this->genlib->checkLogin();
        
        // Load the 'student' model to interact with the database
        $this->load->model(['student']);
    }
    
    /**
     * Index method.
     *
     * This method loads the default students view.
     */
    public function index(){
        $data['pageContent'] = $this->load->view('students/students', '', TRUE);
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
            $this->db->from('students');
            if (!empty($selectedClass)) {
                $this->db->where('students.class_name', $selectedClass);
            }
            $totalStudents = $this->db->count_all_results();

            $this->load->library('pagination');
            
            $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
            
        
            $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
            $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

            
            //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
            $config = $this->genlib->setPaginationConfig($totalStudents, "students/lslt", $limit, ['onclick'=>'return lslt(this.href);']);
            
            $this->pagination->initialize($config);//initialize the library class
            
            // Retrieve students data from the model with the selected class
            $data['allStudents'] = $this->student->getAll($orderBy, $orderFormat, $start, $limit, $selectedClass);
            $data['range'] = $totalStudents > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allStudents'])) . " of " . $totalStudents : "";
            $data['links'] = $this->pagination->create_links();//page links
            $data['sn'] = $start+1;

            // Check if the data retrieval was successful
            if ($data['allStudents'] === FALSE) {
                throw new Exception("Failed to retrieve student data.");
            }
       
            // Generate the students list table and send it as a JSON response
            $json['studentsListTable'] = $this->load->view('students/studentslisttable', $data, TRUE);//get view with populated students table
            

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

    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
    * Add Student method.
    *
    * This method adds a new student record to the database.
    */
    
    
    public function add(){
        
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');

        
        // Define validation rules for student data
        $this->form_validation->set_rules('studentName', 'Student name', ['required', 'trim', 'max_length[30]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentSurname', 'Student Surname', ['required', 'trim', 'max_length[40]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentStudent_id', 'Student Student_id', ['required', 'trim', 'max_length[20]','is_unique[students.student_id]'],['required' => 'There is already a student with this student id.']);
        $this->form_validation->set_rules('studentClass_name', 'Student Class_name', ['required', 'trim', 'max_length[15]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentGender', 'Student Gender', ['required', 'trim', 'max_length[10]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentParent_phone', 'Student Parent_phone', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentAddress', 'Student Address', ['required', 'trim', 'max_length[80]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('studentOwed_fees', 'Student Owed Fees', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        

        if($this->form_validation->run() !== FALSE){
            try {
                $this->db->trans_start();//start transaction
                
                // Insert student data into the database using the 'student' model's 'add' method
                $insertedId = $this->student->add(set_value('studentName'), set_value('studentSurname'), set_value('studentStudent_id'), 
                        set_value('studentClass_name'), set_value('studentGender'),set_value('studentParent_name'),set_value('studentParent_phone'),set_value('studentAddress'),set_value('studentFees'),set_value('studentOwed_fees'),set_value('studentHealthy_status'), set_value('studentRelationship'));
    
                // Additional student data for logging purposes 
                $studentName = set_value('studentName');
                $studentSurname = set_value('studentSurname');
                $studentStudent_id = set_value('studentStudent_id');
                $studentParent_name= set_value('studentParent_name');
                $studentAddress = set_value('studentAddress');
                
                // Insert an event log entry for the addition of a new student
                $desc = "Addition of {$studentName} {$studentSurname} as a new student with ID '{$studentStudent_id}', Parent Name '{$studentParent_name}'and Address '{$studentAddress}' to the Students.";
                
                $insertedId ? $this->genmod->addevent("Creation of new Student", $insertedId, $desc, "students", $this->session->admin_id) : "";
                
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception("Database transaction failed.");
                }
    
                // Set response JSON data for a successful transaction
                $json = ['status' => 1, 'msg' => "Student successfully added"];
            } catch (Exception $e) {
                // Handle exceptions here
                log_message('error', 'Error in add function: ' . $e->getMessage());
                $json = ['status' => 0, 'msg' => "Oops! Unexpected server error! Please contact administrator for help. Sorry for the embarrassment"];
            }
        }
        else{
            // Return all error messages as JSON response
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
     * Get Table Column Value method.
     *
     * This method is primarily used to check whether a student already has a particular random student ID
     * being generated for a new student.
     *
     * @param string $selColName - The name of the column to select.
     * @param string $whereColName - The name of the column for the WHERE condition.
     * @param string $colValue - The value to check in the specified column.
     */
    public function gettablecol($selColName, $whereColName, $colValue){
        // Call the 'gettablecol' method from the 'genmod' model to fetch a column value from the 'students' table
        $a = $this->genmod->gettablecol('students', $selColName, $whereColName, $colValue);
        
        // Prepare a JSON response indicating success (1) or failure (0) and the column value
        $json['status'] = $a ? 1 : 0;
        $json['colVal'] = $a;
        
        // Set the content type to JSON and send the response
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
     * Get Current and Owed Fees method.
     *
     * This method retrieves information about a student's current and owed fees based on their student ID.
     * It returns a JSON response containing the student's details if found.
     */
    public function getCurrentAndOwedFees() {
        $json = array(
            'status' => 0,
            'error' => 'No student information found.'
        );
    
        // Get the student's student ID from the input
        $studentStudent_id = $this->input->get('_iC', TRUE);
    
        if ($studentStudent_id) {
            // Call the 'getStudentInfo' method from the 'student' model to retrieve student details
            $student_info = $this->student->getStudentInfo(['student_id' => $studentStudent_id], ['name', 'surname', 'class_name', 'parent_name', 'parent_phone', 'address', 'owed_fees', 'fees', 'term']);
            if ($student_info) {
                // Populate the JSON response with student details
                $json = array(
                    'status' => 1,
                    'studentName' => $student_info->name,
                    'studentSurname' => $student_info->surname,
                    'studentClass_name' => $student_info->class_name,
                    'studentParent_name' => $student_info->parent_name,
                    'studentParent_phone' => $student_info->parent_phone,
                    'studentAddress' => $student_info->address,
                    'studentFees' => $student_info->fees,
                    'studentOwed_fees' => $student_info->owed_fees,
                    'term' => $student_info->term
                );
            } else {
                $json['error'] = 'Student information not found for the given student ID.';
            }
        } else {
            $json['error'] = 'Student ID parameter is missing or empty.';
        }
    
        // Set the content type to JSON and send the response
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
     * Generate Student Fees Report method.
     *
     * This method generates a spreadsheet report with student fees owed and the amount paid.
     * It saves the report as an Excel file and provides a download link.
     */
    public function generateReport() {
        try {
            // Load the Student model
            $this->load->model('Student');
    
            // Define sorting options
            $orderBy = 'name';
            $orderFormat = 'asc';
    
            // Get the fee partition from the input
            $feePartition = $this->input->post('feePartition');
    
            // Assuming you have loaded the Grade model in your controller
            $this->load->model('grade');

            // Get the selected class from the input
            $selectedClass = $this->input->post('selectedClass');

            // Check if $selectedClass is not empty and contains a valid class ID
            if (!empty($selectedClass) && is_numeric($selectedClass)) {
                // Convert $selectedClass to an integer (grade ID)
                $gradeId = (int)$selectedClass;

                // Use the Grade model to fetch the grade name
                $gradeName = $this->grade->getGradeNameById($gradeId);

                if ($gradeName !== FALSE) {
                    // Grade name found, you can use it in your code
                    $classTitle = " $gradeName";
                } else {
                    // No grade name found, set a default value
                    $classTitle = " for Unknown Grade";
                }
            } else {
                $classTitle = 'All Students';
            }


            // Get students with fees information
            $students = $this->Student->getAllWithFees($orderBy, $orderFormat, 0, '', $feePartition, $selectedClass);
    
            if (empty($students)) {
                throw new Exception('No students found with the selected fee partition.');
            }
    
            // Create a new Excel instance
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            // Set default column width
            $defaultColumnWidth = 15;
            $sheet->getDefaultColumnDimension()->setWidth($defaultColumnWidth);
    
            // Increase the height of the school name row
            $sheet->getRowDimension(1)->setRowHeight(30);
    
            // Add a black border line after the school name
            $borderStyle = [
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'], // Black color
                    ],
                ],
            ];
            $sheet->getStyle('A1:H1')->applyFromArray($borderStyle);
            $sheet->getStyle('A3:H3')->applyFromArray($borderStyle);
            $sheet->getStyle('A4:H4')->applyFromArray($borderStyle);
            $sheet->getStyle('A5:H5')->applyFromArray($borderStyle);
            $sheet->getStyle('A6:H6')->applyFromArray($borderStyle);
            $sheet->getStyle('A17:H17')->applyFromArray($borderStyle);


            
    
            // Add an empty row from A2 to H2 (before school details)
            $sheet->insertNewRowBefore(3, 1);
    
            // Define cell styles
            $styleHeader = [
                'font' => [
                    'bold' => true,
                    'size' => 20,
                    'name' => 'Arial',
                    'color' => ['rgb' => '000000'], // black text
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '99CCFF'], // Light Blue background
                ],
            ];
    
            $styleInfoHeader = [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'name' => 'Arial',
                    'color' => ['rgb' => '000000'], // Black text
                ],
            ];
    
            $styleInfoText = [
                'font' => [
                    'size' => 12,
                    'name' => 'Arial',
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];
    
            // Increase the width of column H to fit an email address
            $sheet->getColumnDimension('H')->setWidth(25);
    
            // Increase the width of column B and C to fit names and outstanding fees respectively 
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(17);
    
            // Reduce the width of columns E and F 
            $sheet->getColumnDimension('E')->setWidth(5);
            $sheet->getColumnDimension('F')->setWidth(5);
    
            // Merge and style cells for School Name
            $sheet->mergeCells('A1:H1');
            $sheet->setCellValue('A1', 'School Name');
            $sheet->getStyle('A1')->applyFromArray($styleHeader);
    
            // Populate and style the rest of the info
            $infoData = [
                ['Address:', '39 Chitsere', 'New Mabvuku', 'Harare', '', '', 'Phone:', "'+263775923458"],
                ['', '', '', '', '', '', '', "'+263715328408"],
                ['', '', '', '', '', '', 'Email:', 'mafurataboz@gmail.com'],
            ];
    
            for ($i = 0; $i < count($infoData); $i++) {
                for ($j = 0; $j < count($infoData[$i]); $j++) {
                    $sheet->setCellValueByColumnAndRow($j + 1, $i + 2, $infoData[$i][$j]);
                    $sheet->getStyleByColumnAndRow($j + 1, $i + 2)->applyFromArray($styleInfoText);
                    $sheet->getStyleByColumnAndRow($j + 1, $i + 2)->getAlignment()->setWrapText(true);
                    $sheet->getStyleByColumnAndRow($j + 1, $i + 2)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('F5F5F5'); // Light Gray background
                }
            }
    
            // Set the report date
            $reportDate = date('F j, Y'); // Use 'F' for the full month name
            $sheet->mergeCells('A5:H5');
            $sheet->setCellValue('A5', 'Report Date: ' . $reportDate);
    
            // Style for the merged cell
            $sheet->getStyle('A5')->applyFromArray($styleHeader);
            $sheet->getStyle('A5')->getFont()->getColor()->setRGB('000000'); // Red text color
    
            // Center the content horizontally and vertically in A5 to H5
            $sheet->getStyle('A5:H5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A5:H5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
            // Set the background color for A5 to H5 (light blue)
            $sheet->getStyle('A5:H5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A5:H5')->getFill()->getStartColor()->setRGB('99CCFF');
    
            // Adjust the row height to accommodate the font size
            $sheet->getRowDimension(5)->setRowHeight(20); // Increase the height as needed
    
            // merge rows (6)
            $sheet->mergeCells('A6:H6');
    
            // Set the fee details header
            $sheet->mergeCells('A7:H7');
            $sheet->setCellValue('A7', 'Outstanding Fees Summary:  ' . $classTitle);
            $sheet->getStyle('A7')->applyFromArray($styleHeader);
            $sheet->getRowDimension(7)->setRowHeight(20); // Increase the height as needed
    
            // Set the column headers for student data
            $columnHeaders = ['Student ID', 'Student Name', 'Current Fees Owed'];
            $columnIndex = 1;
            foreach ($columnHeaders as $header) {
                $sheet->setCellValueByColumnAndRow($columnIndex, 8, $header);
                $sheet->getStyleByColumnAndRow($columnIndex, 8)->applyFromArray($styleInfoHeader);
                $columnIndex++;
            }
    
            // Set student data
            $rowIndex = 9;
            foreach ($students as $student) {
                $sheet->setCellValueByColumnAndRow(1, $rowIndex, $student->student_id);
                $sheet->setCellValueByColumnAndRow(2, $rowIndex, $student->name . ' ' . $student->surname);
                $sheet->setCellValueByColumnAndRow(3, $rowIndex, '$' . number_format($student->owed_fees, 2));
                $sheet->getStyleByColumnAndRow(1, $rowIndex)->applyFromArray($styleInfoText);
                $sheet->getStyleByColumnAndRow(2, $rowIndex)->applyFromArray($styleInfoText);
                $sheet->getStyleByColumnAndRow(3, $rowIndex)->applyFromArray($styleInfoText);
                $rowIndex++;
            }
    
            // Calculate the total amount for the class
            $totalAmountForClass = 0;
            foreach ($students as $student) {
                $totalAmountForClass += $student->owed_fees;
            }
    
            // Add a blank row before the summary section
            $sheet->insertNewRowBefore($rowIndex, 1);
    

            // Display the total amount in the summary section
            $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
            $sheet->setCellValue('A' . $rowIndex, 'Total Amount for ' . $classTitle . ':');
            $sheet->getStyle('A' . $rowIndex)->applyFromArray($styleInfoHeader);
            $sheet->getStyle('A' . $rowIndex . ':B' . $rowIndex)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle('A' . $rowIndex . ':B' . $rowIndex)->getFill()->getStartColor()->setRGB('F5F5F5'); // Light gray background
            $sheet->setCellValue('C' . $rowIndex, '$' . number_format($totalAmountForClass, 2));
            $sheet->getStyle('C' . $rowIndex)->applyFromArray($styleInfoText);
            $rowIndex++;

            // Adjust the row height for the summary section
            $sheet->getRowDimension($rowIndex - 1)->setRowHeight(20);

            // Save the spreadsheet
            $writer = new Xlsx($spreadsheet);
            $filePath = 'reports/students_report.xlsx'; // Adjust the file path as needed
            $writer->save($filePath);
    
            if (!file_exists($filePath)) {
                throw new Exception('Failed to save the Excel report.');
            }
    
            $reportUrl = base_url() . 'reports/students_report.xlsx'; // Adjust the URL as needed
            $response = [
                'status' => 1,
                'message' => 'Student Excel report generated successfully!',
                'report_url' => $reportUrl,
            ];
    
            // Send the response as JSON
            echo json_encode($response);
        } catch (Exception $e) {
            // Handle exceptions and return an error response
            $errorResponse = [
                'status' => 0,
                'message' => 'Error generating the report: ' . $e->getMessage(),
            ];
    
            // Send the error response as JSON
            echo json_encode($errorResponse);
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
     * Edit Student Details method.
     *
     * This method is used to edit the details of a student in the database.
     * It validates and processes the submitted form data and updates the student's information.
     * Additionally, it logs the event of the student's details being updated.
     */
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
    
        // Define form validation rules
        $this->form_validation->set_rules('_sId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('studentName', 'Student Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('studentSurname', 'Student Surname', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('studentClass_name', 'Student Class_name', ['required', 'trim', 'max_length[15]'], ['required'=>'required']);
        $this->form_validation->set_rules('studentFees', 'Student Fees', ['required', 'trim', 'numeric'], ['required'=>'required']);
        $this->form_validation->set_rules('studentParent_name', 'Student Parent_name', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        $this->form_validation->set_rules('studentAddress', 'Student Address', ['required', 'trim', 'max_length[80]'], ['required'=>'required']);
        $this->form_validation->set_rules('studentStudent_id', 'Student Student_id', ['required', 'trim', 'max_length[15]'], ['required'=>'required']);
        $this->form_validation->set_rules('studentParent_phone','Student Student_phone',['required','trim','max_length[15]'],['required'=>'required']);
        $this->form_validation->set_rules('studentOwed_fees', 'Student Owed Fees', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        
        // Initialize an array to store detailed error messages
        $errorMessages = [];

        try {
            // Check if form validation is successful
            if ($this->form_validation->run() !== FALSE) {

                // Extract form data
                $studentId = set_value('_sId');
                $studentName = set_value('studentName');
                // Extract data for other fields...

                // Update student in the database
                $updated = $this->student->edit($studentId, $studentName, $studentSurname, $studentClass_name, $studentParent_phone, $studentFees, $studentParent_name, $studentAddress, $studentOwed_fees, $studentHealthy_status, $studentRelationship);

                if (!$updated) {
                    throw new Exception("Unable to update the student record. Please try again later or contact the administrator.");
                }

                // Add an event log entry
                $desc = "Details of student with Student ID '$studentStudent_id' was updated";
                $this->genmod->addevent("Student Update", $studentId, $desc, 'students', $this->session->admin_id);

                // Set status to 1 if everything is successful
                $json['status'] = 1;
            } else {
                // Form validation failed, throw an exception with validation errors
                $validationErrors = $this->form_validation->error_array();

                // Convert form validation errors to detailed error messages
                foreach ($validationErrors as $field => $message) {
                    $errorMessages[] = "Field '{$field}': {$message}";
                }

                throw new Exception("Form validation failed.");
            }
        } catch (Exception $e) {
            // Handle exceptions and set status to 0
            $json['status'] = 0;
            $errorMessages[] = $e->getMessage();
        }

        // Include detailed error messages in the JSON response
        $json['errors'] = $errorMessages;

        // Set response content type and output JSON response
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
     * Get Grades for Select method.
     *
     * This method is used to fetch a list of grades for populating a select dropdown.
     * It retrieves the grades from the database and returns them as JSON.
     * If grades are found, it returns a JSON response with a status of 1 and the list of grades.
     * If no grades are found, it returns a JSON response with a status of 0 and a message.
     */

     public function getGradesForSelect(){
        $this->genlib->ajaxOnly();
    
        // Define sorting parameters
        $orderBy = 'name';
        $orderFormat = 'ASC';
    
        $this->load->model(['grade']); // Load the Grade model
    
        try {
            // Call the getAll function from the Grade model to fetch grades
            $grades = $this->grade->getAll($orderBy, $orderFormat);
    
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
    
  
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    /**
     * Delete Student method.
     *
     * This method is used to delete a student record from the database.
     * It expects a student ID to be passed as a POST parameter.
     * If a valid student ID is provided, it deletes the corresponding student record.
     * It returns a JSON response with a status of 1 if the deletion is successful,
     * and a status of 0 if there was an error or no student ID was provided.
     */
    
    public function delete(){
        $this->genlib->ajaxOnly();
        
        // Initialize JSON response with a status of 0
        $json['status'] = 0;

        // Get the student ID from POST data
        $student_id = $this->input->post('i', TRUE);
        
        // Check if a valid student ID is provided
        if($student_id){

            // Delete the student record from the 'students' table
            $this->db->where('id', $student_id)->delete('students');
            
            // Set status to 1 to indicate successful deletion
            $json['status'] = 1;
        }
        
        // Set the final output as a JSON response
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
     * Bulk Update Fees method.
     *
     * This method is used to update fees and owed fees for all students in bulk.
     * It expects two POST parameters: 'newFees' for the new fees amount and 'feesToAdd'
     * for the amount to add to owed fees.
     * It checks the validity of these input values and performs the bulk update.
     * If the update is successful, it logs the event and returns a JSON response with
     * a status of 1 and a success message. If there is an error or invalid input values,
     * it returns a JSON response with a status of 0 and an appropriate error message.
     */
    public function bulkUpdateFees() {
        $this->genlib->ajaxOnly();
    
        // Get the new fees value and the amount to add to owed fees from POST data
        $newFees = $this->input->post('newFees', TRUE); 
        $feesToAdd = $this->input->post('feesToAdd', TRUE);
    
        // Initialize JSON response with a status of 0
        $json['status'] = 0;
    
        try {
            // Check the validity of input values
            if (!empty($newFees) && is_numeric($newFees) && !empty($feesToAdd) && is_numeric($feesToAdd)) {
                $this->load->model('student');
    
                // Perform the bulk update
                $updated = $this->student->updateFees($newFees, $feesToAdd);
    
                if ($updated) {
                    // Add event to log
                    $desc = "Bulk update of fees and owed fees for all students. New Fees: {$newFees}, Fees to Add: {$feesToAdd}";
                    $this->genmod->addevent("Bulk Fees Update", 0, $desc, 'students', $this->session->admin_id);
    
                    // Set status to 1 to indicate successful update
                    $json['status'] = 1;
                    $json['message'] = 'Fees and owed fees updated successfully for all students.';
                } else {
                    throw new Exception('Failed to update fees and owed fees.');
                }
            } else {
                throw new Exception('Invalid input values.');
            }
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
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
     * Get and display the last student ID for the current month or create a new one.
     * If a last student ID is found for the current month, it increments the last three digits by 1.
     * If no student ID is found, it creates a new student ID with "000" as the last three digits.
     */
    public function lastStudentIdForMonth() {
        // Get the current month in YYMM format (e.g., "2209" for September 2022)
        $currentMonth = date('Ym');

        // Initialize JSON response with a status of 0
        $json['status'] = 0;

        try {
            // Call the model method to get the last student ID for the current month
            $lastStudentId = $this->student->getLastStudentIdForMonth($currentMonth);

            if ($lastStudentId !== null) {
                // Extract the last three digits and increment them
                $lastThreeDigits = substr($lastStudentId, -3);
                $newLastThreeDigits = str_pad((int)$lastThreeDigits + 1, 3, '0', STR_PAD_LEFT);

                // Generate the new student ID with "TAB" as the prefix
                $newStudentId = "TAB{$currentMonth}{$newLastThreeDigits}";

                // Set status to 1 to indicate success
                $json['status'] = 1;

                // Include the new student ID and added one in the response
                $json['message'] = "New Student ID for {$currentMonth}: {$newStudentId}";
                $json['newStudentId'] = $newStudentId;
                $json['addedOne'] = $newLastThreeDigits;
            } else {
                // No student ID found for the current month, use "000" for the last three digits
                $newLastThreeDigits = "000";
                
                // Generate the new student ID with "TAB" as the prefix
                $newStudentId = "TAB{$currentMonth}{$newLastThreeDigits}";

                // Set status to 1 to indicate success
                $json['status'] = 1;

                // Include the new student ID in the response
                $json['message'] = "No student IDs found for {$currentMonth}, creating a new one: {$newStudentId}";
                $json['newStudentId'] = $newStudentId;
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


