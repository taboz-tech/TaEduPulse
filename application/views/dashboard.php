<?php
defined('BASEPATH') OR exit('');
?>

<div class="row latestStuffs">
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #b71c1c">
                <div class="pull-left"><i class="fa fa-archive"></i></div>
                <div class="pull-right">
                    <div><?=$totalStudents?></div>
                    <div class="latestStuffsText pull-right">Students Enrolled</div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#b71c1c">Total Students In School</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #5cb85c">
                <div class="pull-left"><i class="fa fa-money"></i></div>
                <div class="pull-right">
                    <div><?=$totalSalesToday?></div>
                    <div class="latestStuffsText">Today's Total Payments</div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#5cb85c">Total Amount of Today's Payments</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #607d8b">
                <div class="pull-left"><i class="fa fa-exchange"></i></div>
                <div class="pull-right">
                    <div><?=$totalTransactions?></div>
                    <div class="latestStuffsText pull-right">Total Transactions</div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#607d8b">All-Time Total Transactions</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color:#795548">
                <div class="pull-left"><i class="fa fa-dollar"></i></div>
                <div class="pull-right">
                    <div> <?php $query = $this->db->query('SELECT SUM( totalAmount)as total FROM transactions')->row(); echo floatval($query->total);?></div>
                    <div class="latestStuffsText pull-right">Total Earnings Till Date</div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color#795548">All-Time Total Earnings</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color:#5cb85c">
                <div class="pull-left"><i class="fa fa-dollar"></i></div>
                <div class="pull-right">
                    <div>
                    <?php
                        $query = $this->db->query('SELECT totalMoneySpent, totalAmount FROM transactions');
                        $transactions = $query->result();

                        $totalProfit = 0;

                        foreach ($transactions as $transaction) {
                            $totalMoneySpent = $transaction->totalMoneySpent;
                            $totalAmount = $transaction->totalAmount;

                            $transactionProfit = $totalAmount - $totalMoneySpent;

                            $totalProfit += $transactionProfit;
                        }

                        echo "Total Profit: " . number_format($totalProfit, 2) . "\n";
                    ?>

                    </div>
                    <div class="latestStuffsText pull-right">Month Profit </div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color#5cb85c">Last 30 Days Profit</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color:#5cb85c">
                <div class="pull-left"><i class="fa fa-dollar"></i></div>
                <div class="pull-right">
                    <div>
                    <?php
                        $query = $this->db->query('SELECT totalMoneySpent, totalAmount FROM transactions WHERE transDate >= CURDATE() AND transDate < CURDATE() + INTERVAL 1 DAY;');
                        $transactions = $query->result();

                        $totalProfit = 0;

                        foreach ($transactions as $transaction) {
                            $totalMoneySpent = $transaction->totalMoneySpent;
                            $totalAmount = $transaction->totalAmount;

                            $transactionProfit = $totalAmount - $totalMoneySpent;

                            $totalProfit += $transactionProfit;
                        }

                        echo "Total Profit for Today: " . number_format($totalProfit, 2) . "\n";
                    ?>

                    </div>
                    <div class="latestStuffsText pull-right">Today Profit </div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color#5cb85c">Today's Profit</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color:#333333">
                <div class="pull-left"><i class="fa fa-dollar"></i></div>
                <div class="pull-right">
                    <div>
                    <?php
                        $query = $this->db->query('SELECT SUM(CASE WHEN owed_fees <> 0 THEN owed_fees ELSE 0 END) AS totalCost FROM students;');
                        $result = $query->row(); 
                        $totalCost = $result->totalCost;
                        if ($totalCost !== null) {
                            echo number_format($totalCost, 2);
                        } else {
                            echo "No Cost";
                        }
                    ?>
                    </div>
                    <div class="latestStuffsText pull-right">Total Cost </div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color#333333">Total Cost For All Inventories</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color:#333333">
                <div class="pull-left"><i class="fa fa-dollar"></i></div>
                <div class="pull-right">
                    <div>
                    <?php
                        $query = $this->db->query('SELECT SUM(owed_fees) AS totalCost FROM students
                                                    WHERE MONTH(dateAdded) = MONTH(CURDATE());
                                                ');
                        $result = $query->row(); 
                        $totalCost = $result->totalCost;
                        if ($totalCost !== null) {
                            echo number_format($totalCost, 2);
                        } else {
                            echo "No Cost";
                        }
                    ?>
                    </div>
                    <div class="latestStuffsText pull-right">Total Cost </div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color#333333">Total Cost For Current Month</div>
        </div>
    </div>
   
</div>


<!-- ROW OF GRAPH/CHART OF EARNINGS PER MONTH/YEAR-->
<div class="row margin-top-5">
    <div class="col-sm-9">
        <div class="box">
            <div class="box-header" style="background-color:/*#33c9dd*/#333;">
              <h3 class="box-title" id="earningsTitle"></h3>
            </div>

            <div class="box-body" style="background-color:/*#33c9dd*/#333;">
              <canvas style="padding-right:25px" id="earningsGraph" width="200" height="80"/></canvas>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <section class="panel form-group-sm">
            <label class="control-label">Select Account Year:</label>
            <select class="form-control" id="earningAndExpenseYear">
                <?php $years = range("2016", date('Y')); ?>
                <?php foreach($years as $y):?>
                <option value="<?=$y?>" <?=$y == date('Y') ? 'selected' : ''?>><?=$y?></option>
                <?php endforeach; ?>
            </select>
            <span id="yearAccountLoading"></span>
        </section>
        
        <section class="panel">
          <center>
              <canvas id="paymentMethodChart" width="200" height="200"/></canvas><br>Payment Methods(%)<span id="paymentMethodYear"></span>
          </center>
        </section>
    </div>
</div>
<!-- END OF ROW OF GRAPH/CHART OF EARNINGS PER MONTH/YEAR-->

<!-- ROW OF SUMMARY -->
<div class="row margin-top-5">
    <div class="col-sm-3">
        <div class="panel panel-hash">
            <div class="panel-heading"><i class="fa fa-level-up"></i> HIGH IN DEMAND</div>
            <?php if($topPayersLastTwoMonths): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Total Spent</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($topPayersLastTwoMonths as $payer):?>
                    <tr>
                        <td><?= $payer->name . ' ' . $payer->surname ?></td>
                        <td><?= $payer->totalSpent ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            No Transactions
            <?php endif; ?>
        </div>
    </div>


    
    <div class="col-sm-3">
        <div class="panel panel-hash">
            <div class="panel-heading"><i class="fa fa-level-up"></i> HIGH IN DEMAND</div>
            <?php if($leastPayersLastTwoMonths): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Total Spent</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($leastPayersLastTwoMonths as $payer):?>
                    <tr>
                        <td><?= $payer->name . ' ' . $payer->surname ?></td>
                        <td><?= $payer->totalSpent ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            No Transactions
            <?php endif; ?>
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="panel panel-hash">
            <div class="panel-heading"><i class="fa fa-dollar"></i> HIGHEST EARNING</div>
            <?php if($highestSpenders): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Total Earned</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($highestSpenders as $get):?>
                    <tr>
                        <td><?=$get->name . ' ' . $get->surname?></td>
                        <td>$<?=number_format($get->totalSpent, 2)?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            No Transactions
            <?php endif; ?> 
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="panel panel-hash">
            <div class="panel-heading"><i class="fa fa-dollar"></i> HIGHEST EARNING</div>
            <?php if($highestSpenders): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Total Earned</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($highestSpenders as $get):?>
                    <tr>
                        <td><?=$get->name . ' ' . $get->surname?></td>
                        <td>$<?=number_format($get->totalSpent, 2)?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            No Transactions
            <?php endif; ?> 
        </div>
    </div>
</div>
<!-- END OF ROW OF SUMMARY -->

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-hash">
            <div class="panel-heading">Daily Transactions</div>
            <div class="panel-body scroll panel-height">
                <?php if(isset($dailyTransactions) && $dailyTransactions): ?>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Tot. Trans</th>
                            <th>Tot. Earned</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($dailyTransactions as $get): ?>
                        <tr>
                            <td><?=
                                    date('l jS M, Y', strtotime($get->transactionDate)) === date('l jS M, Y', time())
                                    ? 
                                    "Today" 
                                    : 
                                    date('l jS M, Y', strtotime($get->transactionDate));
                                ?>
                            </td>
                            <td><?=$get->tot_trans?></td>
                            <td>$<?=number_format($get->tot_earned, 2)?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php else: ?>
                <li>No Transactions</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    
    <div class="col-sm-6">
        <div class="panel panel-hash">
            <div class="panel-heading">Transactions by Days</div>
            <div class="panel-body scroll panel-height">
                <?php if(isset($transByDays) && $transByDays): ?>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Tot. Trans</th>
                            <th>Tot. Earned</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($transByDays as $get): ?>
                        <tr>
                            <td><?=$get->day?>s</td>
                            <td><?=$get->tot_trans?></td>
                            <td>$<?=number_format($get->tot_earned, 2)?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php else: ?>
                <li>No Transactions</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-hash">
            <div class="panel-heading">Transactions by Months</div>
            <div class="panel-body scroll panel-height">
                <?php if(isset($transByMonths) && $transByMonths): ?>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Tot. Trans</th>
                            <th>Tot. Earned</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($transByMonths as $get): ?>
                        <tr>
                            <td><?=$get->month?></td>
                            <td><?=$get->tot_trans?></td>
                            <td>$<?=number_format($get->tot_earned, 2)?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php else: ?>
                <li>No Transactions</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    
    <div class="col-sm-6">
        <div class="panel panel-hash">
            <div class="panel-heading">Transactions by Years</div>
            <div class="panel-body scroll panel-height">
                <?php if(isset($transByYears) && $transByYears): ?>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Tot. Trans</th>
                            <th>Tot. Earned</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($transByYears as $get): ?>
                        <tr>
                            <td><?=$get->year?></td>
                            <td><?=$get->tot_trans?></td>
                            <td>$<?=number_format($get->tot_earned, 2)?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php else: ?>
                <li>No Transactions</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url('public/js/chart.js'); ?>"></script>
<script src="<?=base_url('public/js/dashboard.js')?>"></script>