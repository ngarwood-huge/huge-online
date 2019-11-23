<?php defined( '_JEXEC' ) or die; 

$this->setGenerator(null);
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$tpath = $this->baseurl.'/templates/'.$this->template;


?><!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
  <script type="text/javascript" src="<?php echo $tpath ?>/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $tpath ?>/js/jquery-migrate.min.js"></script>

  <jdoc:include type="head" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- mobile viewport optimized -->
  <?php include_once JPATH_THEMES.'/'.$this->template.'/logic.php'; // load logic.php ?>
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
</head>

<body id="print" class="<?php echo $view; ?>">
  <div id="overall">
    <jdoc:include type="message" />
    <jdoc:include type="component" />
  </div>
  <?php 
      /*if ($_GET['print'] == '1') echo '<script type="text/javascript">window.print();</script>'; */
  ?>
</body>
</html>