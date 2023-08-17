<?php

defined('BASEPATH') OR exit('');

/**
 * Description of Transaction
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 9th August0., 2023
 */
class Transaction extends CI_Model {

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
    public function getAll($orderBy, $orderFormat, $start, $limit) {
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT transactions.ref, transactions.totalMoneySpent, transactions.modeOfPayment, transactions.staffId,
                transactions.transDate, transactions.lastUpdated, transactions.amountTendered, transactions.changeDue,
                admin.first_name || ' ' || admin.last_name AS 'staffName',
                transactions.cust_name, transactions.cust_phone, transactions.cust_email, transactions.cancelled,transactions.studentName,transactions.studentSurname
                FROM transactions
                LEFT OUTER JOIN admin ON transactions.staffId = admin.id
                GROUP BY ref
                ORDER BY {$orderBy} {$orderFormat}
                LIMIT {$limit} OFFSET {$start}";

            $run_q = $this->db->query($q);
        }
        else {
            $this->db->select('GROUP_CONCAT(DISTINCT transId) AS transId, transactions.ref');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.totalMoneySpent) AS totalMoneySpent');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.modeOfPayment) AS modeOfPayment');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.staffId) AS staffId');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.transDate) AS transDate');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.lastUpdated) AS lastUpdated');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.amountTendered) AS amountTendered');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.cancelled) AS cancelled');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.changeDue) AS changeDue');
            $this->db->select('CONCAT_WS(" ", GROUP_CONCAT(DISTINCT admin.first_name), GROUP_CONCAT(DISTINCT admin.last_name)) as "staffName"');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.cust_name) AS cust_name');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.cust_phone) AS cust_phone');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.cust_email) AS cust_email');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.studentName) AS studentName');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.studentSurname) AS studentSurname');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.totalAmount) AS totalAmount');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.description) AS description');
            
            
            // Additional fields for studentName and studentSurname
    
            $this->db->join('admin', 'transactions.staffId = admin.id', 'LEFT');
            $this->db->limit($limit, $start);
            $this->db->group_by('ref');
            $this->db->order_by($orderBy, $orderFormat);
    
            $run_q = $this->db->get('transactions');
        }
    
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
     * 
     * @param string $studentName student Name
     * @param string $studentStudent_id student studentId
     * @param string $description Description
     * @param string $studentSurname student Surname
     * @param int $studentClass_name student Class_name
     * @param float $totalFees total fees
     * @param float $_at amount tendered
     * @param float $_cd change due
     * @param string $_mop mode of payment
     * @param int $_tt transaction type whether (sale{1} or return{2})
     * @param string $ref
     * @param float $cumAmount cummulative amount
     * @param int $paymentStatus payment status 
     * @param string $term month paid for
     * @param string $cn Customer Name
     * @param string $cp Customer Phone
     * @param string $ce Customer Email
     * @return boolean
     */
    public function add($ref,$studentName, $studentSurname,$studentClass_name,$studentStudent_id,$description, $totalFees, $cumAmount, $_at, $_cd,$_mop, $cust_name, $cust_phone,  $cust_email, $transType,$paymentStatus,$term) {
        $data = ['studentName' => $studentName, 'student_id' => $studentStudent_id, 'studentSurname' => $studentSurname, 'studentClass_name' => $studentClass_name, 'description' => $description, 'totalAmount' => $totalFees,
            'amountTendered' => $_at, 'changeDue' => $_cd, 'modeOfPayment' => $_mop, 'transType' => $transType,
            'staffId' => $this->session->admin_id, 'totalMoneySpent' => $cumAmount, 'ref' => $ref, 'cust_name'=>$cust_name,'paymentStatus'=>$paymentStatus,'term'=>$term, 'cust_phone'=>$cust_phone,
            'cust_email'=>$cust_email];

        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" ?
            $this->db->set('transDate', "datetime('now')", FALSE) :
            $this->db->set('transDate', "NOW()", FALSE);

        $this->db->insert('transactions', $data);

        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
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
     * Primarily used to check whether a particular transaction reference exists in db
     * @param type $ref
     * @return boolean
     */
    public function isRefExist($ref) {
        $q = "SELECT DISTINCT ref FROM transactions WHERE ref = ?";

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

    public function transSearch($value) {
        $this->db->select('GROUP_CONCAT(DISTINCT transId) AS transId, transactions.ref');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.totalMoneySpent) AS totalMoneySpent');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.modeOfPayment) AS modeOfPayment');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.staffId) AS staffId');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.transDate) AS transDate');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.lastUpdated) AS lastUpdated');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.amountTendered) AS amountTendered');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.cancelled) AS cancelled');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.changeDue) AS changeDue');
        $this->db->select('CONCAT_WS(" ", GROUP_CONCAT(DISTINCT admin.first_name), GROUP_CONCAT(DISTINCT admin.last_name)) as "staffName"');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.cust_name) AS cust_name');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.cust_phone) AS cust_phone');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.cust_email) AS cust_email');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.studentName) AS studentName');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.studentSurname) AS studentSurname');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.totalAmount) AS totalAmount');
        $this->db->select('GROUP_CONCAT(DISTINCT transactions.description) AS description');
    
        $this->db->join('admin', 'transactions.staffId = admin.id', 'LEFT');
        $this->db->like('transactions.ref', $value);
        $this->db->or_like('transactions.studentName', $value);
        $this->db->or_like('transactions.studentSurname', $value);
        $this->db->group_by('ref');

        $run_q = $this->db->get('transactions');

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
     * Get all transactions with a particular ref
     * @param type $ref
     * @return boolean
     */
    public function gettransinfo($ref) {
        $q = "SELECT * FROM transactions WHERE ref = ?";

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
     * selects the total number of transactions done so far
     * @return boolean
     */
    public function totalTransactions() {
        $q = "SELECT count(DISTINCT REF) as 'totalTrans' FROM transactions";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalTrans;
            }
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
     * Calculates the total amount earned today
     * @return boolean
     */
    public function totalEarnedToday() {
        $q = "SELECT GROUP_CONCAT(DISTINCT totalMoneySpent) AS totalMoneySpent FROM transactions WHERE DATE(transDate) = CURRENT_DATE GROUP BY ref";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows()) {
            $totalEarnedToday = 0;

            foreach ($run_q->result() as $get) {
                $totalEarnedToday += $get->totalMoneySpent;
            }

            return $totalEarnedToday;
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

    //Not in use yet
    public function totalEarnedOnDay($date) {
        $q = "SELECT SUM(totalPrice) as 'totalEarnedToday' FROM transactions WHERE DATE(transDate) = {$date}";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalEarnedToday;
            }
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
    
    public function getDateRange($from_date, $to_date){
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT transactions.ref, transactions.totalMoneySpent, transactions.modeOfPayment, transactions.staffId,
                transactions.transDate, transactions.lastUpdated, transactions.amountTendered, transactions.changeDue,
                admin.first_name || ' ' || admin.last_name AS 'staffName', SUM(transactions.quantity) AS 'quantity',
                transactions.cust_name, transactions.cust_phone, transactions.cust_email
                FROM transactions
                LEFT OUTER JOIN admin ON transactions.staffId = admin.id
                WHERE 
                date(transactions.transDate) >= {$from_date} AND date(transactions.transDate) <= {$to_date}
                GROUP BY ref
                ORDER BY transactions.transId DESC";

            $run_q = $this->db->query($q);
        }
        
        else {
            $this->db->select('transactions.ref, transactions.totalMoneySpent, transactions.modeOfPayment, transactions.staffId,
                    transactions.transDate, transactions.lastUpdated, transactions.amountTendered, transactions.changeDue,
                    CONCAT_WS(" ", admin.first_name, admin.last_name) AS "staffName",
                    transactions.cust_name, transactions.cust_phone, transactions.cust_email');

            $this->db->select_sum('transactions.quantity');

            $this->db->join('admin', 'transactions.staffId = admin.id', 'LEFT');

            $this->db->where("DATE(transactions.transDate) >= ", $from_date);
            $this->db->where("DATE(transactions.transDate) <= ", $to_date);

            $this->db->order_by('transactions.transId', 'DESC');

            $this->db->group_by('ref');

            $run_q = $this->db->get('transactions');
        }
        
        return $run_q->num_rows() ? $run_q->result() : FALSE;
    }
}
