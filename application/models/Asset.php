<?php
defined('BASEPATH') OR exit('');

/**
 * Model for managing assets.
 *
 * @author Tavonga <mafuratavonga@gmail.com>
 * @date 08 August, 2023
 */
class Asset extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Get all assets with optional sorting and pagination.
     *
     * @param string $orderBy     The column to sort by.
     * @param string $orderFormat The sorting order (e.g., 'ASC' or 'DESC').
     * @param int    $start       The starting index for pagination.
     * @param int    $limit       The maximum number of results to retrieve.
     *
     * @return array|null An array of Asset objects or NULL if no results are found.
     */

    public function getAll($orderBy, $orderFormat, $start = 0, $limit = ''){ 
        $this->db->select('assets.*');
        $this->db->from('assets');
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);
        $this->db->group_by('assets.id');
    
        $run_q = $this->db->get();
    
        return $run_q->result();
    }
    

    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    /**
     * Add a new Asset to the database.
     *
     * @param string $assetNumber 
     * @param string $description
     * @param string $serialNumber
     * @param string $location
     * @param string $supplier
     * @param string $cost
     * @param string $depreciationMethod
     * @param string $depreciationRate
     * @param string $owner
     * @return int|bool The newly inserted Asset ID or FALSE on failure.
     */
    public function add($assetNumber,$description, $serialNumber, $location, $supplier, $cost, $depreciationMethod, $depreciationRate, $owner){
        $data = ['asset_number'=>$assetNumber, 'description'=>$description, 'serial_number'=>$serialNumber, 'location'=>$location,'supplier'=>$supplier, 'cost'=>$cost, 'depreciation_method'=>$depreciationMethod, 'depreciation_rate'=>$depreciationRate, 'owner'=>$owner];
                
        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" 
                ? 
        $this->db->set('purchase_date', "datetime('now')", FALSE) 
                : 
        $this->db->set('purchase_date', "NOW()", FALSE);
        
        $this->db->insert('assets', $data);
        
        if($this->db->insert_id()){
            return $this->db->insert_id();
        }
        
        else{
            return FALSE;
        }
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    /**
     * Search for assets by description supplier assetnumber owner location.
     *
     * @param string $value The search query.
     *
     * @return array|bool An array of matching asset objects or FALSE if no matches are found.
     */
    public function searchAssets($keyword) {
        try {
            $this->db->select('*');
            $this->db->from('assets');
            $this->db->group_start();
            $this->db->like('supplier', $keyword);
            $this->db->or_like('owner', $keyword);
            $this->db->or_like('description', $keyword);
            $this->db->or_like('asset_number', $keyword);
            $this->db->group_end();
            
            $query = $this->db->get();
            
            // Log the SQL query
            $sql = $this->db->last_query();
            log_message('error', 'SQL Query: ' . $sql);
            
            if ($query->num_rows() > 0) {
                // Log the search results
                $results = $query->result();
                log_message('error', 'Search Results: ' . print_r($results, true));
                return $results;
            } else {
                // Log when no results are found
                log_message('error', 'No results found for the search.');
                return array(); // Return an empty array if no results found.
            }
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in Asset_model: ' . $e->getMessage());
            
            // You can handle the error here as needed, e.g., return an error message or re-throw the exception.
            return array('error' => 'An error occurred while searching for assets.');
        }
    }
    
    
    
    
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
   
    /**
     * Edit an existing asset's information.
     *
     * @param int    $assetId
     * @param string $description
     * @param string $serialNumber
     * @param string $location
     * @param string $supplier
     * @param string $cost
     * @param string $depreciationMethod
     * @param string $depreciationRate
     * @param string $owner
     *
     * @return bool TRUE on successful update, otherwise FALSE.
     */

    public function edit($assetId, $description, $serialNumber, $location, $purchaseDate, $supplier, $cost, $depreciationMethod, $depreciationRate, $owner){
    $data = ['description'=>$description, 'serial_number'=>$serialNumber, 'purchase_date'=>$purchaseDate, 'location'=>$location, 'supplier'=>$supplier, 'cost'=>$cost, 'depreciation_method'=>$depreciationMethod, 'depreciation_rate'=>$depreciationRate,'owner'=>$owner];

    $this->db->where('id', $assetId);
    $this->db->update('assets', $data);

    return TRUE;
    }
   
   
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    /**
     * Get specific asset information based on a given condition.
     *
     * @param array $where_clause    An associative array representing the condition.
     * @param array $fields_to_fetch An array of fields to retrieve.
     *
     * @return object|bool The asset information as an object or FALSE if no match is found.
     */

    public function getAssetInfo($where_clause, $fields_to_fetch){
        $this->db->select($fields_to_fetch);
        
        $this->db->where($where_clause);

        $run_q = $this->db->get('assets');
        
        return $run_q->num_rows() ? $run_q->row() : FALSE;
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    /**
     * Get the asset description by ID.
     *
     * @param int $assetId The ID of the asset.
     * @return string|bool The asset description or FALSE if not found.
     */
    
    public function getAssetDescriptionById($assetsId){
        $this->db->select('description');
        $this->db->where('id', $assetsId);
        $query = $this->db->get('assets');
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->name;
        } else {
            return FALSE;
        }
    }

    /**
     * Get the last Asset for a specific month and year.
     *
     * @param string $monthYear The month and year combined (e.g., "2309" for September 2023).
     * @return string|null The last student ID or null if none is found.
     */
    public function getAssetNumberForMonth($monthYear) {
        
        $likeCondition = "asset_number LIKE 'ASN{$monthYear}%'";
    
        // Generate the SQL query with a custom WHERE clause
        $sql = "SELECT asset_number FROM assets WHERE $likeCondition ORDER BY asset_number DESC LIMIT 1";
    
        // Execute the SQL query
        $query = $this->db->query($sql);
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->asset_number;

        } else {  
            return null;

        }
        
    }

   
}