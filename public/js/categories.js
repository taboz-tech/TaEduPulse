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
     * Toggle the form to add a new Category
     */
    $("#createCategorie").click(function() {
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
    
    //handles the submission of adding new Category
    $("#addNewCategorie").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['categorieNameErr','addCustErrMsg', 'categorieDescriptionErr'], "");
        
        var categorieName = $("#categorieName").val();
        var categorieDescription = $("#categorieDescription").val();

        
        if(!categorieName || !categorieDescription){
            !categorieName ? $("#categorieNameErr").text("required") : "";
            !categorieDescription ? $("#categorieDescriptionErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Category '"+categorieName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"categories/add",
            data:{categorieName:categorieName, categorieDescription:categorieDescription},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewCategorieForm").reset();
                    
                    //refresh the categories list table
                    lclt();
                    
                    //return focus to categorie name input
                    $("#categorieName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#categorieNameErr").text(returnedData.categorieName);
                    $("#categorieDescriptionErr").text(returnedData.categorieDescription);
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
    
    //reload categories list table when events occur
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
    
    //triggers when a categorie's "edit" icon is clicked
    $("#categoriesListTable").on('click', ".editCategorie", function(e){
        e.preventDefault();


        //get Categorie info
        var categorieId = $(this).attr('id').split("-")[1];
        var categorieName = $("#categorieName-" + categorieId).html();
        var categorieDescription = $("#categorieDescription-" + categorieId).html();
        
        
        //prefill form with info
        $("#categorieIdEdit").val(categorieId);
        $("#categorieNameEdit").val(categorieName);
        $("#categorieDescriptionEdit").val(categorieDescription);
        
        //remove all error messages that might exist
        $("#editCategorieFMsg").html("");
        $("#categorieIdEditErr").html("");
        $("#categorieNameEditErr").html("");
        $("#categorieDescriptionEditErr").html("");
        
        
        //launch modal
        $("#editCategorieModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editCategorieSubmit").click(function () {

        var categorieId = $("#categorieIdEdit").val();
        var categorieName = $("#categorieNameEdit").val();
        var categorieDescription = $("#categorieDescriptionEdit").val();

    
        // Clear previous error messages
        $(".error-message").html("");
                
        if (!categorieDescription || !categorieId || !categorieName) {
            if (!categorieDescription) $("#categorieDescriptionErr").html("Description cannot be empty");
            if (!categorieId) $("#editCategorieFMsg").html("Unknown Categorie");
            if (!categorieName) $("#categorieNameEditErr").html("Categorie name cannot be empty");
            return;
        }

    
        $("#editCategorieFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
    
        $.ajax({
            method: "POST",
            url: appRoot + "categories/edit",
            data: {
                categorieName: categorieName,
                _cId: categorieId,
                categorieDescription: categorieDescription
            }
        }).done(function (returnedData) {

            if (returnedData.status === 1) {
                $("#editCategorieFMsg").css('color', 'green').html("Category successfully updated");
    
                setTimeout(function () {
                    $("#editCategorieModal").modal('hide');
                }, 1000);
    
                lclt();
            } else {
                $("#editCategorieFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                if (returnedData.categorieName) $("#categorieNameEditErr").html(returnedData.categorieName);
                if (returnedData.categorieDescription) $("#categorieDescriptionErr").html(returnedData.categorieDescription);
            }
        }).fail(function () {
            $("#editCategorieFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    
    //TO DELETE A Category (The Category will be marked as "deleted" instead of removing it totally from the db)
    $("#categoriesListTable").on('click', '.delCategorie', function(e){
        e.preventDefault();
        
        //get the category id
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
                        //remove categorie from list, update category' SN, display success msg
                        $(categorieRow).remove();

                        //update the SN
                        resetCategorieSN();

                        //display success message
                        changeFlashMsgContent('Category deleted', '', 'green', 1000);
                    }

                    else{
                        changeFlashMsgContent(rd.message, '', 'red', 2000);
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
 * "lclt" = "load Category List Table"
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

