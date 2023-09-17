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
        $this->load->model(['transaction', 'cost', 'currency', 'income']);
        $currentYear = $this->input->post('year', TRUE);
        $currentMonth = sprintf("%02d", $this->input->post('month', TRUE)); // Format month with leading zeros
    
        // Step 1: Get income data
        $incomeData = $this->getTotalIncomeByCurrency($currentMonth, $currentYear);
    
        // Step 2: Get cost data
        $costData = $this->getTotalCostByCurrency();
    
        // Step 3: Convert both income and costs to USD
        $totalIncomeUSD = $this->convertToUSD($incomeData);
        $totalCostUSD = $this->convertToUSD($costData);
    
        // Step 4: Calculate Net Income
        $netIncomeUSD = $totalIncomeUSD - $totalCostUSD;
    
        // Create an Excel instance and set up the spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $defaultColumnWidth = 15;
        $sheet->getDefaultColumnDimension()->setWidth($defaultColumnWidth);
    
        // Merge cells A1 to G1 and set background color
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');
    
        // Set the school name at the center, increase font size, and row height
        $schoolName = "Your School Name";
        $sheet->setCellValue('A1', $schoolName);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setSize(18)->setSize(18)->setName('Arial'); // Use the Arial font family
        $sheet->getRowDimension(1)->setRowHeight(30); // Increase row height

        // Add a border line under the school name
        $borderStyle = [
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($borderStyle);


        // Merge cells A2 to G2 for "Income Statement"
        $sheet->mergeCells('A2:G2');
        $sheet->getStyle('A2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('3498DB'); // Darker blue background

        // Set "Income Statement" to the left with white text, bold, nice font, and larger font size
        $sheet->setCellValue('A2', 'Income Statement');
        $sheet->getStyle('A2')->getFont()->setSize(18)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE))->setBold(true)->setName('Arial'); // White text, bold, Arial font
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

        // Increase row height for row 2 to 20
        $sheet->getRowDimension(2)->setRowHeight(20);

        
        // Add Income section
        $sheet->setCellValue('A4', "Incomes");
        $incomeRow = 5;
        foreach ($incomeData as $incomeName => $incomeAmount) {
            $sheet->setCellValue("A$incomeRow", $incomeName);
            $sheet->setCellValue("B$incomeRow", $incomeAmount);
            $incomeRow++;
        }
        $sheet->setCellValue("A$incomeRow", "Total Incomes");
        $sheet->setCellValue("B$incomeRow", $totalIncomeUSD);
    
        // Add Expenses section
        $expensesRow = $incomeRow + 2;
        $sheet->setCellValue("A$expensesRow", "Expenses");
        $expensesRow++;
        foreach ($costData as $expenseName => $expenseAmount) {
            $sheet->setCellValue("A$expensesRow", $expenseName);
            $sheet->setCellValue("B$expensesRow", $expenseAmount);
            $expensesRow++;
        }
        $sheet->setCellValue("A$expensesRow", "Total Expenses");
        $sheet->setCellValue("B$expensesRow", $totalCostUSD);
    
        // Calculate Net Income
        $netIncome = $totalIncomeUSD - $totalCostUSD;
        $netIncomeRow = $expensesRow + 2;
        $sheet->setCellValue("A$netIncomeRow", "Net Income");
        $sheet->setCellValue("B$netIncomeRow", $netIncome);
    
        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);
        $currentDate = date("Y-m-d");
        $fileName = 'school_report_' . $currentDate . '.xlsx';
        $filePath = 'reports/' . $fileName;
    
        try {
            $writer->save($filePath);
            log_message('error', 'Excel report saved: ' . $filePath);
        } catch (Exception $e) {
            log_message('error', 'Error saving Excel report: ' . $e->getMessage());
        }
    
        $reportUrl = base_url() . 'reports/' . $fileName;
        $response = array(
            'status' => 1,
            'message' => 'Transaction Excel report generated successfully!',
            'report_url' => $reportUrl
        );
        echo json_encode($response);
    }
    
    
    
    

    public function generateBudget() {
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

    
    private function getTotalIncomeByCurrency($month, $year) {
        $incomeDataFees = $this->transaction->getIncomeByCurrencyForMonth($month, $year);
        $incomeDataOther = $this->income->getIncomesForMonth($month, $year);

        $totalIncomeByCurrency = [];

        foreach ($incomeDataFees as $currency => $amount) {
            $totalIncomeByCurrency[$currency] = $amount;
        }

        foreach ($incomeDataOther as $income) {
            $currency = $income->currency;
            $amount = $income->amount;

            if (!isset($totalIncomeByCurrency[$currency])) {
                $totalIncomeByCurrency[$currency] = 0;
            }

            $totalIncomeByCurrency[$currency] += $amount;
        }

        return $totalIncomeByCurrency;
    }

    private function getTotalCostByCurrency() {
        $costsData = $this->cost->getAllCostsAndCurrencies();
        $totalCostByCurrency = [];

        foreach ($costsData as $cost) {
            $currency = $cost->currency;
            $amount = $cost->amount;

            if (!isset($totalCostByCurrency[$currency])) {
                $totalCostByCurrency[$currency] = 0;
            }

            $totalCostByCurrency[$currency] += $amount;
        }

        return $totalCostByCurrency;
    }

    private function convertToUSD($data) {
        $allCurrencies = $this->currency->getAllCurrencies();
        $exchangeRates = [];
    
        foreach ($allCurrencies as $currency) {
            $exchangeRates[$currency->name] = $currency->rate;
        }
    
        $totalUSD = 0;
    
        foreach ($data as $currency => $amount) {
            if ($currency !== 'USD') {
                if (isset($exchangeRates[$currency])) {
                    $usdEquivalent = $amount / $exchangeRates[$currency];
                    $totalUSD += $usdEquivalent;
                } else {
                    log_message('error', 'Exchange rate not found for currency: ' . $currency);
                }
            } else {
                $totalUSD += $amount;
            }
        }
    
        return $totalUSD;
    }

    public function getMonthEndingText($currentYear, $currentMonth) {
        // Convert the numeric month to its name
        $monthNumber = (int)$currentMonth;
        $monthName = date("F", mktime(0, 0, 0, $monthNumber, 1));
    
        // Get the last day of the month
        $lastDay = date("t", strtotime("$currentYear-$currentMonth-01"));
    
        // Create the "Month Ending" text
        $monthEnding = "Month Ending $monthName $lastDay";
    
        return $monthEnding;
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