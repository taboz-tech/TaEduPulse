<?php
defined('BASEPATH') OR exit('');
require_once 'functions.php';
/**
 * Description of Transactions
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 10th September 2023
 */
class Payrolls extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['payroll', 'staff']);
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function index(){
        $payrollsData['staffs'] = $this->staff->getActiveStaffs('name', 'ASC');//get active staff members
        
        $data['pageContent'] = $this->load->view('payrolls/payrolls', $payrollsData, TRUE);
        $data['pageTitle'] = "Payrolls";
        
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
     * lapr_ = "Load All Payrolls"
     */
    public function lapr_(){
        //set the sort order
       
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "id";
        
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "DESC";

        //count the total number of transaction group (grouping by the ref) in db
        $totalPayslips = $this->payroll->totalPayrolls();
        
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalPayslips, "payrolls/lapr_", $limit, ['onclick'=>'return lapr_(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        // Get all Payrolls from the database
        
        $data['allPayslips'] = $this->payroll->getAll($orderBy, $orderFormat, $start, $limit);
        
        // Calculate and assign the 'range' value
        $data['range'] = $totalPayslips > 0 ? ($start+1) . "-" . ($start + count($data['allPayslips'])) . " of " . $totalPayslips : "";
        

        // Generate pagination links
        $data['links'] = $this->pagination->create_links();
        
        // Calculate and assign the 'sn' value
        $data['sn'] = $start + 1;
        
        $json['payslipsListTable'] = $this->load->view('payrolls/payrollstable', $data, TRUE);
    
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
     * np_ = "New Payroll"
     */
    public function np_(){
        $this->genlib->ajaxOnly();


        $staffName = $this->input->post('sName');
        $staffSurname = $this->input->post('staffSurname',TRUE);
        $staffStaff_id =  $this->input->post('sId', TRUE);
        $staffDepartment = $this->input->post('staffDepartment',TRUE);
        $staffNational_id = $this->input->post('staffNational_id',TRUE);
        $staffJob_tittle = $this->input->post('staffJob_tittle',TRUE);
        $staffSalary = $this->input->post('staffSalary',TRUE);
        $staffIncome_tax = $this->input->post('staffIncome_tax',TRUE);
        $staffOvertime = $this->input->post('staffOvertime',TRUE);
        $staffHealthy_insurance = $this->input->post('staffHealthy_insurance',TRUE);
        $currentMonth = $this->input->post('currentMonth',TRUE);
        log_message("error","we are here with Name: ",$staffStaff_id);
            
      
        $allIsWell = $this->validateStaffsDet($staffStaff_id,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth);
        
        $response = json_decode($allIsWell, true);
        if ($response['status'] === 1){//insert each payroll into db, generate payslip and return info to client
            log_message("error","we are here with STAFF ID: ",$staffStaff_id);
            
            //will insert info into db and return payslip
            $returnedData = $this->insertTrToDb($staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth);    
            $json['status'] = $returnedData ? 1 : 0;
            $json['msg'] = $returnedData ? "Transaction successfully processed" : 
                    "Unable to process your request at this time. Pls try again later "
                    . "or contact technical department for assistance";
            $json['transReceipt'] = $returnedData['transReceipt'];
            
            $json['totalEarnedToday'] = number_format($this->transaction->totalEarnedToday());
            
            //add into eventlog
            //function header: addevent($event, $eventRowIdOrRef, $eventDesc, $eventTable, $staffId) in 'genmod'
            $eventDesc = count($arrOfStudentsDetails). " fees totalling $". number_format($cumAmount, 2)
                    ." with reference number {$returnedData['transRef']} was paid";
            
            $this->genmod->addevent("New Transaction", $returnedData['transRef'], $eventDesc, 'transactions', $this->session->admin_id);
       }
        
        else{//return error msg
            $json['status'] = 0;
            $json['msg'] = "Transaction could not be processed. Please ensure there are no errors. Thanks";
            $json['errors'] = $response['errors']; // Include the validation errors
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
     * Validates the details of staff sent from client to prevent manipulation
     * @param type $arrOfStaffsInfo
     * @param type $payment Month
     * @return boolean
     */


     private function validateStaffsDet($staffStaff_id, $staffSalary, $staffIncome_tax, $staffOvertime, $staffHealthy_insurance, $currentMonth) {
        $errors = array();
    
        // Take salary from the db
        $salaryInDb = $this->genmod->gettablecol('staffs', 'basic_salary', 'staff_id', $staffStaff_id);
    
        if ($staffSalary != $salaryInDb) {
            $errors['salary'] = "Salary validation failed";
        }
    
        // Take overtime from the db
        $overtimeInDb = $this->genmod->gettablecol('staffs', 'overtime', 'staff_id', $staffStaff_id);
    
        if ($staffOvertime != $overtimeInDb) {
            $errors['overtime'] = "Overtime validation failed";
        }
    
        // Take income_tax from the db
        $income_taxInDb = $this->genmod->gettablecol('staffs', 'income_tax', 'staff_id', $staffStaff_id);
    
        if ($staffIncome_tax != $income_taxInDb) {
            $errors['income_tax'] = "Income tax validation failed";
        }
    
        // Take healthy insurance from the db
        $healthy_insuranceInDb = $this->genmod->gettablecol('staffs', 'healthy_insurance', 'staff_id', $staffStaff_id);
    
        if ($staffHealthy_insurance != $healthy_insuranceInDb) {
            $errors['healthy_insurance'] = "Healthy insurance validation failed";
        }
    
        $currentMonthIn = date('F');
    
        if ($currentMonth != $currentMonthIn) {
            $errors['current_month'] = "Month validation failed";
        }
    
        $response = array();
        
        if (!empty($errors)) {
            $response['status'] = 0;
            $response['errors'] = $errors;
        } else {
            $response['status'] = 1;
            $response['message'] = "Validation successful";
        }
    
        return json_encode($response);
    }
    
    
   
        
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
     * 
     * @param type $arrOfStudentsDetails
     * @param type $_mop
     * @param type $_at
     * @param type $cumAmount
     * @param type $_cd
     * @param type $cust_name
     * @param type $cust_phone
     * @param type $cust_email
     * @param type $description
     * @param type $term
     * @param type $currency
     * @return boolean
     */
    private function insertTrToDb($staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth){
        
        //generate random string to use as Payslip ref
        //keep regeneration the ref if generated ref exist in db
        do {
            $random_number = generateRandomCode('numeric', 5, 5, "");
            $ref = 'PSL' . $random_number;
            
        } while ($this->payroll->isRefExist($ref));

        $staffAddress = $this->genmod->getTableCol('staffs', 'address', 'staff_id', $staffStaff_id);
        $staffPhone = $this->genmod->getTableCol('staffs', 'phone', 'staff_id', $staffStaff_id);
        $staffEmail = $this->genmod->getTableCol('staffs', 'email', 'staff_id', $staffStaff_id);
        $paymentMethod ="Bank Transfer";
        $payroll_start_date = date('F,j;Y',$currentMonth);
        log_message("error","the start date is: ".$payroll_start_date);
        
        
		
        
        //start transaction
        $this->db->trans_start();

        try {
            
            
            /*
                * add transaction to db
                * function header: add($staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth,$staffAddress,$staffEmail,$staffPhone)
                */
            $payrollId = $this->payroll->add($ref,$staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth,$staffAddress,$staffEmail,$staffPhone,$paymentMethod);
            
                           
        } catch (Exception $e) {
            
            // You might also want to handle the exception appropriately based on your application's needs.
        }
        
        
        $this->db->trans_complete();//end transaction

        //ensure there was no error
        //works in production since db_debug would have been turned off
        if($this->db->trans_status() === FALSE){
            return false;
        }
        
        else{
            $dataToReturn = [];
            
            //get transaction date in db, to be used on the receipt. It is necessary since date and time must matc
            $dateInDb = $this->genmod->getTableCol('transactions', 'transDate', 'transId', $transId);
            
            //generate receipt to return
            $dataToReturn['transReceipt'] = $this->genTransReceipt($allTransInfo, $cumAmount, $_at, $_cd, $ref, $dateInDb, $_mop, $cust_name, $cust_phone, $cust_email, $currency);

            $dataToReturn['transRef'] = $ref;
            
            return $dataToReturn;
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
     * 
     * @param array $allTransInfo
     * @param type $cumAmount
     * @param type $_at
     * @param type $_cd
     * @param type $ref
     * @param type $transDate
     * @param type $_mop
     * @param type $cust_name
     * @param type $cust_phone
     * @param type $cust_email
     * @return type
     */
    private function genTransReceipt($allTransInfo, $cumAmount, $_at, $_cd, $ref, $transDate, $_mop, $cust_name, $cust_phone, $cust_email,$currency){
        $data['allTransInfo'] = $allTransInfo;

        $data['cumAmount'] = $cumAmount;
        $data['amountTendered'] = $_at;
        $data['changeDue'] = $_cd;
        $data['ref'] = $ref;
        $data['transDate'] = $transDate;
        $data['_mop'] = $_mop;
        $data['cust_name'] = $cust_name;
        $data['cust_phone'] = $cust_phone;
        $data['cust_email'] = $cust_email;
        $data['currency'] = $currency;
        
        //generate and return receipt
        $transReceipt = $this->load->view('transactions/transreceipt', $data, TRUE);
        
        return $transReceipt;
    }
    
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
     * vtr_ = "View transaction's receipt"
     * Used when a transaction's ref is clicked
     */
    public function vtr_(){
        $this->genlib->ajaxOnly();
        
        $ref = $this->input->post('ref');
        
        $transInfo = $this->transaction->getTransInfo($ref);
        
        //loop through the transInfo to get needed info
        if($transInfo){
            $json['status'] = 1;
            
            $cumAmount = $transInfo[0]['totalMoneySpent'];
            $amountTendered = $transInfo[0]['amountTendered'];
            $changeDue = $transInfo[0]['changeDue'];
            $transDate = $transInfo[0]['transDate'];
            $modeOfPayment = $transInfo[0]['modeOfPayment'];
            $cust_name = $transInfo[0]['cust_name'];
            $cust_phone = $transInfo[0]['cust_phone'];
            $cust_email = $transInfo[0]['cust_email'];
            $currency = $transInfo[0]['currency'];
            
            $json['transReceipt'] = $this->genTransReceipt($transInfo, $cumAmount, $amountTendered, $changeDue, $ref, 
                $transDate, $modeOfPayment,  $cust_name,
                $cust_phone, $cust_email,$currency);
        }
        
        else{
            $json['status'] = 0;
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    

    /*
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    */
    
    public function report($from_date, $to_date=''){        
        //get all transactions from db ranging from $from_date to $to_date
        $data['from'] = $from_date;
        $data['to'] = $to_date ? $to_date : date('Y-m-d');
        
        $data['allTransactions'] = $this->transaction->getDateRange($from_date, $to_date);
        
        $this->load->view('transactions/transReport', $data);
    }
    /*
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    ****************************************************************************************************************************
    */

    public function getCurrenciesForSelect(){
        $this->genlib->ajaxOnly();
    
        $orderBy = 'name'; // Order Currencies  by name
        $orderFormat = 'ASC';
    
        $this->load->model(['currency']); // Load the Currencies model
    
        // Call the getAll function from the Currency model to fetch Currencies 
        $currencies = $this->currency->getAll($orderBy, $orderFormat);
    
        if ($currencies !== FALSE) {
            $json['status'] = 1;
            $json['currencies'] = $currencies; // Return the list of Currencies 
        } else {
            $json['status'] = 0;
            $json['message'] = "No Currencies found.";
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    
    public function refundTransaction() {
        $this->genlib->ajaxOnly();
    
        $refundAmount = $this->input->post('refundAmount');
        $transactionIdString = $this->input->post('transactionId'); // Comma-separated string of transaction IDs
        log_message('error','this is the transId'.$transactionIdString);
        $transactionIds = explode(',', $transactionIdString); // Convert the string to an array
        log_message('error','we are here now');
    
        $successCount = 0; // Count of successfully refunded transactions
    
        foreach ($transactionIds as $transactionId) {
    
            $transaction = $this->transaction->getTrans($transactionId);
    
    
            if (!$transaction) {
                continue; // Move to the next transaction if not found
            }
    
            // Check if the transaction has already been refunded
            if (isset($transaction[0]['refundDate'])) {
                continue;                
            } 
    
            // Perform the refund process
            // Use the provided refundAmount instead of fetching from transaction
            $result = $this->transaction->updateRefundAmount($transactionId, $refundAmount);
    
            if ($result) {
                $successCount++;
    
                // Retrieve the transaction details to get the 'ref'
                $transactionDetails = $this->transaction->getTrans($transactionId);
                if ($transactionDetails) {
                    $transactionRef = $transactionDetails[0]['ref'];
    
                    // Add event log for the refund
                    $eventDesc = "Refund processed for transaction with ref: " . $transactionRef;
                    $this->genmod->addevent("Refund Processed", $transactionRef, $eventDesc, 'transactions', $this->session->admin_id);
                }
            }
    
            // Add student fees logic here
            if (isset($transaction[0]['student_id'])) {
                $studentId = $transaction[0]['student_id'];


                $this->load->model('student');

                $this->student->incrementStudent($studentId,$refundAmount);


                log_message('error', 'Student ID: ' . $studentId);
                log_message('error', 'Fee Amount: ' . $refundAmount);
            
    
                // Add your logic to update the student's fees with the refunded amount
                // For example:
                // $this->student_model->addFees($studentId, $feeAmount);
            }
        }
    
        $json['status'] = ($successCount > 0) ? 1 : 0;
        $json['message'] = ($successCount > 0) ? "Refunds processed successfully." : "No refunds processed.";
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    public function gsi(){
        $this->genlib->ajaxOnly();

        $staffStaff_id =  $this->input->post('sId', TRUE);

        if ($staffStaff_id) {
            $staff_info = $this->staff->getStaffInfo(['staff_id' => $staffStaff_id], ['name', 'surname', 'national_id',  'job_tittle', 'basic_salary', 'address', 'gender', 'email', 'phone', 'income_tax', 'overtime','healthy_insurance', 'department','staff_id']);
            if ($staff_info) {
                // Populate the JSON response with staff details
                $json = array(
                    'status' => 1,
                    'name' => $staff_info->name,
                    'surname' => $staff_info->surname,
                    'national_id' => $staff_info->national_id,
                    'job_tittle' => $staff_info->job_tittle,
                    'basic_salary' => $staff_info->basic_salary,
                    'address' => $staff_info->address,
                    'gender' => $staff_info->gender,
                    'email' => $staff_info->email,
                    'phone' => $staff_info->phone,
                    'income_tax' => $staff_info->income_tax,
                    'overtime' => $staff_info->overtime,
                    'healthy_insurance' => $staff_info->healthy_insurance,
                    'staff_id'=>$staff_info->staff_id,
                    'department'=>$staff_info->department
                );
            } else {
                $json['error'] = 'Staff information not found for the given staff Id.';
            }
        } else {
            $json['error'] = 'Staff Id parameter is missing or empty.';
        }
            
        $this->output->set_content_type('application/json')->set_output(json_encode($json));

    }
    

    
    
}
