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
                        </select>
                        <label>per page</label>
                    </div>

                    <div class="col-sm-4 form-group-sm form-inline">
                        <label for="categoriesListSortBy">Sort by</label>
                        <select id="categoriesListSortBy" class="form-control">
                            <option value="name-ASC">Category Name (A-Z)</option>
                            <option value="name-DESC">Category Name (Z-A)</option>
                            <option value="description-ASC">Description (A-Z)</option>
                            <option value="description-DESC">Description (Z-A)</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for='categorieSearch'><i class="fa fa-search"></i></label>
                        <input type="search" id="categorieSearch" class="form-control" placeholder="Search Category">
                    </div>
                </div>
            </div>
            <!-- end of sort and co div-->
        </div>
    </div>
    
    <hr>
    
    <!-- row of adding new Category form and Categories list table-->
    <div class="row">
        <div class="col-sm-12">
            <!--Form to add a Category-->
            <div class="col-sm-4 hidden" id='createNewCategorieDiv'>
                <div class="well">
                    <button class="close cancelAddCategorie">&times;</button><br>
                    <form name="addNewCategorieForm" id="addNewCategorieForm" role="form">
                        <div class="text-center errMsg" id='addCustErrMsg'></div>
                        
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorieName">Category Name</label>
                                <input type="text" id="categorieName" name="categorieName" placeholder="Category Name" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'categorieNameErr')">
                                <span class="help-block errMsg" id="categorieNameErr"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label for="categorieDescription">Category Description</label>
                                <input type="text" id="categorieDescription" name="categorieDescription" placeholder="Category Description" maxlength="30"
                                    class="form-control" onchange="checkField(this.value, 'categorieDescriptionErr')">
                                <span class="help-block errMsg" id="categorieDescriptionErr"></span>
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
    <!-- End of row of adding new Categorie form and categories list table-->
</div>

<!--modal to edit categories-->
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
                            <label for="categorieNameEdit">Category Name</label>
                            <input type="text" id="categorieNameEdit" placeholder="Category Name" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="categorieNameEditErr"></span>
                        </div>
                        
                        <div class="col-sm-4 form-group-sm">
                            <label for="categorieDescriptionEdit">Category Description</label>
                            <input type="text" id="categorieDescriptionEdit" placeholder="Category Description" autofocus class="form-control checkField">
                            <span class="help-block errMsg" id="categorieDescriptionEditErr"></span>
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