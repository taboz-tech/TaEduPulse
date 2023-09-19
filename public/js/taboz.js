'use strict';
var initialOwedFees = 0;

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
    $.ajax({
        url: appRoot + "students/getGradesForSelect/",
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status === 1) {
                var grades = response.grades;
                var classDropdown = $('#classDropdown'); // Reference to the select element
                if (classDropdown.length > 0) {
                    $.each(grades, function (index, grade) {
                        if (grade && grade.id && grade.name) {
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
	
    lslt();
    //WHEN USE BARCODE SCANNER IS CLICKED
    $("#useBarcodeScanner").click(function(e){
        e.preventDefault();
        
        $("#studentStudent_id").focus();
    });
    
   
   
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
    
       

    $("#classDropdown").change(function () {
        var selectedClass = $(this).val(); // Get the selected option's value
        lslt();
    });
    

    $(".cancelAddStudent").click(function(){
        //reset and hide the form
        document.getElementById("addNewStudentForm").reset();//reset the form
        $("#createNewStudentDiv").addClass('hidden');//hide the form
        $("#studentsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
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

        
        if(!studentName || !studentStudent_id || !studentSurname || !studentGender || !studentParent_phone || !studentAddress || !studentFees || !studentOwed_fees || !studentRelationship){
            !studentName ? $("#studentNameErr").text("required") : "";
            !studentStudent_id ? $("#studentStudent_idErr").text("required") : "";
            !studentSurname ? $("#studentSurnameErr").text("required") : "";
            !studentGender ? $("#studentGenderErr").text("required") : "";
            !studentParent_phone ? $("#studentParent_phoneErr").text("required") : "";
            !studentAddress ? $("#studentAddressErr").text("required") : "";
            !studentFees ? $("#studentFeesErr").text("required") : "";
            !studentOwed_fees ? $("#studentOwed_feesErr").text("required") : "";
            !studentRelationship ? $("#studentRelatioshipErr").text("required") : ""
            
            
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
                studentHealthy_status:studentHealthy_status, studentRelationship:studentRelationship
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
    
     
    //reload students list table when events occur
    $("#studentsListPerPage, #studentsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lslt();
    });
    

    $("#enableOwedFeesEdit").prop("checked", false); // Set the checkbox to unchecked by default

    // Checkbox event handler to toggle the owed fees field's editability
    $("#enableOwedFeesEdit").on("change", function() {
        updateOwedFeesEditability();
    });

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

        // Fetch and populate the student class select field
        populateEditGradesSelect(appRoot + "students/getGradesForSelect/", studentClass_name);

        //launch modal
        $("#editStudentModal").modal('show');
    });
    
      
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
        var studentHealthy_status = $("#studentHealthy_statusEdit");
        var studentRelationship = $("#studentRelationship");

    
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
        } else {
            // Store the owed fees value from the form
            combinedOwedFees = parseFloat(studentOwed_fees);
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
                studentOwed_fees: combinedOwedFees,
                studentHealthy_status:studentHealthy_status,
                studentRelationship:studentRelationship
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
    
     
    // create the report of students and their owed fees as an excel 
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
                    // Provide a link to download the generated report
                    var downloadLink = $('<a>')
                        .attr('href', response.report_url)
                        .attr('download', 'student_report.xlsx')
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

public function edit(){
    $this->genlib->ajaxOnly();
    
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('', '');

    // Define form validation rules
    $this->form_validation->set_rules('_sId', '', ['required', 'trim', 'numeric']);
    $this->form_validation->set_rules('studentName', 'Student Name', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
    $this->form_validation->set_rules('studentSurname', 'Student Surname', ['required', 'trim', 'max_length[30]'], ['required'=>'required']);
    $this->form_validation->set_rules('studentClass_name', 'Student Class_name', ['required', 'trim', 'max_length[15]'], ['required'=>'required']);
    $this->form_validation->set_rules('studentFees', 'Student Fees', ['required', 'trim', 'numeric'], ['required'=>'required']);
    $this->form_validation->set_rules('studentParent_name', 'Student Parent_name', ['required', 'trim', 'max_length[50]'], ['required'=>'required']);
    $this->form_validation->set_rules('studentAddress', 'Student Address', ['required', 'trim', 'max_length[80]'], ['required'=>'required']);
    $this->form_validation->set_rules('studentStudent_id', 'Student Student_id', ['required', 'trim', 'max_length[15]'], ['required'=>'required']);
    $this->form_validation->set_rules('studentParent_phone','Student Student_phone',['required','trim','max_length[15]'],['required'=>'required']);
    $this->form_validation->set_rules('studentOwed_fees', 'Student Owed Fees', ['numeric', 'greater_than_equal_to[0]'], ['numeric' => 'The %s field must be a valid number.','greater_than_equal_to' => 'The %s field must be greater than or equal to 0.']);
    
    // Initialize an array to store detailed error messages
    $errorMessages = [];

    try {
        // Check if form validation is successful
        if ($this->form_validation->run() !== FALSE) {

        
            $studentId = set_value('_sId');
            $studentName = set_value('studentName');
            $studentId = set_value('_sId');
            $studentName = set_value('studentName');
            $studentSurname = set_value('studentSurname');
            $studentClass_name = set_value('studentClass_name');
            $studentParent_phone = set_value('studentParent_phone');
            $studentFees = set_value('studentFees');
            $studentAddress = set_value('studentAddress');
            $studentParent_name = set_value('studentParent_name');
            $studentOwed_fees = set_value('studentOwed_fees');
            $studentHealthy_status = set_value('studentHealthy_status');
            $studentRelationship = set_value('studentRelationship');

            log_message("error","student Surname is: ".$studentSurname)

            // Update student in the database
            $updated = $this->student->edit($studentId, $studentName, $studentSurname, $studentClass_name, $studentParent_phone, $studentFees, $studentParent_name, $studentAddress, $studentOwed_fees, $studentHealthy_status, $studentRelationship);

            if (!$updated) {
                throw new Exception("Unable to update the student record. Please try again later or contact the administrator.");
            }

            // Add an event log entry
            $desc = "Details of student with Student ID '$studentStudent_id' was updated";
            $this->genmod->addevent("Student Update", $studentId, $desc, 'students', $this->session->admin_id);

            // Set status to 1 if everything is successful
            $json['status'] = 1;
        } else {
            // Form validation failed, throw an exception with validation errors
            $validationErrors = $this->form_validation->error_array();

            // Convert form validation errors to detailed error messages
            foreach ($validationErrors as $field => $message) {
                $errorMessages[] = "Field '{$field}': {$message}";
            }

            throw new Exception("Form validation failed.");
        }
    } catch (Exception $e) {
        // Handle exceptions and set status to 0
        $json['status'] = 0;
        $errorMessages[] = $e->getMessage();
    }

    // Include detailed error messages in the JSON response
    $json['errors'] = $errorMessages;

    log_message("error","the response is: ".print_r($json,TRUE));
    // Set response content type and output JSON response
    $this->output->set_content_type('application/json')->set_output(json_encode($json));
}