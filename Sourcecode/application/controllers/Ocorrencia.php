<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ocorrencia_model');
	}

	public function index()
	{
		$this->load->helper('form');
		$data = array('ocorrencias' => $this->ocorrencia_model->listar());
		$baseContent = $this->load->view('ocorrencia/index', $data, true);
		return loadBaseView($baseContent, 'Ocorrências', 'ocorrencias');
	}

	public function cadastrar()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		// Efetua o cadastro, caso o formulário tenha sido submetido e validado corretamente
		if (($postData = $this->input->post()) && $this->form_validation->run('ocorrencia'))
		{
			try
			{
				if (!$this->ocorrencia_model->cadastrar($postData))
				{
					show_error('Houve um erro ao cadastrar a ocorrência.', 500, 'Ocorrência');
				}

				redirect('ocorrencia');
			}
			catch (\Exception $ex)
			{
				$exception = $ex->getMessage();
			}
		}

		// Mostra o formulário para cadastro
		$this->load->model('bairro_model');
		$this->load->model('OcorrenciaTipo_model');

		$data = array(
			'bairros'	=> $this->bairro_model->listar(),
			'tipos'		=> $this->OcorrenciaTipo_model->listar());

		if (isset($exception))
		{
			$data['exception'] = $exception;
		}

		$baseContent = $this->load->view('ocorrencia/new', $data, true);
		return loadBaseView($baseContent, 'Ocorrência: Inclusão', 'ocorrencias');
	}

	public function editar($id = 0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		// Valida os dados submetidos e persiste a alteração em banco
		if (($postData = $this->input->post()) && $this->form_validation->run('ocorrencia'))
		{
			$postData['id'] = $id;

			try
			{
				if (!$this->ocorrencia_model->atualizar($postData))
				{
					show_error("Houve um erro ao atualizar a ocorrência com identificador $id.", 500, 'Ocorrência');
				}

				redirect('ocorrencia');
			}
			catch (\Exception $ex)
			{
				$exception = $ex->getMessage();
			}
		}

		// Obtém a entidade
		if (!($ocorrencia = $this->ocorrencia_model->buscar($id)))
		{
			show_error("Ocorrência com identificador $id não encontrada.", 404, 'Ocorrência');
		}
		
		// Mostra o formulário para edição
		$this->load->model('bairro_model');
		$this->load->model('OcorrenciaTipo_model');

		$data = array(
			'ocorrencia'	=> $ocorrencia,
			'bairros'		=> $this->bairro_model->listar(),
			'tipos'			=> $this->OcorrenciaTipo_model->listar());

		if (isset($exception))
		{
			$data['exception'] = $exception;
		}

		$baseContent = $this->load->view('ocorrencia/edit', $data, true);
		return loadBaseView($baseContent, 'Ocorrência: Edição', 'ocorrencias');
	}
    
    public function remover($id = null)
    {
        if ($postData = $this->input->post())
		{
			if (!$this->ocorrencia_model->remover($id))
			{
				show_error("Ocorrência com identificador $id não pôde ser removida.", 500, 'Ocorrência');
			}
		}
        
        redirect('ocorrencia');
    }


	// --- Relatório

	public function relatorio()
	{
		$ocorrencias = $this->ocorrencia_model->gerarRelatorio();
		$baseContent = $this->load->view('ocorrencia/relatorio', array('ocorrencias' => $ocorrencias), true);
		return loadBaseView($baseContent, 'Relatório de Ocorrências', 'ocorrencias');
	}

}
