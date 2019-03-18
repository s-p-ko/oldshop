/**
 * Получаем данные с форм
 * 
 */
function getData(obj_form){
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
       if(this.name && this.name !=''){
           hData[this.name] = this.value;
           console.log('hData[' + this.name + '] = ' + hData[this.name]);
       } 
    });
    return hData;
    
};

function newCategory() {
    var postData = getData('#blockNewCategory');
    
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/addnewcat/",
       data: postData,
       dataType: 'json',
       success: function(data){
           if(data['success']){
               alert(data['message']);
               $('newCategoryName').val('');
           } else {
               alert(data['message']);
           }
       }
    });
}

/**
 * Добавление нового продукта
 */

function addProduct(){
    var itemName = $('#newItemName').val();
    var itemPrice = $('#newItemPrice').val();
    var itemCatId = $('#newItemCatId').val();
    var itemDesc = $('#newItemDesc').val();
    
    var postData = {itemName: itemName, itemPrice: itemPrice, 
                    itemCatId: itemCatId, itemDesc: itemDesc};
    
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/addproduct/",
       data: postData,
       dataType: 'json',
       success: function(data){
           alert(data['message']);
           if(data['success']){
              $('#newItemName').val('');
              $('#newItemPrice').val('');
              $('#newItemCatId').val('');
              $('#newItemDesc').val('');
              
           }
       }
    });
}

/**
 * Изменния данных продукта
 */
function updateProduct(itemId){
    
    var itemName = $('#itemName_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).val();
    var itemCatId = $('#itemCatId_' + itemId).val();
    var itemDesc = $('#itemDesc_' + itemId).val();
    var itemStatus = $('#itemStatus_' + itemId).attr('checked');
    if(! itemStatus){
        itemStatus = 1
    } else {
        itemStatus = 0
    }
    
    var postData = {itemId: itemId, itemName: itemName, 
                    itemPrice: itemPrice, itemCadId: itemCatId,
                    itemDesc: itemDesc, itemStatus: itemStatus};
    
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/updateproduct/",
       data: postData,
       dataType: 'json',
       success: function(data){
           alert(data['message']);
       }
    });
}

/**
 * показывать или прятать данные о заказе 
 *
 */
function showProducts(id){
    var objName = "#purchasesForOrderId_" + id;
    if($(objName).css('display') != 'table-row') {
       $(objName).show(); 
    } else {
        $(objName).hide();
    }
}

/*
 * Изменение статуса заказа
 */

function updateOrderStatus(itemId){
    var status = $('#itemStatus_' + itemId).attr('checked');
    if(! status){
        status = 0
    } else {
        status = 1
    }
    var postData = {itemId: itemId, status: status};
    
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/setorderstatus/",
       data: postData,
       dataType: 'json',
       success: function(data){
           if(! data['success']){
               alert(data['message']);
           }
       }
        
    });
}

function updateDatePayment(itemId){
    
    var datePayment = $('#datePayment_' + itemId).val();
    var postData = {itemId: itemId, datePayment: datePayment};
    
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/setorderdatepayment/",
       data: postData,
       dataType: 'json',
       success: function(data){
           if(! data['success']){
               alert(data['message']);
           }
       }
        
    });
}