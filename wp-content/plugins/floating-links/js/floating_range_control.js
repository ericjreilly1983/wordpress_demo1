(function ($) {
    $(document).ready(function ($) {
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).next('.cs-range-value').html(val);
            $(this).val(val);
        });
    })
})(jQuery);