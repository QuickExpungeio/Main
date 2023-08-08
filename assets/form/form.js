var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

$(document).ready(function(){
    $('.impn').inputmask('999-99-9999');
    $('.imcn').inputmask('999-999-9999');
    $('.zipc').inputmask('99999');

    $('#nextBtn').click(function(){

        $('.dad').html($('#moa').val() + " "+$('#doa').val()+" ,"+$('#yoa').val());
        $('.chg').html($('#oaf').val());
        $('.aagcy').html($('#agency').val());
        $('.flname').html($('#fname').val()+" "+$('#lname').val());
        $('.adr').html($('#address').val());
        $('.csz').html($('#city').val()+" / "+$('#state').val()+" /" +$('#zipcode').val());
        $('.phn').html($('#phoneno').val());
    });

});
function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Process To Checkout";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");

    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, z,j, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    z = x[currentTab].getElementsByTagName("select");

    if ($('#file')[0].files.length == 0) {

        $(".custom-file-label").css('border-color', 'red');
        return false;
    }else{
         $(".custom-file-label").css('border-color', '');
    }
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            if(y[i].getAttribute('isvalid')==1){
                y[i].className += " invalid";
                valid = false;
            }else{
                valid =true;
            }

            // and set the current valid status to false
        }
    }
    for (j = 0; j < z.length; j++) {

        if (z[j].value == "") {

            z[j].setAttribute("style","border-color :red");
               valid = false;
        }else{
            z[j].setAttribute("style","border-color :'' ");
            valid =true;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}


$(function () {

    var ddlYears = $(".ddlYears");
    var ddlDate = $(".ddlDate");
    var ddlMonths = $(".ddlMonths");

    var currentYear = (new Date()).getFullYear();
    const monthNames = ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug",
        "Sept", "Oct", "Nov", "Dec"
    ];

    for (var i = 1950; i <= currentYear; i++) {
        var option = $("<option />");
        option.html(i);
        option.val(i);
        ddlYears.append(option);
    }
    for (var i = 1; i <= 31; i++) {
        var option = $("<option />");
        option.html(i);
        option.val(i);
        ddlDate.append(option);
    }

    for (var i = 0; i < 12; i++) {
        var option = $("<option />");
        option.html(monthNames[i]);
        option.val(monthNames[i]);
        ddlMonths.append(option);
    }
});