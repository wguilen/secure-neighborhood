<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ferramenta extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bairro_model');
		$this->load->model('ocorrencia_model');
	}

	public function exportarKML()
	{
		$this->load->helper('download');
		force_download('Ocorrências.kml', $this->_gerarKML());
	}

	private function _gerarKML()
	{
		$xmlWritter = new XMLWriter();
		$xmlWritter->openMemory();
		$xmlWritter->startDocument('1.0', 'UTF-8');
		$xmlWritter->startElement('kml');
		$xmlWritter->startAttribute('xmlns');
		$xmlWritter->text('http://www.opengis.net/kml/2.2');
		$xmlWritter->endAttribute();
		$xmlWritter->startElement('Document');

		// Inclui os Placemarks de bairros no documento
		if (!empty($bairros = $this->bairro_model->gerarKML()))
		{
			// Calcula o número total de ocorrências
			$totalOcorrencias = 0;
			foreach ($bairros as $bairro)
			{
				$totalOcorrencias += $bairro->numero_ocorrencias;
			}

			// Insere no KML os bairros e suas respectivas colorações
			foreach($bairros as $bairro)
			{
				// Coloração de cada bairro
				$xmlWritter->startElement('Style');
				$xmlWritter->startAttribute('id');
				$xmlWritter->text($bairro->id);
				$xmlWritter->endAttribute();
				$xmlWritter->startElement('PolyStyle');
				$xmlWritter->startElement('color');
				$xmlWritter->text(dechex(intval($bairro->numero_ocorrencias * 256.0 / $totalOcorrencias)) . '0000FF');
				$xmlWritter->endElement();
				$xmlWritter->startElement('colorMode');
				$xmlWritter->text('normal');
				$xmlWritter->endElement();
				$xmlWritter->endElement();
				$xmlWritter->endElement();

				// Elementos (bairros)
				$xmlWritter->startElement('Placemark');
				$xmlWritter->startElement('name');
				$xmlWritter->text($bairro->nome);
				$xmlWritter->endElement();
				$xmlWritter->startElement('styleUrl');
				$xmlWritter->text("#{$bairro->id}");
				$xmlWritter->endElement();
				$xmlWritter->startElement('description');
				$xmlWritter->text("Total de ocorrências: {$bairro->numero_ocorrencias}");
				$xmlWritter->endElement();
				$xmlWritter->writeRaw($bairro->kml);
				$xmlWritter->endElement();
			}
		}

		// Inclui os Placemarks de ocorrências no documento
		if (!empty($ocorrencias = $this->ocorrencia_model->gerarKML()))
		{
			foreach ($ocorrencias as $ocorrencia)
			{
				$xmlWritter->startElement('Placemark');

				$xmlWritter->startElement('name');
				$xmlWritter->text($ocorrencia->tipo);
				$xmlWritter->endElement();

				$xmlWritter->startElement('description');
				$xmlWritter->text($ocorrencia->ocorrencia);
				$xmlWritter->endElement();

				$xmlWritter->writeRaw($ocorrencia->kml);

				$xmlWritter->endElement();
			}
		}

		$xmlWritter->endElement();
		$xmlWritter->endElement();

		return $xmlWritter->outputMemory(true);
	}

}