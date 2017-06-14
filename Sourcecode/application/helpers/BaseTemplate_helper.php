<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('loadBaseView'))
{
    function loadBaseView($content = '', $title = null, $menuItem = null)
    {
        $CI = &get_instance();
        
        if (is_null($CI))
        {
            throw new \Exception('loadBaseView() could not obtain $CI instance.');
        }

        $baseViewData = array(
            'content'   => $content,
            'menuItem'  => !is_null($menuItem) ? $menuItem : 'bairros');

        if (!is_null($title))
        {
            $baseViewData['title'] = $title;
        }

        return $CI->load->view('base', $baseViewData);
    }
}