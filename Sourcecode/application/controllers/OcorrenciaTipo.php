<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OcorrenciaTipo extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ocorrenciaTipo_model');
	}

	public function index()
	{
		$this->load->helper('form');
		$data = array('tipos' => $this->ocorrenciaTipo_model->listar());
		$baseContent = $this->load->view('ocorrencia_tipo/index', $data, true);
		return loadBaseView($baseContent, 'Tipos de Ocorrências', 'ocorrencias');
	}

	public function cadastrar()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		// Efetua as validações dos dados submetidos, sendo o caso
		if (!($postData = $this->input->post()) || !$this->form_validation->run('ocorrencia_tipo/new'))
		{
			$baseContent = $this->load->view('ocorrencia_tipo/new', null, true);
			return loadBaseView($baseContent, 'Tipo de Ocorrência: Inclusão', 'ocorrencias');
		}

		// Efetua o cadastro, caso o formulário tenha sido submetido
		if (!$this->ocorrenciaTipo_model->cadastrar($postData))
		{
			show_error('Houve um erro ao cadastrar o tipo de ocorrência.', 500, 'Tipo de Ocorrência');
		}

		redirect('ocorrencia/tipo');
	}

	public function editar($id = 0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
		$this->form_validation->set_rules('descricao', 'Descrição', "edit_unique[ocorrencia_tipo.descricao.$id]");

		// Valida os dados submetidos e persiste a alteração em banco
		if (($postData = $this->input->post()) && $this->form_validation->run('ocorrencia_tipo/edit'))
		{
			$postData['id'] = $id;

			if (!$this->ocorrenciaTipo_model->atualizar($postData))
			{
				show_error("Houve um erro ao atualizar o tipo de ocorrência com identificador $id.", 500, 'Tipo de Ocorrência');
			}

			redirect('ocorrencia/tipo');
		}

		// Obtém a entidade
		if (!($tipo = $this->ocorrenciaTipo_model->buscar($id)))
		{
			show_error("Tipo de Ocorrência com identificador $id não encontrado.", 404, 'Tipo de Ocorrência');
		}
		
		// Mostra o formulário para edição
		$baseContent = $this->load->view('ocorrencia_tipo/edit', array('tipo' => $tipo), true);
		return loadBaseView($baseContent, 'Tipo de Ocorrência: Edição', 'ocorrencias');
	}
    
    public function remover($id = null)
    {
        if ($postData = $this->input->post())
		{
			if (!$this->ocorrenciaTipo_model->remover($id))
			{
				show_error("Tipo de Ocorrência com identificador $id não pôde ser removido.", 500, 'Tipo de Ocorrência');
			}
		}
        
        redirect('ocorrencia/tipo');
    }
	
}
