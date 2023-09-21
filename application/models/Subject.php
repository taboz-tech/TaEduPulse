<?php
defined('BASEPATH') OR exit('');

/**
 * Model for managing Subject
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 19 September, 2023
 */
class Subject extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Get all subjects with optional sorting and pagination.
     *
     * @param string $orderBy     The column to sort by.
     * @param string $orderFormat The sorting order (e.g., 'ASC' or 'DESC').
     * @param int    $start       The starting index for pagination.
     * @param int    $limit       The maximum number of results to retrieve.
     *
     * @return array|null An array of subject objects or NULL if no results are found.
     */

     public function getAll($orderBy, $orderFormat, $start = 0, $limit = ''){ 
        $this->db->select('*'); // Select all columns
        $this->db->from('subjects');
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);
    
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
     * Add a new subject to the database.
     *
     * @param string $subjectName       The name of the subject.
     *
     * @return int|bool The newly inserted subject ID or FALSE on failure.
     */
    public function add($subjectName){
        $data = ['name'=>$subjectName];
                
        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" 
                ? 
        $this->db->set('dateAdded', "datetime('now')", FALSE) 
                : 
        $this->db->set('dateAdded', "NOW()", FALSE);
        
        $this->db->insert('subjects', $data);
        
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
     * Search for subjects by name or teacher ID.
     *
     * @param string $value The search query.
     *
     * @return array|bool An array of matching grade objects or FALSE if no matches are found.
     */
    public function subjectsearch($value) {
        try {
            // Build the SQL query for searching subjects by name
            $sql = "SELECT * FROM subjects ";
            $sql .= "WHERE name LIKE '%" . $this->db->escape_like_str($value) . "%'";
    
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
     * Edit an existing subject's information.
     *
     * @param int    $subjectId         The ID of the subject to edit.
     * @param string $subjectName       The new name for the subject.
     *
     * @return bool TRUE on successful update, otherwise FALSE.
     */

    public function edit($subjectId, $subjectName){
    $data = ['name'=>$subjectName];

    $this->db->where('id', $subjectId);
    $this->db->update('subjects', $data);

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
     * Get specific subject information based on a given condition.
     *
     * @param array $where_clause    An associative array representing the condition.
     * @param array $fields_to_fetch An array of fields to retrieve.
     *
     * @return object|bool The subject information as an object or FALSE if no match is found.
     */

    public function getSubjectInfo($where_clause, $fields_to_fetch){
        $this->db->select($fields_to_fetch);
        
        $this->db->where($where_clause);

        $run_q = $this->db->get('subjects');
        
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
     * Get the subjectgrade name by ID.
     *
     * @param int $subjectId The ID of the subject.
     * @return string|bool The subject name or FALSE if not found.
     */
    
    public function getSubjectNameById($subjectId){
        $this->db->select('name');
        $this->db->where('id', $subjectId);
        $query = $this->db->get('subjects');
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->name;
        } else {
            return FALSE;
        }
    }

   
}