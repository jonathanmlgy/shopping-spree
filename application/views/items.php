<?php
    $catalog_counter  = $this->session->userdata('catalog_counter');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Items</title>
    </head>
    <body>
        <h1>My store</h1>
        <a href='/carts'>Cart(<?=$this->session->userdata('counter')?>)</a>
        <form action="/carts/add_to_cart" method="post">
            <input type='hidden' name='item_id' value='1'/>
            <label>RK61</label>
            <input type="number" name="quantity" min="1" max="10" step="1" value="1">
            <input type='submit' value='Buy'/>
        </form>
        <form action="/carts/add_to_cart" method="post">
            <input type='hidden' name='item_id' value='2'/>
            <label>RK68</label>
            <input type="number" name="quantity" min="1" max="10" step="1" value="1">
            <input type='submit' value='Buy'/>
        </form>
        <form action="/carts/add_to_cart" method="post">
            <input type='hidden' name='item_id' value='3'/>
            <label>RK71</label>
            <input type="number" name="quantity" min="1" max="10" step="1" value="1">
            <input type='submit' value='Buy'/>
        </form>
    </body>
</html>