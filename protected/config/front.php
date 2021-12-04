<?php
ob_start('My_OB');
function My_OB($str, $flags)
{
    //remove UTF-8 BOM
    $str = preg_replace("/\xef\xbb\xbf/","",$str);
    
    return $str;
}
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
    	'name'=>'Website',
    	'theme'=>'newtheme',
        // Put front-end settings there
        // (for example, url rules).
     'components'=>array(
        'urlManager'=>array(
    'urlFormat'=>'path',
    'showScriptName'=>false,
    'rules'=>array(
        'member/changeforgotpassword/<temp_token:\w+>'=>'member/changeforgotpassword/',
        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
	),
    ),
   )
);
