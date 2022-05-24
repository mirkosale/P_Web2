<?php

/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les recettes
 */

class UserController extends Controller
{

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display()
    {
        $action = $_GET['action'] . "Action";

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: listAction, detailAction, ...))
        return call_user_func(array($this, $action));
    }

    /**
     * Gère l'affichage de la page de connexion / déconnexion
     */
    private function connectionAction()
    {
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/login.php');
        } else {
            $view = file_get_contents('view/page/user/logout.php');
        }
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Gère la connexion au site web
     */
    private function loginAction()
    {
        //Check de si la page de check a été accédée via le formulaire
        if (isset($_POST['btnSubmit'])) {
            $username = htmlspecialchars($_POST['user']);
            $password = htmlspecialchars($_POST['password']);

            $database = new Database();
            $users = $database->getAllUsers();

            //Check de si les informations entrées correspondent aux informations d'un utilisateur
            foreach ($users as $user) {
                if ($user['useLogin'] == $username && password_verify($password, $user['usePassword'])) {
                    //Création de la session
                    $_SESSION['useLogin'] = $user['useLogin'];
                    $_SESSION['useAdministrator'] = $user['useAdministrator'];

                    //Redirection à la page d'accueil
                    header('Location: index.php');
                }
            }

            //Check de si l'utilisateur a été correctement connecté ou non
            if (!isset($_SESSION['useLogin'])) {
                $view = file_get_contents('view/page/user/badLogin.php');
            }
        } else {
            $view = file_get_contents('view/page/user/noSubmit.php');
        }

        if (isset($view)) {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        }
    }

    /**
     * Gère la déconnexion au site
     */
    private function logoutAction()
    {
        session_destroy();

        header('Location: index.php');
    }
}
