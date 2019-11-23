$("#postcodeForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Did you enter a UK postcode?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitPostcodeForm();
    }
});


function submitPostcodeForm(){
    // Initiate Variables With Form Content
    var postcode = $("#postcode").val();
    console.log('Postcode is: ' + postcode);

    $.ajax({
        type: "POST",
        url: "php/postcode-form-process.php",
        data: "postcode=" + postcode,
        success : function(text){
            if (text == "success"){
                postcodeFormSuccess();
            } else {
                postcodeFormError();
                submitMSG(false,text);
            }
        }
    });
}

function postcodeFormSuccess(){
    window.location.href = "http://www.huge-online2.co.uk/distanceCheck.php?pc="+$("#postcode").val();
}

function postcodeFormError(){
    $("#postcodeForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}