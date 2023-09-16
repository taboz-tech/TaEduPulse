<?php defined('BASEPATH') OR exit('') ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-xs-12'>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Incomes</div>
        <?php if($allIncomes): ?>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover" style="background-color: #f5f5f5">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>NAME</th>
                        <th>AMOUNT</th>
                        <th>DESCRIPTION</th>
                        <th>CURRENCY</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                        <th>PUSH INCOME</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allIncomes as $get): ?>
                    <tr>
                        <input type="hidden" value="<?=$get->id?>" class="curIncomeId">
                        <th class="incomeSN"><?=$sn?>.</th>
                        <td><span id="incomeName-<?=$get->id?>"><?=$get->name?></span></td>
                        <td><span id="incomeAmount-<?=$get->id?>"><?=$get->amount?></td>
                        <td><span id="incomeDescription-<?=$get->id?>"><?=$get->description?></td>
                        <td><span id="incomeCurrency-<?=$get->id?>"><?=$get->currency?></td>
                        <td class="text-center text-primary">
                            <span class="editIncome" id="edit-<?=$get->id?>"><i class="fa fa-pencil pointer"></i> </span>
                        </td>
                        <td class="text-center"><i class="fa fa-trash text-danger delIncome pointer"></i></td>
                        <td class="text-center text-primary">
                            <span class="updateFees" id="update-<?=$get->id?>"><i class="fa fa-money" aria-hidden="true"></i></span>
                        </td>
                    </tr>
                    <?php $sn++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- table div end-->
        <?php else: ?>
        <ul><li>No Incomes</li></ul>
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
