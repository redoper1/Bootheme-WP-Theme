/* Custom scripts */
jQuery(function($){
    $(document).ready(function () {
        console.log('Bootheme custom scripts initialized!');

        updateDimensionsOfElements();
    });

    $(window).resize(function () {
        updateDimensionsOfElements();
    });

    function updateDimensionsOfElements() {
        // Set the page content minimal height
        $('#content').css('min-height', 'calc(100vh' + ' - ' + $('#master-header').outerHeight() + 'px' + ' - ' + $('footer').outerHeight() + 'px' + ')');

        // Set the minimal height of page content if WP admin bar is present
        if ($('#wpadminbar').length > 0) {
            $('#content').css('min-height', 'calc(100vh' + ' - ' + $('#master-header').outerHeight() + 'px' + ' - ' + $('footer').outerHeight() + 'px' + ' - ' + $('#wpadminbar').outerHeight() + 'px' + ')');
        }
    }
});