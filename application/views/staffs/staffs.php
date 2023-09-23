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
                        <button class="btn btn-primary btn-sm" id='createStaff'>Add New Staff</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="staffsListPerPage">Show</label>
                        <select id="staffsListPerPage" class="form-control">
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
                        <label for="staffsListSortBy">Sort by</label>
                        <select id="staffsListSortBy" class="form-control">
                            <option value="name-ASC">Staff Name (A-Z)</option>
                            <option value="surname-ASC">Staff Surname (Ascending)</option>
                            <option value="dateAdded-ASC">Date Added (Ascending)</option>
                            <option value="gender-ASC">Gender (Ascending)</option>
                            <option value="name-DESC">Staff Name (Z-A)</option>
                            <option value="surname-DESC">Staff Surname (Descending)</option>
                            <option value="dateAdded-DESC">Date Added (Descending)</option>
                            <option value="gender-DESC">Gender (Descending)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='staffSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="staffSearch" class="form-control" placeholder="Search Staff">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Staff form and Staffs list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update a Staff-->
            <div class="col-sm-4 hidden" id='createNewStaffDiv'>
                <div class="well">
                    <button class="close cancelAddStaff">&times;</button><br>
                    <form name="addNewStaffForm" id="addNewStaffForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffStaff_id">Staff Id</label>
                                <input type="text" id="staffStaff_id" name="staffStaff_id" placeholder="Staff Id" maxlength="20"
                                    class="form-control" onchange="checkField(this.value, 'staffStaff_idErr')" readonly>
                                <span class="help-block errMsg" id="staffStaff_idErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffName">Staff Name</label>
                                <input type="text" id="staffName" name="staffName" placeholder="Staff Name" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'staffNameErr')">
                                <span class="help-block errMsg" id="staffNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffSurname">Staff Surname</label>
                                <input type="text" id="staffSurname" name="staffSurname" placeholder="Staff Surname" maxlength="50"
                                    class="form-control"  onchange="checkField(this.value, 'staffSurnameErr')">
                                <span class="help-block errMsg" id="staffSurnameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffGender">Staff Gender</label>
                                <input type="text" id="staffGender" name="staffGender" placeholder="Staff Gender" maxlength="10"
                                    class="form-control" onchange="checkField(this.value, 'staffGenderErr')">
                                <span class="help-block errMsg" id="staffGenderErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffNational_id">National ID</label>
                                <input type="text" id="staffNational_id" name="staffNational_id" placeholder="77093552M77" maxlength="20"
                                    class="form-control" onchange="checkField(this.value, 'staffNational_idErr')">
                                <span class="help-block errMsg" id="staffNational_idErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffJob_tittle">Job Tittle</label>
                                <input type="text" id="staffJob_tittle" name="staffJob_tittle" placeholder="Job Tittle" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'staffJob_tittleErr')">
                                <span class="help-block errMsg" id="staffJob_tittleErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffSalary">Staff Salary</label>
                                <input type="number" id="staffSalary" name="staffSalary" placeholder="Staff Salary" min="0"
                                    class="form-control" onchange="checkField(this.value, 'staffJob_tittleErr')">
                                <span class="help-block errMsg" id="staffSalaryErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffPhone">Staff Phone</label>
                                <input type="text" id="staffPhone" name="staffPhone" placeholder="Staff Phone" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'staffPhoneErr')">
                                <span class="help-block errMsg" id="staffPhoneErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffAddress">Staff Address</label>
                                <input type="text" id="staffAddress" name="staffAddress" placeholder="Staff Address" maxlength="80"
                                    class="form-control" onchange="checkField(this.value, 'staffAddressErr')">
                                <span class="help-block errMsg" id="staffAddressErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffDob">Staff D.O.B</label>
                                <input type="date" id="staffDob" name="staffDob" placeholder="Staff D.O.B" class="form-control"
                                    onchange="checkField(this.value, 'staffDobErr')">
                                <span class="help-block errMsg" id="staffDobErr"></span>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffEmail">Staff Email</label>
                                <input type="text" id="staffEmail" name="staffEmail" placeholder="Staff Email" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'staffEmailErr')">
                                <span class="help-block errMsg" id="staffEmailErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffDepartment">Staff Department</label>
                                <input type="text" id="staffDepartment" name="staffDepartment" placeholder="Staff Department" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'staffDepartmentErr')">
                                <span class="help-block errMsg" id="staffDepartmentErr"></span>
                            </div>
                        </div>
                       
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewStaff">Add Staff</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddStaff" class="btn btn-danger btn-sm cancelAddStaff" form='addNewStaffForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Staff list div-->
            <div class="col-sm-12" id="staffsListDiv">
                <!-- Staff list Table-->
                <div class="row">
                    <div class="col-sm-12" id="staffsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of Staff list div-->

        </div>
    </div>
    <!-- End of row of adding new Staff form and Staffs list table-->
</div>

<!--modal to edit Staffs-->
<div id="editStaffModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Staff</h4>
                <div id="editStaffFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="staffNameEdit">Staff Name</label>
                            <input type="text" id="staffNameEdit" placeholder="Staff Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="staffSurnameEdit">Staff Surname</label>
                            <input type="text" id="staffSurnameEdit" placeholder="Staff Surname" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffSurnameEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="staffNational_idEdit">National ID</label>
                            <input type="text" id="staffNational_idEdit" placeholder="77093552M77" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffNational_idEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="staffJob_tittleEdit">Staff Job Tittle</label>
                            <input type="text" id="staffJob_tittleEdit" placeholder="Staff Job Tittle" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffJob_tittleEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="staffEmailEdit">Staff Email</label>
                            <input type="text" id="staffEmailEdit" placeholder="Staff Email" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffEmailEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="staffGenderEdit">Staff Gender</label>
                            <select id="staffGenderEdit" class="form-control checkField">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span class="help-block errMsg" id="staffGenderEditErr"></span>
                        </div>


                        <div class="col-sm-4 form-group-sm">
                            <label for="staffSalaryEdit">Staff Salary</label>
                            <input type="number" id="staffSalaryEdit" placeholder="Staff Salary" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffSalaryEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="staffDobEdit">Staff D.O.B</label>
                            <input type="date" id="staffDobEdit" placeholder="Staff D.O.B" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffDobEditErr"></span>
                        </div>


                        <div class="col-sm-4 form-group-sm">
                            <label for="staffDepartmentEdit">Staff Department</label>
                            <input type="text" id="staffDepartmentEdit" placeholder="Staff Department" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffDepartmentEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="staffAddressEdit">Staff Address</label>
                            <input type="text" id="staffAddressEdit" placeholder="Staff Address" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffAddressEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="staffPhoneEdit">Staff Phone</label>
                            <input type="text" id="staffPhoneEdit" placeholder="Staff Phone" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="staffPhoneEditErr"></span>
                        </div>
                       
                    </div>
                    
                    <input type="hidden" id="staffIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editStaffSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/staffs.js"></script>