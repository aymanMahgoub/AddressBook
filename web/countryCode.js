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
        preparePhone("#contact_form_phones_"+index);
    });

    preparePhone("#contact_form_phones_0");
    preparePhone("#contact_form_phones_1");
    preparePhone("#contact_form_phones_2");

    let firstCountryData = $("#contact_form_phones_0").intlTelInput("getSelectedCountryData");
    $("#contact_form_CountryCode_0").val('+' + firstCountryData.dialCode);
    $("#contact_form_phones_0").on("countrychange", function () {
        let firstCountryData = $("#contact_form_phones_0").intlTelInput("getSelectedCountryData");
        $("#contact_form_CountryCode_0").val('+' + firstCountryData.dialCode);
        $("#contact_form_phones_0").change();
    });

    let secondCountryData = $("#contact_form_phones_1").intlTelInput("getSelectedCountryData");
    $("#contact_form_CountryCode_1").val('+' + secondCountryData.dialCode);
    $("#contact_form_phones_1").on("countrychange", function () {
        let secondCountryData = $("#contact_form_phones_1").intlTelInput("getSelectedCountryData");
        $("#contact_form_CountryCode_1").val('+' + secondCountryData.dialCode);
        $("#contact_form_phones_1").change();
    });

    let thirdCountryData = $("#contact_form_phones_2").intlTelInput("getSelectedCountryData");
    $("#contact_form_CountryCode_2").val('+' + thirdCountryData.dialCode);
    $("#contact_form_phones_2").on("countrychange", function () {
        let thirdCountryData = $("#contact_form_phones_2").intlTelInput("getSelectedCountryData");
        $("#contact_form_CountryCode_2").val('+' + thirdCountryData.dialCode);
        $("#contact_form_phones_2").change();
    });

    function preparePhone(phoneName) {
        let countryCode = 'de';

        $(phoneName).intlTelInput({
            separateDialCode: true,
            preferredCountries: ['eg', 'de'],
            initialCountry: countryCode.toLowerCase(),
            autoHideDialCode: true
        });
        // $("#contact_form_phones_0").intlTelInput("setNumber", "+44 7733 123 456");
    }
});


