<?php
defined('BASEPATH') OR exit('');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * Description of Finances
 * @date 16 September, 2023
 */
class Finances extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        // Load the 'finance' model in the constructor
        $this->load->model(['finance']);
    }
    
    public function index() {
        // Load the view without cost data and set the page title
        $this->load->view('main', [
            'pageContent' => $this->load->view('finances', '', TRUE),
            'pageTitle' => "Finances"
        ]);
    }

    // Method to fetch cost data using the 'finance' model
    public function getCostsData() {
        
        // Load the 'finance' model method to fetch data
        $costsData = $this->finance->getCostsData();
        
        $this->output->set_content_type('application/json')->set_output(json_encode($costsData));

    }

    public function generateReport() {
        
        
        $this->load->model(['transaction', 'cost', 'currency', 'income','transaction_Item']);
        $currentYear = $this->input->post('year', TRUE);
        $currentMonth = sprintf("%02d", $this->input->post('month', TRUE)); // Format month with leading zeros
    
        // Step 1: Get income data
        $incomeData = $this->getTotalIncomeByCurrency($currentMonth, $currentYear);

        // Access the total income by currency from the $incomeData array
        $totalIncomeByCurrency = $incomeData['totalIncomeByCurrency'];

        $totalRevenueItems = 0; // Initialize a variable to hold the total revenue for items

        // calculate total revenue for items
        foreach ($incomeData['incomeDataItems'] as $item) {
            $totalRevenue = $item['totalRevenue'];
            $totalRevenueItems += $totalRevenue;
        }

        // Add total revenue to the "USD" amount in the array
        if (isset($totalIncomeByCurrency['USD'])) {
            $totalIncomeByCurrency['USD'] += $totalRevenueItems;
        }
    
        // Step 2: Get cost data
        $costData = $this->getTotalCostByCurrency();

        // Access the total Cost by currency from the $CostData array
        $totalCostByCurrency = $costData['totalCostByCurrency'];

    
        // Step 3: Convert both income and costs to USD
        $totalIncomeUSD = $this->convertToUSD($totalIncomeByCurrency);


        $totalCostUSD = $this->convertToUSD($totalCostByCurrency);

    
        // Step 4: Calculate Net Income
        $netIncomeUSD = $totalIncomeUSD - $totalCostUSD;
    
        // Create an Excel instance and set up the spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $defaultColumnWidth = 15;
        $sheet->getDefaultColumnDimension()->setWidth($defaultColumnWidth);

        // Increase the width of column A to 30
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(25);
        
    
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

        $sheet->mergeCells('A3:G3');
        $sheet->getStyle('A3:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('3498DB'); 

        $monthEnding = $this->getMonthEndingText($currentYear, $currentMonth);
        
        // Set "Month Ending" to the center with white text, bold, nice font, and larger font size on a blue background
        $sheet->setCellValue('A3', $monthEnding);
        $sheet->getStyle('A3')->getFont()->setSize(18)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE))->setBold(true)->setName('Arial'); // White text, bold, Arial font
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getRowDimension(3)->setRowHeight(20); // Increase row height
        $sheet->getStyle('A3:G3')->applyFromArray($borderStyle);

        // Merge cells A4 to G4
        $sheet->mergeCells('A4:G4');

        // Set background color to grey
        $sheet->getStyle('A4:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text
        $cell = $sheet->getCell('A4');
        $cell->setValue("Incomes");
        $cell->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        // Increase row height for row 4 to 15
        $sheet->getRowDimension(4)->setRowHeight(15);
        $sheet->getStyle('A4:G4')->applyFromArray($borderStyle);

        $row = 5; // Starting row for inserting data
        
        // Insert data from incomeDataFees
        foreach ($incomeData['incomeDataFees'] as $currency => $amount) {
            $cellA = $sheet->getCell('A' . $row);
            $cellA->setValue('Tuition (' . $currency . ')');
            $cellA->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial

            $cellB = $sheet->getCell('B' . $row);
            $cellB->setValue('$' . $amount); // Adding a dollar sign
            $cellB->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
            $cellB->getStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

            $row++; // Move to the next row
        }

        // Insert exam fee row
        $cellA = $sheet->getCell('A' . $row);
        $cellA->setValue('Exam Fees(USD)');
        $cellA->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial

        $cellB = $sheet->getCell('B' . $row);
        $cellB->setValue('$' . $incomeData['exam_fees']); // Adding a dollar sign
        $cellB->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
        $cellB->getStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        $row++; // Move to the next row

        // Insert data from incomeDataItems
        foreach ($incomeData['incomeDataItems'] as $item) {
            $cellA = $sheet->getCell('A' . $row);
            $cellA->setValue($item['itemName'] . ' (' . $item['totalQuantity'] . ')');
            $cellA->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial

            $cellB = $sheet->getCell('B' . $row);
            $cellB->setValue('$' . $item['totalRevenue']); // Adding a dollar sign
            $cellB->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
            $cellB->getStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

            $row++; // Move to the next row
        }

        
        
        
        $mini = $row - 1;
        $sheet->getStyle('A'.$mini.':B'.$mini)->applyFromArray($borderStyle);

        // Merge cells A9 to G9
        $sheet->mergeCells('A'.$row.':B'.$row);

        // Set background color to grey
        $sheet->getStyle('A'.$row.':B'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text
        $cell = $sheet->getCell('A'.$row);
        $cell->setValue("Other incomes");
        $cell->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);
        $sheet->getStyle('A'.$row.':B'.$row)->applyFromArray($borderStyle);

        $row++;
        
        // Insert data from incomeDataOther
        foreach ($incomeData['incomeDataOther'] as $income) {
            $cellA = $sheet->getCell('A' . $row);
            $cellA->setValue(ucwords($income->name) . ' (' . $income->currency . ')');
            $cellA->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
            
            $cellB = $sheet->getCell('B' . $row);
            $cellB->setValue('$' . $income->amount); // Adding a dollar sign
            $cellB->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
            
            $cellB->getStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
            
            $row++; // Move to the next row
        }
        $mini = $row - 1;
        $sheet->getStyle('A'.$mini.':B'.$mini)->applyFromArray($borderStyle);       
        $sheet->getStyle('A'.$row.':B'.$row)->applyFromArray($borderStyle);

        // Merge cells 
        $sheet->mergeCells('A'.$row.':B'.$row);

        // Set background color to grey
        $sheet->getStyle('A'.$row.':B'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text
        $cell = $sheet->getCell('A'.$row);
        $cell->setValue("Total Incomes In Currencies");
        $cell->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        // Insert data from totalIncomeByCurrency below the merged row
        foreach ($totalIncomeByCurrency as $currency => $amount) {
            $cellA = $sheet->getCell('A' . ($row + 1));
            $cellA->setValue($currency);
            $cellA->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
            
            $cellB = $sheet->getCell('B' . ($row + 1));
            $cellB->setValue('$' . $amount); // Adding a dollar sign
            $cellB->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
            $cellB->getStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
            
            $row++; // Move to the next row
        }

        $row++;
        $mini = $row - 1;
        $sheet->getStyle('A'.$mini.':B'.$mini)->applyFromArray($borderStyle);       
        $sheet->getStyle('A'.$row.':B'.$row)->applyFromArray($borderStyle);

        // Set background color to grey for cell A
        $sheet->getStyle('A'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text for cell A
        $cellA = $sheet->getCell('A'.$row);
        $cellA->setValue("Total Income(USD)");
        $cellA->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        // Set background color to grey for cell B
        $sheet->getStyle('B'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text for cell B
        $cellB = $sheet->getCell('B'.$row);
        $cellB->setValue('$' . $totalIncomeUSD);
        $cellB->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);


    
        // Add Expenses section
        $expensesRow = $row + 2;

        $mini = $expensesRow - 1;
        $sheet->getStyle('A'.$mini.':B'.$mini)->applyFromArray($borderStyle);       
        $sheet->getStyle('A'.$expensesRow.':B'.$expensesRow)->applyFromArray($borderStyle);


        $sheet->mergeCells('A'.$expensesRow.':B'.$expensesRow);
        $sheet->getStyle('A'.$expensesRow.':B'.$expensesRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');
 
        // Set text color to black, make it bold, and italicize the text
        $cell = $sheet->getCell('A'.$expensesRow);
        $cell->setValue("Costs(expenses)");
        $cell->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        $expensesRow++;
        foreach ($costData['allCosts'] as $costItem) {
            $cellA = $sheet->getCell('A' . $expensesRow);
            $cellA->setValue(ucwords($costItem['name']) . ' (' . $costItem['currency'] . ')'); // Using 'name' for cost item name
            $cellA->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
        
            $cellB = $sheet->getCell('B' . $expensesRow);
            $cellB->setValue('$' . $costItem['amount']); // Adding a dollar sign
            $cellB->getStyle()->getFont()->setItalic(true)->setName('Arial'); // Make it italic and set the font family to Arial
        
            $cellB->getStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
        
            $expensesRow++; // Move to the next row
        }
        
        $expensesRow + 2;

        $mini = $expensesRow - 1;
        $sheet->getStyle('A'.$mini.':B'.$mini)->applyFromArray($borderStyle);       
        $sheet->getStyle('A'.$expensesRow.':B'.$expensesRow)->applyFromArray($borderStyle);

        // Set background color to grey for cell A
        $sheet->getStyle('A'.$expensesRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text for cell A
        $cellA = $sheet->getCell('A'.$expensesRow);
        $cellA->setValue("Total Cost(USD)");
        $cellA->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        // Set background color to grey for cell B
        $sheet->getStyle('B'.$expensesRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text for cell B
        $cellB = $sheet->getCell('B'.$expensesRow);
        $cellB->setValue('$' . $totalCostUSD);
        $cellB->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        $expensesRow ++;
        $expensesRow ++;
        


        $mini = $expensesRow - 1;
        $sheet->getStyle('A'.$mini.':B'.$mini)->applyFromArray($borderStyle);       
        $sheet->getStyle('A'.$expensesRow.':B'.$expensesRow)->applyFromArray($borderStyle);

        // Set background color to grey for cell A
        $sheet->getStyle('A' . $expensesRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text for cell A
        $cellA = $sheet->getCell('A' . $expensesRow);
        $cellA->setValue("Net Income(USD)");
        $cellA->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        // Set background color to grey for cell B
        $sheet->getStyle('B' . $expensesRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E0E0E0');

        // Set text color to black, make it bold, and italicize the text for cell B
        $cellB = $sheet->getCell('B' . $expensesRow);
        $cellB->setValue('$' . $netIncomeUSD);
        $cellB->getStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK))->setBold(true)->setItalic(true);

        // Merge cells 
        $sheet->mergeCells('C5:G'.$row);
        $sheet->mergeCells('C'.$row.':G'.$expensesRow);

        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);
        $currentDate = date("Y-m-d");
        $fileName = 'finance_report_' . $currentDate . '.xlsx';
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

    private function getTotalIncomeByCurrency($month, $year) {
        $incomeDataFees = $this->transaction->getIncomeByCurrencyForMonth($month, $year);
        $incomeDataOther = $this->income->getIncomesForMonth($month, $year);
        $incomeDataItems = $this->transaction_Item->getSalesForMonth($month, $year);
    
        // Extract 'exam_fees' from $incomeDataFees
        $examFees = $incomeDataFees['exam_fees'];
    
        // Remove 'exam_fees' from $incomeDataFees
        unset($incomeDataFees['exam_fees']);
    
        // Calculate total income by currency
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
    
        // Check if "USD" entry exists in totalIncomeByCurrency
        if (isset($totalIncomeByCurrency['USD'])) {
            // If it exists, add "exam_fees" to it
            $totalIncomeByCurrency['USD'] += $examFees;
        } else {
            // If it doesn't exist, create it with the value of "exam_fees"
            $totalIncomeByCurrency['USD'] = $examFees;
        }
    
        // Create an associative array to return all values
        $result = [
            'incomeDataFees' => $incomeDataFees,
            'incomeDataOther' => $incomeDataOther,
            'totalIncomeByCurrency' => $totalIncomeByCurrency,
            'incomeDataItems' => $incomeDataItems,
            'exam_fees' => $examFees,
        ];
    
        return $result;
    }
    
    

    private function getTotalCostByCurrency() {
        try {
            $costsData = $this->cost->getAllCostsAndCurrencies();
            $totalCostByCurrency = [];
            $response = ['allCosts' => []]; // Initialize the response array
    
            foreach ($costsData as $cost) {
                $currency = $cost->currency;
                $amount = $cost->amount;
                $name = $cost->name; // Assuming there's a 'name' property for cost
    
                // Store all costs in the response
                $response['allCosts'][] = [
                    'name' => $name,
                    'currency' => $currency,
                    'amount' => $amount,
                ];
    
                if (!isset($totalCostByCurrency[$currency])) {
                    $totalCostByCurrency[$currency] = 0;
                }
    
                $totalCostByCurrency[$currency] += $amount;
            }
    
            // Add the total costs by currency to the response
            $response['totalCostByCurrency'] = $totalCostByCurrency;
    
            return $response;
        } catch (Exception $e) {
            // Handle any exceptions that occur during the process
            log_message('error', 'Error in getTotalCostByCurrency: ' . $e->getMessage());
            return ['error' => 'An error occurred while fetching and processing cost data.'];
        }
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


}
