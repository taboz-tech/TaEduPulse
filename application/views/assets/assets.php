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
                        <button class="btn btn-primary btn-sm" id='createAsset'>Add New Asset</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="assetsListPerPage">Show</label>
                        <select id="assetsListPerPage" class="form-control">
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
                        <label for="assetsListSortBy">Sort by</label>
                        <select id="assetsListSortBy" class="form-control">
                            <option value="description-ASC">Description (ASC)</option>
                            <option value="description-DESC">Description (DESC)</option>
                            <option value="asset_number-ASC">Asset Number (ASC)</option>
                            <option value="asset_number-DESC">Asset Number(DESC)</option>
                            <option value="location-ASC">Location (ASC)</option>
                            <option value="location-DESC">Location (DESC)</option>
                            <option value="purchase_date-ASC"> Date (ASC)</option>
                            <option value="purchase_date-DESC">Date (DESC)</option>
                            <option value="supplier-ASC">Supplier (ASC)</option>
                            <option value="supplier-DESC">Supplier (DESC)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='assetSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="assetSearch" class="form-control" placeholder="Search Assets">
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 form-inline form-group-sm">
                        <button class="btn btn-primary btn-sm" id='printList'>Print Asset List </button>
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Asset form and  list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update a Asset-->
            <div class="col-sm-4 hidden" id='createNewAssetDiv'>
                <div class="well">
                    <button class="close cancelAddAsset">&times;</button><br>
                    <form name="addNewAssetForm" id="addNewAssetForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="assetNumber">Asset Number</label>
                                <input type="text" id="assetNumber" name="assetNumber" placeholder="Asset Number" maxlength="15"
                                    class="form-control" onchange="checkField(this.value, 'assetNumberErr')" autofocus>
                                <span class="help-block errMsg" id="assetNumberErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="description">Description</label>
                                <input type="text" id="description" name="description" placeholder="Description" maxlength="255"
                                    class="form-control" onchange="checkField(this.value, 'descriptionErr')">
                                <span class="help-block errMsg" id="descriptionErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="serialNumber">Serial Number</label>
                                <input type="text" id="serialNumber" name="serialNumber" placeholder="Serial Number" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'serialNumberErr')">
                                <span class="help-block errMsg" id="serialNumberErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" placeholder="Location" maxlength="50"
                                    class="form-control" onchange="checkField(this.value, 'locationErr')">
                                <span class="help-block errMsg" id="locationErr"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="cost">Cost</label>
                                <input type="number" id="cost" name="cost" placeholder="Cost" class="form-control"
                                    onchange="checkField(this.value, 'costErr')">
                                <span class="help-block errMsg" id="costErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="depreciationMethod">Depreciation Method</label>
                                <select id="depreciationMethod" name="depreciationMethod" class="form-control">
                                    <option value="Straight-Line">Straight-Line</option>
                                    <option value="Declining Balance">Declining Balance</option>
                                    <!-- Add other depreciation methods as options -->
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="depreciationRate">Depreciation Rate</label>
                                <input type="number" id="depreciationRate" name="depreciationRate" placeholder="Depreciation Rate"
                                    class="form-control" onchange="checkField(this.value, 'depreciationRateErr')">
                                <span class="help-block errMsg" id="depreciationRateErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="owner">Owner</label>
                                <input type="text" id="owner" name="owner" placeholder="Owner" class="form-control"
                                    onchange="checkField(this.value, 'ownerErr')">
                                <span class="help-block errMsg" id="ownerErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="supplier">Supplier</label>
                                <input type="text" id="supplier" name="supplier" placeholder="Supplier" class="form-control"
                                    onchange="checkField(this.value, 'supplierErr')">
                                <span class="help-block errMsg" id="supplierErr"></span>
                            </div>
                        </div>


                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewAsset">Add Asset</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddAsset" class="btn btn-danger btn-sm cancelAddAsset" form='addNewAssetForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Asset list div-->
            <div class="col-sm-12" id="assetsListDiv">
                <!-- Asset list Table-->
                <div class="row">
                    <div class="col-sm-12" id="assetsListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of asset list div-->

        </div>
    </div>
    <!-- End of row of adding new asset form and assets list table-->
</div>

<!--modal to edit asset-->
<div id="editAssetModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Asset</h4>
                <div id="editAssetFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="assetNumberEdit">Asset Number</label>
                            <input type="text" id="assetNumberEdit" name="assetNumberEdit" placeholder="Asset Number" class="form-control checkField">
                            <span class="help-block errMsg" id="assetNumberEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="descriptionEdit">Description</label>
                            <input type="text" id="descriptionEdit" name="descriptionEdit" placeholder="Description" class="form-control checkField">
                            <span class="help-block errMsg" id="descriptionEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="serialNumberEdit">Serial Number</label>
                            <input type="text" id="serialNumberEdit" name="serialNumberEdit" placeholder="Serial Number" class="form-control checkField">
                            <span class="help-block errMsg" id="serialNumberEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="locationEdit">Location</label>
                            <input type="text" id="locationEdit" name="locationEdit" placeholder="Location" class="form-control checkField">
                            <span class="help-block errMsg" id="locationEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="purchaseDateEdit">Purchase Date</label>
                            <input type="date" id="purchaseDateEdit" name="purchaseDateEdit" class="form-control checkField">
                            <span class="help-block errMsg" id="purchaseDateEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="supplierEdit">Supplier</label>
                            <input type="text" id="supplierEdit" name="supplierEdit" placeholder="Supplier" class="form-control checkField">
                            <span class="help-block errMsg" id="supplierEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="costEdit">Cost</label>
                            <input type="number" id="costEdit" name="costEdit" placeholder="Cost" class="form-control checkField">
                            <span class="help-block errMsg" id="costEditErr"></span>
                        </div>

                        <div class="col-sm-4 form-group-sm">
                            <label for="depreciationMethodEdit">Depreciation Method</label>
                            <select id="depreciationMethodEdit" name="depreciationMethodEdit" class="form-control checkField">
                                    <option value="Straight-Line">Straight-Line</option>
                                    <option value="Declining Balance">Declining Balance</option>
                             </select>
                            <span class="help-block errMsg" id="depreciationMethodEditErr"></span>
                        </div>


                        <div class="col-sm-4 form-group-sm">
                            <label for="depreciationRateEdit">Depreciation Rate</label>
                            <input type="number" id="depreciationRateEdit" name="depreciationRateEdit" placeholder="Depreciation Rate" class="form-control checkField">
                            <span class="help-block errMsg" id="depreciationRateEditErr"></span>
                        </div>

                        

                        <div class="col-sm-4 form-group-sm">
                            <label for="ownerEdit">Owner</label>
                            <input type="text" id="ownerEdit" name="ownerEdit" placeholder="Owner" class="form-control checkField">
                            <span class="help-block errMsg" id="ownerEditErr"></span>
                        </div>


                        
                    </div>
                    
                    <input type="hidden" id="assetIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editAssetSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url()?>public/pdfmake/build/vfs_fonts.js"></script>
<script src="<?=base_url()?>public/js/assets.js"></script>
