'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
    //load all Categories once the page is ready
    lclt();
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new Categorie
     */
    $("#createCategorie").click(function(){
        $("#categoriesListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewCategorieDiv").toggleClass('hidden');
        $("#categorieName").focus();
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    $(".cancelAddCategorie").click(function(){
        //reset and hide the form
        document.getElementById("addNewCategorieForm").reset();//reset the form
        $("#createNewCategorieDiv").addClass('hidden');//hide the form
        $("#categoriesListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //handles the submission of adding new Categorie
    $("#addNewCategorie").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['categorieNameErr', 'categorieStatusErr', 'categoriePercentageErr', 'addCustErrMsg'], "");
        
        var categorieName = $("#categorieName").val();
        var categorieStatus = $("#categorieStatus").val();
        var categoriePercentage = $("#categoriePercentage").val().replace(",", "");
        
        if(!categorieName || !categorieStatus || !categoriePercentage){
            !categorieName ? $("#categorieNameErr").text("required") : "";
            !categorieStatus ? $("#categorieStatusErr").text("required") : "";
            !categoriePercentage ? $("#categoriePercentageErr").text("required") : "";
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Category '"+categorieName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"categories/add",
            data:{categorieName:categorieName, categorieStatus:categorieStatus, categoriePercentage:categoriePercentage },
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewCategorieForm").reset();
                    
                    //refresh the Categories list table
                    lclt();
                    
                    //return focus to Categorie Name input 
                    $("#categorieName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#categorieNameErr").text(returnedData.categorieName);
                    $("#categorieStatusErr").text(returnedData.categorieStatus);
                    $("#categoriePercentageErr").text(returnedData.categoriePercentage);
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
    
    //reload Categories list table when events occur
    $("#categoriesListPerPage, #categoriesListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lclt();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#categorieSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/categoriesearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#categoriesListTable").html(returnedData.categoriesListTable);
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
    
    //triggers when a Categorie "edit" icon is clicked
    $("#categoriesListTable").on('click', ".editCategorie", function(e){
        e.preventDefault();
        
        //get Category info
        var categorieId = $(this).attr('id').split("-")[1];
        var categorieName = $("#categorieName-"+categorieId).html();
        var categoriePercentage = $("#categoriePercentage-"+categorieId).html().split(".")[0].replace(",", "");
        var categorieStatus = $("#categorieStatus-"+categorieId).html();
        
        //prefill form with info
        $("#categorieIdEdit").val(categorieId);
        $("#categorieNameEdit").val(categorieName);
        $("#categorieStatusEdit").val(categorieStatus);
        $("#categoriePercentage").val(categoriePercentage);
        
        //remove all error messages that might exist
        $("#editCategorieFMsg").html("");
        $("#categorieNameEditErr").html("");
        $("#categorieStatusEditErr").html("");
        $("#categoriePercentageEditErr").html("");
        
        //launch modal
        $("#editCategorieModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editCategorieSubmit").click(function(){
        var categorieName = $("#categorieNameEdit").val();
        var categorieId = $("#categorieIdEdit").val();
        var categorieStatus = $("#categorieStatusEdit").val();
        var categoriePercentage = $("#categoriePercentageEdit").val();
    
        if(!categorieName || !categoriePercentage || !categorieId || !categorieStatus){
            !categorieName ? $("#categorieNameEditErr").html("Category name cannot be empty") : "";
            !categoriePercentage ? $("#categoriePercentageEditErr").html("Category percentage cannot be empty") : "";
            !categorieId ? $("#editCategorieFMsg").html("Unknown category") : "";
            return;
        }
    
        $("#editCategorieFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
        
        
        $.ajax({
            method: "POST",
            url: appRoot+"categories/edit",
            data: {categorieName:categorieName, categoriePercentage:categoriePercentage, categorieStatus:categorieStatus, _cId:categorieId}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#editCategorieFMsg").css('color', 'green').html("Category successfully updated");
                
                setTimeout(function(){
                    $("#editCategorieModal").modal('hide');
                }, 1000);
                
                lclt();
            }
            
            else{
                $("#editCategorieFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
                
                $("#categorieNameEditErr").html(returnedData.categorieName);
                $("#categorieStatusEditErr").html(returnedData.categorieStatus);
                $("#categoriePercentageEditErr").html(returnedData.categoriePercentage);
            }
        }).fail(function(){
            $("#editCategorieFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //TO DELETE A CATEGORIE (The Categorie will be marked as "deleted" instead of removing it totally from the db)
    $("#categoriesListTable").on('click', '.delCategorie', function(e){
        e.preventDefault();
        
        //get the Categorie id
        var categorieId = $(this).parents('tr').find('.curCategorieId').val();
        var categorieRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(categorieId){
            var confirm = window.confirm("Are you sure you want to delete Category? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"categories/delete",
                    method: "POST",
                    data: {i:categorieId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove Categorie from list, update Categorie' SN, display success msg
                        $(categorieRow).remove();

                        //update the SN
                        resetCategorieSN();

                        //display success message
                        changeFlashMsgContent('Category deleted', '', 'green', 1000);
                    }

                    else{

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });
});



/**
 * "lclt" = "load Categories List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lclt(url) {

    var orderBy = $("#categoriesListSortBy").val().split("-")[0];
    var orderFormat = $("#categoriesListSortBy").val().split("-")[1];
    var limit = $("#categoriesListPerPage").val();
    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "categories/lclt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#categoriesListTable").html(returnedData.categoriesListTable);
        },

        error: function () {
        }
    });

    return false;
}






function resetCategorieSN(){
    $(".categorieSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}