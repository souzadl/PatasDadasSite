<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

class Auth {

    var $CI;
    var $auth_table_name;
    var $auth_username_field;
    var $auth_password_field;

    /**
     * Constructor
     *
     * Loads the calendar language file and sets the default time reference
     *
     * @access	public
     */
    public function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->database();
        $this->CI->config->load('auth');

        $this->auth_table_name = $this->CI->config->item('auth_table_name');
        $this->auth_username_field = $this->CI->config->item('auth_username_field');
        $this->auth_password_field = $this->CI->config->item('auth_password_field');

        log_message('debug', "Authentication Class Initialized");
    }

    // --------------------------------------------------------------------

    /**
     * Try login with params
     *
     * @access	public
     * @param	string
     * @param	string
     * @return	object
     */
    public function try_login($username, $password) {

        $where = array(
            $this->auth_username_field => $username
        );

        $userdata = $this->CI->db->query("SELECT * FROM `$this->auth_table_name` WHERE `login` = '$username'");
        $query = $userdata->row();

        if (@$query->login != NULL) {
            if ($query->ativo == "N") {
                $output = FALSE;
                $this->CI->session->set_flashdata('respostaLogin', 'O usuário não está ativo');
            } else {
                $row = $query;
                if ($password == $this->CI->encrypt->decode($row->senha)) {

                    $session = array(
                        'lavie_id_usuario' => $this->CI->encrypt->encode($row->id_usuario),
                        'lavie_login_nome' => $row->nome,
                        'lavie_login_email' => $row->email,
                        'lavie_login_usuario' => $row->login,
                        'lavie_login_senha' => $row->senha
                    );

                    $this->CI->session->set_userdata($session);

                    $output = TRUE;
                } else {
                    $output = FALSE;
                    //$this->CI->session->set_flashdata('resposta', 'A Senha não está correta!');
                    $this->CI->session->set_flashdata('respostaLogin', 'Login ou senha incorretos');
                }
            }
        } else {
            $output = FALSE;
            //$this->CI->session->set_flashdata('resposta', 'O Usuário não está correto!');
            $this->CI->session->set_flashdata('respostaLogin', 'Login ou senha incorretos');
        }

        return $output;
    }

    // --------------------------------------------------------------------

    /**
     * Check if logged
     *
     * @access	public
     * @return	void
     */
    function check() {
        $where = array(
            $this->auth_username_field => ($this->CI->session->userdata('lavie_login_usuario')) ? $this->CI->session->userdata('lavie_login_usuario') : "",
            $this->auth_password_field => ($this->CI->session->userdata('lavie_login_senha')) ? $this->CI->session->userdata('lavie_login_senha') : ""
        );

        //$userdata 	= $this->CI->db->query("SELECT * FROM `$this->auth_table_name` WHERE `login` = '$username'");
        //$query 		= $userdata->row();

        $query = $this->CI->db->get_where($this->auth_table_name, $where, 1);

        /* echo "<pre>";
          print_r($query->result_id->num_rows);
          echo "</pre>";
          exit; */

        if ($query->result_id->num_rows != 1) {
            redirect("login/");
        }
    }

    // --------------------------------------------------------------------

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function logout() {
        $this->CI->session->sess_destroy();
    }

    // --------------------------------------------------------------------
}

// END CI_Authentication class

/* End of file Auth.php */
/* Location: ./system/libraries/Auth.php */