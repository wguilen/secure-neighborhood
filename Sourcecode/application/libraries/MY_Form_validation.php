<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{

    function __construct(array $config = array())
    {
        parent::__construct($config);
    }

    function coordinates($coordinates)
    {
        if (count($coordinates = explode(',', $coordinates)) <= 3 ||
            strcasecmp(trim($coordinates[0]), trim($coordinates[count($coordinates) - 1])) !== 0)
        {
            return false;
        }

        $pontos = -1;
        foreach ($coordinates as $coordinate)
        {
            $coordinatesPair = explode(' ', trim($coordinate));

            foreach ($coordinatesPair as $coord) {
                if (!is_numeric($coord))
                {
                    return false;
                }
            }

            $pontosCoordenada = count($coordinatesPair);

            if ($pontos === -1)
            {
                $pontos = $pontosCoordenada;
            }
            elseif ($pontos !== $pontosCoordenada)
            {
                return false;
            }
        }

        return true;
    }

    public function edit_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0)
            : false;
    }

}