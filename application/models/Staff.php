<?php
defined('BASEPATH') OR exit('');

/**
 * model for Staff
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 9 September, 2023
 */
class Staff extends CI_Model{
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
        
        $run_q = $this->db->get('staffs');
        
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
     * @param string $staffName
     * @param string $staffSurname
     * @param string $staffGender
     * @param string $staffStaff_id
     * @param string $staffPhone
     * @param string $staffAddress
     * @param string $staffDepartment
     * @param string $staffNational_id
     * @param string $staffEmail
     * @param string $staffDob
     * @param string $staffJob_tittle
     * @param decimal $staffSalary
     * @return boolean
     */
    public function add($staffName, $staffSurname, $staffGender, $staffStaff_id, $staffPhone,$staffAddress,$staffDepartment,$staffNational_id,$staffEmail,$staffDob,$staffJob_tittle,$staffSalary){
        $data = ['name'=>$staffName, 'surname'=>$staffSurname, 'gender'=>$staffGender, 'staff_id'=>$staffStaff_id, 'phone'=>$staffPhone, 'address'=>$staffAddress, 'department'=>$staffDepartment,'national_id'=>$staffNational_id,'email'=>$staffEmail,'dob'=>$staffDob, 'job_tittle'=>$staffJob_tittle, 'basic_salary'=>$staffSalary];
                
        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" 
                ? 
        $this->db->set('dateAdded', "datetime('now')", FALSE) 
                : 
        $this->db->set('dateAdded', "NOW()", FALSE);
        
        $this->db->insert('staffs', $data);
        
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
    public function staffsearch($value){
        $q = "SELECT * FROM staffs 
            WHERE 
            name LIKE '%".$this->db->escape_like_str($value)."%'
            OR 
            surname LIKE '%".$this->db->escape_like_str($value)."%'
            OR
            staff_id LIKE '%".$this->db->escape_like_str($value)."%'";
        
        $run_q = $this->db->query($q, [$value, $value, $value]);
        
        if($run_q->num_rows() > 0){
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
    * @param int $staffId
    * @param string $staffName
    * @param string $staffSurname
    * @param string $staffPhone
    * @param string $staffAddress
    * @param string $staffEmail
    * @param string $staffDepartment
    * @param string $staffNational_id
    * @param string $staffGender
    * @param date $staffDob
    * @param string $staffJob_tittle
    * @param decimal $staffSalary
    */


     
   public function edit($staffId, $staffName, $staffSurname, $staffPhone, $staffAddress,$staffEmail,$staffDepartment,$staffNational_id,$staffGender,$staffDob,$staffJob_tittle,$staffSalary){
       $data = ['name'=>$staffName, 'surname'=>$staffSurname, 'phone'=>$staffPhone, 'address'=>$staffAddress,'email'=>$staffEmail,'department'=>$staffDepartment, 'national_id'=>$staffNational_id,'gender'=>$staffGender,'dob'=>$staffDob,'job_tittle'=>$staffJob_tittle, 'basic_salary'=>$staffSalary];
       
       $this->db->where('id', $staffId);
       $this->db->update('staffs', $data);
       
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
    public function getStaffInfo($where_clause, $fields_to_fetch){
        $this->db->select($fields_to_fetch);
        
        $this->db->where($where_clause);

        $run_q = $this->db->get('staffs');
        
        return $run_q->num_rows() ? $run_q->row() : FALSE;
    }
    
    /**
     * Get active employees based on their status.
     *
     * @param string $orderBy Column to order by
     * @param string $orderFormat Order format (ASC or DESC)
     * @return array|boolean Returns an array of active employees or FALSE if no results are found
     */
    public function getActiveStaffs($orderBy, $orderFormat) {
        $this->db->order_by($orderBy, $orderFormat);
    
        // Assuming 'status' is a BOOLEAN field with 1 for active and 0 for inactive
        $this->db->where('status', 1); // 1 represents 'active'
    
        $run_q = $this->db->get('staffs');
    
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
    * @param type $staff_id
    * @param type $new_status New account status
    * @return boolean
    */ 
    public function suspend($staff_id, $new_status){       
        $this->db->where('id', $staff_id);
        $this->db->update('staffs', ['status'=>$new_status]);

        if($this->db->affected_rows()){
            return TRUE;
        }

        else{
            return FALSE;
        }
    }
    


}



