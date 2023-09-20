'use strict';
var initialOwedFees = 0;

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status

    // To load all classes in the class select
    $.ajax({
        url: appRoot + "examinations/getGradesForSelect/",
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
    
    
    
    
   
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      

    $("#classDropdown").change(function () {
        lslt();
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
        var selectedClass = $("#classDropdown").val(); // Get the selected class value
        if (value) {
            $.ajax({
                url: appRoot + "search/examStudentSearch",
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
    
    // Register Button Click (Event Delegation)
    $(document).on('click', '.registerButton', function(e) {
        e.preventDefault();

        var studentId = $(this).data('student-id');
        // Check if the student is already registered with subjects
        var numberOfSubjects = $("#numberOfSubjects-" + studentId).text().trim();
        if (numberOfSubjects !== 'N/A') {
            // Show a message to inform the user
            displayFlashMsg('This student is already registered. You can view the details.', '', 'red', 0);
            return; // Don't proceed with registration
        }
        $.ajax({
            url: appRoot + "examinations/getInfoNSubjects/",
            type: 'GET',
            dataType: 'json',
            data: { studentId: studentId },
            success: function (response) {
                
                $("#studentName").val(response.studentInfo.name);
                $("#studentSurname").val(response.studentInfo.surname);

                var subjects = response.subjects;
                var subjectCheckboxes = $("#subjectCheckboxes");
                subjectCheckboxes.empty();     

                $.each(subjects, function(index, subject) {
                    var checkboxId = "subject" + subject.id;
                    subjectCheckboxes.append(
                        '<div class="form-check">' +
                        '<input class="form-check-input" type="checkbox" value="' + subject.id + '" id="' + checkboxId + '">' +
                        '<label class="form-check-label" for="' + checkboxId + '">' + subject.name + '</label>' +
                        '</div>'
                    );
                });

                $("#studentId").val(studentId);

                // Show the registration modal
                $("#registrationModal").modal('show');
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error: ' + error);
                console.log('Error Response: ' + xhr.responseText); // Include more details for debugging
            }
        });
    });


    $("#registerButton").on("click", function () {
        $('.errMsg').text('');
    
        // Get the values from the input fields
        var studentName = $('#studentName').val();
        var studentSurname = $('#studentSurname').val();
        var zimsecRegNumber = $('#zimsecRegNumber').val();
        var studentId = $('#studentId').val();
    
        // Check if the student ID, name, and surname are not empty
        if (studentId === '' || studentName === '' || studentSurname === '') {
            $('#addCustErrMsg').text('Please fill in all required fields.');
            return; 
        }
    
        // Check if at least one subject is selected
        var selectedSubjects = [];
        $('#subjectCheckboxes input:checked').each(function () {
            selectedSubjects.push($(this).val());
        });
    
        if (selectedSubjects.length === 0) {
            $('#addCustErrMsg').text('Please select at least one subject.');
            return; 
        }
    
        if (zimsecRegNumber === '') {
            $('#zimsecRegNumberErr').text('Registration Number cannot be empty.');
            return; 
        }
    
        // Prepare the data to be sent in the AJAX request
        var postData = {
            studentName: studentName,
            studentSurname: studentSurname,
            zimsecRegNumber: zimsecRegNumber,
            studentId: studentId,
            selectedSubjects: selectedSubjects
        };
        displayFlashMsg("Registering  '"+studentName+ " " +studentSurname+"'", "fa fa-spinner faa-spin animated", '', '');

        // Send an AJAX POST request to the registerStudent method
        $.ajax({
            url: 'examinations/registerStudent',
            type: 'POST',
            dataType: 'json',
            data: postData,
            success: function(response) {
                if (response.status === 1) {
                    changeFlashMsgContent(response.message, "text-success", '', 3000);
                    //refresh the students list table
                    lslt();
                    // Show the registration modal
                    $("#registrationModal").modal('hide');

                } else {
                    // Display the error message
                    $('#addCustErrMsg').text(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + error);
                console.log('Error Response: ' + xhr.responseText);
            }
        });
    });
    

    // View Button Click (Event Delegation)
    $(document).on('click', '.viewButton', function(e) {
        e.preventDefault();
        
        var studentId = $(this).data('student-id');
        // Check if the student is already registered with subjects
        var numberOfSubjects = $("#numberOfSubjects-" + studentId).text().trim();
        if (numberOfSubjects == 'N/A') {
            // Show a message to inform the user
            displayFlashMsg('This student is not registered. You can register first.', '', 'red', 0);
            return; // Don't proceed with registration
        }
        
        $.ajax({
            url: appRoot + "examinations/getInfoNSubjectsView/",
            type: 'GET',
            dataType: 'json',
            data: { studentId: studentId },
            success: function (response) {
                console.log("Response:", response);

                // Populate the modal with data from the response
                $("#viewStudentName").val(response.studentInfo.name);
                $("#viewStudentSurname").val(response.studentInfo.surname);
                $("#viewZimsecRegNumber").val(response.studentInfo.zimsec_reg_num);

                // Clear and populate the list of registered subjects
                var registeredSubjectsList = $("#viewRegisteredSubjects");
                registeredSubjectsList.empty();

                // Split the subjects string into an array
                var subjectsArray = response.studentInfo.subjects.split(',');

                // Loop through the subjects array and add them to the list
                $.each(subjectsArray, function(index, subject) {
                    registeredSubjectsList.append('<li class="list-group-item">' + subject.trim() + '</li>');
                });

                // Set the exams_regId hidden field
                $("#exams_regId").val(response.studentInfo.id);

                // Show the registration modal
                $("#viewRegistrationModal").modal('show');
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error: ' + error);
                console.log('Error Response: ' + xhr.responseText); // Include more details for debugging
            }
        });
    });

    $("#cancelRegistrationButton").on("click", function () {
        var exams_regId = $("#exams_regId").val();
    
        // Confirm with the user before proceeding
        if (confirm("Are you sure you want to cancel this registration?")) {
            displayFlashMsg("Registering Cancelling", "fa fa-spinner faa-spin animated", '', '');
            $.ajax({
                url: appRoot + "examinations/deleteRecord",
                type: "POST",
                data: { exams_reg_id: exams_regId },
                dataType: "json",
                success: function (response) {
                    if (response.status === 1) {
                        changeFlashMsgContent(response.message, "text-success", '', 4000);
                        //refresh the students list table
                        lslt();
                        // close the view reg modal modal
                        $("#viewRegistrationModal").modal('hide');
                    } else {
                        alert("Failed to cancel registration. " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error: " + error);
                    console.log("Error Response: " + xhr.responseText); // Include more details for debugging
                    alert("An error occurred while canceling registration.");
                },
            });
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
        url: url ? url : appRoot + "examinations/lslt/",
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






