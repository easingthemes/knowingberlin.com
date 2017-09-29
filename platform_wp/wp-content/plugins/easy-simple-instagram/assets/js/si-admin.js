jQuery(document).ready(function($){

    // Tooltips
    $('.si-what').click(function(){

        var id = $(this).data('info');

        $('#' + id).slideToggle('fast');

    });

});