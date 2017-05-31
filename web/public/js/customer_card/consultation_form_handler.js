function hideConsultationForm() {
    $('dialog').hide();
}

function showConsultationForm() {
    document.querySelector('dialog').showModal();
}

$(document).ready(function () {
	var show = document.querySelector('dialog');

    $('.froala').froalaEditor(froalaOptions);
    $('select').chosen(chosenOptions);
    $('#add_consultation').click(function() {
        showConsultationForm();
    });
	show.click(function() {
		dialog.showModal();
	});
	$('#cancel_btn').click(function (e) {
        e.preventDefault();
        document.querySelector('dialog').close();
    });
});
