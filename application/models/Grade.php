<?php
defined('BASEPATH') OR exit('');

/**
 * Model for managing grades.
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 08 August, 2023
 */
class Grade extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Get all grades with optional sorting and pagination.
     *
     * @param string $orderBy     The column to sort by.
     * @param string $orderFormat The sorting order (e.g., 'ASC' or 'DESC').
     * @param int    $start       The starting index for pagination.
     * @param int    $limit       The maximum number of results to retrieve.
     *
     * @return array|null An array of grade objects or NULL if no results are found.
     */

    public function getAll($orderBy, $orderFormat, $start = 0, $limit = ''){ 
        $this->db->select('grades.*, GROUP_CONCAT(DISTINCT teachers.name, " ", teachers.surname) AS teacher_id');
        $this->db->from('grades');
        $this->db->join('teachers', 'grades.teacher_id = teachers.id', 'left');
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);
        $this->db->group_by('grades.id');
    
        $run_q = $this->db->get();
    
        return $run_q->result();
    }
    

    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    /**
     * Add a new grade to the database.
     *
     * @param string $gradeName       The name of the grade.
     * @param int    $gradeTeacher_id The ID of the teacher associated with the grade.
     *
     * @return int|bool The newly inserted grade ID or FALSE on failure.
     */
    public function add($gradeName,$gradeTeacher_id){
        $data = ['name'=>$gradeName, 'teacher_id'=>$gradeTeacher_id];
                
        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" 
                ? 
        $this->db->set('dateAdded', "datetime('now')", FALSE) 
                : 
        $this->db->set('dateAdded', "NOW()", FALSE);
        
        $this->db->insert('grades', $data);
        
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
     * Search for grades by name or teacher ID.
     *
     * @param string $value The search query.
     *
     * @return array|bool An array of matching grade objects or FALSE if no matches are found.
     */
    public function gradesearch($value) {
        try {
            
            // Build the SQL query manually
            $sql = "SELECT grades.*, GROUP_CONCAT(DISTINCT teachers.name, ' ', teachers.surname) AS teacher_id ";
            $sql .= "FROM grades ";
            $sql .= "LEFT JOIN teachers ON grades.teacher_id = teachers.id ";
            $sql .= "WHERE grades.name LIKE '%" . $this->db->escape_like_str($value) . "%' ";
            $sql .= "OR CONCAT(teachers.name, ' ', teachers.surname) LIKE '%" . $this->db->escape_like_str($value) . "%' ";
            $sql .= "GROUP BY grades.id";
    
            
            $query = $this->db->query($sql);
    
            if ($query === false) {
                // Log the database error
                log_message('error', 'Database error: ' . $this->db->error());
                return array();
            }
    
            return $query->result();
        } catch (Exception $e) {
            // Log any exceptions that occur
            log_message('error', 'Exception: ' . $e->getMessage());
            return array();
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
     * Edit an existing grade's information.
     *
     * @param int    $gradeId         The ID of the grade to edit.
     * @param string $gradeName       The new name for the grade.
     * @param int    $gradeTeacher_id The new teacher ID associated with the grade.
     *
     * @return bool TRUE on successful update, otherwise FALSE.
     */

    public function edit($gradeId, $gradeName, $gradeTeacher_id){
    $data = ['name'=>$gradeName, 'teacher_id'=>$gradeTeacher_id];

    $this->db->where('id', $gradeId);
    $this->db->update('grades', $data);

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
     * Get specific grade information based on a given condition.
     *
     * @param array $where_clause    An associative array representing the condition.
     * @param array $fields_to_fetch An array of fields to retrieve.
     *
     * @return object|bool The grade information as an object or FALSE if no match is found.
     */

    public function getGradeInfo($where_clause, $fields_to_fetch){
        $this->db->select($fields_to_fetch);
        
        $this->db->where($where_clause);

        $run_q = $this->db->get('grades');
        
        return $run_q->num_rows() ? $run_q->row() : FALSE;
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    /**
     * Get the grade name by ID.
     *
     * @param int $gradeId The ID of the grade.
     * @return string|bool The grade name or FALSE if not found.
     */
    
    public function getGradeNameById($gradeId){
        $this->db->select('name');
        $this->db->where('id', $gradeId);
        $query = $this->db->get('grades');
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->name;
        } else {
            return FALSE;
        }
    }

   
}