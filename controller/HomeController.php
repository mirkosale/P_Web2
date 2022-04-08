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
    private function addRecipeAction()
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
     * Check contact Form action
     *
     * @return string
     */
    private function checkContactAction()
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

}
