jQuery(document).ready(function ($) {
    var $wrapper = $('#phones');
    $wrapper.on('click', '#phone-add', function (e) {
        e.preventDefault();
        let prototype = $wrapper.data('prototype');
        let index = $wrapper.data('index');
        let newForm = prototype.replace(/__name__/g, index);
        $wrapper.data('index', index + 1);
        if (index == 2) {
            $("#phone-add").hide();
        }
        $(this).before(newForm);
        let countryCode = 'de';
        $("#contact_form_phones_0").intlTelInput({
            separateDialCode: true,
            preferredCountries: ['eg', 'de'],
            initialCountry: countryCode.toLowerCase(),
            autoHideDialCode: true
        });
        $("#contact_form_phones_1").intlTelInput({
            separateDialCode: true,
            preferredCountries: ['eg', 'de'],
            initialCountry: countryCode.toLowerCase(),
            autoHideDialCode: true
        });
        $("#contact_form_phones_2").intlTelInput({
            separateDialCode: true,
            preferredCountries: ['eg', 'de'],
            initialCountry: countryCode.toLowerCase(),
            autoHideDialCode: true
        });
    });


    let firstCountryData = $("#contact_form_phones_0").intlTelInput("getSelectedCountryData");
    $("#CountryCode_0").val('+' + firstCountryData.dialCode);
    $("#contact_form_phones_0").on("countrychange", function () {
        let firstCountryData = $("#contact_form_phones_0").intlTelInput("getSelectedCountryData");
        $("#firstCountryCode").val('+' + firstCountryData.dialCode);
        $("#contact_form_phones_0").change();
    });

    let secondCountryData = $("#contact_form_phones_1").intlTelInput("getSelectedCountryData");
    $("#secondCountryCode").val('+' + secondCountryData.dialCode);
    $("#contact_form_phones_1").on("countrychange", function () {
        let secondCountryData = $("#contact_form_phones_1").intlTelInput("getSelectedCountryData");
        $("#secondCountryCode").val('+' + secondCountryData.dialCode);
        $("#contact_form_phones_1").change();
    });

    let thirdCountryData = $("#contact_form_phones_2").intlTelInput("getSelectedCountryData");
    $("#thirdCountryCode").val('+' + thirdCountryData.dialCode);
    $("#contact_form_phones_2").on("countrychange", function () {
        let thirdCountryData = $("#contact_form_phones_2").intlTelInput("getSelectedCountryData");
        $("#thirdCountryCode").val('+' + thirdCountryData.dialCode);
        $("#contact_form_phones_2").change();
    });

});
