<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/
$this->pageTitle = Yii::app()->name . ' - '.Yii::t('mc', 'Server List');

$this->breadcrumbs=array(
    Yii::t('mc', 'Servers'),
);

echo CHtml::css('
#manage { display: none; }
');

if (Yii::app()->user->isSuperuser())
{
    $this->menu=array(
        array(
            'label'=>Yii::t('mc', '<i class="fa fa-plus"></i> '.Yii::t('mc', 'Create Server')),
            'url'=>array('create'),

        ),
        array(
                    'label'=>Yii::t('mc', '<i class="fa fa-user"></i> '.Yii::t('mc', 'Manage Players')),
                    'url'=>array('player/admin'),
                    'visible'=>Yii::app()->user->isSuperuser(),
                ),
                array(
                    'label'=>Yii::t('mc', '<i class="fa fa-keyboard-o"></i> '.Yii::t('mc', 'Manage Commands')),
                    'url'=>array('command/admin'),
                    'visible'=>Yii::app()->user->isSuperuser(),
                ),
                array(
                    'label'=>Yii::t('mc', '<i class="fa fa-clock-o"></i> '.Yii::t('mc', 'Manage Tasks')),
                    'url'=>array('schedule/admin'),
                    'visible'=>Yii::app()->user->isSuperuser(),
                ),
                array(
                    'label'=>Yii::t('mc', '<i class="fa fa-desktop"></i> '.Yii::t('mc', 'Manage Servers')),
                    'url'=>array('server/admin'),
                    'visible'=>Yii::app()->user->isSuperuser(),
                ),
    );
}
else
{
    if (!$my)
    {
        $this->menu[] = array(
            'label'=>Yii::t('mc', '<i class="fa fa-desktop"></i> '.Yii::t('mc', 'My Servers')),
            'url'=>array('server/index', 'my'=>true),
            'visible'=>!Yii::app()->user->isGuest
        );
    }
    else
    {
        $this->menu[] = array(
            'label'=>Yii::t('mc', '<i class="fa fa-arrow-left"></i> '.Yii::t('mc', 'All Servers')),
            'url'=>array('server/index'),
            'visible'=>!Yii::app()->user->isGuest
        );
    }
}
echo CHtml::script('
    imgOpen = "'.Theme::themeFile('images/icons/open.png').'";
    imgClosed = "'.Theme::themeFile('images/icons/closed.png').'";
    menuShown = {}
    function showSub(name)
    {
        menuShown[name] = !menuShown[name];
        $("#"+name+"_main").children("img").attr("src", !menuShown[name] ? imgClosed : imgOpen);
        $("#"+name).stop(true, true).slideToggle(menuShown[name]);
    }
');

if (!!Yii::app()->params['ajax_serverlist'])
    echo CHtml::script('
    function get_status(server)
    {
        '.CHtml::ajax(array(
            'type'=>'POST',
            'dataType'=>'json',
            'data'=>array(
                'ajax'=>'get_status',
                'server'=>'js:server',
                Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken,
                ),
            'success'=>'status_response'
            )).'
    }

    function status_response(data)
    {
        id = parseInt(data["id"]);
        pl = parseInt(data["pl"]);
        img = pl >= 0 ? \''.Theme::img('online.png').'\' : \''.Theme::img('offline.png').'\';
        $("#sv_icon_"+id).html(img);
        if (pl >= 0)
        {
            str = pl;
            $("#sv_maxplr_"+id).show();
            $("#sv_chatlink_"+id).show();
        }
        else
        {
            str = "'.Yii::t('mc', 'Offline').'" + (pl == -2 ? " ('.Yii::t('mc', 'error').')" : "");
        }
        $("#sv_status_"+id).html(str);
    }
');
?>

<?php $this->widget('zii.widgets.CListView', array(
    'emptyText'=>'<br/>'.Yii::t('mc', '<div style="margin-left:40px; padding-top:45px;">Your own servers and other servers you have access to will be listed here.</div>'),
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'ajaxUpdate'=>false,
    'sortableAttributes'=>array(
        'name'=>Yii::t('mc', 'Name'),
    ),
));

