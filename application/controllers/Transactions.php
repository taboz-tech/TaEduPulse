<?php
defined('BASEPATH') OR exit('');
require_once 'functions.php';
/**
 * Description of Transactions
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 31st Dec, 2022
 */
class Transactions extends CI_Controller{
    private $total_before_discount = 0, $discount_amount = 0, $vat_amount = 0, $eventual_total = 0;
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['transaction', 'student','currency']);
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function index(){
        $transData['students'] = $this->student->getActiveStudents('name', 'ASC');//get students with a fees credit when doing a new transaction
        // ge('error', 'Student data: ' . print_r($transData['students'], true));
        
        $data['pageContent'] = $this->load->view('transactions/transactions', $transData, TRUE);
        $data['pageTitle'] = "Transactions";
        
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
     * latr_ = "Load All Transactions"
     */
    public function latr_(){
        //set the sort order
       
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "transId";
        
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "DESC";
        
        //count the total number of transaction group (grouping by the ref) in db
        $totalTransactions = $this->transaction->totalTransactions();
        
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalTransactions, "transactions/latr_", $limit, ['onclick'=>'return latr_(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        // Get all transactions from the database
        
        $data['allTransactions'] = $this->transaction->getAll($orderBy, $orderFormat, $start, $limit);


        // Calculate and assign the 'range' value
        $data['range'] = $totalTransactions > 0 ? ($start+1) . "-" . ($start + count($data['allTransactions'])) . " of " . $totalTransactions : "";
        

        // Generate pagination links
        $data['links'] = $this->pagination->create_links();
        
        // Calculate and assign the 'sn' value
        $data['sn'] = $start + 1;
        
        $json['transTable'] = $this->load->view('transactions/transtable', $data, TRUE);
    
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
     * nso_ = "New Sales Order"
     */
    public function nso_(){
        $this->genlib->ajaxOnly();
        
        $arrOfStudentsDetails = json_decode($this->input->post('_aoi', TRUE));
        $_mop = $this->input->post('_mop', TRUE);//mode of payment
        $_at = round($this->input->post('_at', TRUE), 2);//amount tendered
        $_cd = $this->input->post('_cd', TRUE);//change due
        $cumAmount = $this->input->post('_ca', TRUE);//cumulative amount
        $cust_name = $this->input->post('cn', TRUE);
        $cust_phone = $this->input->post('cp', TRUE);
        $cust_email = $this->input->post('ce', TRUE);
        $description = $this->input->post('description', TRUE);
        $currency = $this->input->post('currency',TRUE);
        /*
         * Loop through the arrOfStudentsDetails and ensure each student's details has not been manipulated
         * The Fees Debt must match the student's fees owed in db, the total Amount must match the amount paid nothing added
         *
         * 
         */

        // Load the Currency model
        $this->load->model('currency');

        // Fetch all currencies' information
        $currencies = $this->currency->getAllCurrencies();

        
        $allIsWell = $this->validateStudentsDet($arrOfStudentsDetails, $cumAmount, $_at, $currencies);
        
        
        if($allIsWell){//insert each sales order into db, generate receipt and return info to client
            
            //will insert info into db and return transaction's receipt
            $returnedData = $this->insertTrToDb($arrOfStudentsDetails, $_mop, $_at, $cumAmount, $_cd, $cust_name, $cust_phone, $cust_email,$description,$currency);
                    
            $json['status'] = $returnedData ? 1 : 0;
            $json['msg'] = $returnedData ? "Transaction successfully processed" : 
                    "Unable to process your request at this time. Pls try again later "
                    . "or contact technical department for assistance";
            $json['transReceipt'] = $returnedData['transReceipt'];
            
            $json['totalEarnedToday'] = number_format($this->transaction->totalEarnedToday(), 2);

            //add into eventlog
            //function header: addevent($event, $eventRowIdOrRef, $eventDesc, $eventTable, $staffId) in 'genmod'
            $eventDesc = count($arrOfStudentsDetails). " fees totalling $". number_format($cumAmount, 2)
                    ." with reference number {$returnedData['transRef']} was paid";
            
            $this->genmod->addevent("New Transaction", $returnedData['transRef'], $eventDesc, 'transactions', $this->session->admin_id);
       }
        
        else{//return error msg
            $json['status'] = 0;
            $json['msg'] = "Transaction could not be processed. Please ensure there are no errors. Thanks";
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
     * Validates the details of students sent from client to prevent manipulation
     * @param type $arrOfStudentsInfo
     * @param type $cumAmountFromClient
     * @param type $amountTendered
     * @return boolean
     */


     private function validateStudentsDet($arrOfStudentsInfo, $cumAmountFromClient, $amountTendered) {
        $error = 0;
    
        foreach ($arrOfStudentsInfo as $get) {
            $studentStudent_id = $get->_sI;
            $feesToPay = $get->currentFees;
            $currencyRate = $get->currency; // Assuming rate is provided in the array
    
            // Calculate fees from the database using the currency rate
            $feesToPayInDb = $this->genmod->gettablecol('students', 'fees', 'student_id', $studentStudent_id) * $currencyRate;
    
            if (abs($feesToPayInDb - $feesToPay) > 0.001) { // Adding a small tolerance for floating-point precision
                $error++;
            }
    
            $expectedTotFees = $get->transAmount;
    
            if ($expectedTotFees != $get->totalFees) {
                $error++;
            }
    
            if ($error > 0) {
                return FALSE;
            }
    
            // Update any other relevant logic here
        }
    
        $expectedCumAmount = $cumAmountFromClient;
    
        if (($expectedCumAmount != $cumAmountFromClient) || ($expectedCumAmount > $amountTendered)) {
            return FALSE;
        }
    
        $this->eventual_total = $expectedCumAmount;
        return TRUE;
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
    private function insertTrToDb($arrOfStudentsDetails, $_mop, $_at, $cumAmount, $_cd, $cust_name, $cust_phone, $cust_email,$description,$currency){
        $allTransInfo = [];//to hold info of all students' in transaction
        
        //generate random string to use as transaction ref
        //keep regeneration the ref if generated ref exist in db
        do{
            $ref = strtoupper(generateRandomCode('numeric', 6, 10, ""));
        }
        
        while($this->transaction->isRefExist($ref));
        
		
        //loop through the students' details and insert them one by one
        //start transaction
        $this->db->trans_start();

        foreach ($arrOfStudentsDetails as $get) {
            try {
                $studentStudent_id = $get->_sI;
                $studentName = $this->genmod->getTableCol('students', 'name', 'student_id', $studentStudent_id);
                $studentSurname = $this->genmod->getTableCol('students', 'surname', 'student_id', $studentStudent_id);
                $studentClass_name = $this->genmod->getTableCol('students', 'class_name', 'student_id', $studentStudent_id);
                $transAmount = $get->transAmount; // money being paid for a student in loop
                $currentFees = $get->currentFees; // current fees of student in loop
                $totalFees = $get->totalFees; // total fees for student in loop
                $transType = 1;
                $paymentStatus = 1;
                $term = $get->term;
                
                /*
                 * add transaction to db
                 * function header: add($ref, $studentName, $studentSurname, $studentClass_name, $studentStudent_id, $description, $totalFees, $cumAmount, $_at, $_cd, $_mop, $cust_name, $cust_phone, $cust_email, $transType, $paymentStatus, $term)
                 */
                $transId = $this->transaction->add($ref, $studentName, $studentSurname, $studentClass_name, $studentStudent_id, $description, $totalFees, $cumAmount, $_at, $_cd, $_mop, $cust_name, $cust_phone, $cust_email, $transType, $paymentStatus, $term,$currency);
                
                $allTransInfo[$transId] = ['studentName' => $studentName, 'studentSurname' => $studentSurname, 'transAmount' => $transAmount, 'totalAmount' => $totalFees, 'term' => $term,'currency'=>$currency];
                
                // Load the Currency model
                $this->load->model('currency');

                // Fetch all currencies' information
                $currencies = $this->currency->getAllCurrencies();

                // update student fees owed in db by removing the transAmount
                // function header: decrementStudent($studentStudent_id, $amountToRemove)
                $this->student->decrementStudent($studentStudent_id, $transAmount, $currencies,$currency);
                                
            } catch (Exception $e) {
                
                // You might also want to handle the exception appropriately based on your application's needs.
            }
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
        $transactionIds = explode(',', $transactionIdString); // Convert the string to an array
    
        $successCount = 0; // Count of successfully refunded transactions
    
        foreach ($transactionIds as $transactionId) {
            $transaction = $this->transaction->getTrans($transactionId);
    
            if (!$transaction) {
                continue; // Move to the next transaction if not found
            }
    
            // Get the transaction currency
            $transactionCurrency = $transaction[0]['currency'];
    
            // Query the currencies table to get the exchange rate for the transaction currency
            $currencyInfo = $this->currency->getCurrencieInfo(array('name' => $transactionCurrency), array('rate'));
    
            if ($currencyInfo) {
                $exchangeRate = $currencyInfo->rate;
    
                // Calculate the refund amount in USD
                $refundAmountUSD = $refundAmount / $exchangeRate;
            } else {
                // Handle the case where the currency information is not found
                $refundAmountUSD = $refundAmount;
            }
    
            // Perform the refund process using $refundAmountUSD
            $result = $this->transaction->updateRefundAmount($transactionId, $refundAmountUSD);
    
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
    
                $this->student->incrementStudent($studentId, $refundAmountUSD);
            }
        }
    
        $json['status'] = ($successCount > 0) ? 1 : 0;
        $json['message'] = ($successCount > 0) ? "Refunds processed successfully." : "No refunds processed.";
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    public function RefundAmount() {
        $this->genlib->ajaxOnly();
    
        $transId = $this->input->post('transactionId', TRUE);
    
        $json = array();
    
        if (!empty($transId)) {
            $refundAmount = $this->transaction->getRefundAmount($transId);
    
            if ($refundAmount !== false) {
                // Check if refundAmount is null and set it to zero if needed
                if ($refundAmount === null) {
                    $refundAmount = 0;
                }
    
                $json['status'] = 1;
                $json['refundAmount'] = $refundAmount;
            } else {
                $json['status'] = 0;
            }
        } else {
            $json['status'] = -1;
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    
}
