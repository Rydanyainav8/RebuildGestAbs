$(function () {
    // this will get the full URL at the address bar
    var url = window.location;
    // console.log(url);

    // passes on every "a" tag 
    $("#navigation a").each(function () {
        // checks if its the same on the address bar
        if (url == (this.href)) {
            $(this).closest("li").addClass("active");
        }
    });
});
