/*Javascript file for list page e.g. create and manage users or employees.*/
$(document).ready(function(){
    $("#trlink").click(function(e){
        e.preventDefault();
        var url = $(this).data('href');
        var emId = $(this).data('empid');
        var windowName = $(this).attr('id');
        alert(emId)
        window.open(url, windowName);
    });
});