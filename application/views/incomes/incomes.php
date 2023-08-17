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
                        <button class="btn btn-primary btn-sm" id='createIncome'>Add New Income</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="incomesListPerPage">Show</label>
                        <select id="incomesListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="incomesListSortBy">Sort by</label>
                        <select id="incomesListSortBy" class="form-control">
                            <option value="name-ASC">Income Name (A-Z)</option>
                            <option value="dateAdded-ASC">Date Added (Ascending)</option>
                            <option value="name-DESC">Income Name (Z-A)</option>
                            <option value="dateAdded-DESC">Date Added (Descending)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='incomeSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="incomeSearch" class="form-control" placeholder="Search Incomes">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Income form and Incomes list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add a Income-->
            <div class="col-sm-4 hidden" id='createNewIncomeDiv'>
                <div class="well">
                    <button class="close cancelAddIncome">&times;</button><br>
                    <form name="addNewIncomeForm" id="addNewIncomeForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="incomeName">Income Name</label>
                                <input type="text" id="incomeName" name="incomeName" placeholder="Income Name" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'incomeNameErr')">
                                <span class="help-block errMsg" id="incomeNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="incomeAmount">Income Amount</label>
                                <input type="number" id="incomeAmount" name="incomeAmount" placeholder="Income Amount" min="0"
                                    class="form-control" onchange="checkField(this.value, 'incomeAmountErr')">
                                <span class="help-block errMsg" id="incomeAmountErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="incomeDescription">Income Description</label>
                                <input type="text" id="incomeDescription" name="incomeDescription" placeholder="Income Description" maxlength="40"
                                    class="form-control" onchange="checkField(this.value, 'incomeDescriptionErr')">
                                <span class="help-block errMsg" id="incomeDescriptionErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="incomeCurrency">Income Currency</label>
                                <input type="text" id="incomeCurrency" name="incomeCurrency" placeholder="Income Currency" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'incomeCurrencyErr')">
                                <span class="help-block errMsg" id="incomeCurrencyErr"></span>
                            </div>
                        </div>

                       
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewIncome">Add Income</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddIncome" class="btn btn-danger btn-sm cancelAddIncome" form='addNewIncomeForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Income list div-->
            <div class="col-sm-12" id="incomesListDiv">
                <!-- Income list Table-->
                <div class="row">
                    <div class="col-sm-12" id="incomesListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of Income list div-->

        </div>
    </div>
    <!-- End of row of adding new Income form and incomes list table-->
</div>

<!--modal to edit incomes-->
<div id="editIncomeModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Income</h4>
                <div id="editIncomeFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="incomeNameEdit">Income Name</label>
                            <input type="text" id="incomeNameEdit" placeholder="Income Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="incomeNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="incomeAmountEdit">Income Amount</label>
                            <input type="text" id="incomeAmountEdit" placeholder="Income Amount" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="incomeAmountEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="incomeDescriptionEdit">Income Description</label>
                            <input type="text" id="incomeDescriptionEdit" placeholder="Income Description" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="incomeDescriptionEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="incomeCurrencyEdit">Income Currency</label>
                            <input type="text" id="incomeCurrencyEdit" placeholder="Income Currency" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="incomeCurrencyEditErr"></span>
                        </div>
                       
                    </div>
                    
                    <input type="hidden" id="incomeIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editIncomeSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/incomes.js"></script>