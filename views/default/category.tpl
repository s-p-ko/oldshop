{*myshop*}
{*Страница категории*}
<h1>Товары категории {$rsCategory['name']}</h1>

{if $rsProducts || $rsChildCats}
    
{foreach $rsProducts as $item name=products}
    <div style="float: left; padding: 0 30px 40px 0;">
        <a href="/product/{$item['id']}/">
            <img src="/images/products/{$item['image']}" width="100">
        </a><br>
        <a href="/product/{$item['id']}/">{$item['name']}</a>
    </div>
    
    {if $smarty.foreach.products.iteration mod 3 == 0}
        <div style="clear: both"></div>
    {/if}
    
{/foreach}

{else}
    <p style="color: red; font-size: 2em;" >Товар из данной категории отсутствует</p> 
{/if}


{foreach $rsChildCats as $item name = childCats}
    <h2><a href="/category/{$item['id']}/">{$item['name']}</a></h2>

{/foreach}
