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
    
    public function getAll($orderBy, $orderFormat, $start = 0, $limit = '', $selectedClass = '') { 
        try {
            $this->db->select('students.*, grades.name AS class_name');
            $this->db->from('students');
            $this->db->join('grades', 'students.class_name = grades.id', 'left');

            // Modify the query to filter by the selected class if it's set
            if (!empty($selectedClass)) {
                $this->db->where('students.class_name', $selectedClass);
            }

            $this->db->limit($limit, $start);
            $this->db->order_by($orderBy, $orderFormat);
            
            $run_q = $this->db->get();
    
            if ($run_q !== false) {
                if ($run_q->num_rows() > 0) {
                    return $run_q->result();
                } else {
                    return array(); // Return an empty array if no records found
                }
            } else {
                log_message('error', 'Database error: ' . $this->db->error());
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
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
     * @param type $studentHealthy_status
     * @param type $studentRelationship
     * @return boolean
     */
    public function add($studentName, $studentSurname, $studentStudent_id, $studentClass_name, $studentGender, $studentParent_name, $studentParent_phone, $studentAddress, $studentFees, $studentOwed_fees, $studentHealthy_status, $studentRelationship){
        try {
            $data = [
                'name' => $studentName,
                'surname' => $studentSurname,
                'student_id' => $studentStudent_id,
                'class_name' => $studentClass_name,
                'gender' => $studentGender,
                'parent_name' => $studentParent_name,
                'parent_phone' => $studentParent_phone,
                'address' => $studentAddress,
                'fees' => $studentFees,
                'owed_fees' => $studentOwed_fees,
                'healthyStatus' => $studentHealthy_status,
                'relationship' => $studentRelationship
            ];
    
            // Set the datetime based on the db driver in use
            $this->db->platform() == "sqlite3" 
                ? $this->db->set('dateAdded', "datetime('now')", FALSE) 
                : $this->db->set('dateAdded', "NOW()", FALSE);
    
            $this->db->insert('students', $data);
    
            if ($this->db->insert_id()) {
                return $this->db->insert_id();
            } else {
                log_message('error', 'Database error: Insert operation failed');
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
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
    public function studentsearch($value, $selectedClass = '') {
        try {
            $sql = "SELECT students.*, grades.name AS class_name FROM students
                    LEFT JOIN grades ON students.class_name = grades.id";
    
            $params = [];
    
            if (!empty($selectedClass)) {
                // If a class is selected, filter by class
                $sql .= " WHERE students.class_name = ?";
                $params[] = $selectedClass;
            }
    
            // Add search conditions based on the value
            $escapedValue = '%' . $this->db->escape_like_str($value) . '%';
    
            if (!empty($value)) {
                if (!empty($selectedClass)) {
                    // If both class and search value are provided, use AND to combine conditions
                    $sql .= " AND (students.name LIKE ? OR students.surname LIKE ? OR students.student_id LIKE ?)";
                } else {
                    // If no class is selected, just use WHERE to start the conditions
                    $sql .= " WHERE (students.name LIKE ? OR students.surname LIKE ? OR students.student_id LIKE ?)";
                }
    
                $params[] = $escapedValue;
                $params[] = $escapedValue;
                $params[] = $escapedValue;
            }
    
            $run_q = $this->db->query($sql, $params);
    
            if ($run_q !== false) {
                return $run_q->result();
            } else {
                log_message('error', 'Database error: ' . $this->db->error());
                return false;
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false;
        }
    }
    
    
    
    
    
    
    
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function getAllWithFees($orderBy, $orderFormat, $start = 0, $limit = '', $feePartition = '', $selectedClass = '') {
        try {
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
            
            // Add the selected class filter if it's provided
            if (!empty($selectedClass)) {
                $this->db->where('students.class_name', $selectedClass);
            }
            
            $this->db->limit($limit, $start);
            $this->db->order_by($orderBy, $orderFormat);
            
            $run_q = $this->db->get();
    
            if ($run_q !== false) {
                if ($run_q->num_rows() > 0) {
                    return $run_q->result();
                } else {
                    return array(); // Return an empty array if no records found
                }
            } else {
                log_message('error', 'Database error: ' . $this->db->error());
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
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
        try {
            $this->db->set('fees', $newFees);
            $this->db->set('owed_fees', 'owed_fees + ' . $feesToAdd, FALSE);
            $this->db->update('students');
            
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                log_message('error', 'Database error: Update operation failed');
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
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
    * @param type $studentHealthy_status
    * @param type $studentRelationship
    */


     
    public function edit($studentId, $studentName, $studentSurname, $studentClass_name, $studentParent_phone, $studentFees, $studentParent_name, $studentAddress, $studentOwed_fees, $studentHealthy_status, $studentRelationship){
        try {
            $data = [
                'name' => $studentName,
                'surname' => $studentSurname,
                'class_name' => $studentClass_name,
                'parent_name' => $studentParent_name,
                'parent_phone' => $studentParent_phone,
                'fees' => $studentFees,
                'address' => $studentAddress,
                'owed_fees' => $studentOwed_fees,
                'healthyStatus' => $studentHealthy_status,
                'relationship' => $studentRelationship
            ];
    
            $this->db->where('id', $studentId);
            $this->db->update('students', $data);
    
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                log_message('error', 'Database error: Update operation failed');
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
        }
    }
    
   
   /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    public function getActiveStudents($orderBy, $orderFormat){
        try {
            $this->db->order_by($orderBy, $orderFormat);
            
            $this->db->where('fees >', 0);
            
            $run_q = $this->db->get('students');
    
            if ($run_q !== false) {
                if ($run_q->num_rows() > 0) {
                    return $run_q->result();
                } else {
                    return array(); // Return an empty array if no records found
                }
            } else {
                log_message('error', 'Database error: ' . $this->db->error());
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
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
        try {
            $this->db->select($fields_to_fetch);
            $this->db->where($where_clause);
    
            $run_q = $this->db->get('students');
    
            if ($run_q !== false) {
                if ($run_q->num_rows() > 0) {
                    return $run_q->row();
                } else {
                    return false; // Return false to indicate no records found
                }
            } else {
                log_message('error', 'Database error: ' . $this->db->error());
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
        }
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function getstudentsCumTotal(){
        try {
            $this->db->select("SUM(fees) as cumPrice");
    
            $run_q = $this->db->get('students');
    
            if ($run_q !== false) {
                if ($run_q->num_rows() > 0) {
                    return $run_q->row()->cumPrice;
                } else {
                    return 0; // Return 0 to indicate no records found
                }
            } else {
                log_message('error', 'Database error: ' . $this->db->error());
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
        }
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function decrementStudent($studentStudent_id, $amountToRemove, $currencies, $currency) {
        try {
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
    
            
            $q = "UPDATE students SET owed_fees = owed_fees - ? WHERE student_id = ?";
    
            $this->db->query($q, [$amountInUSD, $studentStudent_id]);
    
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                log_message('error', 'Database error: Update operation failed');
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
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
        try {
            $q = "UPDATE students SET owed_fees = owed_fees + ? WHERE student_id = ?";
    
            $this->db->query($q, [$amountToAdd, $studentStudent_id]);
    
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                log_message('error', 'Database error: Update operation failed');
                return false; // Return false to indicate a database error
            }
        } catch (Exception $e) {
            log_message('error', 'An error occurred: ' . $e->getMessage());
            return false; // Return false to indicate a general error
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
     * Get the last student ID for a specific month and year.
     *
     * @param string $monthYear The month and year combined (e.g., "2309" for September 2023).
     * @return string|null The last student ID or null if none is found.
     */
    public function getLastStudentIdForMonth($monthYear) {
        
        // Construct the LIKE condition without the CodeIgniter like function
        $likeCondition = "student_id LIKE 'TAB{$monthYear}%'";
    
        // Generate the SQL query with a custom WHERE clause
        $sql = "SELECT student_id FROM students WHERE $likeCondition ORDER BY student_id DESC LIMIT 1";
    
        // Execute the SQL query
        $query = $this->db->query($sql);
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->student_id;

        } else {  
            return null;

        }
        
    }
    
    

    

    
    
}



