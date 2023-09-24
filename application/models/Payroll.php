<?php

defined('BASEPATH') OR exit('');

/**
 * Description of Payroll
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 11th September, 2023
 */
class Payroll extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

     public function getAll($orderBy, $orderFormat, $start=0, $limit=''){
        try {
            $this->db->select('payrolls.*, CONCAT(admin.first_name, " ", admin.last_name) as personnel_name', false);
            // Calculate deductions (you can adjust the formula as needed)pto_balance
            $this->db->select('(payrolls.tax_withholding + payrolls.health_insurance + payrolls.advance_payment ) as deductions', false);
            $this->db->select('(payrolls.pto_balance + payrolls.other_allowances) as bonuses', false);
            $this->db->from('payrolls');
            $this->db->join('admin', 'payrolls.personnelId = admin.id', 'left');
            $this->db->limit($limit, $start);
            $this->db->order_by($orderBy, $orderFormat);
            
            $run_q = $this->db->get();
    
            if ($run_q !== false) {
                if ($run_q->num_rows() > 0) {
                    return $run_q->result();
                } else {
                    return array(); // Return an empty array if no records found
                }
            } else {
                log_message('error', 'Database error: ' . $this->db->error());
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * 
     * @param string $staff_name
     * @param string $staff_surname
     * @param string $staff_address
     * @param string $staff_email
     * @param string $staff_phone
     * @param string $staff_id
     * @param date $payroll_start_date
     * @param date $payroll_end_date
     * @param string $payment_method
     * @param string $ref
     * @param date $payment_month
     * @param int $status 
     * @param decimal $gross_salary
     * @param decimal $net_salary
     * @return boolean
     */
    public function add($ref,$staffName,$staffSurname,$staffStaff_id,$staffDepartment,$staffNational_id,$staffJob_tittle,$staffSalary,$staffIncome_tax,$staffOvertime,$staffHealthy_insurance,$currentMonth,$staffAddress,$staffEmail,$staffPhone,$paymentMethod,$status,$staffAdvancePayment) {
        try {
            // Convert the month in words to a numeric value (1 to 12)
            $monthNumeric = date('n', strtotime($currentMonth . ' 1'));
    
            // Get the first day of the current month
            $currentMonthStart = date('Y-m-01', strtotime(date('Y') . '-' . $monthNumeric . '-01'));
    
            // Get the last day of the current month
            $currentMonthEnd = date('Y-m-t', strtotime(date('Y') . '-' . $monthNumeric . '-01'));
            $gross_salary = $staffSalary + $staffOvertime;
            $net_salary = $staffSalary;
            $data = [
                'staff_name' => $staffName,
                'staff_surname' => $staffSurname,
                'staff_address' => $staffAddress,
                'staff_email' => $staffEmail,
                'staff_phone' => $staffPhone,
                'staff_id' => $staffStaff_id,
                'personnelId' => $this->session->admin_id,
                'tax_withholding' => $staffIncome_tax,
                'staff_department' => $staffDepartment,
                'health_insurance' => $staffHealthy_insurance,
                'ref' => $ref,
                'status' => $status,
                'gross_salary' => $gross_salary,
                'net_salary' => $net_salary,
                'payment_method' => $paymentMethod,
                'payment_month' => $currentMonth,
                'staff_job_tittle' => $staffJob_tittle,
                'staff_national_id' => $staffNational_id,
                'payroll_start_date' => $currentMonthStart, 
                'payroll_end_date' => $currentMonthEnd, 
                'advance_payment' => $staffAdvancePayment,
                'other_allowances'=> $staffOvertime
            ];
                
            //set the datetime based on the db driver in use
            $this->db->platform() == "sqlite3" ?
                $this->db->set('dateAdded', "datetime('now')", FALSE) :
                $this->db->set('dateAdded', "NOW()", FALSE);

            
            $this->db->insert('payrolls', $data);


            if ($this->db->affected_rows()) {
                return $this->db->insert_id();
            }
            else {
                return FALSE;
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * Primarily used to check whether a particular payroll reference exists in db
     * @param type $ref
     * @return boolean
     */
    public function isRefExist($ref) {
        $q = "SELECT DISTINCT ref FROM payrolls WHERE ref = ?";

        $run_q = $this->db->query($q, [$ref]);

        if ($run_q->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */
    public function payslipSearch($value) {
        try {
           
            $this->db->select('*, CONCAT(admin.first_name, " ", admin.last_name) as personnel_name');
            $this->db->select('(tax_withholding + health_insurance) as deductions', FALSE);
            $this->db->select('(pto_balance + other_allowances) as bonuses', FALSE);
            $this->db->from('payrolls');
            $this->db->join('admin', 'payrolls.personnelId = admin.id', 'left');
    
            // Add your search conditions here for 'surname' and 'ref'
            if (!empty($value)) {
                $this->db->group_start();
                $this->db->like('staff_surname', $value, 'after'); // Use 'after' to search for values starting with the letter
                $this->db->or_like('staff_name', $value, 'after');
                $this->db->or_like('ref', $value, 'after');
                $this->db->group_end();
            }
              
    
            $query = $this->db->get();
    
            
            if ($query === false) {
                // Handle the database error here
                throw new Exception('Database query failed.');
            }
    
            return $query->result();
        } catch (Exception $e) {
            // Log the error and return an empty result or handle it as needed
            log_message('error', 'Database error: ' . $e->getMessage());
            return array();
        }
    }
    
    
    
    

    

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * Get all Payrolls with a particular ref
     * @param type $ref
     * @return boolean
     */
    public function getPayrollInfo($ref) {
        $q = "SELECT * FROM payrolls WHERE ref = ?";

        $run_q = $this->db->query($q, [$ref]);

        if ($run_q->num_rows() > 0) {
            return $run_q->result_array();
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * Get all Payrolls with a particular Id
     * @param type $ref
     * @return boolean
     */
    public function getPayroll($Id) {
        $q = "SELECT * FROM payrolls WHERE id = ?";

        $run_q = $this->db->query($q, [$Id]);

        if ($run_q->num_rows() > 0) {
            return $run_q->result_array();
        }
        else {
            return FALSE;
        }
    }

    /**
     * selects the total number of payrolls done so far
     * @return boolean
     */
    public function totalPayrolls() {
        $q = "SELECT count(DISTINCT REF) as 'totalPayrolls' FROM payrolls";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalPayrolls;
            }
        }
        else {
            return FALSE;
        }
    }

   

    

}
