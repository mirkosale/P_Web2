<?php

/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les recettes
 */

class NoteController extends Controller
{
    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display()
    {

        $action = $_GET['action'] . "Action";

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: addAction, deleteAction, ...))
        return call_user_func(array($this, $action));
    }

    /**
     * Vérifie que la note ajoutée à une recette a été correctement ajoutée
     */
    private function addAction()
    {
        #Check si l'utilisateur est connecté
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        #Check si l'ID de la recette a été entré
        if (isset($_SESSION['useLogin']) && !isset($_GET['id'])) {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }

        #Check si le nombre d'étoiles a été entré
        if (isset($_SESSION['useLogin']) && isset($_GET['id']) && !isset($_POST['stars'])) {
            $view = file_get_contents('view/page/note/noStars.php');
        }

        #Vérification de si la recette avec l'ID correspondant existe
        if (isset($_SESSION['useLogin']) && isset($_GET['id'])) {
            $db = new Database();
            $recipe = $db->getOneRecipe($_GET['id']);;

            if (!isset($recipe[0])) {
                $view = file_get_contents('view/page/recipe/badRecipe.php');
            }
        }

        #Si la note a été bien ajoutée, retour à la page de détail (refresh)
        if (!isset($view)) {
            $idUser = $db->getLoggedUserID($_SESSION['useLogin']);

            $db->addNote($_POST['stars'], $_GET['id'], $idUser[0]['idUser']);
            header('Location: ?controller=recipe&action=detail&id=' . $_GET['id']);
        } else {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        }
    }

    /**
     * Gère la suppresion d'une note d'une recette
     */
    private function deleteAction()
    {
        #Check si l'utilisateur est connecté
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        #Check si l'ID de la note a été entré
        if (isset($_SESSION['useLogin']) && !isset($_GET['idNote'])) {
            $view = file_get_contents('view/page/recipe/badNote.php');
        }

        #Récupération de l'ID de l'utilisateur actif et des informations de la note
        $db = new Database();
        $loggedUserId = $db->getLoggedUserID($_SESSION['useLogin']);
        $noteUserId = $db->getNoteUser($_GET['idNote']);

        #Vérifie si la note entrée existe bien
        if (!isset($noteUserId)) {
            $view = file_get_contents('view/page/note/badNote.php');
        }

        #Vérifie que ce soit bien la note de l'utilisateur qui soit supprimée et non une autre
        if ($loggedUserId[0]['idUser'] != $noteUserId[0]['fkUser']) {
            $view = file_get_contents('view/page/note/noRights.php');
        }

        #Affichage de la page d'erreur correspondante
        if (isset($view)) {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        } else {
            #Suppression de la note et retour à la page de détail de la recette (refresh)
            $db->deleteNote($_GET['idNote']);

            header('Location: ?controller=recipe&action=detail&id=' . $_GET['idRecipe']);

            die;
        }
    }
}
