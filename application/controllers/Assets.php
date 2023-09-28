<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Assets
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 13 August, 2023
 */
class Assets extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['asset']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('assets/assets', '', TRUE);
        $data['pageTitle'] = "Assets";

        $this->load->view('main', $data);
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
     * "lalt" = "load Assets List Table"
     */
    public function lalt(){
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of assets in db
        $totalAssets = $this->db->count_all('assets');
    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalAssets, "assets/lalt", $limit, ['onclick'=>'return lalt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library grade
        
        //get all grades from db
        $data['allassets'] = $this->asset->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalAssets > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allassets'])) . " of " . $totalAssets : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
           
        $json['assetsListTable'] = $this->load->view('assets/assetslisttable', $data, TRUE);//get view with populated assets table
        

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    } 

    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    

    
    
    
    public function add(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        
        // Load the form validation library (if not already loaded)
        $this->load->library('form_validation');

        // Define form validation rules for assets
        $this->form_validation->set_rules('assetNumber', 'Asset Number', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('serialNumber', 'Serial Number', 'trim|max_length[30]');
        $this->form_validation->set_rules('location', 'Location', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('cost', 'Cost', 'required|trim|numeric');
        $this->form_validation->set_rules('depreciationMethod', 'Depreciation Method', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('depreciationRate', 'Depreciation Rate', 'required|trim|numeric');
        $this->form_validation->set_rules('owner', 'Owner', 'required|trim|max_length[30]');

                        
        if ($this->form_validation->run() !== FALSE) {
            $this->db->trans_start(); // Start transaction
            
            // Insert asset information into the database
            $insertedId = $this->asset->add(
                set_value('assetNumber'),
                set_value('description'),
                set_value('serialNumber'),
                set_value('location'),
                set_value('supplier'),
                set_value('cost'),
                set_value('depreciationMethod'),
                set_value('depreciationRate'),
                set_value('owner'),
                set_value('supplier')
            );
        
            // Check if the asset was successfully inserted
            if ($insertedId) {
                // Asset information for the event log
                $assetDescription = set_value('description');
                $assetNumber = set_value('assetNumber');
                $assetCost = set_value('cost');
                $supplier = set_value('supplier');
                
                // Create a description for the event log
                $eventDescription = "Addition of asset '$assetDescription' (Asset Number: '$assetNumber', Cost: $assetCost, Supplier: '$supplier') to the Assets.";
                
                // Insert the event into the event log
                $this->genmod->addevent("Creation of New Asset", $insertedId, $eventDescription, "assets", $this->session->admin_id);
        
                $this->db->trans_complete();
        
                $json = $this->db->trans_status() !== FALSE ?
                    ['status' => 1, 'msg' => "Asset successfully added"]
                    :
                    ['status' => 0, 'msg' => "Oops! Unexpected server error! Please contact the administrator for help. Sorry for the inconvenience"];
            } else {
                $json = ['status' => 0, 'msg' => "Failed to add the asset. Please check your input and try again."];
            }
        } else{
            // Return all error messages
            $json = $this->form_validation->error_array(); // Get an array of all errors
            
            $json['msg'] = "One or more required fields are empty or not correctly filled";
            $json['status'] = 0;
        }
                    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
       
    
   /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    // edit these details ($studentId, $studentName, $studentSurname, $studentGrade_name, $studentParent_name, $studentParent_phone,$studentFees)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        
        $this->form_validation->set_rules('_aId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('description', 'Description', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('serial_number', 'Serial Number', 'trim|max_length[30]');
        $this->form_validation->set_rules('location', 'Location', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('purchaseDate', 'Purchase Date', 'required|trim');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('cost', 'Cost', 'required|trim|numeric');
        $this->form_validation->set_rules('depreciationMethod', 'Depreciation Method', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('depreciationRate', 'Depreciation Rate', 'required|trim|numeric');
        $this->form_validation->set_rules('owner', 'Owner', 'required|trim|max_length[30]');

          
        if($this->form_validation->run() !== FALSE){
            $assetId = set_value('_aId');
            $description = set_value('description');
            $serialNumber = set_value('serial_number');
            $location = set_value('location');
            $purchaseDate = set_value('purchaseDate');
            $supplier = set_value('supplier');
            $cost = set_value('cost');
            $depreciationMethod = set_value('depreciationMethod');
            $depreciationRate = set_value('depreciationRate');
            $owner = set_value('owner');

           
            //update grade in db
            $updated = $this->asset->edit($assetId, $description, $serialNumber, $location, $purchaseDate, $supplier, $cost, $depreciationMethod, $depreciationRate, $owner);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of asset with Name '$description' was updated";
            
            $this->genmod->addevent("Asset Update", $assetId, $desc, 'assets', $this->session->admin_id);
        }
        
        else{
            $json['status'] = 0;
            $json = $this->form_validation->error_array();
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }




   /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
  
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function delete(){
        $this->genlib->ajaxOnly();
        
        $json['status'] = 0;
        $assetId = $this->input->post('i', TRUE);
        
        if($assetId){
            $this->db->where('id', $assetId)->delete('assets');
            
            $json['status'] = 1;
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /**
     * Get and display the last student ID for the current month or create a new one.
     * If a last student ID is found for the current month, it increments the last three digits by 1.
     * If no student ID is found, it creates a new student ID with "000" as the last three digits.
     */
    public function lastAssetNumberForMonth() {
        // Get the current month in YYMM format (e.g., "2209" for September 2022)
        $currentMonth = date('Ym');

        // Initialize JSON response with a status of 0
        $json['status'] = 0;

        try {
            // Call the model method to get the last student ID for the current month
            $lastAssetNumber = $this->asset->getAssetNumberForMonth($currentMonth);

            if ($lastAssetNumber !== null) {
                // Extract the last three digits and increment them
                $lastThreeDigits = substr($lastAssetNumber, -3);
                $newLastThreeDigits = str_pad((int)$lastThreeDigits + 1, 3, '0', STR_PAD_LEFT);

                // Generate the new Asset Number with "ASN" as the prefix
                $newAssetNumber = "ASN{$currentMonth}{$newLastThreeDigits}";

                // Set status to 1 to indicate success
                $json['status'] = 1;

                // Include the new student ID and added one in the response
                $json['message'] = "New Asset Number for {$currentMonth}: {$newAssetNumber}";
                $json['newAssetNumber'] = $newAssetNumber;
                $json['addedOne'] = $newLastThreeDigits;
            } else {
                // No asset number found for the current month, use "000" for the last three digits
                $newLastThreeDigits = "000";
                
                // Generate the new student ID with "TAB" as the prefix
                $newAssetNumber = "ASN{$currentMonth}{$newLastThreeDigits}";

                // Set status to 1 to indicate success
                $json['status'] = 1;

                // Include the new student ID in the response
                $json['message'] = "No Asset nummbers found for {$currentMonth}, creating a new one: {$newAssetNumber}";
                $json['newAssetNumber'] = $newAssetNumber;
            }
        } catch (Exception $e) {
            // Handle exceptions and set status to 0 with an error message
            $json['status'] = 0;
            $json['error'] = $e->getMessage();
        }

        // Encode the response as JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}