jQuery(document).ready(function ($) {
    var $wrapper = $('#phones');
    $wrapper.on('click', '#phone-add', function (e) {
        e.preventDefault();
        let prototype = $wrapper.data('prototype');
        let index = $wrapper.data('index');
        let newForm = prototype.replace(/__name__/g, index);
        $wrapper.data('index', index + 1);
        if (index >= 2) {
            $("#phone-add").hide();
        }
        $(this).before(newForm);
        prepareInternationalNumber(index);
    });

    prepareInternationalNumber(0);
    prepareInternationalNumber(1);
    prepareInternationalNumber(2);

    $(document).on('countrychange','#contact_form_phones_0', function(){
        let firstCountryData = $("#contact_form_phones_0").intlTelInput("getSelectedCountryData");
        $("#contact_form_countryCode_0").val('+' + firstCountryData.dialCode);
        $("#contact_form_phones_0").change();
    });

    $(document).on('countrychange','#contact_form_phones_1', function(){
        let firstCountryData = $("#contact_form_phones_1").intlTelInput("getSelectedCountryData");
        $("#contact_form_countryCode_1").val('+' + firstCountryData.dialCode);
        $("#contact_form_phones_1").change();
    });

    $(document).on('countrychange','#contact_form_phones_2', function(){
        let firstCountryData = $("#contact_form_phones_2").intlTelInput("getSelectedCountryData");
        $("#contact_form_countryCode_2").val('+' + firstCountryData.dialCode);
        $("#contact_form_phones_2").change();
    });

    function prepareInternationalNumber(index) {
        let countryCode = 'de';
        let phoneId = "#contact_form_phones_"+index;
        let countryCodeId = "#contact_form_countryCode_"+index;

        $(phoneId).intlTelInput({
            separateDialCode: true,
            preferredCountries: ['eg', 'de'],
            initialCountry: countryCode.toLowerCase(),
            autoHideDialCode: true
        });
        let firstCountryData = $(phoneId).intlTelInput("getSelectedCountryData");
        $(countryCodeId).val('+' + firstCountryData.dialCode);
    }
});
