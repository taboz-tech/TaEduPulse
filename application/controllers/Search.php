<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Search
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 26 Jan 2023
 */

class Search extends CI_Controller{
    protected $value;
    
    public function __construct() {
        parent::__construct();
        
        //$this->gen->checklogin();
        
        $this->genlib->ajaxOnly();
        
        $this->load->model(['transaction', 'student','grade','teacher','cost','category','currency','income','record','staff','payroll','subject','examination','item','transaction_Item']);
        
        $this->load->helper('text');
        
        $this->value = $this->input->get('v', TRUE);
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function index(){
        /**
         * function will call models to do all kinds of search just to check whether there is a match for the searched value
         * in the search criteria or not. This applies only to global search
         */
        
        
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    
    
    
    
    
    public function studentSearch(){
        $searchValue = $this->input->get('v', TRUE);
        $selectedClass = $this->input->get('selectedClass', TRUE);
    
        $data['allStudents'] = $this->student->studentsearch($searchValue, $selectedClass);
        $data['sn'] = 1;
    
        $json['studentsListTable'] = $data['allStudents']
            ? $this->load->view('students/studentslisttable', $data, TRUE)
            : "No match found";
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    
    public function transSearch(){
        $data['allTransactions'] = $this->transaction->transsearch($this->value);
        $data['sn'] = 1;

        $json['transTable'] = $data['allTransactions'] ? $this->load->view('transactions/transtable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    public function reportSearch() {
        $data['allReports'] = $this->record->searchReportFiles($this->value);
        $data['sn'] = 1;
        
        // Load the view to display the search results
        $json['reportsListTable'] = $data['allReports'] ? $this->load->view('records/recordslisttable', $data, TRUE) : "No match found";
        
        // Set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function otherSearch(){
        
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function gradeSearch(){
        $data['allgrades'] = $this->grade->gradesearch($this->value);
        $data['sn'] = 1;
        
        $json['gradesListTable'] = $data['allgrades'] ? $this->load->view('grades/gradeslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function teacherSearch(){
        $data['allTeachers'] = $this->teacher->teachersearch($this->value);
        $data['sn'] = 1;
        
        $json['teachersListTable'] = $data['allTeachers'] ? $this->load->view('teachers/teacherslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function costSearch(){
        $data['allCosts'] = $this->cost->costsearch($this->value);
        $data['sn'] = 1;
        
        $json['costsListTable'] = $data['allCosts'] ? $this->load->view('costs/costslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function categorieSearch(){
        $data['allCategories'] = $this->category->categoriesearch($this->value);
        $data['sn'] = 1;
        
        $json['categoriesListTable'] = $data['allCategories'] ? $this->load->view('categories/categorieslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function currencieSearch(){
        $data['allCurrencies'] = $this->currency->currenciesearch($this->value);
        $data['sn'] = 1;
        
        $json['currenciesListTable'] = $data['allCurrencies'] ? $this->load->view('currencies/currencieslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function incomeSearch(){
        $data['allIncomes'] = $this->income->incomesearch($this->value);
        $data['sn'] = 1;
        
        $json['incomesListTable'] = $data['allIncomes'] ? $this->load->view('incomes/incomeslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

     /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function staffSearch(){
        $data['allStaffs'] = $this->staff->staffsearch($this->value);
        $data['sn'] = 1;
        
        $json['staffsListTable'] = $data['allStaffs'] ? $this->load->view('staffs/staffslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

     /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function payslipSearch(){
        
        $data['allPayslips'] = $this->payroll->payslipSearch($this->value);
        $data['sn'] = 1;
        
        $json['payslipsListTable'] = $data['allPayslips'] ? $this->load->view('payrolls/payrollstable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function recordSearch(){
        $searchTerm = $this->input->get('v', TRUE);
        
        // Call the searchReportFiles method from the Record model to get matching records
        $matchingRecords = $this->record->searchReportFiles($searchTerm);
    
        // Create a response array to hold the search results
        $response = [];
    
        // Check if any matching records were found
        if (!empty($matchingRecords)) {
            // Loop through the matching records and build the response array
            foreach ($matchingRecords as $record) {
                $fileName = pathinfo($record, PATHINFO_FILENAME);
                $recordExtension = pathinfo($record, PATHINFO_EXTENSION);
                $recordPath = base_url() . 'reports/' . urlencode($fileName . '.' . $recordExtension); // Adjust the path here
    
                // Add each matching record to the response array
                $response[] = [
                    'file_name' => $fileName,
                    'download_link' => $recordPath,
                ];
            }
        } else {
            // If no matching records were found, include a message in the response
            $response['message'] = "No matching records found.";
        }
    
        // Set the final output as JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function subjectSearch(){
        $data['allsubjects'] = $this->subject->subjectsearch($this->value);
        $data['sn'] = 1;
        
        $json['subjectsListTable'] = $data['allsubjects'] ? $this->load->view('subjects/subjectslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function examStudentSearch(){
        $searchValue = $this->input->get('v', TRUE);
        $selectedClass = $this->input->get('selectedClass', TRUE);
    
        $data['allStudents'] = $this->examination->searchStudents($searchValue, $selectedClass);
        $data['sn'] = 1;
    
        $json['studentsListTable'] = $data['allStudents']
            ? $this->load->view('examinations/examinationslisttable', $data, TRUE)
            : "No match found";
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    
    
    public function itemSearch(){
        $data['allItems'] = $this->item->itemsearch($this->value);
        $data['sn'] = 1;
        $data['cum_total'] = $this->item->getItemsCumTotal();
        
        $json['itemsListTable'] = $data['allItems'] ? $this->load->view('items/itemslisttable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    public function trans_Itemsearch(){
        log_message("error","we are hwe");
        $data['allTransactions'] = $this->transaction_Item->transsearch($this->value);
        log_message("error","teh data: ".print_r($data['allTransactions'],TRUE));
        $data['sn'] = 1;

        $json['transTable'] = $data['allTransactions'] ? $this->load->view('transaction_Items/transtable', $data, TRUE) : "No match found";
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
