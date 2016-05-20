<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('mc', 'Login');
$this->breadcrumbs=array(
    Yii::t('mc', 'Login'),
);

?>
<style>
body{
	background-image: url('images/minecraft_repainted_by_griffsnuff-d79wp4u.png') !important;
	background-size: 100% 100%;
    background-repeat: no-repeat;
}
#left_panel{
display:none !important;
}
#right_panel{
background-color:transparent !important;
}
#usage_panel {
background-color:transparent !important;
}
#header_panel{
display:none;
}
.copy
{
background-color:transparent !important;
color:#dfe0e6;
opacity:0.5;
}
.copy a{
color:#dfe0e6;
}
</style>

<?php if (Yii::app()->user->hasFlash('login')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('login'); ?>
</div>
<?php endif ?>

<?php if (Yii::app()->params['demo_mode'] != 'enabled'): ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableAjaxValidation'=>false,
)); ?>

   <div style="max-width:390px; margin:0 auto; background-color: rgba(27, 29, 34, 0.5); padding-top:15px; padding-left:30px; padding-right:30px; padding-bottom:30px; border-radius:5px;">
   <h1 style="text-align:center; margin-bottom:20px; color:#dfe0e6;" class="form-signin-heading h2">登录帐号</h1>
   <h2 style="text-align:center; margin-bottom:20px; color:#dfe0e6; font-size:14px !important; letter-spacing:3px;" class="form-signin-heading h2">Minecraft服务器管理</h2>
    <div class="row">
    
        <?php echo $form->textField($model,'name', array('class'=>'form-control', 'placeholder'=>'Login', 'style'=>'text-align:center; height:45px; border-radius:0px;')); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">

        <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'Password', 'style'=>'text-align:center; height:45px; border-radius:0px; margin-top:20px;')); ?>
        <?php echo $form->error($model,'password'); ?>
        <?php if (Yii::app()->params['reset_token_hours'] > 0): ?>
        <br/>
        <?php echo CHtml::link(Yii::t('mc', 'Forgot password?'), array('site/requestResetPw'), array('style'=>'font-size: 11px')); ?>
        <?php endif ?>
    </div>

    <div class="row checkbox checkbox-inline" style="float:left; margin-top:20px; color:#dfe0e6;">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </div>
    

    <div class="row checkbox checkbox-inline" style="float:right; margin-top:20px; margin-bottom:20px; color:#dfe0e6;">
        <?php echo $form->checkBox($model,'ignoreIp'); ?>
        <?php echo $form->label($model,'ignoreIp'); ?>
        <?php echo $form->error($model,'ignoreIp'); ?>
    </div>

    <div class="row buttons">
        <button class="btn btn-lg btn-primary btn-block loginbtn" name="login" type="submit">LOGIN</button>
        
<?php if (!Yii::app()->params['register_disabled']): ?>
<p style="text-align: center; color:#dfe0e6;"><br><?php echo CHtml::link(Yii::t('mc', 'Register here'), array('site/register')) ?> <?php echo Yii::t('mc', 'if you don\'t have an account yet.') ?></p>
<?php endif ?>
    </div>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->

<?php else: ?>
<h1>Demo mode</h1>
<table>
<tr>
<td>
<?php echo CHtml::beginForm() ?>
<?php echo CHtml::hiddenField('LoginForm[name]', 'admin') ?>
<?php echo CHtml::hiddenField('LoginForm[password]', 'admin') ?>
<?php echo CHtml::submitButton('Log me in as Administrator', array('style'=>'width: 180px')); ?>
<?php echo CHtml::endForm() ?>
</td>
<td>
Create servers &amp; users
</td>
</tr>
<tr>
<td>
<?php echo CHtml::beginForm() ?>
<?php echo CHtml::hiddenField('LoginForm[name]', 'owner') ?>
<?php echo CHtml::hiddenField('LoginForm[password]', 'owner') ?>
<?php echo CHtml::submitButton('Log me in as Server Owner', array('style'=>'width: 180px')); ?>
<?php echo CHtml::endForm() ?>
</td>
<td>
Edit server settings, assign permissions to users/players, define custom commands
</td>
</tr>
<tr>
<td>
<?php echo CHtml::beginForm() ?>
<?php echo CHtml::hiddenField('LoginForm[name]', 'user') ?>
<?php echo CHtml::hiddenField('LoginForm[password]', 'user') ?>
<?php echo CHtml::submitButton('Log me in as normal User', array('style'=>'width: 180px')); ?>
<?php echo CHtml::endForm() ?>
</td>
<td>
Edit assigned players, use functions for assigned player
</td>
</tr>
</table>
<br/>
<br/>
<div class="infoBox">
<b>Note</b><br/>
Servers are not running and can't be stopped/restarted.<br/>
</div>

<?php endif ?>
