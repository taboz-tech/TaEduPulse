<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Incomes
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 14 August, 2023
 */
class Incomes extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['income']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('incomes/incomes', '', TRUE);
        $data['pageTitle'] = "Incomes";

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
     * "lilt" = "load Incomes List Table"
     */
    public function lilt(){
       
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of Incomes in db
        $totalIncomes = $this->db->count_all('incomes');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalIncomes, "incomes/lilt", $limit, ['onclick'=>'return lilt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all Incomes from db
        $data['allIncomes'] = $this->income->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalIncomes > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allIncomes'])) . " of " . $totalIncomes : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['incomesListTable'] = $this->load->view('incomes/incomeslisttable', $data, TRUE);//get view with populated incomes table
        

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

        $this->form_validation->set_rules('incomeName','Income Name',['required', 'trim', 'max_length[30]', 'is_unique[incomes.name]'],['required' => 'The %s field is required.', 'is_unique' => 'An income with this name already exists.']); 
        $this->form_validation->set_rules('incomeAmount', 'Income Amount', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        $this->form_validation->set_rules('incomeDescription', 'Income Description', ['required', 'trim', 'max_length[50]'],['required' => 'The %s field is required.']);
        $this->form_validation->set_rules('incomeCurrency', 'Income Currency', ['required', 'trim', 'max_length[15]'],['required' => 'The %s field is required.']);
       
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($incomeName, $incomeAmount, $incomeDescription, $incomeCurrency)
             */

            $insertedId = $this->income->add(set_value('incomeName'), set_value('incomeAmount'), 
                    set_value('incomeDescription'), set_value('incomeCurrency'));
            
            $incomeName = set_value('incomeName');
            $incomeAmount = set_value('incomeAmount');
            $incomeCurrency = set_value('incomeCurrency');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$incomeName} as a new Income with  Amount '{$incomeAmount}' and Currency '{$incomeCurrency}' to the Incomes.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Income", $insertedId, $desc, "incomes", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status'=>1, 'msg'=>"Income successfully added"] 
                    : 
                    ['status'=>0, 'msg'=>"Oops! Unexpected server error! Please contact administrator for help. Sorry for the embarrassment"];
        }
        
        else{
            //return all error messages
            $json = $this->form_validation->error_array();//get an array of all errors
            
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
    // edit these details ($incomeId, $incomeName, $incomeAmount, $incomeCategory, $incomeDescription,$incomeCurrency)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
    

        $this->form_validation->set_rules('_iId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('incomeName', 'Income Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('incomeAmount', 'Income Amount', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        $this->form_validation->set_rules('incomeDescription', 'Income Description', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        $this->form_validation->set_rules('incomeCurrency','Income Currency',['required','trim','max_length[15]'],['required'=>'required']);
        

        if($this->form_validation->run() !== FALSE){
            $incomeId = set_value('_iId');
            $incomeName = set_value('incomeName');
            $incomeAmount = set_value('incomeAmount');
            $incomeDescription = set_value('incomeDescription');
            $incomeCurrency = set_value('incomeCurrency');

           
            //update Income in db
            $updated = $this->income->edit($incomeId, $incomeName, $incomeAmount,$incomeDescription,$incomeCurrency);
            
            $json['status'] = $updated ? 1 : 0;
            
            //add event to log
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Details of Income with  Name '$incomeName' was updated";
            
            $this->genmod->addevent("Income Update", $incomeId, $desc, 'incomes', $this->session->admin_id);
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
    
    public function delete(){
        $this->genlib->ajaxOnly();
        
        $json['status'] = 0;
        $incomeId = $this->input->post('i', TRUE);
        
        // Add conditions to prevent deletion of specific incomes by name
        $incomesToPreserve = ['Fees', 'Reg_fee','Centre_Fee','Subject_Fee','Fees Olevel','Fees Alevel','Fees ZJC']; // Names of Incomes to be preserved
        
        // Retrieve the income name based on the ID
        $incomeInfo = $this->income->getIncomeInfo(['id' => $incomeId], ['name']);
        
        if ($incomeId && $incomeInfo) {
            $incomeName = $incomeInfo->name;
            
            // Check if the income name is in the list of incomes to be preserved
            if (in_array($incomeName, $incomesToPreserve)) {
                $json['error'] = "Income '$incomeName' cannot be deleted.";
            } else {
                // Delete the income if it's not in the list of incomes to be preserved
                $this->db->where('id', $incomeId)->delete('incomes');
                $json['status'] = 1;
            }
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function getCurrenciesForSelect(){
        $this->genlib->ajaxOnly();
    
        $orderBy = 'name'; // Order Currencies  by name
        $orderFormat = 'ASC';
    
        $this->load->model(['currency']); // Load the Currencies model
    
        // Call the getAll function from the Currency model to fetch Currencies 
        $currencies = $this->currency->getAll($orderBy, $orderFormat);
    
        if ($currencies !== FALSE) {
            $json['status'] = 1;
            $json['currencies'] = $currencies; // Return the list of Currencies 
        } else {
            $json['status'] = 0;
            $json['message'] = "No Currencies found.";
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /**
     * Fetches information about the "Fees" and "Reg_fee" incomes and returns their amounts as a JSON response.
     *
     * This method retrieves income data for the income types with the names "Fees" and "Reg_fee" from the database
     * and returns their amounts as a JSON response. It uses the 'income' model to query the database and retrieve
     * the necessary information.
     *
     * @throws Exception If any of the incomes is not found, an exception is thrown with a detailed message.
     *
     * @return void
     */
    public function getIncomes() {
        try {
            // Define the names of the fees you want to retrieve
            $feeNames = ['Fees ZJC', 'Reg_fee', 'Fees Olevel', 'Fees Alevel'];
    
            // Initialize an array to store the fee name and amount pairs
            $feeData = [];
    
            // Use your 'income' model to fetch the income information for each fee
            foreach ($feeNames as $feeName) {
                $whereClause = ['name' => $feeName];
                $fieldsToFetch = ['name', 'amount'];
                $incomeInfo = $this->income->getIncomeInfo($whereClause, $fieldsToFetch);
    
                if ($incomeInfo !== FALSE) {
                    // Add the name and amount to the $feeData array
                    $feeData[] = [
                        'name' => $incomeInfo->name,
                        'amount' => $incomeInfo->amount
                    ];
                } else {
                    throw new Exception('Income not found for ' . $feeName);
                }
            }
    
            $response = [
                'status' => 1,
                'feeData' => $feeData
            ];
    
            // Return the response as JSON
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } catch (Exception $e) {
            $errorResponse = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
    
            // Return the error response as JSON
            $this->output->set_content_type('application/json')->set_output(json_encode($errorResponse));
        }
    }
    



}