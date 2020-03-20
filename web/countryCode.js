jQuery(document).ready(function($){
    let countryCode = 'de' ;
    $("#contact_form_number").intlTelInput({
        separateDialCode: true,
        preferredCountries: ['eg', 'de'],
        initialCountry: countryCode.toLowerCase(),
        autoHideDialCode: true
    });
    let countryData = $("#contact_form_number").intlTelInput("getSelectedCountryData");
    $("#countryCode").val('+'+countryData.dialCode);
    $("#contact_form_number").on("countrychange", function() {
        let countryData = $("#contact_form_number").intlTelInput("getSelectedCountryData");
        $("#countryCode").val('+'+countryData.dialCode);
        $("#contact_form_number").change();
    });
});
