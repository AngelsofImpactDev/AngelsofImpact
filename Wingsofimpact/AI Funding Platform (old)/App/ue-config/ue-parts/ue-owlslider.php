<link rel="stylesheet" type="text/css" href="ue-js/owlcarousel/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="ue-js/owlcarousel/owl.theme.css" />
<script type="text/javascript" src="ue-js/owlcarousel/owl.carousel.min.js"></script>
<div id="touchCarousel" class="owl-carousel">
	<?php
		$sliderImageString = '';
		$sliderImageFolder = 'upload/sliderImage/';
		$sliderQueStr = "SELECT * FROM slider
			WHERE slider_enabled = 'e'
			ORDER BY slider_showorder DESC
		";
		
		$sliderQue = ue_query($sliderQueStr);
		while($sliderRes = ue_fetch_array($sliderQue)) {
	?>
	<div class="item"><a href="<?php echo $sliderRes['slider_url'] ?>" target="<?php echo $sliderRes['slider_target'] ?>"><img src="<?php echo $sliderImageFolder ?><?php echo $sliderRes['slider_image'] ?>" width="100%" /></a></div>
	<?php
		}
	?>
</div>
<script type="text/javascript">
	$("#touchCarousel").owlCarousel({
		autoPlay: 4000,
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination:false,
		singleItem : true
	});
</script>