<?php
/*
 * myshop
 * 
 */

/*
 * Файл настроек
 */



//>константы для обращения к контроллерам
define('PathPrefix', '../controllers/');
define('PathPostfix', 'Controller.php');
//<


//> используемый шаблон
$template = 'default';
$templateAdmin = 'admin';

//пути к файлам шаблонов (*.tpl)
define('TemplatePrefix', "../views/{$template}/");
define('TemplateAdminPrefix', "../views/{$templateAdmin}/");
define('TemplatePostfix', '.tpl');

//пути к файлам шаблонов в вебпространстве для CSS, js
define('TemplateWebPath', "templates/{$template}/");
define('TemplateAdminWebPath', "/templates/{$templateAdmin}/");
//<

//>Инициализация шаблонизатора Смарти
//put full path to Smarty.class.php
require('../library/Smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(TemplatePrefix);
$smarty->setCompileDir('../tmp/smarty/templates_c'); //создать вручную
$smarty->setCacheDir('../tmp/smarty/cashe'); //создать вручную
$smarty->setConfigDir('../library/Smarty/configs'); //создать вручную

$smarty->assign('TemplateWebPath', TemplateWebPath);
//<

