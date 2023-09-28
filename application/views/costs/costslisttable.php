<?php defined('BASEPATH') OR exit('') ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Costs</div>
        <?php if($allCosts): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>NAME</th>
                        <th>AMOUNT</th>
                        <th>CATEGORY</th>
                        <th>DESCRIPTION</th>
                        <th>CURRENCY</th>
                        <th>BALANCE</th>
                        <th>DATE</th>
                        <th>PAID</th>
                        <th>STATUS</th>
                        <?php if ($this->session->admin_role !== "Basic"): ?>
                        <th>PAY</th>
                        <?php endif; ?>
                        <th>EDIT</th>
                        <?php if ($this->session->admin_role !== "Basic"): ?>
                        <th>DELETE</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allCosts as $get): ?>
                    <tr>
                        <input type="hidden" value="<?=$get->id?>" class="curCostId">
                        <th class="costSN"><?=$sn?>.</th>
                        <td><span id="costName-<?=$get->id?>"><?=$get->name?></span></td>
                        <td><span id="costAmount-<?=$get->id?>"><?=$get->amount?></td>
                        <td><span id="costCategory-<?=$get->id?>"><?=$get->category?></td>
                        <td><span id="costDescription-<?=$get->id?>"><?=$get->description?></td>
                        <td><span id="costCurrency-<?=$get->id?>"><?=$get->currency?></td>
                        <td><span id="costBalance-<?=$get->id?>"><?=$get->balance?></td>
                        <td><span id="costDate-<?=$get->id?>"><?=$get->dateAdded?></td>
                        <td><span id="costPaid-<?=$get->id?>"><?=$get->paid?></td>
                        <td class="text-center <?= $get->status ? 'text-success' : 'text-danger' ?>"> <?= $get->status ? 'Paid' : 'Pending' ?> </td>
                        <?php if ($this->session->admin_role !== "Basic"): ?>
                        <td class="text-center text-primary">
                            <span class="payCost" id="pay-<?=$get->id?>"><i class="fa fa-money"></i> </span>
                        </td>
                        <?php endif; ?>
                        <td class="text-center text-primary">
                            <span class="editCost" id="edit-<?=$get->id?>"><i class="fa fa-pencil pointer"></i> </span>
                        </td>
                        <?php if ($this->session->admin_role !== "Basic"): ?>
                        <td class="text-center"><i class="fa fa-trash text-danger delCost pointer"></i></td>
                        <?php endif; ?>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Costs</li></ul>
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
