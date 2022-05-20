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
        $db = new Database();
        $latestRecipe = $db->getLatestRecipe();

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
   
        $database = new Database();
    
        $typedish = $database->getAllTypedish();

        $view = file_get_contents('view/page/home/contact.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;

    }

    
    private function checkRecipeAction($modifyOrAdd)
    {
        
    }

     /**
     * Check si lutilisateur a bien rentré toutes les informations requises pour nous contacter
     */
    private function checkContactAction()
    {
        //Instancie le modèle et va chercher les informations
        $errors = array();
        $recipeData = array();

        $database = new Database();
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);
        $imagePath = "resources/images/" . $_POST["imagePath"];
        $typedish = $_POST["typedish"];
        /**
         * Vérification que l'utilisateur ait bien entré son nom
         */
        if (!isset($name)) {
            $errors[] = "Vous devez entrer votre nom";
        }

        /**
         * Vérification que l'utilisateur ait bien entré son email
         */
        if (!isset($email)) {
            $errors[] = "Vous devez entrer votre email";
        }

        /**
         * Vérification que l'utilisateur ait bien entré le message à passé
         */
        if (!isset($message)) {
            $errors[] = "Vous devez entrer la préparation de la recette";
        }

       
    }

}
