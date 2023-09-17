'use strict';

$(document).ready(function () {
    try {
        // Load initial list of records
        lrlt();

        // Add New Record Button Click
        $("#createRecord").click(function () {
            $("#recordsListDiv").removeClass("col-sm-12").addClass("col-sm-8");
            $("#createNewRecordDiv").removeClass("hidden");
        });

        // Show per page dropdown change
        $("#recordsListPerPage").change(function () {
            lrlt();
        });

        // Sort by dropdown change
        $("#recordsListSortBy").change(function () {
            lrlt();
        });

        // Search box keyup event
        $("#recordsearch").keyup(function () {
            var value = $(this).val();
        
            if (value) {
                $.ajax({
                    url: appRoot + "search/reportSearch",
                    type: "get",
                    data: { v: value },
                    success: function (returnedData) {
                        $("#recordsListTable").html(returnedData.reportsListTable);
                    }
                });
            } else {
                // Reload the table if all text in the search box has been cleare
                lrlt ();
            }
        });
        
    } catch (error) {
        console.error("Caught an error:", error);
    }
});

// Load records list based on selected filters
function lrlt(url) {
    var limit = $("#recordsListPerPage").val();
    var orderFormat = $("#recordsListSortBy").val().split("-")[1];
    var search = $("#recordsearch").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "records/lrlt/",
        data: {
            limit: limit,
            orderFormat: orderFormat,
            search: search
        },
        success: function (returnedData) {
            $("#recordsListTable").html(returnedData.reportsListTable);
        },
        error: function () {
            console.log('Error loading records.');
        }
    });
}
