<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

$(document).ready(function() {
    $('.navigation > ul > li').hover(
        function() {
            $(this).find('.mega-menu').stop(true, true).slideDown(300).css('display', 'block');
        }, function() {
            $(this).find('.mega-menu').stop(true, true).slideUp(300);
        }
    );

    $('.mega-menu-col').hover(
        function() {
            $(this).find('.subcategory-products').stop(true, true).slideDown(300).css('display', 'block');
        }, function() {
            $(this).find('.subcategory-products').stop(true, true).slideUp(300);
        }
    );
});