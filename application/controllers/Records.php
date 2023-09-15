<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Records
 * @date 25 August, 2023
 */
class Records extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->genlib->checkLogin();

        // Load the Record model
        $this->load->model('Record');
    }
    
    public function index(){
        $data['pageContent'] = $this->load->view('records/records', '', TRUE);
        $data['pageTitle'] = "Records";

        $this->load->view('main', $data);
    }

    public function lrlt() {
        $this->genlib->ajaxOnly();
        
        $this->load->helper('text');
        
        // Set the sort order
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";


        $totalReports =  $this->Record->countReportFiles();
        

        $this->load->library('pagination');

        $pageNumber = $this->uri->segment(3, 0); // Set page number to zero if not set in the URI

        // Get the limit from the input or use a default value
        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit; // Start from 0 if pageNumber is 0, else start from the next iteration

        // Call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalReports, "records/lrlt", $limit, ['onclick' => 'return lrlt(this.href);']);
       
        $this->pagination->initialize($config); // Initialize the pagination library

        // Get a list of report files
        $data['allReports'] = $this->Record->getReportFiles($orderFormat, $start, $limit);

        $data['range'] = $totalReports > 0 ? "Showing " . ($start + 1) . "-" . ($start + count($data['allReports'])) . " of " . $totalReports : "";
        $data['links'] = $this->pagination->create_links(); // Page links
        $data['sn'] = $start + 1;
        
        $json['reportsListTable'] = $this->load->view('records/recordslisttable', $data, TRUE); // Get view with populated reports table
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    


    // Add other methods here

}
