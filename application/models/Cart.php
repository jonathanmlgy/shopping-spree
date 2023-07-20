<?php
class Cart extends CI_Model {
    function add_item($new_item_data)
    {
        $query = "INSERT INTO carts (users_user_id, items_item_id, quantity) VALUES (?,?,?)";
        $values = array($new_item_data['user_id'], $new_item_data['item_id'], $new_item_data['quantity']); 
        return $this->db->query($query, $values);
    }
    public function login_user($contact_number, $password)
    {
        return $this->db->query("SELECT first_name, last_name, contact_number FROM users WHERE contact_number = ? AND password = ?", array($contact_number, $password))->row_array();
    }

    function check_user_cart($user_cart)
    {
        return $this->db->query("SELECT users_user_id, items_item_id, quantity FROM carts WHERE users_user_id = ? AND items_item_id = ?", array($user_cart['user_id'], $user_cart['item_id']))->row_array();
    }

    function update_quantity($updated_quantity)
    {
        $query = "UPDATE carts SET quantity = ? WHERE users_user_id = ? AND items_item_id = ?";
        $values = array($updated_quantity['new_quantity'], $updated_quantity['user_id'], $updated_quantity['item_id']); 
        return $this->db->query($query, $values);
    }

    function get_cart($user_id)
    {
        return $this->db->query(
        "SELECT
            items_item_id, 
            items.item_name,
            quantity,
            items.item_price, 
            quantity * items.item_price as subtotal_price 
        FROM 
            carts
        LEFT JOIN 
            items ON carts.items_item_id = items.item_id
        WHERE 
            users_user_id = ?", array($user_id))->result_array();
    }

    function destroy_cart_item($destroy_id)
    {
        return $this->db->query("DELETE FROM carts WHERE users_user_id = ? AND items_item_id = ?", array($destroy_id['user_id'], $destroy_id['item_id']));
    }

    /*function update_contact($new_contact_details)
    {
        $query = "UPDATE phonebook SET name = ?, contact_number = ?, updated_at = ? WHERE id = ?";
        $values = array($new_contact_details['name'], $new_contact_details['number'], date("Y-m-d, H:i:s"), $new_contact_details['update_id']); 
        return $this->db->query($query, $values);
    }

    function get_contact_by_id($show_id)
    {
        return $this->db->query("SELECT id, name, contact_number FROM Phonebook WHERE id = ?", array($show_id))->row_array();
    }
    
    function delete_by_id($destroy_id)
    {
        return $this->db->query("DELETE FROM Phonebook WHERE id = ?", array($destroy_id));
    }

    function get_all_contacts()
    {
        return $this->db->query("SELECT id, name, contact_number FROM phonebook")->result_array();
    }*/
}
?>