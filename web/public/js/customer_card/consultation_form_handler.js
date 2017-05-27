/*var ownersData = {
 id: '#customer_card_customer_owners',
 prototype: '__owner__',
 count: '{{ form.customer.owners|length }}'
 };*/

$(document).ready(function () {
    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
    $('#add_consultation').click(function() {
        $('#consultation_form_wrapper').css('display', 'block');
    });
    $('#consultation_form_wrapper').click(function () {
        $('#consultation_form_wrapper').css('display', 'none');
    })
});
