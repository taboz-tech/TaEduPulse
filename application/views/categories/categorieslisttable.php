<?php defined('BASEPATH') OR exit('') ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Categories</div>
        <?php if($allCategories): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allCategories as $get): ?>
                    <tr>
                        <input type="hidden" value="<?=$get->id?>" class="curCategorieId">
                        <th class="categorieSN"><?=$sn?>.</th>
                        <td><span id="categorieName-<?=$get->id?>"><?=$get->name?></span></td>
                        <td><span id="categorieDescription-<?=$get->id?>"><?=$get->description?></td>
                        <td class="text-center text-primary">
                            <span class="editCategorie" id="edit-<?=$get->id?>"><i class="fa fa-pencil pointer"></i> </span>
                        </td>
                        <td class="text-center"><i class="fa fa-trash text-danger delCategorie pointer"></i></td>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Categories</li></ul>
        <?php endif; ?>
    </div>
    <!--- panel end-->
</div>

<!---Pagination div-->
<div class="col-sm-12 text-center">
    <ul class="pagination">
        <?= isset($links) ? $links : "" ?>
    </ul>
</div>
