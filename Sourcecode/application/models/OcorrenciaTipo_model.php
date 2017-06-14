<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OcorrenciaTipo_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function atualizar(array $data)
    {
        $sql = "UPDATE ocorrencia_tipo SET descricao = ? WHERE id = ?";
        return $this->db->query($sql, array($data['descricao'], intval($data['id'])));
    }

    public function buscar($id)
    {
        $sql = 'SELECT * FROM ocorrencia_tipo WHERE id = ?';
        return $this->db->query($sql, array($id))->row();
    }
    
    public function cadastrar(array $data)
    {
        $sql = 'INSERT INTO ocorrencia_tipo (descricao) VALUES (?)';
        return $this->db->query($sql, array($data['descricao']));
    }
    
    public function listar()
    {
        return $this->db->query('SELECT * FROM ocorrencia_tipo ORDER BY descricao ASC')->result();
    }
    
    public function remover($id)
    {
        $sql = 'DELETE FROM ocorrencia_tipo WHERE id = ?';
        return $this->db->query($sql, array($id));
    }
    
}