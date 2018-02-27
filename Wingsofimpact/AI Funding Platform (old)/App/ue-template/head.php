<link rel="stylesheet" type="text/css" href="style.css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="js/customInputFile/customInputBtn.css" />
<script type="text/javascript" src="ue-js/uedatepicker/zebra_datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="ue-js/uedatepicker/style.css" />
<script>
$(document).ready(function() {
	$('.datepicker').Zebra_DatePicker();
	
	$('.futuredatepickerstart').Zebra_DatePicker({
		direction: true
	});
	
	$("#writeError, #writeOk").click(function(){
		$(this).fadeOut(200);
	});
	
	$(window).scroll(function() {
		if ($(this).scrollTop() > 1){  
			$('#topHead').addClass("sticky");
			$('#topCenterMenu a, #topLeftMenu a').addClass("lessPadding");
			$('#floatingLogo').addClass('resizeLogo');
			
			$('#mobileHead').addClass("stickyMobile");
			/*$('#floatingLogoMobile').addClass("resizeLogoMobile");*/
		}
		else{
			$('#topHead').removeClass("sticky");
			$('#topCenterMenu a, #topLeftMenu a').removeClass("lessPadding");
			$('#floatingLogo').removeClass('resizeLogo');
			
			$('#mobileHead').removeClass("stickyMobile");
			/*$('#floatingLogoMobile').removeClass("resizeLogoMobile");*/
		}
	});
	
});
</script>