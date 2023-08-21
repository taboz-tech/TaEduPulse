<?php
defined('BASEPATH') OR exit('');

use Dompdf\Dompdf;

/**
 * Report Controller
 */
class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transaction'); // Load the Transaction model
        $this->load->library('dompdf'); // Load the Dompdf library
    }

    public function index() {
        $reports = $this->loadReportsFromFolder(); // Load existing reports from the folder

        $data['reports'] = $reports;

        // Load the view to display existing reports and generate a new report
        $this->load->view('reports/reports', $data);
    }

    public function generate() {
        // Generate new report content (similar to the previous example)
        $transactions = $this->Transaction->getAll('transId', 'ASC', 0, '');

        $data['transactions'] = $transactions;

        $html = $this->load->view('report/report_view', $data, TRUE);

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $filename = 'transactions_report_' . date('YmdHis') . '.pdf';

        $pdf->stream($filename, array('Attachment' => 0));
    }

    private function loadReportsFromFolder() {
        $reportPath = FCPATH . 'reports'; // Use the 'reports' folder in your project directory
        $reports = array();

        // Scan the folder for PDF files
        $files = scandir($reportPath);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                $reports[] = $file;
            }
        }

        return $reports;
    }
}
