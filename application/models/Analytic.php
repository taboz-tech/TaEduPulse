<?php
defined('BASEPATH') OR exit(':D');

/**
 * Description of Analytic
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 12-March-2022
 */
class Analytic extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     * Get daily info on transactions
     * @param type $start
     * @param type $limit
     * @param type $order_by
     * @param type $order_format
     * @return boolean
     */
    public function getDailyTrans($start = 0, $limit = 10, $order_by = 'DATE(transDate)', $order_format = 'DESC')
    {
        // Calculate the sum of (totalAmount - refundAmount) converted to USD
        $this->db->select('count(DISTINCT(ref)) as "tot_trans", SUM(totalAmount - IFNULL(refundAmount, 0)) as "tot_earned_not", DATE(transDate) as transactionDate, SUM((totalAmount - IFNULL(refundAmount, 0)) / c.rate) as "tot_earned"');
        $this->db->order_by($order_by, $order_format);
        $this->db->limit($limit, $start);
        $this->db->group_by('transactionDate');
        $this->db->join('currencies c', 'c.name = transactions.currency', 'left'); // Join with currencies table
    
        $run_q = $this->db->get('transactions');
    
        return $run_q->num_rows() ? $run_q->result() : FALSE;
    }
    
     
    
    
    
    /*public function getTimeOfDay(){
        $this->db->select('count(id) as "counter", visit_period');
        $this->db->order_by('counter', 'DESC');
        $this->db->group_by('visit_period');
        
        $run_q = $this->db->get('daily_visitors');
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    public function getTotalToday(){
        $this->db->select('count(id) as "counter"');
        $this->db->where('DATE(visit_time)', date('Y-m-d'));
        
        $run_q = $this->db->get('daily_visitors');
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->counter;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    public function getTotalThisMonth(){
        $this->db->select('count(id) as "counter"');
        $this->db->where('MONTH(visit_time)', date('n'));
        
        $run_q = $this->db->get('daily_visitors');
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->counter;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    
    public function getTotalThisYear(){
        $this->db->select('count(id) as "counter"');
        $this->db->where('YEAR(visit_time)', date('Y'));
        
        $run_q = $this->db->get('daily_visitors');
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->counter;
            }
        }
        
        else{
            return FALSE;
        }
    }*/
    
    /*
     ********************************************************************************************************************************
     ********************************************************************************************************************************
     ********************************************************************************************************************************
     ********************************************************************************************************************************
     ********************************************************************************************************************************
     */
    
    /**
     * Get Transactions info by days
     * @return boolean
     */
    public function getTransByDays()
    {
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT 
                count(DISTINCT(ref)) as 'tot_trans',  
                SUM(totalAmount - IFNULL(refundAmount, 0)) as 'tot_earned',
                case cast (strftime('%w', transDate) as integer)
                when 0 then 'Sunday'
                when 1 then 'Monday'
                when 2 then 'Tuesday'
                when 3 then 'Wednesday'
                when 4 then 'Thursday'
                when 5 then 'Friday'
                else 'Saturday' end as day
            FROM transactions
            GROUP BY day
            ORDER BY tot_earned DESC";

            $run_q = $this->db->query($q, []);
        } else {
            // Calculate the sum of (totalAmount - refundAmount) converted to USD
            $this->db->select('count(DISTINCT(ref)) as "tot_trans", SUM((totalAmount - IFNULL(refundAmount, 0)) / c.rate) as "tot_earned", DAYNAME(transDate) as "day"');
            $this->db->order_by('tot_earned', 'DESC');
            $this->db->group_by('day');
            $this->db->join('currencies c', 'c.name = transactions.currency', 'left'); // Join with currencies table
            $run_q = $this->db->get('transactions');
        }

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
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
     * Get Transactions info by months
     * @return boolean
     */
    public function getTransByMonths()
    {
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT 
                count(DISTINCT(ref)) as 'tot_trans', 
                SUM(totalAmount - IFNULL(refundAmount, 0)) as 'tot_earned',
                case cast (strftime('%m', transDate) as integer)
                when 01 then 'January'
                when 02 then 'February'
                when 03 then 'March'
                when 04 then 'April'
                when 05 then 'May'
                when 06 then 'June'
                when 07 then 'July'
                when 08 then 'August'
                when 09 then 'September'
                when 10 then 'October'
                when 11 then 'November'
                when 12 then 'December' end as month
            FROM transactions
            GROUP BY month
            ORDER BY tot_earned DESC";

            $run_q = $this->db->query($q, []);
        } else {
            // Calculate the sum of (totalAmount - refundAmount) converted to USD
            $this->db->select('count(DISTINCT(ref)) as "tot_trans", SUM((totalAmount - IFNULL(refundAmount, 0)) / c.rate) as "tot_earned", MONTHNAME(transDate) as "month"');
            $this->db->order_by('tot_earned', 'DESC');
            $this->db->group_by('month');
            $this->db->join('currencies c', 'c.name = transactions.currency', 'left'); // Join with currencies table
            $run_q = $this->db->get('transactions');
        }

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
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
     * Get Transactions info by years
     * @return boolean
     */
    public function getTransByYears()
    {
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT 
                count(DISTINCT(ref)) as 'tot_trans', 
                SUM(totalAmount - IFNULL(refundAmount, 0)) as 'tot_earned',
                strftime('%Y', transDate) as 'year'
            FROM transactions
            GROUP BY year
            ORDER BY tot_earned DESC";

            $run_q = $this->db->query($q, []);
        } else {
            // Calculate the sum of (totalAmount - refundAmount) converted to USD
            $this->db->select('count(DISTINCT(ref)) as "tot_trans", SUM((totalAmount - IFNULL(refundAmount, 0)) / c.rate) as "tot_earned", YEAR(transDate) as "year"');
            $this->db->order_by('tot_earned', 'DESC');
            $this->db->group_by('year');
            $this->db->join('currencies c', 'c.name = transactions.currency', 'left'); // Join with currencies table
            $run_q = $this->db->get('transactions');
        }

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
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
    * Selects most paying students
    * @return boolean
    */
    public function topPayersLastTwoMonths() {
        $query = "SELECT students.name, students.surname, students.student_id, 
                  SUM(transactions.totalAmount) AS 'totalSpent'
                  FROM students
                  INNER JOIN transactions ON students.student_id = transactions.student_id
                  WHERE transactions.paymentStatus = 1
                    AND transactions.transDate >= DATE_SUB(NOW(), INTERVAL 2 MONTH)
                  GROUP BY students.student_id
                  ORDER BY totalSpent DESC
                  LIMIT 5";
    
        $result = $this->db->query($query);
    
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return FALSE;
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
     * Selects least paying students
     * @return boolean
     */
    public function leastPayersLastTwoMonths() {
        $query = "SELECT students.name, students.surname, students.student_id, 
                  SUM(transactions.totalAmount) AS 'totalSpent'
                  FROM students
                  INNER JOIN transactions ON students.student_id = transactions.student_id
                  WHERE transactions.paymentStatus = 1
                    AND transactions.transDate >= DATE_SUB(NOW(), INTERVAL 2 MONTH)
                  GROUP BY students.student_id
                  ORDER BY totalSpent ASC
                  LIMIT 5";
    
        $result = $this->db->query($query);
    
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return FALSE;
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
     * Students that has brought highest income (in total)
     * @return boolean
     */
    public function highestSpenders() {
        $query = "SELECT students.name, students.surname, students.student_id, 
                  SUM(transactions.totalAmount) AS 'totalSpent'
                  FROM students
                  INNER JOIN transactions ON students.student_id = transactions.student_id
                  WHERE transactions.paymentStatus = 1
                  GROUP BY students.student_id
                  ORDER BY totalSpent DESC
                  LIMIT 5";
    
        $result = $this->db->query($query);
    
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return FALSE;
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
    * studentss that has brought lowest income (in total)
    * @return boolean
    */
    public function lowestSpenders() {
        $query = "SELECT students.name, students.surname, students.student_id, 
                  SUM(transactions.totalAmount) AS 'totalSpent'
                  FROM students
                  INNER JOIN transactions ON students.student_id = transactions.student_id
                  WHERE transactions.paymentStatus = 1
                  GROUP BY students.student_id
                  ORDER BY totalSpent ASC
                  LIMIT 5";
    
        $result = $this->db->query($query);
    
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return FALSE;
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
     * Selects all transactions done within the last 24 hours
     * @return float Total earnings today in USD
     */
    public function totalSalesToday()
    {
        if ($this->db->platform() == "sqlite3") {
            // SQLite doesn't support CURRENT_DATE directly, so we'll use a workaround
            $query = "SELECT SUM(totalAmount - IFNULL(refundAmount, 0)) as 'totalAmountToday' 
                    FROM transactions 
                    WHERE DATE(transDate) = DATE('now', 'localtime')";
        } else {
            // Calculate the sum of (totalAmount - refundAmount) converted to USD
            $query = "SELECT SUM((totalAmount - IFNULL(refundAmount, 0)) / c.rate) as 'totalAmountToday' 
                    FROM transactions 
                    LEFT JOIN currencies c ON c.name = transactions.currency
                    WHERE DATE(transactions.transDate) = CURRENT_DATE";
        }

        $result = $this->db->query($query);
        if (!$result) {
            // Handle SQL query errors
            return 0.00;
        }
        $row = $result->row();
        if (isset($row->totalAmountToday) && $row->totalAmountToday !== null) {
            return $row->totalAmountToday;
        } else {
            return 0.00; // Return 0.00 when there are no transactions or totalAmountToday is NULL
        }
    }

    /**
     * Selects the total earnings for the current month in USD
     * @return float Total earnings for the current month in USD
     */
    public function totalSalesThisMonth()
    {
        if ($this->db->platform() == "sqlite3") {
            // SQLite doesn't support CURRENT_DATE directly, so we'll use a workaround
            $query = "SELECT SUM(totalAmount - IFNULL(refundAmount, 0)) as 'totalAmountThisMonth' 
                    FROM transactions 
                    WHERE strftime('%Y-%m', transDate) = strftime('%Y-%m', 'now', 'localtime')";
        } else {
            // Calculate the sum of (totalAmount - refundAmount) converted to USD
            $query = "SELECT SUM((totalAmount - IFNULL(refundAmount, 0)) / c.rate) as 'totalAmountThisMonth' 
                    FROM transactions 
                    LEFT JOIN currencies c ON c.name = transactions.currency
                    WHERE DATE_FORMAT(transactions.transDate, '%Y-%m') = DATE_FORMAT(CURRENT_DATE, '%Y-%m')";
        }

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->totalAmountThisMonth;
        } else {
            return 0.00; // Return 0.00 when there are no transactions for the current month
        }
    }


}
