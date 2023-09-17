<?php
defined('BASEPATH') OR exit('');

/**
 * model for Costs
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 14 August, 2023
 */
class Cost extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function getAll($orderBy, $orderFormat, $start=0, $limit=''){
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);
        
        $run_q = $this->db->get('costs');
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
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
     * 
     * @param string $costName
     * @param string $costAmount
     * @param string $costCategory
     * @param string $costDescription
     * @param string $costCurrency
     * @param boolean $costStatus
     * @param decimal $costBalance
     * @param decimal $costPaid
     * @return boolean
     */
    public function add($costName, $costAmount, $costCategory, $costDescription, $costCurrency,$costStatus,$costBalance,$costPaid){
        $data = ['name'=>$costName, 'amount'=>$costAmount, 'category'=>$costCategory, 'balance'=>$costBalance,
         'description'=>$costDescription, 'currency'=>$costCurrency , 'status'=>$costStatus, 'paid'=>$costPaid];
                
        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" 
                ? 
        $this->db->set('dateAdded', "datetime('now')", FALSE) 
                : 
        $this->db->set('dateAdded', "NOW()", FALSE);
        
        $this->db->insert('costs', $data);
        
        if($this->db->insert_id()){
            return $this->db->insert_id();
        }
        
        else{
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
     * 
     * @param type $value
     * @return boolean
     */
    public function costsearch($value){
        $q = "SELECT * FROM costs 
            WHERE 
            name LIKE '%".$this->db->escape_like_str($value)."%'
            || 
            category LIKE '%".$this->db->escape_like_str($value)."%'";
        
        $run_q = $this->db->query($q, [$value, $value]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
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
    * 
    * @param int $costId
    * @param string $costName
    * @param string $costAmount
    * @param string $costCategory
    * @param string $costDescription
    * @param string $costCurrency
    */


     
   public function edit($costId, $costName, $costAmount, $costCategory, $costDescription,$costCurrency,$newBalance){
       $data = ['name'=>$costName, 'amount'=>$costAmount, 'category'=>$costCategory, 'description'=>$costDescription,'currency'=>$costCurrency, 'balance'=>$newBalance];
       
       $this->db->where('id', $costId);
       $this->db->update('costs', $data);
       
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
     * array $where_clause
     * array $fields_to_fetch
     * 
     * return array | FALSE
     */
    public function getCostInfo($where_clause, $fields_to_fetch){
        $this->db->select($fields_to_fetch);
        
        $this->db->where($where_clause);

        $run_q = $this->db->get('costs');
        
        return $run_q->num_rows() ? $run_q->row() : FALSE;
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function totalCostZar() {
        $q = "SELECT SUM(amount) as 'totalCostZAR' FROM costs where currency = 'ZAR'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalCostZAR;
            }
        }
        else {
            return FALSE;
        }
    }

    public function totalCostUsd() {
        $q = "SELECT SUM(amount) as 'totalCostUSD' FROM costs where currency = 'Usd'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalCostUSD;
            }
        }
        else {
            return FALSE;
        }
    }

    public function totalCostZwl() {
        $q = "SELECT SUM(amount) as 'totalCostZWL' FROM costs where currency = 'ZWL'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalCostZWL;
            }
        }
        else {
            return FALSE;
        }
    }

    public function payCost($costId, $paymentAmount) {
        try {
            // Get the current cost information
            $costInfo = $this->getCostInfo(['id' => $costId], ['paid', 'balance', 'status']);
    
            if (!$costInfo) {
                throw new Exception('Cost not found');
            }
    
            $currentPaid = $costInfo->paid;
            $currentBalance = $costInfo->balance;
    
            // Calculate the new balance
            $newBalance = $currentBalance - $paymentAmount;
    
            // Update the amount paid and balance
            $data = ['paid' => $currentPaid + $paymentAmount, 'balance' => $newBalance];
    
            // If the new balance is 0, set the status to 1
            if ($newBalance == 0) {
                $data['status'] = 1;
            }
    
            $this->db->where('id', $costId);
            $this->db->update('costs', $data);
    
            return true;
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false;
        }
    }
    
    public function getAllCostsAndCurrencies() {
        // Select all costs and their currencies
        $this->db->select('name, amount, currency');
        $query = $this->db->get('costs');
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Return an empty array if no costs are found
        }
    }
}



