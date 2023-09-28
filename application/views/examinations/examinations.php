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
                        <!-- <div class="col-sm-2 form-inline form-group-sm">
                            <button class="btn btn-primary btn-sm" id="generateReport">Generate Report</button>
                            
                        </div> -->
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

<!-- Registration Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Student Registration</h5>
                <button type="button" class="close close-red" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Error div at the top -->
                <div class="text-center errMsg" id="addCustErrMsg"></div>

                <!-- Grouped Student Name and Student Surname (read-only) -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="studentName">Student Name</label>
                            <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Student Name" maxlength="30" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="studentSurname">Student Surname</label>
                            <input type="text" class="form-control" id="studentSurname" name="studentSurname" placeholder="Student Surname" maxlength="30" readonly>
                        </div>
                    </div>
                </div>

                <!-- ZIMSEC Registration Number -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="zimsecRegNumber">Registration Number</label>
                            <input type="text" class="form-control" id="zimsecRegNumber" name="zimsecRegNumber" placeholder="Registration Number" maxlength="20" onchange="checkField(this.value, 'zimsecRegNumberErr')">
                            <span class="help-block errMsg" id="zimsecRegNumberErr"></span>
                        </div>
                    </div>
                </div>

                <!-- Subjects with checkboxes -->
                <div class="form-group" id="subjectCheckboxes">
                    <!-- Dynamically loaded checkboxes will be placed here -->
                </div>

                <!-- Hidden Student ID -->
                <input type="hidden" id="studentId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="registerButton">Register</button>
            </div>
        </div>
    </div>
</div>

<!-- Registration Details Modal -->
<div class="modal fade" id="viewRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="viewRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRegistrationModalLabel">Registered Student Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="viewStudentName">Student Name</label>
                            <input type="text" class="form-control" id="viewStudentName" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="viewStudentSurname">Student Surname</label>
                            <input type="text" class="form-control" id="viewStudentSurname" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="viewZimsecRegNumber">ZIMSEC Registration Number</label>
                            <input type="text" class="form-control" id="viewZimsecRegNumber" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="viewRegisteredSubjects">Registered Subjects</label>
                    <ul class="list-group" id="viewRegisteredSubjects">
                        <!-- Registered subjects will be displayed here -->
                    </ul>
                </div>
                <input type="hidden" id="exams_regId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="cancelRegistrationButton">Cancel Registration</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<script src="<?=base_url()?>public/js/examinations.js"></script>