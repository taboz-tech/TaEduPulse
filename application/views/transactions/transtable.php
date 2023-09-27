<?php defined('BASEPATH') OR exit('') ?>

<?= isset($range) && !empty($range) ? $range : ""; ?>
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">TRANSACTIONS</div>
    <?php if($allTransactions): ?>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Receipt No</th>
                    <th>Student Name</th>
                    <th>Student Surname</th>
                    <th>Total Amount</th>
                    <th>Amount Tendered</th>
                    <th>Change Due</th>
                    <th>Mode of Payment</th>
                    <th>Description</th>
                    <th>Currency</th>
                    <th>Staff</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th>
                    <?php if ($this->session->admin_role !== "Basic"): ?>
                    <th>Refund</th>
                    <th>ACTION</th>
                    <?php endif; ?>

                </tr>
            </thead>
            <tbody>
                <?php foreach($allTransactions as $get): ?>
                <tr>
                    <th><?= $sn ?>.</th>
                    <td><a class="pointer vtr" style="color:#b30d0d" title="Click to view receipt"><?= $get->ref ?></a></td>
                    <td><?= $get->studentName?></td>
                    <td><?= $get->studentSurname?></td>
                    <td>$<?= number_format($get->totalMoneySpent, 2) ?></td>
                    <td>$<?= number_format($get->amountTendered, 2) ?></td>
                    <td>$<?= number_format($get->changeDue, 2) ?></td>
                    <td><?=  str_replace("_", " ", $get->modeOfPayment)?></td>
                    <td><?=$get->description?></td>
                    <td><?=$get->currency?></td>
                    <td><?=$get->staffName?></td>
                    <td><?=$get->cust_name?> - <?=$get->cust_phone?> - <?=$get->cust_email?></td>
                    <td><?= date('jS M, Y h:ia', strtotime($get->transDate)) ?></td>
                    <td><?=$get->cancelled ? 'Cancelled' : 'Completed'?></td>
                    <?php if ($this->session->admin_role !== "Basic"): ?>
                    <td class="text-center">
                        <?php if ($get->refundAmount === null): ?>
                            <span class="text-warning refund-action" data-refundable="true"><i class="fa fa-exclamation"></i></span>
                        <?php elseif ($get->refundAmount == 0): ?>
                            <span class="text-success refund-action" data-refundable="true"><i class="fa fa-check"></i></span>
                        <?php elseif ($get->refundAmount == $get->totalMoneySpent): ?>
                            <span class="text-danger refund-action" data-refundable="false"><i class="fa fa-times"></i></span>
                        <?php else: ?>
                            <span class="text-success refund-action" data-refundable="true"><i class="fa fa-check"></i></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center text-primary">
                        <span class="refundTrans" id="refund-<?=$get->transId?>"><i class="fa fa-reply"></i> </span>
                    </td>
                    <?php endif; ?>

                </tr>
                <?php $sn++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- table div end-->
    <?php else: ?>
    <ul><li>No Transactions</li></ul>
    <?php endif; ?>

    <!--Pagination div-->
    <div class="col-sm-12 text-center">
        <ul class="pagination">
            <?= isset($links) ? $links : "" ?>
        </ul>
    </div>
</div>
<!-- panel end-->
