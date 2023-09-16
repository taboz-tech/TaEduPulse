<?php
defined('BASEPATH') OR exit('');
?>

<div class="pwell hidden-print">   
    <!-- Row for Buttons -->
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-2 form-inline form-group-sm">
                <button class="btn btn-primary btn-sm" id='createPayslip'>Add New Payslip</button>
            </div>

            <div class="col-sm-2 form-inline form-group-sm">
                <button class="btn btn-primary btn-sm" id='showEmployeeListModal'>Show Employee List</button>
            </div>
        </div>
    </div>
    
    <hr>
    
    <!-- Row for Sorting Options -->
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3 form-inline form-group-sm">
                <label for="payslipsListPerPage">Show</label>
                <select id="payslipsListPerPage" class="form-control">
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
                <label for="payslipsListSortBy">Sort by</label>
                <select id="payslipsListSortBy" class="form-control">
                    <option value="dateAdded-ASC"> Date (ASC)</option>
                    <option value="dateAdded-DESC"> Date (DESC)</option>
                    <option value="staff_name-ASC"> Staff Name (ASC)</option>
                    <option value="staff_name-DESC"> Staff Name (DESC)</option>
                    <option value="staff_department-ASC"> Staff Dept (ASC)</option>
                    <option value="staff_department-DESC"> Staff Dept (DESC)</option>
                    
                </select>
            </div>

            <div class="col-sm-3 form-inline form-group-sm">
                <label for='payslipSearch'><i class="fa fa-search"></i></label>
                <input type="search" id="payslipSearch" class="form-control" placeholder="Search Payslip">
            </div>
        </div>
    </div>

    
    <hr>
    
    <!-- row of adding new Payslip form and Payslips list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update a Payslip-->
            <div class="col-sm-4 hidden" id='createNewPayslipDiv'>
                <div class="well">
                    <button class="close cancelAddPayslip">&times;</button><br>
                    <form name="addNewPayslipForm" id="addNewPayslipForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffSelect">Select Staff</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <select id="staffSelect" class="form-control">
                                    <option value="">Select...</option>
                                    <?php if (isset($staffs) && !empty($staffs)) { ?>
                                        <?php foreach ($staffs as $staff) { ?>
                                            <option value="<?= $staff->staff_id ?>" data-display="<?= $staff->name ?> <?= $staff->surname ?>" data-search="<?= $staff->staff_id ?> <?= $staff->name ?> <?= $staff->surname ?>"><?= $staff->name ?> <?= $staff->surname ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="help-block errMsg" id="staffSelectErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffStaff_id">Staff Id</label>
                                <input type="text" id="staffStaff_id" name="staffStaff_id" placeholder="Staff Id" maxlength="20"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="staffStaff_idErr"></span>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffName">Staff Name</label>
                                <input type="text" id="staffName" name="staffName" placeholder="Staff Name" maxlength="30"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="staffNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffSurname">Staff Surname</label>
                                <input type="text" id="staffSurname" name="staffSurname" placeholder="Staff Surname" maxlength="50"
                                    class="form-control"  readonly>
                                <span class="help-block errMsg" id="staffSurnameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffNational_id">National ID</label>
                                <input type="text" id="staffNational_id" name="staffNational_id" placeholder="77093552M77" maxlength="20"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="staffNational_idErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffJob_tittle">Job Tittle</label>
                                <input type="text" id="staffJob_tittle" name="staffJob_tittle" placeholder="Job Tittle" maxlength="30"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="staffJob_tittleErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffSalary">Staff Salary</label>
                                <input type="number" id="staffSalary" name="staffSalary" placeholder="Staff Salary" min="0"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="staffSalaryErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffIncome_tax">Staff Income Tax</label>
                                <input type="number" id="staffIncome_tax" name="staffIncome_tax" placeholder="Staff Income Tax" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'staffIncome_taxErr')">
                                <span class="help-block errMsg" id="staffIncome_taxErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffOvertime">Staff Overtime</label>
                                <input type="number" id="staffOvertime" name="staffOvertime" placeholder="Staff Overtime" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'staffOvertimeErr')">
                                <span class="help-block errMsg" id="staffOvertimeErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffHealthy_insurance">Staff Healthy Insurance</label>
                                <input type="number" id="staffHealthy_insurance" name="staffHealthy_insurance" placeholder="Staff Healthy Insurance" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'staffHealthy_insuranceErr')">
                                <span class="help-block errMsg" id="staffHealthy_insuranceErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 form-group-sm">
                                <label for="staffDepartment">Staff Department</label>
                                <input type="text" id="staffDepartment" name="staffDepartment" placeholder="Staff Department" maxlength="30"
                                    class="form-control" readonly>
                                <span class="help-block errMsg" id="staffDepartmentErr"></span>
                            </div>
                        </div>
                       
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewPayslip">Add Payslip</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddPayslip" class="btn btn-danger btn-sm cancelAddPayslip" form='addNewStaffForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Staff list div-->
            <div class="col-sm-12" id="payslipsListDiv">
                <!-- payslip list Table-->
                <div class="row">
                    <div class="col-sm-12" id="payslipsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of payslip list div-->

        </div>
    </div>
    <!-- End of row of adding newPayslip form and Payslip list table-->
</div>

<!-- Modal -->
<div class="modal fade" id="employeeListModal" tabindex="-1" role="dialog" aria-labelledby="employeeListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content custom-modal-background"> <!-- Add custom-modal-background class -->
            <div class="modal-header">
                <h5 class="modal-title" id="employeeListModalLabel">Employee List</h5>
                <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Employee list with checkboxes -->
                <div id="employeeList">
                    <!-- "Select All" option -->
                    <ul class="list-group">
                        <li class="list-group-item custom-list-item-background">
                            <label>
                                <input type="checkbox" id="selectAllCheckbox"> Select All
                            </label>
                        </li>
                    </ul>

                    <!-- Populate this div with employee checkboxes -->
                    <?php if (isset($staffs) && !empty($staffs)) { ?>
                        <ul class="list-group">
                            <?php foreach ($staffs as $staff) { ?>
                                <li class="list-group-item custom-list-item-background">
                                    <label>
                                        <input type="checkbox" class="employeeCheckbox" value="<?= $staff->staff_id ?>">
                                        <?= $staff->name ?> <?= $staff->surname ?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
                <!-- End of Employee list -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <!-- Create button with success style -->
                <button type="button" class="btn btn-success" id="createButtonPayroll">Create</button>
                <p id="modalErrorMessage" style="color: red;"></p> <!-- Add this <p> for error message -->
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>public/js/payrolls.js"></script>