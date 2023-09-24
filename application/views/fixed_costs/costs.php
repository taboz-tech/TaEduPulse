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
                        <button class="btn btn-primary btn-sm" id='createCost'>Add New Cost</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="costsListPerPage">Show</label>
                        <select id="costsListPerPage" class="form-control">
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
                        <label for="costsListSortBy">Sort by</label>
                        <select id="costsListSortBy" class="form-control">
                            <option value="name-ASC">Cost Name (A-Z)</option>
                            <option value="category-ASC">Cost Category (Ascending)</option>
                            <option value="dateAdded-ASC">Date Added (Ascending)</option>
                            <option value="name-DESC">Cost Name (Z-A)</option>
                            <option value="category-DESC">Cost Category (Descending)</option>
                            <option value="dateAdded-DESC">Date Added (Descending)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='costSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="costSearch" class="form-control" placeholder="Search Costs">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Cost form and Costs list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add a Cost-->
            <div class="col-sm-4 hidden" id='createNewCostDiv'>
                <div class="well">
                    <button class="close cancelAddCost">&times;</button><br>
                    <form name="addNewCostForm" id="addNewCostForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="costName">Cost Name</label>
                                <input type="text" id="costName" name="costName" placeholder="Cost Name" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'costNameErr')">
                                <span class="help-block errMsg" id="costNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="costAmount">Cost Amount</label>
                                <input type="number" id="costAmount" name="costAmount" placeholder="Cost Amount" min="0"
                                    class="form-control" onchange="checkField(this.value, 'costAmountErr')">
                                <span class="help-block errMsg" id="costAmountErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="costCategory">Cost Category</label>
                                <select id="costCategory" name="costCategory" class="form-control" onchange="checkField(this.value, 'costCategoryErr')">
                                    <option value="">Select Category</option> <!-- Add a default empty option -->
                                </select>
                                <span class="help-block errMsg" id="costCategoryErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="costDescription">Cost Description</label>
                                <input type="text" id="costDescription" name="costDescription" placeholder="Cost Description" maxlength="40"
                                    class="form-control" onchange="checkField(this.value, 'costDescriptionErr')">
                                <span class="help-block errMsg" id="costDescriptionErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="costCurrency">Cost Currency</label>
                                <select id="costCurrency" name="costCurrency" class="form-control" onchange="checkField(this.value, 'costCurrencyErr')">
                                    <option value="">Select Currency</option> <!-- Add a default empty option -->
                                </select>
                                <span class="help-block errMsg" id="costCurrencyErr"></span>
                            </div>
                        </div>

                       
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewCost">Add Cost</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddCost" class="btn btn-danger btn-sm cancelAddCost" form='addNewCostForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Cost list div-->
            <div class="col-sm-12" id="costsListDiv">
                <!-- Cost list Table-->
                <div class="row">
                    <div class="col-sm-12" id="costsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of Cost list div-->

        </div>
    </div>
    <!-- End of row of adding new Cost form and costs list table-->
</div>

<!--modal to edit costs-->
<div id="editCostModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Cost</h4>
                <div id="editCostFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="costNameEdit">Cost Name</label>
                            <input type="text" id="costNameEdit" placeholder="Cost Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="costNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="costAmountEdit">Cost Amount</label>
                            <input type="text" id="costAmountEdit" placeholder="Cost Amount" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="costAmountEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="costCategoryEdit">Cost Category</label>
                            <select id="costCategoryEdit" class="form-control checkField">
                                <option value="">Select Category</option>
                            </select>
                            <span class="help-block errMsg" id="costCategoryEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="costDescriptionEdit">Cost Description</label>
                            <input type="text" id="costDescriptionEdit" placeholder="Cost Description" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="costDescriptionEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="costCurrencyEdit">Cost Currency</label>
                            <select id="costCurrencyEdit" class="form-control checkField">
                                <option value="">Select Currency</option>
                            </select>
                            <span class="help-block errMsg" id="costCurrencyEditErr"></span>
                        </div>
                       
                    </div>
                    
                    <input type="hidden" id="costIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editCostSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->

<div id="paymentModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Payment Cost</h4>
                <div id="paymentMessage" class="text-center" style="font-weight: bold !important; color: green !important;"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <input type="hidden" id="costId" value="">
                    <input type="hidden" id="costAmountPaying" value="">

                    <div class="form-group">
                        <label for="paymentAmount">Payment Amount</label>
                        <input type="text" id="paymentAmount" placeholder="Payment Amount" class="form-control">
                        <span class="help-block" id="paymentAmountErr"></span>
                    </div>

                    <div class="form-group">
                        <label for="enablePaymentAmount">Full Payment</label>
                        <input type="checkbox" id="enablePaymentAmount">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="processPaymentSubmit">Pay Cost</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script src="<?=base_url()?>public/js/fixed_costs.js"></script>