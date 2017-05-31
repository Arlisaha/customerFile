function hideConsultationForm() {
    $('dialog').hide();
}

function showConsultationForm() {
    $('dialog').show();
}

$(document).ready(function () {
    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
    $('#add_consultation').click(function() {
        showConsultationForm();
    });
    $('#cancel_btn').click(function (e) {
        e.preventDefault();
        hideConsultationForm();
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            hideConsultationForm();
        }
    });
});
