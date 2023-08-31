<?php
defined('BASEPATH') OR exit('');

/**
 * model for Teachers
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 8 August, 2023
 */
class Teacher extends CI_Model{
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
        
        $run_q = $this->db->get('teachers');
        
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
     * @param string $teacherName
     * @param string $teacherSurname
     * @param string $teacherGender
     * @param string $teacherSubject
     * @param string $teacherPhone
     * @param string $teacherAddress
     * @param string $teacherDepartment
     * @return boolean
     */
    public function add($teacherName, $teacherSurname, $teacherGender, $teacherSubject, $teacherPhone,$teacherAddress,$teacherDepartment){
        $data = ['name'=>$teacherName, 'surname'=>$teacherSurname, 'gender'=>$teacherGender, 'subject'=>$teacherSubject, 'phone'=>$teacherPhone, 'address'=>$teacherAddress, 'department'=>$teacherDepartment];
                
        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" 
                ? 
        $this->db->set('dateAdded', "datetime('now')", FALSE) 
                : 
        $this->db->set('dateAdded', "NOW()", FALSE);
        
        $this->db->insert('teachers', $data);
        
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
    public function teachersearch($value){
        $q = "SELECT * FROM teachers 
            WHERE 
            name LIKE '%".$this->db->escape_like_str($value)."%'
            || 
            surname LIKE '%".$this->db->escape_like_str($value)."%'";
        
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
    * @param int $teacherId
    * @param string $teacherName
    * @param string $teacherSurname
    * @param string $teacherPhone
    * @param string $teacherAddress
    * @param string $teacherSubject
    * @param string $teacherDepartment
    */


     
   public function edit($teacherId, $teacherName, $teacherSurname, $teacherPhone, $teacherAddress,$teacherSubject,$teacherDepartment){
       $data = ['name'=>$teacherName, 'surname'=>$teacherSurname, 'phone'=>$teacherPhone, 'address'=>$teacherAddress,'subject'=>$teacherSubject,'department'=>$teacherDepartment];
       
       $this->db->where('id', $teacherId);
       $this->db->update('teachers', $data);
       
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
    public function getTeacherInfo($where_clause, $fields_to_fetch){
        $this->db->select($fields_to_fetch);
        
        $this->db->where($where_clause);

        $run_q = $this->db->get('teachers');
        
        return $run_q->num_rows() ? $run_q->row() : FALSE;
    }
    
    /**
     * Get active employees based on their status.
     *
     * @param string $orderBy Column to order by
     * @param string $orderFormat Order format (ASC or DESC)
     * @return array|boolean Returns an array of active employees or FALSE if no results are found
     */
    public function getActiveTeachers($orderBy, $orderFormat) {
        $this->db->order_by($orderBy, $orderFormat);

        // Assuming 'status' is the BOOLEAN field that determines the employee's active/inactive status
        $this->db->where('status', TRUE); // TRUE represents 'active'

        $run_q = $this->db->get('teachers');

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }


}



