<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bairro extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bairro_model');
	}

	public function index()
	{
		$this->load->helper('form');
		$data = array('bairros' => $this->bairro_model->listar());
		$baseContent = $this->load->view('bairro/index', $data, true);
		return loadBaseView($baseContent, 'Bairros');
	}

	public function cadastrar()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		// Efetua as validações dos dados submetidos, sendo o caso
		if (!($postData = $this->input->post()) || !$this->form_validation->run('bairro/new'))
		{
			$baseContent = $this->load->view('bairro/new', null, true);
			return loadBaseView($baseContent, 'Bairro: Inclusão');
		}

		// Efetua o cadastro, caso o formulário tenha sido submetido
		if (!$this->bairro_model->cadastrar($postData))
		{
			show_error('Houve um erro ao cadastrar o bairro.', 500, 'Bairro');
		}

		redirect('bairro');
	}

	public function editar($id = 0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		// Valida os dados submetidos e persiste a alteração em banco
		if (($postData = $this->input->post()) && $this->form_validation->run('bairro/edit'))
		{
			$postData['id'] = $id;

			if (!$this->bairro_model->atualizar($postData))
			{
				show_error("Houve um erro ao atualizar o bairro com identificador $id.", 500, 'Bairro');
			}

			redirect('bairro');
		}

		// Obtém a entidade bairro
		if (!($bairro = $this->bairro_model->buscar($id)))
		{
			show_error("Bairro com identificador $id não encontrado.", 404, 'Bairro');
		}
		
		// Mostra o formulário para edição
		$baseContent = $this->load->view('bairro/edit', array('bairro' => $bairro), true);
		return loadBaseView($baseContent, 'Bairro: Edição');	
	}
    
    public function remover($id = null)
    {
        if ($postData = $this->input->post())
		{
			if (!$this->bairro_model->remover($id))
			{
				show_error("Bairro com identificador $id não pôde ser removido.", 500, 'Bairro');
			}
		}
        
        redirect('bairro');
    }
	
}
