$(document).ready(function() {
	hideStartup();
});

function hideStartup() {
		$('.you-owe').hide();
		$('.owe-you').hide();

}

$(function () {
	$('.tabs a:last').tab('show')
})

$(function() {
	$('#trans-type').change(function () {
		var choice = $('#trans-type').val();
		if(choice == 'People owe you money') {
			$('.you-owe').hide();
			$('.owe-you').fadeIn();
			$('#trans-people-owe-you').change(function () {
				$('.amount-desc').fadeIn();
			});
		}
		else if(choice == 'You owe money') {
			$('.owe-you').hide();
			$('.you-owe').fadeIn();
			$('#trans-people-you-owe').change(function () {
				$('.amount-desc').fadeIn();
			});
		}	
		
	});
});