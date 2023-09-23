<?php
defined('BASEPATH') OR exit('');
?>
<?php if($allTransInfo):?>
<?php $sn = 1; ?>
<div id="transReceiptToPrint">
    <div class="row">
        <div class="col-xs-12 text-center text-uppercase">
            <center style='margin-bottom:5px'><img src="<?=base_url()?>public/images/receipt_logo2.png" alt="logo" class="img-responsive" width="45px"></center>
            <b>3084  MAFURA TABOZ PVT , B-7</b>
            <div>077 592 3458, 071 532 8408</div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-12">
            <b><?=isset($transDate) ? date('jS M, Y h:i:sa', strtotime($transDate)) : ""?></b>
        </div>
    </div>
    
    <div class="row" style="margin-top:2px">
        <div class="col-sm-12">
            <label>Receipt No:</label>
            <span><?=isset($ref) ? $ref : ""?></span>
        </div>
    </div>
    
    <div class="row" style='font-weight:bold'>
        <div class="col-xs-4">Name</div>
        <div class="col-xs-4">Surname</div>
        <div class="col-xs-4">Term</div>
    </div>
    <hr style='margin-top:2px; margin-bottom:0px'>
    <?php $init_total = 0; ?>
    <?php foreach($allTransInfo as $get):?>
        <div class="row">
            <div class="col-xs-4"><?=ellipsize($get['studentName'], 10);?></div>
            <div class="col-xs-4"><?=ellipsize($get['studentSurname'], 10);?></div>
            <div class="col-xs-4"><?= $get['term'] ?></div>
        </div>
        <hr style='margin-top:2px; margin-bottom:0px'>
        <div class="col-xs-12 text-right">
            <b>Amount: $<?=number_format($get['totalAmount'], 2)?></b>
        </div>
        <?php $init_total += $get['totalAmount'];?>
    <?php endforeach; ?>
    <hr style='margin-top:2px; margin-bottom:0px'>       
    <div class="row">
        <div class="col-xs-12 text-right">
            <b>Total: $<?=isset($init_total) ? number_format($init_total, 2) : 0?></b>
        </div>
    </div>
    
    <?php if ($refundAmount !== null && $refundAmount !== 0): ?>
    <hr style='margin-top:2px; margin-bottom:0px'>
    <div class="row">
        <div class="col-xs-12 text-right">
            <b>Refund: $<?=number_format($refundAmount, 2)?></b>
        </div>
    </div>
    <?php endif; ?>
    
    <?php
    // Calculate the final total by subtracting the refund amount
    $finalTotal = isset($cumAmount) ? $cumAmount - $refundAmount : 0;
    ?>
    <hr style='margin-top:2px; margin-bottom:0px'>            
    <div class="row">
        <div class="col-xs-12 text-right">
            <b>FINAL TOTAL: $<?=number_format($finalTotal, 2)?></b>
        </div>
    </div>
    
    <hr style='margin-top:5px; margin-bottom:0px'>
    <div class="row margin-top-5">
        <div class="col-xs-12">
            <b>Mode of Payment: <?=isset($_mop) ? str_replace("_", " ", $_mop) : ""?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <b>Amount Tendered: $<?=isset($amountTendered) ? number_format($amountTendered, 2) : ""?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <b>Change: $<?=isset($changeDue) ? number_format($changeDue, 2) : ""?></b>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <b>Currency: <?=isset($currency) ? $currency : ""?></b>
        </div>
    </div>
    <hr style='margin-top:5px; margin-bottom:0px'>
    <div class="row margin-top-5">
        <div class="col-xs-12">
            <b>Customer Name: <?=$cust_name?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <b>Customer Phone: <?=$cust_phone?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <b>Customer Email: <?=$cust_email?></b>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 text-center">Thanks for your patronage</div>
    </div>
</div>
<br class="hidden-print">
<div class="row hidden-print">
    <div class="col-sm-12">
        <div class="text-center">
            <button type="button" class="btn btn-primary ptr">
                <i class="fa fa-print"></i> Print Receipt
            </button>
            
            <button type="button" data-dismiss='modal' class="btn btn-danger">
                <i class="fa fa-close"></i> Close
            </button>
        </div>
    </div>
</div>
<br class="hidden-print">
<?php endif;?>
