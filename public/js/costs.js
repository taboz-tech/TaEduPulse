'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Costs once the page is ready
    lclt();
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new Cost
     */
    $("#createCost").click(function() {
        populateCategoriesSelect();
        populateCurrenciesSelect();
        $("#costsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewCostDiv").toggleClass('hidden');
        $("#costName").focus();
    });
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      


    $(".cancelAddCost").click(function(){
        //reset and hide the form
        document.getElementById("addNewCostForm").reset();//reset the form
        $("#createNewCostDiv").addClass('hidden');//hide the form
        $("#costsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
   
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Cost
    $("#addNewCost").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['costNameErr', 'costAmountErr','addCustErrMsg','costCategoryErr', 'costDescriptionErr', 'costCurrencyErr'], "");
        
        var costName = $("#costName").val();
        var costAmount = $("#costAmount").val();
        var costCategory = $("#costCategory").val();
        var costDescription = $("#costDescription").val();
        var costCurrency = $("#costCurrency").val();
        const costStatus = 0;
        const costBalance = $("#costAmount").val();
        const costPaid = 0.00; 

        
        if(!costName || !costAmount || !costCategory || !costCurrency || !costDescription){
            !costName ? $("#costNameErr").text("required") : "";
            !costAmount ? $("#costAmountErr").text("required") : "";
            !costCategory ? $("#costCategoryErr").text("required") : "";
            !costCurrency ? $("#costCurrencyErr").text("required") : "";
            !costDescription ? $("#costDescriptionErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Cost '"+costName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"costs/add",
            data:{costName:costName, costAmount:costAmount, costCategory:costCategory, costDescription:costDescription, costCurrency:costCurrency, costStatus:costStatus, costBalance:costBalance,costPaid:costPaid},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewCostForm").reset();
                    
                    //refresh the costs list table
                    lclt();
                    
                    //return focus to cost name input
                    $("#costName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    // Display validation errors
                    if (returnedData.errors) {
                        $("#costNameErr").text(returnedData.errors.costName);
                        $("#costAmountErr").text(returnedData.errors.costAmount);
                        $("#costCategoryErr").text(returnedData.errors.costCategory);
                        $("#costDescriptionErr").text(returnedData.errors.costDescription);
                        $("#costCurrencyErr").text(returnedData.errors.costCurrency);
                    } else {
                        $("#addCustErrMsg").text(returnedData.msg);
                    }
                }
            },

            error: function(){
                if(!navigator.onLine){
                    changeFlashMsgContent("You appear to be offline. Please reconnect to the internet and try again", "", "red", "");
                }

                else{
                    changeFlashMsgContent("Unable to process your request at this time. Pls try again later!", "", "red", "");
                }
            }
        });
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //reload costs list table when events occur
    $("#costsListPerPage, #costsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lclt();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#costSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/costsearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#costsListTable").html(returnedData.costsListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lclt();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //triggers when a cost's "edit" icon is clicked
    $("#costsListTable").on('click', ".editCost", function(e){
        e.preventDefault();


        //get Cost info
        var costId = $(this).attr('id').split("-")[1];
        var costName = $("#costName-" + costId).html();
        var costAmount = $("#costAmount-" + costId).html();
        var costCategory = $("#costCategory-" + costId).html();
        var costDescription = $("#costDescription-" + costId).html();
        var costCurrency = $("#costCurrency-" + costId).html();
        
        
        //prefill form with info
        $("#costIdEdit").val(costId);
        $("#costNameEdit").val(costName);
        $("#costAmountEdit").val(costAmount);
        $("#costDescriptionEdit").val(costDescription);
        
        //remove all error messages that might exist
        $("#editCostFMsg").html("");
        $("#costIdEditErr").html("");
        $("#costNameEditErr").html("");
        $("#costAmountEditErr").html("");
        $("#costCategoryEditErr").html("");
        $("#costDescriptionEditErr").html("");
        $("#costCurrencyEditErr").html("");

        // Fetch and populate  select field
        populateEditCategoriesSelect(appRoot + "costs/getCategoriesForSelect/", costCategory);
        populateEditCurrenciesSelect(appRoot + "costs/getCurrenciesForSelect/", costCurrency);
        
        
        //launch modal
        $("#editCostModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editCostSubmit").click(function () {

        var costId = $("#costIdEdit").val();
        var costName = $("#costNameEdit").val();
        var costAmount = $("#costAmountEdit").val();
        var costCategory = $("#costCategoryEdit").val();
        var costDescription = $("#costDescriptionEdit").val();
        var costCurrency = $("#costCurrencyEdit").val();

    
        // Clear previous error messages
        $(".error-message").html("");
                
        if (!costAmount || !costCurrency || !costId || !costName) {
            if (!costAmount) $("#costAmountErr").html("Amount cannot be empty");
            if (!costCurrency) $("#costCurrencyEditErr").html("Cost Currency cannot be empty");
            if (!costId) $("#editCostFMsg").html("Unknown cost");
            if (!costName) $("#costNameEditErr").html("Cost name cannot be empty");
            return;
        }

    
        $("#editCostFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
    
        $.ajax({
            method: "POST",
            url: appRoot + "costs/edit",
            data: {
                costName: costName,
                costAmount: costAmount,
                _cId: costId,
                costCategory: costCategory,
                costDescription: costDescription,
                costCurrency: costCurrency
            }
        }).done(function (returnedData) {

            if (returnedData.status === 1) {
                $("#editCostFMsg").css('color', 'green').html("Cost successfully updated");
    
                setTimeout(function () {
                    $("#editCostModal").modal('hide');
                }, 1000);
    
                lclt();
            } else {
                $("#editCostFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                if (returnedData.costName) $("#costNameEditErr").html(returnedData.costName);
                if (returnedData.costDescription) $("#costDescriptionErr").html(returnedData.costDescription);
            }
        }).fail(function () {
            $("#editCostFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    
    //TO DELETE A Cost (The Cost will be marked as "deleted" instead of removing it totally from the db)
    $("#costsListTable").on('click', '.delCost', function(e){
        e.preventDefault();
        
        //get the cost id
        var costId = $(this).parents('tr').find('.curCostId').val();
        var costRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(costId){
            var confirm = window.confirm("Are you sure you want to delete Cost? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"costs/delete",
                    method: "POST",
                    data: {i:costId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove cost from list, update cost' SN, display success msg
                        $(costRow).remove();

                        //update the SN
                        resetCostSN();

                        //display success message
                        changeFlashMsgContent('Cost deleted', '', 'green', 1000);
                    }

                    else{
                        changeFlashMsgContent(rd.error, '', 'red', 2000);

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     // Triggered when the pay icon is clicked
    $("#costsListTable").on('click', ".payCost", function(e){
        e.preventDefault();
        $("#enablePaymentAmount").prop("checked", false);

        var costId = $(this).attr('id').split('-')[1];
        var costBalance = parseFloat($("#costBalance-" + costId).text()); // Parse the balance as a float

        // Open the refund modal
        $('#paymentModal').modal('show');

        $('#costId').val(costId);
        $('#costAmountPaying').val(costBalance.toFixed(2)); // Set the payment amount with 2 decimal places

        // Check if costBalance is zero and make the modal non-editable
        if (costBalance === 0) {
            $('#paymentAmount').prop('readonly', true);
            $('#enablePaymentAmount').prop('disabled', true);
            $('#processPaymentSubmit').prop('disabled', true);
            $("#paymentMessage").css('font-weight', '1500').css('color', 'green').html("PAID!");


        } else {
            $('#paymentAmount').prop('readonly', false);
            $('#enablePaymentAmount').prop('disabled', false);
            $('#processPaymentSubmit').prop('disabled', false);
            $('#paymentMessage').html(''); // Remove the watermark message
        }
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
    $("#enablePaymentAmount").prop("checked", false); // Set the checkbox to unchecked by default

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // Checkbox event handler to toggle the amount field's editability
    $("#enablePaymentAmount").on("change", function() {
        var isEnabled = $(this).prop("checked");
        if (isEnabled) {
            // Get the displayed cost amount value
            var costAmount = parseFloat($("#costAmountPaying").val()).toFixed(2);

            // Set the cost amount in the hidden field
            $("#paymentAmount").val(costAmount);

            // Disable the payment amount field
            $("#paymentAmount").prop("disabled", true);
        } else {
            // Enable the payment amount field
            $("#paymentAmount").prop("disabled", false);

            // Clear the hidden field value
            $("#paymentAmount").val("");
        }
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
    $("#processPaymentSubmit").click(function () {
        
        var paymentAmount = parseFloat($('#paymentAmount').val());
        var costAmount = parseFloat($('#costAmountPaying').val());
        var costId = $('#costId').val();
        var decision = paymentAmount <= costAmount;
        console.log(paymentAmount + " <= " + costAmount + " = " + decision);
    
        if (decision) {
            console.log("taboz");
            $.ajax({
                type: "POST",
                url: appRoot + "costs/payCost",
                data: { paymentAmount: paymentAmount, costId: costId },
                success: function (returnedData) {
                    console.log(returnedData);
                    if (returnedData.status === 1) {
                        // Payment was successful, display the success message
                        $("#paymentMessage").css('font-weight', 'bold').css('color', 'green').html("Payment was successful!");
    
                        // Hide any previous error messages
                        $("#paymentAmountErr").css('display', 'none');
    
                        // Close the modal after 3 seconds (2000 milliseconds)
                        setTimeout(function () {
                            $('#paymentModal').modal('hide');
                        }, 2000);
                    } else {
                        // Handle the error case
                    }
                },
                error: function () {
                    alert("ERROR!");
                }
            });
        } else {
            $("#paymentAmountErr").css('color', 'red').html("You can not pay " + paymentAmount + " whilst the balance is " + costAmount);
        }
    });
    
    
});



/**
 * "lclt" = "load Cost List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lclt(url) {

    var orderBy = $("#costsListSortBy").val().split("-")[0];
    var orderFormat = $("#costsListSortBy").val().split("-")[1];
    var limit = $("#costsListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "costs/lclt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#costsListTable").html(returnedData.costsListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetCostSN(){
    $(".costSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}


function populateCategoriesSelect(url) {
    $.ajax({
        url: url ? url : appRoot + "costs/getCategoriesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var categories = response.categories;
                var selectField = $('#costCategory');

                // Clear existing options and add a default empty option
                selectField.empty().append($('<option>', {
                    value: '',
                    text: 'Select Category'
                }));

                // Populate options
                $.each(categories, function(index, category) {
                    selectField.append($('<option>', {
                        value: category.name,
                        text: category.name 
                    }));
                });
            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error: ' + error);
        }
    });
}


// Function to populate the edit cost category select field
function populateEditCategoriesSelect(url, selectedCategoryName) {

    var selectField = $("#costCategoryEdit");

    $.ajax({
        url: url ? url : appRoot + "costs/getCategoriesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var categories = response.categories;

                selectField.empty();

                $.each(categories, function(index, category) {
                    selectField.append($('<option>', {
                        value: category.name,
                        text: category.name,
                        selected: category.name === selectedCategoryName
                    }));
                });


            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error: ' + error);
        }
    });
}

function populateCurrenciesSelect(url) {
    $.ajax({
        url: url ? url : appRoot + "costs/getCurrenciesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var currencies = response.currencies;
                var selectField = $('#costCurrency');

                // Clear existing options and add a default empty option
                selectField.empty().append($('<option>', {
                    value: '',
                    text: 'Select Currency'
                }));

                // Populate options
                $.each(currencies, function(index, currency) {
                    selectField.append($('<option>', {
                        value: currency.name,
                        text: currency.name 
                    }));
                });
            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error: ' + error);
        }
    });
}


// Function to populate the edit cost category select field
function populateEditCurrenciesSelect(url, selectedCurrencyName) {

    var selectField = $("#costCurrencyEdit");

    $.ajax({
        url: url ? url : appRoot + "costs/getCurrenciesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var currencies = response.currencies;

                selectField.empty();

                $.each(currencies, function(index, currency) {
                    selectField.append($('<option>', {
                        value: currency.name,
                        text: currency.name,
                        selected: currency.name === selectedCurrencyName
                    }));
                });


            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error: ' + error);
        }
    });
}
