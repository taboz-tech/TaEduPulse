<?php

defined('BASEPATH') OR exit('');

/**
 * Description of Transaction
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 9th August0., 2023
 */
class Payslip extends CI_Model {

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

    /**
     * Get all transactions
     * @param type $orderBy
     * @param type $orderFormat
     * @param type $start
     * @param type $limit
     * @return boolean
     */
    public function getAllPayslips($orderBy, $orderFormat, $start, $limit) {
        $this->db->select('payslips.id, payslips.employee_name, payslips.employee_department, payslips.employee_position, payslips.pay_period_start, payslips.pay_period_end, payslips.pay_date, payslips.basic_salary, payslips.overtime, payslips.bonuses, payslips.allowances, payslips.gross_earnings, payslips.net_salary, payslips.leave_balances, payslips.loan_repayments');
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);
    
        $run_q = $this->db->get('payslips');
    
        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
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
     * Add a new payslip entry to the database.
     *
     * @param string $employeeName Employee Name
     * @param string $employeeDepartment Employee Department
     * @param string $employeePosition Employee Position
     * @param string $pay_period_start Pay Period Start Date
     * @param string $pay_period_end Pay Period End Date
     * @param string $pay_date Pay Date
     * @param float $basic_salary Basic Salary
     * @param float $overtime Overtime
     * @param float $bonuses Bonuses
     * @param float $allowances Allowances
     * @param float $gross_earnings Gross Earnings
     * @param float $net_salary Net Salary
     * @param float $leave_balances Leave Balances
     * @param float $loan_repayments Loan Repayments
     * @return boolean|int Returns the inserted ID on success, or FALSE on failure.
     */
    public function addPayslip($employeeName, $employeeDepartment, $employeePosition, $pay_period_start, $pay_period_end, $pay_date, $basic_salary, $overtime, $bonuses, $allowances, $gross_earnings, $net_salary, $leave_balances, $loan_repayments) {
        $data = [
            'employee_name' => $employeeName,
            'employee_department' => $employeeDepartment,
            'employee_position' => $employeePosition,
            'pay_period_start' => $pay_period_start,
            'pay_period_end' => $pay_period_end,
            'pay_date' => $pay_date,
            'basic_salary' => $basic_salary,
            'overtime' => $overtime,
            'bonuses' => $bonuses,
            'allowances' => $allowances,
            'gross_earnings' => $gross_earnings,
            'net_salary' => $net_salary,
            'leave_balances' => $leave_balances,
            'loan_repayments' => $loan_repayments
        ];

        $this->db->insert('payslips', $data);

        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    /**
     * Check whether a particular payslip reference exists in the database.
     *
     * @param string $id Payslip reference to check
     * @return boolean TRUE if the reference exists, FALSE otherwise
     */
    public function isPayslipRefExist($id) {
        $q = "SELECT DISTINCT id FROM payslips WHERE id = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * Search for payslip data based on a search value.
     *
     * @param string $value The search value
     * @return array|boolean Returns an array of search results or FALSE if no results are found
     */
    public function payslipSearch($value) {
        $this->db->select('payslips.id, payslips.employee_name, payslips.employee_department, payslips.employee_position, payslips.pay_period_start, payslips.pay_period_end, payslips.pay_date, payslips.basic_salary, payslips.overtime, payslips.bonuses, payslips.allowances, payslips.gross_earnings, payslips.net_salary, payslips.leave_balances, payslips.loan_repayments');
        $this->db->like('payslips.employee_name', $value);
        $this->db->or_like('payslips.employee_department', $value);
        $this->db->or_like('payslips.employee_position', $value);
        // Add similar or_like conditions for other relevant columns

        $run_q = $this->db->get('payslips');

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }


    

    /**
     * Get all payslip information with a particular reference.
     *
     * @param string $ref The reference to retrieve payslip information for
     * @return array|boolean Returns an array of payslip information or FALSE if no results are found
     */
    public function getPayslipInfo($id) {
        $q = "SELECT * FROM payslips WHERE id = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
            return $run_q->result_array();
        } else {
            return FALSE;
        }
    }


    /**
     * Get the total number of distinct references in the payslip table.
     *
     * @return int|boolean Returns the total number of distinct references or FALSE if no results are found
     */
    public function totalPayslipReferences() {
        $q = "SELECT COUNT(DISTINCT id) as 'totalids' FROM payslips";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            $result = $run_q->row();
            return $result->totalRefs;
        } else {
            return FALSE;
        }
    }


    


    /**
     * Get payslip information with a particular ID.
     *
     * @param int $id The ID of the payslip to retrieve information for
     * @return array|boolean Returns an array of payslip information or FALSE if no results are found
     */
    public function getPayslip($id) {
        $q = "SELECT * FROM payslips WHERE id = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
            return $run_q->result_array();
        } else {
            return FALSE;
        }
    }


    


}
