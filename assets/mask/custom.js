$(function () {
    $('.money').mask('#.##0,00', {reverse: true});
    $('.money2').mask('#,##0.00', {reverse: true});
    $('.postal').mask('000000');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.pis').mask('000.00000.00-0', {reverse: true});
    $('.nit').mask('000000000-0', {reverse: true});
    $('.telefono_fijo').mask('(#) 000-0000');
    $('.uf').mask('AA');
    $('.dia_vencimento').mask('00');
    $('.mask-producto-qty').mask('00000000');
    $('.codigo_servicio_correo').mask('00000');
    $('.selectonfocus').mask("00000000", {selectOnFocus: true});
    $('.card_number').mask('0000 0000 0000 0000');
    $('.card_expire').mask('00/0000');
    $('.card_cvv').mask('000');

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '000 000-0000' : '000 000-0000';
    },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

    $('.telefono_celular').mask(SPMaskBehavior, spOptions);
})

$(document).ready(function () {
    maskMercosul('.placa');
});

function maskMercosul(selector) {
    var MercoSulMaskBehavior = function (val) {
        var myMask = 'AAA0A00';
        var mercosul = /([A-Za-z]{3}[0-9]{1}[A-Za-z]{1})/;
        var normal = /([A-Za-z]{3}[0-9]{2})/;
        var replaced = val.replace(/[^\w]/g, '');
        if (normal.exec(replaced)) {
            myMask = 'AAA-0000';
        } else if (mercosul.exec(replaced)) {
            myMask = 'AAA-0A00';
        }
        return myMask;
    },
            mercoSulOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(MercoSulMaskBehavior.apply({}, arguments), options);
                }
            };
    $(function () {
        $(selector).bind('paste', function (e) {
            $(this).unmask();
        });
        $(selector).bind('input', function (e) {
            $(selector).mask(MercoSulMaskBehavior, mercoSulOptions);
        });
    });
}