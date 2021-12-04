<?php

return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        // Put front-end settings there
        // (for example, url rules).
        'name'=>'Website Admin',
        'theme'=>'newtheme',
            'preload'=>array(
        //'log',
        'bootstrap'
        ),
        'components'=>array(
        'urlManager'=>array(
    'urlFormat'=>'path',
    'showScriptName'=>false,
    'rules'=>array(
            'backend.php'=>'site/index',     
           'backend/<controller:\w+>/<id:\d+>'=>'<controller>/view',
           'backend/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
           'backend/<controller:\w+>/<action:\w+>'=>'<controller>/<action>', 
    ),
	),
    ),
        )
);
