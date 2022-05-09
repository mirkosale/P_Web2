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

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: listAction, detailAction, ...))
        return call_user_func(array($this, $action));
    }

    private function addAction()
    {
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }
        if (isset($_SESSION['useLogin']) && !isset($_GET['id']) || !isset($_GET['stars'])) {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }
        if (isset($view)) {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        } else {
            $db = new Database();
            $users = $db->getAllUsers();

            foreach ($users as $user) {
                if ($_SESSION['useLogin'] == $user['useLogin']) {
                    $idUser = $user['idUser'];
                }
            }

            $db->addNote($_GET['stars'], $_GET['id'], $idUser);
        }
    }

    private function deleteAction()
    {
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        if (isset($_SESSION['useLogin']) && !isset($_GET['id'])) {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }

        if (isset($view)) {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        } else {
            $db = new Database();
            $db->deleteNote($_GET['id']);

            header('Location: index.php');
            die;
        }
    }
}
