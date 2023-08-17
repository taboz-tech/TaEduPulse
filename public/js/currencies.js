'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Currencies once the page is ready
    lclt();
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new Currency
     */
    $("#createCurrencie").click(function() {
        $("#currenciesListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewCurrencieDiv").toggleClass('hidden');
        $("#currencieName").focus();
    });
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      


    $(".cancelAddCurrencie").click(function(){
        //reset and hide the form
        document.getElementById("addNewCurrencieForm").reset();//reset the form
        $("#createNewCurrencieDiv").addClass('hidden');//hide the form
        $("#currenciesListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
   
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Currency
    $("#addNewCurrencie").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['currencieNameErr','addCustErrMsg', 'currencieRateErr'], "");
        
        var currencieName = $("#currencieName").val();
        var currencieRate = $("#currencieRate").val();

        
        if(!currencieName || !currencieRate){
            !currencieName ? $("#currencieNameErr").text("required") : "";
            !currencieRate ? $("#currencieRateErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Currency '"+currencieName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"currencies/add",
            data:{currencieName:currencieName, currencieRate:currencieRate},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewCurrencieForm").reset();
                    
                    //refresh the currencies list table
                    lclt();
                    
                    //return focus to currencie name input
                    $("#currencieName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#currencieNameErr").text(returnedData.currencieName);
                    $("#currencieRateErr").text(returnedData.currencieRate);
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
    
    //reload currencies list table when events occur
    $("#currenciesListPerPage, #currenciesListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lclt();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#currencieSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/currenciesearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#currenciesListTable").html(returnedData.currenciesListTable);
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
    
    //triggers when a currencie's "edit" icon is clicked
    $("#currenciesListTable").on('click', ".editCurrencie", function(e){
        e.preventDefault();


        //get Currencie info
        var currencieId = $(this).attr('id').split("-")[1];
        var currencieName = $("#currencieName-" + currencieId).html();
        var currencieRate = $("#currencieRate-" + currencieId).html();
        
        
        //prefill form with info
        $("#currencieIdEdit").val(currencieId);
        $("#currencieNameEdit").val(currencieName);
        $("#currencieRateEdit").val(currencieRate);
        
        //remove all error messages that might exist
        $("#editCurrencieFMsg").html("");
        $("#currencieIdEditErr").html("");
        $("#currencieNameEditErr").html("");
        $("#currencieDescriptionEditErr").html("");
        
        
        //launch modal
        $("#editCurrencieModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editCurrencieSubmit").click(function () {

        var currencieId = $("#currencieIdEdit").val();
        var currencieName = $("#currencieNameEdit").val();
        var currencieRate = $("#currencieRateEdit").val();

    
        // Clear previous error messages
        $(".error-message").html("");
                
        if (!currencieRate || !currencieId || !currencieName) {
            if (!currencieRate) $("#currencieRateErr").html("Rate cannot be empty");
            if (!currencieId) $("#editCurrencieFMsg").html("Unknown Currencie");
            if (!currencieName) $("#currencieNameEditErr").html("Currency name cannot be empty");
            return;
        }

    
        $("#editCurrencieFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
    
        $.ajax({
            method: "POST",
            url: appRoot + "currencies/edit",
            data: {
                currencieName: currencieName,
                _cId: currencieId,
                currencieRate: currencieRate
            }
        }).done(function (returnedData) {

            if (returnedData.status === 1) {
                $("#editCurrencieFMsg").css('color', 'green').html("Currency successfully updated");
    
                setTimeout(function () {
                    $("#editCurrencieModal").modal('hide');
                }, 1000);
    
                lclt();
            } else {
                $("#editCurrencieFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                if (returnedData.currencieName) $("#currencieNameEditErr").html(returnedData.currencieName);
                if (returnedData.currencieRate) $("#currencieRateErr").html(returnedData.currencieRate);
            }
        }).fail(function () {
            $("#editCurrencieFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    
    //TO DELETE A Currency (The Currency will be marked as "deleted" instead of removing it totally from the db)
    $("#currenciesListTable").on('click', '.delCurrencie', function(e){
        e.preventDefault();
        
        //get the currency id
        var currencieId = $(this).parents('tr').find('.curCurrencieId').val();
        var currencieRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(currencieId){
            var confirm = window.confirm("Are you sure you want to delete Currency? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"currencies/delete",
                    method: "POST",
                    data: {i:currencieId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove currencie from list, update currency' SN, display success msg
                        $(currencieRow).remove();

                        //update the SN
                        resetCurrencieSN();

                        //display success message
                        changeFlashMsgContent('Currency deleted', '', 'green', 1000);
                    }

                    else{

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
 * "lclt" = "load Currency List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lclt(url) {

    var orderBy = $("#currenciesListSortBy").val().split("-")[0];
    var orderFormat = $("#currenciesListSortBy").val().split("-")[1];
    var limit = $("#currenciesListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "currencies/lclt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#currenciesListTable").html(returnedData.currenciesListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetCurrencieSN(){
    $(".currencieSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}

