<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Costs
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 14 August, 2023
 */
class Costs extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['cost']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('costs/costs', '', TRUE);
        $data['pageTitle'] = "Costs";

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
     * "lclt" = "load Cost List Table"
     */
    public function lclt(){
       
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of Costs in db
        $totalCosts = $this->db->count_all('costs');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalCosts, "costs/lclt", $limit, ['onclick'=>'return lclt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all Costs from db
        $data['allCosts'] = $this->cost->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalCosts > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allCosts'])) . " of " . $totalCosts : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['costsListTable'] = $this->load->view('costs/costslisttable', $data, TRUE);//get view with populated costs table
        

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
    
        try {
            // Validation rules
            $this->form_validation->set_rules('costName', 'Cost Name', ['required', 'trim', 'max_length[30]', 'is_unique[costs.name]'], ['required' => 'The %s field is required.', 'is_unique' => 'A cost with this name already exists.']);
            $this->form_validation->set_rules('costAmount', 'Cost Amount', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.', 'greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
            $this->form_validation->set_rules('costCategory', 'Cost Category', ['required', 'trim', 'max_length[20]'], ['required' => 'The %s field is required.']);
            $this->form_validation->set_rules('costDescription', 'Cost Description', ['required', 'trim', 'max_length[50]'], ['required' => 'The %s field is required.']);
            $this->form_validation->set_rules('costCurrency', 'Cost Currency', ['required', 'trim', 'max_length[15]'], ['required' => 'The %s field is required.']);
    
            if ($this->form_validation->run() === FALSE) {
                // Validation failed
                $json = [
                    'status' => 0,
                    'msg' => 'Validation error',
                    'errors' => [
                        'costName' => form_error('costName'),
                        'costAmount' => form_error('costAmount'),
                        'costCategory' => form_error('costCategory'),
                        'costDescription' => form_error('costDescription'),
                        'costCurrency' => form_error('costCurrency'),
                    ]
                ];
            } else {
                // Validation passed, proceed to insert
                $this->db->trans_start(); // Start transaction
    
                $costName = set_value('costName');
                $costAmount = set_value('costAmount');
                $costCategory = set_value('costCategory');
                $costCurrency = set_value('costCurrency');
    
                // Insert info into the database
                $insertedId = $this->cost->add($costName, $costAmount, $costCategory, set_value('costDescription'), $costCurrency, set_value('costStatus'), set_value('costBalance'), set_value('costPaid'));
    
                // Insert into event log
                $desc = "Addition of {$costName} as a new Cost with Amount '{$costAmount}', Currency '{$costCurrency}' and Category '{$costCategory}' to the Costs.";
                $insertedId ? $this->genmod->addevent("Creation of new Cost", $insertedId, $desc, "costs", $this->session->admin_id) : "";
    
                $this->db->trans_complete();
    
                if ($this->db->trans_status() !== FALSE) {
                    // Transaction successful
                    $json = ['status' => 1, 'msg' => 'Cost successfully added'];
                } else {
                    // Transaction failed
                    $json = ['status' => 0, 'msg' => 'Oops! Unexpected server error! Please contact administrator for help. Sorry for the embarrassment'];
                }
            }
        } catch (Exception $e) {
            // Log any exceptions
            log_message('error', 'Exception: ' . $e->getMessage());
            $json = ['status' => 0, 'msg' => 'An unexpected error occurred. Please contact the administrator.'];
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
    // edit these details ($costId, $costName, $costAmount, $costCategory, $costDescription,$costCurrency)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');
    
        $this->form_validation->set_error_delimiters('', '');
    
        $this->form_validation->set_rules('_cId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('costName', 'Cost Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('costAmount', 'Cost Amount', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
        $this->form_validation->set_rules('costCategory', 'Cost Category', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('costDescription', 'Cost Description', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
        $this->form_validation->set_rules('costCurrency','Cost Currency',['required','trim','max_length[15]'],['required'=>'required']);
    
        if($this->form_validation->run() !== FALSE){
            $costId = set_value('_cId');
            $costName = set_value('costName');
            $costAmount = set_value('costAmount');
            $costCategory = set_value('costCategory');
            $costDescription = set_value('costDescription');
            $costCurrency = set_value('costCurrency');
    
            $oldAmount = $this->genmod->gettablecol('costs', 'amount', 'id', $costId);
            $oldBalance = $this->genmod->gettablecol('costs', 'balance', 'id', $costId);
            $paid = $this->genmod->gettablecol('costs', 'paid', 'id', $costId);
            $change = $costAmount - $oldAmount;
            $newBalance = $oldBalance + $change;
            
    
            // Check if the new amount is greater than or equal to the paid amount
            if ($costAmount >= $paid) {
                // Update Cost in db
                $updated = $this->cost->edit($costId, $costName, $costAmount, $costCategory, $costDescription, $costCurrency, $newBalance);
                
                $json['status'] = $updated ? 1 : 0;
                
                // Add event to log
                $desc = "Details of Cost with Name '$costName' was updated";
                
                $this->genmod->addevent("Cost Update", $costId, $desc, 'costs', $this->session->admin_id);
            } else {
                $json['status'] = 0;
                $json['message'] = 'The Cost Amount cannot be less than the Paid Amount.';
            }
        } else {
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
    
    
    public function delete() {
        $this->genlib->ajaxOnly();
        
        $json['status'] = 0;
        $costId = $this->input->post('i', TRUE);
        
        if ($costId) {
            try {
                // Get the name of the cost before deleting it
                $cost = $this->cost->getCostInfo(['id' => $costId], ['name']);
                
                if (!$cost) {
                    throw new Exception('Cost not found');
                }
                
                $costName = $cost->name;
                
                // Check if the cost name does not contain "salary" (case-insensitive)
                if (stripos($costName, 'salary') === false) {
                    
                    $this->db->where('id', $costId)->delete('costs');
                    $json['status'] = 1;

                } else {
                    // Cost contains "salary," inform the user it's a system cost
                    $json['error'] = 'You cannot delete system costs.';
                }
            } catch (Exception $e) {
                // Handle any exceptions here, such as logging the error
                log_message('error', 'An error occurred: ' . $e->getMessage());
                $json['error'] = 'An error occurred while deleting the cost.';
            }
        }
        
        // Set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function getCategoriesForSelect(){
        $this->genlib->ajaxOnly();
    
        $orderBy = 'name'; // Order Categoriess by name
        $orderFormat = 'ASC';
    
        $this->load->model(['category']); // Load the Categories model
    
        // Call the getAll function from the Categories model to fetch Categoriess
        $categories = $this->category->getAll($orderBy, $orderFormat);
    
        if ($categories !== FALSE) {
            $json['status'] = 1;
            $json['categories'] = $categories; // Return the list of Categoriess
        } else {
            $json['status'] = 0;
            $json['message'] = "No Categories found.";
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

    public function getCurrenciesForSelect(){
        $this->genlib->ajaxOnly();
    
        $orderBy = 'name'; // Order Categories by name
        $orderFormat = 'ASC';
    
        $this->load->model(['currency']); // Load the Categorie model
    
        // Call the getAll function from the Categorie model to fetch Categories
        $currencies = $this->currency->getAll($orderBy, $orderFormat);
    
        if ($currencies !== FALSE) {
            $json['status'] = 1;
            $json['currencies'] = $currencies; // Return the list of Categories
        } else {
            $json['status'] = 0;
            $json['message'] = "No Currencies found.";
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
    public function payCost(){
        $this->genlib->ajaxOnly();
    
        $costId = $this->input->post('costId', TRUE);
        $paymentAmount = $this->input->post('paymentAmount', TRUE);
        
        $costName = $this->genmod->getTableCol('costs', 'name', 'id', $costId);
        
        try {
            // Attempt to pay the cost
            $paid = $this->cost->payCost($costId, $paymentAmount);
    
            if ($paid) {
                // Payment was successful
                $json['status'] = 1;
    
                // Log the successful payment
                $desc = "Cost with Name '$costName' was paid by amount '$paymentAmount'";
                $this->genmod->addevent("Cost Update", $costId, $desc, 'costs', $this->session->admin_id);
            } else {
                // Payment failed
                $json['status'] = 0;
            }
        } catch (Exception $e) {
            // Handle the exception
            log_message('error', 'Payment Error: ' . $e->getMessage()); // Log the error
    
            // Provide an error response to JavaScript
            $json['status'] = 0;
            $json['error'] = 'An error occurred while processing the payment.';
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($json));

    }
    

    
}