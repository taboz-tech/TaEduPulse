<?php

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
        $this->load->model(['transaction']);


        $totalEarnedZwl = $this->transaction->totalEarnedZwl();

        $totalEarnedUsd = $this->transaction->totalEarnedUsd();

        $totalEarnedZar = $this->transaction->totalEarnedZar();

        $this->load->model(['cost']);

        $totalCostZwl = $this->cost->totalCostZwl();

        $totalCostUsd = $this->cost->totalCostUsd();

        $totalCostZar = $this->cost->totalCostZar();


        $this->load->model(['currency']);

        $currencies = $this->currency->getAllCurrencies(); 
        $currencyRateZWL = 0;
        foreach ($currencies as $currencyInfo) {
            if ($currencyInfo->name === 'ZWL') {
                $currencyRateZWL = $currencyInfo->rate;
                break;
            }
        }

        $currencyRateZAR = 0;
        foreach ($currencies as $currencyInfo) {
            if ($currencyInfo->name === 'ZAR') {
                $currencyRateZAR = $currencyInfo->rate;
                break;
            }
        }



        $totalFees = $totalEarnedUsd + ($totalEarnedZar/$currencyRateZAR) +($totalEarnedZwl/$currencyRateZWL);

        $totalCost = $totalCostUsd + ($totalCostZar/$currencyRateZAR) + ($totalCostZwl/$currencyRateZWL);

        $netCash = $totalFees - $totalCost;
        // Create a new Excel instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set default column width
        $defaultColumnWidth = 15;
        $sheet->getDefaultColumnDimension()->setWidth($defaultColumnWidth);
        

        // Set column headers
        $columnHeaders = ['Category', 'InFlow/OutFlow', 'Amount', 'TotalInFlow (USD)', 'TotalOutFlow(USD)','NetCash (USD)'];
        $columnIndex = 1;
        foreach ($columnHeaders as $header) {
            $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
            $columnIndex++;
        }

        $rowIndex = 2;
        $sheet->setCellValueByColumnAndRow(1, $rowIndex, 'FEES ZWL');
        $sheet->setCellValueByColumnAndRow(2, $rowIndex, 'INFLOW');
        $sheet->setCellValueByColumnAndRow(3, $rowIndex, $totalEarnedZwl);

        $rowIndex = 3;
        $sheet->setCellValueByColumnAndRow(1, $rowIndex, 'FEES USD');
        $sheet->setCellValueByColumnAndRow(2, $rowIndex, 'INFLOW');
        $sheet->setCellValueByColumnAndRow(3, $rowIndex, $totalEarnedUsd);

        $rowIndex = 4;
        $sheet->setCellValueByColumnAndRow(1, $rowIndex, 'FEES ZAR');
        $sheet->setCellValueByColumnAndRow(2, $rowIndex, 'INFLOW');
        $sheet->setCellValueByColumnAndRow(3, $rowIndex, $totalEarnedZar);

        $rowIndex = 5;
        $sheet->setCellValueByColumnAndRow(4, $rowIndex, $totalFees);

        $rowIndex = 6;
        $sheet->setCellValueByColumnAndRow(1, $rowIndex, 'COSTS ZWL');
        $sheet->setCellValueByColumnAndRow(2, $rowIndex, 'OUTFLOW');
        $sheet->setCellValueByColumnAndRow(3, $rowIndex, $totalCostZwl);

        $rowIndex = 7;
        $sheet->setCellValueByColumnAndRow(1, $rowIndex, 'COSTS ZWL');
        $sheet->setCellValueByColumnAndRow(2, $rowIndex, 'OUTFLOW');
        $sheet->setCellValueByColumnAndRow(3, $rowIndex, $totalCostUsd);

        $rowIndex = 8;
        $sheet->setCellValueByColumnAndRow(1, $rowIndex, 'COSTS ZAR');
        $sheet->setCellValueByColumnAndRow(2, $rowIndex, 'OUTFLOW');
        $sheet->setCellValueByColumnAndRow(3, $rowIndex, $totalCostZar);


        $rowIndex = 9;
        $sheet->setCellValueByColumnAndRow(5, $rowIndex, $totalCost);

        $rowIndex = 10;
        $sheet->setCellValueByColumnAndRow(6, $rowIndex, $netCash);

      
        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);

        $currentDate = date("Y-m-d"); // Get today's date in "YYYY-MM-DD" format
        $fileName = 'transaction_report_' . $currentDate . '.xlsx'; // Add today's date to the file name

        $filePath = 'reports/' . $fileName; // Adjust the file path as needed

        // Check if a report for today already exists
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the existing report file
        }

        $writer->save($filePath);

        $reportUrl = base_url() . 'reports/' . $fileName; // Adjust the URL as needed
        $response = array(
            'status' => 1,
            'message' => 'Transaction Excel report generated successfully!',
            'report_url' => $reportUrl
        );
        echo json_encode($response);

    }

    public function generateBudget() {
        log_message("error","we rae here");
        // Create a new Excel instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set default column width
        $defaultColumnWidth = 20;
        $sheet->getDefaultColumnDimension()->setWidth($defaultColumnWidth);
    
        // Set column headers
        $columnHeaders = ['Category', 'Amount'];
        $columnIndex = 1;
        foreach ($columnHeaders as $header) {
            $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
            $columnIndex++;
        }
    
        // Add budget data to the spreadsheet
        $budgetData = $this->calculateBudget(); // Assume you have a separate function to calculate the budget data
    
        $rowIndex = 2;
        foreach ($budgetData as $category => $amount) {
            $sheet->setCellValueByColumnAndRow(1, $rowIndex, $category);
            $sheet->setCellValueByColumnAndRow(2, $rowIndex, $amount);
            $rowIndex++;
        }
    
        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);
    
        $currentDate = date("Y-m-d"); // Get today's date in "YYYY-MM-DD" format
        $fileName = 'school_budget_' . $currentDate . '.xlsx'; // Add today's date to the file name
    
        $filePath = 'reports/' . $fileName; // Adjust the file path as needed
    
        // Check if a budget report for today already exists
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the existing budget report file
        }
    
        $writer->save($filePath);
    
        $budgetUrl = base_url() . 'budgets/' . $fileName; // Adjust the URL as needed
        $response = [
            'status' => 1,
            'message' => 'School budget Excel spreadsheet generated successfully!',
            'budget_url' => $budgetUrl
        ];
        echo json_encode($response);
    }

    public function calculateBudget() {
        // Load the Student model
        $this->load->model(['transaction']);
    
        $totalEarnedZwl = $this->transaction->totalEarnedZwl();
        $totalEarnedUsd = $this->transaction->totalEarnedUsd();
        $totalEarnedZar = $this->transaction->totalEarnedZar();
    
        $this->load->model(['cost']);
        
        $totalCostZwl = $this->cost->totalCostZwl();
        $totalCostUsd = $this->cost->totalCostUsd();
        $totalCostZar = $this->cost->totalCostZar();
    
        $this->load->model(['currency']);
        
        $currencies = $this->currency->getAllCurrencies(); 
        $currencyRateZWL = 0;
        foreach ($currencies as $currencyInfo) {
            if ($currencyInfo->name === 'ZWL') {
                $currencyRateZWL = $currencyInfo->rate;
                break;
            }
        }
    
        $currencyRateZAR = 0;
        foreach ($currencies as $currencyInfo) {
            if ($currencyInfo->name === 'ZAR') {
                $currencyRateZAR = $currencyInfo->rate;
                break;
            }
        }
    
        $totalFees = $totalEarnedUsd + ($totalEarnedZar / $currencyRateZAR) + ($totalEarnedZwl / $currencyRateZWL);
        $totalCost = $totalCostUsd + ($totalCostZar / $currencyRateZAR) + ($totalCostZwl / $currencyRateZWL);
        $netCash = $totalFees - $totalCost;
    
        // Create an array to store the budget data
        $budgetData = [
            'Total Earned ZWL' => $totalEarnedZwl,
            'Total Earned USD' => $totalEarnedUsd,
            'Total Earned ZAR' => $totalEarnedZar,
            'Total Cost ZWL' => $totalCostZwl,
            'Total Cost USD' => $totalCostUsd,
            'Total Cost ZAR' => $totalCostZar,
            'Total Fees' => $totalFees,
            'Total Cost' => $totalCost,
            'Net Cash' => $netCash,
        ];
    
        return $budgetData;
    }
    
    
    public function newhex(){
        echo md5(time());
    }
    
    
    public function a(){
        $this->load->view('test');
    }
}