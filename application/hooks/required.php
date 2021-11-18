<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function required() {
    $CI = & get_instance();

    $CI->load->library('Ion_auth');
    //$CI->load->library('REST_Controller');
    $CI->load->library('session');
    $CI->load->library('form_validation');
    $CI->load->library('upload');

    $CI->load->config('paypal');
    
    
    
    $RTR = & load_class('Router');
    
    if($RTR->class != "client" && $RTR->class != "volunteer_details"){
        
     if ($RTR->class != "frontend" && $RTR->class != "auth") {
        if (!$CI->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }
    

    $language = $CI->db->get('settings')->row()->language;
    $CI->lang->load('system_syntax', $language);

    $CI->load->model('settings/settings_model');
    $CI->load->model('ion_auth_model');


    $CI->load->model('party/party_model');



    if ($RTR->class != "auth") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            if ($CI->ion_auth->in_group(array('admin'))) {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $CI->party_id = $CI->db->get_where('party', array('ion_user_id' => $current_user_id))->row()->id;

                if (!empty($CI->party_id)) {
                    $newdata = array(
                        'party_id' => $CI->party_id,
                    );
                    $CI->session->set_userdata($newdata);
                }
            } else {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $group_id = $CI->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $CI->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $CI->party_id = $CI->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->party_id;
                if (!empty($CI->party_id)) {
                    $newdata = array(
                        'party_id' => $CI->party_id,
                    );
                    $CI->session->set_userdata($newdata);
                }
            }
        }
    }


    }

   
}
