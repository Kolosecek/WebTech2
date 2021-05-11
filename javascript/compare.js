$( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    $( "#not-sortable" ).sortable("disable");
    $( "#not-sortable" ).disableSelection();
});