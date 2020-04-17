<?php defined( '_JEXEC' ) or die; ?>

<!DOCTYPE html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
<!-- NEW INDEX PAGE -->
  <?php include_once JPATH_THEMES.'/'.$this->template.'/logic.php'; // load logic.php ?>
  <script type="text/javascript" src="<?php echo $tpath ?>/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $tpath ?>/js/jquery-migrate.min.js"></script>
  <jdoc:include type="head" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
  <!--[if lte IE 8]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <?php if ($pie==1) : ?>
      <style> 
        {behavior:url(<?php echo $tpath; ?>/js/PIE.htc);}
      </style>
    <?php endif; ?>
  <![endif]-->
   <!--[if lt IE 9]><div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div><![endif]-->      
	<script type="text/javascript">
    	var animate =  '<?php echo $animation; ?>';
    </script>
</head>
  
<body class="<?php echo 
  ( ($menu->getActive() == $menu->getDefault()) ? ('front') : ('page') ).' '.
  ( ($active) ? ($active->alias) : ('') ) .' '.
  $pageclass . ' ' . $view ; ?>">
<div id="wrapper" class="z-index">
	<div class="cotainer-top">
        <!-- Header row -->
          <div class="header-row">
                    <div class="header">
                         <div class="container">
                             <div class="row">
                                 <div class="col-md-4 col-lg-4 col-sm-4">
                                  <div class="logo-fleft">
                                      <!-- Site logo / title / description -->
                                      <div class="site-logo site-logo__header">
                                        <a class="site-logo_link" href="<?php echo $this->baseurl ?>">
                                          <?php if ($logo): ?>
                                            <img class="site-logo_img" src="<?php echo $this->baseurl . "/" . htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
                                          <?php else: ?>
                                            <?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
                                          <?php endif; ?>
                                        </a>
                    
                                        <span class="site-desc">
                                          <?php echo htmlspecialchars($templateparams->get('sitedescription'));?>
                                        </span>
                                      </div>
                                    </div>
                               </div> 
                               
                                  <div class="col-md-8 col-lg-8 col-sm-8">
                                	  <div class="row">
                                            <div class="col-md-10 col-lg-10 col-sm-10">
                                           		<div class="fright">
                                                	<jdoc:include type="modules" name="top-a" style="vmBasic"/>
                                                    <div class="clearfix"></div>
                                              		<jdoc:include type="modules" name="top-c" style="vmBasic"/>
                                                    <div class="clearfix"></div>
                                              		<jdoc:include type="modules" name="top-b" style="vmBasic"/>
                                                    <div class="clearfix"></div>
                                             	</div> 
                                            </div>
                                            <div class="col-md-2 col-lg-2 col-sm-2">
                                        	   <jdoc:include type="modules" name="header-a" style="vmBasic"/>
                                            </div>
                                            
                                      </div>
                              		
                              	  </div>
                               </div>
                           </div>
                      </div>       
                </div>  
                 <div class="navigation">
                     <!-- Header module position -->
                    <?php if ($this->countModules( 'navigation' )): ?>
                    <div class="container">
                         <jdoc:include type="modules" name="navigation" style="raw"/>
                    </div>     
                    <?php endif; ?>
                 </div> 
                 <?php if (($this->countModules( 'showcase' ) || $this->countModules( 'galerific' ))&& ($view !=='search')): ?>
                <!-- Showcase row -->
                    <div class="showcase-row">
                        <div class="showcase">
                              <jdoc:include type="modules" name="showcase" style="vmNotitle"/>
                              <?php if ($this->countModules( 'galerific' ) && ($view !=='search')): ?>
                             <div id="galerific-banner">
                               <div class="container">
                                    <jdoc:include type="modules" name="galerific" style="vmBasic"/>
                                </div>
                            </div>  
                             <div class="clearfix"></div>  
                         <?php endif; ?>    
                          </div>
                    </div>
                <?php endif; ?>   
         <div class="clearfix"></div>
        </div>
 	</div>  


                <!-- Main row -->
                <div class="main-row">
                    <div class="container">
                        
                        <?php if ($this->countModules( 'main-top' ) && ($view !=='search')): ?>
                        <div class="main-top">
                            <jdoc:include type="modules" name="main-top" style="vmBasic"/>
                        </div>
                        <?php endif; ?>
                        <!-- ******************* MAIN CONTAINER ****************** -->
                        <div class="main">
                            <div class="row">            
                                <?php if ($this->countModules( 'aside-left' ) && !$hide_asides): ?>
                                  <!-- Left aside -->
                                  <div class="col-md-<?php echo $aside_width; ?>">
                                    <div class="aside aside__left">
                                      <jdoc:include type="modules" name="aside-left" style="vmBasic"/>
                                    </div>
                                  </div>
                                <?php endif; ?>
        
                                <div class="col-md-<?php echo $content_width; ?>">
                                 <jdoc:include type="modules" name="breadcrumbs" style="vmNotitle"/>

                                    <?php if ($this->countModules( 'content-top' ) && ($view !=='search')): ?>
                                        <!-- Top content -->
                                        <div class="top-content">
                                            <jdoc:include type="modules" name="content-top" style="vmBasic"/>
                                        </div>
                                    <?php endif; ?>
            
                                    <!-- Main content area -->
                                    <div class="main-content">
                                        <?php if($menu->getActive() == $menu->getDefault()): ?>
                                        <div w3-include-html="home/index.html"></div>
                                        <?php else: ?>
                                            <?php if(count($app->getMessageQueue())): ?>
                                                <jdoc:include type="message" />
                                            <?php endif; ?>
                                            <jdoc:include type="component" />
                                        <?php endif; ?>
                                    </div>
        
                                    <?php if ($this->countModules( 'content-bottom' )&& ($view !=='search')): ?>
                                        <!-- bottom content -->
                                        <div class="bottom-content">
                                            <jdoc:include type="modules" name="content-bottom" style="vmBasic"/>
                                        </div>
                                    <?php endif; ?>					
                                </div>
        
                                <?php if ($this->countModules( 'aside-right' ) && !$hide_asides): ?>
                                  <!-- Right aside -->
                                  <div class="col-md-<?php echo $aside_width; ?>">
                                    <div class="aside aside__right">
                                      <jdoc:include type="modules" name="aside-right" style="vmBasic"/>
                                    </div>
                                  </div>
                                <?php endif; ?>
                            </div>          
                        </div>
                    </div>
                </div>
                <?php if ($this->countModules( 'video-bottom' )): ?>
                    <div id="video-bottom-un" class="video-section">
                            <div class="container">
                                <jdoc:include type="modules" name="video-bottom" style="vmBasic"/>
                            </div>
                    </div>
                <?php endif; ?>
                 <?php if ($this->countModules( 'custom-html' )): ?>
                    <div id="custom-html">
                            <div class="container">
                                <jdoc:include type="modules" name="custom-html" style="vmBasic"/>
                            </div>
                    </div>
                <?php endif; ?>
        		<?php if ($this->countModules( 'paralax-bottom' )): ?>
                        <div id="parallax-bottom-un" class="stellar-section">
                        <div class="container">
                            <jdoc:include type="modules" name="paralax-bottom" style="vmBasic"/>
                        </div>    
                    </div>
                <?php endif; ?>
                 <?php if ($this->countModules( 'main-bottom-a' ) || $this->countModules( 'main-bottom-b' ) || $this->countModules( 'main-bottom-c' ) || $this->countModules( 'main-bottom-d' )): ?>
                  <div class="main-bottom">
                  		<div class="container">
                        	<div class="row">
                              <?php if ($this->countModules( 'main-bottom-a' )): ?>
                                  <div class="col-md-2 col-lg-2 col-sm-4">
                                    <jdoc:include type="modules" name="main-bottom-a" style="vmBasic"/>
                                  </div>
                              <?php endif; ?>
                              <?php if ($this->countModules( 'main-bottom-d' )): ?>
                                  <div class="col-md-2 col-lg-2 col-sm-4">
                                    <jdoc:include type="modules" name="main-bottom-d" style="vmBasic"/>
                                  </div>
                              <?php endif; ?>
                              <?php if ($this->countModules( 'main-bottom-b' )): ?>
                                  <div class="col-md-4 col-lg-4 col-sm-4">
                                    <jdoc:include type="modules" name="main-bottom-b" style="vmBasic"/>
                                  </div>
                              <?php endif; ?>
                              <?php if ($this->countModules( 'main-bottom-c' )): ?>
                                  <div class="col-md-4 col-lg-4 col-sm-12">
                                    <jdoc:include type="modules" name="main-bottom-c" style="vmBasic"/>
                                  </div>
                              <?php endif; ?>
                            </div>   
                        </div>
                 </div>       
                 <?php endif; ?>
                        
                <div id="push"></div>
		
    <div id="footer">
        <!-- Bottom row -->
        <?php if (position_enabled(array('bottom-a', 'bottom-b'/*, 'bottom-c', 'bottom-d'*/))): ?>
        <div class="bottom-row">
          <div class="container">
            <div class="bottom">
              <div class="row">
                <?php if ($this->countModules( 'bottom-a' )): ?>
                  <div class="col-md-6">
                    <jdoc:include type="modules" name="bottom-a" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                <?php if ($this->countModules( 'bottom-b' )): ?>
                  <div class="col-md-6">
                    <jdoc:include type="modules" name="bottom-b" style="vmBasic"/>
                  </div>
                <?php endif; ?>

                <?php /*if ($this->countModules( 'bottom-c' )): ?>
                  <div class="col-md-3">
                    <jdoc:include type="modules" name="bottom-c" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                <?php if ($this->countModules( 'bottom-d' )): ?>
                  <div class="col-md-3">
                    <jdoc:include type="modules" name="bottom-d" style="vmBasic"/>
                  </div>
                <?php endif;*/ ?>
              </div>
            </div>
          </div>
        </div>
		<?php endif; ?>
        <!-- Footer row -->
     <?php if ($this->countModules( 'footer-a' ) || $this->countModules( 'footer-b' ) || $this->countModules( 'footer-c' ) || $this->countModules( 'footer-d' ) || $this->countModules( 'copyright' )): ?>
        <!-- START NEW FOOTER -->
         <!--   FOOTER START================== -->
        <!-- <div class="footer-row"> <!-- original footer container -->
         <footer class="footer">
             <div class="container">
                 <div class="row">
                     <div class="col-sm-3">
                         <h4 class="title">Sumi</h4>
                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin suscipit, libero a molestie consectetur, sapien elit lacinia mi.</p>
                         <ul class="social-icon">
                             <a href="#" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                             <a href="#" class="social"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                             <a href="#" class="social"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                             <a href="#" class="social"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                             <a href="#" class="social"><i class="fa fa-google" aria-hidden="true"></i></a>
                             <a href="#" class="social"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                         </ul>
                     </div>
                     <div class="col-sm-3">
                         <h4 class="title">My Account</h4>
                         <span class="acount-icon">
            <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> Wish List</a>
            <a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i> Cart</a>
            <a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
            <a href="#"><i class="fa fa-globe" aria-hidden="true"></i> Language</a>
          </span>
                     </div>
                     <div class="col-sm-3">
                         <h4 class="title">Category</h4>
                         <div class="category">
                             <a href="#">men</a>
                             <a href="#">women</a>
                             <a href="#">boy</a>
                             <a href="#">girl</a>
                             <a href="#">bag</a>
                             <a href="#">teshart</a>
                             <a href="#">top</a>
                             <a href="#">shos</a>
                             <a href="#">glass</a>
                             <a href="#">kit</a>
                             <a href="#">baby dress</a>
                             <a href="#">kurti</a>
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <h4 class="title">Payment Methods</h4>
                         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                         <ul class="payment">
                             <li><a href="#"><i class="fa fa-cc-amex" aria-hidden="true"></i></a></li>
                             <li><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i></a></li>
                             <li><a href="#"><i class="fa fa-paypal" aria-hidden="true"></i></a></li>
                             <li><a href="#"><i class="fa fa-cc-visa" aria-hidden="true"></i></a></li>
                         </ul>
                     </div>
                 </div>
                 <hr>
                 <?php if ($this->countModules( 'copyright' )): ?>
                 <div class="row text-center"><jdoc:include type="modules" name="copyright" style="vmNotitle"/>.</div>
                 <?php endif; ?>
             </div>


         </footer>



            <!-- END NEW FOOTER -->
        <!-- </div> -->
        <?php endif; ?>
    <div id="totopscroller"></div>
    <div class="chat-position">
        <jdoc:include type="modules" name="chat" style="vmBasic"/>
    </div>
    <jdoc:include type="modules" name="debug" />
    
    <script type="text/javascript" src="<?php echo $tpath ?>/js/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/tm-stick-up.js"></script>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/scrollUp.min.js"></script>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/vm/scriptsAll.js"></script>
    <?php
    if($animation == '1'){ ?>
    	<script type="text/javascript" src="<?php echo $tpath ?>/js/animate/wow.js"></script>
    <?php } ?>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/scripts.js"></script>
    <script type="text/javascript" src="https://use.fontawesome.com/07b0ce5d10.js"></script>


    <script>
        function includeHTML() {
            var z, i, elmnt, file, xhttp;
            /* Loop through a collection of all HTML elements: */
            z = document.getElementsByTagName("*");
            for (i = 0; i < z.length; i++) {
                elmnt = z[i];
                /*search for elements with a certain atrribute:*/
                file = elmnt.getAttribute("w3-include-html");
                if (file) {
                    /* Make an HTTP request using the attribute value as the file name: */
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            if (this.status == 200) {elmnt.innerHTML = this.responseText;}
                            if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
                            /* Remove the attribute, and call this function once more: */
                            elmnt.removeAttribute("w3-include-html");
                            includeHTML();
                        }
                    }
                    xhttp.open("GET", file, true);
                    xhttp.send();
                    /* Exit the function: */
                    return;
                }
            }
        }
    </script>
    <script>
        includeHTML();
    </script>
</body>
</html>

