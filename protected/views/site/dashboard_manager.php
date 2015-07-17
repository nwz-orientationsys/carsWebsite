<?php
/* @var $this SiteController */

$this->pageTitle='首页';

$day = array(
		'日','一','二','三','四','五','六',
);

$new_customer_num = User::model()->count('DATE(created)>=:today AND type="customer"',array(':today'=>date('Y-m-d')));

$subscribe_num = Orders::model()->count( 'DATE(created) >= :today', array(':today'=>date('Y-m-d')) );
?>
<div class="content">
    <div class="header">
        <h1 class="page-title"><?php echo $this->pageTitle?></h1>
    </div>
    <div class="container-fluid">
    
        <div class="alert in alert-block fade alert-success">
                    今天是  <?php echo date('Y-m-d');?>, 星期 <?php echo $day[date('w')];?>
        </div>
        <div class="alert in alert-block fade alert-success">
                    新注册的用户数 : <?php echo $new_customer_num;?> 。
        </div>
        <div class="alert in alert-block fade alert-success">
                    产品预约个数 ：  <?php echo $subscribe_num?>
        </div>	
    </div>
</div>