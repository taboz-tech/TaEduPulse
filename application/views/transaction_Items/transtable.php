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
                    <th>Total Items</th>
                    <th>Total Amount</th>
                    <th>Amount Tendered</th>
                    <th>Change Due</th>
                    <th>Mode of Payment</th>
                    <th>Staff</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($allTransactions as $get): ?>
                <tr>
                    <th><?= $sn ?>.</th>
                    <td><a class="pointer vtri" style="color:#b30d0d" title="Click to view receipt"><?= $get->ref ?></a></td>
                    <td><?= $get->quantity ?></td>
                    <td>
                        <?php
                        // Assuming $get->totalPrice is a string containing comma-separated values like "4.50,7.50,37.03"
                        $totalPriceArray = explode(',', $get->totalPrice);

                        // Initialize a variable to store the sum
                        $totalSum = 0;

                        // Loop through the array and add each value to the sum
                        foreach ($totalPriceArray as $price) {
                            $totalSum += (float) $price;
                        }

                        // Format the sum with 2 decimal places
                        $formattedTotalSum = number_format($totalSum, 2);

                        // Display the result
                        echo $formattedTotalSum;
                        ?>
                    </td>

                    <td>$<?= number_format($get->amountTendered, 2) ?></td>
                    <td>$<?= number_format($get->changeDue, 2) ?></td>
                    <td><?=  str_replace("_", " ", $get->modeOfPayment)?></td>
                    <td><?=$get->staffName?></td>
                    <td><?=$get->cust_name?> - <?=$get->cust_phone?> - <?=$get->cust_email?></td>
                    <td><?= date('jS M, Y h:ia', strtotime($get->transDate)) ?></td>
                    <td><?=$get->cancelled ? 'Cancelled' : 'Completed'?></td>
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