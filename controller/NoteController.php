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

    private function addAction()
    {
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }
        if (isset($_SESSION['useLogin']) && !isset($_GET['id'])) {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }

        if (isset($_SESSION['useLogin']) && isset($_GET['id']) && !isset($_POST['stars'])) {
            $view = file_get_contents('view/page/note/noStars.php');
        }

        if (isset($_SESSION['useLogin']) && isset($_GET['id']))
        {
            $db = new Database();
            $recipe = $db->getOneRecipe($_GET['id']);;

            if (!isset($recipe[0]))
            {
                $view = file_get_contents('view/page/recipe/badRecipe.php');
            }
        }

        if (!isset($view)) {
            $idUser = $db->getLoggedUserID($_SESSION['useLogin']);
            $db->addNote($_POST['stars'], $_GET['id'], $idUser);
            header('Location: ?controller=recipe&action=detail&id=' . $_GET['id']);
        }
        else
        {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
        
            return $content;
        }
    }

    private function deleteAction()
    {
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        if (isset($_SESSION['useLogin']) && !isset($_GET['id'])) {
            $view = file_get_contents('view/page/recipe/badNote.php');            
        }

        $db = new Database();
        $loggedUserId = $db->getLoggedUserID($_SESSION['useLogin']);
        $noteUserId = $db->getNoteUser($_GET['id']);

        if (!isset($noteUserId))
        {
            $view = file_get_contents('view/page/note/badNote.php');            
        }

        if ($loggedUserId[0]['idUser'] != $noteUserId[0]['fkUser'])
        {
            $view = file_get_contents('view/page/note/noRights.php');            
        }

        if (isset($view)) {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        } else {
            $db->deleteNote($_GET['id']);

            header('Location: ?controller=recipe&action=detail&id=' . $_GET['id']);

            die;
        }
    }
}
