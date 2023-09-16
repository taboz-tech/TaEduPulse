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



    // Triggered when the payroll icon is clicked
    $("#createButtonPayroll").click(function (e) {
        e.preventDefault();
        var selectedStaffIds = [];
    
        // Iterate through checked checkboxes and collect staff IDs
        $(".employeeCheckbox:checked").each(function () {
            selectedStaffIds.push($(this).val());
        });
    
        // You can now use the selectedStaffIds array for further processing
        console.log("Selected Staff IDs: ", selectedStaffIds);
    
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

                 var staffName = batchData.map(function (data) { return data.staffName; });
                 console.log(staffName)
                // Include the currentMonth from batchData
                var ajaxData = batchData;
                console.log("ajaxData:", ajaxData); // Log the contents of ajaxData

    
                // Perform the AJAX request
                $.ajax({
                    type: "POST",
                    url: appRoot + "payrolls/np_",
                    data: ajaxData,
                    success: function (returnedData) {
                        if (returnedData.status === 1) {
                            // Handle success here
                            changeFlashMsgContent('Success: Payrolls created successfully!', 'green', 5000);
                        } else {
                            // Handle failure here
                            changeFlashMsgContent('Error: Payroll creation failed.', 'red', 5000);
                        }
                    },
                    error: function () {
                        // Handle AJAX error here
                        changeFlashMsgContent('Error: An error occurred while processing your request.', 'red', 5000);
                    }
                });
            } else {
                // Display an error message or take appropriate action
                var errorMessage = "Error: Some staff members have missing values.";
                console.error(errorMessage);
                // Update the error message in the modal or wherever you want to display it
                changeFlashMsgContent(errorMessage, 'red', 5000);
            }
        });
    });

    We can use a "for" loop to go through the "ajaxData" array and log each "staffName" value. The "for" loop will look like this:

for (let i = 0; i < ajaxData.length; i++) {
    console.log(ajaxData[i].staffName);
}

The "for" loop starts by setting the "i" variable to 0. Then, it checks if "i" is less than the length of the "ajaxData" array. If it is, the "for" loop runs.




$("#createButtonPayroll").click(function (e) {
    e.preventDefault();
    var selectedStaffIds = [];
    $(".employeeCheckbox:checked").each(function () {
        selectedStaffIds.push($(this).val());
    });
    sdrb(selectedStaffIds, function (batchData) {
        var hasMissingValues = false;
        batchData.forEach(function (staffData) {
            for (var key in staffData) {
                if (staffData.hasOwnProperty(key) && !staffData[key]) {
                    hasMissingValues = true;
                    break; // Exit the loop for this batch if any property is empty
                }
            }
        });
        if (!hasMissingValues) {
            var ajaxData = batchData;
            ajaxData.forEach(function (batchElement) {
                var staffName = batchElement.staffName;
                var staffSurname = batchElement.staffSurname;
                var staffDepartment = batchElement.staffDepartment;
                var staffStaff_id = batchElement.staffStaff_id;
                var staffNational_id = batchElement.staffNational_id;
                var staffJob_tittle = batchElement.staffJob_tittle;
                var staffSalary = batchElement.staffSalary;
                var staffIncome_tax = batchElement.staffIncome_tax;
                var staffOvertime = batchElement.staffOvertime;
                var staffHealthy_insurance = batchElement.staffHealthy_insurance;
                var currentMonth = batchElement.currentMonth;
    
                $.ajax({
                type: "POST",
                    url: appRoot + "payrolls/np_",
                    data: {
                        staffName: staffName,
                        staffSurname: staffSurname,
                        staffStaff_id: staffStaff_id,
                        staffDepartment: staffDepartment,
                        staffNational_id: staffNational_id,
                        staffJob_tittle: staffJob_tittle,
                        staffSalary: staffSalary,
                        staffIncome_tax: staffIncome_tax,
                        staffOvertime: staffOvertime,
                        staffHealthy_insurance: staffHealthy_insurance,
                        currentMonth: currentMonth
                    },
                    success: function (returnedData) {
                        if (returnedData.status === 1) {
                            console.log(returnedData)
                        } else {
                        }
                    },
                    error: function () {
                    }
                });
            });
        } else {
            var errorMessage = "Error: Some staff members have missing values.";
            console.error(errorMessage);
            $("#modalErrorMessage").text(errorMessage);
        }
    });
});