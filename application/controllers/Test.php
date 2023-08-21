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
        log_message('error','ew are here ');
        // Load the Student model
        $this->load->model(['transaction']);
        log_message('error','ew are here  after');


        $totalEarnedZwl = $this->transaction->totalEarnedZwl();
        log_message('error','this is the total earned in ZWL'.print_r($totalEarnedZwl,TRUE));

        $totalEarnedUsd = $this->transaction->totalEarnedUsd();
        log_message('error','this is the total earned in Usd'.print_r($totalEarnedUsd,TRUE));

        $totalEarnedZar = $this->transaction->totalEarnedZar();
        log_message('error','this is the total earned in Zar'.print_r($totalEarnedZar,TRUE));

        log_message('error','taboz');
        $this->load->model(['cost']);

        $totalCostZwl = $this->cost->totalCostZwl();
        log_message('error','this is the total cost in ZWL :    '.$totalCostZwl);

        $totalCostUsd = $this->cost->totalCostUsd();
        log_message('error','this is the total cost in Usd'.print_r($totalCostUsd,TRUE));

        $totalCostZar = $this->cost->totalCostZar();
        log_message('error','this is the total cost in Zar'.print_r($totalCostZar,TRUE));


        $this->load->model(['currency']);

        $currencies = $this->currency->getAllCurrencies(); 
        $currencyRateZWL = 0;
        foreach ($currencies as $currencyInfo) {
            if ($currencyInfo->name === 'ZWL') {
                $currencyRateZWL = $currencyInfo->rate;
                break;
            }
        }
        log_message('error', 'rher currency rate for zwl: '.$currencyRateZWL);

        $currencyRateZAR = 0;
        foreach ($currencies as $currencyInfo) {
            if ($currencyInfo->name === 'ZAR') {
                $currencyRateZAR = $currencyInfo->rate;
                break;
            }
        }

        log_message('error', 'rher currency rate for ZAR: '.$currencyRateZAR);


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

        log_message('error',' we rae here taboz');
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
        $filePath = 'reports/transaction_report.xlsx'; // Adjust the file path as needed
        $writer->save($filePath);
        $reportUrl = base_url() . 'reports/transaction_report.xlsx'; // Adjust the URL as needed
        $response = array(
            'status' => 1,
            'message' => 'Transaction Excel report generated successfully!',
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