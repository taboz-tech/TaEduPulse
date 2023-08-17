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
                        <button class="btn btn-primary btn-sm" id='createCurrencie'>Add New Currency</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="currenciesListPerPage">Show</label>
                        <select id="currenciesListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="currenciesListSortBy">Sort by</label>
                        <select id="currenciesListSortBy" class="form-control">
                            <option value="name-ASC">Currency Name (A-Z)</option>
                            <option value="name-DESC">Currency Name (Z-A)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='currencieSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="currencieSearch" class="form-control" placeholder="Search Currency">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Currency form and Currencies list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add a Currency-->
            <div class="col-sm-4 hidden" id='createNewCurrencieDiv'>
                <div class="well">
                    <button class="close cancelAddCurrencie">&times;</button><br>
                    <form name="addNewCurrencieForm" id="addNewCurrencieForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="currencieName">Currency Name</label>
                                <input type="text" id="currencieName" name="currencieName" placeholder="Currency Name" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'currencieNameErr')">
                                <span class="help-block errMsg" id="currencieNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="currencieRate">Currency Rate</label>
                                <input type="number" id="currencieRate" name="currencieRate" placeholder="Currency Rate" min="0"
                                    class="form-control" onchange="checkField(this.value, 'currencieRateErr')">
                                <span class="help-block errMsg" id="currencieRateErr"></span>
                            </div>
                        </div>
                        
                       
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewCurrencie">Add Currency</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddCurrencie" class="btn btn-danger btn-sm cancelAddCurrencie" form='addNewCurrencieForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Currencie list div-->
            <div class="col-sm-12" id="currenciesListDiv">
                <!-- Currencie list Table-->
                <div class="row">
                    <div class="col-sm-12" id="currenciesListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of Currencie list div-->

        </div>
    </div>
    <!-- End of row of adding new Currencie form and currencies list table-->
</div>

<!--modal to edit currencies-->
<div id="editCurrencieModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Currency</h4>
                <div id="editCurrencieFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="currencieNameEdit">Currency Name</label>
                            <input type="text" id="currencieNameEdit" placeholder="Currency Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="currencieNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="currencieRateEdit">Currency Rate</label>
                            <input type="number" id="currencieRateEdit" placeholder="Currency Rate" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="currencieRateEditErr"></span>
                        </div>

                       
                    </div>
                    
                    <input type="hidden" id="currencieIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editCurrencieSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/currencies.js"></script>