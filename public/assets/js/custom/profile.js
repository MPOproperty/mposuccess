$("#phone").inputmask("mask", {
    "mask": "(999) 999-99-99",
    "clearIncomplete": true
}).val(dataUser['phone']);

//init date pickers
$('.date-picker').datepicker({
    startDate: '-100y',
    endDate: '-18y',
    language: 'ru'
});

function formatCountry(state) {
    if (!state.id) return state.text; // optgroup
    return "<img class='flag' src='/assets/img/flags/" + $(state.element).data('country') + ".png'/>&nbsp;&nbsp;" + state.text;
}
$("#select2_country").select2({
    allowClear: true,
    formatResult: formatCountry,
    formatSelection: formatCountry,
    escapeMarkup: function (m) {
        return m;
    }
}).select2("val", dataUser['country']);

$('#select2_program').select2().select2("val", dataUser['program']);

// copy in buffer
var client = new ZeroClipboard( document.getElementById("copy-button") );
client.on( "ready", function( readyEvent ) {
    // alert( "ZeroClipboard SWF is ready!" );

    client.on( "aftercopy", function( event ) {
        // `this` === `client`
        // `event.target` === the element that was clicked
        event.target.style.opacity = .7;
        setTimeout(function(){event.target.style.opacity = 1}, 500);
    } );
} );