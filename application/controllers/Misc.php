<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Misc
 * Do not check login status in the constructor of this class and some functions are to be accessed even without logging in
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * date 17th Feb. 2023
 */
class Misc extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    
    public function totalEarnedToday(){
        $this->genlib->checkLogin();
        
        $this->genlib->ajaxOnly();
        
        $this->load->model('transaction');
        
        $total_earned_today = $this->transaction->totalEarnedToday();
        
        $json['totalEarnedToday'] = $total_earned_today ? number_format($total_earned_today, 2) : "0.00";
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
	
	
	
    /**
     * check if admin's session is still on
     */
    public function check_session_status(){
        if(isset($_SESSION['admin_id']) && ($_SESSION['admin_id'] !== false) && ($_SESSION['admin_id'] !== "")){
            $json['status'] = 1;
            
            //update user's last seen time
            //update_last_seen_time($id, $table_name)
            $this->genmod->update_last_seen_time($_SESSION['admin_id'], 'admin');
        }
        
        else{
            $json['status'] = 0;
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    public function dbmanagement(){
        $this->genlib->checkLogin();
        
        $this->genlib->superOnly();
        
        $data['pageContent'] = $this->load->view('dbbackup', '', TRUE);
        $data['pageTitle'] = "Database";
        
        $this->load->view('main', $data);
    }

   
    
    public function backupDb(){
        $this->genlib->checkLogin();
        $this->genlib->superOnly();
        
        // Load the database library
        $this->load->database();
        
        // Load the File Helper
        $this->load->helper('file');
        
        // Set the backup directory path
        $backup_dir = '/var/www/html/TaEduPulse/backup/';
        
        // Get a list of existing backup files
        $backup_files = glob($backup_dir . '*.sql');
        
        // If there are more than three backup files, remove the oldest ones
        if (count($backup_files) > 2) {
            // Sort backup files by modification time in ascending order
            array_multisort(
                array_map('filemtime', $backup_files),
                SORT_NUMERIC,
                SORT_ASC,
                $backup_files
            );
            
            // Determine the number of files to delete
            $files_to_delete = count($backup_files) - 2; // Keep the most recent three
            
            // Delete the oldest backup files
            for ($i = 0; $i < $files_to_delete; $i++) {
                unlink($backup_files[$i]);
            }
        }
        
        // Initialize the backup data
        $backup_data = '';
        
        // Get the list of tables in your database
        $tables = $this->db->list_tables();
        
        foreach ($tables as $table)
        {
            // Add table structure and data to the backup data
            $backup_data .= "DROP TABLE IF EXISTS $table;\n";
            $create_table_query = $this->db->query("SHOW CREATE TABLE $table")->row_array();
            $backup_data .= $create_table_query['Create Table'] . ";\n\n";
            
            $table_data = $this->db->get($table)->result_array();
            foreach ($table_data as $row)
            {
                // Remove addslashes, it's not needed
                // $row = array_map('addslashes', $row);
                
                // Escape data using CI's db class
                $row = $this->db->escape($row);
                
                $row_values = implode(",", $row);
                $backup_data .= "INSERT INTO $table VALUES ($row_values);\n";
            }
            
            $backup_data .= "\n"; // Add a blank line between tables
        }
        
        // Set the backup file path
        $backup_file = $backup_dir . 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
        
        // Write the backup data to the file
        if (write_file($backup_file, $backup_data))
        {
            // Load the download helper to force download the backup file
            $this->load->helper('download');
            
            // Set the backup file's name
            $filename = basename($backup_file);
            
            // Force download the backup file
            force_download($filename, file_get_contents($backup_file));
        }
        else
        {
            // Handle backup file write error
            $json['msg'] = "Failed to create a backup.";
            $json['status'] = 0;
        }
    }


    
    
    /**
     * 
     */
    public function importdb(){
        $this->genlib->checkLogin();
        
        $this->genlib->superOnly();
        
        //create a copy of the db file currently in the sqlite dir for keep in case something go wrong
        if(file_exists(BASEPATH."sqlite/1410inventory.sqlite")){
            copy(BASEPATH."sqlite/1410inventory.sqlite", BASEPATH."sqlite/backups/".time().".sqlite");
        }
        
        $config['upload_path'] = BASEPATH . "sqlite/";//db files are stored in the basepath
        $config['allowed_types'] = 'sqlite';
        $config['file_ext_tolower'] = TRUE;
        $config['file_name'] = "1410inventory.sqlite";
        $config['max_size'] = 2000;//in kb
        $config['overwrite'] = TRUE;//overwrite the previous file

        $this->load->library('upload', $config);//load CI's 'upload' library

        $this->upload->initialize($config, TRUE);

        if($this->upload->do_upload('dbfile') == FALSE){
            $json['msg'] = $this->upload->display_errors();
            $json['status'] = 0;
        }

        else{
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
