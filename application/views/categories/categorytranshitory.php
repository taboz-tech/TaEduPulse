<?php defined('BASEPATH') OR exit('') ?>

<!--An Categories's transactions history--->
<div class="col-sm-4">
    <div class="row">
        <div class="col-sm-12 form-group-sm form-inline">
            <div class="col-sm-4">
                Show
                <select id="categoriePerPage" class="form-control">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="col-sm-4">
                <select id="sortCategories" class="form-control">
                    <option value="">Sort by</option>
                    <option value="status-asc">Category Status</option>
                </select>
            </div>
            <div class="col-sm-4">
                <input type="search" id="categorieSearch" class="form-control" placeholder="Search Categories">
            </div>
        </div>
    </div>
    <br>
    
    <!--Row of Categorie's transactions -->
    <div class="row">
        <div class="col-sm-12" id='categorieTransHistoryTable'>
            
        </div>
    </div>
</div>
<!--End of an Categorie's transactions history--->