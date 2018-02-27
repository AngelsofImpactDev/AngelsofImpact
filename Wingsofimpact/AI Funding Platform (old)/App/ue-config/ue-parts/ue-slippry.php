<link rel="stylesheet" type="text/css" href="ue-js/slippry/slippry.css" />
<script type="text/javascript" src="ue-js/slippry/slippry.min.js"></script>
<div id="slippryContainer">
    <ul id="slipprySlider">
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
        <li><a href="<?php echo $sliderRes['slider_url'] ?>" target="<?php echo $sliderRes['slider_target'] ?>"><img src="<?php echo $sliderImageFolder ?><?php echo $sliderRes['slider_image'] ?>" /></a></li>
        <?php
            }
        ?>
    </ul>
</div>
<script>
    $(function() {
        var demo1 = $("#slipprySlider").slippry({
            transition: 'horizontal',
            useCSS: true
        });
    });
</script>