/*var ownersData = {
    id: '#customer_card_customer_owners',
    prototype: '__owner__',
    count: '{{ form.customer.owners|length }}'
};*/

function addTypePart(e, data) {
    e.preventDefault();

    var typePart = $(data['id']);

    var newWidget = typePart.attr('data-prototype');
    newWidget = newWidget.replace(new RegExp(data['prototype'], 'g'), data['count']);
    data['count']++;

    var newLi = $('<li></li>').html(newWidget);
    newLi.appendTo(typePart);
}

$(document).ready(function() {
    $('textarea').froalaEditor();
    $('select').chosen({
        width: '20%',
        no_results_text: "Pas de r&eacute:sultats !",
        disable_search_threshold: 10
    });
    $('#add_owner').click(function(e) {addTypePart(e, ownersData)});
    $('#add_cat').click(function(e) {addTypePart(e, catsData)});
    $('#add_dog').click(function(e) {addTypePart(e, dogsData)});
    $('#add_consultation').click(function(e) {addTypePart(e, consultationsData)});
});
