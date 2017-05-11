/*var ownersData = {
 id: '#customer_card_customer_owners',
 prototype: '__owner__',
 count: '{{ form.customer.owners|length }}'
 };*/

function addTypePart(e, data) {
    e.preventDefault();

    var typePart = $(data['id']);
    var list = $(data['append_id']);

    var newWidget = '<span class="deletable">-</span>' + typePart.attr('data-prototype');
    newWidget = newWidget.replace(new RegExp('__' + data['prototype'] + '__', 'g'), data['count']);

    if ($(data['append_id'] + ' li').length > 0) {
        var newHr = $('<hr />');
        newHr.appendTo(list);
    }

    var newLi = $('<li id="' + data['prototype'] + '_' + data['count'] + '"></li>').html(newWidget);

    newLi.appendTo(list);

    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
    $('.deletable').click(removeDeletable);

    data['count']++;
}

function removeDeletable(e) {
    $(this).parent().prev('hr').remove();
    $(this).parent().remove();
}

$(document).ready(function () {
    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
    $('#add_owner').click(function (e) {
        addTypePart(e, ownersData)
    });
    $('#add_cat').click(function (e) {
        addTypePart(e, catsData)
    });
    $('#add_dog').click(function (e) {
        addTypePart(e, dogsData)
    });
    $('#add_consultation').click(function (e) {
        addTypePart(e, consultationsData)
    });
    $('.deletable').click(removeDeletable);
});
