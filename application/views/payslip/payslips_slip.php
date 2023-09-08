<?php
defined('BASEPATH') OR exit('');
?>
<?php if($allTransInfo):?>
<?php $sn = 1; ?>
<div id="payslipToPrint">
    <div class="row">
        <div class="col-xs-12 text-center text-uppercase">
            <center style='margin-bottom:5px'><img src="<?=base_url()?>public/images/logo.png" alt="logo" class="img-responsive" width="45px"></center>
            <b>Your Company Name</b>
            <div>Contact Information: Phone: 123-456-7890 | Email: info@example.com</div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-12">
            <b>Payslip for <?=isset($employeeName) ? $employeeName : ""?></b>
        </div>
    </div>
    
    <div class="row" style="margin-top:2px">
        <div class="col-sm-12">
            <label>Employee ID:</label>
            <span><?=isset($employeeId) ? $employeeId : ""?></span>
		</div>
    </div>
    
	<div class="row" style='font-weight:bold'>
		<div class="col-xs-4">Earnings</div>
        <div class="col-xs-4">Deductions</div>
        <div class="col-xs-4">Total</div>
	</div>
	<hr style='margin-top:2px; margin-bottom:0px'>
    <?php $totalEarnings = 0; ?>
    <?php $totalDeductions = 0; ?>
    <?php foreach($allTransInfo as $entry):?>
        <div class="row">
            <div class="col-xs-4"><?=ellipsize($entry['earningType'], 10);?></div>
            <div class="col-xs-4"><?=ellipsize($entry['deductionType'], 10);?></div>
            <div class="col-xs-4">$<?=number_format($entry['amount'], 2)?></div>
        </div>
        <hr style='margin-top:2px; margin-bottom:0px'>
        <?php if ($entry['earningType']) {
            $totalEarnings += $entry['amount'];
        } elseif ($entry['deductionType']) {
            $totalDeductions += $entry['amount'];
        }?>
    <?php endforeach; ?>
    <hr style='margin-top:2px; margin-bottom:0px'>       
    <div class="row">
        <div class="col-xs-12 text-right">
            <b>Total Earnings: $<?=isset($totalEarnings) ? number_format($totalEarnings, 2) : 0?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-right">
            <b>Total Deductions: $<?=isset($totalDeductions) ? number_format($totalDeductions, 2) : 0?></b>
        </div>
    </div>
    <hr style='margin-top:5px; margin-bottom:0px'>
    <div class="row margin-top-5">
        <div class="col-xs-12">
            <b>Net Pay: $<?=isset($netPay) ? number_format($netPay, 2) : ""?></b>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 text-center">Thank you for your hard work!</div>
    </div>
</div>
<br class="hidden-print">
<div class="row hidden-print">
    <div class="col-sm-12">
        <div class="text-center">
            <button type="button" class="btn btn-primary ptr">
                <i class="fa fa-print"></i> Print Payslip
            </button>
            
            <button type="button" data-dismiss='modal' class="btn btn-danger">
                <i class="fa fa-close"></i> Close
            </button>
        </div>
    </div>
</div>
<br class="hidden-print">
<?php endif;?>
