'use strict';

$(document).ready(function(){
    checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status
	
    //load all Assets once the page is ready
    lalt();
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Toggle the form to add a new assets
     */
    $("#createAsset").click(function() {
        fetchLastAssetNumber()
        $("#assetsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewAssetDiv").toggleClass('hidden');
        $("#description").focus();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    
    $(".cancelAddAsset").click(function(){
        //reset and hide the form
        document.getElementById("addNewAssetForm").reset();//reset the form
        $("#createNewAssetDiv").addClass('hidden');//hide the form
        $("#assetsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Handles the submission of adding a new Assets
    $("#addNewAsset").click(function(e){
        e.preventDefault();
        
        changeInnerHTML(['descriptionErr', 'addCustErrMsg','assetNumberErr', 'serialNumberErr','locationErr', 'costErr', 'depreciationRateErr', 'ownerErr'], "");
        
        const fields = ["assetNumber", "description", "serialNumber", "location", "cost", "depreciationMethod", "depreciationRate", "owner"];
        let isError = false;

        fields.forEach(field => {
            const value = $(`#${field}`).val();
            if (!value) {
                $(`#${field}Err`).text("Required");
                isError = true;
            }
        });

        if (isError) {
            $("#addCustErrMsg").text("One or more required fields are empty");
            return false; // Prevent form submission
        }
        // Get values from form fields
        var assetNumber = $("#assetNumber").val();
        var description = $("#description").val();
        var serialNumber = $("#serialNumber").val();
        var location = $("#location").val();
        var cost = $("#cost").val();
        var depreciationMethod = $("#depreciationMethod").val();
        var depreciationRate = $("#depreciationRate").val();
        var owner = $("#owner").val();
        var supplier = $("#supplier").val();

        displayFlashMsg("Adding Asset '"+description+"'", "fa fa-spinner faa-spin animated", '', '');
        
        $.ajax({
            type: "post",
            url: appRoot+"assets/add",
            data: { assetNumber:assetNumber,description:description,
                 serialNumber:serialNumber, location:location, cost:cost, 
                 depreciationMethod:depreciationMethod, supplier:supplier,
                 depreciationRate:depreciationRate, owner:owner, },
            
            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewAssetForm").reset();
                    
                    // Refresh the asset list table
                    lalt();
                    fetchLastAssetNumber()
                    
                    // Return focus to description input 
                    $("#description").focus();
                } else {
                    hideFlashMsg();
                    
                    // Display errors for individual fields
                    $("#assetNumberErr").text(returnedData.asset_number);
                    $("#descriptionErr").text(returnedData.description);
                    $("#serialNumberErr").text(returnedData.serial_number);
                    $("#locationErr").text(returnedData.location);
                    $("#supplierErr").text(returnedData.supplier);
                    $("#costErr").text(returnedData.cost);
                    $("#depreciationMethodErr").text(returnedData.depreciation_method);
                    $("#depreciationRateErr").text(returnedData.depreciation_rate);
                    $("#ownerErr").text(returnedData.owner);
                    $("#supplierErr").text(returnedData.supplier);
                    

                    $("#addCustErrMsg").text(returnedData.msg);
                }
            },

            error: function(){
                if(!navigator.onLine){
                    changeFlashMsgContent("You appear to be offline. Please reconnect to the internet and try again", "", "red", "");
                } else {
                    changeFlashMsgContent("Unable to process your request at this time. Please try again later!", "", "red", "");
                }
            }
        });
    });

    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //reload asset list table when events occur
    $("#assetsListPerPage, #assetsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lalt();
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#assetSearch").keyup(function(){
        var value = $(this).val();
        
        if(value){
            $.ajax({
                url: appRoot+"search/assetsearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#assetsListTable").html(returnedData.assetsListTable);
                }
            });
        }
        
        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lalt();
        }
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //triggers when a asset's "edit" icon is clicked
    $("#assetsListTable").on('click', ".editAsset", function(e){
        e.preventDefault();
        
        //get Asset info
        var assetId = $(this).attr('id').split("-")[1];
        var description = $("#description-" + assetId).html();
        var assetNumber = $("#assetNumber-" + assetId).html();
        var serialNumber = $("#serialNumber-" + assetId).html();
        var location = $("#location-" + assetId).html();
        var purchaseDate = $("#purchaseDate-" + assetId).html();
        var supplier = $("#supplier-" + assetId).html();
        var cost = $("#cost-" + assetId).html();
        var depreciationMethod = $("#depreciationMethod-" + assetId).html();
        var depreciationRate = $("#depreciationRate-" + assetId).html();
        var owner = $("#owner-" + assetId).html();


        
                
        //prefill form with info
        $("#assetIdEdit").val(assetId);
        $("#assetNumberEdit").val(assetNumber);
        $("#descriptionEdit").val(description);
        $("#serialNumberEdit").val(serialNumber);
        $("#locationEdit").val(location);
        $("#purchaseDateEdit").val(purchaseDate);
        $("#supplierEdit").val(supplier);
        $("#costEdit").val(cost);
        $("#depreciationMethodEdit").val(depreciationMethod);
        $("#depreciationRateEdit").val(depreciationRate);
        $("#ownerEdit").val(owner);

        
        //remove all error messages that might exist
        $("#editAssetFMsg").html("");
        $("#assetIdEditErr").html("");
        $("#assetNumberEditErr").html("");
        $("#descriptionEditErr").html("");
        $("#serialNumberEditErr").html("");
        $("#locationEditErr").html("");
        $("#purchaseDateEditErr").html("");
        $("#supplierEditErr").html("");
        $("#costEditErr").html("");
        $("#depreciationMethodEditErr").html("");
        $("#depreciationRateEditErr").html("");
        $("#ownerEditErr").html("");

         
        //launch modal
        $("#editAssetModal").modal('show');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#editAssetSubmit").click(function(){
        var assetId = $("#assetIdEdit").val();
        var description = $("#descriptionEdit").val();
        var serial_number = $("#serialNumberEdit").val();
        var assetNumber = $("#assetNumberEdit").val();
        var location = $("#locationEdit").val();
        var purchaseDate = $("#purchaseDateEdit").val();
        var supplier = $("#supplierEdit").val();
        var cost = $("#costEdit").val();
        var depreciationMethod = $("#depreciationMethodEdit").val();
        var depreciationRate = $("#depreciationRateEdit").val();  
        var owner = $("#ownerEdit").val();     
        
        if(!description || !serial_number ||!location || !purchaseDate || !cost || !depreciationRate || !supplier){
                        
            !serial_number ? $("#serialNumberEditErr").html("Serial number cannot be empty") : "";
            !description ? $("#descriptionEditErr").html("Asset description cannot be empty") : "";
            !location ? $("#locationEditErr").html("Asset location cannot be empty") : "";
            !purchaseDate ? $("#purchaseDateEditErr").html("Purchase date can not be empty ") : "";
            !cost ? $("#costEditErr").html("Asset cost can not be empty ") : "";
            !depreciationRate ? $("#depreciationRateEditErr").html("Depreciation rate can not be empty ") : "";
            !supplier ? $("#supplierEditErr").html("Supplier can not be empty ") : "";
           
            return;
        }
        
        $("#editAssetFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");
        
        $.ajax({
            method: "POST",
            url: appRoot+"assets/edit",
            data: {description:description,_aId:assetId, serial_number:serial_number, assetNumber:assetNumber, location:location, purchaseDate:purchaseDate, supplier:supplier, cost:cost, depreciationMethod:depreciationMethod, depreciationRate:depreciationRate, owner:owner}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#editAssetFMsg").css('color', 'green').html("Asset successfully updated");
                
                setTimeout(function(){
                    $("#editAssetModal").modal('hide');
                }, 1000);
                
                lalt();
            }
            
            else{
                
                // Display errors for individual fields
                $("#editAssetFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");

                $("#assetNumberEditErr").text(returnedData.asset_number);
                $("#descriptionEditErr").text(returnedData.description);
                $("#serialNumberEditErr").text(returnedData.serial_number);
                $("#locationEditErr").text(returnedData.location);
                $("#supplierEditErr").text(returnedData.supplier);
                $("#costEditErr").text(returnedData.cost);
                $("#depreciationMethodEditErr").text(returnedData.depreciation_method);
                $("#depreciationRateEditErr").text(returnedData.depreciation_rate);
                $("#ownerEditErr").text(returnedData.owner);

                $("#addCustEditErrMsg").text(returnedData.msg);
            }
        }).fail(function(){
            $("#editAssetFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    //TO DELETE A Asset (The Asset will be marked as "deleted" instead of removing it totally from the db)
    $("#assetsListTable").on('click', '.delAsset', function(e){
        e.preventDefault();
        
        //get the Asset id
        var assetId = $(this).parents('tr').find('.curAssetId').val();
        var assetRow = $(this).closest('tr');//to be used in removing the currently deleted row
        
        if(assetId){
            var confirm = window.confirm("Are you sure you want to delete asset? This cannot be undone.");
            
            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');
                
                $.ajax({
                    url: appRoot+"assets/delete",
                    method: "POST",
                    data: {i:assetId}
                }).done(function(rd){
                    console.log(rd);
                    if(rd.status === 1){
                        //remove Asset from list, update Assets' SN, display success msg
                        $(assetRow).remove();

                        //update the SN
                        resetAssetSN();

                        //display success message
                        changeFlashMsgContent('Asset deleted', '', 'green', 1000);
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
    
    // Handles the printing of all Assets
    $("#printList").click(function(e){
        e.preventDefault();
        generatePDF()

    });
});



/**
 * "lalt" = "load Asset List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lalt(url) {

    var orderBy = $("#assetsListSortBy").val().split("-")[0];
    var orderFormat = $("#assetsListSortBy").val().split("-")[1];
    var limit = $("#assetsListPerPage").val();

    $.ajax({
        type: 'get',
        url: url ? url : appRoot + "assets/lalt/",
        data: {
            orderBy: orderBy,
            orderFormat: orderFormat,
            limit: limit
        },

        success: function (returnedData) {
            hideFlashMsg();
            $("#assetsListTable").html(returnedData.assetsListTable);
        },

        error: function () {
        }
    });

    return false;
}



function resetAssetSN(){
    $(".assetSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}


// function to create the Asset Number for the currrent month
function fetchLastAssetNumber() {
    $.ajax({
        type: 'GET',
        url: appRoot + "assets/lastAssetNumberForMonth",
        success: function (response) {
            if (response.status === 1) {
                // Set the new Asset Number to the input field
                $('#assetNumber').val(response.newAssetNumber);
                
            } else {
                // Handle the case when an error occurs or no Asset Number is found
                alert('An error occurred while fetching the last Asset Number.');
            }
        },
        error: function () {
            // Handle any errors that occur during the AJAX request
            alert('An error occurred while fetching the last Asset Number.');
        }
    });
}


function generatePDF() {
    // Define the column names with bold formatting
    var columnsToInclude = [
        { text: 'Asset Number', bold: true },
        { text: 'Description', bold: true },
        { text: 'Serial Number', bold: true },
        { text: 'Location', bold: true },
        { text: 'Purchase Date', bold: true },
        { text: 'Supplier', bold: true },
        { text: 'Cost', bold: true },
    ];

    // Step 1: Extract the column names from the table header
    var table = document.querySelector('table');
    var headerRow = table.rows[0];
    var columnNames = [];
    for (var i = 0; i < headerRow.cells.length; i++) {
        columnNames.push(headerRow.cells[i].textContent.trim());
    }

    // Step 2: Extract table data from the table rows
    var extractedData = [];
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = {};

        for (var j = 0; j < row.cells.length; j++) {
            rowData[columnNames[j]] = row.cells[j].textContent.trim();
        }

        extractedData.push(rowData);
    }

    // Create the content for the PDF document
    var content = [
        { text: 'Asset List', style: 'header' },
        {
            table: {
                headerRows: 1,
                widths: ['auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto'],
                body: [columnsToInclude].concat(extractedData.map(function (row) {
                    return [
                        row['Asset Number'],
                        row['Description'],
                        row['Serial Number'],
                        row['Location'],
                        row['Purchase Date'],
                        row['Supplier'],
                        row['Cost']
                    ];
                })),
            },
            layout: 'lightHorizontalLines', // Add horizontal lines to the table
        },
    ];

    // Define the styles for the PDF
    var styles = {
        header: {
            fontSize: 18,
            bold: true,
            alignment: 'center',
            margin: [0, 0, 0, 10],
        },
    };

    // Create the PDF document
    var pdfDefinition = {
        content: content,
        styles: styles,
    };

    // Generate the PDF using pdfmake
    pdfMake.createPdf(pdfDefinition).download('asset_list.pdf'); // Download the PDF with a specified filename
}
