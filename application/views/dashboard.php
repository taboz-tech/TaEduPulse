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
                    <div class="latestStuffsText">Total Amount</div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#5cb85c">Total Amount Today</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #607d8b">
                <div class="pull-left"><i class="fa fa-exchange"></i></div>
                <div class="pull-right">
                    <div><?=$totalTransactions?></div>
                    <div class="latestStuffsText pull-right">Total </div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#607d8b">Today Total Transactions</div>
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #607d8b">
                <div class="pull-left"><i class="fa fa-exchange"></i></div>
                <div class="pull-right">
                    <div><?=$totalSalesMonth?></div>
                    <div class="latestStuffsText pull-right">Monthly Sales</div>
                </div>
            </div>
            <div class="panel-footer text-center" style="color:#607d8b">Total Monthly Sales</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color:#795548">
                <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                <div class="pull-right">
                <div>
                    <?php
                    $this->db->select('COUNT(*) as total');
                    $this->db->from('items');
                    $query = $this->db->get()->row();
                    ?>
                    <?= intval($query->total); ?>
                </div>

                    <div class="latestStuffsText pull-right">Items</div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color#795548">Total Items In Stock</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color:#5cb85c">
                <div class="pull-left"><i class="fa fa-money"></i></div>
                <div class="pull-right">
                    <div>
                        <?php
                        // Get today's date in 'YYYY-MM-DD' format
                        $todayDate = date('Y-m-d');

                        $this->db->select_sum('totalMoneySpent');
                        $this->db->from('transactions_item');
                        $this->db->where('DATE(transDate)', $todayDate);
                        $this->db->distinct();

                        $query = $this->db->get()->row();

                        $totalMoneySpent = ($query && isset($query->totalMoneySpent)) ? number_format($query->totalMoneySpent, 2) : '0.00';
                        ?>
                        <?= $totalMoneySpent; // Display 0 if null ?>
                    </div>



                    <div class="latestStuffsText pull-right">Total Amount</div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color:#5cb85c">Total Amount Today</div>
        </div>
    </div>


    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #607d8b">
                <div class="pull-left"><i class="fa fa-exchange"></i></div>
                <div class="pull-right">
                <div>
                    <?php
                    // Get today's date in 'YYYY-MM-DD' format
                    $todayDate = date('Y-m-d');

                    $this->db->select_sum('totalMoneySpent');
                    $this->db->from('transactions_item');
                    $this->db->where('DATE(transDate)', $todayDate);
                    $this->db->distinct();

                    $query = $this->db->get()->row();
                    
                    $totalMoneySpent = ($query && isset($query->totalMoneySpent)) ? number_format($query->totalMoneySpent, 2) : '0';
                    ?>
                    <?= $totalMoneySpent; // Display 0 if null ?>
                </div>


                    <div class="latestStuffsText pull-right">Total</div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color:#607d8b">Today Total Transactions</div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-body latestStuffsBody" style="background-color: #607d8b">
                <div class="pull-left"><i class="fa fa-exchange"></i></div>
                <div class="pull-right">
                    <div>
                        <?php
                        // Get the current month and year
                        $currentMonth = date('m');
                        $currentYear = date('Y');

                        $this->db->select('DATE_FORMAT(transDate, "%Y-%m") as monthYear, SUM(totalMoneySpent) as monthlySales');
                        $this->db->from('transactions_item');
                        $this->db->where('MONTH(transDate)', $currentMonth);
                        $this->db->where('YEAR(transDate)', $currentYear);
                        $this->db->group_by('monthYear');

                        $query = $this->db->get()->row();

                        $monthlySales = ($query && isset($query->monthlySales)) ? number_format($query->monthlySales, 2) : '0';
                        ?>
                        <?= $monthlySales; // Display 0 if null ?>
                    </div>



                    <div class="latestStuffsText pull-right">Monthly Sales</div>
                </div>
                
            </div>
            <div class="panel-footer text-center" style="color:#607d8b">Total Monthly Sales</div>
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