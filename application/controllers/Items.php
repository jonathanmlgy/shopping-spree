<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Items extends CI_Controller {

	public function index()
	{
		$this->session->set_userdata('customer_id', 1);
		$this->load->view('items');
	}

	public function add_to_cart($item)
	{
		if($this->session->userdata($item. '_quantity') == NULL) {
			$temp = 0;
			$this->session->set_userdata($item. '_quantity', $temp);
			$quantity = $this->session->userdata($item. '_quantity') + $this->input->post('quantity');
			$this->session->set_userdata($item. '_quantity', $quantity);
		} else {
			$quantity = $this->session->userdata($item. '_quantity') + $this->input->post('quantity');
			$this->session->set_userdata($item. '_quantity', $quantity);
		}
		echo "buy " . $item . " ". $this->session->userdata($item. '_quantity');
		//$this->load->view('store');
		//$this->session->sess_destroy();
		redirect('shops');
	}

	public function cart()
	{
		$this->load->view('cart');
	}

	public function unset($quantity)
	{
		$this->session->unset_userdata($quantity);
		redirect('shops/cart');
	}
}
?>