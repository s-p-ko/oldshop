<?php
/*
 * myshop
 * 
 */
/* 
 * Контроллер страницы категории (/category/1)
 * 
 */

//подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';


/**
 * Формирование страницы категории
 * 
 * @param jbject $smarty шаблонизатор
 */

function indexAction($smarty) {
    $catId = isset($_GET['id']) ? $_GET['id'] : null;
    if(!$catId) exit (); // === if($catId == null) exit();
    $rsProducts = null; //Обратите внимание что переменные инициализированы со значением null
    $rsChildCats = null;// Это даст избежать ошибок так как может одновременно сработать лишь одна 42 or 43
    
    $rsCategory = getCatById($catId);
    //если главная категория, то показывает дочернии категории,
    //иначе показывает товар
    if($rsCategory['parent_id'] == 0)
    {
        $rsChildCats = getChildrenForCat($catId);
    } else {
       $rsProducts = getProductsByCat($catId); 
    }
    $rsCategories = getAllMainCatsWithChildren();
    $smarty->assign('pageTitle', 'Товары категории ' . $rsCategory['name']);
    
    $smarty->assign('rsCategory', $rsCategory);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsChildCats', $rsChildCats);
    
    $smarty->assign('rsCategories', $rsCategories);
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'category');
    loadTemplate($smarty, 'footer');
}

