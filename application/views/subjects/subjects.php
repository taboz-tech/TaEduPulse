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
                        <button class="btn btn-primary btn-sm" id='createSubject'>Add New Subject</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="subjectsListPerPage">Show</label>
                        <select id="subjectsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5"selected>5</option>
                            <option value="10" >10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="subjectsListSortBy">Sort by</label>
                        <select id="subjectsListSortBy" class="form-control">
                            <option value="name-ASC">Subject Name (A-Z)</option>
                            <option value="name-DESC">Subject Name (Z-A)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='subjectSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="subjectSearch" class="form-control" placeholder="Search Subjects">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Subject form and Subject list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update a Subject-->
            <div class="col-sm-4 hidden" id='createNewSubjectDiv'>
                <div class="well">
                    <button class="close cancelAddSubject">&times;</button><br>
                    <form name="addNewSubjectForm" id="addNewSubjectForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="subjectName">Subject Name</label>
                                <input type="text" id="subjectName" name="subjectName" placeholder="Subject Name" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'subjectNameErr')" autofocus>
                                <span class="help-block errMsg" id="subjectNameErr"></span>
                            </div>
                        </div>
                        
                       

                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewSubject">Add Subject</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddSubject" class="btn btn-danger btn-sm cancelAddSubject" form='addNewSubjectForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Subject list div-->
            <div class="col-sm-12" id="subjectsListDiv">
                <!-- Subject list Table-->
                <div class="row">
                    <div class="col-sm-12" id="subjectsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of Subject list div-->

        </div>
    </div>
    <!-- End of row of adding new subject form and subjects list table-->
</div>

<!--modal to edit Subject-->
<div id="editSubjectModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Subject</h4>
                <div id="editSubjectFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="subjectNameEdit">Subject Name</label>
                            <input type="text" id="subjectNameEdit" placeholder="Subject Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="subjectNameEditErr"></span>
                        </div>
                        
                    </div>
                    
                    <input type="hidden" id="subjectIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editSubjectSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/subjects.js"></script>
