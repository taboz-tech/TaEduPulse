<?php defined('BASEPATH') OR exit('') ?>

<!--A Student's transactions history--->
<div class="col-sm-4">
    <div class="row">
        <div class="col-sm-12 form-group-sm form-inline">
            <div class="col-sm-4">
                Show
                <select id="studentPerPage" class="form-control">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="col-sm-4">
                <select id="sortStudents" class="form-control">
                    <option value="">Sort by</option>
                    <option value="student_id-asc">Student Id</option>
                </select>
            </div>
            <div class="col-sm-4">
                <input type="search" id="studentSearch" class="form-control" placeholder="Search Students">
            </div>
        </div>
    </div>
    <br>
    
    <!--Row of student's transactions -->
    <div class="row">
        <div class="col-sm-12" id='studentTransHistoryTable'>
            
        </div>
    </div>
</div>
<!--End of an student's transactions history--->