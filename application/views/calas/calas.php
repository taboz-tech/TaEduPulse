<?php
defined('BASEPATH') OR exit('');
?>

<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="studentsListPerPage">Show</label>
                        <select id="studentsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="studentsListSortBy">Sort</label>
                        <select id="studentsListSortBy" class="form-control">
                            <option value="name-ASC">Student Name (A-Z)</option>
                            <option value="surname-ASC">Student Surname (Ascending)</option>
                            <option value="name-DESC">Student Name (Z-A)</option>
                            <option value="surname-DESC">Student Surname (Descending)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='studentSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="studentSearch" class="form-control" placeholder="Search Students">
                    </div>
                </div>
            </div>
            <!-- Line breaker -->
            <hr>
            
            <!-- Generate Report row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        
                        <div class="col-sm-2 form-inline form-group-sm">
                            <button class="btn btn-primary btn-sm" id="captureMarks">Capture Marks</button>  
                        </div>

                        <div class="col-sm-3 form-inline form-group-sm">
                            <label for="classDropdown">Select Class</label>
                            <select id="classDropdown" class="form-control">
                                <option value="" selected>Select Class</option>
                                <!-- Options will be added dynamically here -->
                            </select>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Element to display the report download link -->
            <div id="reportDownloadLink"></div>


            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-sm-12">

            <!--- Student list div-->
            <div class="col-sm-12" id="studentsListDiv">
                <!-- Student list Table-->
                <div class="row">
                    <div class="col-sm-12" id="studentsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of student list div-->

        </div>
    </div>
</div>

<!-- Modal for Capturing Marks -->
<div class="modal fade" id="captureMarksModal" tabindex="-1" role="dialog" aria-labelledby="captureMarksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="captureMarksModalLabel">Enter Student Marks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="selected-class-display">
                    <h3>Selected Class: <span id="selectedClassNameCaptureMarks"></span></h3>
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;"> <!-- Adjust the max-height as needed -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="hidden-id" style="display: none;">ID</th> <!-- Hidden column for ID -->
                                <th style="width: 20%;">Student Name</th>
                                <th contenteditable="true">Component A</th>
                                <th contenteditable="true">Component B</th>
                                <th contenteditable="true">Component C</th>
                                <th contenteditable="true">Component D</th>
                                <th contenteditable="true">Component E</th>
                                <th contenteditable="true">Average</th>
                            </tr>
                        </thead>
                        <tbody id="studentMarksTableBody">
                            <!-- Rows for students and input fields will be added dynamically here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveMarksButton">Save Marks</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="downloadPDF">Download PDF</button> <!-- Add this button -->

            </div>
        </div>
    </div>
</div>




<!-- Modal for Class and Subject Selection -->
<div class="modal fade" id="classSubjectSelectionModal" tabindex="-1" role="dialog" aria-labelledby="classSubjectSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="classSubjectSelectionModalLabel">Select Class and Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="classSubjectForm">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Class Selection -->
                            <div class="form-group">
                                <label for="classCheckboxes">Select Class(es):</label>
                                <div id="classCheckboxes">
                                    <!-- Checkboxes for classes will be populated dynamically via JavaScript -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Subject Selection -->
                            <div class="form-group">
                                <label for="subjectCheckboxes">Select Subject(s):</label>
                                <div id="subjectCheckboxes">
                                    <!-- Checkboxes for subjects will be populated dynamically via JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmClassSubjectSelection">Confirm</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
<script src="<?=base_url()?>public/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url()?>public/pdfmake/build/vfs_fonts.js"></script>
<script src="<?=base_url()?>public/js/calas.js"></script>