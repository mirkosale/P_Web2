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
     * Affiche la page correcte
     *
     * @return mixed
     */
    public function display()
    {
        $action = $_GET['action'] . "Action";

        return call_user_func(array($this, $action));
    }

    /**
     * Affiche la page d'accueil index
     *
     * @return string
     */
    private function indexAction()
    {
        #Récupère la dernière recette
        $db = new Database();
        $latestRecipe = $db->getLatestRecipe();
        $latestRecipe[0]['note'] = $db->getRecipeNoteAverage($latestRecipe[0]['idRecipe'])[0]['AVG(notStars)'];

        $view = file_get_contents('view/page/home/index.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
<<<<<<< HEAD
     * Check contact Form action
     *
     * @return string
=======
     * Affiche la page de contact
     *
     * @return string
     */
    private function contactAction()
    {
        $database = new Database();

        $view = file_get_contents('view/page/home/contact.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Va prendre les informations entrées dans la page de contact et les valider
     * 
     * A ajouter : retourner et stocker les informations dans une DB
>>>>>>> 4fdb30d97e96fc462cb686c2fe420cde4197dcd4
     */
    private function checkContactAction()
    {
        //Vérification de si l'utilisateur a bel et bien utilisé le formulaire pour accéder à la page
        if (isset($_POST['btnSubmit'])) {

            $errors = array();
            $recipeData = array();

            $database = new Database();
            $name = trim(htmlspecialchars($_POST["name"]));
            $email = trim(htmlspecialchars($_POST["email"]));
            $address = trim(htmlspecialchars($_POST["address"]));
            $phoneNumber = trim(htmlspecialchars($_POST["phoneNumber"]));
            $message = trim(htmlspecialchars($_POST["message"]));

            #Check de si toutes les informations entrées ne sont pas vide
            if (!isset($name) || empty($name)) {
                $errors[] = "Vous devez entrer un nom";
            }
            if (!isset($email) || empty($email)) {
                $errors[] = "Vous devez entrer un email";
            }

            #Check de si le numéro de téléphone contient uniquement des bons symboles et est au moins de 5 de long
            if (isset($phoneNumber) && !empty($phoneNumber) && !preg_match("/^[0-9+-]{5,}$/", $phoneNumber)) {
                $errors[] = "Vous devez entrer un numéro de téléphone qui fait au minimum 5 de longueur avec uniquement des chiffres et des +, / et -";
            }
            if (!isset($message) || empty($message)) {
                $errors[] = "Vous devez entrer un message";
            }

            #Retour à l'accueil si aucune erreur
            if (empty($errors)) {
                $recipeData["name"] = $name;
                $recipeData["email"] = $email;
                $recipeData["address"] = $address;
                $recipeData["phoneNumber"] = $phoneNumber;
                $recipeData["message"] = $message;

                $view = file_get_contents('view/page/home/index.php');
            } else {
                $view = file_get_contents('view/page/home/errors.php');
            }
        } else {
            $view = file_get_contents('view/page/home/noSubmit.php');
        }

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
}
