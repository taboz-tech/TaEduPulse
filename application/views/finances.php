<?php defined('BASEPATH') OR exit(''); ?>

<div class="pwell hidden-print">   
    <div class="row">
        <div class="col-sm-12">
            <!-- Buttons Row -->
            <div class="row">
                <div class="col-sm-12">
                    <!-- Generate Report Button -->
                    <div class="col-sm-6 form-inline form-group-sm">
                        <button class="btn btn-success" id="generateReportBtn">Generate Report</button>
                        <!-- Element to display the report download link for "Generate Report" button -->
                        <div id="reportDownloadLink"></div>
                    </div>

                    <!-- Generate Budget Button -->
                    <!-- <div class="col-sm-6 form-inline form-group-sm">
                        <button class="btn btn-success" id="generateBudgetBtn">Generate Budget</button>
                        <div id="budgetDownloadLink"></div>
                    </div> -->
                </div>
            </div>
            <!-- End of Buttons Row -->
        </div>
    </div>
    
    <hr>
    
    <!-- Cost Chart -->
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <h2>Cost Chart</h2>
                <canvas id="costChart" style="height: 500px;"></canvas> <!-- Change to canvas element -->
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <div id="legend"></div>
            </div>
        </div>
    </div>
</div>

<!-- Include the necessary JavaScript for charting libraries here -->
<script src="<?=base_url('public/js/chart.js'); ?>"></script>
<script src="<?=base_url()?>public/js/finances.js"></script>
