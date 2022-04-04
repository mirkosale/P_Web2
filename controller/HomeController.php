<?php

/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les pages classiques
 */
include_once 'model/Database.php';

class HomeController extends Controller
{

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display()
    {

        $action = $_GET['action'] . "Action";

        return call_user_func(array($this, $action));
    }

    /**
     * Display Index Action
     *
     * @return string
     */
    private function indexAction()
    {

        $view = file_get_contents('view/page/home/index.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Contact Action
     *
     * @return string
     */
    private function contactAction()
    {

        $view = file_get_contents('view/page/home/contact.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Check Form action
     *
     * @return string
     */
    private function checkAction()
    {

        $lastName = htmlspecialchars($_POST['lastName']);
        $firstName = htmlspecialchars($_POST['firstName']);
        $answer = htmlspecialchars($_POST['answer']);

        $view = file_get_contents('view/page/home/resume.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    private function connexionAction()
    {
        $view = file_get_contents('view/page/home/connexion.php');

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
        $database = new Database();
        $response = $database->getOneUser($_POST['user'], $_POST['password']);
        
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
}
