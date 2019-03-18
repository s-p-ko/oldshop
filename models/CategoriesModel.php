<?php
/*
 * myshop
 * 
 */

/* 
 *Модель для таблици категорий (categories)
 * 
 */


/**
 * Получить дочерние категории для категории $catId
 * 
 * @param integer $catId ID
 * @return array массив дочерних категорий
 */
function getChildrenForCat($catId)
{
    $sql = "SELECT * FROM categories WHERE parent_id = '{$catId}'";
   
    $rs = mysql_query($sql);
      
    return createSmartyRsArray($rs);
}

/**
 * Получить главные категории с привязкой дочерних
 * 
 * @return array массив категорий
 */
function getAllMainCatsWithChildren() {
    $sql = 'SELECT * 
            FROM categories 
            WHERE parent_id = 0';
    
    $rs = mysql_query($sql);
  
    $smartyRS = array();
    while ($row = mysql_fetch_assoc($rs)) {
        
        $rsChildren = getChildrenForCat($row['id']);
       
         if($rsChildren){
            $row['children'] = $rsChildren;
             
        }
        $smartyRS[] = $row;
    }
       return $smartyRS;
}

/**
 * получить данные категории по id
 * 
 * @param integer $catId ID категории
 * @return array - строка категории
 */

function getCatById($catId)
{
    $catId = intval($catId);// каким бы значение не пришло,
                            // оно преобразуется в интегер
    $sql = "SELECT * 
            FROM `categories`
            WHERE
            id = '{$catId}'"; // одинарные кавычки, для того чтобы обезопасить 
                              // сайт от сбоя, если придет ноль или пустая 
                              // строка - сайт может остановиться, а так будет 
                              // поиск идентификатора по пустой строке
                              // Плюс помех СКЛ-инъекциям.
            
    $rs = mysql_query($sql);
    
    return mysql_fetch_assoc($rs);
}

/**
 * Получить все главные категории (категорий, которые не являются дочерними)
 * 
 * @return array массив категорий
 */
function getAllMainCategories()
{
    $sql = "SELECT * "
            . "FROM `categories` "
            . "WHERE parent_id = 0";
    
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);
}

/**
 *  Добавление новой категории
 * @param string $catName Название категории
 * @param integer $catParentId ID родительской категории
 * @return integer id новой категории
 */
function insertCat($catName, $catParentId=0)
{
    // готовим запрос
    $sql = "INSERT INTO "
            . "categories (`parent_id`, `name`) "
            . "VALUES ('{$catParentId}', '{$catName}')";
            
    // выполняем запрос
    mysql_query($sql);
    
    // получаем id добавленной записи (сгенерированный при последнем INSERT-запросе)
    $id = mysql_insert_id();
    
    return $id;
    
}

function getAllCategories()
{
    $sql = "SELECT * "
            . "FROM categories "
            . "ORDER BY `parent_id` ASC";
    
    $rs = mysql_query($sql);
    
    return createSmartyRsArray($rs);
}