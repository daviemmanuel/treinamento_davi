<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produto_model');
	}

	public function index()
	{
		/*$data['produtos'] = $this->Produto_model->get_all_products(); // Buscando todos os produtos
																										$this->load->view('clientePaginaPrincipal', $data); // Carregando a view*/

		$id_usuario = $this->session->userdata('id_usuario');
		$data['produtos'] = $this->Produto_model->get_all_products();
		$data['tipo_acesso'] = $this->session->userdata('tipo_acesso');
		$data['homeUrl'] = '/';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');

		$data['conteudo'] = $this->load->view('clientePaginaPrincipal', $data, TRUE);

		$this->load->view('template/index', $data);
	}

	public function comprar_produto()
	{
		$id_produto = $this->input->post('id_produto');
		$quantidade = $this->input->post('quantidade');

		$produto = $this->Produto_model->get_product_by_id($id_produto);
		print_r($produto);

		if ($quantidade <= $produto['estoque']) {
			$data = array(
				'id' => $produto['id_produto'],
				'qty' => $quantidade,
				'price' => $produto['preco'],
				'name' => $produto['nome'],
			);



			// $this->cart->insert($data);

			// $novo_estoque = $produto->estoque - $quantidade;
			// $this->Produto_model->update_estoque($id_produto, $novo_estoque);

			redirect('cliente');
		} else {
			$response = [
				'cart_count' => $this->cart->total_items(),
				'message' => 'Quantidade solicitada maior que o estoque disponível.'
			];
		}

		echo json_encode($response);
	}

	// 	$(document).on('submit', 'form', function(e) {
//     e.preventDefault();

	//     $.ajax({
//         url: $(this).attr('action'),
//         method: 'POST',
//         data: $(this).serialize(),
//         success: function(response) {
//             response = JSON.parse(response);
//             $('#quantidade_carrinho').text(response.cart_count); // Atualiza o contador do carrinho
//             alert(response.message); // Mostra a mensagem de sucesso ou erro
//         }
//     });
// });



	// Controller: Cliente.php



}
