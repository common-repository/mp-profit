(function ($) {
    /*
     * calculator validate form
     */
    function validateForm(parent) {
        var result = true;
        $('#starting_amount').parents('form').find('.notification').remove();
        var re = new RegExp("^\\d+$");
        var num = $('#starting_amount').val();
        if (!re.test(num)) {
            $('#starting_amount').after('<div class="notification error">' + $('#starting_amount').attr('title') + '</div>');
            result = false;
        }
        var num2 = $('#years').val();
        if (!re.test(num2)) {
            $('#years').after('<div class="notification error">' + $('#years').attr('title') + '</div>');
            result = false;
        }
        var reg = new RegExp("^\\d+(\.\\d+)?$");
        var floatVal = $('#hypo_rate_of_return').val();
        if (!reg.test(floatVal)) {
            $('#hypo_rate_of_return').after('<div class="notification error">' + $('#hypo_rate_of_return').attr('title') + '</div>');
            result = false;
        }
        return result;

    }
    /*
     * calculator
     */
    function calc_investing() {
        if (validateForm()) {
            // S = K ( 1 + P/100/d ) ^ ( d * N );
            var K = $('#starting_amount').val();
            var P = $('#hypo_rate_of_return').val();
            var N = $('#years').val();
            var d = $('#compound_interest').val();
            var S = K * Math.pow((1 + P / 100 / d), (N * d));
            var text = '';
            text += '<table style="opacity:0; ">';
            text += '<thead><tr><th colspan="2" scope="col">' + mp_profit_script_data.invest_result + '</th></tr></thead>';
            text += '<tbody>';
            text += ' <tr><td>' + mp_profit_script_data.invest_start + '</td><td> $' + K + ' </td></tr>';
            text += ' <tr><td>' + mp_profit_script_data.invest_years + '</td><td> ' + N + ' </td></tr>';
            text += '<tr><td>' + mp_profit_script_data.invest_rate + '</td><td> ' + P + '% ' + $("#compound_interest option:selected").text() + '</td></tr>';
            text += ' </tbody>';
            text += '<tfoot>';
            text += '<tr>';
            text += ' <td colspan="2">' + mp_profit_script_data.invest_ending + ': <h5>$' + S.toFixed(2) + '</h5></td>';
            text += ' </tr>';
            text += '</tfoot>';
            text += ' </table>';
            var Ki = parseFloat(K);
            text += ' <table>';
            text += '<thead><tr><th>' + mp_profit_script_data.invest_year + '</th><th>' + mp_profit_script_data.invest_earnings + '</th><th>' + mp_profit_script_data.invest_balance + '</th></tr></thead>';
            text += '<tbody>';
            for (var i = 0; i < N; i++) {
                var Si = Ki * Math.pow((1 + P / 100 / d), (1 * d));
                var Kj = Ki;
                Ki = Si;
                text += ' <tr><td>' + (i + 1) + '</td><td> $' + (Ki - Kj).toFixed(2) + ' </td><td> $' + Ki.toFixed(2) + '</td></tr>';
            }
            text += '</tfoot>';
            text += ' </table>';
            $('.calculator-section .result').html(text);
            $('.calculator-section form').hide();
            $('.calculator-section .result table').animate({
                opacity: 1
            }, 400);
        }
    }
    $(document).ready(function () {
        /* 
         * show/hide reCaptcha 
         */
        var thisOpen = false;
        $('.contact-form .form-control').each(function () {
            if ($(this).val().length > 0) {
                thisOpen = true;
                $('.g-recaptcha').css('display', 'block').delay(1000).css('opacity', '1');
                return false;
            }
        });
        if (thisOpen == false && (typeof $('.contact-form textarea').val() != 'undefined') && ($('.contact-form textarea').val().length > 0)) {
            thisOpen = true;
            $('.g-recaptcha').css('display', 'block').delay(1000).css('opacity', '1');
        }
        $('.contact-form input, .contact-form textarea').focus(function () {
            if (!$('.g-recaptcha').hasClass('recaptcha-display')) {
                $('.g-recaptcha').css('display', 'block').delay(1000).css('opacity', '1');
            }
        });
        /*
         * calculator
         */
        $('body').on('click', '.calc-investing', function (e) {
            e.preventDefault();
            calc_investing(e);
        });
    });
    $(window).load(function () {
		if (typeof mp_profit !== 'undefined' && mp_profit.position !== '') {
			setTimeout(function(){
				window.scrollTo(0,parseInt(mp_profit.position));
			},0);
		}
    });
})(jQuery);