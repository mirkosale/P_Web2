<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les recettes
 */

include_once 'model/UserRepository.php';

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

    private function connexionAction()
    {
        if (isset($_SESSION['useLogin']))
        {
            $view = file_get_contents('view/page/user/loginForm.php');
        }
        else
        {
            $view = file_get_contents('view/page/user/logoutForm.php');
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
        $response = $database->getOneUser($username, $password);
        
        // Si la connexion n'est pas faux
        if ($response != false) {
            //Ajout la session dans la bd
            $idSession = $database->addSession($response[0]['idUser']);
        
            // Création cookie de connexion
            setcookie('idSession', $idSession, time() + 30 * 24 * 60 * 60);
        }
        // Redirection
        header('Location: index.php');
    }

    private function logoutAction()
    {

    }
}