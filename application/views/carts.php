<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
    </head>
    <body>
        <h1>My store</h1>
        <a href="/items">Go back</a>
        <table>
            <tr>
                <th>Item name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
<?php   if(isset($errors)) {
            echo $errors;
        }
         $counter = 0;
         if(isset($results)) {
        foreach($results as $result => $key) {
?>
            <tr>
                <td><?=$key['item_name']?></td>
                <td><?=$key['quantity']?></td>
                <td><?=$key['item_price']?></td>
                <td><a href="/carts/delete/<?=$key['items_item_id']?>">Delete</a></td>
            </tr>
<?php   $counter++;
        }
        $this->session->set_userdata('counter', $counter);
        }
?>
        </table>
        <form action="/carts/confirm" method="post">
            <h1>Billing info</h1>
            <label>Name: </label>
            <input type="text" name="name">
            <label>Address: </label>
            <input type="text" name="address">
            <label>Card number: </label>
            <input type="number" name="card_number">
            <input type="Submit" name="Submit Order">
        </form>
    </body>
</html>