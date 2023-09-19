<?php
defined('BASEPATH') OR exit('');

class Record extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Count the number of report files in the specified directory
     *
     * @return int Number of report files
     */
    public function countReportFiles() {
        $reportsPath = '/var/www/html/TabnEduPulse/reports/';
        
        // Get a list of all report files
        $reportFiles = glob($reportsPath . '*', GLOB_BRACE);
        
        // Count the number of report files
        $numReportFiles = count($reportFiles);
        
        return $numReportFiles;
    }


    /**
     * Get the list of report files from the specified directory
     *
     * @return array List of report files with download links
     */
    public function getReportFiles($orderFormat, $start, $limit) {
        $reportsPath = '/var/www/html/TabnEduPulse/reports/';
    
        // Get a list of report files matching a pattern
        $reportFiles = glob($reportsPath . '*', GLOB_BRACE);
    
        // Sort the report files based on the provided order format
        usort($reportFiles, function ($a, $b) use ($orderFormat) {
            if ($orderFormat === 'ASC') {
                return strcmp($a, $b);
            } else {
                return strcmp($b, $a);
            }
        });
    
        // Apply the limit and start index to the report files array
        $limitedReportFiles = array_slice($reportFiles, $start, $limit);
    
        // Generate download links for each report file
        $reportsWithDownloadLinks = [];
        foreach ($limitedReportFiles as $report) {
            $fileName = pathinfo($report, PATHINFO_FILENAME) . '.' . pathinfo($report, PATHINFO_EXTENSION);
            $downloadLink = base_url() . 'reports/' . urlencode($fileName); // Adjust the path here
            $reportsWithDownloadLinks[] = [
                'file_name' => $fileName,
                'download_link' => $downloadLink,
            ];
        }
    
        return $reportsWithDownloadLinks;
    }
    

    
    /**
     * Search for report files in the specified directory based on a search term
     *
     * @param string $searchTerm The search term
     * @return array List of report files matching the search term
     */
    public function searchReportFiles($searchTerm) {
        $reportsPath = '/var/www/html/TabnEduPulse/reports/';
    
        // Get a list of report files matching the search term
        $matchingReportFiles = array_filter(glob($reportsPath . '*' . $searchTerm . '*', GLOB_BRACE), 'is_file');
    
        // Initialize an array to store matching reports
        $matchingReports = [];
    
        // Generate download links for each matching report file
        foreach ($matchingReportFiles as $report) {
            $fileName = pathinfo($report, PATHINFO_FILENAME);
            $recordExtension = pathinfo($report, PATHINFO_EXTENSION);
            $recordPath = base_url() . 'reports/' . urlencode($fileName . '.' . $recordExtension); // Adjust the path here
    
            // Add each matching record to the response array
            $matchingReports[] = [
                'file_name' => $fileName,
                'download_link' => $recordPath,
            ];
        }
    
        return $matchingReports;
    }
    

}
