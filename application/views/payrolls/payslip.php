<?php defined('BASEPATH') OR exit(''); ?>

<!-- Check if payslip data exists -->
<?php if ($allPayrollInfo): ?>
    <div id="payslipToPrint">
        <div class="row">
            <div class="col-xs-12 text-center text-uppercase">
                <center style='margin-bottom:5px'><img src="<?=base_url()?>public/images/receipt_logo2.png" alt="logo" class="img-responsive" width="45px"></center>
                <b>Your Company Name</b>
                <div>Contact Info: Phone, Email, Address</div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-12">
                <b><?= $currentMonth ?></b>
            </div>
        </div>

        <div class="row" style="margin-top:2px">
            <div class="col-sm-12">
                <label>Payslip No:</label>
                <span><?= $ref ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <label>Employee Name:</label>
                <span><?= $staffName . ' ' . $staffSurname ?></span>
            </div>
            <div class="col-xs-6">
                <label>Employee ID:</label>
                <span><?= $staffStaff_id ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <label>Employee Address:</label>
                <span><?= $staffAddress ?></span>
            </div>
            <div class="col-xs-6">
                <label>Employee Phone:</label>
                <span><?= $staffPhone ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <label>Employee Email:</label>
                <span><?= $staffEmail ?></span>
            </div>
            <div class="col-xs-6">
                <label>Tax Identification Number:</label>
                <span><?= $tax_identification_number ?></span>
            </div>
        </div>

        <!-- Earnings Section -->
        <div class="row" style="font-weight:bold; margin-top:10px">
            <div class="col-xs-12">Earnings</div>
        </div>
        <hr style="margin-top:2px; margin-bottom:0px">
        <?php $totalEarnings = 0; ?>
        <?php foreach ($allPayrollInfo['earnings'] as $earning): ?>
            <div class="row">
                <div class="col-xs-6"><?= ellipsize($earning['name'], 15); ?></div>
                <div class="col-xs-6">$<?= number_format($earning['amount'], 2) ?></div>
            </div>
            <hr style="margin-top:2px; margin-bottom:0px">
            <?php $totalEarnings += $earning['amount']; ?>
        <?php endforeach; ?>

        <!-- Deductions Section -->
        <div class="row" style="font-weight:bold; margin-top:10px">
            <div class="col-xs-12">Deductions</div>
        </div>
        <hr style="margin-top:2px; margin-bottom:0px">
        <?php $totalDeductions = 0; ?>
        <?php foreach ($allPayrollInfo['deductions'] as $deduction): ?>
            <div class="row">
                <div class="col-xs-6"><?= ellipsize($deduction['name'], 15); ?></div>
                <div class="col-xs-6">$<?= number_format($deduction['amount'], 2) ?></div>
            </div>
            <hr style="margin-top:2px; margin-bottom:0px">
            <?php $totalDeductions += $deduction['amount']; ?>
        <?php endforeach; ?>

        <div class="row">
            <div class="col-xs-12 text-right">
                <b>Total Earnings: $<?= number_format($totalEarnings, 2) ?></b>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 text-right">
                <b>Total Deductions: $<?= number_format($totalDeductions, 2) ?></b>
            </div>
        </div>

        <div class="row" style="margin-top:10px">
            <div class="col-xs-12 text-right">
                <b>Net Salary: $<?= number_format($totalEarnings - $totalDeductions, 2) ?></b>
            </div>
        </div>

        <!-- Additional payslip details go here -->

        <br>
        <div class="row">
            <div class="col-xs-12 text-center">Thank you for your work!</div>
        </div>
    </div>

    <br class="hidden-print">
    <div class="row hidden-print">
        <div class="col-sm-12">
            <div class="text-center">
                <button type="button" class="btn btn-primary ptr" onclick="window.print()">
                    <i class="fa fa-print"></i> Print Payslip
                </button>
            </div>
        </div>
    </div>
    <br class="hidden-print">

<?php else: ?>
    <p>No payslip data available.</p>
<?php endif; ?>
