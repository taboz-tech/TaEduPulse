'use strict';

var barCodeTextTimeOut;
var cumTotalWithoutVATAndDiscount = 0;

$(document).ready(function(){
    $("#selStudentDefault").select2();
    
    
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all transactions on page load
    latr_();
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //when text/btn ("Add Student") to clone the div to add a student is clicked
    $("#clickToClone").on('click', function(e){
        e.preventDefault();
        
        var cloned = $("#divToClone").clone();
        
        //remove the id 'divToClone' from the cloned div
        cloned.addClass('transStudentList').removeClass('hidden').attr('id', '');
        
        //reset the form values (in the cloned div) to default
        cloned.find(".selectedStudentDefault").addClass("selectedStudent").val("");
        cloned.find(".studentTransAmount").html("0");
        cloned.find(".studentTotalFees").val("0");
        cloned.find(".studentCurrentFees").html("0.00");
        
        //loop through the currentStudents variable to add the students to the select input
		return new Promise((resolve, reject)=>{
			//if a student has been selected (i.e. added to the current transaction), do not add it to the list. This way, a student will appear just once.
			//We start by forming an array of all selected students, then skip that student in the loop appending students to select dropdown
			var selectedStudentsArr = [];
			
			return new Promise((res, rej)=>{
				$(".selectedStudent").each(function(){
					//push the selected value (which is the student_id [a key in currentStudents object]) to the array
					$(this).val() ? selectedStudentsArr.push($(this).val()) : "";
				});
				
				res();
			}).then(()=>{
				for(let key in currentStudents){
					//if the current key in the loop is in our 'selectedStudentsArr' array
					if(!inArray(key, selectedStudentsArr)){
						//if the student has not been selected, append it to the select list
						cloned.find(".selectedStudentDefault").append("<option value='"+key+"'>"+currentStudents[key]+"</option>");
					}
				}
			
				//prepend 'select student' to the select option
				cloned.find(".selectedStudentDefault").prepend("<option value='' selected>Select Student</option>");
				
				resolve(selectedStudentsArr);
			});
		}).then((selectedStudentsArray)=>{
			//If the input is from the barcode scanner, we need to check if the student has already been added to the list and just increment the qty instead of 
			//re-adding it to the list, thus duplicating the student
			if($("#barcodeText").val()){
				//This means our clickToClone btn was triggered after a student was scanned by the barcode scanner
				//Check the gotten selected students array if the student scanned has already been selected
				if(inArray($("#barcodeText").val().trim(), selectedStudentsArray)){
					//increment it
					$(".selectedStudent").each(function(){
						if($(this).val() === $("#barcodeText").val()){
							var newVal = parseInt($(this).closest('div').siblings('.studentTransAmountDiv').find('.studentTransAmount').val()) + 1;
			
							$(this).closest('div').siblings('.studentTransAmountDiv').find('.studentTransAmount').val(newVal);
							
							//unset value in barcode input
							$("#barcodeText").val('');
							
							return false;
						}
					});
				}
				
				else{
					//if it has not been selected previously, append it to the list and set it as the selected student
					//then append our cloned div to div with id 'appendClonedDivHere'
					cloned.appendTo("#appendClonedDivHere");
					
					//add select2 to the 'select input'
					cloned.find('.selectedStudentDefault').select2();
					
					//set it as the selected student
					changeSelectedStudentWithBarcodeText($("#barcodeText"), $("#barcodeText").val());
				}
			}
			
			else{//i.e. clickToClone clicked manually by user
				//do not append if no students is selected in the last select list
				if($(".selectedStudent").length > 0 && (!$(".selectedStudent").last().val())){
					//do nothing
				}
				
				else{
					//then append our cloned div to div with id 'appendClonedDivHere'
					cloned.appendTo("#appendClonedDivHere");
					
					//add select2 to the 'select input'
					cloned.find('.selectedStudentDefault').select2();
				}
			}
		}).catch(()=>{
			console.log('outer promise err');
		});
        
        return false;
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //WHEN USER CLICKS BTN TO REMOVE AN STUDENT FROM THE TRANSACTION LIST
    $("#appendClonedDivHere").on('click', '.retrit', function(e){
        e.preventDefault();
        
        $(this).closest(".transStudentList").remove();
        
        cespacp();//recalculate price
        calchadue();//also recalculate change due
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $("#currency").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //reload transactions table when events occur
    $("#transListPerPage, #transListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        latr_();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // remove phone error when keys are clicked 
    $("#custPhone").keyup(function(){

        changeInnerHTML(["custPhoneErr"], "");      
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    $("#transSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/transsearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#transListTable").html(returnedData.transTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            latr_();
        }
    });

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
    
    //enable/disable amount tendered input field based on the selected mode of payment
    $("#modeOfPayment").change(function(){
        var modeOfPayment = $(this).val();
        
        //remove any error message we might have
        $("#amountTenderedErr").html("");
        
        //unset the values of cashAmount and posAmount
        $("#cashAmount, #posAmount").val("");
        
        if(modeOfPayment === "POS"){
            /**
             * Change the Label
             * set the "cumulative amount" value field as the value of "amount tendered" and make the amountTendered field disabled
             * change "changeDue" to 0.00
             * hide "cash" an "pos" fields
             * 
             */
            $("#amountTenderedLabel").html("Amount Tendered");
            $("#amountTendered").val($("#cumAmount").html()).prop('disabled', true);
            $("#changeDue").html('0.00');
            $(".cashAndPos").addClass('hidden');
        }
        
        else if(modeOfPayment === "Cash and POS"){
            /*
             * Change the label
             * make empty "amount tendered" field's value and also make it writable
             * unset any value that might be in "changeDue"
             * display "cash" an "pos" fields
             */
            $("#amountTenderedLabel").html("Total");
            $("#amountTendered").val('').prop('disabled', true);
            $("#changeDue").html('');
            $(".cashAndPos").removeClass('hidden');
        }
        
        else{//if cash. If something not recognise, we assume it is cash
            /*
             * change the label
             * empty and make amountTendered field writable
             * unset any value that might be in "changeDue"
             * hide "cash" an "pos" fields
             */
            $("#amountTenderedLabel").html("Amount Tendered");
            $("#amountTendered").val('').prop('disabled', false);
            $("#changeDue").html('');
            $(".cashAndPos").addClass('hidden');
        } 
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //calculate the change due based on the amount tendered. Also ensure amount tendered is not less than the cumulative amount 
    $("#amountTendered").on('change focusout keyup keydown keypress', calchadue);
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /*
     * unset mode of payment each time ".studentTransAmount" changes
     * This will allow the user to be able to reselect the mode of payment, 
     * thus enabling us to recalculate change due based on amount tendered
     */
    $("#appendClonedDivHere").on("change", ".studentTransAmount", function(e){
        e.preventDefault();
		
		return new Promise((resolve, reject)=>{
			$("#modeOfPayment").val("");
			
			resolve();
		}).then(()=>{
			cespacp();
		}).catch();
	    
		//recalculate
	    cespacp();
        
        $("#modeOfPayment").val("");
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * If mode of payment is "Cash and POS", both #cashAmount and #posAmount fields will be visible to user to add values
     * The addition of both will be set as the amount tendered
     */
    $("#cashAmount, #posAmount").on("change", function(e){
        e.preventDefault();
        
        var totalAmountTendered = parseFloat($("#posAmount").val()) + parseFloat($("#cashAmount").val());
        
        //set amount tendered as the value of "totalAmountTendered" and then trigger the change event on it
        $("#amountTendered").val(isNaN(totalAmountTendered) ? "" : totalAmountTendered).change();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
  

    // Function to validate the phone number
    function validatePhoneNumber() {
        const phoneNumber = phoneInput.value.trim();
    
        // Check if the phone number starts with "07" or "+263"
        if (phoneNumber.startsWith("07") || phoneNumber.startsWith("+263")) {
        // Clear the error message
        custPhoneError.textContent = "";
        }
    }
     
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////BY TABOZ ////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // DATE@ 25 JUN 2023 TIME@ 13:37 
    // Tavonga Mafura
    // Get a reference to the input field and error message
    var custPhoneInput = document.getElementById("custPhone");
    var custPhoneErr = document.getElementById("custPhoneErr");

    // Add an event listener for the 'input' event
    custPhoneInput.addEventListener("input", function() {
    // Get the entered value
    var enteredValue = custPhoneInput.value.trim();
    
    // Check if the entered value starts with '07' or '+263'
    if (enteredValue.startsWith("07") || enteredValue.startsWith("+263")) {
        // If it matches, set the error message to an empty string
        custPhoneErr.textContent = "";
    }
    });

    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of a new sales order
    $("#confirmSaleOrder").click(function(){

        //ensure all fields are properly filled
        var amountTendered = parseFloat($("#amountTendered").val());
        var changeDue = $("#changeDue").html();
        var modeOfPayment = $("#modeOfPayment").val();
        var cumAmount = parseFloat($("#cumAmount").html());
        var arrToSend = [];
        var description = $("#description").val();
        var custName = $("#custName").val();
        var custPhone = $("#custPhone").val();
        var custEmail = $("#custEmail").val();
        
        // Add validation for custPhone
        var phonePattern = /^(07\d{8})$|^(\+263\d{9,14})$/;
    
        if (isNaN(amountTendered) || (amountTendered === '0.00') || !modeOfPayment || (amountTendered < cumAmount) || !phonePattern.test(custPhone)) {
            isNaN(amountTendered) || (amountTendered === '0.00') ? $("#amountTenderedErr").html("required") : $("#amountTenderedErr").html("");
            !modeOfPayment ? $("#modeOfPaymentErr").html("Select mode of payment") : $("#modeOfPaymentErr").html("");
            amountTendered < cumAmount ? $("#amountTenderedErr").html("Amount cannot be less than "+cumAmount) : "";
            !phonePattern.test(custPhone) ? $("#custPhoneErr").html("Invalid phone number") : $("#custPhoneErr").html("");
            return;
        } else {
            //remove error messages if any
            changeInnerHTML(["amountTenderedErr", "modeOfPaymentErr", "custPhoneErr"], "");
            
            //now get details of all students to be transacted (studentStudent_id, owedFees, currentFees, transAmount)
            var selectedStudentNode = document.getElementsByClassName("selectedStudent");
            var selectedStudentNodeLength = selectedStudentNode.length;
            var verifyCumAmount = 0;
    
            for (var i = 0; i < selectedStudentNodeLength; i++) {
                var studentStudent_id = selectedStudentNode[i].value;
                var owedFeesNode = selectedStudentNode[i].parentNode.parentNode.children[1].children[1];
                var currentFeesNode = selectedStudentNode[i].parentNode.parentNode.children[3].children[1];
                var transAmountNode = selectedStudentNode[i].parentNode.parentNode.children[2].children[1];
                var totalFeesNode = selectedStudentNode[i].parentNode.parentNode.children[4].children[1];
                var termNode  = selectedStudentNode[i].parentNode.parentNode.children[5].children[1];
              
                
                //get values
                var owedFees = parseFloat(owedFeesNode.innerHTML);
                var currentFees = parseFloat(currentFeesNode.innerHTML);
                var transAmount = parseFloat(transAmountNode.value);
                var totalFees = parseFloat(totalFeesNode.innerHTML);
                var term = termNode.value;
                var expectedTotFees = transAmount;

                // console.log("Owed Fees:", owedFees);
                // console.log("Current Fees:", currentFees);
                // console.log("Transaction Amount:", transAmount);
                // console.log("Total Fees:", totalFees);
                // console.log("term:" , term);
                // console.log("Expected Total Fees:", expectedTotFees);

                //validate data
                if ((transAmount === 0) || (owedFees < transAmount) || (expectedTotFees !== totalFees)) {
                    // console.log(expectedTotFees);
                    // console.log(transAmount)
                    // console.log(totalFees);
                    totalFeesNode.style.backgroundColor = expectedTotFees !== totalFees ? "red" : "";
                    transAmountNode.style.backgroundColor = (transAmount === 0) || (owedFees < transAmount) ? "red" : "";
                    return;
                } else {
                    //if all is well, remove all error bg color
                    totalFeesNode.style.backgroundColor = "";
                    transAmountNode.style.backgroundColor = "";
                    
                    //then prepare data to add to array of students' info
                    var studentInfo = {_sI:studentStudent_id, transAmount:transAmount, currentFees:currentFees, totalFees:totalFees,term:term};
                    
                    //add data to array
                    arrToSend.push(studentInfo);

                    //if all is well, add totalFees to calculate cumAmount
                    verifyCumAmount = (parseFloat(verifyCumAmount) + parseFloat(totalFees));
                }
            }
            
            // Compare verifyCumAmount with cumAmount
            if (verifyCumAmount !== cumAmount) {
                $("#cumAmount").css('backgroundColor', 'red');
                return;
            } else {
                $("#cumAmount").css('backgroundColor', '');
                
                //aoi = "All orders info"
                var _aoi = JSON.stringify(arrToSend);
    
                displayFlashMsg("Processing transaction...", spinnerClass, "", "");
                
                //send details to server
                $.ajax({
                    url: appRoot+"transactions/nso_",
                    method: "post",
                    data: {_aoi:_aoi, _mop:modeOfPayment, _at:amountTendered, _cd:changeDue, _ca:cumAmount, cn:custName, ce:custEmail, cp:custPhone, description:description},
                    success:function(returnedData){
                        if(returnedData.status === 1){
                            hideFlashMsg();

                            //reset the form
                            resetSalesTransForm();

                            //display receipt
                            $("#transReceipt").html(returnedData.transReceipt);
                            $("#transReceiptModal").modal('show');

                            //refresh the transaction list table
                            latr_();

                            //update total earned today
                            $("#totalEarnedToday").html(returnedData.totalEarnedToday);

                            //remove all students list in transaction and leave just one
                            resetTransList();
                        } else {
                            changeFlashMsgContent(returnedData.msg, "", "red", "");
                        }
                    },
                    error: function(){
                        checkBrowserOnline(true);
                    }
                });
            }
        }
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the submission of a new sales transaction
    $("#cancelSaleOrder").click(function(e){
        e.preventDefault();
        
        resetSalesTransForm();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //WHEN THE "USE SCANNER" BTN IS CLICKED
    $("#useScanner").click(function(e){
        e.preventDefault();
        
        //focus on the barcode text input
        $("#barcodeText").focus();
    });
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //WHEN THE BARCODE TEXT INPUT VALUE CHANGED
    $("#barcodeText").keyup(function(e){
        e.preventDefault();
        
        clearTimeout(barCodeTextTimeOut);

        var bText = $(this).val();
        var allStudents = [];

        barCodeTextTimeOut = setTimeout(function(){
            if(bText){
                for(let i in currentStudents){
                    if(bText === i){
                        //remove any message that might have been previously displayed
                        $("#studentStudent_idNotFoundMsg").html("");
    
                        //if no select input has been added or the last select input has a value (i.e. a student has been selected)
                        if(!$(".selectedStudent").length || $(".selectedStudent").last().val()){
                            //add a new student by triggering the clickToClone btn. This will handle everything from 'appending a list of students' to 'auto-selecting
                            //the corresponding student to the value detected by the scanner'
                            $("#clickToClone").click();                   
                        }
    
                        //else if the last select input doesn't have a value
                        else{
                            //just change the selected student to the corresponding student_id in var bText
                            changeSelectedStudentWithBarcodeText($(this), bText);
                        }
                        
                        break;
                    }
                    
                    //if the value doesn't match the code of any student
                    else{
                        //display message telling user student not found
                        $("#studentStudent_idNotFoundMsg").css('color', 'red').html("Student not found. Student may not be registered.");
                    }
                }
            }
        }, 1500);
    });
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //TO SHOW/HIDE THE TRANSACTION FORM
    $("#showTransForm").click(function(){
        $("#newTransDiv").toggleClass('collapse');
        
        if($("#newTransDiv").hasClass('collapse')){
            $(this).html("<i class='fa fa-plus'></i> New Transaction");
        }
        
        else{
            $(this).html("<i class='fa fa-minus'></i> New Transaction");
            
            //remove error messages
            $("#studentCodeNotFoundMsg").html("");
        }
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //TO HIDE THE TRANSACTION FORM FROM THE TRANSACTION FORM
    $("#hideTransForm").click(function(){
        $("#newTransDiv").toggleClass('collapse');
        
        //remove error messages
        $("#studentStudent_idNotFoundMsg").html("");
        
        //change main "new transaction" button back to default
        $("#showTransForm").html("<i class='fa fa-plus'></i> New Transaction");
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //PREVENT AUTO-SUBMISSION BY THE BARCODE SCANNER (this shouldn't matter but just to be on the safe side)
    $("#barcodeText").keypress(function(e){
        if(e.which === 13){
            e.preventDefault();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //INITIALISE datepicker on the "From date" and "To date" fields
    $('#datePair .date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        assumeNearbyYear: true,
        todayBtn: 'linked',
        todayHighlight: true,
        endDate: 'today'
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //INITIALISE datepair on the "From date" and "To date" fields
    $("#datePair").datepair();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //WHEN "GENERATE REPORT" BUTTON IS CLICKED FROM THE MODAL
    $("#clickToGen").click(function(e){
        e.preventDefault();
        
        var fromDate = $("#transFrom").val();
        var toDate = $("#transTo").val();
        
        if(!fromDate){
            $("#transFromErr").html("Select date to start from");
            
            return;
        }
        
        /*
         * remove any error msg, hide modal, launch window to display the report in
         */
        
        $("#transFromErr").html("");
        $("#reportModal").modal('hide');

        var strWindowFeatures = "width=1000,height=500,scrollbars=yes,resizable=yes";

        window.open(appRoot+"transactions/report/"+fromDate+"/"+toDate, 'Print', strWindowFeatures);
    });
});


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

/**
 * gti_ = "Get Transaction Info"
 * @param {type} transId
 * @returns {Boolean}
 */
function gti_(transId){
    if(transId){
        $("#transReceipt").html("<i class='fa fa-spinner faa-spin animated'></i> Loading...");
        
        //make server request to get information about transaction
        $.ajax({
            type: "POST",
            url: appRoot+"transactions/transactionReceipt",
            data: {transId:transId},
            success: function(returnedData){
                if(returnedData.status === 1){
                    $("#transReceipt").html(returnedData.transReceipt);
                }
                
                else{
                    
                }
            },
            error: function(){
                alert("ERROR!");
            }
        });
    }
    
    return false;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//to update transaction
function uptr_(transId){
    //alert(transId);
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * cespacp = "Calculate each student's price and cumulative price"
 * This calculates the total price of each student selected for sale and also their cumulative amount
 * @returns {undefined}
 */
function cespacp() {
    var cumulativePrice = 0;
    
    // Loop through the students selected to calculate the total of each student
    $(".transStudentList").each(function() {
        // Current student's owed fees
        var owedFees = parseFloat($(this).find(".studentOwedFees").html());
        
        // Current student's fees to be paid
        var transAmount = parseInt($(this).find(".studentTransAmount").val());
        
        // If the fees to be paid is greater than the owed fees
        if (transAmount > owedFees) {
            // Display message telling user the fees owed 
            $(this).find(".studentTransAmountErr").html("only " + owedFees + " left");

            // Set the value back to the owed fees
            $(this).find(".studentTransAmount").val(owedFees);
            
            cumulativePrice += owedFees;
            // Display the cumulative amount
            $("#cumAmount").html(cumulativePrice);

            cespacp(); // Call itself in order to recalculate price
        } else {
            // If all is well, remove error message if any
            $(this).find(".studentTransAmountErr").html("");
            
            // Calculate the total fees of current student
            var studentTotalFees = parseFloat($(this).find(".studentTransAmount").val());

            // Round to two decimal places
            studentTotalFees = +(studentTotalFees).toFixed(2);

            // Display the total fees
            $(this).find(".studentTotalFees").html(studentTotalFees);

            // Add current student's total fees to the cumulative amount
            cumulativePrice += studentTotalFees;
        }

        // Trigger the click event of "use barcode" btn to focus on the barcode input text
        $("#useScanner").click();
    });
    // Display the cumulative amount
    $("#cumAmount").html(cumulativePrice);
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Populates the student Owed Fees and Current Fees of selected Student to be sold
 * Auto set the Amount to pay to current fees 
 * @param {type} selectedNode
 * @returns {undefined}
 */
function selectedStudent(selectedNode){
    if(selectedNode){
        
        //get the elements of the selected student's owed fees and current fees 
        var studentOwedFeesElem = selectedNode.parentNode.parentNode.children[1].children[1];
        var studentCurrentFeesElem = selectedNode.parentNode.parentNode.children[3].children[1];
        var studentTransAmountElem = selectedNode.parentNode.parentNode.children[2].children[1];
        var studentTermElem = selectedNode.parentNode.parentNode.children[5].children[1];
        
        var studentStudent_id = selectedNode.value;
        
        //displayFlashMsg("Getting student info...", spinnerClass, "", "");
        
        //get student's available owed fees  and current fees 
        $.ajax({
            url: appRoot+"students/getCurrentAndOwedFees",
            type: "get",
            data: {_iC:studentStudent_id},
            success: function(returnedData){
                
                if(returnedData.status === 1){
                    studentOwedFeesElem.innerHTML = returnedData.studentOwed_fees;
                    studentCurrentFeesElem.innerHTML = parseFloat(returnedData.studentFees).toFixed(2);
                    studentTermElem.value = returnedData.term
                    
                    studentTransAmountElem.value = returnedData.studentOwed_fees;
                    
                    cespacp();//recalculate since student has been changed/added
                    calchadue();//update change due as well in case amount tendered is not empty
					
                    //hideFlashMsg();
                    
                    //return focus to the hidden barcode input
                    $("#useScanner").click();
                }
                
                else{
                    studentOwedFeesElem.innerHTML = "0.00";
                    studentCurrentFeesElem.innerHTML = "0.00";
                    
                    cespacp();//recalculate since student has been changed/added
                    calchadue();//update change due as well in case amount tendered is not empty
					
                    //changeFlashMsgContent("Student not found", "", "red", "");
                }
            }
        });
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/**
 * calchadue = "Calculate change due"
 * @returns {undefined}
 */
function calchadue(){
    var cumAmount = parseFloat($("#cumAmount").html());
    var amountTendered = parseFloat($("#amountTendered").val());

    if(amountTendered && (amountTendered < cumAmount)){
        $("#amountTenderedErr").html("Amount cannot be less than $;"+ cumAmount);

        //remove change due if any
        $("#changeDue").html("");
    }

    else if(amountTendered){
        $("#changeDue").html(+(amountTendered - cumAmount).toFixed(2));
        
        //remove error msg if any
        $("#amountTenderedErr").html("");
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function resetSalesTransForm(){
    document.getElementById('salesTransForm').reset();
        
    $(".studentCurrentFees, .studentTotalFees, #cumAmount, #changeDue").html("0.00");
    $(".studentOwedFees").html("0.00");
    $("#amountTendered").prop('disabled', false);
    
    //remove error messages
    $("#studentStudent_idNotFoundMsg").html("");
	
	//remove all appended lists
	$("#appendClonedDivHere").html("");
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * ctr_ = "Close Transaction receipt". This is for the receipt being displayed immediately the sales order is done
 * @deprecated v1.0.0
 * @returns {undefined}
 */
function ctr_(){
    //hide receipt and display form
    $("#salesTransFormDiv").removeClass("hidden");
    $("#showTransReceipt").addClass("hidden").html("");
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function resetTransList(){
    var tot = $(".transStudentList").length;
    
    $(".transStudentList").each(function(){
        if($(".transStudentList").length > 1){
            $(this).remove();
        }
        
        else{
            return "";
        }
    });
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/**
 * latr_ = "Load all transactions"
 * @param {type} url
 * @returns {Boolean}
 */
function latr_(url){
    var orderBy = $("#transListSortBy").val().split("-")[0];
    var orderFormat = $("#transListSortBy").val().split("-")[1];
    var limit = $("#transListPerPage").val();
    
    $.ajax({
        type:'get',
        url: url ? url : appRoot+"transactions/latr_/",
        data: {orderBy:orderBy, orderFormat:orderFormat, limit:limit},
        
        success: function(returnedData){
            hideFlashMsg();
			
            $("#transListTable").html(returnedData.transTable);
        },
        
        error: function(){
            
        }
    });
    
    return false;
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function changeSelectedStudentWithBarcodeText(barcodeTextElem, selectedStudent){
    $(".selectedStudent").last().val(selectedStudent).change();
            
    //then remove the value from the input
    $(barcodeTextElem).val("");
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


