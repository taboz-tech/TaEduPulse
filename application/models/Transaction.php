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
            $q = "SELECT transactions.transId, transactions.ref, transactions.studentName, transactions.studentSurname,
                transactions.student_id, transactions.studentClass_name, transactions.description,
                transactions.totalAmount, transactions.totalMoneySpent, transactions.amountTendered,
                transactions.changeDue, transactions.modeOfPayment, transactions.currency,
                transactions.cust_name, transactions.cust_phone, transactions.cust_email,
                transactions.transType, transactions.staffId, transactions.transDate,
                transactions.lastUpdated, transactions.cancelled, transactions.paymentStatus,
                transactions.term, transactions.latePenalty, transactions.refundDate,
                transactions.refundAmount,
                admin.first_name || ' ' || admin.last_name AS 'staffName'      FROM transactions
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
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.currency) AS currency');
            $this->db->select('GROUP_CONCAT(DISTINCT transactions.refundAmount) AS refundAmount');
            
            
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
    public function add($ref,$studentName, $studentSurname,$studentClass_name,$studentStudent_id,$description, $totalFees, $cumAmount, $_at, $_cd,$_mop, $cust_name, $cust_phone,  $cust_email, $transType,$paymentStatus,$term,$currency) { 
        log_message("error", "Inside Transaction Model add method");
        $data = ['studentName' => $studentName, 'student_id' => $studentStudent_id, 'studentSurname' => $studentSurname, 'studentClass_name' => $studentClass_name, 'description' => $description, 'totalAmount' => $totalFees,
            'amountTendered' => $_at, 'changeDue' => $_cd, 'modeOfPayment' => $_mop, 'transType' => $transType,
            'staffId' => $this->session->admin_id, 'totalMoneySpent' => $cumAmount, 'ref' => $ref, 'cust_name'=>$cust_name,'paymentStatus'=>$paymentStatus,'term'=>$term, 'cust_phone'=>$cust_phone,
            'cust_email'=>$cust_email,'currency'=>$currency];

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

     public function totalEarnedToday() {
        // Query to get all transactions for today, along with their currencies
        $transactionsQuery = "SELECT transId, totalMoneySpent, currency
                            FROM transactions
                            WHERE DATE(transDate) = CURRENT_DATE";
    
        $transactionsResult = $this->db->query($transactionsQuery);
    
        if ($transactionsResult->num_rows() > 0) {
            $totalEarnedTodayInUSD = 0;
    
            foreach ($transactionsResult->result() as $transaction) {
                // Check if there is a refund for this transaction and subtract it
                $refundQuery = "SELECT SUM(refundAmount) AS totalRefund
                                FROM transactions
                                WHERE transId = ?";
    
                $refundResult = $this->db->query($refundQuery, array($transaction->transId));
    
                if ($refundResult->num_rows() === 1) {
                    $refundAmount = $refundResult->row()->totalRefund;
                    $transaction->totalMoneySpent -= $refundAmount; // Subtract refund amount
    
                    // Fetch the exchange rate for the transaction's currency
                    $currencyRateQuery = "SELECT rate FROM currencies WHERE name = ?";
                    $currencyRateResult = $this->db->query($currencyRateQuery, array($transaction->currency));
    
                    if ($currencyRateResult->num_rows() === 1) {
                        $exchangeRate = $currencyRateResult->row()->rate;
    
                        // Convert the transaction amount to USD using its currency's exchange rate
                        $convertedAmountUSD = $transaction->totalMoneySpent / $exchangeRate;
    
                        $totalEarnedTodayInUSD += $convertedAmountUSD;
                    } else {
                        return FALSE; // Currency not found in the database
                    }
                } else {
                    return FALSE; // Error in refund query
                }
            }
    
            return $totalEarnedTodayInUSD;
        } else {
            return 0; // No transactions today
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

    /**
     * Get all transactions with a particular transId
     * @param type $ref
     * @return boolean
     */
    public function getTrans($transId) {
        $q = "SELECT * FROM transactions WHERE transId = ?";

        $run_q = $this->db->query($q, [$transId]);

        if ($run_q->num_rows() > 0) {
            return $run_q->result_array();
        }
        else {
            return FALSE;
        }
    }

    /**
     * Update the refund amount and date for a transaction
     * @param int $transactionId Transaction ID
     * @param float $refundAmount Refund amount
     * @return boolean
     */
    public function updateRefundAmount($transactionId, $refundAmount) {
        $data = array(
            'refundAmount' => $refundAmount,
            'refundDate' => date('Y-m-d H:i:s') // Set the refund date to the current date and time
        );

        $this->db->where('transId', $transactionId);
        $this->db->update('transactions', $data);

        return $this->db->affected_rows() > 0;
    }
    
    public function totalEarnedZwl() {
        $q = "SELECT SUM(totalAmount) as 'totalEarnedZWL' FROM transactions where currency = 'ZWL'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalEarnedZWL;
            }
        }
        else {
            return FALSE;
        }
    }

    public function totalEarnedUsd() {
        $q = "SELECT SUM(totalAmount) as 'totalEarnedUSD' FROM transactions where currency = 'USD'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalEarnedUSD;
            }
        }
        else {
            return FALSE;
        }
    }

    public function totalEarnedZar() {
        $q = "SELECT SUM(totalAmount) as 'totalEarnedZAR' FROM transactions where currency = 'ZAR'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalEarnedZAR;
            }
        }
        else {
            return FALSE;
        }
    }
    
    public function getIncomeByCurrencyForMonth($month, $year) {
        try {
            // Define the start and end date for the specified month
            $startDate = "{$year}-{$month}-01";
            $endDate = date('Y-m-t', strtotime($startDate));
    
            // Get all currencies
            $currencies = $this->db->get('currencies')->result();
    
            // Initialize income data array with 0 for each currency
            $incomeData = [];
            foreach ($currencies as $currency) {
                $incomeData[$currency->name] = 0;
            }
    
            // Calculate total income for the specified month by currency
            $this->db->select('currency');
            $this->db->select_sum('totalAmount', 'totalIncome');
            $this->db->where('transDate >=', $startDate);
            $this->db->where('transDate <=', $endDate);
            $this->db->where('refundDate IS NULL', null, false); // Exclude transactions with refund date
            $this->db->group_by('currency');
            $incomeQuery = $this->db->get('transactions');
    
            if (!$incomeQuery) {
                // Handle the database error
                throw new Exception('Database Error: ' . $this->db->error()['message']);
            }
    
            // Update the income data array with actual totals
            foreach ($incomeQuery->result() as $row) {
                $incomeData[$row->currency] = $row->totalIncome;
            }
            return $incomeData; // Return only the income data
        } catch (Exception $e) {
            log_message('error', 'Error: ' . $e->getMessage());
            return FALSE; // Or handle the error in your own way
        }
    }
    
    /**
     * Get refund amount by transaction ID
     * @param int $transId Transaction ID
     * @return float|boolean Refund amount if found, FALSE otherwise
     */
    public function getRefundAmount($transId) {
        $this->db->select('refundAmount');
        $this->db->where('transId', $transId);
        $query = $this->db->get('transactions');

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->refundAmount;
        } else {
            return FALSE;
        }
    }

    /**
     * Selects the total number of transactions done today
     * @return int Total number of transactions today
     */
    public function totalTransactionsToday()
    {
        if ($this->db->platform() == "sqlite3") {
            // SQLite doesn't support CURRENT_DATE directly, so we'll use a workaround
            $query = "SELECT count(DISTINCT REF) as 'totalTrans' 
                    FROM transactions 
                    WHERE DATE(transDate) = DATE('now', 'localtime')";
        } else {
            $query = "SELECT count(DISTINCT REF) as 'totalTrans' 
                    FROM transactions 
                    WHERE DATE(transactions.transDate) = CURRENT_DATE";
        }

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->totalTrans;
        } else {
            return 0; // Return 0 when there are no transactions today
        }
    }

    
    

}
