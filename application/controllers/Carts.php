<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Carts extends CI_Controller {

	public function index()
	{
        $user_id =  $this->session->userdata('customer_id');
        $this->load->model("Cart");
        $results = $this->Cart->get_cart($user_id);
        $this->load->view('carts', array("results" => $results));
	}
    
    public function add_to_cart()
    {
        ////////Check user cart////////
        $this->load->model("Cart");
        $user_id =  $this->session->userdata('customer_id');
        $item_id = $this->input->post('item_id');
        $quantity = $this->input->post('quantity');
        $user_cart = array (
            'user_id' => $user_id,
            'item_id' => $item_id
        );
        $user_data = $this->Cart->check_user_cart($user_cart);
        
        ////update if exists, add if not///
        if($user_data !== NULL) {
            //$new_quantity = $user_data['quantity'] + $add_quantity; 
            $new_quantity = $this->input->post('quantity');
            $updated_quantity = array(
                'user_id' => $user_id,
                'item_id' => $item_id,
                'new_quantity' => $new_quantity
            );
            $this->Cart->update_quantity($updated_quantity);
        } else if ($user_data == NULL) {
            $new_item_data = array (
                'user_id' => $user_id,
                'item_id' => $item_id,
                'quantity' => $quantity
            );
            $this->Cart->add_item($new_item_data);
        }

        redirect('items');
    }

	public function delete($destroy_id)
	{
        $destroy_data = array (
            'user_id' => $this->session->userdata('customer_id'),
            'item_id' => $destroy_id
        );
        $this->load->model("Cart");
        $results = $this->Cart->destroy_cart_item($destroy_data);
        redirect('carts');
		//$this->session->unset_userdata($quantity);
		//redirect('shops/cart');
	}

    public function confirm()
	{ 
        $this->load->model("User");
        $result = $this->User->validate($this->input->post());
        if($result == "valid") {
            $user_id =  $this->session->userdata('customer_id');
            $this->load->model("Cart");
            $results = $this->Cart->get_cart($user_id);
            $this->session->set_userdata('results', $results);
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $card_number = $this->input->post('card_number');
            $confirm_data = array (
                'name' => $name,
                'address' => $address,
                'card_number' => $card_number,
                'results' => $results
            );
            $this->load->view('confirm', $confirm_data);
        } else {
            $this->view_data['errors'] = $result;
			$this->load->view('carts', $this->view_data);
        }
    }

}
?>