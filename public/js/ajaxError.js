$( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
    location.href = "/login";
});