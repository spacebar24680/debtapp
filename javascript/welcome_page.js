//Associated with homepage.html

$('login').dropdown();

//To prevent dropdown from disappearing after clicking within it
//Might need to change to add IE support
//http://stackoverflow.com/questions/6729049/making-a-dropdown-menu-disappear-when-clicking-anything-but-the-menu
$('#myForm').bind('click', function (e) { e.stopPropagation() });

//Set keyboard ESC to close registration popup
$('#registrationModal').modal({
  keyboard: true
})

//Registration popup hidden by default
$('#registrationModal').modal('hide');