(function ($) {
    'use strict';
    $(document).ready(function () {
        $("form").on("change", "input", function () {
            $("form").submit();
        });
    });
})(jQuery);
