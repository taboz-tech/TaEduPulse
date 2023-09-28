<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Currencies
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 14 August, 2023
 */
class Currencies extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();
        
        $this->load->model(['currency']);
    }
    
    /**
     * 
     */
    public function index(){
        $data['pageContent'] = $this->load->view('currencies/currencies', '', TRUE);
        $data['pageTitle'] = "Currencies";

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
     * "lclt" = "load Currencies List Table"
     */
    public function lclt(){
       
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        
        //count the total number of Currencies in db
        $totalCurrencies = $this->db->count_all('currencies');

    
        $this->load->library('pagination');
        
        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri
        
	
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        
        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalCurrencies, "currencies/lclt", $limit, ['onclick'=>'return lclt(this.href);']);
        
        $this->pagination->initialize($config);//initialize the library class
        
        //get all Currencies from db
        $data['allCurrencies'] = $this->currency->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalCurrencies > 0 ? "Showing " . ($start+1) . "-" . ($start + count($data['allCurrencies'])) . " of " . $totalCurrencies : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;
        
        $json['currenciesListTable'] = $this->load->view('currencies/currencieslisttable', $data, TRUE);//get view with populated currencies table
        

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
    
        
        $this->form_validation->set_rules('currencieName','Currencie Name',['required', 'trim', 'max_length[30]', 'is_unique[currencies.name]'],['required' => 'The %s field is required.', 'is_unique' => 'A currency with this name already exists.']);
        
        $this->form_validation->set_rules('currencieRate', 'Currencie Rate', ['numeric', 'greater_than[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than' => 'The %s field must be greater than 0.']);
       
        if($this->form_validation->run() !== FALSE){
            $this->db->trans_start();//start transaction
            
            /**
             * insert info into db
             * function header: add($currencieName, $currencieRate)
             */
    
            $insertedId = $this->currency->add(set_value('currencieName'), set_value('currencieRate'));
            
            $currencieName = set_value('currencieName');
            $currencieRate = set_value('currencieRate');
            
            //insert into eventlog
            //function header: addevent($event, $eventRowId, $eventDesc, $eventTable, $staffId)
            $desc = "Addition of {$currencieName} with Rate {$currencieRate} as a new Currency to the Currencies.";
            
            $insertedId ? $this->genmod->addevent("Creation of new Currency", $insertedId, $desc, "currencies", $this->session->admin_id) : "";
            
            $this->db->trans_complete();
            
            $json = $this->db->trans_status() !== FALSE ? 
                    ['status'=>1, 'msg'=>"Currency successfully added"] 
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
    // edit these details ($currencieId, $currencieName,$currencieRate)
   
    public function edit(){
        $this->genlib->ajaxOnly();
        
        $this->load->library('form_validation');
    
        $this->form_validation->set_error_delimiters('', '');
    
        $this->form_validation->set_rules('_cId', '', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('currencieName', 'Currencie Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
        $this->form_validation->set_rules('currencieRate', 'Currencie Rate', ['numeric', 'greater_than[0]'], [
            'numeric' => 'The %s field must be a valid number.',
            'greater_than' => 'The %s field must be greater than 0.'
        ]);
    
        if($this->form_validation->run() !== FALSE){
            $currencieId = set_value('_cId');
            $currencieName = set_value('currencieName');
            $currencieRate = set_value('currencieRate');
    
            // Check if the rate is not equal to 0
            if ($currencieRate == 0) {
                $this->form_validation->set_message('greater_than', 'The Currencie Rate must be greater than 0.');
                $json['status'] = 0;
                $json['error'] = form_error('currencieRate'); // Get the custom error message for currencieRate
            } else {
                // Update Currency in db
                $updated = $this->currency->edit($currencieId, $currencieName, $currencieRate);
    
                $json['status'] = $updated ? 1 : 0;
            }
        } else {
            $json['status'] = 0;
            $json['errors'] = [
                'currencieName' => form_error('currencieName'),
                'currencieRate' => form_error('currencieRate')
            ];
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
        $currencieId = $this->input->post('i', TRUE);
        
        // Add conditions to prevent deletion of specific currencies by name
        $currenciesToPreserve = ['ZAR', 'ZWL', 'RTGS', 'USD']; // Names of currencies to be preserved
        
        // Retrieve the currency name based on the ID
        $currencyInfo = $this->currency->getCurrencieInfo(['id' => $currencieId], ['name']);
        
        if ($currencieId && $currencyInfo) {
            $currencyName = $currencyInfo->name;
            
            // Check if the currency name is in the list of currencies to be preserved
            if (in_array($currencyName, $currenciesToPreserve)) {
                $json['error'] = "Currency '$currencyName' cannot be deleted.";
            } else {
                // Delete the currency if it's not in the list of currencies to be preserved
                $this->db->where('id', $currencieId)->delete('currencies');
                $json['status'] = 1;
            }
        }
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
}