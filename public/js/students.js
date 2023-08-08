'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Students once the page is ready
    lslt();
    
    
    
    //WHEN USE BARCODE SCANNER IS CLICKED
    $("#useBarcodeScanner").click(function(e){
        e.preventDefault();
        
        $("#studentStudent_id").focus();
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new student
     */
    $("#createStudent").click(function() {
        $("#studentsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewStudentDiv").toggleClass('hidden');
        $("#studentName").focus();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    
    $(".cancelAddStudent").click(function(){
        //reset and hide the form
        document.getElementById("addNewStudentForm").reset();//reset the form
        $("#createNewStudentDiv").addClass('hidden');//hide the form
        $("#studentsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //execute when 'auto-generate' checkbox is clicked while trying to add a new student
    $("#gen4me").click(function(){
        //if checked, generate a unique item code for user. Else, clear field
        if($("#gen4me").prop("checked")){
            var codeExist = false;
            
            do{
                //generate random string, reduce the length to 10 and convert to uppercase
                var rand = Math.random().toString(36).slice(2).substring(0, 10).toUpperCase();
                $("#studentStudent_id").val(rand);//paste the code in input
                $("#studentStudent_idErr").text('');//remove the error message being displayed (if any)
                
                //check whether code exist for another item
                $.ajax({
                    type: 'get',
                    url: appRoot+"students/gettablecol/id/code/"+rand,
                    success: function(returnedData){
                        codeExist = returnedData.status;//returnedData.status could be either 1 or 0
                    }
                });
            }
            
            while(codeExist);
            
        }
        
        else{
            $("#studentStudent_id").val("");
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new item
    $("#addNewStudent").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['studentNameErr', 'studentStudent_idErr', 'studentSurnameErr', 'studentClass_nameErr', 'addCustErrMsg','studentGenderErr', 'studentFeesErr', 'studentParent_nameErr', 'studentParent_phoneErr', 'studentAddressErr'], "");
        
        var studentStudent_id = $("#studentStudent_id").val();
        var studentName = $("#studentName").val();
        var studentSurname = $("#studentSurname").val();
        var studentClass_name = $("#studentClass_name").val();
        var studentGender = $("#studentGender").val();
        var studentFees = $("#studentFees").val().replace(",", "");
        var studentParent_name = $("#studentParent_name").val();
        var studentParent_phone = $("#studentParent_phone").val();
        var studentAddress = $("#studentAddress").val();

        
        if(!studentName || !studentStudent_id || !studentSurname || !studentGender || !studentParent_phone || !studentAddress || !studentFees){
            !studentName ? $("#studentNameErr").text("required") : "";
            !studentStudent_id ? $("#studentStudent_idErr").text("required") : "";
            !studentSurname ? $("#studentSurnameErr").text("required") : "";
            !studentGender ? $("#studentGenderErr").text("required") : "";
            !studentParent_phone ? $("#studentParent_phoneErr").text("required") : "";
            !studentAddress ? $("#studentAddressErr").text("required") : "";
            !studentFees ? $("#studentFeesErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Student '"+studentName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"students/add",
            data:{studentStudent_id:studentStudent_id, studentName:studentName, studentSurname:studentSurname, studentClass_name:studentClass_name, studentGender:studentGender, studentFees:studentFees, studentParent_name:studentParent_name, studentParent_phone:studentParent_phone, studentAddress:studentAddress},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewStudentForm").reset();
                    
                    //refresh the students list table
                    lslt();
                    
                    //return focus to student code input to allow adding item with barcode scanner
                    $("#studentStudent_id").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#studentStudent_idErr").text(returnedData.studentStudent_id);
                    $("#studentNameErr").text(returnedData.studentName);
                    $("#studentSurnameErr").text(returnedData.studentSurname);
                    $("#studentClass_nameErr").text(returnedData.studentClass_name)
                    $("#studentGenderErr").text(returnedData.studentGender);
                    $("#studentFeesErr").text(returnedData.studentFees);
                    $("#studentParent_nameErr").text(returnedData.studentParent_name);
                    $("#studentParent_phoneErr").text(returnedData.studentParent_phone);
                    $("#studentAddressErr").text(returnedData.studentAddress);
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
    
    //reload students list table when events occur
    $("#studentsListPerPage, #studentsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lslt();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#studentSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/studentsearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#studentsListTable").html(returnedData.studentsListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lslt();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //triggers when a student's "edit" icon is clicked
    $("#studentsListTable").on('click', ".editStudent", function(e){
        e.preventDefault();
        
        //get Student info
        var studentId = $(this).attr('id').split("-")[1];
        var studentName = $("#studentName-" + studentId).html();
        var studentSurname = $("#studentSurname-" + studentId).html();
        var studentStudentId = $("#studentStudent_id-" + studentId).html();
        var studentClassName = $("#studentClass_name-" + studentId).html();
        var studentParentName = $("#studentParent_name-" + studentId).html();
        var studentParentPhone = $("#studentParent_phone-" + studentId).html();
        var studentAddress = $("#studentAddress-" + studentId).html();
        var studentFees = $("#studentFees-" + studentId).html().replace(",", "");
        
        //prefill form with info
        $("#studentIdEdit").val(studentId);
        $("#studentNameEdit").val(studentName);
        $("#studentSurnameEdit").val(studentSurname);
        $("#studentClass_nameEdit").val(studentClassName);
        $("#studentAddressEdit").val(studentAddress);
        $("#studentStudent_idEdit").val(studentStudentId);
        $("#studentParent_nameEdit").val(studentParentName);
        $("#studentParent_phoneEdit").val(studentParentPhone);
        $("#studentFeesEdit").val(studentFees);
        
        //remove all error messages that might exist
        $("#editStudentFMsg").html("");
        $("#studentIdEditErr").html("");
        $("#studentNameEditErr").html("");
        $("#studentSurnameEditErr").html("");
        $("#studentClass_nameEditErr").html("");
        $("#studentAddressEditErr").html("");
        $("#studentStudent_idEditErr").html("");
        $("#studentParent_nameEditErr").html("");
        $("#studentParent_phoneEditErr").html("");
        $("#studentFeesEditErr").html("");
        
        
        //launch modal
        $("#editStudentModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editStudentSubmit").click(function(){
        var studentId = $("#studentIdEdit").val();
        var studentName = $("#studentNameEdit").val();
        var studentSurname = $("#studentSurnameEdit").val();
        var studentStudentId  = $("#studentStudent_idEdit").val();
        var studentClassName = $("#studentClass_nameEdit").val();
        var studentParentName = $("#studentParent_nameEdit").val();
        var studentParentPhone = $("#studentParent_phoneEdit").val();
        var studentAddress= $("#studentAddressEdit").val();
        var studentFees= $("#studentFeesEdit").val();

        
        if(!studentStudentId || !studentFees || !studentId || !studentName){
            !studentStudentId ? $("#studentStudent_idErr").html("Student name cannot be empty") : "";
            !studentFees ? $("#studentFeesEditErr").html("Student fees cannot be empty") : "";
            !studentId ? $("#editStudentFMsg").html("Unknown item") : "";
            !studentName ? $("#studentNameEditErr").html("Student name can not be empty") : "";
            return;
        }
        
        $("#editStudentFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
        
        $.ajax({
            method: "POST",
            url: appRoot+"students/edit",
            data: {studentName:studentName, studentStudentId:studentStudentId, studentSurname:studentSurname, _sId:studentId, studentClassName:studentClassName, studentParentName:studentParentName, studentParentPhone:studentParentPhone, studentAddress:studentAddress, studentFees:studentFees}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#editStudentFMsg").css('color', 'green').html("Student successfully updated");
                
                setTimeout(function(){
                    $("#editStudentModal").modal('hide');
                }, 1000);
                
                lslt();
            }
            
            else{
                $("#editStudentFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
                
                $("#studentStudent_idErr").html(returnedData.studentId);
                $("#studentNameEditErr").html(returnedData.studentName);
                $("#studentSurnameErr").html(returnedData.studentSurname);
            }
        }).fail(function(){
            $("#editStudentFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //trigers the modal to update student
    $("#studentsListTable").on('click', '.updateStudent', function(){
        //get item info and fill the form with them
        var studentId = $(this).attr('id').split("-")[1];
        var studentName = $("#studentName-" + studentId).html();
        var studentStudentId = $("#studentStudent_id-" + studentId).html();
        var studentFees = $("#studentFees-" + studentId).html().replace(",", "");
        
        
        $("#studentUpdateStudent_id").val(studentId);
        $("#studentUpdateStudentName").val(studentName);
        $("#studentUpdatestudentUpdateStudentStudent_id").val(studentStudentId);
        $("#studentUpdateItemQInStock").val(studentFees);
        
        $("#updateStudentModal").modal('show');
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //runs when the update type is changed while trying to update student
    //sets a default description if update type is "newFees"
    $("#studentUpdateType").on('change', function(){
        var updateType = $("#studentUpdateType").val();
        
        if(updateType && (updateType === 'newFees')){
            $("#studentUpdateDescription").val("New Fees gazzeted");
        }
        
        else{
            $("#studentpdateDescription").val("");
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the updating of student fees 
    $("#studentUpdateSubmit").click(function(){
        var updateType = $("#studentUpdateType").val();
        var studentUpdateFees = $("#stockUpdateFees").val();
        var studentUpdateDescription = $("#studentUpdateDescription").val();
        var studentId = $("#studentUpdateStudent_id").val();
        
        if(!updateType || !studentUpdateFees || !studentUpdateDescription || !studentId){
            !updateType ? $("#studentUpdateTypeErr").html("required") : "";
            !studentUpdateFees ? $("#studentUpdateFeesErr").html("required") : "";
            !studentUpdateDescription ? $("#studentUpdateDescriptionErr").html("required") : "";
            !studentId ? $("#studentUpdateStudent_idErr").html("required") : "";
            
            return;
        }
        
        $("#studentUpdateFMsg").html("<i class='"+spinnerClass+"'></i> Updating Student.....");
        
        $.ajax({
            method: "POST",
            url: appRoot+"students/updatestudent",
            data: {_sId:studentId, _upType:updateType, fees:studentUpdateFees, desc:studentUpdateDescription}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#studentUpdateFMsg").html(returnedData.msg);
                
                //refresh students' list
                lslt();
                
                //reset form
                document.getElementById("updateStudentForm").reset();
                
                //dismiss modal after some secs
                setTimeout(function(){
                    $("#updateStudentModal").modal('hide');//hide modal
                    $("#studentUpdateFMsg").html("");//remove msg
                }, 1000);
            }
            
            else{
                $("#studentUpdateFMsg").html(returnedData.msg);
                
                $("#studentUpdateTypeErr").html(returnedData._upType);
                $("#studentUpdateFeesErr").html(returnedData.fees);
                $("#studentUpdateDescriptionErr").html(returnedData.desc);
            }
        }).fail(function(){
            $("#studentUpdateFMsg").html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //PREVENT AUTO-SUBMISSION BY THE BARCODE SCANNER
    $("#studentStudent_id").keypress(function(e){
        if(e.which === 13){
            e.preventDefault();
            
            //change to next input by triggering the tab keyboard
            $("#studentName").focus();
        }
    });
    
    
    
    //TO DELETE A STUDENT (The studet will be marked as "deleted" instead of removing it totally from the db)
    $("#studentsListTable").on('click', '.delStudent', function(e){
        e.preventDefault();
        
        //get the student id
        var studentId = $(this).parents('tr').find('.curStudentId').val();
        var studentRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(studentId){
            var confirm = window.confirm("Are you sure you want to delete student? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"students/delete",
                    method: "POST",
                    data: {i:studentId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove student from list, update students' SN, display success msg
                        $(studentRow).remove();

                        //update the SN
                        resetStudentSN();

                        //display success message
                        changeFlashMsgContent('Student deleted', '', 'green', 1000);
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
 * "lslt" = "load Students List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lslt(url) {

    var orderBy = $("#studentsListSortBy").val().split("-")[0];
    var orderFormat = $("#studentsListSortBy").val().split("-")[1];
    var limit = $("#studentsListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "students/lslt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#studentsListTable").html(returnedData.studentsListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetStudentSN(){
    $(".studentSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}



