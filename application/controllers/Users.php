<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {

	public function index()
	{
        
	}

    public function purchase()
    {
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $card_number = $this->input->post('card_number');
        $results = $this->session->userdata('results');
        foreach($results as $result => $key) {
            $purchase = array (
                'user_id' => $this->session->userdata('customer_id'),
                'name' => $name,
                'item_id' => $key['items_item_id'],
                'quantity' => $key['quantity'],
                'address' => $address,
                'card_number' => $card_number
            );
            $this->load->model("User");
            $this->User->confirm_order($purchase);
        }
        redirect('/items');
    }
}