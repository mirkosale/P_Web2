<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les recettes
 */

class RecipeController extends Controller {
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

    /**
     * Rechercher les données et les passe à la vue (en liste)
     *
     * @return string
     */
    private function listAction() {

        // Instancie le modèle et va chercher les informations
        $db = new Database();
        $recipes = $db->getAllRecipe();

        // Charge le fichier pour la vue
        $view = file_get_contents('view/page/recipe/list.php');


        // Pour que la vue puisse afficher les bonnes données, il est obligatoire que les variables de la vue puisse contenir les valeurs des données
        // ob_start est une méthode qui stoppe provisoirement le transfert des données (donc aucune donnée n'est envoyée).
        ob_start();
        // eval permet de prendre le fichier de vue et de le parcourir dans le but de remplacer les variables PHP par leur valeur (provenant du model)
        eval('?>' . $view);
        // ob_get_clean permet de reprendre la lecture qui avait été stoppée (dans le but d'afficher la vue)
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Rechercher les données et les passe à la vue (en détail)
     *
     * @return string
     */
    private function detailAction() {

        $db = new Database();
        $recipe = $db->getOneRecipe($_GET['id']);;

        $view = file_get_contents('view/page/recipe/detail.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Supprime une recette de la base de données
     */
    private function deleteAction()
    {
        if (!isset($_SESSION['useLogin']))
        {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] != 1)
        {
            $view = file_get_contents('view/page/user/noRights.php');
        }

        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] == 1 && !isset($_GET['id']))
        {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }

        if (isset($view))
        {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
    
            return $content;
        }
        else
        {
            $db = new Database();
            $db->deleteRecipe($_GET['id']);

            header('Location: index.php');
            die;
        }
    }

    /**
     * Display Contact Action
     *
     * @return string
     */
    private function addRecipeAction()
    {
   
        $database = new Database();
    
        $typedish = $database->getAllTypedish();

        $view = file_get_contents('view/page/recipe/addRecipe.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Vérifie que les champs ont bien été entrés correctement pour l'ajout d'une recette
     */
    private function checkAddAction()
    {
        $errors = array();

        $database = new Database();  
        
        $name = htmlspecialchars($_POST["name"]);
        $itemList = htmlspecialchars($_POST["itemList"]);
        $preparation = htmlspecialchars($_POST["preparation"]);

        /**
         * Vérification que l'utilisateur ait bien entré le nom de la recette
         */
        if (!isset($name)) {
            $errors[] = "Vous devez choisir le nom de votre recette";
        }
        
        /**
         * Vérification que l'utilisateur ait bien entré la list des ingrédients
         */
        if (!isset($itemList)) {
            $errors[] = "Vous devez entrer une liste d'ingrédients";
        } 
        
        /**
         * Vérification que l'utilisateur ait bien entré la préparation de la recette
         */
        if (!isset($preparation)) {
            $errors[] = "Vous devez entrer la préparation de la recette";
        }
        
        /**
         * Vérification de si l'utilisateur a mal rempli ses informations et écriture de la liste de ces dernières.
         * S'il a bien rempli les informations, redirection à la page d'acceuil.
         */
        if (empty($errors)) {
            $addRecipe = $database->InsertRecipe($name);
            header("Location: .\\index.php");
            die();
        } else {
        
            /**
             * Écriture de toutes les erreurs que l'utilisateur a provoquées.
             */
            foreach ($errors as $error) {
                echo '<li>';
                echo $error;
                echo '</li>';
            }
        }        
    }
}