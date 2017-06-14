<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'bairro/new'    => array(
        array('field' => 'nome', 'label' => 'Nome', 'rules' => 'required|is_unique[bairro.nome]'),
        array('field' => 'coordenadas', 'label' => 'Coordenadas', 'rules' => 'required|coordinates')
    ),
    'bairro/edit'   => array(
        array('field' => 'nome', 'label' => 'Nome', 'rules' => 'required'),
        array('field' => 'coordenadas', 'label' => 'Coordenadas', 'rules' => 'required|coordinates')
    ),
    'ocorrencia_tipo/new'   => array(
        array('field' => 'descricao', 'label' => 'Descricao', 'rules' => 'required|is_unique[ocorrencia_tipo.descricao]')
    ),
    'ocorrencia_tipo/edit'  => array(
        array('field' => 'descricao', 'label' => 'Descricao', 'rules' => 'required')
    ),
    'ocorrencia' => array(
        array('field' => 'bairro', 'label' => 'Bairro', 'rules' => 'required'),
        array('field' => 'tipo', 'label' => 'Tipo', 'rules' => 'required'),
        array('field' => 'descricao', 'label' => 'Descrição', 'rules' => 'required'),
        array('field' => 'longitude', 'label' => 'Longitude', 'rules' => 'required|decimal'),
        array('field' => 'latitude', 'label' => 'Latitude', 'rules' => 'required|decimal')
    )
);