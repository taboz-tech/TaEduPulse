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
                        <select id="studentListSortBy" class="form-control">
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
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new student form and studnets list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update an student-->
            <div class="col-sm-4 hidden" id='createNewStudentDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddStudent">&times;</button><br>
                    <form name="addNewStudentForm" id="addNewStudentForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentStudent_id">Student ID</label>
                                <input type="text" id="studentStudent_id" name="studentStudent_id" placeholder="Student Id" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'studentStudent_idErr')" autofocus>
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
                                <input type="text" id="studentClass_name" name="studentClass_name" placeholder="Student Class_name" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'studentClass_nameErr')">
                                <span class="help-block errMsg" id="studentClass_nameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentGender">Student Gender</label>
                                <input type="text" id="studentGender" name="studentGender" placeholder="Student Gender" maxlength="10"
                                    class="form-control" onchange="checkField(this.value, 'studentGenderErr')">
                                <span class="help-block errMsg" id="studentGenderErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="studentFees">Student Fees</label>
                                <input type="number" id="studentFees" name="studentFees" placeholder="Student Fees" min="0"
                                    class="form-control" onchange="checkField(this.value, 'studentFeesErr')">
                                <span class="help-block errMsg" id="studentFeesErr"></span>
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
                                <button type="reset" id="cancelAddStudent" class="btn btn-danger btn-sm cancelAddItem" form='addNewStudentForm'>Cancel</button>
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

<!--modal to update student-->
<div id="updateStudentModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Student</h4>
                <div id="studentUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateStudentForm" id="updateStudentForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Student Name</label>
                            <input type="text" readonly id="studentUpdateStudentName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Student Id</label>
                            <input type="text" readonly id="studentUpdateStudentStudent_id" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Student Fees </label>
                            <input type="text" readonly id="studentUpdateStudentFees" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group-sm">
                            <label for="studentUpdateType">Update Type</label>
                            <select id="studentUpdateType" class="form-control checkField">
                                <option value="">---</option>
                                <option value="newFees">New Fees</option>
                                <option value="addition"> Additional</option>
                            </select>
                            <span class="help-block errMsg" id="studentUpdateTypeErr"></span>
                        </div>
                        
                        <div class="col-sm-6 form-group-sm">
                            <label for="studentUpdateFees"> Update fees</label>
                            <input type="number" id="studentUpdateFees" placeholder="Update Fees"
                                class="form-control checkField" min="0">
                            <span class="help-block errMsg" id="studentUpdateFeesErr"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="studentUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="studentUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="studentUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="studentUpdateStudent_id">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="studentUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



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
                            <label for="studentClass_nameEdit">Student Class_name</label>
                            <input type="text" id="studentClass_nameEdit" placeholder="Student Class_name" autofocus class="form-control checkField">
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
                            <label for="studentParent_nameEdit">Student Parent_name</label>
                            <input type="text" id="studentParent_nameEdit" placeholder="Student Parent_name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentParent_nameEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="studentParent_phoneEdit">Student Parent_phone</label>
                            <input type="text" id="studentParent_phoneEdit" placeholder="Student Parent_phone" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="studentParent_phoneEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="studentFees">Student Fees</label>
                            <input type="text" id="studentFeesEdit" name="studentFeesPrice" placeholder="studentFees" class="form-control checkField">
                            <span class="help-block errMsg" id="studentFeesEditErr"></span>
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