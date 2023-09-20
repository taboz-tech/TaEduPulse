<?php
defined('BASEPATH') OR exit('');

/**
 * model for Currencies
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 9 September, 2023
 */
class Examination extends CI_Model{
    public function __construct(){
        parent::__construct();
    }


    public function getStudentsWithSubjects($orderBy, $orderFormat, $start = 0, $limit = '', $selectedClassId = '') {
        try {
            $this->db->limit($limit, $start);
            $this->db->order_by($orderBy, $orderFormat);
    
            $this->db->select('students.id, students.student_id, students.name, students.surname, grades.name AS class_name, exams_reg.zimsec_reg_num AS zimsec_registration_number');
            $this->db->select('GROUP_CONCAT(subjects.name) AS subjects', false); // Use false to prevent CI from adding backticks
    
            $this->db->from('students');
            $this->db->join('exams_reg', 'students.id = exams_reg.student_id', 'left');
            $this->db->join('grades', 'students.class_name = grades.id');
            $this->db->join('reg_subjects', 'exams_reg.id = reg_subjects.reg_id', 'left');
            $this->db->join('subjects', 'reg_subjects.subject_id = subjects.id', 'left');
    
            if (!empty($selectedClassId)) {
                // If a specific class ID is provided, filter by that class
                $this->db->where("students.class_name", $selectedClassId);
            } else {
                // If no specific class ID is provided, apply your other conditions here
                $this->db->where("grades.name LIKE '%Form 4%' OR grades.name LIKE '%Form 6%'");
            }
    
            $this->db->group_by('students.id, students.student_id, students.name, students.surname, grades.name, exams_reg.zimsec_reg_num');
    
            $query = $this->db->get();
    
            if ($query) {
                return $query->result();
            } else {
                // Log the error
                log_message('error', 'Database query error in getStudentsWithSubjects method.');
                throw new Exception('Database query error');
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Exception in getStudentsWithSubjects method: ' . $e->getMessage());
            return false;
        }
    }
    

    public function countExamStuds() {
        try {
            $this->db->from('students');
            $this->db->join('grades', 'students.class_name = grades.id');
            $this->db->where("grades.name LIKE '%Form 4%' OR grades.name LIKE '%Form 6%'");

            return $this->db->count_all_results();
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Exception in countexamStuds method: ' . $e->getMessage());
            return false;
        }
    }

    public function countExamStudsByClass($selectedClass) {
        try {
            // Count students in the selected class ("Form 4" or "Form 6")
            $this->db->from('students');
            $this->db->where("class_name", $selectedClass);

            return $this->db->count_all_results();
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Exception in countExamStudsByClass method: ' . $e->getMessage());
            return false;
        }
    }

    public function getGradesByFormName() {
        try {
            // Define the condition to select grades with names like 'Form 4' or 'Form 6'
            $this->db->like('name', 'Form 4', 'both');
            $this->db->or_like('name', 'Form 6', 'both');
    
            // Get grades from the 'grades' table
            $query = $this->db->get('grades');
    
            if ($query) {
                return $query->result();
            } else {
                // Log the error
                log_message('error', 'Database query error in getGradesByFormName method.');
                throw new Exception('Database query error');
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Exception in getGradesByFormName method: ' . $e->getMessage());
            return false;
        }
    }

    public function searchStudents($searchText, $selectedClassId = '') {
        try {
            $this->db->select('students.id, students.student_id, students.name, students.surname, grades.name AS class_name, exams_reg.zimsec_reg_num AS zimsec_registration_number');
            $this->db->select('GROUP_CONCAT(subjects.name) AS subjects', false); // Use false to prevent CI from adding backticks
    
            $this->db->from('students');
            $this->db->join('exams_reg', 'students.id = exams_reg.student_id', 'left');
            $this->db->join('grades', 'students.class_name = grades.id');
            $this->db->join('reg_subjects', 'exams_reg.id = reg_subjects.reg_id', 'left');
            $this->db->join('subjects', 'reg_subjects.subject_id = subjects.id', 'left');
    
            // Add search conditions for name and surname
            $this->db->group_start(); // Group the following conditions together
            $this->db->like('students.name', $searchText);
            $this->db->or_like('students.surname', $searchText);
            $this->db->group_end(); // End the group
    
            // Add condition to filter by selected class if provided
            if (!empty($selectedClassId)) {
                $this->db->where('students.class_name', $selectedClassId);
            }
    
            $this->db->group_by('students.id, students.student_id, students.name, students.surname, grades.name, exams_reg.zimsec_reg_num');
    
            $query = $this->db->get();
    
            if ($query) {
                return $query->result();
            } else {
                // Log the error
                log_message('error', 'Database query error in searchStudents method.');
                throw new Exception('Database query error');
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Exception in searchStudents method: ' . $e->getMessage());
            return false;
        }
        
    }

    public function getStudentNameAndSurnameById($studentId) {
        try {

            $this->db->select('name, surname');
            $this->db->where('id', $studentId);
            $query = $this->db->get('students');
    
            if ($query && $query->num_rows() > 0) {
                return $query->row(); // Return the result as an object
            } else {
                // Student not found
                return false;
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Exception in getStudentNameAndSurnameById method: ' . $e->getMessage());
            return false;
        }
    }
    

    public function getAllSubjects() {
        try {
            $this->db->select('id, name');
            
            $query = $this->db->get('subjects');
    
            if ($query) {
                return $query->result(); 
            } else {
                // Log the error
                log_message('error', 'Database query error in getAllSubjects method.');
                throw new Exception('Database query error');
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Exception in getAllSubjects method: ' . $e->getMessage());
            return false;
        }
    }
 
    public function insertRegistration($studentId, $zimsecRegNumber, $paymentStatus, $paymentTransId, $regStatus) {
        // Create the data array for insertion
        $data = array(
            'student_id' => $studentId,
            'zimsec_reg_num' => $zimsecRegNumber,
            'payment_status' => $paymentStatus,
            'payment_trans_id' => $paymentTransId,
            'reg_status' => $regStatus,
            'reg_date' => date('Y-m-d H:i:s'), // Current date and time
        );
    
        // Insert the data into the "exams_reg" table
        $this->db->insert('exams_reg', $data);
    
        // Check if the insertion was successful
        if ($this->db->affected_rows() > 0) {
            return true; 
        } else {
            return false; 
        }
    }


    public function isZimsecRegNumberUnique($zimsecRegNumber) {

        $this->db->select('zimsec_reg_num');
        $this->db->from('exams_reg');
        $this->db->where('zimsec_reg_num', $zimsecRegNumber);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }   

    public function getIncomeByName($name) {
        $this->db->select('name, amount');
        $this->db->where('name', $name);
        $query = $this->db->get('incomes');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; 
        }
    }

    public function getStudentInfoById($studentId)
    {
        $this->db->select('name, surname, class_name, student_id'); 
        $this->db->from('students'); 
        $this->db->where('id', $studentId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function insertRegSubject($registrationId, $subjectId) {
        try {
            $data = array(
                'reg_id' => $registrationId,
                'subject_id' => $subjectId,
            );
    
            $this->db->insert('reg_subjects', $data);
    
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                throw new Exception('Failed to insert subject into registration.');
            }
        } catch (Exception $e) {
            log_message('error', 'Error in insertRegSubject: ' . $e->getMessage());
            return false;
        }
    }

    public function getStudentInfoWithSubjects($student_id) {
        $this->db->select('students.name, students.surname, exams_reg.id, exams_reg.zimsec_reg_num');
        $this->db->select('GROUP_CONCAT(subjects.name) AS subjects', FALSE);
        $this->db->from('exams_reg');
        $this->db->join('students', 'exams_reg.student_id = students.id');
        $this->db->join('reg_subjects', 'exams_reg.id = reg_subjects.reg_id', 'left');
        $this->db->join('subjects', 'reg_subjects.subject_id = subjects.id', 'left'); // Join the subjects table
        $this->db->where('exams_reg.student_id', $student_id);
        $this->db->group_by('students.name, students.surname, exams_reg.id, exams_reg.zimsec_reg_num');
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function delete($examsRegId) {
        try {
            // Check if the record exists
            $this->db->where('id', $examsRegId);
            $query = $this->db->get('exams_reg');
    
            if ($query->num_rows() > 0) {
                // Record found, proceed with deletion
                $this->db->where('id', $examsRegId);
                $this->db->delete('exams_reg');
    
                if ($this->db->affected_rows() > 0) {
                    return true; // Deletion successful
                } else {
                    throw new Exception('Failed to delete record.');
                }
            } else {
                // Record not found
                return false;
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log it or return an error message)
            log_message('error', 'Error in delete method: ' . $e->getMessage());
            return false;
        }
    }
    

    
}