<link rel="stylesheet" href="ue-js/nivoSlider/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="ue-js/nivoSlider/themes/default/default.css" type="text/css" />
<script type="text/javascript" src="ue-js/nivoSlider/jquery.nivo.slider.js"></script>
<div class="slider-wrapper theme-default">
    <div class="ribbon"></div>
    <div id="slider" class="nivoSlider">
<?php
    $sliderImageString = '';
    $sliderImageFolder = 'upload/sliderImage/';
    $sliderImageQue = ue_query("SELECT * FROM slider WHERE slider_enabled = 'e' ORDER BY slider_showorder ASC");
    while($sliderImageRes = ue_fetch_array($sliderImageQue)) {
?>
    <a<?php
    if($sliderImageRes['slider_url']) { 
        echo ' href="'.$sliderImageRes['slider_url'].'" target="'.$sliderImageRes['slider_target'].'"';
    }
    ?>><img src="<?php echo $sliderImageFolder.$sliderImageRes['slider_image']?>" alt="<?php echo $sliderImageRes['slider_name']?>" /></a>
<?php
    }
?>
    </div>
</div>
<script type="text/javascript" src="ue-js/nivoSlider/nivo-init.js"></script>