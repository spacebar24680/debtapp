//Associated with homepage.html

$('login').dropdown();

//To prevent dropdown from disappearing after clicking within it
$('#myForm').bind('click', function (e) { e.stopPropagation() });

//Set keyboard ESC to close registration popup
$('#registrationModal').modal({
  keyboard: true
})

//Registration popup hidden by default
$('#registrationModal').modal('hide');