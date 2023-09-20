'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Subjects once the page is ready
    lslt_();
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new subject
     */
    $("#createSubject").click(function() {
        $("#SubjectsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewSubjectDiv").toggleClass('hidden');
        $("#SubjectName").focus();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    
    $(".cancelAddSubject").click(function(){
        //reset and hide the form
        document.getElementById("addNewSubjectForm").reset();//reset the form
        $("#createNewSubjectDiv").addClass('hidden');//hide the form
        $("#subjectsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Subject
    $("#addNewSubject").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['subjectNameErr'], "");
        
        var subjectName = $("#subjectName").val();
        
        
        if(!subjectName){
            !subjectName ? $("#subjectNameErr").text("required") : "";            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding subject '"+subjectName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"subjects/add",
            data:{subjectName:subjectName},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    console
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewSubjectForm").reset();
                    
                    //refresh the subjects list table
                    lslt_();
                    
                    //return focus to subject name input 
                    $("#subjectName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#subjectNameErr").text(returnedData.subjectName);
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
    
    //reload subject list table when events occur
    $("#subjectsListPerPage, #subjectsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lslt_();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#subjectSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/subjectsearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#subjectsListTable").html(returnedData.subjectsListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lslt_();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //triggers when a subject's "edit" icon is clicked
    $("#subjectsListTable").on('click', ".editSubject", function(e){
        e.preventDefault();
        
        //get subject info
        var subjectId = $(this).attr('id').split("-")[1];
        var subjectName = $("#subjectName-" + subjectId).html();
                
        //prefill form with info
        $("#subjectIdEdit").val(subjectId);
        $("#subjectNameEdit").val(subjectName);
        
        //remove all error messages that might exist
        $("#editSubjectFMsg").html("");
        $("#subjectIdEditErr").html("");
        $("#subjectNameEditErr").html("");

        
        
        //launch modal
        $("#editSubjectModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editSubjectSubmit").click(function(){
        var subjectId = $("#subjectIdEdit").val();
        var subjectName = $("#subjectNameEdit").val();
        
        
        if(!subjectName ){
            !subjectName ? $("#subjectNameEditErr").html("Subject name cannot be empty") : "";

            return;
        }
        
        $("#editSubjectFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
        
        $.ajax({
            method: "POST",
            url: appRoot+"subjects/edit",
            data: {subjectName:subjectName,_sId:subjectId}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#editSubjectFMsg").css('color', 'green').html("Subject successfully updated");
                
                setTimeout(function(){
                    $("#editSubjectModal").modal('hide');
                }, 1000);
                
                lslt_();
            }
            
            else{
                $("#editSubjectFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
                
                $("#subjectNameEditErr").html(returnedData.subjectName);
            }
        }).fail(function(){
            $("#editSubjectFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    //TO DELETE A Subject 
    $("#subjectsListTable").on('click', '.delSubject', function(e){
        e.preventDefault();
        
        //get the Subject id
        var subjectId = $(this).parents('tr').find('.curSubjectId').val();
        var subjectRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(subjectId){
            var confirm = window.confirm("Are you sure you want to delete Subject? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"subjects/delete",
                    method: "POST",
                    data: {i:subjectId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove subject from list, update subjects' SN, display success msg
                        $(subjectRow).remove();

                        //update the SN
                        resetSubjectSN();

                        //display success message
                        changeFlashMsgContent('Subject deleted', '', 'green', 1000);
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
 * "lslt_" = "load subject List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lslt_(url) {

    var orderBy = $("#subjectsListSortBy").val().split("-")[0];
    var orderFormat = $("#subjectsListSortBy").val().split("-")[1];
    var limit = $("#subjectsListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "subjects/lslt_/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#subjectsListTable").html(returnedData.subjectsListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetSubjectSN(){
    $(".subjectSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}





