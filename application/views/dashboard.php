<?php
defined('BASEPATH') OR exit('');
?>

<div class="row latestStuffs">
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #b71c1c">
                <div class="pull-left"><i class="fa fa-archive"></i></div>
                <div class="pull-right">
                    <div><?=$totalItems?></div>
                    <div class="latestStuffsText pull-right">Items in Stock</div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#b71c1c">Total Items in Stock</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #5cb85c">
                <div class="pull-left"><i class="fa fa-money"></i></div>
                <div class="pull-right">
                    <div><?=$totalSalesToday?></div>
                    <div class="latestStuffsText">Today's Total Sales</div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#5cb85c">Number of Items Sold Today</div>
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
                    <div> <?php $query = $this->db->query('SELECT SUM( totalPrice)as total FROM transactions')->row(); echo floatval($query->total);?></div>
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
                        $query = $this->db->query('SELECT t.itemCode, t.quantity, t.totalMoneySpent, i.cost,
                                                            t.quantity * i.cost AS totalCost,
                                                            t.totalMoneySpent - (t.quantity * i.cost) AS profit
                                                    FROM transactions AS t
                                                    JOIN items AS i ON t.itemCode = i.code
                                                    WHERE YEAR(t.transDate) = YEAR(CURDATE()) AND MONTH(t.transDate) = MONTH(CURDATE());
                                                    ');
                        $transactions = $query->result();

                        $totalProfit = 0;

                        foreach ($transactions as $transaction) {
                            $quantity = $transaction->quantity;
                            $totalMoneySpent = $transaction->totalMoneySpent;
                            $cost = $transaction->cost;

                            $transactionCost = $quantity * $cost;
                            $transactionProfit = $totalMoneySpent - $transactionCost;

                            $totalProfit += $transactionProfit;
                        }

                        echo number_format($totalProfit, 2);
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
                        $query = $this->db->query('SELECT t.itemCode, t.quantity, t.totalMoneySpent, i.cost,
                                                            t.quantity * i.cost AS totalCost,
                                                            t.totalMoneySpent - (t.quantity * i.cost) AS profit
                                                    FROM transactions AS t
                                                    JOIN items AS i ON t.itemCode = i.code
                                                    WHERE t.transDate >= CURDATE() AND t.transDate < CURDATE() + INTERVAL 1 DAY;
                                                    ');
                        $transactions = $query->result();

                        $totalProfit = 0;

                        foreach ($transactions as $transaction) {
                            $quantity = $transaction->quantity;
                            $totalMoneySpent = $transaction->totalMoneySpent;
                            $cost = $transaction->cost;

                            $transactionCost = $quantity * $cost;
                            $transactionProfit = $totalMoneySpent - $transactionCost;

                            $totalProfit += $transactionProfit;
                        }

                        echo number_format($totalProfit, 2);
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
                        $query = $this->db->query('SELECT SUM(CASE WHEN quantity <> 0 THEN cost * quantity ELSE 0 END) AS totalCost FROM items;');
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
                        $query = $this->db->query('SELECT SUM(cost * quantity) AS totalCost FROM items
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
            <?php if($topDemanded): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty Sold</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($topDemanded as $get):?>
                    <tr>
                        <td><?=$get->name?></td>
                        <td><?=$get->totSold?></td>
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
            <div class="panel-heading"><i class="fa fa-level-down"></i> LOW IN DEMAND</div>
            <?php if($leastDemanded): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty Sold</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($leastDemanded as $get):?>
                    <tr>
                        <td><?=$get->name?></td>
                        <td><?=$get->totSold?></td>
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
            <?php if($highestEarners): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Total Earned</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($highestEarners as $get):?>
                    <tr>
                        <td><?=$get->name?></td>
                        <td>$<?=number_format($get->totEarned, 2)?></td>
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
            <div class="panel-heading"><i class="fa fa-dollar"></i> LOWEST EARNING</div>
            <?php if($lowestEarners): ?>
            <table class="table table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Total Earned</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lowestEarners as $get):?>
                    <tr>
                        <td><?=$get->name?></td>
                        <td>$<?=number_format($get->totEarned, 2)?></td>
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
                            <th>Qty Sold</th>
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
                            <td><?=$get->qty_sold?></td>
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
                            <th>Qty Sold</th>
                            <th>Tot. Trans</th>
                            <th>Tot. Earned</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($transByDays as $get): ?>
                        <tr>
                            <td><?=$get->day?>s</td>
                            <td><?=$get->qty_sold?></td>
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
                            <th>Qty Sold</th>
                            <th>Tot. Trans</th>
                            <th>Tot. Earned</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($transByMonths as $get): ?>
                        <tr>
                            <td><?=$get->month?></td>
                            <td><?=$get->qty_sold?></td>
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
                            <th>Qty Sold</th>
                            <th>Tot. Trans</th>
                            <th>Tot. Earned</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($transByYears as $get): ?>
                        <tr>
                            <td><?=$get->year?></td>
                            <td><?=$get->qty_sold?></td>
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