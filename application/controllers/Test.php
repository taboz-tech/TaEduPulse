<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "functions.php";
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



/**
 * Description of Test
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * Date: Dec 31st, 2022
 */

class Test extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function index(){
        echo password_hash("123456", PASSWORD_BCRYPT);
    }

    public function generateReport() {
        // Load the Student model
        $this->load->model('Student');

        // Call the getAll function to retrieve student records
        $orderBy = 'name'; // Replace with the column you want to order by
        $orderFormat = 'asc'; // Replace with 'asc' or 'desc' based on your preference
        $feePartition = $this->input->post('feePartition');

        $students = $this->Student->getAllWithFees($orderBy, $orderFormat, 0, '', $feePartition);

        // Create a new Excel instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set default column width
        $defaultColumnWidth = 15;
        $sheet->getDefaultColumnDimension()->setWidth($defaultColumnWidth);


        // Set column headers
        $columnHeaders = ['Name', 'Surname', 'Student ID', 'Fees', 'Owed Fees', 'Paid Amount'];
        $columnIndex = 1;
        foreach ($columnHeaders as $header) {
            $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
            $columnIndex++;
        }

        // Set student data
        $rowIndex = 2;
        foreach ($students as $student) {
            $paidAmount = $student->fees - $student->owed_fees; // Calculate the Paid Amount
            $sheet->setCellValueByColumnAndRow(1, $rowIndex, $student->name);
            $sheet->setCellValueByColumnAndRow(2, $rowIndex, $student->surname);
            $sheet->setCellValueByColumnAndRow(3, $rowIndex, $student->student_id);
            $sheet->setCellValueByColumnAndRow(4, $rowIndex, $student->fees);
            $sheet->setCellValueByColumnAndRow(5, $rowIndex, $student->owed_fees);
            $sheet->setCellValueByColumnAndRow(6, $rowIndex, $paidAmount); // Set the Paid Amount
            $rowIndex++;
        }


        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);
        $filePath = 'reports/students_report.xlsx'; // Adjust the file path as needed
        $writer->save($filePath);
        $reportUrl = base_url() . 'reports/students_report.xlsx'; // Adjust the URL as needed
        $response = array(
            'status' => 1,
            'message' => 'Student Excel report generated successfully!',
            'report_url' => $reportUrl
        );
        echo json_encode($response);

    }
    
    public function newhex(){
        echo md5(time());
    }
    
    
    public function a(){
        $this->load->view('test');
    }
}