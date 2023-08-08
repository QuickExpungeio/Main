
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

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

    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");

    for (i = 0; i < y.length; i++) {

        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }

    // If the valid status is true, mark the step as finished and valid:
    if (!valid) {
        return false;
    }else{
        $('#paymentForm').submit();
    }
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