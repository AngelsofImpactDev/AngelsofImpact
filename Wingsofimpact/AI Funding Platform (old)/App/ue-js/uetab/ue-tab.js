defaultUeTabTarget = $('.uetab-menucontainer a:first-child').attr('data-uetab-target');
$('.uetab-menucontainer a:first-child').addClass('uetab-btnAfter');
$('#'+defaultUeTabTarget).css('display','block');

$('.uetab-btn').click(function() {
	$('.uetab-target').css('display','none');
	$('.uetab-menucontainer a').removeClass('uetab-btnAfter');
	currentClickedUeTabTarget = $(this).attr('data-uetab-target');
	$(this).addClass('uetab-btnAfter');
	$('#'+currentClickedUeTabTarget).css('display','block');
});