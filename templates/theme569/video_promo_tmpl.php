<?php
$templatePath = 'templates/'.$this->template ;
?>

<link rel="stylesheet" href="<?=$templatePath?>/css/grt-youtube.css">
<!-- Start Video promo Section -->
<section class="video-promo section" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="video-promo-content text-center">
                    <h2 class="wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms">About H.U.G.E</h2>
                    <p class="wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms">Learn more about us!</p>
                    <span class="youtube-link addtocart-button add btn btn-primary" youtubeid="mo1EHYkFP8I" style="padding: 20px">Open Video</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Video Promo Section -->

<!-- GRT Youtube Popup -->
<script src="<?=$templatePath?>/js/grt-youtube-popup.js"></script>

<!-- Initialize GRT Youtube Popup plugin -->
<script>
    $(".youtube-link").grtyoutube({
        autoPlay:true
    });
</script>