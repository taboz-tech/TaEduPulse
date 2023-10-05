<?php
defined('BASEPATH') OR exit('');
?>

<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- sort and co row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='createStudent'>Add New Student</button>
                    </div>

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
                        <label for="studentsListSortBy">Sort by</label>
                        <select id="studentsListSortBy" class="form-control">
                            <option value="name-ASC">Student Name (A-Z)</option>
                            <option value="surname-ASC">Student Surname (Ascending)</option>
                            <option value="dateAdded-ASC">Date Added (Ascending)</option>
                            <option value="parent_name-ASC">Parent Name (Ascending)</option>
                            <option value="name-DESC">Student Name (Z-A)</option>
                            <option value="surname-DESC">Student Surname (Descending)</option>
                            <option value="dateAdded-DESC">Date Added (Descending)</option>
                            <option value="parent_name-DESC">Parent Name (Descending)</option>
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
                            <button class="btn btn-primary btn-sm" id="generateReport">Generate Report</button>
                            <select id="percentageSelect">
                                <option value="0">0%</option>
                                <option value="25">0-25%</option>
                                <option value="50">25-50%</option>
                                <option value="75">50-75%</option>
                                <option value="100">75-100%</option>
                            </select>
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
    
    <!-- row of adding new student form and students list table-->
    <div class="row">
        <div class="col-sm-12">

            <!--Form to add/update an student-->
            <div class="col-sm-4 hidden" id='createNewStudentDiv'>
                <div class="well">
                    <button class="close cancelAddStudent">&times;</button><br>
                    <form name="addNewStudentForm" id="addNewStudentForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentStudent_id">Student ID</label>
                                <input type="text" id="studentStudent_id" name="studentStudent_id" placeholder="Student Id" maxlength="15"
                                    class="form-control" readonly >
                                <!--<span class="help-block"><input type="checkbox" id="gen4me"> auto-generate</span>-->
                                <span class="help-block errMsg" id="studentStudent_idErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentName">Student Name</label>
                                <input type="text" id="studentName" name="studentName" placeholder="Student Name" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'studentNameErr')">
                                <span class="help-block errMsg" id="studentNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentSurname">Student Surname</label>
                                <input type="text" id="studentSurname" name="studentSurname" placeholder="Student Surname" maxlength="40"
                                    class="form-control"  onchange="checkField(this.value, 'studentSurnameErr')">
                                <span class="help-block errMsg" id="studentSurnameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentClass_name">Student Class</label>
                                <select id="studentClass_name" name="studentClass_name" class="form-control" onchange="checkField(this.value, 'studentClass_nameErr')">
                                    <option value="">Select Class</option> <!-- Add a default empty option -->
                                </select>
                                <span class="help-block errMsg" id="studentClass_nameErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentGender">Student Gender</label>
                                <select id="studentGender" name="studentGender" class="form-control" onchange="checkField(this.value, 'studentGenderErr')">
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-block errMsg" id="studentGenderErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentHealthy_status">Student Healthy Status</label>
                                <input type="text" id="studentHealthy_status" name="studentHealthy_status" placeholder="Student Healthy Status" maxlength="40"
                                    class="form-control" value="None" onchange="checkField(this.value, 'studentHealthy_statusErr')">
                                <span class="help-block errMsg" id="studentHealthy_statusErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentDob">Student DOB</label>
                                <input type="date" id="studentDob" name="studentDob" placeholder="Student DOB" class="form-control" 
                                    max="<?= date('Y-m-d', strtotime('-1 years')) ?>"
                                    onchange="checkField(this.value, 'studentDobErr')">
                                <span class="help-block errMsg" id="studentDobErr"></span>
                            </div>
                        </div>                      

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentFees">Student Fees</label>
                                <input type="number" id="studentFees" name="studentFees" placeholder="Student Fees" min="0"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="studentFeesErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentRegFees">Student Reg Fees</label>
                                <input type="number" id="studentRegFees" name="studentRegFees" placeholder="Student Reg Fees" min="0"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="studentRegFeesErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentOwed_fees">Student Owed Fees</label>
                                <input type="number" id="studentOwed_fees" name="studentOwed_fees" placeholder="Student Owed Fees" min="0"
                                    class="form-control" onchange="checkField(this.value, 'studentOwed_feesErr')" readonly>
                                <span class="help-block errMsg" id="studentOwed_feesErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentParent_name">Student Parent_name</label>
                                <input type="text" id="studentParent_name" name="studentParent_name" placeholder="Student Parent_name" maxlength="50"
                                    class="form-control" onchange="checkField(this.value, 'studentParent_nameErr')">
                                <span class="help-block errMsg" id="studentParent_nameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentRelationship">Student Relationship</label>
                                <input type="text" id="studentRelationship" name="studentRelationship" placeholder="Student Relationship" maxlength="40"
                                    class="form-control"  onchange="checkField(this.value, 'studentRelationshipErr')">
                                <span class="help-block errMsg" id="studentRelationshipErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentParent_phone">Student Parent_phone</label>
                                <input type="text" id="studentParent_phone" name="studentParent_phone" placeholder="Student Parent_phone" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'studentParent_phoneErr')">
                                <span class="help-block errMsg" id="studentParent_phoneErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentAddress">Student Address</label>
                                <input type="text" id="studentAddress" name="studentAddress" placeholder="Student Address" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'studentAddressErr')">
                                <span class="help-block errMsg" id="studentAddressErr"></span>
                            </div>
                        </div>



                        
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewStudent">Add Student</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddStudent" class="btn btn-danger btn-sm cancelAddStudent" form='addNewStudentForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
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
    <!-- End of row of adding new student form and students list table-->
