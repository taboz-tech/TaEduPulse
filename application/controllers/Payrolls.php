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
       
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "dateAdded";
        
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

        $staffStaff_id =  $this->input->post('staffStaff_id', TRUE);
        $staffName =  $this->input->post('staffName', TRUE);
        $staffSurname =  $this->input->post('staffSurname', TRUE);
        $staffDepartment =  $this->input->post('staffDepartment', TRUE);
        $staffNational_id =  $this->input->post('staffNational_id', TRUE);
        $staffJob_tittle =  $this->input->post('staffJob_tittle', TRUE);
        $staffSalary =  $this->input->post('staffSalary', TRUE);
        $staffIncome_tax =  $this->input->post('staffIncome_tax', TRUE);
        $staffOvertime =  $this->input->post('staffOvertime', TRUE);
        $staffHealthy_insurance =  $this->input->post('staffHealthy_insurance', TRUE);
        $currentMonth =  $this->input->post('currentMonth', TRUE);
        
        
        $allIsWell = $this->validateStaffsDet($staffStaff_id,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth);
        $response = json_decode($allIsWell, True);

        if ($response['status'] === 1){//insert each payroll into db, generate payslip and return info to client

            //will insert info into db and return payslip
            $returnedData = $this->insertTrToDb($staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth);
            
            $json['status'] = $returnedData ? 1 : 0;
            $json['msg'] = $returnedData ? "Payroll successfully processed" : 
                    "Unable to process your request at this time. Pls try again later "
                    . "or contact technical department for assistance";
            $json['payrollPayslip'] = $returnedData['payrollPayslip'];

            //add into eventlog
            //function header: addevent($event, $eventRowIdOrRef, $eventDesc, $eventTable, $staffId) in 'genmod'
            $eventDesc = "{$staffName} {$staffSurname} (Staff ID: {$staffStaff_id}) in the {$staffDepartment} department received a payroll of $".number_format($staffSalary, 2)." for {$currentMonth}. Deductions include $".number_format($staffIncome_tax, 2)." for income tax and $".number_format($staffHealthy_insurance, 2)." for health insurance.";

            
            $this->genmod->addevent("New Payroll", $returnedData['payslipRef'], $eventDesc, 'payrolls', $this->session->admin_id);
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

    private function insertTrToDb($staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth){
        $allPayrollInfo = [];//to hold info of all students' in transaction

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
        $status = 0;
        
        //start transaction
        $this->db->trans_start();

        try {
            
            
            /*
            * add transaction to db
            * function header: add($ref,$staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth,$staffAddress,$staffEmail,$staffPhone,$paymentMethod)
            */
            $payrollId = $this->payroll->add($ref,$staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth,$staffAddress,$staffEmail,$staffPhone,$paymentMethod,$status);
            $pto_balance = $this->genmod->getTableCol('payrolls', 'pto_balance', 'ref', $ref);
            $other_allowances = $this->genmod->getTableCol('payrolls', 'other_allowances','ref',$ref);
            $pto_name = "Paid Time Off";
            $other_allowances_name = "Allowances";
            $income_Tax_name = "Income Tax";
            $staffHealthy_insurance_name = "Health Insurance";
            $basic_salary_name = "Basic Salary";

            // Create separate arrays for earnings
            $pto_earnings = ['name' => $pto_name, 'amount' => $pto_balance];
            $other_allowances_earnings = ['name' => $other_allowances_name, 'amount' => $other_allowances];
            $basic_salary = ['name' =>$basic_salary_name, 'amount' => $staffSalary ];

            // Assign these arrays to the "earnings" key in $allPayrollInfo
            $allPayrollInfo['earnings'] = [$pto_earnings, $other_allowances_earnings,$basic_salary];

            // Create separate arrays for deductions
            $income_tax_deduction = ['name' => $income_Tax_name, 'amount' => $staffIncome_tax];
            $health_insurance_deduction = ['name' => $staffHealthy_insurance_name, 'amount' => $staffHealthy_insurance];

            // Assign these arrays to the "deductions" key in $allPayrollInfo
            $allPayrollInfo['deductions'] = [$income_tax_deduction, $health_insurance_deduction];


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
            
            //get Payroll date in db, to be used on the Payslip. It is necessary since date and time must matc
            $tax_identification_number = $this->genmod->getTableCol('payrolls', 'tax_identification_number', 'id', $payrollId);
            
            //generate Payslip to return
            $dataToReturn['payrollPayslip'] = $this->genPayrollPayslip($allPayrollInfo,$currentMonth,$ref,$staffName,$staffSurname,$staffStaff_id,$staffAddress,$staffIncome_tax,$staffEmail,$tax_identification_number,$staffPhone);

            $dataToReturn['payslipRef'] = $ref;
            
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

    private function genPayrollPayslip($allPayrollInfo,$currentMonth,$ref,$staffName,$staffSurname,$staffStaff_id,$staffAddress,$staffIncome_tax,$staffEmail,$tax_identification_number,$staffPhone){
        $data['allPayrollInfo'] = $allPayrollInfo;
        $data['currentMonth'] = $currentMonth;
        $data['staffName'] = $staffName;
        $data['staffSurname'] = $staffSurname;
        $data['ref'] = $ref;
        $data['staffPhone'] = $staffPhone;
        $data['staffStaff_id'] = $staffStaff_id;
        $data['staffAddress'] = $staffAddress;
        $data['staffIncome_tax'] = $staffIncome_tax;
        $data['staffEmail'] = $staffEmail;
        $data['tax_identification_number'] = $tax_identification_number;
        //generate and return payslip
        $payrollPayslip = $this->load->view('payrolls/payslip', $data, TRUE);
        return $payrollPayslip;
    }


    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
     * vpp_ = "View Payroll Payslip"
     * Used when a payslip ref is clicked
     */
    public function vpp_(){
        $this->genlib->ajaxOnly();
        
        $ref = $this->input->post('ref');
        
        $payrollInfo = $this->payroll->getPayrollInfo($ref);
        // Log the payrollInfo using print_r or var_dump

        
        //loop through the payrollInfo to get needed info
        if($payrollInfo){

            $json['status'] = 1;
            
            $currentMonth = $payrollInfo[0]['payment_month'];
            $ref = $payrollInfo[0]['ref'];
            $staffName = $payrollInfo[0]['staff_name'];
            $staffSurname = $payrollInfo[0]['staff_surname'];
            $staffStaff_id = $payrollInfo[0]['staff_id'];
            $staffAddress = $payrollInfo[0]['staff_address'];
            $staffIncome_tax = $payrollInfo[0]['tax_withholding'];
            $staffEmail = $payrollInfo[0]['staff_email'];
            $tax_identification_number = $payrollInfo[0]['tax_identification_number'];
            $staffPhone = $payrollInfo[0]['staff_phone'];
            $pto_balance = $payrollInfo[0]['pto_balance'];
            $other_allowances = $payrollInfo[0]['other_allowances'];
            $tax_withholding = $payrollInfo[0]['tax_withholding'];
            $health_insurance = $payrollInfo[0]['health_insurance'];
            $basic_salary = $payrollInfo[0]['gross_salary'];

            // Create separate arrays for earnings and deductions
            $earnings = [
                ['name' => 'PTO Earnings', 'amount' => $pto_balance],
                ['name' => 'Allowances', 'amount' => $other_allowances],
                ['name' => 'Basic Salary', 'amount' => $basic_salary]
            ];

            $deductions = [
                ['name' => 'Income Tax ', 'amount' => $tax_withholding],
                ['name' => 'Health Insurance', 'amount' => $health_insurance]
            ];

            // Assign the earnings and deductions arrays to the "earnings" and "deductions" keys in $allPayrollInfo
            $allPayrollInfo['earnings'] = $earnings;
            $allPayrollInfo['deductions'] = $deductions;
            
            $json['payrollPayslip'] = $this->genPayrollPayslip($allPayrollInfo,$currentMonth,$ref,$staffName,$staffSurname,$staffStaff_id,$staffAddress,$staffIncome_tax,$staffEmail,$tax_identification_number,$staffPhone);
        }
        
        else{
            $json['status'] = 0;
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    

    public function payPayroll() {
        $this->genlib->ajaxOnly();
    
        // Initialize JSON response with a status of 0
        $json['status'] = 0;
    
        try {
            // Get the payroll ID from POST data
            $payrollId = $this->input->post('i', TRUE);
            $ref = $this->genmod->getTableCol('payrolls', 'ref', 'id', $payrollId);
    
            if (!$ref) {
                throw new Exception("Payroll not found");
            }
    
            $payrollInfo = $this->payroll->getPayrollInfo($ref);
    
            if (!$payrollInfo) {
                throw new Exception("Payroll info not found");
            }
    
            $gross_salary = $payrollInfo[0]['gross_salary'];
            $payment_month = $payrollInfo[0]['payment_month'];
            $costColumnName = 'Salary_' . $payment_month;
    
            $costId = $this->genmod->getTableCol('costs', 'id', 'name', $costColumnName);
            $costBalance = $this->genmod->getTableCol('costs', 'balance', 'name', $costColumnName);
            $costPaid = $this->genmod->getTableCol('costs', 'paid', 'name', $costColumnName);

            $newCostBalance = $costBalance - $gross_salary;
            $newCostPaid = $costPaid + $gross_salary;
            $status = 1;
    
            // Check if the payroll has already been paid
            if ($payrollInfo[0]['status'] == 1) {
                throw new Exception("Payroll has already been paid");
            }
    
            // Check if the gross_salary is greater than zero
            if ($gross_salary <= 0) {
                throw new Exception("Invalid gross salary amount");
            }
    
            // Check if the gross_salary is greater than the balance
            if ($gross_salary > $costBalance) {
                throw new Exception("Cannot pay for this month's salary. Salary exceeds the available balance.");
            }
    
            // Update the cost record with new balances
            $this->genmod->updateTableCol('costs', 'balance', $newCostBalance, 'id', $costId);
            $this->genmod->updateTableCol('costs', 'paid', $newCostPaid, 'id', $costId);
    
            // Update the payroll status
            $this->genmod->updateTableCol('payrolls', 'status', $status, 'id', $payrollId);
    
            // Set the JSON response status to 1 for success
            $json['status'] = 1;
        } catch (Exception $e) {
            // Log the error and set status to 0
            log_message('error', $e->getMessage());
            $json['status'] = 0;
            $json['error_message'] = $e->getMessage(); // Include the error message in the JSON response
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
}
