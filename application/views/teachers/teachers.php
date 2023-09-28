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
                        <button class="btn btn-primary btn-sm" id='createTeacher'>Add New Teacher</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="teachersListPerPage">Show</label>
                        <select id="teachersListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="teachersListSortBy">Sort by</label>
                        <select id="teachersListSortBy" class="form-control">
                            <option value="name-ASC">Teacher Name (ASC)</option>
                            <option value="surname-ASC">Teacher Surname (ASC)</option>
                            <option value="dateAdded-ASC">Date Added (ASC)</option>
                            <option value="subject-ASC">Subject (ASC)</option>
                            <option value="department-ASC">Department (ASC)</option>
                            <option value="name-DESC">Teacher Name (DESC)</option>
                            <option value="surname-DESC">Teacher Surname (DESC)</option>
                            <option value="dateAdded-DESC">Date Added (DESC)</option>
                            <option value="subject-DESC">Subject (DESC)</option>
                            <option value="department-DESC">Department (DESC)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='teacherSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="teacherSearch" class="form-control" placeholder="Search Teachers">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Teacher form and Teachers list table-->
    <div class="row">
        <div class="col-sm-12">
            <!-- Form to add/update a Teacher -->
            <div class="col-sm-4 hidden" id='createNewTeacherDiv'>
                <div class="well">
                    <button class="close cancelAddTeacher">&times;</button><br>
                    <form name="addNewTeacherForm" id="addNewTeacherForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>

                        <br>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="staffStaff_id">Staff Id</label>
                                <input type="text" id="staffStaff_id" name="staffStaff_id" placeholder="Staff Id" maxlength="20"
                                    class="form-control" onchange="checkField(this.value, 'staffStaff_idErr')" >
                                <span class="help-block errMsg" id="staffStaff_idErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="teacherName">Teacher Name</label>
                                <input type="text" id="teacherName" name="teacherName" placeholder="Teacher Name" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'teacherNameErr')" readonly>
                                <span class="help-block errMsg" id="teacherNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="teacherSurname">Teacher Surname</label>
                                <input type="text" id="teacherSurname" name="teacherSurname" placeholder="Teacher Surname" maxlength="40"
                                    class="form-control"  onchange="checkField(this.value, 'teacherSurnameErr')" readonly>
                                <span class="help-block errMsg" id="teacherSurnameErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="teacherGender">Teacher Gender</label>
                                <input type="text" id="teacherGender" name="teacherGender" placeholder="Teacher Gender" maxlength="10"
                                    class="form-control" onchange="checkField(this.value, 'teacherGenderErr')" readonly>
                                <span class="help-block errMsg" id="teacherGenderErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="teacherProfession">Profession</label>
                                <input type="text" id="teacherProfession" name="teacherProfession" placeholder="Profession" maxlength="50"
                                    class="form-control" onchange="checkField(this.value, 'teacherProfessionErr')">
                                <span class="help-block errMsg" id="teacherProfessionErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="teacherSubject">Teacher Subject</label>
                                <input type="text" id="teacherSubject" name="teacherSubject" placeholder="Teacher Subject" maxlength="100"
                                    class="form-control" onchange="checkField(this.value, 'teacherSubjectErr')">
                                <span class="help-block errMsg" id="teacherSubjectErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="teacherDepartment">Teacher Department</label>
                                <input type="text" id="teacherDepartment" name="teacherDepartment" placeholder="Teacher Department" maxlength="100"
                                    class="form-control" onchange="checkField(this.value, 'teacherDepartmentErr')" readonly>
                                <span class="help-block errMsg" id="teacherDepartmentErr"></span>
                            </div>
                        </div>

                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewTeacher">Add Teacher</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddTeacher" class="btn btn-danger btn-sm cancelAddTeacher" form='addNewTeacherForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div>
            </div>
            
            <!--- Teacher list div-->
            <div class="col-sm-12" id="teachersListDiv">
                <!-- Teacher list Table-->
                <div class="row">
                    <div class="col-sm-12" id="teachersListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of teacher list div-->

        </div>
    </div>
    <!-- End of row of adding new teacher form and teachers list table-->
</div>

<!--modal to edit teachers-->
<div id="editTeacherModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Teacher</h4>
                <div id="editTeacherFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="teacherNameEdit">Teacher Name</label>
                            <input type="text" id="teacherNameEdit" placeholder="Teacher Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="teacherNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="teacherSurnameEdit">Teacher Surname</label>
                            <input type="text" id="teacherSurnameEdit" placeholder="Teacher Surname" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="teacherSurnameEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="teacherProfessionEdit">Teacher Profession</label>
                            <input type="text" id="teacherProfessionEdit" placeholder="Teacher Profession" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="teacherProfessionEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="teacherSubjectEdit">Teacher Subject</label>
                            <input type="text" id="teacherSubjectEdit" placeholder="Teacher Subject" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="teacherSubjectEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="teacherDepartmentEdit">Teacher Department</label>
                            <input type="text" id="teacherDepartmentEdit" placeholder="Teacher Department" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="teacherDepartmentEditErr"></span>
                        </div>

                    </div>
                    
                    <input type="hidden" id="teacherIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editTeacherSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/teachers.js"></script>