<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('mc', 'Scheduled Tasks');

$this->breadcrumbs=array(
    Yii::t('mc', 'Servers')=>array('server/index'),
    Server::model()->findByPk((int)$sv)->name=>array('server/view', 'id'=>$sv),
    Yii::t('mc', 'Scheduled Tasks'),
);

$this->menu=array(
    array(
        'label'=>Yii::t('mc', '<i class="fa fa-plus-circle"></i> '.Yii::t('mc', 'New Task')),
        'url'=>array('create', 'sv'=>$sv),
    ),
    array(
        'label'=>Yii::t('mc', '<i class="fa fa-keyboard-o"></i> '.Yii::t('mc', 'Manage Tasks')),
        'url'=>array('admin'),
        'visible'=>Yii::app()->user->isSuperuser(),
    ),
    array(
        'label'=>Yii::t('mc', '<i class="fa fa-arrow-left"></i> '.Yii::t('mc', 'Back')),
        'url'=>array('server/view', 'id'=>$sv),

    ),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'schedule-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'ajaxUpdate'=>false,
    'columns'=>array(
        array('name'=>'name', 'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode($data->name), array("schedule/view", "id"=>$data->id))'),
        array('name'=>'scheduled_ts', 'value'=>'$data->scheduled_ts ? @date("'.Yii::t('mc', 'd. M Y, H:i').'", (int)$data->scheduled_ts) : "'.Yii::t('mc', 'Not Scheduled').'"'),
        array('name'=>'interval', 'value'=>'$data->intervalString'),
        array('name'=>'status', 'value'=>'@Schedule::getStatusValues($data->status)'),
        array('name'=>'last_run_ts', 'value'=>'$data->last_run_ts ? @date("'.Yii::t('mc', 'd. M Y, H:i').'", (int)$data->last_run_ts) : "'.Yii::t('mc', 'Never').'"'),
        array('name'=>'hidden', 'value'=>'$data->hidden ? "'.Yii::t('mc', 'Yes').'" : "'.Yii::t('mc', 'No').'"', 'htmlOptions'=>array('style'=>'width: 40px'), 'visible'=>Yii::app()->user->isSuperuser()),
    ),
)); ?>
