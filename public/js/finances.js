'use strict';
var initialOwedFees = 0;

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status

    // create the report of students and their owed fees as an excel 
    $(document).ready(function() {
        $("#generateReportBtn").click(function(e) {
            e.preventDefault();
            
            // Call the generateReport() function on the server with the selected feePartition
            $.ajax({
                url: appRoot + "test/generateReport",
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status === 1) {
                        // Extract the file name from the report_url
                        var reportUrlParts = response.report_url.split('/');
                        var fileName = reportUrlParts[reportUrlParts.length - 1];
                        
                        // Provide a link to download the generated report
                        var downloadLink = $('<a>')
                            .attr('href', response.report_url)
                            .attr('download', fileName) // Use the extracted file name
                            .text('Download Report');
                        $('#transreportDownloadLink').empty().append(downloadLink);
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



