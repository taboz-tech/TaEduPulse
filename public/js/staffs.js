'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Staff once the page is ready
    lslt();
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new Staff
     */
    $("#createStaff").click(function() {
        fetchLastStaffId()
        $("#staffsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewStaffDiv").toggleClass('hidden');
        $("#staffName").focus();
    });
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      


    $(".cancelAddStaff").click(function(){
        //reset and hide the form
        document.getElementById("addNewStaffForm").reset();//reset the form
        $("#createNewStaffDiv").addClass('hidden');//hide the form
        $("#staffsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
   
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of adding new Staff
    $("#addNewStaff").click(function(e){
        e.preventDefault();
       
        changeInnerHTML(['staffNameErr', 'staffSurnameErr','addCustErrMsg','staffGenderErr', 'staffStaff_idErr','staffPhoneErr', 'staffAddressErr', 'staffDepartmentErr', 'staffNational_idErr', 'staffEmailErr', 'staffDobErr', 'staffJob_tittleErr', 'staffSalaryErr'], "");
        
        var staffName = $("#staffName").val();
        var staffSurname = $("#staffSurname").val();
        var staffGender = $("#staffGender").val();
        var staffStaff_id = $("#staffStaff_id").val();
        var staffPhone = $("#staffPhone").val();
        var staffAddress = $("#staffAddress").val();
        var staffDepartment = $("#staffDepartment").val();
        var staffNational_id = $("#staffNational_id").val();
        var staffEmail = $("#staffEmail").val();
        var staffDob = $("#staffDob").val();
        var staffJob_tittle = $("#staffJob_tittle").val();
        var staffSalary = $("#staffSalary").val();

        // Add validation for studentParent_phone
        var phonePattern = /^(07\d{8})$|^(\+263\d{9,14})$/;

        // Calculate the date 5 years ago formatted as "YYYY-MM-DD"
        var today = new Date();
        var fiveYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

        var enteredDate = new Date(staffDob);
        if ( enteredDate < fiveYearsAgo) {
            $("#staffDobErr").text("Invalid date. Please enter a date exactly 5 years ago or earlier.");
            return; // Return early without processing further if there's an error
        }

        if (staffSalary === "" || parseFloat(staffSalary) === 0) {
            $("#staffSalaryErr").text("Staff Salary must be greater than zero.");
            return; 
        }


        
        if(!staffName || !staffSurname || !staffGender || !staffAddress || !staffEmail || !staffNational_id || !staffStaff_id || !staffSalary || !phonePattern.test(staffPhone) ){
            !staffName ? $("#staffNameErr").text("required") : "";
            !staffSurname ? $("#staffSurnameErr").text("required") : "";
            !staffGender ? $("#staffGenderErr").text("required") : "";
            !staffAddress ? $("#staffAddressErr").text("required") : "";
            !staffEmail ? $("#staffEmailErr").text("required") : "";
            !staffNational_id ? $("#staffNational_idErr").text("required") : "";
            !staffStaff_id ? $("#staffStaff_idErr").text("required") : "";
            !staffSalary ? $("#staffSalaryErr").text("required") : "";
            !phonePattern.test(staffPhone) ? $("#staffPhoneErr").html("Invalid phone number") : $("#staffPhoneErr").html("");

            
            
            $("#addCustErrMsg").text("One or more required fields are empty");
            
            return;
        }
        
        displayFlashMsg("Adding Staff '"+staffName+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"staffs/add",
            data:{staffName:staffName, staffSurname:staffSurname, staffGender:staffGender, 
                    staffStaff_id:staffStaff_id, staffPhone:staffPhone, staffAddress:staffAddress,
                    staffDepartment:staffDepartment, staffNational_id:staffNational_id,
                    staffEmail:staffEmail, staffDob:staffDob, staffJob_tittle:staffJob_tittle, staffSalary:staffSalary
                    },
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewStaffForm").reset();
                    
                    //refresh the Staffs list table
                    lslt();

                    // pick new staff Id
                    fetchLastStaffId()
                    
                    //return focus to Staff name input
                    $("#staffName").focus();
                }
                
                else{
                    hideFlashMsg();
                    
                    //display all errors
                    $("#staffNameErr").text(returnedData.staffName);
                    $("#staffSurnameErr").text(returnedData.staffSurname);
                    $("#staffGenderErr").text(returnedData.staffGender);
                    $("#staffEmailErr").text(returnedData.staffEmail);
                    $("#staffPhoneErr").text(returnedData.staffPhone);
                    $("#staffAddressErr").text(returnedData.staffAddress);
                    $("#staffDepartmentErr").text(returnedData.staffDepartment);
                    $("#staffNational_idErr").text(returnedData.staffNational_id);
                    $("#staffStaff_idErr").text(returnedData.staffStaff_id);
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
    $("#staffsListPerPage, #staffsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lslt();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#staffSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/staffsearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#staffsListTable").html(returnedData.staffsListTable);
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
    
    //triggers when a staff's "edit" icon is clicked
    $("#staffsListTable").on('click', ".editStaff", function(e){
        e.preventDefault();


        
        //get Staff info
        var staffId = $(this).attr('id').split("-")[1];
        var staffName = $("#staffName-" + staffId).html();
        var staffSurname = $("#staffSurname-" + staffId).html();
        var staffPhone = $("#staffPhone-" + staffId).html();
        var staffAddress = $("#staffAddress-" + staffId).html();
        var staffEmail = $("#staffEmail-" + staffId).html();
        var staffDepartment = $("#staffDepartment-" + staffId).html();
        var staffNational_id = $("#staffNational_id-" + staffId).html();
        var staffGender = $("#staffGender-" + staffId).html(); 
        var staffDob = $("#staffDob-" + staffId).html();
        var staffJob_tittle = $("#staffJob_tittle-" + staffId).html(); 
        var staffSalary = $("#staffSalary-" + staffId).html();   
        var staffAdvancePayment = $("#staffAdvancePayment-" + staffId).html();
        var staffOvertime = $("#staffOvertime-" + staffId).html();
        
        
        //prefill form with info
        $("#staffIdEdit").val(staffId);
        $("#staffNameEdit").val(staffName);
        $("#staffSurnameEdit").val(staffSurname);
        $("#staffAddressEdit").val(staffAddress);
        $("#staffPhoneEdit").val(staffPhone);
        $("#staffEmailEdit").val(staffEmail);
        $("#staffDepartmentEdit").val(staffDepartment);
        $("#staffNational_idEdit").val(staffNational_id);
        $("#staffGenderEdit").val(staffGender);
        $("#staffDobEdit").val(staffDob);
        $("#staffJob_tittleEdit").val(staffJob_tittle);
        $("#staffSalaryEdit").val(staffSalary);
        $("#staffAdvancePaymentEdit").val(staffAdvancePayment);
        $("#staffOvertimeEdit").val(staffOvertime);
        
        
        //remove all error messages that might exist
        $("#editStaffFMsg").html("");
        $("#staffIdEditErr").html("");
        $("#staffNameEditErr").html("");
        $("#staffSurnameEditErr").html("");
        $("#staffEmailEditErr").html("");
        $("#staffAddressEditErr").html("");
        $("#staffDepartmentEditErr").html("");
        $("#staffPhoneEditErr").html("");
        $("#staffNational_idEditErr").html("");
        $("#staffGenderEditErr").html("");
        $("#staffDobEditErr").html("");
        $("#staffJob_tittleEditErr").html("");
        $("#staffSalaryEditErr").html("");
        $("#staffAdvancePaymentEditErr").html("");
        $("#staffOvertimeEditErr").html("");
        
        
        //launch modal
        $("#editStaffModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editStaffSubmit").click(function () {

        var staffId = $("#staffIdEdit").val();
        var staffName = $("#staffNameEdit").val();
        var staffSurname = $("#staffSurnameEdit").val();
        var staffPhone = $("#staffPhoneEdit").val();
        var staffAddress = $("#staffAddressEdit").val();
        var staffEmail = $("#staffEmailEdit").val();
        var staffDepartment = $("#staffDepartmentEdit").val();
        var staffNational_id = $("#staffNational_idEdit").val();
        var staffGender = $("#staffGenderEdit").val();
        var staffDob =$("#staffDobEdit").val();
        var staffJob_tittle = $("#staffJob_tittleEdit").val();
        var staffSalary = $("#staffSalaryEdit").val();
        var staffAdvancePayment = $("#staffAdvancePaymentEdit").val();
        var staffOvertime = $("#staffOvertimeEdit").val();


    
        // Clear previous error messages
        $(".error-message").html("");
        if (staffSalary === "" || parseFloat(staffSalary) === 0) {
            $("#staffSalaryEditErr").text("Staff Salary must be greater than zero.");
            return; 
        }

        // Calculate the date 5 years ago formatted as "YYYY-MM-DD"
        var today = new Date();
        var fiveYearsAgo = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());

        var enteredDate = new Date(staffDob);
        if ( enteredDate < fiveYearsAgo) {
            $("#staffDobEditErr").text("Invalid date. Please enter a date exactly 5 years ago or earlier.");
            return; // Return early without processing further if there's an error
        }
        
                
        if (!staffSurname || !staffEmail || !staffId || !staffName || !staffNational_id || !staffJob_tittle || !staffSalary ||!staffOvertime || !staffAdvancePayment) {
            if (!staffSurname) $("#staffSurnameErr").html("Surname cannot be empty");
            if (!staffEmail) $("#staffEmailEditErr").html("Staff EmailstaffEmail cannot be empty");
            if (!staffId) $("#editStaffFMsg").html("Unknown Staff");
            if (!staffName) $("#staffNameEditErr").html("Staff name cannot be empty");
            if (!staffNational_id) $("#staffNational_idEditErr").html("Staff National Id cannot be empty");
            if (!staffJob_tittle) $("#staffJob_tittleEditErr").html("Staff Job Tittle cannot be empty");
            if (!staffSalary) $("#staffSalaryEditErr").html("Staff Salary cannot be empty");
            if (!staffAdvancePayment) $("#staffAdvancePaymentEditErr").html("Staff Advance payment can not be empty");
            if (!staffOvertime) $("#staffOvertimeEditErr").html("Staff overtime can not be empty");
            return;
        }

    
        $("#editStaffFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
    
        $.ajax({
            method: "POST",
            url: appRoot + "staffs/edit",
            data: {
                staffName: staffName,
                staffSurname: staffSurname,
                _sId: staffId,
                staffEmail: staffEmail,
                staffPhone: staffPhone,
                staffAddress: staffAddress,
                staffDepartment:staffDepartment,
                staffNational_id:staffNational_id,
                staffGender:staffGender,
                staffDob:staffDob,
                staffJob_tittle:staffJob_tittle,
                staffSalary:staffSalary,
                staffAdvancePayment:staffAdvancePayment,
                staffOvertime:staffOvertime
            }
        }).done(function (returnedData) {
            

            if (returnedData.status === 1) {
                $("#editStaffFMsg").css('color', 'green').html("Staff successfully updated");
    
                setTimeout(function () {
                    $("#editStaffModal").modal('hide');
                }, 1000);
    
                lslt();
            } else {
                $("#editStaffFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");
    
                
                if (returnedData.staffName) $("#staffNameEditErr").html(returnedData.staffName);
                if (returnedData.staffSurname) $("#staffSurnameEditErr").html(returnedData.staffSurname);
                if (returnedData.sId) $("#staffIdEditErr").html(returnedData._sId);
                if (returnedData.staffGender) $("#staffGenderEditErr").html(returnedData.staffGender);
                if (returnedData.staffPhone) $("#staffPhoneEditErr").html(returnedData.staffPhone);
                if (returnedData.staffAddress) $("#staffAddressEditErr").html(returnedData.staffAddress);
                if (returnedData.staffEmail) $("#staffEmailEditErr").html(returnedData.staffEmail);
                if (returnedData.staffDepartment) $("#staffDepartmentEditErr").html(returnedData.staffDepartment);
                if (returnedData.staffNational_id) $("#staffNational_idEditErr").html(returnedData.staffNational_id);
                if (returnedData.staffSalary) $("#staffSalaryEditErr").html(returnedData.staffSalary);

            }
        }).fail(function () {
            $("#editStaffFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    
    //TO DELETE Staff (The tStaff will be marked as "deleted" instead of removing it totally from the db)
    $("#staffsListTable").on('click', '.delStaff', function(e){
        e.preventDefault();
        
        //get the Staff id
        var staffId = $(this).parents('tr').find('.curStaffId').val();
        var staffRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(staffId){
            var confirm = window.confirm("Are you sure you want to delete Staff? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"Staffs/delete",
                    method: "POST",
                    data: {i:staffId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove Staff from list, update Staffs' SN, display success msg
                        $(staffRow).remove();

                        //update the SN
                        resetStaffSN();

                        //display success message
                        changeFlashMsgContent('Staff deleted', '', 'green', 1000);
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

    // Add a blur event listener for the National ID input
    $("#staffNational_id").on("blur", function () {
        var nationalID = $(this).val();
        var isValid = validateZimbabweanID(nationalID);

        if (isValid) {
            // Clear any previous error message
            $("#staffNational_idErr").text("");
        } else {
            // Display an error message
            $("#staffNational_idErr").text("Invalid National ID format");
        }
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //When the toggle on/off button is clicked to change the staff status  (i.e. suspend or lift suspension)
    $("#staffsListTable").on('click', '.staffStatus', function(){
        var ElemId = $(this).attr('id');
                
        var staffId = ElemId.split("-")[1];//get the staffId
        
        //show spinner
        $("#"+ElemId).html("<i class='"+spinnerClass+"'</i>");
        
        if(staffId){
            $.ajax({
                url: appRoot+"staffs/suspend",
                method: "POST",
                data: {_sId:staffId}
            }).done(function(returnedData){
                if(returnedData.status === 1){
                    //change the icon to "on" if it's "off" before the change and vice-versa
                    var newIconClass = returnedData._ns === 1 ? "fa fa-toggle-on pointer" : "fa fa-toggle-off pointer";
                    
                    //change the icon
                    $("#staffStatus-"+returnedData._sId).html("<i class='"+ newIconClass +"'></i>");
                    
                }
                
                else{
                    console.log('err');
                }
            });
        }
    });

    // Add an input event listener to the input field with the ID "studentParent_phone"
    $("#staffPhone").on('input', function(e){
        // Get the trimmed value entered by the user
        const enteredValue = $(this).val().trim();
        
        // Define the valid prefixes
        const validPrefixes = ["07", "+263"];
        
        // Check if the entered value starts with any valid prefix
        const isValid = validPrefixes.some(prefix => enteredValue.startsWith(prefix));

        // Get the error message element
        const custPhoneErr = $("#staffPhoneErr");

        // Update the error message based on validity
        if (isValid) {
            custPhoneErr.html("");
        } else {
            custPhoneErr.html("Invalid phone number");
        }
    });
});



/**
 * "lslt" = "load Staff List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lslt(url) {

    var orderBy = $("#staffsListSortBy").val().split("-")[0];
    var orderFormat = $("#staffsListSortBy").val().split("-")[1];
    var limit = $("#staffsListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "staffs/lslt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#staffsListTable").html(returnedData.staffsListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetStaffSN(){
    $(".staffSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}

function validateZimbabweanID(id) {
    // Define the regex pattern for Zimbabwean National ID
    var pattern = /^\d{2}\d{6}[A-Z]\d{2}$/;
    // Check if the input matches the pattern
    return pattern.test(id);
}


// function to create the staff id for the currrent month
function fetchLastStaffId() {
    $.ajax({
        type: 'GET',
        url: appRoot + "staffs/lastStaffIdForMonth",
        success: function (response) {
            if (response.status === 1) {
                // Set the new student ID to the input field
                $('#staffStaff_id').val(response.newStaffId);
                
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