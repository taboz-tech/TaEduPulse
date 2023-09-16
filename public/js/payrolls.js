'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Staff once the page is ready
    lplt();
    
    // Initialize Select2 on the select element
    $('#staffSelect').select2({
        matcher: function (params, data) {
            // Custom search function
            if ($.trim(params.term) === '') {
                return data;
            }

            // Split the search term into words
            var terms = params.term.split(' ');

            // Check if any of the terms match the display or search value
            for (var i = 0; i < terms.length; i++) {
                var term = terms[i].toUpperCase();
                var searchText = data.element.getAttribute('data-search');

                if (searchText && (data.text.toUpperCase().indexOf(term) > -1 || searchText.toUpperCase().indexOf(term) > -1)) {
                    return data;
                }
            }

            return null;
        }
    });
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new Payslip
     */
    $("#createPayslip").click(function() {
        $("#payslipsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewPayslipDiv").toggleClass('hidden');
        $("#staffOvertime").focus();
    });
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      


    $(".cancelAddPayslip").click(function(){
        //reset and hide the form
        document.getElementById("addNewPayslipForm").reset();//reset the form
        $("#createNewPayslipDiv").addClass('hidden');//hide the form
        $("#payslipsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
   
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Payslip
    $("#addNewPayslip").click(function(e){
        e.preventDefault();
       
        changeInnerHTML(['staffNameErr', 'staffSurnameErr','addCustErrMsg', 'staffStaff_idErr', 'staffDepartmentErr', 'staffNational_idErr', 'staffJob_tittleErr', 'staffSalaryErr', 'staffIncome_taxErr','staffOvertimeErr','staffHealthy_insuranceErr'], "");
        
        var staffName = $("#staffName").val();
        var staffSurname = $("#staffSurname").val();
        var staffStaff_id = $("#staffStaff_id").val();
        var staffDepartment = $("#staffDepartment").val();
        var staffNational_id = $("#staffNational_id").val();
        var staffJob_tittle = $("#staffJob_tittle").val();
        var staffSalary = $("#staffSalary").val();
        var staffIncome_tax = $("#staffIncome_tax").val();
        var staffOvertime = $("#staffOvertime").val();
        var staffHealthy_insurance = $("#staffHealthy_insurance").val();

        const currentDate = new Date();
        const options = { month: 'long' };
        const currentMonth = currentDate.toLocaleDateString('en-US', options);



        if(!staffName || !staffSurname || !staffIncome_tax || !staffOvertime || !staffHealthy_insurance || !staffNational_id || !staffStaff_id || !staffSalary){
            !staffName ? $("#staffNameErr").text("required") : "";
            !staffSurname ? $("#staffSurnameErr").text("required") : "";
            !staffIncome_tax ? $("#staffIncome_taxErr").text("required") : "";
            !staffOvertime ? $("#staffOvertimeErr").text("required") : "";
            !staffHealthy_insurance ? $("#staffHealthy_insuranceErr").text("required") : "";
            !staffNational_id ? $("#staffNational_idErr").text("required") : "";
            !staffStaff_id ? $("#staffStaff_idErr").text("required") : "";
            !staffSalary ? $("#staffSalaryErr").text("required") : "";
            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Creating Payslip for  '"+staffName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "POST",
            url: appRoot+"payrolls/np_",
            data:{
                staffName:staffName,
                staffSurname:staffSurname,
                staffStaff_id:staffStaff_id,
                staffDepartment:staffDepartment,
                staffNational_id:staffNational_id,
                staffJob_tittle:staffJob_tittle,
                staffSalary:staffSalary,
                staffIncome_tax:staffIncome_tax,
                staffOvertime:staffOvertime,
                staffHealthy_insurance:staffHealthy_insurance,
                currentMonth:currentMonth
                },
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewPayslipForm").reset();
                    clearSelectedEmployee();

                    //display receipt
                    $("#payrollPayslip").html(returnedData.payrollPayslip);
                    $("#payrollPayslipModal").modal('show');
                    
                    //refresh the Payslip list table
                    lplt();
                    
                    //return focus to Staff name input
                    $("#staffOvertime").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#staffNameErr").text(returnedData.staffName);
                    $("#staffSurnameErr").text(returnedData.staffSurname);
                    $("#staffDepartmentErr").text(returnedData.staffDepartment);
                    $("#staffNational_idErr").text(returnedData.staffNational_id);
                    $("#staffSalaryErr").text(returnedData.staffSalary);

                    

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
    
    //reload staff list table when events occur
    $("#payslipsListPerPage, #payslipsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lplt();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //reload staff list table when events occur
    $("#staffSelect").change(function(){
        var staffStaff_id = $("#staffSelect").val()
        sdr(staffStaff_id);
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#payslipSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/payslipsearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#payslipsListTable").html(returnedData.payslipsListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lplt();
        }
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    

    // Triggered when the payroll icon is clicked
    $("#payslipsListTable").on('click', ".payroll", function(e){
        e.preventDefault();

        var payrollId = $(this).attr('id').split('-')[1];
        var statusText = $(this).closest('tr').find('.text-center').eq(0).text().trim(); // Extract the status text

        if (statusText === 'Paid') {
            alert("This payslip is already paid.");
        } else {
            var confirm = window.confirm("Are you sure you want to Pay? This cannot be undone.");
            if (confirm) {
                displayFlashMsg('Please wait...', spinnerClass, 'black');

                $.ajax({
                    url: appRoot + "payrolls/payPayroll",
                    method: "POST",
                    data: { i: payrollId }
                }).done(function(rd){
                    if (rd.status === 1) {
                        // Display success message
                        changeFlashMsgContent('Payslip Paid', '', 'green', 1000);

                        // Update the status text in the table to 'Paid'
                        $(this).closest('tr').find('.text-center').eq(0).text('Paid').removeClass('text-danger').addClass('text-success');
                    } else {
                        // Handle the case where the payment was not successful
                        alert(rd.error_message || "Payment failed. Please try again or contact support.");
                    }
                }.bind(this)).fail(function(){
                    console.log('Request Failed');
                    alert("An error occurred while processing the payment. Please try again or contact support.");
                });
            }
        }
    });

    //  Toggle the visibility of the employee list section
    $("#showEmployeeListModal").click(function () {
        $("#employeeListModal").modal("show");
    });

    // handle "Select All" functionality in the staff list modal
    $("#selectAllCheckbox").change(function () {
        $(".employeeCheckbox").prop("checked", $(this).prop("checked"));
    });

    // JavaScript for the "Create" button
    $("#createButtonPayroll").click(function (e) {
        e.preventDefault();
        var selectedStaffIds = [];
    
        // Iterate through checked checkboxes and collect staff IDs
        $(".employeeCheckbox:checked").each(function () {
            selectedStaffIds.push($(this).val());
        });
    
        displayFlashMsg("Creating Payslips for the selected Staff", "fa fa-spinner faa-spin animated", '', '');
        // Call the sdrb function with the selectedStaffIds array
        sdrb(selectedStaffIds, function (batchData) {
            // Define a flag to track if any batch has missing values
            var hasMissingValues = false;
    
            // Iterate through each batch
            batchData.forEach(function (staffData) {
                // Check if any property is empty in the staffData object
                for (var key in staffData) {
                    if (staffData.hasOwnProperty(key) && !staffData[key]) {
                        hasMissingValues = true;
                        break; // Exit the loop for this batch if any property is empty
                    }
                }
            });
    
            if (!hasMissingValues) {
                // Include the currentMonth from batchData
                var ajaxData = batchData;
                console.log("ajaxData:", ajaxData); // Log the contents of ajaxData
                for (let i = 0; i < ajaxData.length; i++) {
                    var staffName = ajaxData[i].staffName;
                    var staffSurname = ajaxData[i].staffSurname;
                    var staffDepartment = ajaxData[i].staffDepartment;
                    var staffStaff_id = ajaxData[i].staffStaff_id;
                    var staffNational_id = ajaxData[i].staffNational_id;
                    var staffJob_tittle = ajaxData[i].staffJob_tittle;
                    var staffSalary = ajaxData[i].staffSalary;
                    var staffIncome_tax = ajaxData[i].staffIncome_tax;
                    var staffOvertime = ajaxData[i].staffOvertime;
                    var staffHealthy_insurance = ajaxData[i].staffHealthy_insurance;
                    var currentMonth = ajaxData[i].currentMonth;
                    
                    // Perform the AJAX request
                    $.ajax({
                        type: "POST",
                        url: appRoot + "payrolls/np_",
                        data:{
                            staffName:staffName,
                            staffSurname:staffSurname,
                            staffStaff_id:staffStaff_id,
                            staffDepartment:staffDepartment,
                            staffNational_id:staffNational_id,
                            staffJob_tittle:staffJob_tittle,
                            staffSalary:staffSalary,
                            staffIncome_tax:staffIncome_tax,
                            staffOvertime:staffOvertime,
                            staffHealthy_insurance:staffHealthy_insurance,
                            currentMonth:currentMonth
                            },
                        success: function (returnedData) {
                            if (returnedData.status === 1) {
                                console.log(returnedData);
                                // Handle success here
                                changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                                
                                $("#employeeListModal").modal('hide');
                                //refresh the Payslip list table
                                lplt();

                            } else {
                                // Handle failure here
                                changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                            }
                        },
                        error: function () {
                            // Handle AJAX error here
                            changeFlashMsgContent('Error: An error occurred while processing your request.', 'red', 4000);
                        }
                    });
                }

            } else {
                // Display an error message or take appropriate action
                var errorMessage = "Error: Some staff members have missing values.";
                console.error(errorMessage);
                // Update the error message in the modal or wherever you want to display it
                changeFlashMsgContent(errorMessage, 'red', 5000);
            }
        });
    });  
    
    
    




});

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/**
 * "lplt" = "load Payslip List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lplt(url) {

    var orderBy = $("#payslipsListSortBy").val().split("-")[0];
    var orderFormat = $("#payslipsListSortBy").val().split("-")[1];
    var limit = $("#payslipsListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "payrolls/lapr_/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#payslipsListTable").html(returnedData.payslipsListTable);
        },

        error: function () {
        }
    });

    return false;
}

/**
 * "sdr" = "staff data retrival"
 * @param {type} url
 * @returns {undefined}
 */
function sdr(staffStaff_id){
    $.ajax({
        url: appRoot+"payrolls/gsi",
        method: "POST",
        data: {sId:staffStaff_id}
    }).done(function(rd){
        console.log(rd.income_tax);
        if(rd.status === 1){
            $("#staffStaff_id").val(rd.staff_id);
            $("#staffName").val(rd.name);
            $("#staffSurname").val(rd.surname);
            $("#staffNational_id").val(rd.national_id);
            $("#staffJob_tittle").val(rd.job_tittle);
            $("#staffSalary").val(rd.basic_salary);
            $("#staffIncome_tax").val(rd.income_tax);
            $("#staffOvertime").val(rd.overtime);
            $("#staffDepartment").val(rd.department);
            $("#staffHealthy_insurance").val(rd.healthy_insurance);

           
        }
    
        else{
    
        }
    }).fail(function(){
        console.log('Req Failed');
    });

}

function clearSelectedEmployee() {
    // Clear the selected option in the staffSelect dropdown
    $("#staffSelect").val("");

    // Clear the input fields related to the selected employee
    $("#staffStaff_id, #staffName, #staffSurname, #staffNational_id, #staffJob_tittle, #staffSalary, #staffIncome_tax, #staffOvertime, #staffHealthy_insurance, #staffDepartment").val("");

    // Clear any error messages
    $(".errMsg").text("");
}

/**
 * "sdrb" = "staff data retrieval batch"
 * @param {number[]} staffStaff_ids - An array of staff member IDs you want to retrieve data for.
 * @param {function} callback - A callback function to handle the retrieved data.
 */
function sdrb(staffStaff_ids, callback) {
    // Create an array to store the retrieved data
    var batchData = [];
    
    // Loop through the staff IDs and retrieve data for each
    staffStaff_ids.forEach(function (staffStaff_id) {
        $.ajax({
            url: appRoot + "payrolls/gsi",
            method: "POST",
            data: { sId: staffStaff_id }
        }).done(function (rd) {
            if (rd.status === 1) {
                // Create an array with the retrieved data for this staff member
                var staffData = {
                    staffStaff_id: rd.staff_id,
                    staffName: rd.name,
                    staffSurname: rd.surname,
                    staffNational_id: rd.national_id,
                    staffJob_tittle: rd.job_tittle,
                    staffSalary: rd.basic_salary,
                    staffIncome_tax: rd.income_tax,
                    staffOvertime: rd.overtime,
                    staffDepartment: rd.department,
                    staffHealthy_insurance: rd.healthy_insurance,
                    currentMonth: getCurrentMonth() // Add the current month
                };
                // Add the staffData to the batchData array
                batchData.push(staffData);
            } else {
                // Handle the case when the status is not 1 (e.g., show an error message)
                console.log("Staff data retrieval failed for ID: " + staffStaff_id);
            }
            
            // Check if all requests have completed
            if (batchData.length === staffStaff_ids.length) {
                // Invoke the callback with the batchData array
                callback(batchData);
            }
        }).fail(function () {
            // Handle AJAX request failure (e.g., show an error message)
            console.log('Request Failed for ID: ' + staffStaff_id);
            
            // Check if all requests have completed
            if (batchData.length === staffStaff_ids.length) {
                // Invoke the callback with the batchData array
                callback(batchData);
            }
        });
    });
}

// Function to get the current month
function getCurrentMonth() {
    const currentDate = new Date();
    const options = { month: 'long' };
    return currentDate.toLocaleDateString('en-US', options);
}
