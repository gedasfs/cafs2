<?php
// Should be set if project runs not in the server root (i.e. /var/www), 
// i.e. project resides in /var/www/project/forms, 
// then define('PROJECT_DIR', '/project/forms');
define('PROJECT_DIR', '');

define('PROJECT_DIR_FULL', $_SERVER['DOCUMENT_ROOT'] . PROJECT_DIR);

define('UPLOAD_DIR', '/uploads');
define('UPLOAD_DIR_FULL', PROJECT_DIR_FULL .'/' . UPLOAD_DIR);

define('IMAGES_DIR_FULL', PROJECT_DIR_FULL . '/public/images');
define('FONTS_DIR_FULL', PROJECT_DIR_FULL . '/public/fonts');