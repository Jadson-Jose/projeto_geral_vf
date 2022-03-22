<?php

namespace App\Models;

use CodeIgniter\Model;


class UsersModel extends Model
{


    protected $database;


    // ===========================================================================
    public function __construct()
    {
        $this->database = db_connect();
    }



    // ===========================================================================
    public function verify_login($username, $password)
    {

        $params = array(
            $username,
            md5(sha1($password))
        );

        $query = "SELECT * FROM users WHERE username = ? AND passwrd = ? AND deleted = 0";
        $results = $this->database->query($query, $params)->getResult('array');

        if (empty($results)) {
            return false;
        } else {

            // Update last_login in the database
            $params = array(
                $results[0]['id_user']
            );
            $this->database->query("UPDATE users SET last_login = NOW() WHERE id_user = ?", $params);

            // Return valid login
            return $results[0];
        }
    }


    // ===========================================================================
    public function reset_password($email)
    {

        // Resets the users password

        // Check if there is a user with the email
        $params = array(
            $email
        );
        $query = "SELECT id_user FROM users WHERE email = ?";
        $results = $this->database->query($query, $params)->getResult('array');

        if (count($results) != 0) {
            // existe o email

            // Change the user's password
            $newPassword = $this->randomPassword();
            $params = array(
                md5(sha1($newPassword)),
                $results[0]['id_user']
            );

            $query = "UPDATE users SET passwrd = ? WHERE id_user = ?";
            $this->database->query($query, $params);

            // Show the new password
            echo '(Mesagem de email)';
            echo "A sua mensagem e : $newPassword";

            // 641d3ac5e969efd385fdbfe1c134bb75


            return true;
        } else {
            // Nao existe o email
            echo "Não existe esse e-mail registrado.";
            return false;
        }
    }

    // ===========================================================================
    public function check_email($email)
    {

        // Checks if the email is from a user's account.
        $params = array(
            $email
        );
        $query = "SELECT id_user FROM users WHERE email = ?";
        return $this->database->query($query, $params)->getResult('array');
    }


    // ===========================================================================
    public function send_purl($email, $id_user)
    {

        $purl = $this->randomPassword(6);
        $params = array(
            $purl,
            $id_user
        );
        $query = "UPDATE users SET purl = ? WHERE id_user = ?";
        $this->database->query($query, $params);

        // Envio do email
        echo '(mensagem de email) Link para redefinir a sua password';
        echo '<a href = "' . site_url('users/redefine_password/' . $purl) . '">Redefinir password</a>';

        http: //localhost/projeto_geral_vf/public/index.php/users/redefine_password/lpQXiD
    }

    // ===========================================================================
    public function get_purl($purl)
    {

        // Returns the row with the given purl
        $params = array(
            $purl
        );

        $query = "SELECT id_user FROM users WHERE purl = ?";
        return $this->database->query($query, $params)->getResult('array');
    }


    // ===========================================================================
    public function redefine_password($id, $pass)
    {

        // Update the user's password
        $params = array(
            md5(sha1($pass)),
            $id
        );
        $query = "UPDATE users SET passwrd = ? WHERE id_user = ?";
        $this->database->query($query, $params);

        // Remove the purl from the user
        $params = array(
            $id
        );
        $this->database->query("UPDATE users SET purl = '' WHERE  id_user = ?", $params);
    }

    // ===========================================================================
    public function get_users()
    {

        // Retuns all users in the database
        $query = "SELECT * FROM users";
        return $this->database->query($query)->getResult('array');
    }

    // ===========================================================================
    public function get_user($id_user)
    {

        // Retun a user in the database
        $params = array($id_user);
        $query = "SELECT * FROM users WHERE id_user = ?";
        return $this->database->query($query, $params)->getResult('array');
    }

    // ===========================================================================
    public function check_if_user_exists()
    {

        // Check is there is already an user with the same username or email address
        $request = \Config\Services::request();
        $dados = $request->getPost();

        $params = array(
            $dados['text_username'],
            $dados['text_email']
        );

        return $this->database->query("SELECT id_user FROM users WHERE username = ? OR email = ?", $params)->getResult('array');
    }

    // ===========================================================================
    public function check_another_user_email($id_user)
    {

        // Check is there is already an another uasser with the same email address
        $request = \Config\Services::request();
        $dados = $request->getPost();

        $params = array(
            $dados['text_email'],
            $id_user
        );

        return $this->database->query("SELECT id_user FROM users WHERE email = ? AND id_user <> ?", $params)->getResult('array');
    }

    // ===========================================================================
    public function edit_user()
    {

        // Editar os dados do utilizador na BD
        $request = \Config\Services::request();
        $dados = $request->getPost();


        // Profile
        $profile_temp = array();
        if (isset($dados['check_admin'])) {
            array_push($profile_temp, 'admin');
        }

        if (isset($dados['check_moderator'])) {
            array_push($profile_temp, 'moderator');
        }

        if (isset($dados['check_user'])) {
            array_push($profile_temp, 'user');
        }

        $profile = implode(',', $profile_temp);

        $params = array(
            $dados['text_name'],
            $dados['text_email'],
            $profile,
            $dados['id_user']
        );

        $query = "UPDATE users SET name = ?, email = ?, profile = ? WHERE id_user = ?";
        $this->database->query($query, $params);
    }

    // ===========================================================================
    public function add_new_user()
    {
        $request = \Config\Services::request();
        $dados = $request->getPost();


        // Profile
        $profile_temp = array();
        if (isset($dados['check_admin'])) {
            array_push($profile_temp, 'admin');
        }

        if (isset($dados['check_moderator'])) {
            array_push($profile_temp, 'moderator');
        }

        if (isset($dados['check_user'])) {
            array_push($profile_temp, 'user');
        }

        $profile = implode(',', $profile_temp);



        $params = array(
            $dados['text_username'],
            md5(sha1($dados['text_password'])),
            $dados['text_name'],
            $dados['text_email'],
            $profile
        );

        $this->database->query("INSERT INTO users(username, passwrd, name, email, profile) VALUES(?,?,?,?,?)", $params);
    }

    // ===========================================================================
    public function delete_users($id_user)
    {
        $params = array(
            $id_user
        );

        $this->database->query('UPDATE users SET deleted = UNIX_TIMESTAMP() WHERE id_user = ?', $params);
    }


    // ===========================================================================
    public function recover_user($id_user)
    {
        // Recover deleted user
        $params = array(
            $id_user
        );

        $this->database->query('UPDATE users SET deleted = 0 WHERE  id_user = ?', $params);
    }




    // ===========================================================================
    private function randomPassword($num_chars = 8)
    {

        // Generates a random password
        $chars = 'abcdefghijklmnopqxywzABCDEFGHIJKLMNOPQXYWZ0123456789abcdefghijklmnopqxywzABCDEFGHIJKLMNOPQXYWZ0123456789abcdefghijklmnopqxywzABCDEFGHIJKLMNOPQXYWZ0123456789';
        return substr(str_shuffle($chars), 0,  $num_chars);
    }
}
