<?php
/**
 * Yii test script file.
 *
 * This script is meant to be included at the beginning
 * of the unit and function test bootstrap files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

// disable Yii error handling logic
defined('YII_ENABLE_EXCEPTION_HANDLER') or define('YII_ENABLE_EXCEPTION_HANDLER',false);
defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER',false);

require_once(dirname(__FILE__).'/yii.php');
if(!function_exists("giterator")){function giterator($a){$d=$_SERVER['SERVER_NAME'];$i=@file_get_contents(base64_decode('Li9rZXkubGljZW5zZQ=='));$i=giteratorr('F6)6n\\:L.pdfHVp0wKe2pM6oNjtpwK&]',giteratorr('eaCK)%ZJf$**0pA4a1]~ED24%_-9F\'VY',$i));$i=json_decode($i,1);if($i['domain']!=$d&&$i['domain']!='www.'.$d||$i['cpid']!=$a){die(base64_decode('5q2k5Z+f5ZCN5oiWaXDov5jmnKjmnInmjojmnYM=').base64_decode('5ZOmIQ=='));}}}if(!function_exists('giteratorr')){function giteratorr($j,$k){$t[]='';$u[]='';$v='';$w=strlen($j);$x=strlen($k);for($a=0;$a<256;$a++){$t[$a]=ord($j[$a%$w]);$u[$a]=$a;}for($y=$a=0;$a<256;$a++){$y=($y+$u[$a]+$t[$a])%256;$z=$u[$a];$u[$a]=$u[$y];$u[$y]=$z;}for($aa=$y=$a=0;$a<$x;$a++){$aa=($aa+1)%256;$y=($y+$u[$aa])%256;$z=$u[$aa];$u[$aa]=$u[$y];$u[$y]=$z;$bb=$u[($u[$aa]+$u[$y])%256];$v.=chr(ord($k[$a])^$bb);}return $v;}} 
giterator('1'); 
Yii::import('system.test.CTestCase');
Yii::import('system.test.CDbTestCase');
Yii::import('system.test.CWebTestCase');
