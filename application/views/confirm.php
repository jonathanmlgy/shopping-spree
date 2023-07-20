<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
    </head>
    <body>
        <h1>Confirm Orders</h1>
        <table>
            <tr>
                <th>Item name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
<?php   
        $total_price = 0;
        foreach($results as $result => $key) {
?>
            <tr>
                <td><?=$key['item_name']?></td>
                <td><?=$key['quantity']?></td>
                <td><?=$key['subtotal_price']?></td>
            </tr>
<?php       $total_price += $key['subtotal_price'];
        }  
?>
        </table>
        <p>Total Price: <?=$total_price?></p>
        <p>Name: <?=$name?></p>
        <p>Address: <?=$address?></p>
        <p>Card number: <?=$card_number?></p>
        <form action="/users/purchase" method="post">
            <input type="hidden" name="name" value="<?=$name?>">
            <input type="hidden" name="address" value="<?=$address?>">
            <input type="hidden" name="card_number" value="<?=$card_number?>">
            <input type="submit" value="Confirm order">
        </form>
    </body>
</html>