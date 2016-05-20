<?php if ($cpu !== null || $memory !== null): ?>
<br/>
<br/>
<table style="width: 100%" class="stdtable">
<tr class="titlerow"> 
    <td><?php echo Yii::t('mc', 'Resource usage') ?></td>
</tr>

<tr><td></td></tr>
</table>
<div style="float: left; width: 50%;"><?php echo Yii::t('mc', 'CPU') ?></div>
<div style="float: left"><?php echo Yii::t('mc', 'Memory') ?></div>
<div style="clear: both"></div>
<div style="float: left; width: 50%;">
    <div id="resource_cpu" class="progress" style="width: 82%; position: relative; color:#ffffff;">
        <div class="progress-bar" style="width: <?php echo $cpu ?>%; height: 100%">&nbsp;</div>
        <div style="width: 100%; position: absolute; top: 0; left: 0;  padding-top:2px; height: 100%; text-align: center; font-size:11px;"><?php echo $cpu ?>%</div>
    </div>
</div>
<div id="resource_cpu" class="progress" style="float: left; width: 41%; position: relative; color:#ffffff;">
    <div class="progress-bar" style="width: <?php echo $memory ?>%; height: 100%">&nbsp;</div>
    <div style="width: 100%; position: absolute; top: 0; left: 0; padding-top:2px; height: 100%; text-align: center; font-size:11px;"><?php echo $memory ?>%</div>
</div>
<div style="clear: both"></div>
<br/>
<?php endif ?>