</div>

<!--modal to edit students-->
<div id="editStudentModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Student</h4>
                <div id="editStudentFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="studentNameEdit">Student Name</label>
                            <input type="text" id="studentNameEdit" placeholder="Student Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="studentSurnameEdit">Student Surname</label>
                            <input type="text" id="studentSurnameEdit" placeholder="Student Surname" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentSurnameEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="studentClass_nameEdit">Student Class</label>
                            <select id="studentClass_nameEdit" class="form-control checkField">
                                <option value="">Select Class</option>
                            </select>
                            <span class="help-block errMsg" id="studentClass_nameEditErr"></span>
                        </div>


                        <div class="col-sm-4 form-group-sm">
                            <label for="studentStudent_id"> Student Id</label>
                            <input type="text" id="studentStudent_idEdit" class="form-control">
                            <span class="help-block errMsg" id="studentStudent_idEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="studentAddressEdit">Student Address</label>
                            <input type="text" id="studentAddressEdit" placeholder="Student Address" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentAddressEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="studentHealthy_statusEdit">Student Healthy Status</label>
                            <input type="text" id="studentHealthy_statusEdit" placeholder="Student Healthy Status" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentHealthy_statusEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="studentDobEdit">Student DOB</label>
                            <input type="date" id="studentDobEdit" name="studentDobEdit" autofocus class="form-control checkField" max="<?= date('Y-m-d', strtotime('-1 years')) ?>">
                            <span class="help-block errMsg" id="studentDobEditErr"></span>
                        </div>


                        <div class="col-sm-4 form-group-sm">
                            <label for="studentParent_nameEdit">Student Parent_name</label>
                            <input type="text" id="studentParent_nameEdit" placeholder="Student Parent_name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentParent_nameEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="studentRelationshipEdit">Student Relationship</label>
                            <input type="text" id="studentRelationshipEdit" placeholder="Student Relationship" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentRelationshipEditErr"></span>
                        </div>


                        <div class="col-sm-4 form-group-sm">
                            <label for="studentParent_phoneEdit">Student Parent_phone</label>
                            <input type="text" id="studentParent_phoneEdit" placeholder="Student Parent_phone" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentParent_phoneEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="studentFees">Student Fees</label>
                            <input type="text" id="studentFeesEdit" name="studentFeesPrice" placeholder="studentFees" class="form-control checkField" readonly>
                            <span class="help-block errMsg" id="studentFeesEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="studentOwed_fees">Owed Fees</label>
                            <div class="input-group">
                                <input type="text" id="studentOwed_feesEdit" name="studentOwed_fees" placeholder="Owed Fees" class="form-control checkField">
                                <?php if ($this->session->admin_role === "Super"): ?>
                                <div class="input-group-append">
                                    <label for="enableOwedFeesEdit" class="input-group-text">Allow Edit</label>
                                    <input type="checkbox" id="enableOwedFeesEdit">
                                </div>
                                <?php endif; ?>
                            </div>
                            <span class="help-block errMsg" id="studentOwed_feesEditErr"></span>
                        </div>

                    </div>
                    
                    <input type="hidden" id="studentIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editStudentSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/students.js"></script>