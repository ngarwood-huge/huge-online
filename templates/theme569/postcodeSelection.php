<?php defined( '_JEXEC' ) or die; ?>

<!DOCTYPE html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>

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
        <!-- Top row -->

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
        
                        <div class="main">
                            <div class="row">            
  
            
                                    <!-- Main content area -->
                                    <div class="main-content">
                                    
                                    <jdoc:include type="component" />
                                    </div>
                                      
                                
                            </div>          
                        </div>
                    </div>
                </div>
               
                 
                        
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

                </div>
            </div>
          </div>
        </div>
		<?php endif; ?>
        <!-- Footer row -->
     <?php if ($this->countModules( 'footer-a' ) || $this->countModules( 'footer-b' ) || $this->countModules( 'footer-c' ) || $this->countModules( 'footer-d' ) || $this->countModules( 'copyright' )): ?>
        <div class="footer-row">
          <div class="container">
            <div class="footer">
              <div class="row">
                <?php if ($this->countModules( 'footer-a' )): ?>
                  <div class="col-md-4 col-lg-4 col-sm-4">
                    <jdoc:include type="modules" name="footer-a" style="vmBasic"/>
                  </div>
                <?php endif; ?>
              <?php /*?>  <?php if ($this->countModules( 'footer-c' )): ?>
                  <div class="col-md-3 col-lg-3 col-sm-4">
                    <jdoc:include type="modules" name="footer-c" style="vmBasic"/>
                  </div>
                <?php endif; ?><?php */?>
                 <?php if ($this->countModules( 'footer-b' )): ?>
                  <div class="col-md-4 col-lg-4 col-sm-4">
                    <jdoc:include type="modules" name="footer-b" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                 <?php if ($this->countModules( 'footer-c' )): ?>
                  <div class="col-md-4 col-lg-4 col-sm-4">
                    <jdoc:include type="modules" name="footer-c" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                </div>
                </div>
                </div>
          
        </div>
          <?php endif; ?> 
        <!-- Copyright row -->
        <div class="copyright-row">
          <div class="container">
            <?php if ($this->countModules( 'copyright' )): ?>
              <div class="copyright">
                 <jdoc:include type="modules" name="copyright" style="vmNotitle"/>
              </div>   
             <?php endif; ?>
          </div>
        </div>
    </div>
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

</body>
</html>

