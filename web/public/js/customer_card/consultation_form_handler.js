/*var ownersData = {
 id: '#customer_card_customer_owners',
 prototype: '__owner__',
 count: '{{ form.customer.owners|length }}'
 };*/

function hideConsultationForm() {
    $('#consultation_form_wrapper').css('display', 'none');
}

function showConsultationForm() {
    $('#consultation_form_wrapper').css('display', 'block');
}

$(document).ready(function () {
    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
    $('#add_consultation').click(function() {
        showConsultationForm();
    });
    $('#cancel_btn').click(function () {
        hideConsultationForm();
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            hideConsultationForm();
        }
    });
});
