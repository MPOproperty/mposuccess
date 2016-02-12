$('.bs-select').selectpicker({
    iconBase: 'fa',
    tickIcon: 'fa-check'
}).on('change', function(){
    $('form#perPage').submit();
});

// fix pagination a href - for save perPage
$('.pagination').find('a').each(function () {
    $(this).attr('href', $(this).attr('href') + '&perPage=' + dataNews['perPage']);
});