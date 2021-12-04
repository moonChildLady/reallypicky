<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ReallyPicky</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
        <meta http-equiv="cleartype" content="on">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/touch/apple-touch-icon-57x57-precomposed.png">
        <link rel="shortcut icon" sizes="196x196" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/touch/touch-icon-196x196.png">
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/touch/apple-touch-icon.png">
        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="<?php echo Yii::app()->theme->baseUrl; ?>/img/touch/apple-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#222222">
        
        <!-- SEO: If mobile URL is different from desktop URL, add a canonical link to the desktop page -->
        <link rel="canonical" href="http://www.example.com/" >
        
        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">

        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/normalize.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tabox.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pdtslider.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.mmenu.all.css" />
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/modernizr-2.6.2.min.js"></script>


        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 

  ga('create', 'UA-52353943-1', 'auto');
  ga('set', 'userId', <?php echo "'".Yii::app()->session['token']['token']."'";?>); 
  ga('set', 'campaignSource', <?php echo "'".Yii::app()->session['utm']['utm_source']."'";?>); 
  ga('set', 'campaignMedium', <?php echo "'".Yii::app()->session['utm']['utm_medium']."'";?>); 
  ga('set', 'campaignContent', <?php echo "'".Yii::app()->session['utm']['utm_content']."'";?>); 
  ga('set', 'compaignName', <?php echo "'".Yii::app()->session['utm']['utm_campaign']."'";?>); 
  ga('send', 'pageview');

// Set the user ID using signed-in user_id.
  
</script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

<!-- header start -->

<!--#include virtual="ssi/header.shtml"-->

<nav id="menu">
    
  <ul>

    <li><span class="mm-title"><?php echo Yii::app()->session['memberinfo']['displayname'];?> 歡迎您!</span></li>
  <?php if(isset(Yii::app()->session['memberinfo'])) { ?><li><a href="/member/logout">登出</a></li><?php }else { ?>
    <li><a href="/member/login">註冊 | 登入</a></li><?php } ?>
    <li style="margin-top:10px; line-height:1px;"></li>
    <li><a href="/">活動首頁</a></li>
    <li><a href="/member/membercenter">帳戶管理</a></li>
    <li><a href="/order">訂單狀態</a></li>
    <li><a href="/order/notice">購物須知</a></li>
    <li><a href="/order/deliverynote">送貨服務</a></li>
    <li><a href="/member/tnc">使用條款</a></li>
    <li><a href="/member/privacy">私隱政策</a></li>
    <li><a href="mailto:reallypicky@aster.com.hk">查詢或協助</a></li>
    
      
  </ul>

</nav>
<!-- main content -->
<div class="header-container">
    <header class="wrapper htitle clearfix">
    <div class="hlogo"><a href="/">ReallyPicky</a></div>
    <div class="hmenu"><a href="#menu">menu</a></div>
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ae-title.png" alt="雅施精挑細選購物優惠" width="204" height="22" />
    </header>
</div>
<div class="main-container">
	<div class="main wrapper clearfix">


		<?php echo $content; ?>
	</div>
</div>

<!-- footer start -->

<div class="footer-container">
    <footer class="wrapper">
    <div class="finner clearfix">
        <div class="fbl"><span>Aster HK 香港雅施</span></div>
      <div class="fbr"><span>ReallyPicky</span></div>
    </div>
        <div class="fcr">&copy; 2014 Sotfpub.com Ltd</div>
    </footer>
</div>
<?php 
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/vendor/jquery.mmenu.min.all.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.calculation.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/plugins.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/main.js');
?>
<!--script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery.mmenu.min.all.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.calculation.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script-->
        <script type="text/javascript">
          $(document).ready(function() {
            $("nav#menu").mmenu({
              offCanvas: { position: "right" }
            });
            $('#checkout').click(function(){
    if($("#countryselect").val()=="OO"){
        if($("#Order_country").val().length == 0){
            alert("請輸入其他國家!");
            return false;
        }
    }
});
          });
        </script>

    </body>
</html>
