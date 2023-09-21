<?php
defined('BASEPATH') OR exit('');

class Cala extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all subjects and their IDs from the subjects table.
     *
     * @return array List of subjects with their IDs.
     */
    public function getSubjects() {
        try {
            $this->db->select('id, name');
            
            $this->db->from('subjects');
            
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        } catch (Exception $e) {

            log_message('error', 'Error in getSubjects: ' . $e->getMessage());
            return false; 
        }
    }

    /**
     * Get student data filtered by class and subject.
     *
     * @param string $class_name The class name to filter students.
     * @param string $subject_name The subject name to filter students.
     * @return array|bool Student data matching the criteria or false if there's an error.
     */
    public function getStudentData($class_name, $subject_id) {
        try {
            $this->db->select('students.student_id, students.name as student_name, students.surname, subjects.name as subject_name, student_subject_marks.*');
            $this->db->from('student_subject_marks');
            $this->db->join('students', 'student_subject_marks.student_id = students.id', 'left');
            $this->db->join('subjects', 'student_subject_marks.subject_id = subjects.id', 'left');
            $this->db->where('subjects.id', $subject_id);
            $this->db->where('students.class_name', $class_name);
    
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Handle exceptions here and log or return an appropriate error message
            log_message('error', 'Error in getStudentData method: ' . $e->getMessage());
            return false;
        }
    }
        
    


    /**
     * Create missing data in student_subject_marks if it doesn't tally with students.
     *
     * @param string $class_name The class name to filter students.
     * @return bool True if data creation is successful or no missing data, false otherwise.
     */
    public function createMissingStudentSubjectMarks($class_name) {
        try {
            // Find distinct students in student_subject_marks
            $this->db->select('DISTINCT(student_id)');
            $this->db->from('student_subject_marks');
            $this->db->where('grade_id', $class_name);
            $distinct_students_student_subject_marks = $this->db->get()->result_array();

            // Find distinct students in students table
            $this->db->select('DISTINCT(id)');
            $this->db->from('students');
            $this->db->where('class_name', $class_name);
            $distinct_students_students = $this->db->get()->result_array();

            // Check if counts match
            if (count($distinct_students_student_subject_marks) !== count($distinct_students_students)) {
                // Find missing students
                $this->db->select('students.id as student_id, subjects.id as subject_id');
                $this->db->from('students');
                $this->db->join('subjects', '1=1', 'cross'); // Create a cross join to get all combinations
                $this->db->where('students.class_name', $class_name);
                $this->db->where_not_in(
                    'students.id',
                    "SELECT DISTINCT(student_id) FROM student_subject_marks WHERE grade_id = '$class_name'"
                );
                $missing_students = $this->db->get()->result();

                // Insert missing data into student_subject_marks
                foreach ($missing_students as $student) {
                    $data = array(
                        'student_id' => $student->student_id,
                        'subject_id' => $student->subject_id,
                        'componentA' => 0.00, // You can set default values for components
                        'componentB' => 0.00,
                        'componentC' => 0.00,
                        'componentD' => 0.00,
                        'componentE' => 0.00,
                        'average'=>0.00,
                        'grade_id' => $class_name // Set grade_id to class_name
                    );
                    $this->db->insert('student_subject_marks', $data);
                }
            }

            return true; // Data creation is successful or no missing data
        } catch (Exception $e) {
            // Handle exceptions here and log or return an appropriate error message
            log_message('error', 'Error in createMissingStudentSubjectMarks method: ' . $e->getMessage());
            return false; // Error occurred while creating missing data
        }
    }

    public function updateMarks($id, $componentA, $componentB, $componentC, $componentD, $componentE,$average) {
        try {
            $data = array(
                'componentA' => $componentA,
                'componentB' => $componentB,
                'componentC' => $componentC,
                'componentD' => $componentD,
                'componentE' => $componentE,
                'average' => $average
            );
    
            $this->db->where('id', $id);
    
            $this->db->update('student_subject_marks', $data);
    
            if ($this->db->affected_rows() > 0) {
                return true; // Update successful
            } else {
                return false; // No rows updated (record not found)
            }
        } catch (Exception $e) {
            // Handle exceptions here and log or return an appropriate error message
            log_message('error', 'Error in updateMarks method: ' . $e->getMessage());
            return false; // Error occurred while updating
        }
    }
    




}
