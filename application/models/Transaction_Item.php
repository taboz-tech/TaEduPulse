<?php

defined('BASEPATH') OR exit('');

/**
 * Description of Transaction
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 8th Jan., 2023
 */
class Transaction_Item extends CI_Model {

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
            $q = "SELECT transactions_item.ref, transactions_item.totalMoneySpent, transactions_item.modeOfPayment, transactions_item.staffId,
                transactions_item.transDate, transactions_item.lastUpdated, transactions_item.amountTendered, transactions_item.changeDue,
                admin.first_name || ' ' || admin.last_name AS 'staffName', SUM(transactions_item.quantity) AS 'quantity',
                transactions_item.cust_name, transactions_item.cust_phone, transactions_item.cust_email, transactions_item.cancelled
                FROM transactions_item
                LEFT OUTER JOIN admin ON transactions_item.staffId = admin.id
                GROUP BY ref
                ORDER BY {$orderBy} {$orderFormat}
                LIMIT {$limit} OFFSET {$start}";

            $run_q = $this->db->query($q);
        }
        else {
            $this->db->select('GROUP_CONCAT(DISTINCT transId) AS transId, GROUP_CONCAT(DISTINCT totalPrice) AS totalPrice, transactions_item.ref, GROUP_CONCAT(DISTINCT transactions_item.totalMoneySpent) AS totalMoneySpent, 
                GROUP_CONCAT(DISTINCT transactions_item.modeOfPayment) AS modeOfPayment, GROUP_CONCAT(DISTINCT transactions_item.staffId) AS staffId, GROUP_CONCAT(DISTINCT transactions_item.transDate) AS transDate, 
                GROUP_CONCAT(DISTINCT transactions_item.lastUpdated) AS lastUpdated, GROUP_CONCAT(DISTINCT transactions_item.amountTendered) AS amountTendered, GROUP_CONCAT(DISTINCT transactions_item.cancelled) AS cancelled,
                GROUP_CONCAT(DISTINCT transactions_item.changeDue) AS changeDue, CONCAT_WS(" ", GROUP_CONCAT(DISTINCT admin.first_name), GROUP_CONCAT(DISTINCT admin.last_name)) as "staffName",
                GROUP_CONCAT(DISTINCT transactions_item.cust_name) AS cust_name, GROUP_CONCAT(DISTINCT transactions_item.cust_phone) AS cust_phone, GROUP_CONCAT(DISTINCT transactions_item.cust_email) AS cust_email');
            
            $this->db->select_sum('transactions_item.quantity');
            
            $this->db->join('admin', 'transactions_item.staffId = admin.id', 'LEFT');
            $this->db->limit($limit, $start);
            $this->db->group_by('ref');
            $this->db->order_by($orderBy, $orderFormat);

            $run_q = $this->db->get('transactions_item');
        }

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
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
     * 
     * @param type $_iN item Name
     * @param type $_iC item Code
     * @param type $desc Desc
     * @param type $q quantity bought
     * @param type $_up unit price
     * @param type $_tp total price
     * @param type $_tas total amount spent
     * @param type $_at amount tendered
     * @param type $_cd change due
     * @param type $_mop mode of payment
     * @param type $_tt transaction type whether (sale{1} or return{2})
     * @param type $ref
     * @param float $_va VAT Amount
     * @param float $_vp VAT Percentage
     * @param float $da Discount Amount
     * @param float $dp Discount Percentage
     * @param {string} $cn Customer Name
     * @param {string} $cp Customer Phone
     * @param {string} $ce Customer Email
     * @return boolean
     */
    public function add($_iN, $_iC, $desc, $q, $_up, $_tp, $_tas, $_at, $_cd, $_mop, $_tt, $ref, $_va, $_vp, $da, $dp, $cn, $cp, $ce) {
        $data = ['itemName' => $_iN, 'itemCode' => $_iC, 'description' => $desc, 'quantity' => $q, 'unitPrice' => $_up, 'totalPrice' => $_tp,
            'amountTendered' => $_at, 'changeDue' => $_cd, 'modeOfPayment' => $_mop, 'transType' => $_tt,
            'staffId' => $this->session->admin_id, 'totalMoneySpent' => $_tas, 'ref' => $ref, 'vatAmount' => $_va,
            'vatPercentage' => $_vp, 'discount_amount'=>$da, 'discount_percentage'=>$dp, 'cust_name'=>$cn, 'cust_phone'=>$cp,
            'cust_email'=>$ce];

        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" ?
            $this->db->set('transDate', "datetime('now')", FALSE) :
            $this->db->set('transDate', "NOW()", FALSE);

        $this->db->insert('transactions_item', $data);

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
        $q = "SELECT DISTINCT ref FROM transactions_item WHERE ref = ?";

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
        try {
            $this->db->select('transactions_item.ref, GROUP_CONCAT(DISTINCT transactions_item.totalMoneySpent) AS totalMoneySpent, transactions_item.modeOfPayment, transactions_item.staffId,
                transactions_item.transDate, transactions_item.lastUpdated, transactions_item.amountTendered, transactions_item.changeDue,
                CONCAT_WS(" ", admin.first_name, admin.last_name) as "staffName",
                transactions_item.cust_name, transactions_item.cust_phone, transactions_item.cust_email, GROUP_CONCAT(DISTINCT totalPrice) AS totalPrice,GROUP_CONCAT(DISTINCT transactions_item.cancelled) AS cancelled');
            $this->db->select_sum('transactions_item.quantity');
            $this->db->join('admin', 'transactions_item.staffId = admin.id', 'LEFT');
            $this->db->like('ref', $value);
            $this->db->or_like('itemName', $value);
            $this->db->or_like('itemCode', $value);
            $this->db->group_by('transactions_item.ref, transactions_item.modeOfPayment, transactions_item.staffId, transactions_item.transDate, transactions_item.lastUpdated, transactions_item.amountTendered, transactions_item.changeDue, CONCAT_WS(" ", admin.first_name, admin.last_name), transactions_item.cust_name, transactions_item.cust_phone, transactions_item.cust_email');

    
            $run_q = $this->db->get('transactions_item');
    
            if ($run_q->num_rows() > 0) {
                return $run_q->result();
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            // Handle the exception here by logging it
            log_message('error', 'Error in transSearch: ' . $e->getMessage());
            return FALSE; // Return FALSE to indicate an error occurred
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
        $q = "SELECT * FROM transactions_item WHERE ref = ?";

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
        $q = "SELECT count(DISTINCT REF) as 'totalTrans' FROM transactions_item";

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
        $q = "SELECT GROUP_CONCAT(DISTINCT totalMoneySpent) AS totalMoneySpent FROM transactions_item WHERE DATE(transDate) = CURRENT_DATE GROUP BY ref";

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
    
    public function getDateRange($from_date, $to_date){
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT transactions_item.ref, transactions_item.totalMoneySpent, transactions_item.modeOfPayment, transactions_item.staffId,
                transactions_item.transDate, transactions_item.lastUpdated, transactions_item.amountTendered, transactions_item.changeDue,
                admin.first_name || ' ' || admin.last_name AS 'staffName', SUM(transactions_item.quantity) AS 'quantity',
                transactions_item.cust_name, transactions_item.cust_phone, transactions_item.cust_email
                FROM transactions_item
                LEFT OUTER JOIN admin ON transactions_item.staffId = admin.id
                WHERE 
                date(transactions_item.transDate) >= {$from_date} AND date(transactions_item.transDate) <= {$to_date}
                GROUP BY ref
                ORDER BY transactions_item.transId DESC";

            $run_q = $this->db->query($q);
        }
        
        else {
            $this->db->select('transactions_item.ref, transactions_item.totalMoneySpent, transactions_item.modeOfPayment, transactions_item.staffId,
                    transactions_item.transDate, transactions_item.lastUpdated, transactions_item.amountTendered, transactions_item.changeDue,
                    CONCAT_WS(" ", admin.first_name, admin.last_name) AS "staffName",
                    transactions_item.cust_name, transactions_item.cust_phone, transactions_item.cust_email');

            $this->db->select_sum('transactions_item.quantity');

            $this->db->join('admin', 'transactions_item.staffId = admin.id', 'LEFT');

            $this->db->where("DATE(transactions_item.transDate) >= ", $from_date);
            $this->db->where("DATE(transactions_item.transDate) <= ", $to_date);

            $this->db->order_by('transactions_item.transId', 'DESC');

            $this->db->group_by('ref');

            $run_q = $this->db->get('transactions_item');
        }
        
        return $run_q->num_rows() ? $run_q->result() : FALSE;
    }
    

    public function getSalesForMonth($month, $year) {
        try {
            // Define the start and end date for the specified month
            $startDate = "{$year}-{$month}-01";
            $endDate = date('Y-m-t', strtotime($startDate));
    
            // Get all item sales for the specified month
            $this->db->select('itemName, SUM(quantity) as totalQuantity, SUM(totalPrice) as totalRevenue');
            $this->db->where('transDate >=', $startDate);
            $this->db->where('transDate <=', $endDate);
            $this->db->group_by('itemName');
            $salesQuery = $this->db->get('transactions_item');
    
            if (!$salesQuery) {
                // Handle the database error
                throw new Exception('Database Error: ' . $this->db->error()['message']);
            }
    
            // Initialize sales data array
            $salesData = [];
    
            // Populate sales data array with item sales information
            foreach ($salesQuery->result() as $row) {
                $salesData[] = [
                    'itemName' => $row->itemName,
                    'totalQuantity' => $row->totalQuantity,
                    'totalRevenue' => $row->totalRevenue,
                ];
            }
    
            return $salesData; // Return sales data for the specified month
        } catch (Exception $e) {
            log_message('error', 'Error: ' . $e->getMessage());
            return FALSE; // Or handle the error in your own way
        }
    }
    
}