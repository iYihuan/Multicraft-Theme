<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--
    -
    -   Copyright © 2010-2012 by xhost.ch GmbH
    -
    -   All rights reserved.
    -
    -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rev="made" href="mailto:multicraft@xhost.ch">
    <meta name="description" content="Multicraft: The Minecraft server control panel">
    <meta name="keywords" content="Multicraft, Minecraft, server, management, control panel, hosting">
    <meta name="author" content="xhost.ch GmbH">
    <title>MC互联-控制面板</title>
    <!-- Bootstrap -->
    <link href="<?php echo Theme::css('bootstrap.css') ?>" rel="stylesheet">
    <link href="<?php echo Theme::css('style.css') ?>" rel="stylesheet">
    <link href="<?php echo Theme::css('font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo Theme::css('dataTables.bootstrap.css') ?>"  rel="stylesheet">
    <link href="<?php echo Theme::css('main.css') ?>"  rel="stylesheet">
    <link href="<?php echo Theme::css('form.css') ?>"  rel="stylesheet">
    <link href="<?php echo Theme::css('theme.css') ?>"  rel="stylesheet">
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<body>

<div class="container" style="margin-top:55px; min-width:960px; overflow:hidden; display: table; margin-bottom:55px;">

    <?php echo $content; ?>

</div>

</body>
<script type="text/javascript">
var divHeight = $('#mastercontainer').height(); 
$('#left_panel').css('min-height', divHeight+'px');
$('#side_menu').css('min-height', divHeight+'px');
</script>
<!--  C o p y r i g h t   (c)   2 0 1 0 - 2 0 1 2   b y   x h o s t . c h   G m b H .   A l l   r i g h t s   r e s e r v e d .  -->
</html>
