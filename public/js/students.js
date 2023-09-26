'use strict';
var initialOwedFees = 0;

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status

    // To load all classes in the class select
    $.ajax({
        url: appRoot + "students/getGradesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status === 1) {
                var grades = response.grades;
                var classDropdown = $('#classDropdown'); // Reference to the select element

                // Check if classDropdown is a valid element before manipulation
                if (classDropdown.length > 0) {
                    $.each(grades, function (index, grade) {
                        // Validate grade object properties before using them
                        if (grade && grade.id && grade.name) {
                            // Check if the option with the same value already exists
                            if (classDropdown.find('option[value="' + grade.id + '"]').length === 0) {
                                classDropdown.append($('<option>', {
                                    value: grade.id,
                                    text: grade.name
                                }));
                            }
                        }
                    });
                } else {
                    console.log('classDropdown is not defined or valid.');
                }
            } else {
                console.log('AJAX request failed with message: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.log('AJAX Error: ' + error);
            console.log('Error Response: ' + xhr.responseText); // Include more details for debugging
        }
    });

	
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
        fetchLastStudentId();
        fetchFeesIncome();
        $("#studentsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewStudentDiv").toggleClass('hidden');
        $("#studentName").focus();

       

    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      

    $("#classDropdown").change(function () {
        var selectedClass = $(this).val(); // Get the selected option's value
        lslt();
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
        
        changeInnerHTML(['studentNameErr', 'studentStudent_idErr', 'studentSurnameErr', 'studentClass_nameErr', 'addCustErrMsg','studentGenderErr', 'studentFeesErr', 'studentParent_nameErr', 'studentParent_phoneErr', 'studentAddressErr', 'studentOwed_feesErr', 'studentHealthy_statusErr', 'studentRelationshipErr'], "");
        
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
        var studentHealthy_status = $("#studentHealthy_status").val();
        var studentRelationship = $("#studentRelationship").val();
        var studentDob = $("#studentDob").val();

        // Add validation for studentParent_phone
        var phonePattern = /^(07\d{8})$|^(\+263\d{9,14})$/;

        // Calculate the date 5 years ago formatted as "YYYY-MM-DD"
        var today = new Date();
        var fiveYearsAgo = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());

        var enteredDate = new Date(studentDob);
        if ( enteredDate < fiveYearsAgo) {
            $("#studentDobErr").text("Invalid date. Please enter a date exactly 5 years ago or earlier.");
            return; // Return early without processing further if there's an error
        }

        
        if(!studentName || !studentStudent_id || !studentSurname || !studentGender || !studentParent_phone || !studentAddress || !studentFees || !studentOwed_fees || !studentRelationship || !phonePattern.test(studentParent_phone) || !studentDob ){
            !studentName ? $("#studentNameErr").text("required") : "";
            !studentStudent_id ? $("#studentStudent_idErr").text("required") : "";
            !studentSurname ? $("#studentSurnameErr").text("required") : "";
            !studentGender ? $("#studentGenderErr").text("required") : "";
            !studentParent_phone ? $("#studentParent_phoneErr").text("required") : "";
            !studentAddress ? $("#studentAddressErr").text("required") : "";
            !studentFees ? $("#studentFeesErr").text("required") : "";
            !studentOwed_fees ? $("#studentOwed_feesErr").text("required") : "";
            !studentRelationship ? $("#studentRelatioshipErr").text("required") : ""
            !phonePattern.test(studentParent_phone) ? $("#studentParent_phoneErr").html("Invalid phone number") : $("#studentParent_phoneErr").html("");
            !studentDob ? $("#studentDobErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Student '"+studentName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"students/add",
            data:{studentStudent_id:studentStudent_id, studentName:studentName, 
                studentSurname:studentSurname, studentClass_name:studentClass_name,
                studentGender:studentGender, studentFees:studentFees,
                studentParent_name:studentParent_name, studentParent_phone:studentParent_phone, 
                studentAddress:studentAddress, studentOwed_fees:studentOwed_fees,
                studentHealthy_status:studentHealthy_status, studentRelationship:studentRelationship,
                studentDob:studentDob
            },
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewStudentForm").reset();
                    
                    //refresh the students list table
                    lslt();
                    //update the student id
                    fetchLastStudentId();
                    
                    //return focus to student code input to allow adding student with barcode scanner
                    $("#studentStudent_id").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#studentStudent_idErr").text(returnedData.studentStudent_id);
                    $("#studentNameErr").text(returnedData.studentName);
                    $("#studentSurnameErr").text(returnedData.studentSurname);
                    $("#studentClass_nameErr").text(returnedData.studentClass_name);
                    $("#studentGenderErr").text(returnedData.studentGender);
                    $("#studentFeesErr").text(returnedData.studentFees);
                    $("#studentParent_nameErr").text(returnedData.studentParent_name);
                    $("#studentParent_phoneErr").text(returnedData.studentParent_phone);
                    $("#studentAddressErr").text(returnedData.studentAddress);
                    $("#studentOwed_feesErr").text(returnedData.studentOwed_fees);
                    $("#studentDobErr").text(returnedData.studentDob);
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
        var selectedClass = $("#classDropdown").val(); // Get the selected class value
        if (value) {
            $.ajax({
                url: appRoot + "search/studentsearch",
                type: "get",
                data: { v: value, selectedClass: selectedClass }, // Include selectedClass in the data
                success: function(returnedData){
                    $("#studentsListTable").html(returnedData.studentsListTable);
                }
            });
        } else {
            // Reload the table if all text in the search box has been cleared
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
        var studentHealthy_status = $("#studentHealthy_status-" + studentId).html();
        var studentRelationship = $("#studentRelationship-" + studentId).html();
        var studentFees = parseFloat($("#studentFees-" + studentId).html().replace(",", "")).toFixed(2);
        var studentOwed_fees = parseFloat($("#studentOwed_fees-" + studentId).html().replace(",", "")).toFixed(2);
        var studentDob = $("#studentDob-" + studentId).html();

        if (isNaN(studentOwed_fees)) {
            studentOwed_fees = 0;
        }
        
        
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
        $("#studentHealthy_statusEdit").val(studentHealthy_status);
        $("#studentRelationshipEdit").val(studentRelationship);
        $("#studentDobEdit").val(studentDob);
        
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
        $("#studentHealthy_statusEditErr").html("");
        $("#studentRelationshipEditErr").html("");
        $("#studentDobEditErr").html("");

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
        var studentHealthy_status = $("#studentHealthy_statusEdit").val();
        var studentRelationship = $("#studentRelationshipEdit").val();
        var studentDob = $("#studentDobEdit").val();
        
        // Clear previous error messages
        $(".errMsg").html("");
        $("#editStudentFMsg").html(""); 

        // Calculate the date 5 years ago formatted as "YYYY-MM-DD"
        var today = new Date();
        var fiveYearsAgo = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());

        var enteredDate = new Date(studentDob);
        if ( enteredDate < fiveYearsAgo) {
            $("#studentDobEditErr").text("Invalid date. Please enter a date exactly 5 years ago or earlier.");
            return; // Return early without processing further if there's an error
        }
        
        // Validate required fields
        if (!studentStudent_id || !studentFees || !studentId || !studentName || !studentDob) {
            if (!studentStudent_id) $("#studentStudent_idEditErr").html("Student ID cannot be empty");
            if (!studentFees) $("#studentFeesEditErr").html("Student fees cannot be empty");
            if (!studentId) $("#editStudentFMsg").html("Unknown Student");
            if (!studentName) $("#studentNameEditErr").html("Student name cannot be empty");
            if (!studentDob) $("#studentDobEditErr").html("DOB cannot be empty");
            return;
        }
    
        if ($("#enableOwedFeesEdit").prop("checked")) {
            // Calculate the combined owed fees value (initial + owed fees from form)
            var owedFeesFromForm = parseFloat(studentOwed_fees);
           
            // Check if initialOwedFees is a valid number, if not, set it to 0
            if (isNaN(initialOwedFees) || initialOwedFees === null || initialOwedFees === undefined) {
                initialOwedFees = 0;
            }
            combinedOwedFees = initialOwedFees + owedFeesFromForm;
        } else {
            // Store the owed fees value from the form
            combinedOwedFees = parseFloat(studentOwed_fees);
        }
    
        // Display a loading message
        $("#editStudentFMsg").css('color', 'black').html("<i class='fa fa-spinner fa-spin'></i> Processing your request....");
    
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
                studentOwed_fees: combinedOwedFees,
                studentHealthy_status: studentHealthy_status,
                studentRelationship: studentRelationship,
                studentDob:studentDob
            }
        }).done(function (returnedData) {
            if (returnedData.status === 1) {
                // Success message
                $("#editStudentFMsg").css('color', 'green').html("Student successfully updated");
                setTimeout(function () {
                    $("#editStudentModal").modal('hide');
                }, 1000);
                lslt(); // Call your custom function
            } else {
                // Handle errors returned from the server
                $("#editStudentFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                if (returnedData.errors) {
                    // Display field-specific errors
                    if (returnedData.errors.studentStudent_id) $("#studentStudent_idEditErr").html(returnedData.errors.studentStudent_id);
                    if (returnedData.errors.studentName) $("#studentNameEditErr").html(returnedData.errors.studentName);
                    if (returnedData.errors.studentSurname) $("#studentSurnameEditErr").html(returnedData.errors.studentSurname);
                    // Add more error handling for other fields as needed
                }
            }
        }).fail(function () {
            // Handle AJAX request failure
            $("#editStudentFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#generateReport").click(function(e) {
        e.preventDefault();
        
        // Get the selected value from the percentageSelect dropdown
        var feePartition = $("#percentageSelect").val();
    
        // Get the selected class from the classDropdown
        var selectedClass = $("#classDropdown").val();
    
        // Call the generateReport() function on the server with the selected feePartition
        $.ajax({
            url: appRoot + "students/generateReport",
            type: 'POST',
            data: { feePartition: feePartition, selectedClass: selectedClass },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === 1) {
                    // Provide a link to download the generated report with a filename containing the date
                    var currentDate = new Date();
                    var dateString = currentDate.toISOString().slice(0,10); // Get the current date in YYYY-MM-DD format
                    var filename = 'student_report_' + dateString + '.xlsx';
    
                    var downloadLink = $('<a>')
                        .attr('href', response.report_url)
                        .attr('download', filename)
                        .text('Download Report');
                    $('#reportDownloadLink').empty().append(downloadLink);
                } else if (response.status === 0) {
                    // Handle the case where no students were found
                    $('#reportDownloadLink').empty().text('No students found with the selected criteria.');
                } else {
                    // Error while generating the report
                    alert('An error occurred while generating the report.');
                }
            },
            error: function() {
                console.log("Error occurred during AJAX call.");
            }
        });

         // remove phone error when keys are clicked 
        $("#studentParent_phone").keyup(function(){

            changeInnerHTML(["studentParent_phoneErr"], "");      
        });
    });
    
    
   
    
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    
    // TO DELETE A STUDENT (The student will be marked as "deleted" instead of removing it totally from the db)
    $("#studentsListTable").on('click', '.delStudent', function(e){
        e.preventDefault();
        
        // Get the student ID
        var studentId = $(this).parents('tr').find('.curStudentId').val();
        var studentRow = $(this).closest('tr'); // To be used in removing the currently deleted row
        
        if(studentId){
            // Check student's fees status first
            $.ajax({
                url: appRoot + "students/getStudentFeesStatus", 
                method: "POST",
                data: { student_id: studentId }, 
                dataType: "json"
            }).done(function(rd){
                if (rd.status === 1) {
                    // No fees owed, confirm deletion
                    var confirmDelete = window.confirm("Are you sure you want to delete this student? This cannot be undone.");
                    
                    if (confirmDelete) {
                        displayFlashMsg('Please wait...', spinnerClass, 'black');
                        
                        // Proceed with deleting the student from the database
                        $.ajax({
                            url: appRoot + "students/delete",
                            method: "POST",
                            data: { i: studentId }
                        }).done(function(rd){
                            if(rd.status === 1){
                                // Remove student from list, update students' SN, display success msg
                                $(studentRow).remove();
        
                                // Update the SN
                                resetStudentSN();
        
                                // Display success message
                                changeFlashMsgContent('Student deleted', '', 'green', 1000);
                            }
                            else{
                                changeFlashMsgContent(rd.message, '', 'green', 3000);
                            }
                        }).fail(function(){
                            console.log('Req Failed');
                        });
                    }
                } else if (rd.status === 0) {
                    // Fees owed, inform the user
                    window.alert(rd.message);
                } else {
                    // Error or invalid student ID
                    window.alert("An error occurred: " + rd.message);
                }
            }).fail(function(){
                console.log('Req Failed');
            });
        }
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Add an input event listener to the input field with the ID "studentParent_phone"
    $("#studentParent_phone").on('input', function(e){
        // Get the trimmed value entered by the user
        const enteredValue = $(this).val().trim();
        
        // Define the valid prefixes
        const validPrefixes = ["07", "+263"];
        
        // Check if the entered value starts with any valid prefix
        const isValid = validPrefixes.some(prefix => enteredValue.startsWith(prefix));

        // Get the error message element
        const custPhoneErr = $("#studentParent_phoneErr");

        // Update the error message based on validity
        if (isValid) {
            custPhoneErr.html("");
        } else {
            custPhoneErr.html("Invalid phone number");
        }
    });
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
    var selectedClass = $("#classDropdown").val(); 

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "students/lslt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit,
            selectedClass: selectedClass
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

// function to create the student id for the currrent month
function fetchLastStudentId() {
    $.ajax({
        type: 'GET',
        url: appRoot + "students/lastStudentIdForMonth",
        success: function (response) {
            if (response.status === 1) {
                // Set the new student ID to the input field
                $('#studentStudent_id').val(response.newStudentId);
                
            } else {
                // Handle the case when an error occurs or no student ID is found
                alert('An error occurred while fetching the last student ID.');
            }
        },
        error: function () {
            // Handle any errors that occur during the AJAX request
            alert('An error occurred while fetching the last student ID.');
        }
    });
}

// Function to fetch the "Fees" income amount
function fetchFeesIncome() {
    $.ajax({
        url: appRoot + "incomes/getIncomes",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 1) {
            
                var fees = parseFloat(response.feesAmount);
                var regFees = parseFloat(response.regFeeAmount);

                // Check if parsing was successful
                if (!isNaN(fees) && !isNaN(regFees)) {
                    fees = fees.toFixed(2); // Format fees to have two decimal places
                    regFees = regFees.toFixed(2); // Format regFees to have two decimal places

                    var owedFees = (parseFloat(fees) + parseFloat(regFees)).toFixed(2); 
                }
                
                $('#studentFees').val(fees);
                $('#studentRegFees').val(regFees);
                $('#studentOwed_fees').val(owedFees)
                
            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error: ' + error);
        }
    });
}

