<?php
/*
 * myshop
 * 
 */
/**
 * Контроллер главной страницы
 * 
 */
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/*
 * Надо удаллить
 */
//function testAction () {
//    echo 'IndexController.php > testAction';
//}

/**
 * Формирование главной страницы сайта
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction ($smarty) {
    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getLastProducts(16);
        
    $smarty->assign('pageTitle', 'Головна сторінка сайту');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}


