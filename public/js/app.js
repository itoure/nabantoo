$(function() {

    $("#start_date").datetimepicker({
        format: 'yyyy-mm-dd HH:ii',
        autoclose: true
    });

    $("#end_date").datetimepicker({
        format: 'yyyy-mm-dd HH:ii',
        autoclose: true
    });

    var $container = $('#isotope');
    // init
    $container.isotope({
        // options
        itemSelector: '.thumbnail',
        layoutMode: 'fitRows'
    });

});