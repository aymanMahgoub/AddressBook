jQuery(document).ready(function($){

    let countryCode = 'de' ;
    $("#contact_form_firstNumber").intlTelInput({
        separateDialCode: true,
        preferredCountries: ['eg', 'de'],
        initialCountry: countryCode.toLowerCase(),
        autoHideDialCode: true
    });
    $("#contact_form_secondNumber").intlTelInput({
        separateDialCode: true,
        preferredCountries: ['eg', 'de'],
        initialCountry: countryCode.toLowerCase(),
        autoHideDialCode: true
    });
    $("#contact_form_thirdNumber").intlTelInput({
        separateDialCode: true,
        preferredCountries: ['eg', 'de'],
        initialCountry: countryCode.toLowerCase(),
        autoHideDialCode: true
    });

    let firstCountryData = $("#contact_form_firstNumber").intlTelInput("getSelectedCountryData");
    $("#firstCountryCode").val('+'+firstCountryData.dialCode);
    $("#contact_form_firstNumber").on("countrychange", function() {
        let firstCountryData = $("#contact_form_firstNumber").intlTelInput("getSelectedCountryData");
        $("#firstCountryCode").val('+'+firstCountryData.dialCode);
        $("#contact_form_firstNumber").change();
    });

    let secondCountryData = $("#contact_form_secondNumber").intlTelInput("getSelectedCountryData");
    $("#secondCountryCode").val('+'+secondCountryData.dialCode);
    $("#contact_form_secondNumber").on("countrychange", function() {
        let secondCountryData = $("#contact_form_secondNumber").intlTelInput("getSelectedCountryData");
        $("#secondCountryCode").val('+'+secondCountryData.dialCode);
        $("#contact_form_secondNumber").change();
    });

    let thirdCountryData = $("#contact_form_thirdNumber").intlTelInput("getSelectedCountryData");
    $("#thirdCountryCode").val('+'+thirdCountryData.dialCode);
    $("#contact_form_thirdNumber").on("countrychange", function() {
        let thirdCountryData = $("#contact_form_thirdNumber").intlTelInput("getSelectedCountryData");
        $("#thirdCountryCode").val('+'+thirdCountryData.dialCode);
        $("#contact_form_thirdNumber").change();
    });

});
