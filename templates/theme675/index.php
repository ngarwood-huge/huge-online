<?php
defined('_JEXEC') or die;
include_once 'includes/includes.php'; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
	<head>
    <?php
        if(!empty($info['page_title'])) {
            echo '<title>'.$info['page_title'].'</title>' . PHP_EOL;
            echo '<meta name="title" content="'.$info['page_title'].'" />' . PHP_EOL;
        }
        if(!empty($info['page_desc'])) {
            echo '<meta name="description" content="'.$info['page_desc'].'" />';
        }
    ?>
	<link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
	<?php echo $viewport;
		$doc->addStyleSheet($csspath.'layout.css');
		$doc->addStyleSheet($csspath.'jquery.fancybox.css');
		$doc->addStyleSheet($csspath.'jquery.fancybox-buttons.css');
		$doc->addStyleSheet($csspath.'jquery.fancybox-thumbs.css');
		$doc->addStyleSheet($csspath.'owl.carousel.css');
		$doc->addStyleSheet($csspath.'material-icons.css');
		$doc->addStyleSheet($csspath.'template.css'); ?>
		<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $template ?>/favicon.ico" type="image/x-icon"/>
		<jdoc:include type="head" />

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WHKJXDJ');</script>
        <!-- End Google Tag Manager -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166731983-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-166731983-1');
        </script>

        <!-- H.U.G.E TV, FAQs -->
        <script src="https://apps.elfsight.com/p/platform.js" defer></script>
	</head>
	<body class="option-com_virtuemart <?php echo $bodyClass.' '.$body_class; ?>">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WHKJXDJ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
		<?php echo $ie_warning; ?>
		<!-- Body -->
		<div id="wrapper">
			<div class="wrapper-inner">
				<!-- Top -->



				<div id="top">
					<div class="row-container">
						<div class="<?php echo $containerClass; ?>">
							<div class="<?php echo $rowClass; ?>">
								<!-- Logo -->
								<div class="span4 mobile2" style="float:right">
									<jdoc:include type="modules" name="top2" style="themeHtml5" />
								</div>
								<div id="logo" class="span<?php echo $params->get('logoBlockWidth'); ?>" style="float:left">
									<a href="<?php echo JURI::base(); ?>">
										<?php if(isset($logo)){ ?>
										<img src="<?php echo $logo;?>" alt="<?php echo $sitename; ?>">
										<?php } ?>
										<h1><?php echo wrap_chars_with_span($sitename); ?></h1>
									</a>
								</div>
								<div class="span4 mobile">
									<jdoc:include type="modules" name="top" style="themeHtml5" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if($this->countModules('navigation')){
					echo display_position('navigation');
				}
				if($this->countModules('header') && !$hideByView && !$client->mobile){
					echo display_position('header');
				}
				elseif ($info['request_uri'] == '/') { ?>
                        <div class="module_container">
				            <img src="images/slider/mobile-slider.jpg" style="width:100%"/>
<!--				            <img src="images/slider/huge-mobile-slider-bpd.jpg" style="width:100%"/>-->
                            <p>&nbsp;</p>
                        </div>
                <?php
                }
                if($this->countModules('maintop') && !$hideByView){
                    echo display_position('maintop');
                }

				if($this->countModules('showcase') && !$hideByView){
				  echo display_position('showcase');
				}
				
				 ?>
				<!-- Main Content row -->
				<div id="content">
					<?php if($this->countModules('breadcrumbs')){ ?>
					<div class="row-container">
						<div class="<?php echo $containerClass; ?>">
							<!-- Breadcrumbs -->
							<div id="breadcrumbs" class="<?php echo $rowClass; ?>">
								<jdoc:include type="modules" name="breadcrumbs" style="themeHtml5" />
							</div>
						</div>
					</div>
					<?php }
					if($this->countModules('map') && !$hideByView){ ?>
					<!-- Map -->
					<div id="map">
						<div class="row-container">
							<div class="<?php echo $containerClass; ?>">
								<div class="<?php echo $rowClass; ?>">
									<jdoc:include type="modules" name="map" style="themeHtml5" />
								</div>
							</div>
						</div>
					</div>
					<?php }
					$layout = $params->get('content_layout');
					if($layout == "normal"){ ?>
					<div class="row-container">
						<div class="<?php echo $containerClass; ?>">
					<?php } ?>
							<div class="content-inner <?php echo $rowClass; ?>">
                                <?php if (!$client->mobile) : ?>
								<?php if($this->countModules('aside-left') && !$hideByOption && !$hideByView){ ?>
								<!-- Left sidebar -->
								<div id="aside-left" class="span<?php echo $asideLeftWidth; ?>">
									<aside role="complementary">
										<jdoc:include type="modules" name="aside-left" style="html5nosize" />
									</aside>
								</div>
								<?php } ?>
                                <?php endif; ?>
								<div id="component" class="span<?php echo $mainContentWidth; ?>">
									<main role="main">    
										<?php if($this->countModules('content-top') && !$hideByView){ ?> 
										<!-- Content-top -->
										<div id="content-top" class="<?php echo $rowClass; ?>">
											<jdoc:include type="modules" name="content-top" style="themeHtml5" />
										</div>
										<?php } ?>   
										<jdoc:include type="message" />
										<jdoc:include type="component" />
										<?php if($this->countModules('content-bottom') && !$hideByOption && !$hideByView && $view !== 'form'){ ?>     
										<!-- Content-bottom -->
										<div id="content-bottom" class="<?php echo $rowClass; ?>">
											<jdoc:include type="modules" name="content-bottom" style="themeHtml5" />
										</div>
										<?php } ?>
									</main>
								</div>
                                <?php if ($client->mobile) : ?>
                                    <?php if($this->countModules('aside-left') && !$hideByOption && !$hideByView){ ?>
                                        <!-- Left sidebar -->
                                        <div id="aside-left" class="span<?php echo $asideLeftWidth; ?>">
                                            <aside role="complementary">
                                                <jdoc:include type="modules" name="aside-left" style="html5nosize" />
                                            </aside>
                                        </div>
                                    <?php } ?>
                                <?php endif; ?>
								<?php if($this->countModules('aside-right') && !$hideByOption && $view !== 'form'){ ?>
								<!-- Right sidebar -->
								<div id="aside-right" class="span<?php echo $asideRightWidth; ?>">
									<aside role="complementary">
										<jdoc:include type="modules" name="aside-right" style="html5nosize" />
									</aside>
								</div>
								<?php } ?>
							</div>
							<?php $layout = $params->get('content_layout');
							if($layout == "normal"){ ?>
						</div>
					</div>
							<?php } ?>
				</div>
				<?php if($this->countModules('video') && !$hideByView){
					echo display_position('video');
				}
				if($this->countModules('mainbottom') && !$hideByView){
					echo display_position('mainbottom');
				}
				if($this->countModules('mainbottom-2') && !$hideByView){
					echo display_position('mainbottom-2');
				}
				if($this->countModules('mainbottom-3') && !$hideByView){
					echo display_position('mainbottom-3');
				}
				if($this->countModules('mainbottom-4') && !$hideByView){
					echo display_position('mainbottom-4');
				}
				if($this->countModules('mainbottom-5') && !$hideByView){
					echo display_position('mainbottom-5');
				}
				if($this->countModules('bottom') && !$hideByView){
					echo display_position('bottom');
				} ?>
				<div id="push"></div>
			</div>
		<div id="footer-wrapper">
			<div class="footer-wrapper-inner">    
				<div id="logofooter">
					<div class="row-container">
						<div class="<?php echo $containerClass; ?>">
							<div class="<?php echo $rowClass; ?>">
								<div class="logofoot span<?php echo $params->get('footerWidth'); ?>">
									<?php if($params->get('footerLogo')){ ?>
									<!-- Footer Logo -->
									<a class="footer_logo" href="<?php echo JURI::base(); ?>"><img src="<?php echo $footerLogo; ?>" alt="<?php echo $sitename; ?>"></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if($this->countModules('footer')){
				echo display_position('footer');
				} ?>
				<!-- Copyright -->
				<div id="copyright" role="contentinfo">
					<div class="row-container">
						<div class="<?php echo $containerClass; ?>">
							<div class="<?php echo $rowClass; ?>">
								<jdoc:include type="modules" name="copyright" style="themeHtml5" />
								<div class="copyright">
									<span class="siteName"><?php echo $sitename; ?></span>
									<?php
									if($params->get('footerCopy')) echo '<span class="copy">&copy;</span>';
									if($params->get('footerYear')) echo '<span class="year">'.date('Y').'</span>';
									if($params->get('privacyLink')){ ?>
									<a class="privacy_link" rel="license" href="<?php echo $privacy_link_url; ?>"><?php echo $params->get('privacy_link_title'); ?></a>
                                        &nbsp;|&nbsp;
                                    <a class="privacy_link" rel="license" href="index.php/terms-and-conditions">Terms &amp; Conditions</a>
									<?php } ?>
								</div>
								<?php echo $todesktop; ?>
								<!-- {%FOOTER_LINK} -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
		if($this->countModules('fixed-sidebar-left')){ ?>
			<jdoc:include type="modules" name="fixed-sidebar-left" style="none"/>
		<?php }
		if($this->countModules('fixed-sidebar-right')){ ?>
		<div id="fixed-sidebar-right">
			<jdoc:include type="modules" name="fixed-sidebar-right" style="sidebar"/>
		</div>
		<?php }
		if($params->get('totop')){ ?>
		<div id="back-top">
			<a href="#"><span></span><?php echo $params->get('totop_text') ?></a>
		</div>
		<?php } ?>

		<jdoc:include type="modules" name="debug" style="none" />
		<?php if(($client->platform == JApplicationWebClient::IPHONE || $client->platform == JApplicationWebClient::IPAD) && ((isset($_COOKIE['disableMobile']) && $_COOKIE['disableMobile']=='false') || !isset($_COOKIE['disableMobile']))){ ?>
		<script src="<?php echo $jspath; ?>ios-orientationchange-fix.js"></script>
		<?php }
		if($client->mobile){ ?>
		<script src="<?php echo $jspath; ?>desktop-mobile.js"></script>
		<?php }
		 ?>
		<script type="text/javascript">
			var path = "<?php echo JURI::base().'/templates/'.$template ?>",
			isMobile = "<?php echo $client->mobile ? 'true' : 'false'; ?>";
		</script>
		<script src="<?php echo $jspath; ?>scripts.js"></script>
		</div>
		<?php if($this->countModules('newsletter')){ ?>
			<jdoc:include type="modules" name="newsletter" style="none"/>
		<?php } ?>
		<div class="modalTmbox"> </div>
	</body>
</html>
