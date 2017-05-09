/*var ownersData = {
    id: '#customer_card_customer_owners',
    prototype: '__owner__',
    count: '{{ form.customer.owners|length }}'
};*/

function addTypePart(e, data) {
    e.preventDefault();

    var typePart = $(data['id']);
    var list = $(data['append_id']);

    var newWidget = typePart.attr('data-prototype');
    newWidget = newWidget.replace(new RegExp(data['prototype'], 'g'), data['count']);
    data['count']++;

    var newLi = $('<li></li>').html(newWidget);

    newLi.appendTo(list);
    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
}

$(document).ready(function() {
    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
    $('#add_owner').click(function(e) {addTypePart(e, ownersData)});
    $('#add_cat').click(function(e) {addTypePart(e, catsData)});
    $('#add_dog').click(function(e) {addTypePart(e, dogsData)});
    $('#add_consultation').click(function(e) {addTypePart(e, consultationsData)});
});
