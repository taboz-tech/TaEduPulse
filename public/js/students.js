'use strict';
var initialOwedFees = 0;

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
        populateGradesSelect();
        $("#studentsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewStudentDiv").toggleClass('hidden');
        $("#studentName").focus();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    $('#studentFees').on('input', function() {
        var studentFeesValue = parseFloat($(this).val());
        
        var studentOwedFeesValue = isNaN(studentFeesValue) ? 0 : studentFeesValue;
        
        $('#studentOwed_fees').val(studentOwedFeesValue);
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
        //if checked, generate a unique student id for user. Else, clear field
        if($("#gen4me").prop("checked")){
            var codeExist = false;
            
            do{
                //generate random string, reduce the length to 10 and convert to uppercase
                var rand = Math.random().toString(36).slice(2).substring(0, 10).toUpperCase();
                $("#studentStudent_id").val(rand);//paste the code in input
                $("#studentStudent_idErr").text('');//remove the error message being displayed (if any)
                
                //check whether code exist for another student
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
    
    //handles the submission of adding new student
    $("#addNewStudent").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['studentNameErr', 'studentStudent_idErr', 'studentSurnameErr', 'studentClass_nameErr', 'addCustErrMsg','studentGenderErr', 'studentFeesErr', 'studentParent_nameErr', 'studentParent_phoneErr', 'studentAddressErr', 'studentOwed_feesErr'], "");
        
        var studentStudent_id = $("#studentStudent_id").val();
        var studentName = $("#studentName").val();
        var studentSurname = $("#studentSurname").val();
        var studentClass_name = $("#studentClass_name").val();
        var studentGender = $("#studentGender").val();
        var studentFees = $("#studentFees").val().replace(",", "");
        var studentParent_name = $("#studentParent_name").val();
        var studentParent_phone = $("#studentParent_phone").val();
        var studentAddress = $("#studentAddress").val();
        var studentOwed_fees = $("#studentOwed_fees").val();

        
        if(!studentName || !studentStudent_id || !studentSurname || !studentGender || !studentParent_phone || !studentAddress || !studentFees || !studentOwed_fees){
            !studentName ? $("#studentNameErr").text("required") : "";
            !studentStudent_id ? $("#studentStudent_idErr").text("required") : "";
            !studentSurname ? $("#studentSurnameErr").text("required") : "";
            !studentGender ? $("#studentGenderErr").text("required") : "";
            !studentParent_phone ? $("#studentParent_phoneErr").text("required") : "";
            !studentAddress ? $("#studentAddressErr").text("required") : "";
            !studentFees ? $("#studentFeesErr").text("required") : "";
            !studentOwed_fees ? $("#studentOwed_feesErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Student '"+studentName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"students/add",
            data:{studentStudent_id:studentStudent_id, studentName:studentName, studentSurname:studentSurname, studentClass_name:studentClass_name, studentGender:studentGender, studentFees:studentFees, studentParent_name:studentParent_name, studentParent_phone:studentParent_phone, studentAddress:studentAddress, studentOwed_fees:studentOwed_fees},
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewStudentForm").reset();
                    
                    //refresh the students list table
                    lslt();
                    
                    //return focus to student code input to allow adding student with barcode scanner
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
                    $("#studentOwed_feesErr").text(returnedData.studentOwed_fees)
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


    $("#enableOwedFeesEdit").prop("checked", false); // Set the checkbox to unchecked by default

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // Checkbox event handler to toggle the owed fees field's editability
    $("#enableOwedFeesEdit").on("change", function() {
        updateOwedFeesEditability();
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
        $("#studentOwed_feesEdit").prop("disabled", true);
        $("#enableOwedFeesEdit").prop("checked", false);
        
        //get Student info
        var studentId = $(this).attr('id').split("-")[1];
        var studentName = $("#studentName-" + studentId).html();
        var studentSurname = $("#studentSurname-" + studentId).html();
        var studentStudent_id = $("#studentStudent_id-" + studentId).html();
        var studentClass_name = $("#studentClass_name-" + studentId).html();
        var studentParent_name = $("#studentParent_name-" + studentId).html();
        var studentParent_phone = $("#studentParent_phone-" + studentId).html();
        var studentAddress = $("#studentAddress-" + studentId).html();
        var studentFees = $("#studentFees-" + studentId).html().replace(",", "");
        var studentOwed_fees = $("#studentOwed_fees-" + studentId).html();
        
        
        //prefill form with info
        $("#studentIdEdit").val(studentId);
        $("#studentNameEdit").val(studentName);
        $("#studentSurnameEdit").val(studentSurname);
        $("#studentAddressEdit").val(studentAddress);
        $("#studentStudent_idEdit").val(studentStudent_id);
        $("#studentParent_nameEdit").val(studentParent_name);
        $("#studentParent_phoneEdit").val(studentParent_phone);
        $("#studentFeesEdit").val(studentFees);
        $("#studentOwed_feesEdit").val(studentOwed_fees);
        
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
        $("#studentOwed_feesEditErr").html("");

        // Fetch and populate the student class select field
        populateEditGradesSelect(appRoot + "students/getGradesForSelect/", studentClass_name);


        
        
        //launch modal
        $("#editStudentModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editStudentSubmit").click(function () {

        // Create a variable to store owed fees value
        var combinedOwedFees;
        

        var studentId = $("#studentIdEdit").val();
        var studentName = $("#studentNameEdit").val();
        var studentSurname = $("#studentSurnameEdit").val();
        var studentStudent_id = $("#studentStudent_idEdit").val();
        var studentClass_name = $("#studentClass_nameEdit").val();
        var studentParent_name = $("#studentParent_nameEdit").val();
        var studentParent_phone = $("#studentParent_phoneEdit").val();
        var studentAddress = $("#studentAddressEdit").val();
        var studentFees = $("#studentFeesEdit").val();
        var studentOwed_fees = $("#studentOwed_feesEdit").val();

    
        // Clear previous error messages
        $(".error-message").html("");
                
        if (!studentStudent_id || !studentFees || !studentId || !studentName) {
            if (!studentStudent_id) $("#studentStudent_idErr").html("Student ID cannot be empty");
            if (!studentFees) $("#studentFeesEditErr").html("Student fees cannot be empty");
            if (!studentId) $("#editStudentFMsg").html("Unknown Student");
            if (!studentName) $("#studentNameEditErr").html("Student name cannot be empty");
            return;
        }

        if ($("#enableOwedFeesEdit").prop("checked")) {
        // Calculate the combined owed fees value (initial + owed fees from form)
        var owedFeesFromForm = parseFloat(studentOwed_fees);
        combinedOwedFees = initialOwedFees + owedFeesFromForm;
        console.log("we are here")
        } else {
            // Store the owed fees value from the form
            combinedOwedFees = parseFloat(studentOwed_fees);
            console.log("weare below my guy")
        }
    
        $("#editStudentFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
    
        $.ajax({
            method: "POST",
            url: appRoot + "students/edit",
            data: {
                studentName: studentName,
                studentStudent_id: studentStudent_id,
                studentSurname: studentSurname,
                _sId: studentId,
                studentClass_name: studentClass_name,
                studentParent_name: studentParent_name,
                studentParent_phone: studentParent_phone,
                studentAddress: studentAddress,
                studentFees: studentFees,
                studentOwed_fees: combinedOwedFees
            }
        }).done(function (returnedData) {
            if (returnedData.status === 1) {
                $("#editStudentFMsg").css('color', 'green').html("Student successfully updated");
    
                setTimeout(function () {
                    $("#editStudentModal").modal('hide');
                }, 1000);
    
                lslt();
            } else {
                $("#editStudentFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                if (returnedData.studentId) $("#studentStudent_idErr").html(returnedData.studentId);
                if (returnedData.studentName) $("#studentNameEditErr").html(returnedData.studentName);
                if (returnedData.studentSurname) $("#studentSurnameErr").html(returnedData.studentSurname);
            }
        }).fail(function () {
            $("#editStudentFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // create the report of students and their owed fees as an excel 
    $(document).ready(function() {
        $("#generateReport").click(function(e) {
            e.preventDefault();
            
            // Get the selected value from the percentageSelect dropdown
            var feePartition = $("#percentageSelect").val();
    
            // Call the generateReport() function on the server with the selected feePartition
            $.ajax({
                url: appRoot + "students/generateReport",
                type: 'POST',
                data: { feePartition: feePartition }, // Pass the selected value to the server
                dataType: 'json',
                success: function(response) {
                    if (response.status === 1) {
                        
    
                        // Provide a link to download the generated report
                        var downloadLink = $('<a>')
                            .attr('href', response.report_url)
                            .attr('download', 'student_report.xlsx')
                            .text('Download Report');
                        $('#reportDownloadLink').empty().append(downloadLink);
                    } else {
                        // Error while generating the report
                        alert('An error occurred while generating the report.');
                    }
                },
                error: function() {
                    console.log("Error occurred during AJAX call.");
                }
            });
        });
    });
    
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    
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



function updateOwedFeesEditability() {
    var isEnabled = $("#enableOwedFeesEdit").prop("checked");
    $("#studentOwed_feesEdit").prop("disabled", !isEnabled);

    if (isEnabled) {
        // Get the displayed owed fees value from the input field
        var displayedOwedFees = parseFloat($("#studentOwed_feesEdit").val());

        initialOwedFees = displayedOwedFees;
    }
}




function populateGradesSelect(url) {
    $.ajax({
        url: url ? url : appRoot + "students/getGradesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var grades = response.grades;
                var selectField = $('#studentClass_name');

                // Clear existing options and add a default empty option
                selectField.empty().append($('<option>', {
                    value: '',
                    text: 'Select Class'
                }));

                // Populate options
                $.each(grades, function(index, grade) {
                    selectField.append($('<option>', {
                        value: grade.id,
                        text: grade.name
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


// Function to populate the edit student class select field
function populateEditGradesSelect(url, selectedGradeId) {

    var selectField = $("#studentClass_nameEdit");

    $.ajax({
        url: url ? url : appRoot + "students/getGradesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
                var grades = response.grades;

                selectField.empty();

                $.each(grades, function(index, grade) {
                    selectField.append($('<option>', {
                        value: grade.id,
                        text: grade.name,
                        selected: grade.name === selectedGradeId
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



