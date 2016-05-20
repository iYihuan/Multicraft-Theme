<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container" id="mastercontainer" style="min-width:960px; height:100%; overflow: auto;  padding:0px;">
<?php
$id      = Yii::app()->user->id;
$getbase = Yii::app()->request->hostInfo . Yii::app()->baseUrl;
$default = "$getbase/images/gravatar2.png";
$size    = 50;

$results = Yii::app()->db->createCommand()->
          select('email')->
          from('user')->
          where('id=:id', array(':id'=>$id))->
          limit(1)->
          queryAll();

if(count($results) > 0) {
    $email = $results['0']['email'];
}
else
{
    $email = null;
}

?>
<div id="left_panel">
    <div id="side_menu">
    <br>
        <?php
        $items = array();

        $simple = (Yii::app()->theme && in_array(Yii::app()->theme->name, array('simple', 'mobile', 'platform')));
        if (!$simple)
            $items[] = array('label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-home"></i></p>'), 'url'=>array('/site/page', 'view'=>'home'));
        if (@Yii::app()->params['installer'] !== 'show')
        {
            $items[] = array(
                'label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-list"></i></p>'),
                'url'=>array('/server/index', 'my'=>($simple && !Yii::app()->user->isSuperuser() ? 1 : 0)),
            );
            $items[] = array(
                'label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-users"></i></p>'),
                'url'=>array('/user/index'),
                'visible'=>(Yii::app()->user->isSuperuser()
                    || !(Yii::app()->user->isGuest || (Yii::app()->params['hide_userlist'] === true) || $simple)),
            );
            $items[] = array(
                'label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-user"></i></p>'),
                'url'=>array('/user/view', 'id'=>Yii::app()->user->id),
                'visible'=>(!Yii::app()->user->isSuperuser() && !Yii::app()->user->isGuest
                    && ((Yii::app()->params['hide_userlist'] === true) || $simple)),
            );
            $items[] = array(
                'label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-cog"></i></p>'),
                'url'=>array('/daemon/index'),
                'visible'=>Yii::app()->user->isSuperuser(),
            );
            $items[] = array(
                'label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-question"></i></p>'),
                'url'=>array('/site/report'),
                'visible'=>!empty(Yii::app()->params['admin_email']),
            );
        }
        if (Yii::app()->user->isGuest)
        {
            $items[] = array(
                'label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-lock"></i></p>'),
                'url'=>array('/site/login'),
                'itemOptions'=>$simple ? array('style'=>'float: right') : array(),
            );
        }
        else
        {
            $items[] = array(
                'label'=>Yii::t('mc', '<p style="text-align: center;"><i class="fa fa-power-off"></i></p>', array('{name}'=>Yii::app()->user->name)),
                'url'=>array('/site/logout'),
                'itemOptions'=>$simple ? array('style'=>'float: right') : array(),
            );
        }
        $items[] = array(
            'label'=>Yii::t('mc', 'About'),
            'url'=>array('/site/page', 'view'=>'about'),
            'visible'=>$simple,
            'itemOptions'=>array('style'=>'float: right'),
        );
        
        
        $this->widget('zii.widgets.CMenu',array('items'=>$items,'encodeLabel' => false, 'id' => "sidemenu")); ?>
        <?php if (!$simple): ?>
        <div class="notice"><?php echo $this->notice ?></div>
        <?php endif ?>
    
    </div>
    <div id="domain_list" spellcheck="false"> 
    <div class="your_domains">Menu</div>
    <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>end($this->breadcrumbs),
                'hideOnEmpty'=>false,
            ));
            $this->widget('application.components.Menu', array(
                'items'=>$this->menu,
                'encodeLabel' => false,
                'htmlOptions'=>array('class'=>'operations'),
            ));
            $this->endWidget();
        ?>
    <?php
        if (!!Yii::app()->params['ajax_serverlist'] && !$data->suspended)
            echo CHtml::script('get_status('.$data->id.');')
    ?>
    </div>
    </div>
    
    
    
    
    
    <div id="right_panel">
    <div id="header_panel">
    <div class="domain"><?php echo CHtml::encode($this->pageTitle); ?></div>
    </div>
    <div id="content">
    <div id="usage_panel">
    <?php echo $content; ?>
    </div>
    </div>
    </div>
    
<?php $this->endContent(); ?>

