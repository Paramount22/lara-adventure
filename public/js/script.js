(function($) {

    // DELETE FORM
    $('#delete-form').on('submit', function() {
        return confirm('Are you sure ?');
    });

    // Flash
    $('div.alert-success').not('.alert-important').delay(3000).fadeOut(350);

    // DELETE comment

    $('.fa-times').on('click', function() {
        return confirm('Are you sure ?');
    });


}(jQuery));
