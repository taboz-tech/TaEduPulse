'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Incomes once the page is ready
    lilt();
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new Income
     */
    $("#createIncome").click(function() {
        populateCurrenciesSelect();
        $("#incomesListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewIncomeDiv").toggleClass('hidden');
        $("#incomeName").focus();
    });
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      


    $(".cancelAddIncome").click(function(){
        //reset and hide the form
        document.getElementById("addNewIncomeForm").reset();//reset the form
        $("#createNewIncomeDiv").addClass('hidden');//hide the form
        $("#incomesListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
   
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Income
    $("#addNewIncome").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['incomeNameErr', 'incomeAmountErr','addCustErrMsg', 'incomeDescriptionErr', 'incomeCurrencyErr'], "");
        
        var incomeName = $("#incomeName").val();
        var incomeAmount = $("#incomeAmount").val();
        var incomeDescription = $("#incomeDescription").val();
        var incomeCurrency = $("#incomeCurrency").val();

        
        if(!incomeName || !incomeAmount || !incomeCurrency || !incomeDescription){
            !incomeName ? $("#incomeNameErr").text("required") : "";
            !incomeAmount ? $("#incomeAmountErr").text("required") : "";
            !incomeCurrency ? $("#incomeCurrencyErr").text("required") : "";
            !incomeDescription ? $("#incomeDescriptionErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Income '"+incomeName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"incomes/add",
            data:{incomeName:incomeName, incomeAmount:incomeAmount, incomeDescription:incomeDescription, incomeCurrency:incomeCurrency},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewIncomeForm").reset();
                    
                    //refresh the incomes list table
                    lilt();
                    
                    //return focus to Income name input
                    $("#incomeName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#incomeNameErr").text(returnedData.incomeName);
                    $("#incomeAmountErr").text(returnedData.incomeAmount);
                    $("#incomeDescriptionErr").text(returnedData.incomeDescription);
                    $("#incomeCurrencyErr").text(returnedData.incomeCurrency);
                    $("#addCustErrMsg").text(returnedData.msg);
                    
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
    
    //reload incomes list table when events occur
    $("#incomesListPerPage, #incomesListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lilt();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#incomeSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/incomesearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#incomesListTable").html(returnedData.incomesListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lilt();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //triggers when a income's "edit" icon is clicked
    $("#incomesListTable").on('click', ".editIncome", function(e){
        e.preventDefault();
        console.log("clicked")


        //get income info
        var incomeId = $(this).attr('id').split("-")[1];
        var incomeName = $("#incomeName-" + incomeId).html();
        var incomeAmount = $("#incomeAmount-" + incomeId).html();
        var incomeDescription = $("#incomeDescription-" + incomeId).html();
        var incomeCurrency = $("#incomeCurrency-" + incomeId).html();
        
        
        //prefill form with info
        $("#incomeIdEdit").val(incomeId);
        $("#incomeNameEdit").val(incomeName);
        $("#incomeAmountEdit").val(incomeAmount);
        $("#incomeDescriptionEdit").val(incomeDescription);
        
        //remove all error messages that might exist
        $("#editIncomeFMsg").html("");
        $("#incomeIdEditErr").html("");
        $("#incomeNameEditErr").html("");
        $("#incomeAmountEditErr").html("");
        $("#incomeDescriptionEditErr").html("");
        $("#incomeCurrencyEditErr").html("");

        populateEditCurrenciesSelect(appRoot + "costs/getCurrenciesForSelect/", incomeCurrency);
      
        
        
        //launch modal
        $("#editIncomeModal").modal('show');
    });
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editIncomeSubmit").click(function () {

        var incomeId = $("#incomeIdEdit").val();
        var incomeName = $("#incomeNameEdit").val();
        var incomeAmount = $("#incomeAmountEdit").val();
        var incomeDescription = $("#incomeDescriptionEdit").val();
        var incomeCurrency = $("#incomeCurrencyEdit").val();

    
        // Clear previous error messages
        $(".error-message").html("");
                
        if (!incomeAmount || !incomeCurrency || !incomeId || !incomeName) {
            if (!incomeAmount) $("#incomeAmountErr").html("Amount cannot be empty");
            if (!incomeCurrency) $("#incomeCurrencyEditErr").html("Income Currency cannot be empty");
            if (!incomeId) $("#editincomeFMsg").html("Unknown Income");
            if (!incomeName) $("#incomeNameEditErr").html("Income name cannot be empty");
            return;
        }

        // Check if incomeAmount is not empty and not equal to zero
        if (!incomeAmount || parseFloat(incomeAmount) === 0) {
            $("#incomeAmountEditErr").html("Amount must be a valid number greater than zero");
            return;
        }

    
        $("#editIncomeFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
    
        $.ajax({
            method: "POST",
            url: appRoot + "incomes/edit",
            data: {
                incomeName: incomeName,
                incomeAmount: incomeAmount,
                _iId: incomeId,
                incomeDescription: incomeDescription,
                incomeCurrency: incomeCurrency
            }
        }).done(function (returnedData) {

            if (returnedData.status === 1) {
                $("#editncometFMsg").css('color', 'green').html("Income successfully updated");
    
                setTimeout(function () {
                    $("#editIncomeModal").modal('hide');
                }, 1000);
    
                lilt();
            } else {
                $("#editIncomeFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                if (returnedData.incomeName) $("#incomeNameEditErr").html(returnedData.incomeName);
                if (returnedData.incomeDescription) $("#incomeDescriptionErr").html(returnedData.incomeDescription);
            }
        }).fail(function () {
            $("#editIncomeFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //triggers when a income's "money" icon is clicked
    $("#incomesListTable").on('click', ".updateFees", function(e){
        e.preventDefault();
    
        var incomeId = $(this).attr('id').split("-")[1];
        var incomeName = $("#incomeName-" + incomeId).html();
    
        if (incomeName === "Fees Alevel" || incomeName === "Fees ZJC" || incomeName === "Fees Olevel") {
            var incomeAmount = $("#incomeAmount-" + incomeId).html();
            var incomeCurrency = $("#incomeCurrency-" + incomeId).html();
    
            // Set modal content
            $("#modalIncomeId").val(incomeId);
            $("#modalIncomeName").text(incomeName);
            $("#modalIncomeAmount").text(incomeAmount);
            $("#modalIncomeCurrency").text(incomeCurrency);
        
            // Launch modal
            $("#feesIncomeModal").modal('show');
    
        } else {
            // Display a flash message for other income names
            displayFlashMsg("Invalid Operation", "fa fa-exclamation-circle", "red", 3000);
            
        }
    });
    


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#feesAllowButton").click(function () {
        var incomeId = $("#modalIncomeId").val();
        var incomeName = $("#modalIncomeName").text();
        var incomeAmount = $("#modalIncomeAmount").text();
        var incomeCurrency = $("#modalIncomeCurrency").text();

        // Perform the AJAX request
        $.ajax({
            type: 'POST',
            url: appRoot+"students/bulkUpdateFees", 
            data: {
                newFees: incomeAmount,
                feesToAdd: incomeAmount,
                incomeName: incomeName,
                incomeCurrency: incomeCurrency
            },
            dataType: 'json',
            success: function(response) {
                console.log(response)
                if (response.status === 1) {
                    alert(response.message);
                    // Reload or update the page as needed
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            }
        });
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //TO DELETE A Income (The Income will be marked as "deleted" instead of removing it totally from the db)
    $("#incomesListTable").on('click', '.delIncome', function(e){
        e.preventDefault();
        
        //get the income id
        var incomeId = $(this).parents('tr').find('.curIncomeId').val();
        var incomeRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(incomeId){
            var confirm = window.confirm("Are you sure you want to delete Income? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"incomes/delete",
                    method: "POST",
                    data: {i:incomeId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove income from list, update income' SN, display success msg
                        $(incomeRow).remove();

                        //update the SN
                        resetIncomeSN();

                        //display success message
                        changeFlashMsgContent('Income deleted', '', 'green', 1000);
                    }

                    else{
                        changeFlashMsgContent(rd.error, "text-danger", 'red', 3000);

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

});



/**
 * "lilt" = "load Income List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lilt(url) {

    var orderBy = $("#incomesListSortBy").val().split("-")[0];
    var orderFormat = $("#incomesListSortBy").val().split("-")[1];
    var limit = $("#incomesListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "incomes/lilt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#incomesListTable").html(returnedData.incomesListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetIncomeSN(){
    $(".incomeSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}

function populateCurrenciesSelect(url) {
    $.ajax({
        url: url ? url : appRoot + "incomes/getCurrenciesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var currencies = response.currencies; // Updated variable name
                var selectField = $('#incomeCurrency');

                selectField.empty().append($('<option>', {
                    value: '',
                    text: 'Select Currency'
                }));

                $.each(currencies, function(index, currency) { // Updated variable name
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




function populateEditCurrenciesSelect(url, selectedCurrencyName) {

    var selectField = $("#incomeCurrencyEdit");

    $.ajax({
        url: url ? url : appRoot + "incomes/getCurrenciesForSelect/",
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

