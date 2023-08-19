'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Grades once the page is ready
    lglt();
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new grade
     */
    $("#createGrade").click(function() {
        populateTeachersSelect();
        $("#GradesListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewGradeDiv").toggleClass('hidden');
        $("#GradeName").focus();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    
    $(".cancelAddGrade").click(function(){
        //reset and hide the form
        document.getElementById("addNewGradeForm").reset();//reset the form
        $("#createNewGradeDiv").addClass('hidden');//hide the form
        $("#gradesListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Grade
    $("#addNewGrade").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['gradeNameErr', 'gradeTeacher_idErr'], "");
        
        var gradeTeacher_id = $("#gradeTeacher_id").val();
        var gradeName = $("#gradeName").val();
        
        
        if(!gradeTeacher_id || !gradeName){
            !gradeTeacher_id ? $("#gradeTeacher_idErr").text("required") : "";
            !gradeName ? $("#gradeNameErr").text("required") : "";            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding grade '"+gradeName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"grades/add",
            data:{gradeName:gradeName, gradeTeacher_id:gradeTeacher_id},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewGradeForm").reset();
                    
                    //refresh the grades list table
                    lglt();
                    
                    //return focus to grade name input 
                    $("#gradeName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#gradeTeacher_idErr").text(returnedData.gradeTeacher_id);
                    $("#gradeNameErr").text(returnedData.gradeName);
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
    
    //reload grade list table when events occur
    $("#gradesListPerPage, #gradesListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lglt();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#gradeSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/gradesearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#gradesListTable").html(returnedData.gradesListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lglt();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //triggers when a grade's "edit" icon is clicked
    $("#gradesListTable").on('click', ".editGrade", function(e){
        e.preventDefault();
        
        //get Grade info
        var gradeId = $(this).attr('id').split("-")[1];
        var gradeName = $("#gradeName-" + gradeId).html();
        var gradeTeacher_id = $("#gradeTeacher_id-" + gradeId).html();
                
        //prefill form with info
        $("#gradeIdEdit").val(gradeId);
        $("#gradeNameEdit").val(gradeName);
        
        //remove all error messages that might exist
        $("#editGradeFMsg").html("");
        $("#gradeIdEditErr").html("");
        $("#gradeNameEditErr").html("");
        $("#gradeTeacher_idEditErr").html("");

        // Fetch and populate the grade teacher select field
        populateEditTeachersSelect(appRoot + "grades/getTeachersForSelect/", gradeTeacher_id);

        
        //launch modal
        $("#editGradeModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editGradeSubmit").click(function(){
        var gradeId = $("#gradeIdEdit").val();
        var gradeName = $("#gradeNameEdit").val();
        var gradeTeacher_id = $("#gradeTeacher_idEdit").val();
        
        
        if(!gradeName || !gradeTeacher_id ){
            !gradeTeacher_id ? $("#gradeTeacher_idErr").html("Teacher Id name cannot be empty") : "";
            !gradeName ? $("#gradeNameEditErr").html("Grade name cannot be empty") : "";

            return;
        }
        
        $("#editGradeFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
        
        $.ajax({
            method: "POST",
            url: appRoot+"grades/edit",
            data: {gradeName:gradeName,_gId:gradeId, gradeTeacher_id:gradeTeacher_id}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#editGradeFMsg").css('color', 'green').html("Grade successfully updated");
                
                setTimeout(function(){
                    $("#editGradeModal").modal('hide');
                }, 1000);
                
                lglt();
            }
            
            else{
                $("#editGradeFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
                
                $("#gradeTeacher_idEditErr").html(returnedData.gradeTeacher_id);
                $("#gradeNameEditErr").html(returnedData.gradeName);
            }
        }).fail(function(){
            $("#editGradeFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    //TO DELETE A Grade (The Grade will be marked as "deleted" instead of removing it totally from the db)
    $("#gradesListTable").on('click', '.delGrade', function(e){
        e.preventDefault();
        
        //get the grade id
        var gradeId = $(this).parents('tr').find('.curGradeId').val();
        var gradeRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(gradeId){
            var confirm = window.confirm("Are you sure you want to delete grade? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"grades/delete",
                    method: "POST",
                    data: {i:gradeId}
                }).done(function(rd){
                    console.log(rd);
                    if(rd.status === 1){
                        //remove grade from list, update grades' SN, display success msg
                        $(gradeRow).remove();

                        //update the SN
                        resetGradeSN();

                        //display success message
                        changeFlashMsgContent('Grade deleted', '', 'green', 1000);
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
 * "lglt" = "load Grade List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lglt(url) {

    var orderBy = $("#gradesListSortBy").val().split("-")[0];
    var orderFormat = $("#gradesListSortBy").val().split("-")[1];
    var limit = $("#gradesListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "grades/lglt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#gradesListTable").html(returnedData.gradesListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetGradeSN(){
    $(".gradeSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}

function populateTeachersSelect(url) {
    $.ajax({
        url: url ? url : appRoot + "grades/getTeachersForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var teachers = response.teachers;
                var selectField = $('#gradeTeacher_id');

                // Clear existing options and add a default empty option
                selectField.empty().append($('<option>', {
                    value: '',
                    text: 'Select Class'
                }));

                // Populate options
                $.each(teachers, function(index, teacher) {
                    selectField.append($('<option>', {
                        value: teacher.id,
                        text: teacher.name +' ' + teacher.surname
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




// Function to populate the edit grade class select field
function populateEditTeachersSelect(url, selectedTeacherId) {

    var selectField = $("#gradeTeacher_idEdit");

    $.ajax({
        url: url ? url : appRoot + "grades/getTeachersForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var teachers = response.teachers;

                selectField.empty();

                $.each(teachers, function(index, teacher) {
                    selectField.append($('<option>', {
                        value: teacher.id,
                        text: teacher.name + ' '+ teacher.surname,
                        selected: teacher.name === selectedTeacherId
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
