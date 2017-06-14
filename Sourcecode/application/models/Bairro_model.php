<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bairro_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function atualizar(array $data)
    {
        $sql = 'UPDATE bairro SET nome = ?, coordenadas = st_geomfromtext(?, 4326) WHERE id = ?';
        return $this->db->query($sql, array(
            $data['nome'],
            "POLYGON(({$data['coordenadas']}))",
            intval($data['id'])
        ));
    }

    public function buscar($id)
    {
        $sql = 'SELECT id, nome, substring(left(st_astext(coordenadas), -2), 10) as coordenadas FROM bairro WHERE id = ?';
        return $this->db->query($sql, array($id))->row();
    }
    
    public function cadastrar(array $data)
    {
        $sql = 'INSERT INTO bairro (nome, coordenadas) VALUES (?, st_geomfromtext(?, 4326))';
        return $this->db->query($sql, array(
            $data['nome'],
            "POLYGON(({$data['coordenadas']}))"
        ));
    }
    
    public function listar()
    {
        $sql = 'SELECT id, nome, substring(left(st_astext(coordenadas), -2), 10) AS coordenadas FROM bairro ORDER BY nome ASC';
        return $this->db->query($sql)->result();
    }
    
    public function remover($id)
    {
        $sql = "DELETE FROM bairro WHERE id = ?";
        return $this->db->query($sql, array($id));
    }

    public function gerarKML()
    {
        $sql = 'SELECT
                    bairro.id,
                    bairro.nome,
                    COUNT(ocorrencia) AS numero_ocorrencias,
                    st_askml(bairro.coordenadas) AS kml
                FROM
                    bairro LEFT OUTER JOIN ocorrencia ON (bairro.id = ocorrencia.bairro_id)
                GROUP BY
                    bairro.id,
                    bairro.nome,
                    bairro.coordenadas
                ORDER BY
                    bairro.nome ASC';

        return $this->db->query($sql)->result();
    }
    
}