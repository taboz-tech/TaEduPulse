'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Teachers once the page is ready
    ltlt();
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new Teacher
     */
    $("#createTeacher").click(function() {
        $("#teachersListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewTeacherDiv").toggleClass('hidden');
        $("#teacherName").focus();
    });
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      


    $(".cancelAddTeacher").click(function(){
        //reset and hide the form
        document.getElementById("addNewTeacherForm").reset();//reset the form
        $("#createNewTeacherDiv").addClass('hidden');//hide the form
        $("#teachersListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
   
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Teacher
    $("#addNewTeacher").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['teacherNameErr', 'teacherSurnameErr','addCustErrMsg','teacherGenderErr', 'teacherSubjectErr', 'teacherDepartmmentErr'], "");
        
        var teacherName = $("#teacherName").val();
        var teacherSurname = $("#teacherSurname").val();
        var teacherGender = $("#teacherGender").val();
        var teacherSubject = $("#teacherSubject").val();
        var teacherDepartment = $("#teacherDepartment").val();
        var teacherProfession = $("#teacherProfession").val();

        
        if(!teacherName || !teacherSurname || !teacherGender || !teacherSubject ){
            !teacherName ? $("#teacherNameErr").text("required") : "";
            !teacherSurname ? $("#teacherSurnameErr").text("required") : "";
            !teacherGender ? $("#teacherGenderErr").text("required") : "";
            !teacherSubject ? $("#teacherSubjectErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Teacher '"+teacherName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"teachers/add",
            data:{teacherName:teacherName, teacherSurname:teacherSurname, teacherGender:teacherGender, teacherSubject:teacherSubject,teacherDepartment:teacherDepartment,teacherProfession:teacherProfession},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewTeacherForm").reset();
                    
                    //refresh the teachers list table
                    ltlt();
                    
                    //return focus to teacher name input
                    $("#teacherName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#teacherNameErr").text(returnedData.teacherName);
                    $("#teacherSurnameErr").text(returnedData.teacherSurname);
                    $("#teacherGenderErr").text(returnedData.teacherGender);
                    $("#teacherSubjectErr").text(returnedData.teacherSubject);
                    $("#teacherDepartmentErr").text(returnedData.teacherDepartment);
                    $("#teacherProfessionErr").text(returnedData.teacherProfession);
                    

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
    
    //reload teachers list table when events occur
    $("#teachersListPerPage, #teachersListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        ltlt();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#teacherSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/teachersearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#teachersListTable").html(returnedData.teachersListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            ltlt();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //triggers when a teacher's "edit" icon is clicked
    $("#teachersListTable").on('click', ".editTeacher", function(e){
        e.preventDefault();


        //get Teacher info
        var teacherId = $(this).attr('id').split("-")[1];
        var teacherName = $("#teacherName-" + teacherId).html();
        var teacherSurname = $("#teacherSurname-" + teacherId).html();
        var teacherSubject = $("#teacherSubject-" + teacherId).html();
        var teacherDepartment = $("#teacherDepartment-" + teacherId).html();
        var teacherProfession = $("#teacherProfession-" + teacherId).html();       
        
        
        //prefill form with info
        $("#teacherIdEdit").val(teacherId);
        $("#teacherNameEdit").val(teacherName);
        $("#teacherSurnameEdit").val(teacherSurname);
        $("#teacherSubjectEdit").val(teacherSubject);
        $("#teacherDepartmentEdit").val(teacherDepartment);
        $("#teacherProfessionEdit").val(teacherProfession);
        
        
        //remove all error messages that might exist
        $("#editTeacherFMsg").html("");
        $("#teacherIdEditErr").html("");
        $("#teacherNameEditErr").html("");
        $("#teacherSurnameEditErr").html("");
        $("#teacherSubjectEditErr").html("");
        $("#teacherDepartmentEditErr").html("");
        $("#teacherProfessionEditErr").html("");
        
        
        //launch modal
        $("#editTeacherModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editTeacherSubmit").click(function () {

        var teacherId = $("#teacherIdEdit").val();
        var teacherName = $("#teacherNameEdit").val();
        var teacherSurname = $("#teacherSurnameEdit").val();
        var teacherSubject = $("#teacherSubjectEdit").val();
        var teacherDepartment = $("#teacherDepartmentEdit").val();
        var teacherProfession = $("#teacherProfessionEdit").val();


    
        // Clear previous error messages
        $(".error-message").html("");
                
        if (!teacherSurname || !teacherSubject || !teacherId || !teacherName || !teacherDepartment) {
            if (!teacherSurname) $("#teacherSurnameErr").html("Surname cannot be empty");
            if (!teacherSubject) $("#teacherSubjectEditErr").html("Teacher Subject cannot be empty");
            if (!teacherId) $("#editTeacherFMsg").html("Unknown Teacher");
            if (!teacherName) $("#teacherNameEditErr").html("Teacher name cannot be empty");
            if (!teacherDepartment) $("#teacherDepartmentEditErr").html("Teacher Department cannot be empty");
            return;
        }

    
        $("#editTeacherFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
    
        $.ajax({
            method: "POST",
            url: appRoot + "teachers/edit",
            data: {
                teacherName: teacherName,
                teacherSurname: teacherSurname,
                _tId: teacherId,
                teacherSubject: teacherSubject,
                teacherAddress: teacherAddress,
                teacherDepartment:teacherDepartment,
                teacherProfession:teacherProfession
            }
        }).done(function (returnedData) {
            console.log(returnedData)

            if (returnedData.status === 1) {
                $("#editTeacherFMsg").css('color', 'green').html("Teacher successfully updated");
    
                setTimeout(function () {
                    $("#editTeacherModal").modal('hide');
                }, 1000);
    
                ltlt();
            } else {
                $("#editTeacherFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                if (returnedData.teacherName) $("#teacherNameEditErr").html(returnedData.teacherName);
                if (returnedData.teacherSurname) $("#teacherSurnameEditErr").html(returnedData.teacherSurname);
            }
        }).fail(function () {
            $("#editTeacherFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    
    //TO DELETE A Teacher (The teacher will be marked as "deleted" instead of removing it totally from the db)
    $("#teachersListTable").on('click', '.delTeacher', function(e){
        e.preventDefault();
        
        //get the taecher id
        var teacherId = $(this).parents('tr').find('.curTeacherId').val();
        var teacherRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(teacherId){
            var confirm = window.confirm("Are you sure you want to delete Teacher? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"teachers/delete",
                    method: "POST",
                    data: {i:teacherId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove teacher from list, update teachers' SN, display success msg
                        $(teacherRow).remove();

                        //update the SN
                        resetTeacherSN();

                        //display success message
                        changeFlashMsgContent('Teacher deleted', '', 'green', 1000);
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

    // Add a blur event listener for the National ID input add
    $("#teacherNational_id").on("blur", function () {
        var nationalID = $(this).val();
        var isValid = validateZimbabweanID(nationalID);

        if (isValid) {
            // Clear any previous error message
            $("#teacherNational_idErr").text("");
        } else {
            // Display an error message
            $("#teacherNational_idErr").text("Invalid National ID format");
        }
    });

    // Add a blur event listener for the National ID input edit
    $("#teacherNational_idEdit").on("blur", function () {
        var nationalID = $(this).val();
        var isValid = validateZimbabweanID(nationalID);

        if (isValid) {
            // Clear any previous error message
            $("#teacherNational_idEditErr").text("");
        } else {
            // Display an error message
            $("#teacherNational_idEditErr").text("Invalid National ID format");
        }
    });
});



/**
 * "ltlt" = "load Teacher List Table"
 * @param {type} url
 * @returns {undefined}
 */
function ltlt(url) {

    var orderBy = $("#teachersListSortBy").val().split("-")[0];
    var orderFormat = $("#teachersListSortBy").val().split("-")[1];
    var limit = $("#teachersListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "teachers/ltlt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#teachersListTable").html(returnedData.teachersListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetTeacherSN(){
    $(".teacherSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}

function validateZimbabweanID(id) {
    // Define the regex pattern for Zimbabwean National ID
    var pattern = /^\d{2}\d{6}[A-Z]\d{2}$/;
    // Check if the input matches the pattern
    return pattern.test(id);
}
