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
                        <button class="btn btn-primary btn-sm" id='createCategorie'>Add New Category</button>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="categoriesListPerPage">Show</label>
                        <select id="categoriesListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="categoriesListSortBy">Sort by</label>
                        <select id="categoriesListSortBy" class="form-control">
                            <option value="name-ASC">Category Name (A-Z)</option>
                            <option value="name-DESC">Category Name (Z-A)</option>
                            <option value="status-ASC">Category Status (Inactive)</option>
                            <option value="status-DESC">Category Status (Active)</option>
                            <option value="percentage-ASC">Category Percentage (Lowest first)</option>
                            <option value="percentage-DESC">Category Percentage (Highest first)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='categorieSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="categorieSearch" class="form-control" placeholder="Search Categories">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Categorie form and categories list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add/update a categorie-->
            <div class="col-sm-4 hidden" id='createNewCategorieDiv'>
                <div class="well">
                    <button class="close cancelAddCategorie">&times;</button><br>
                    <form name="addNewCategorieForm" id="addNewCategorieForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorieName">Category Name</label>
                                <input type="text" id="categorieName" name="categorieName" placeholder="Category Name" maxlength="25"
                                    class="form-control" onchange="checkField(this.value, 'categorieNameErr')" autofocus>
                                <span class="help-block errMsg" id="categorieNameErr"></span>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorieStatus">Category Status</label>
                                <select id="categorieStatus" name="categorieStatus" class="form-control" onchange="checkField(this.value, 'categorieStatusErr')">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="help-block errMsg" id="categorieStatusErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categoriePercentage">Category Percentage</label>
                                <input type="number" id="categoriePercentage" name="categoriePercentage" placeholder="Category Percentage"
                                    class="form-control" min="0" step="0.01" onchange="checkField(this.value, 'categoriePercentageErr')">
                                <span class="help-block errMsg" id="categoriePercentageErr"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-6 form-group-sm">
                                <button class="btn btn-primary btn-sm" id="addNewCategorie">Add Category</button>
                            </div>

                            <div class="col-sm-6 form-group-sm">
                                <button type="reset" id="cancelAddCategorie" class="btn btn-danger btn-sm cancelAddCategorie" form='addNewCategorieForm'>Cancel</button>
                            </div>
                        </div>
                    </form><!-- end of form-->
                </div>
            </div>
            
            <!--- Categorie list div-->
            <div class="col-sm-12" id="categoriesListDiv">
                <!-- Categorie list Table-->
                <div class="row">
                    <div class="col-sm-12" id="categoriesListTable"></div>
                </div>
                <!--end of table-->
            </div>
            <!--- End of Categorie list div-->

        </div>
    </div>
    <!-- End of row of adding new Category form and categories list table-->
</div>

<!--modal to edit categorie-->
<div id="editCategorieModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="text-center">Edit Category</h4>
                <div id="editCategorieFMsg" class="text-center"></div>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-4 form-group-sm">
                            <label for="categorieName">Category Name</label>
                            <input type="text" id="categorieNameEdit" placeholder="Category Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="categorieNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="categorieStatus">Category Status</label>
                            <select id="categorieStatusEdit" name="categorieStatus" class="form-control" onchange="checkField(this.value, 'categorieStatusErr')">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span class="help-block errMsg" id="categorieStatusEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="categoriePercentage">Category Percentage</label>
                            <input type="number" id="categoriePercentageEdit" name="categoriePercentage" placeholder="Category Percentage"
                                    class="form-control" min="0" step="0.01" onchange="checkField(this.value, 'categoriePercentageErr')">
                            <span class="help-block errMsg" id="categoriePercentageEditErr"></span>
                        </div>
                    </div>
                    
                    <input type="hidden" id="categorieIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="editCategorieSubmit">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<script src="<?=base_url()?>public/js/categories.js"></script>