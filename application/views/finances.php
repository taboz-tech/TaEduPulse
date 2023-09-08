<?php
defined('BASEPATH') OR exit('');
?>

<div class="pwell hidden-print"> 
    <div class="row">
        <div class="col-sm-12">
            <h2>Generate Report</h2>
            <p>Click the button below to generate a report.</p>
            <button class="btn btn-success" id="generateReportBtn">Generate Report</button>
        </div>
    </div>
</div>
<!-- Element to display the report download link -->
<div id="transreportDownloadLink"></div>

<div class="pwell hidden-print"> 
    <div class="row">
        <div class="col-sm-12">
            <h2>Generate Budget</h2>
            <p>Click the button below to generate a budget.</p>
            <button class="btn btn-success" id="generateBudgetBtn">Generate Budget</button>
        </div>
    </div>
</div>
<!-- Element to display the budget download link -->
<div id="budgetDownloadLink"></div>




<script src="<?=base_url()?>public/js/finances.js"></script>