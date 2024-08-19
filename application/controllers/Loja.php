<?php
/* 
defined('BASEPATH') or exit('No direct script access allowed');

class Loja extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template'); //Carrega a biblioteca de template
	}

	public function index()
	{
		$dados = [
			'title' => 'Loja'
		];
		$this->template->load('lojaPaginaPrincipal', $dados);
	}
} */

class Loja extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produto_model');
	}

	// Método para carregar a página principal da loja
	public function index()
	{
		$id_usuario = $this->session->userdata('id_usuario');
		$data['produtos'] = $this->Produto_model->get_all_products_by_loja($id_usuario);
		$data['tipo_acesso'] = $this->session->userdata('tipo_acesso');
		$data['homeUrl'] = '/';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');

		$data['conteudo'] = $this->load->view('lojaPaginaPrincipal', $data, TRUE);

		$this->load->view('template/index', $data);
	}

	// Método para adicionar um novo produto
	public function add_product()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required|numeric');
		$this->form_validation->set_rules('estoque', 'Estoque', 'required|integer');
		$this->form_validation->set_rules('custo', 'Custo', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Adicionar Produto';
			$data['conteudo'] = $this->load->view('add_product_form', $data, TRUE); // Carrega o form dentro do layout
			$data['tipo_acesso'] = $this->session->userdata('tipo_acesso');
			$data['homeUrl'] = '/';
			$data['nome_usuario'] = $this->session->userdata('nome_usuario');

			$this->load->view('template/index', $data); // Renderiza o layout principal com o form embutido
		} else {
			$id_usuario = $this->session->userdata('id_usuario'); // Obtém id_usuario da sessão
			$productData = array(
				'id_usuario_loja' => $id_usuario,  // Define id_usuario_loja como id_usuario
				'nome' => $this->input->post('nome'),
				'descricao' => $this->input->post('descricao'),
				'preco' => $this->input->post('preco'),
				'estoque' => $this->input->post('estoque'),
				'custo' => $this->input->post('custo')
			);

			$this->Produto_model->insert_product($productData);
			redirect('loja');
		}
	}


	// Método para editar um produto existente
	public function edit_product($id_produto)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required|numeric');
		$this->form_validation->set_rules('estoque', 'Estoque', 'required|integer');
		$this->form_validation->set_rules('custo', 'Custo', 'required|numeric');

		// Carrega os dados do produto pelo ID
		$data['produto'] = $this->Produto_model->get_product_by_id($id_produto);

		// Define o título da página
		$data['title'] = 'Editar Produto';

		if ($this->form_validation->run() == FALSE) {
			// Carrega a view do formulário de edição dentro do layout
			$data['conteudo'] = $this->load->view('edit_product_form', $data, true);
			$data['tipo_acesso'] = $this->session->userdata('tipo_acesso');
			$data['homeUrl'] = '/';
			$data['nome_usuario'] = $this->session->userdata('nome_usuario');
			// Renderiza o layout principal com o conteúdo do formulário de edição embutido
			$this->load->view('template/index', $data);
		} else {
			// Atualiza os dados do produto
			$productData = array(
				'nome' => $this->input->post('nome'),
				'descricao' => $this->input->post('descricao'),
				'preco' => $this->input->post('preco'),
				'estoque' => $this->input->post('estoque'),
				'custo' => $this->input->post('custo')
			);

			$this->Produto_model->update_product($id_produto, $productData);
			redirect('loja');
		}
	}


	// Método para deletar um produto
	public function delete_product($id_produto)
	{
		$id_usuario = $this->session->userdata('id_usuario'); // Obtém id_usuario da sessão

		// Verifica se o produto pertence ao id_usuario
		$produto = $this->Produto_model->get_product_by_id($id_produto);
		if ($produto && $produto['id_usuario_loja'] == $id_usuario) {
			$this->Produto_model->delete_product($id_produto);
		} else {
			$this->session->set_flashdata('error', 'Você não tem permissão para deletar este produto.');
		}

		redirect('loja');
	}
}


