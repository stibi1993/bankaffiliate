$(function() {

    $('#social-status').change(function(){
        var val = $('option:selected', this).val();

        if(val == "secondment"){
            $(".secondment-show").show();
            $(".expatriation-show").hide();
        }else{
            $(".secondment-show").hide();
            $(".expatriation-show").show();
        }

    });
});


