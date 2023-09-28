<?php defined('BASEPATH') OR exit(''); ?>

<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and search row -->
            <div class="row">
                <div class="col-sm-12">
                    
                    <!-- Show per page dropdown -->
                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="recordsListPerPage">Show</label>
                        <select id="recordsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="30">50</option>
                            <option value="30">100</option>

                        </select>
                        <label>per page</label>
                    </div>

                    <!-- Sort by dropdown -->
                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="recordsListSortBy">Sort by</label>
                        <select id="recordsListSortBy" class="form-control">
                            <option value="name-ASC">Record Name (A-Z)</option>
                            <option value="name-DESC">Record Name (Z-A)</option>
                        </select>
                    </div>

                    <!-- Search box -->
                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='recordsearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="recordsearch" class="form-control" placeholder="Search Records">
                    </div>
                </div>
            </div>
            <!-- end of sort and search div -->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Record form and Record list table -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Form to add/update a Record -->
            <div class="col-sm-4 hidden" id='createNewRecordDiv'>
                <!-- Add New Record Form Content -->
            </div>
            
            <!-- Record list div -->
            <div class="col-sm-12" id="recordsListDiv">
                <!-- Record list Table -->
                <div class="row">
                    <div class="col-sm-12" id="recordsListTable"></div>
                </div>
                <!-- end of table -->
            </div>
            <!-- End of Record list div -->
        </div>
    </div>
    <!-- End of row of adding new Record form and Record list table -->
</div>

<!-- Modal to update Record -->
<div id="updateRecordModal" class="modal fade" role="dialog" data-backdrop="static">
    <!-- Update Record Modal Content -->
</div>

<!-- Modal to edit Record -->
<div id="editRecordModal" class="modal fade" role="dialog" data-backdrop="static">
    <!-- Edit Record Modal Content -->
</div>

<script src="<?=base_url()?>public/js/records.js"></script>
