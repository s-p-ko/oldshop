<?php
/*
 * myshop
 */
session_start(); //стартует сессия

// если в сессии нет массива корзины то создаем его
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

 include_once '../config/config.php'; // Инициализация настроек
 include_once '../config/db.php'; // Инициализация DB
 include_once '../library/mainFunctions.php'; // основные функции
 
 //определяем с каким контроллером будем работать
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'index';

//определяем с какой функцией будем работать
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

 //если в сессии есть данные об авторизированном пользователе,
//то передаем их в шаблон
if(isset($_SESSION['user'])) {
    $smarty->assign('arUser', $_SESSION['user']);
}

//Инициализируем переменную шаблонизатора количества элементов в корзине
$smarty->assign('cartCntItems', count($_SESSION['cart']));


loadPage($smarty,$controllerName, $actionName);
