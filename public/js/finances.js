'use strict';

$(document).ready(function () {
    checkDocumentVisibility(checkLogin); // Check document visibility to confirm user's login status

    // Create the income statement
    $("#generateReportBtn").click(function (e) {
        e.preventDefault();
    
        // Get the current date
        var currentDate = new Date();
    
        // Extract the current month and year
        var month = currentDate.getMonth() + 1; // Adding 1 because getMonth() returns a zero-based index
        var year = currentDate.getFullYear();
    
        // Call the generateReport() function on the server with current month and year
        $.ajax({
            url: appRoot + "finances/generateReport",
            type: 'POST',
            dataType: 'json',
            data: {
                month: month,
                year: year
            }, // Pass current month and year as data
            success: function (response) {
                if (response.status === 1) {
                    // Extract the file name from the report_url
                    var reportUrlParts = response.report_url.split('/');
                    var fileName = reportUrlParts[reportUrlParts.length - 1];
    
                    // Create a download link
                    var downloadLink = $('<a>')
                        .attr('href', response.report_url)
                        .attr('download', fileName) // Use the extracted file name
                        .text('Download Report');
    
                    // Append the download link to the #reportDownloadLink div
                    $('#reportDownloadLink').empty().append(downloadLink);
                } else {
                    // Error while generating the report
                    alert('An error occurred while generating the report.');
                }
            },
            error: function () {
                console.log("Error occurred during AJAX call.");
            }
        });
    });
    
    
    

    // Function to generate the budget
    $("#generateBudgetBtn").click(function (e) {
        e.preventDefault();

        // Call the generateBudget() function on the server
        $.ajax({
            url: appRoot + "finances/generateBudget", // Adjust the URL as needed
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response.status === 1) {
                    // Extract the file name from the budget_url
                    var budgetUrlParts = response.budget_url.split('/');
                    var fileName = budgetUrlParts[budgetUrlParts.length - 1];

                    // Provide a link to download the generated budget
                    var downloadLink = $('<a>')
                        .attr('href', response.budget_url)
                        .attr('download', fileName) // Use the extracted file name
                        .text('Download Budget');
                    $('#budgetDownloadLink').empty().append(downloadLink);
                } else {
                    // Error while generating the budget
                    alert('An error occurred while generating the budget.');
                }
            },
            error: function () {
                console.log("Error occurred during the AJAX call for generating the budget.");
            }
        });
    });

    // Function to create the cost chart
    function createCostChart() {
        // AJAX request to fetch cost data
        $.ajax({
            url: appRoot + "finances/getCostsData", // Adjust the URL as needed
            type: 'GET',
            dataType: 'json',
            success: function (response) {

                // Check if the response is an array
                if (Array.isArray(response)) {

                    // Extract data for the chart
                    var months = response.map(function (item) {
                        return item.month;
                    });

                    var totalCosts = response.map(function (item) {
                        return item.total_cost;
                    });

                    var totalPaidCosts = response.map(function (item) {
                        return item.total_paid_cost;
                    });

                    var totalBalances = response.map(function (item) {
                        return item.total_balance;
                    });

                    // Get the canvas element and create the chart
                    var ctx = document.getElementById('costChart').getContext('2d');

                    // Create a bar chart using Chart.js 1.0.2
                    var costChart = new Chart(ctx).Bar({
                        labels: months,
                        datasets: [
                            {
                                label: 'Total Cost',
                                data: totalCosts,
                                fillColor: 'rgba(75, 192, 192, 0.2)',
                                strokeColor: 'rgba(75, 192, 192, 1)',
                                pointColor: 'rgba(75, 192, 192, 1)',
                                pointStrokeColor: '#fff',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(75, 192, 192, 1)'
                            },
                            {
                                label: 'Total Paid Cost',
                                data: totalPaidCosts,
                                fillColor: 'rgba(255, 99, 132, 0.2)',
                                strokeColor: 'rgba(255, 99, 132, 1)',
                                pointColor: 'rgba(255, 99, 132, 1)',
                                pointStrokeColor: '#fff',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(255, 99, 132, 1)'
                            },
                            {
                                label: 'Total Balance',
                                data: totalBalances,
                                fillColor: 'rgba(255, 206, 86, 0.2)',
                                strokeColor: 'rgba(255, 206, 86, 1)',
                                pointColor: 'rgba(255, 206, 86, 1)',
                                pointStrokeColor: '#fff',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(255, 206, 86, 1)'
                            }
                        ]
                    },
                    {
                        responsive: true,
                        scaleShowLabels: true,
                        scaleBeginAtZero: true,
                        scaleShowGridLines: true,
                        scaleGridLineColor: "rgba(0,0,0,.05)",
                        scaleGridLineWidth: 1,
                        scaleShowHorizontalLines: true,
                        scaleShowVerticalLines: true,
                        barShowStroke: true,
                        barStrokeWidth: 2,
                        barValueSpacing: 5,
                        barDatasetSpacing: 1,
                        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\">  </span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                    });

                    // Add legend and axis labels
                    var legend = costChart.generateLegend();
                    $('#legend').html(legend);
                } else {
                    console.error("Invalid response format for cost data.");
                }
            },
            error: function () {
                console.error("Error occurred during the AJAX call for cost data.");
            }
        });
    }

    // Call the createCostChart function to generate the cost chart
    createCostChart();

    // Rest of your code here...

});
