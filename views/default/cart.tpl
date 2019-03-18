{*myshop*}
{*шаблон корзины*}

<h1>Корзина</h1>

{if ! $rsProducts}
В корзине пусто.

{else}
    <form action="/cart/order/" method="POST">
    <h2>Данные заказа</h2>
    <table>
        <thead>
            <td>
              №  
            </td>
            <td>
               Наименование
            </td>
            <td>
               Количество 
            </td>
            <td>
               Цена за единицу 
            </td>
            <td>
               Цена 
            </td>
            <td>
               Действие 
            </td>
        </thead>
        {foreach $rsProducts as $item name=products}
        <tr>
            <td>
                {$smarty.foreach.products.iteration} {*№*}
            </td>
            <td>
                <a href="/product/{$item['id']}/">{$item['name']}</a><br> {*Наименование*}
            </td>
            <td>
                <input name="itemCnt_{$item['id']}" id="itemCnt_{$item['id']}" 
                       type="text" value="1" onchange="conversionPrice({$item['id']});"/> {*Количество*}
            </td>
            <td>
                <span id="itemPrice_{$item['id']}" value="{$item['price']}"> {*Цена за единицу*}
                    {$item['price']}
                </span>
            </td>
            <td>
                <span id="itemRealPrice_{$item['id']}"> {*Цена*}
                    {$item['price']}
                </span>
            </td>
            <td>
                <a id="removeCart_{$item['id']}" href="#" onClick="removeFromCart({$item['id']}); {*Действие*}
                    return false;" title="Удалить из корзины">Удалить</a>
                <a id="addCart_{$item['id']}" class="hideme" href="#" onClick="addToCart({$item['id']}); 
                    return false;" title="Восстановить элемент">Восстановить</a>
            </td>
        </tr>
        {/foreach}
    </table>
    <input type="submit" value="Оформить заказ" />
    </form>
    
{/if}

