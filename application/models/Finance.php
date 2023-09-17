<?php
defined('BASEPATH') OR exit('');

/**
 * model for Finances
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 16 September, 2023
 */
class Finance extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function getCostsData(){
        try {
            $this->db->select('DATE_FORMAT(dateAdded, "%Y-%m") as month, 
                            SUM(CASE WHEN currency = "USD" THEN amount
                                    ELSE amount / (
                                        SELECT rate FROM currencies 
                                        WHERE name = costs.currency 
                                        ORDER BY dateAdded DESC LIMIT 1
                                    ) END) as total_cost,
                            SUM(CASE WHEN status = 1 THEN 
                                    (CASE WHEN currency = "USD" THEN amount
                                    ELSE amount / (
                                        SELECT rate FROM currencies 
                                        WHERE name = costs.currency 
                                        ORDER BY dateAdded DESC LIMIT 1
                                    ) END) ELSE 0 END) as total_paid_cost,
                            SUM(CASE WHEN status = 0 THEN 
                                    (CASE WHEN currency = "USD" THEN balance
                                    ELSE balance / (
                                        SELECT rate FROM currencies 
                                        WHERE name = costs.currency 
                                        ORDER BY dateAdded DESC LIMIT 1
                                    ) END) ELSE 0 END) as total_balance');
            $this->db->from('costs');
            $this->db->group_by('month');
            $this->db->order_by('month');
            $query = $this->db->get();
    
            if (!$query) {
                throw new Exception('Database query failed.');
            }
    
            $costsData = array();
            foreach ($query->result() as $row) {
                $costsData[] = array(
                    'month' => $row->month,
                    'total_cost' => $row->total_cost,
                    'total_paid_cost' => $row->total_paid_cost,
                    'total_balance' => $row->total_balance
                );
            }
    
            // Return the data as JSON
            return $costsData;
        } catch (Exception $e) {
            // Handle the exception, log it, or return an error message
            return array('error' => $e->getMessage());
        }
    }
    

    

}



