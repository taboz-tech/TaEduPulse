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
                        <label for="payslipsListPerPage">Per Page</label>
                        <select id="payslipsListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="col-sm-5 form-group-sm form-inline">
                        <label for="payslipsListSortBy">Sort by</label>
                        <select id="payslipsListSortBy" class="form-control">
                            <option value="payslipsDate-DESC">date(Latest First)</option>
                            <option value="payslipsDate-ASC">date(Oldest First)</option>
                            <option value="basic_salary-DESC">Basic Salary (Highest first)</option>
                            <option value="basic_salary-ASC">Basic Salary (Lowest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-4 form-inline form-group-sm">
                        <label for='payslipsSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="payslipsSearch" class="form-control" placeholder="Search Payslips">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- payslip list table-->
    <div class="row">
        <!-- Payslip list div-->
        <div class="col-sm-12" id="payslipsListTable"></div>
        <!-- End of Payslips div-->
    </div>
    <!-- End of Payslips list table-->
</div>


<script src="<?=base_url()?>public/js/transactions.js"></script>
