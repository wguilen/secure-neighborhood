<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function atualizar(array $data)
    {
        if (!$this->validarPonto(intval($data['bairro']), $data['longitude'], $data['latitude']))
        {
            throw new \Exception('As coordenadas informadas não pertencem ao bairro.');
        }

        $sql = 'UPDATE
                    ocorrencia
                SET
                    bairro_id = ?,
                    tipo_id = ?,
                    descricao = ?,
                    localizacao = st_geomfromtext(?, 4326)
                WHERE
                    id = ?';

        return $this->db->query($sql, array(
            intval($data['bairro']),
            intval($data['tipo']),
            $data['descricao'],
            "POINT({$data['longitude']} {$data['latitude']})",
            intval($data['id'])
        ));
    }

    public function buscar($id)
    {
        $sql = 'SELECT
                    id,
                    bairro_id AS bairro,
                    tipo_id AS tipo,
                    descricao,
                    st_x(localizacao) AS longitude,
                    st_y(localizacao) AS latitude
                FROM
                    ocorrencia
               WHERE
                    ocorrencia.id = ?';

        return $this->db->query($sql, array($id))->row();
    }
    
    public function cadastrar(array $data)
    {
        if (!$this->validarPonto(intval($data['bairro']), $data['longitude'], $data['latitude']))
        {
            throw new \Exception('As coordenadas informadas não pertencem ao bairro.');
        }

        $sql = 'INSERT INTO ocorrencia (bairro_id, tipo_id, descricao, localizacao) VALUES (?, ?, ?, st_geomfromtext(?, 4326))';
        return $this->db->query($sql, array(
            intval($data['bairro']),
            intval($data['tipo']),
            $data['descricao'],
            "POINT({$data['longitude']} {$data['latitude']})"
        ));
    }
    
    public function listar()
    {
        $sql = 'SELECT
                    ocorrencia.id,
                    bairro.nome AS bairro,
                    ocorrencia_tipo.descricao AS tipo,
                    ocorrencia.descricao AS descricao, st_x(ocorrencia.localizacao) AS longitude, st_y(ocorrencia.localizacao) AS latitude
                FROM
                   ocorrencia INNER JOIN bairro ON (ocorrencia.bairro_id = bairro.id)
                              INNER JOIN ocorrencia_tipo ON (ocorrencia.tipo_id = ocorrencia_tipo.id)
                ORDER BY
                   bairro';

        return $this->db->query($sql)->result();
    }
    
    public function remover($id)
    {
        $sql = 'DELETE FROM ocorrencia WHERE id = ?';
        return $this->db->query($sql, array($id));
    }

    public function gerarKML()
    {
        $sql = 'SELECT
                    bairro.nome AS bairro,
                    ocorrencia_tipo.descricao as tipo,
                    ocorrencia.descricao AS ocorrencia,
                    st_askml(ocorrencia.localizacao) AS kml
                FROM 
                    ocorrencia INNER JOIN bairro ON (ocorrencia.bairro_id = bairro.id)
                               INNER JOIN ocorrencia_tipo ON (ocorrencia.tipo_id = ocorrencia_tipo.id)
                ORDER BY
                    bairro ASC,
                    ocorrencia ASC';

        return $this->db->query($sql)->result();
    }

    public function gerarRelatorio()
    {
        $sql = 'SELECT
                    nome AS bairro,
                    count(ocorrencia) AS numero_ocorrencias 
                FROM
                    bairro LEFT OUTER JOIN ocorrencia ON (bairro.id = ocorrencia.bairro_id)
                GROUP BY
                    nome
                ORDER BY
                    nome ASC';

        return $this->db->query($sql)->result();
    }

    private function validarPonto($bairroId = null, $longitude = null, $latitude = null)
    {
        if (!$bairroId || !$longitude || !$latitude)
        {
            return false;
        }

        $sql = 'SELECT
                    st_within(st_geomfromtext(?, 4326), coordenadas) AS ponto_valido
                FROM
                    bairro
                WHERE
                    id = ?';

        $pontoValido = $this->db->query($sql, array(
            "POINT($longitude $latitude)",
            $bairroId
        ));

        if ($pontoValido->num_rows() <= 0)
        {
            return false;
        }
        else
        {
            $pontoValido = $pontoValido->row();
            return strcasecmp($pontoValido->ponto_valido, 'f') === 0 ? false : true;
        }
    }

}