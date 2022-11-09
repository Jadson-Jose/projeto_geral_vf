<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{

    protected $session;



    // ===========================================================================
    public function __construct()
    {
        $this->session = session();
    }


    // ===========================================================================
    public function index()
    {
        // Check if there is an active session
        if ($this->check_session()) {

            // Active session
            $this->homePage();
        } else {
            // Show the form
            $this->login();
        }
    }



    // ===========================================================================
    public function login()
    {

        // Check session if there is session goes to the homepage
        if ($this->check_session()) {
            $this->homePage();
            return;
        }

        $error = '';
        $data = array();
        $request = \Config\Services::request();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $request->getPost('text_username');
            $password = $request->getPost('text_password');

            if ($username == '' || $password == '') {
                $error = "Erro no preenchimento dos campos.";
            }

            // Check to the database
            if ($error == '') {
                $model = new UsersModel();
                $result = $model->verify_login($username, $password);

                if (is_array($result)) {
                    // Valid login
                    $this->setSession($result);
                    $this->homePage();
                    return;
                } else {
                    // Invalid login
                    $error = "Login inválido.";
                }
            }
        }

        if ($error != '') {
            $data['error'] = $error;
        }


        // Show the login page
        echo view('users/login', $data);
    }


    // ===========================================================================
    private function setSession($data)
    {
        // Init session

        $session_data = array(
            'id_user' => $data['id_user'],
            'name' => $data['name'],
            'profile' => $data['profile']
        );


        $this->session->set($session_data);
    }


    // ===========================================================================
    public function homePage()
    {
        // Check if session exists
        if (!$this->check_session()) {
            $this->login();
            return;
        }

        // Check if user is admin
        $data = array();
        if ($this->check_profile('admin')) {
            $data['admin'] = true;
        }

        // Show homepage view
        echo view('users/homepage', $data);
    }


    // ===========================================================================
    public function logout()
    {

        // Logout
        $this->session->destroy();

        return redirect()->to('users');
    }

    // ===========================================================================
    public function recover()
    {

        // Show form the login password
        echo view('users/recover_password');
    }

    // ===========================================================================
    public function reset_password()
    {
        $request = \Config\Services::request();
        $email = $request->getPost('text_email');
        $users = new UsersModel();
        $result = $users->check_email($email);

        if (count($result) != 0) {

            // Exsite um email associado
            $users->send_purl($email, $result[0]['id_user']);
        } else {

            // Nao existe email
            echo "Não existe o email associado.";
        }
    }

    // ===========================================================================
    public function redefine_password($purl)
    {

        $users = new UsersModel();
        $results = $users->get_purl($purl);

        if (count($results) == 0) {

            // No purl found.Redirects to main
            return redirect()->to(site_url('main'));
        } else {

            $data['user'] = $results[0];

            echo view('users/redefine_password_submit', $data);
        }
    }

    // ===========================================================================
    public function redefine_password_submit()
    {

        $request = \Config\Services::request();
        $id_user = $request->getPost('text_id_user');
        $new_password = $request->getPost('text_new_password');
        $new_password_repeated = $request->getPost('text_repeat_password');

        $error = '';

        // Check if passwords match
        if ($new_password != $new_password_repeated) {
            $error = 'As senhas não são iguais.';
            die($error);
        }

        // Updates the new password
        if ($error == '') {
            $users = new UsersModel();
            $users->redefine_password($id_user, $new_password);
        }
    }


    // ===========================================================================
    public function teste($value)
    {

        if ($this->check_profile($value)) {
            echo 'existe';
        } else {
            echo 'Nao Existe';
        }
    }


    // ===========================================================================
    public function op1()
    {
        echo 'op1';
    }


    // ===========================================================================
    public function op2()
    {
        echo 'op2';
    }



    // ===========================================================================
    // ADMIN
    // ===========================================================================
    public function admin_users()
    {


        // Check session if there is session goes to the homepage
        if (!$this->check_session()) {
            $this->homePage();
            return;
        }

        // Check if the user has permission
        if (!$this->check_profile('admin')) {
            return redirect()->to('users');
        }

        // Bucar a lista de utilizadores registrados.
        $users = new UsersModel();
        $results = $users->get_users();
        $data['users'] = $results;

        echo view('users/admin_users', $data);
    }


    // ===========================================================================
    public function admin_new_user()
    {

        // Check session if there is session goes to the homepage
        if (!$this->check_session()) {
            $this->homePage();
            return;
        }

        // Check if the user has permission
        if (!$this->check_profile('admin')) {
            return redirect()->to('users');
        }

        // Adds new user to the database
        $error = '';
        $data = array();

        // verify if  there was a submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Will get the post data
            $request = \Config\Services::request();
            $dados = $request->getPost();

            // check if the correct data came
            if (
                $dados['text_username'] == '' ||
                $dados['text_password'] == '' ||
                $dados['text_repeat_password'] == '' ||
                $dados['text_name'] == '' ||
                $dados['text_email'] == ''
            ) {
                $error = 'Preencha todos os campos.';
            }

            // Check if passwords match
            if ($error == '') {

                if ($dados['text_password'] !=  $dados['text_repeat_password']) {
                    $error = 'As senhas são diferentes.';
                }
            }

            // Check id at least one check the profile id checked
            if ($error == '') {
                if (
                    !isset($dados['check_admin']) &&
                    !isset($dados['check_moderator']) &&
                    !isset($dados['check_user'])
                ) {
                    $error = 'Indique pelo menos um tipo de perfil.';
                }
            }

            // Check if there is already a user with the same usename or email
            $model = new UsersModel();
            if ($error == '') {
                $result = $model->check_if_user_exists();
                if (count($result) != 0) {
                    $error = "Já existe um utilizador com esses dados.";
                }
            }

            if ($error == '') {
                $model->add_new_user();
                return redirect()->to(site_url('users/admin_users'));
            }
        }

        // Check if there is an error
        if ($error != '') {
            $data['error'] = $error;
        }

        echo view('users/admin_new_user', $data);
    }

    // ===========================================================================
    public function admin_edit_user($id_user)
    {

        if ($id_user == $this->session->id_user) {
            return redirect()->to(site_url('users'));
        }

        // Check session if there is session goes to the homepage
        if (!$this->check_session()) {
            $this->homePage();
            return;
        }

        // Check if the user has permission
        if (!$this->check_profile('admin')) {
            return redirect()->to('users');
        }

        $error = '';
        $data = array();

        // If there is was a submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //  Check if the data is correct
            $request = \Config\Services::request();
            $dados = $request->getPost();

            if (
                $dados['text_name'] == '' ||
                $dados['text_email'] == ''
            ) {
                $error = 'Preencha todos os campos.';
            }

            if ($error == '') {

                // Checks id at least one profile check was checked
                if (
                    !isset($dados['check_admin']) &&
                    !isset($dados['check_moderator']) &&
                    !isset($dados['check_user'])
                ) {
                    $error = 'Indique pelo menos, um tipo de perfil.';
                }
            }


            // Check if there is another user with the same data
            $model = new UsersModel();
            if ($error == '') {
                $results = $model->check_another_user_email($dados['id_user']);

                if (count($results) != 0) {
                    $error = 'Já existe outro utilizador com o mesmo email.';
                }
            }

            // Save and update data in the database.
            if ($error == '') {
                $model->edit_user();
                return redirect()->to(site_url('users/admin_users'));
            }
        }

        // Open the board for user editing
        $users = new UsersModel();

        // Check if suer data came
        $user = $users->get_user($id_user);
        if (count($user) == 0 || $user[0]['id_user'] == $this->session->id_user) {
            return redirect()->to(site_url('users/admin_users'));
        }

        $data['user'] = $user[0];

        if ($error != '') {
            $data['error'] = $error;
        }
        echo view('users/admin_edit_user', $data);
    }

    // ===========================================================================
    public function admin_delete_user($id_user, $response = '')
    {

        if ($id_user == $this->session->id_user) {
            return redirect()->to(site_url('users'));
        }

        // Check session if there is session goes to the homepage
        if (!$this->check_session()) {
            $this->homePage();
            return;
        }

        // Check if the user has permission
        if (!$this->check_profile('admin')) {
            return redirect()->to('users');
        }

        $model = new UsersModel();

        // Check if the answer came
        if ($response == 'yes') {
            $model->delete_users($id_user);
            return redirect()->to(site_url('users/admin_users'));
        }

        // Ask if you want to delete the user

        $data['user'] = $model->get_user($id_user)[0];


        echo view('users/admin_delete_user', $data);
    }

    // ===========================================================================
    public function admin_recover_user($id_user, $response = '')
    {

        if ($id_user == $this->session->id_user) {
            return redirect()->to(site_url('users'));
        }

        // Check session if there is session goes to the homepage
        if (!$this->check_session()) {
            $this->homePage();
            return;
        }

        // Check if the user has permission
        if (!$this->check_profile('admin')) {
            return redirect()->to('users');
        }

        $model = new UsersModel();

        // Check if the answer came
        if ($response == 'yes') {
            $model->recover_user($id_user);
            return redirect()->to(site_url('users/admin_users'));
        }

        //  Ask if you want to recover user
        $data['user'] = $model->get_user($id_user)[0];

        echo view('users/admin_recover_user', $data);
    }



    // ===========================================================================
    // PRIVATE  
    // ===========================================================================
    private function check_session()
    {
        // Verifica se exsite sessao
        return $this->session->has('id_user');
    }

    // ===========================================================================
    private function check_profile($profile)
    {

        // Check if the user has permission to acess fature
        if (preg_match("/$profile/", $this->session->profile)) {
            return true;
        } else {
            return false;
        }
    }
}
