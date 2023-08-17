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
                        <button class="btn btn-primary btn-sm" id='createGrade'>Add New Grade</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="gradesListPerPage">Show</label>
                        <select id="gradesListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="gradesListSortBy">Sort by</label>
                        <select id="gradesListSortBy" class="form-control">
                            <option value="name-ASC">Grade Name (A-Z)</option>
                            <option value="name-DESC">Grade Name (Z-A)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='gradeSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="gradeSearch" class="form-control" placeholder="Search Grades">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Grade form and Grade list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update a Grade-->
            <div class="col-sm-4 hidden" id='createNewGradeDiv'>
                <div class="well">
                    <button class="btn btn-info btn-xs pull-left" id="useBarcodeScanner">Use Scanner</button>
                    <button class="close cancelAddGrade">&times;</button><br>
                    <form name="addNewGradeForm" id="addNewGradeForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="gradeName">Grade Name</label>
                                <input type="text" id="gradeName" name="gradeName" placeholder="Grade Name" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'gradeNameErr')" autofocus>
                                <span class="help-block errMsg" id="gradeNameErr"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="gradeTeacher_id">Grade Teacher_id</label>
                                <select id="gradeTeacher_id" name="gradeTeacher_id" class="form-control" onchange="checkField(this.value, 'gradeTeacher_idErr')">
                                    <option value="">Select Teacher</option> <!-- Add a default empty option -->
                                </select>
                                <span class="help-block errMsg" id="gradeTeacher_idErr"></span>
                            </div>
                        </div>

                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewGrade">Add Grade</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddGrade" class="btn btn-danger btn-sm cancelAddGrade" form='addNewGradeForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Grade list div-->
            <div class="col-sm-12" id="gradesListDiv">
                <!-- Grade list Table-->
                <div class="row">
                    <div class="col-sm-12" id="gradesListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of grade list div-->

        </div>
    </div>
    <!-- End of row of adding new grade form and grades list table-->
</div>

<!--modal to update grade-->
<div id="updateGradeModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Update Grade</h4>
                <div id="gradeUpdateFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form name="updateGradeForm" id="updateGradeForm" role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label>Grade Name</label>
                            <input type="text" readonly id="gradeUpdateGradeName" class="form-control">
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label>Grade Teacher_id</label>
                            <input type="text" readonly id="gradeUpdateGradeTeacher_id" class="form-control">
                        </div>
                        
                    </div>
                    <br>
                    
                    <div class="row">
                        <div class="col-sm-12 form-group-sm">
                            <label for="gradeUpdateDescription" class="">Description</label>
                            <textarea class="form-control checkField" id="gradeUpdateDescription" placeholder="Update Description"></textarea>
                            <span class="help-block errMsg" id="gradeUpdateDescriptionErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="gradeUpdateGradeId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="gradeUpdateSubmit">Update</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<!--modal to edit grade-->
<div id="editGradeModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Grade</h4>
                <div id="editGradeFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="gradeNameEdit">Grade Name</label>
                            <input type="text" id="gradeNameEdit" placeholder="Grade Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="gradeNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="gradeTeacher_idEdit">Grade Teacher_id</label>
                            <select id="gradeTeacher_idEdit" class="form-control checkField">
                                <option value="">Select Class</option>
                            </select>
                            <span class="help-block errMsg" id="gradeTeacher_idEditErr"></span>
                        </div>

                        
                    </div>
                    
                    <input type="hidden" id="gradeIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editGradeSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/grades.js"></script>
