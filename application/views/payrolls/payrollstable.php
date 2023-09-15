<?php defined('BASEPATH') OR exit(''); ?>

<?= isset($range) && !empty($range) ? $range : ""; ?>
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">PAYSLIPS</div>
    <?php if($allPayslips): ?>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Payslip No</th>
                    <th>Staff Name</th>
                    <th>Staff Surname</th>
                    <th>Salary</th>
                    <th>Mode of Payment</th>
                    <th>Month</th>
                    <th>Bonuses</th>
                    <th>Deductions</th>
                    <th>Processing Date</th>
                    <th>Personnel</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($allPayslips as $get): ?>
                <tr>
                    <th><?= $sn ?>.</th>
                    <td><a class="pointer vpp" style="color:#b30d0d" title="Click to view payslip"><?= $get->ref ?></a></td>
                    <td><?= $get->staff_name?></td>
                    <td><?= $get->staff_surname?></td>
                    <td>$<?= number_format($get->gross_salary, 2) ?></td>
                    <td><?= $get->payment_method?></td>
                    <td><?= $get->payment_month?></td>
                    <td><?= $get->bonuses?></td>
                    <td><?= $get->deductions?></td>
                    <td><?= date('jS M, Y', strtotime($get->dateAdded)) ?></td>
                    <td><?= $get->personnel_name?></td>
                    <td class="text-center <?= $get->status ? 'text-success' : 'text-danger' ?>"> <?= $get->status ? 'Paid' : 'Pending' ?> </td>
                    <td class="text-center text-primary">
                            <span class="payroll" id="id-<?=$get->id?>"><i class="fa fa-undo"></i> </span>
                        </td>

                </tr>
                <?php $sn++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- table div end-->
    <?php else: ?>
        <ul><li>No Payslips</li></ul>
    <?php endif; ?>
    
    <!-- Pagination div -->
    <div class="col-sm-12 text-center">
        <ul class="pagination">
            <?= isset($links) ? $links : "" ?>
        </ul>
    </div>
</div>
<!-- panel end -->
