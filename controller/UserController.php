<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les recettes
 */

class UserController extends Controller {

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: listAction, detailAction, ...))
        return call_user_func(array($this, $action));
    }

    private function connectionAction()
    {
        if (!isset($_SESSION['useLogin']))
        {
            $view = file_get_contents('view/page/user/login.php');
        }
        else
        {
            $view = file_get_contents('view/page/user/logout.php');
        }
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

        /**
     * Check Form submit
     *
     * @return string
     */
    private function loginAction()
    {
        $username = htmlspecialchars($_POST['user']);
        $password = htmlspecialchars($_POST['password']);

        $database = new Database();
        $users = $database->getAllUsers();
        
        foreach($users as $user)
        {
            if ($user['useLogin'] == $username && password_verify($password, $user['usePassword']))
            {
                //Ajout la session dans la bd
                $_SESSION['useLogin'] = $user['useLogin'];
                $_SESSION['useAdministrator'] = $user['useAdministrator'];

                // Redirection
                header('Location: index.php');
                die;
            }
        }

        header('Location: index.php?controller=user&action=badLogin');
    }

    private function badLoginAction()
    {
        $view = file_get_contents('view/page/user/badLogin.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    private function logoutAction()
    {
        session_destroy();

        header('Location: index.php');
    }
}