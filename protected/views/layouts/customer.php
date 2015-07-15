<?php /* @var $this Controller */Yii::app()->bootstrap->register();?><!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>车辆年检预约系统<?php echo !empty($this->title) ? " | ".Html::encode($this->title) : "";?></title><meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="description" content=""><meta name="author" content=""><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/lib/datepicker/css/datepicker.css"><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/lib/jquery-ui/css/ui-lightness/jquery-ui-1.10.3.custom.css"><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/stylesheets/theme.css"><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/stylesheets/font-awesome-ie7.css"><!-- Demo page code --><style type="text/css">#line-chart {	height: 300px;	width: 800px;	margin: 0px auto;	margin-top: 1em;}
.brand {	font-family: georgia, serif;}
.brand .first {	color: #ccc;	font-style: italic;}
.brand .second {	color: #fff;	font-weight: bold;}.content {    background: #fff none repeat scroll 0 0;    border-left: 1px solid #111;    margin: 0 auto;    max-width: 1000px;    min-height: 800px;    min-width: 400px;    position: relative;    vertical-align: middle;}</style>
</head>
<body class="">    <div class="navbar">        <div class="navbar-inner">            <ul class="nav pull-right">                <li id="fat-menu" class="dropdown">                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">                        <i class="icon-user"></i>                        <?php echo Yii::app()->user->name?>                        <i class="icon-caret-down"></i>                    </a>                    <ul class="dropdown-menu">                        <li>                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('user/passwordupdate');?>">修改密码</a>                        </li>                        <li class="divider"></li>                        <li>                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('site/logout');?>">退出</a>                        </li>                    </ul>                </li>            </ul>            <a class="brand" href="<?php echo Yii::app()->homeUrl;?>">                <span class="first">车辆年检预约系统</span> <span class="second">用户中心</span>            </a>
        </div>
    </div>
            <div class="content">        <div class="header">            <h1 class="page-title">                我的信息            </h1>        </div>        <?php if(!empty($this->breadcrumbs)):?>        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(                'links'=>$this->breadcrumbs,                ));        ?>        <?php endif;?>        <!-- breadcrumbs -->        <div class="container-fluid">            <div class="row-fluid">                <?php echo $content;?>            </div>        </div>    </div>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/lib/jquery-ui/js/jquery-ui-1.10.3.custom.js"></script>    <script src="<?php echo Yii::app()->theme->baseUrl;?>/lib/jquery-ui/js/jquery.ui.datepicker-zh-CN.min.js"></script>    <script type="text/javascript">        $("[rel=tooltip]").tooltip();        $(function() {            $('.demo-cancel-click').click(function(){return false;});            $('body').on('focus',".datepicker", function(){                    $(this).removeClass('hasDatepicker');                    $(this).datepicker({changeMonth:true,changeYear:true});            });            var menu='';            <?php if(isset($_GET['menu'])){?>            menu=<?php echo $_GET['menu'];?>;            $('.sidebar-nav ul:eq('+menu+')').addClass('in');            //$('.sidebar-nav ul:not('+menu+')').removeClass('in');            <?php }?>        });            </script></body></html>