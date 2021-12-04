<!DOCTYPE html>
<html>
  <head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Admin</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <!--div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div-->
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">

	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">


	                          <li><?php if(Yii::app()->user->isGuest) {?><?php echo CHtml::link('Login',array('/backend/site/login')); ?><?php }else{?>
	                          	<?php echo CHtml::link('Logout ('.Yii::app()->user->name.')', array('/backend/site/logout')); }?>
	                          	

	                          <!--li><a href="login.html">Logout</a></li-->
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
    		<?php if(!Yii::app()->user->isGuest) {?>
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <!--li  class="current"><?php echo CHtml::link('Product',array('product/index')); ?></li-->
                    <!--li><?php echo CHtml::link('Company',array('company/index')); ?></li-->
                    <!--li><?php echo CHtml::link('Shipment',array('shipmentinfo/index')); ?></li-->
                    <li><?php echo CHtml::link('Member',array('/backend/member/admin')); ?></li>
                    <!--li><?php echo CHtml::link('Admin user',array('adminUser/index')); ?></li-->
                    <li><?php echo CHtml::link('Order',array('/backend/Order/admin')); ?></li>
                    <!--li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li-->
                    <!--li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                         </a>

                         <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li-->
                </ul>
             </div>
		  </div>
		  <?php } ?>
		  <div class="col-md-10">
		  	<?php echo $content;?>
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>
            
         </div>
      </footer>


   
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/custom.js"></script>
  </body>
</html>
