<?php
/*
 * myshop *
 */
/*
 * 
 * Основные функции
 * 
 */

/**
 * Формирование запрашиваемой страницы
 * 
 * @param type $controllerName  Название контроллера
 * @param type $actionName      Название функции обработки страницы
 */
function loadPage ($smarty, $controllerName, $actionName = 'index') {
    
    include_once PathPrefix . $controllerName . PathPostfix;
    
    $function = $actionName . 'Action';
    $function($smarty);
}

/**
 * Загрузка шаблона
 * 
 * @param object $smarty объект шаблонизатора
 * @param string $templateName название файла шаблона
 */
function loadTemplate($smarty, $templateName) {
    $smarty->display($templateName . TemplatePostfix);
}


/**
 * Функция отладки. Останавливает работу программы выводя 
 * значение переменной $value
 * 
 * @param variant $value переменная для вывода ее на страницу
 */
function d($value = null, $die = 1)
{
    echo 'Debug: <br><pre>';
    print_r($value);
    echo '</pre>';
    
    if($die) die;
}

/**
 * Преобразование результата работы функции выборки в асоциативный массив
 * 
 * @param recordest $rs набор строк - результат работы SELECT
 * @return array
 */
function createSmartyRsArray($rs)
{
    if(!$rs) return false;
    
    $smartyRs = array();
    while ($row = mysql_fetch_assoc($rs)) { //Внимание Данное расширение устарело, начиная с версии PHP 5.5.0, и удалено в PHP 7.0.0. 
        $smartyRs[] = $row;
    }
        
    return $smartyRs;
}

/**
 * Редирект
 * 
 * @param string $url адрес для перенаправления
 */
function redirect($url)
{
    if(! $url) $url = '/';
    header("Location: $url");
    exit;
}
