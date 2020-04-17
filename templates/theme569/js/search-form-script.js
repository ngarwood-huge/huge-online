jQuery("#searchForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Please enter a product");
    } else {
        // everything looks good!
        event.preventDefault();
        var product = jQuery("#keyword").val();
        var url = "index.php/component/search/?searchword=" + product + "&searchphrase=all";
        var encUrl = encodeURI(url);
        window.location.href = encUrl;
    }
});


function submitSearchForm(){
    // Initiate Variables With Form Content
    var name = jQuery("#keyword").val();
    jQuery.ajax({
        type: "POST",
        url: "/templates/theme569/php/form-process.php",
        data: "name=" + keyword ,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    jQuery("#contactForm")[0].reset();
    submitMSG(true, "Message Submitted!")
}

function formError(){
    jQuery("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        jQuery(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    jQuery("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}