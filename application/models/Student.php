<?php
defined('BASEPATH') OR exit('');

/**
 * model for students 
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 29th July, 2023
 */
class Student extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function getAll($orderBy, $orderFormat, $start = 0, $limit = '') { 
        $this->db->select('students.*, grades.name AS class_name');
        $this->db->from('students');
        $this->db->join('grades', 'students.class_name = grades.id', 'left');
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);
        
        $run_q = $this->db->get();
        
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
     * 
     * @param type $studentName
     * @param type $studentSurname
     * @param type $studentStudent_id
     * @param type $studentClass_name
     * @param type $studentGender
     * @param type $studentParent_name
     * @param type $studentParent_phone
     * @param type $studentAddress
     * @param type $studentFees
     * @param type $studentOwed_fees
     * @return boolean
     */
    public function add($studentName, $studentSurname, $studentStudent_id, $studentClass_name, $studentGender, $studentParent_name,$studentParent_phone,$studentAddress,$studentFees,$studentOwed_fees){
        $data = ['name'=>$studentName, 'surname'=>$studentSurname, 'student_id'=>$studentStudent_id, 'class_name'=>$studentClass_name, 'gender'=>$studentGender, 'parent_name'=>$studentParent_name, 'parent_phone'=>$studentParent_phone, 'address'=>$studentAddress, 'fees'=>$studentFees,'owed_fees'=>$studentOwed_fees];
                
        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" 
                ? 
        $this->db->set('dateAdded', "datetime('now')", FALSE) 
                : 
        $this->db->set('dateAdded', "NOW()", FALSE);
        
        $this->db->insert('students', $data);
        
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
    public function studentsearch($value){
        $q = "SELECT * FROM students 
            WHERE 
            name LIKE '%".$this->db->escape_like_str($value)."%'
            || 
            student_id LIKE '%".$this->db->escape_like_str($value)."%'";
        
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
    public function getAllWithFees($orderBy, $orderFormat, $start = 0, $limit = '', $feePartition = '') { 
        $this->db->select('students.*, grades.name AS class_name');
        $this->db->from('students');
        $this->db->join('grades', 'students.class_name = grades.id', 'left');
        
        if ($feePartition === '0') {
            $this->db->where('students.owed_fees', 0);
        } elseif ($feePartition === '25') {
            $this->db->where('students.owed_fees >', 0);
            $this->db->where('students.owed_fees <=', 'students.fees * 0.25', false);
        } elseif ($feePartition === '50') {
            $this->db->where('students.owed_fees >', 'students.fees * 0.25', false);
            $this->db->where('students.owed_fees <=', 'students.fees * 0.5', false);
        } elseif ($feePartition === '75') {
            $this->db->where('students.owed_fees >', 'students.fees * 0.5', false);
            $this->db->where('students.owed_fees <=', 'students.fees * 0.75', false);
        } elseif ($feePartition === '100') {
            $this->db->where('students.owed_fees >', 'students.fees * 0.75', false);
        }
        
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);
        
        $run_q = $this->db->get();
        
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
     * Bulk update fees and owed fees for all students
     * @param float $newFees The new value for fees for all students
     * @param float $feesToAdd The amount to add to the current owed fees for all students
     * @return bool TRUE on success, FALSE on failure
     */
    public function updateFees($newFees, $feesToAdd) {
        $this->db->set('fees', $newFees);
        $this->db->set('owed_fees', 'owed_fees + ' . $feesToAdd, FALSE);
        $this->db->update('students');
        
        if ($this->db->affected_rows() > 0) {
            return TRUE;
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
    * 
    * @param type $studentId
    * @param type $studentName
    * @param type $studentSurname
    * @param type $studentClass_name
    * @param type $studentParent_name
    * @param type $studentParent_phone
    * @param type $studentFees
    * @param type $studentAddress
    * @param type $studentOwed_fees
    */


     
   public function edit($studentId, $studentName, $studentSurname, $studentClass_name,$studentParent_phone,$studentFees,$studentParent_name,$studentAddress,$studentOwed_fees){
       $data = ['name'=>$studentName, 'surname'=>$studentSurname, 'class_name'=>$studentClass_name, 'parent_name'=>$studentParent_name, 'parent_phone'=>$studentParent_phone, 'fees'=>$studentFees,'address'=>$studentAddress,'owed_fees'=>$studentOwed_fees];
       
       $this->db->where('id', $studentId);
       $this->db->update('students', $data);
       
       return TRUE;
   }
   
   /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function getActiveStudents($orderBy, $orderFormat){
        $this->db->order_by($orderBy, $orderFormat);
		
		$this->db->where('fees >', 0);
        
        $run_q = $this->db->get('students');
        
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
     * array $where_clause
     * array $fields_to_fetch
     * 
     * return array | FALSE
     */
    public function getStudentInfo($where_clause, $fields_to_fetch){
        $this->db->select($fields_to_fetch);
        
        $this->db->where($where_clause);

        $run_q = $this->db->get('students');
        
        return $run_q->num_rows() ? $run_q->row() : FALSE;
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function getstudentsCumTotal(){
        $this->db->select("SUM(fees) as cumPrice");

        $run_q = $this->db->get('students');
        
        return $run_q->num_rows() ? $run_q->row()->cumPrice : FALSE;
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function decrementStudent($studentStudent_id, $amountToRemove, $currencies, $currency) {
        
        // Determine the currency rate using currency name
        $currencyRate = 1.0; // Default value if currency is not found
    
        foreach ($currencies as $currencyInfo) {
            if ($currencyInfo->name === $currency) {
                $currencyRate = $currencyInfo->rate;
                break;
            }
        }

        // Convert the given amount to USD using the currency rate
        $amountInUSD = $amountToRemove / $currencyRate;
    
        log_message('error', 'amount to remove in USD: ' . $amountInUSD);
    
        $q = "UPDATE students SET owed_fees = owed_fees - ? WHERE student_id = ?";
    
        $this->db->query($q, [$amountInUSD, $studentStudent_id]);
    
        if ($this->db->affected_rows() > 0) {
            return TRUE;
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

    public function incrementStudent($studentStudent_id, $amountToAdd) {
        $q = "UPDATE students SET owed_fees = owed_fees + ? WHERE student_id = ?";
    
        $this->db->query($q, [$amountToAdd, $studentStudent_id]);
    
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
}



