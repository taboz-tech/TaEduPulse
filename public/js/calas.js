'use strict';
var initialOwedFees = 0;

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status

    // To load all classes in the class select
    $.ajax({
        url: appRoot + "calas/getGradesForSelect/",
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
    
    

    // Add an event listener to the "Capture Marks" button
    $("#captureMarks").click(function () {
        // Open the modal dialog
        $('#classSubjectSelectionModal').modal('show');

        // Populate class checkboxes dynamically
        var classCheckboxes = $("#classCheckboxes");
        classCheckboxes.empty(); // Clear any previous checkboxes

        // Send an AJAX request to retrieve classes and populate the checkboxes
        $.ajax({
            url: appRoot + "calas/getGradesForSelect/",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status === 1) {
                    var classes = response.grades;
                    $.each(classes, function (index, classItem) {
                        // Create a checkbox for each class
                        var checkbox = $('<input type="checkbox" class="form-check-input" name="classCheckbox[]" value="' + classItem.id + '">');
                        var label = $('<label class="form-check-label">' + classItem.name + '</label>');
                        var div = $('<div class="form-check">').append(checkbox).append(label);
                        classCheckboxes.append(div);
                    });
                } else {
                    console.log('Failed to retrieve classes.');
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error: ' + error);
                console.log('Error Response: ' + xhr.responseText);
            }
        });

        // Populate subject checkboxes dynamically
        var subjectCheckboxes = $("#subjectCheckboxes");
        subjectCheckboxes.empty(); // Clear any previous checkboxes

        // Send an AJAX request to retrieve subjects and populate the checkboxes
        $.ajax({
            url: appRoot + "calas/getAllSubjects/",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status === 1) {
                    var subjects = response.subjects;
                    $.each(subjects, function (index, subject) {
                        // Create a checkbox for each subject
                        var checkbox = $('<input type="checkbox" class="form-check-input" name="subjectCheckbox[]" value="' + subject.id + '">');
                        var label = $('<label class="form-check-label">' + subject.name + '</label>');
                        var div = $('<div class="form-check">').append(checkbox).append(label);
                        subjectCheckboxes.append(div);
                    });
                } else {
                    console.log('Failed to retrieve subjects.');
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error: ' + error);
                console.log('Error Response: ' + xhr.responseText);
            }
        });
    });

    // Handle the selected classes and subjects when the user confirms their selection
    $("#confirmClassSubjectSelection").click(function () {
        var selectedClasses = $("input[name='classCheckbox[]']:checked").map(function () {
            return $(this).val();
        }).get();
        var selectedSubjects = $("input[name='subjectCheckbox[]']:checked").map(function () {
            return $(this).val();
        }).get();

        if (selectedClasses.length === 1 && selectedSubjects.length === 1) {
            
            // Call the getStudentsData method with the selected class and subject
            $.ajax({
                url: appRoot + "calas/getStudentsData",
                method: "GET",
                data: {
                    class: selectedClasses[0], // Pass the selected class
                    subject: selectedSubjects[0] // Pass the selected subject
                },
                dataType: "json",
                success: function (response) {
                    console.log("Response from getStudentsData:", response);
                    $('#classSubjectSelectionModal').modal('hide');
                
                    if (response.status === 1) {
                        var studentsData = response.studentsData;
                        var selectedClass = response.class;
                        var selectedSubject = response.subject;
                
                        // Clear any existing rows in the table body
                        $("#studentMarksTableBody").empty();
                
                        // Set the selected class name in the modal
                        $("#selectedClassNameCaptureMarks").text(selectedClass);
                
                        $("#selectedSubjectCaptureMarks").text(selectedSubject);
                
                        // Iterate through the student data and populate the table
                        studentsData.forEach(function(student) {
                            var row = $("<tr>");
                
                            // Create a hidden cell for the student's ID
                            var idCell = $("<td>")
                                .addClass("hidden-id")
                                .css("display", "none")
                                .text(student.id); // Use the student's ID here
                
                            // Create cells for student name, components (you can add more cells as needed)
                            var nameCell = $("<td>").text(student.student_name + " " + student.surname);
                            var componentACell = $("<td>").attr("contenteditable", "true").text(student.componentA);
                            var componentBCell = $("<td>").attr("contenteditable", "true").text(student.componentB);
                            var componentCCell = $("<td>").attr("contenteditable", "true").text(student.componentC);
                            var componentDCell = $("<td>").attr("contenteditable", "true").text(student.componentD);
                            var componentECell = $("<td>").attr("contenteditable", "true").text(student.componentE);
                            var averageCell = $("<td>").attr("contenteditable", "true").text(student.average);
                
                            // Append cells to the row
                            row.append(idCell, nameCell, componentACell, componentBCell, componentCCell, componentDCell, componentECell,averageCell);
                
                            // Append the row to the table body
                            $("#studentMarksTableBody").append(row);
                        });
                
                        // Show the modal with populated data
                        $("#captureMarksModal").modal("show");
                    } else {
                        // Display a message indicating that no students are registered
                        alert("No students are registered in the selected class and subject.");
                    }
                },                
                error: function (xhr, status, error) {
                    // Handle errors here and display an error message
                    alert("Error: " + error);
                }
            });
        } else if (selectedClasses.length === 0 && selectedSubjects.length === 0) {
            // Neither class nor subject is selected, show an error message
            alert("Please select Class and Subject.");
        } else if (selectedClasses.length === 0) {
            // Only subject is selected, ask the user to select a class as well
            alert("Please select a Class.");
        } else if (selectedSubjects.length === 0) {
            // Only class is selected, ask the user to select a subject as well
            alert("Please select a Subject.");
        } else {
            // More than one class or subject is selected, show an error message
            alert("Please select only one Class and one Subject.");
        }
    });



    // Add a click event listener to the "Save Marks" button
    $("#saveMarksButton").click(function () {
        // Display a confirmation dialog
        var isConfirmed = confirm("Are you sure you want to save the changes?");

        // Check if the user confirmed
        if (isConfirmed) {
            // Create an array to store the captured data from table rows
            var capturedData = [];

            // Iterate through each table row in the tbody
            $("#studentMarksTableBody tr").each(function () {
                var row = $(this);
                var id = row.find(".hidden-id").text(); // Get the ID from the hidden column
                var componentA = row.find("td:nth-child(3)").text(); // Get Component A from the third column
                var componentB = row.find("td:nth-child(4)").text(); // Get Component B from the fourth column
                var componentC = row.find("td:nth-child(5)").text(); // Get Component C from the fifth column
                var componentD = row.find("td:nth-child(6)").text(); // Get Component D from the sixth column
                var componentE = row.find("td:nth-child(7)").text(); // Get Component E from the seventh column
                var average = row.find("td:nth-child(8)").text(); 

                var rowData = {
                    id: id,
                    componentA: componentA,
                    componentB: componentB,
                    componentC: componentC,
                    componentD: componentD,
                    componentE: componentE,
                    average: average
                };

                // Push the row data object to the capturedData array
                capturedData.push(rowData);
            });

            displayFlashMsg("Updating Marks", "fa fa-spinner faa-spin animated", '', '');
           
            // Send the captured data to the server for updating
            $.ajax({
                url: appRoot + "calas/updateStudentComponents", // Replace with the correct URL
                method: "POST",
                data: { capturedData: JSON.stringify(capturedData) }, // Send the captured data as JSON
                dataType: "json",
                success: function (response) {
                    // Handle the response from the server
                    if (response.status === 1) {
                    changeFlashMsgContent(response.message, "text-success", '', 1500);
                    $("#captureMarksModal").modal("hide");
                    
                    } else {
                    changeFlashMsgContent(response.error, "text-success", '', 1500);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle AJAX errors here
                    alert("AJAX Error: " + error);
                }
            });
        } else {
            // User canceled the operation, do nothing
            console.log("Changes not saved.");
        }
    });



    // Add a click event listener to the "Download PDF" button
    $("#downloadPDF").click(function () {
        generateFlyer();
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
        url: url ? url : appRoot + "calas/lslt/",
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

function generatePDF() {
    // Get the selected class name from the modal
    const selectedClassName = document.getElementById("selectedClassNameCaptureMarks").textContent;

    // Get the selected subject from the modal
    const selectedSubject = document.getElementById("selectedSubjectCaptureMarks").textContent;

    // Combine class and subject into one line
    const classAndSubject = `${selectedClassName}: ${selectedSubject}`;

    // Define the table content
    const tableContent = [];
    const tableHeaders = ['Student Name', 'Component A', 'Component B', 'Component C', 'Component D', 'Component E', 'Average'];

    // Get the table rows
    const rows = document.querySelectorAll("#studentMarksTableBody tr");

    // Loop through each row and extract data
    rows.forEach((row) => {
        const rowData = [];
        const columns = row.querySelectorAll("td");

        // Loop through each column in the row
        columns.forEach((column, index) => {
            // Skip the first hidden column (ID)
            if (index > 0) {
                rowData.push(column.textContent);
            }
        });

        tableContent.push(rowData);
    });

    // Define the PDF document definition
    const docDefinition = {
        content: [
            { text: 'Student Marks Table', style: 'header' },
            { text: classAndSubject, style: 'classAndSubjectHeader' }, // Combine class and subject in one line
            {
                table: {
                    headerRows: 1,
                    widths: ['*', '*', '*', '*', '*', '*', '*'],
                    body: [tableHeaders, ...tableContent]
                }
            }
        ],
        styles: {
            header: {
                fontSize: 18,
                bold: true,
                alignment: 'center'
            },
            classAndSubjectHeader: {
                fontSize: 16,
                bold: true,
                alignment: 'center',
                margin: [0, 10, 0, 10] // Add margin for spacing
            }
        }
    };

    // Generate the PDF
    pdfMake.createPdf(docDefinition).download('student_marks.pdf');
}



function generateFlyer() {
    // Define the fonts and colors
    const fonts = {
        Roboto: {
            normal: 'public/pdfmake/fonts/roboto/regular.ttf',
            bold: 'public/pdfmake/fonts/roboto/bold.ttf',
            italics: 'public/pdfmake/fonts/roboto/italic.ttf',
            bolditalics: 'public/pdfmake/fonts/roboto/bolditalic.ttf',
        },
    };

    const colors = {
        primary: '#007bff', // Blue
        secondary: '#28a745', // Green
        text: '#333', // Dark Gray
    };

    // Create the PDF document definition
    const documentDefinition = {
        content: [
            {
                text: '🚀 Ultimate Educational Management System 🚀',
                style: 'header',
            },
            {
                text: 'Highlights:',
                style: 'subheader',
            },
            {
                ul: [
                    { text: 'Simplified Enrollment: Effortlessly enroll students, no more paperwork.', listType: 'square' },
                    { text: 'Comprehensive Records: Maintain detailed student profiles and vital data.', listType: 'square' },
                    { text: 'Rapid Information Access: Instant access to crucial student information.', listType: 'square' },
                    { text: 'Streamlined Communication: Stay connected with students and families.', listType: 'square' },
                    { text: 'Administrative Efficiency: Save time and resources for student success.', listType: 'square' },
                    { text: 'Fee Payment Tracking: Precise monitoring of fee payments.', listType: 'square' },
                    { text: 'Sales Management: Effortless inventory and sales record management.', listType: 'square' },
                    { text: 'Monthly Finance Reports: Crystal-clear financial insights.', listType: 'square' },
                    { text: 'Global Currency Support: Flexibility with major Zimbabwean currencies.', listType: 'square' },
                    { text: 'Interactive Dashboard: Visualize data for informed decisions.', listType: 'square' },
                    { text: 'Ironclad Security: Robust user authentication and data protection.', listType: 'square' },
                    { text: 'Staff Management: Organize your team with ease.', listType: 'square' },
                    { text: 'Continuous Assessment: Elevate teaching with detailed student progress tracking.', listType: 'square' },
                ],
                margin: [0, 10, 0, 10], // Add margin around the bullet points
            },
            {
                text: 'Ready to transform your institution with these powerful features?',
                style: 'callout',
                margin: [0, 20, 0, 10], // Add margin to separate from highlights
            },
            {
                text: 'Contact us at [Your Contact Information] to get started! 🚀💰📊',
                style: 'contact',
            },
        ],
        background: [
            // Create a rectangle shape for the background color
            {
                canvas: [
                    {
                        type: 'rect',
                        x: 0,
                        y: 0,
                        w: 595.28, // Page width
                        h: 20, // Add a colored bar at the top of the page
                        color: colors.primary,
                    },
                ],
                absolutePosition: { x: 0, y: 0 },
            },
        ],
        styles: {
            header: {
                fontSize: 24,
                bold: true,
                color: 'white', // White text on the colored bar
                alignment: 'center',
            },
            subheader: {
                fontSize: 16,
                bold: true,
                margin: [0, 10, 0, 10],
                color: colors.secondary,
            },
            callout: {
                margin: [0, 20, 0, 10],
                color: colors.text,
            },
            contact: {
                margin: [0, 10, 0, 0],
                color: colors.primary,
                decoration: 'underline',
            },
        },
        defaultStyle: {
            font: 'Roboto',
            fontSize: 12,
            color: colors.text,
        },
    };

    // Generate the PDF
    pdfMake.createPdf(documentDefinition).download('educational_system_flyer.pdf');
}







function generateHelloWorldPDF() {
    try {
        // Define the content for the PDF
        var content = [
            {
                text: "Hello, World!", // Text to display
                fontSize: 24, // Font size
                bold: true, // Bold text
                alignment: "center" // Text alignment
            }
        ];

        // Create the PDF document
        var pdfDoc = {
            content: content
        };

        // Generate and open the PDF
        pdfMake.createPdf(pdfDoc).open();
    } catch (error) {
        console.error("Error generating PDF:", error.message);
    }
}

// Call the function to generate the "Hello, World!" PDF

