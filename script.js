(function ($) {
    'use strict';
    $(document).ready(function () {
        $('form').on('change', 'input', function () {
            $('form').submit();
        });
        $('.bonus-block').click(function () {
            let input = $(this).next('div').find('input');
            let value = input.val();
            if (value > 0) {
                value--;
            }
            input.val(value);
            $('form').submit();
        });
    });
})(jQuery);
