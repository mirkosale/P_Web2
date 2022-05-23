<?php

/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les recettes
 */

class RecipeController extends Controller
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
     * Rechercher les données et les passe à la vue (en liste)
     *
     * @return string
     */
    private function listAction()
    {
        // Instancie le modèle et va chercher les informations
        $db = new Database();
        $dishTypes = $db->getAllTypedish();

        //Check de si l'utilisateur a trié les recettes
        if (!isset($_GET['sort']) || $_GET['sort'] == 'all') {
            $recipes = $db->getAllRecipe();
        } else {
            $sort = trim(htmlspecialchars($_GET['sort']));

            $recipes = $db->getAllRecipeSort($sort);

            if (!isset($recipes)) {
                $view = file_get_contents('view/page/recipe/badSort.php');
            }
        }

        #Check si des recettes ont été enregistrées
        if (!isset($view)) {
            for ($x = 0; $x < count($recipes); $x++) {
                $recipeNote = $db->getRecipeNoteAverage($recipes[$x]['idRecipe']);

                #Récupération de la note pour chacune des recettes
                if (isset($recipeNote[0]['AVG(notStars)'])) {
                    $note = round($recipeNote[0]['AVG(notStars)']);
                    $recipes[$x]['note'] = $note;
                }
            }

            // Charge le fichier pour la vue
            $view = file_get_contents('view/page/recipe/list.php');
        }

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
    private function detailAction()
    {
        #Check si l'utilisateur est connecté
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        #Check si l'ID de la recette a été mis
        if (isset($_SESSION['useLogin']) && !isset($_GET['id'])) {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }

        #Check si la recette avec l'ID correspondant existe
        if (isset($_SESSION['useLogin']) && isset($_GET['id'])) {
            $db = new Database();
            $recipe = $db->getOneRecipe($_GET['id']);;
            $note = $db->getRecipeNoteOfUser($_GET['id'], $_SESSION['useLogin']);

            if (!isset($recipe[0])) {
                $view = file_get_contents('view/page/recipe/badRecipe.php');
            }
        }

        #Affichage de la page de détail si pas d'erreur
        if (!isset($view)) {
            $view = file_get_contents('view/page/recipe/detail.php');
        }

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
        #Check de si l'utilisateur est connecté
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        #Check de si l'utilisateur a les droits suffisants pour supprimer une recette
        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] != 1) {
            $view = file_get_contents('view/page/user/noRights.php');
        }

        #Check de si l'ID de la recette a été mis
        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] == 1 && !isset($_GET['id'])) {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }

        #Affichage de la page d'erreur
        if (isset($view)) {
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        } else {
            #Suppression de la recette et retour à la page de lsite
            $db = new Database();
            $db->deleteRecipe($_GET['id']);

            header('Location: index.php?controller=recipe&action=list');
            die;
        }
    }

    /**
     * Affiche la page d'ajout d'une recette
     */
    private function addRecipeAction()
    {
        #Check de si l'utilisateur est connecté
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        #Check de si l'utilisateur a les droits suffisants pour accéder à la page
        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] != 1) {
            $view = file_get_contents('view/page/user/noRights.php');
        }

        #Check de si une erreur a été trouvée
        if (!isset($view)) {
            $database = new Database();

            $typedish = $database->getAllTypedish();

            $view = file_get_contents('view/page/recipe/addRecipe.php');
        }

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
        if (isset($_POST['btnSubmit'])) {
            $errors = array();
            $recipeData = array();

            $database = new Database();

            $name = htmlspecialchars($_POST["name"]);
            $itemList = htmlspecialchars($_POST["itemList"]);
            $preparation = htmlspecialchars($_POST["preparation"]);
            $typedish = $_POST["typedish"];

            /**
             * Vérification que l'utilisateur ait bien entré le nom de la recette
             */
            if (!isset($name) || empty($name)) {
                $errors[] = "Vous devez choisir le nom de votre recette";
            }

            /**
             * Vérification que le nom de la recette ne soit pas trop long
             */
            elseif (strlen($name) > 30) {
                $errors[] = "Le nom de votre recette est trop long (30 charactères maximum)";
            }

            /**
             * Vérification que l'utilisateur ait bien entré la list des ingrédients
             */
            if (!isset($itemList)  || empty($itemList)) {
                $errors[] = "Vous devez entrer une liste d'ingrédients";
            }

            /**
             * Vérification que l'utilisateur ait bien entré la préparation de la recette
             */
            if (!isset($preparation)  || empty($preparation)) {
                $errors[] = "Vous devez entrer la préparation de la recette";
            }

            /**
             * Vérification que l'utilisateur ait bien entré une image ainsi que le bon format et pas trop lourde
             */
            if (!empty($_FILES["image"])) {
                if (
                    $_FILES["image"]["type"] == "image/jpeg"
                    || $_FILES["image"]["type"] == "image/png"
                    || $_FILES["image"]["type"] == "image/jpg"
                ) {
                    if ($_FILES["image"]["error"] == 1) {
                        $errors[] = "La taille est trop élévée, taille max 2MO";
                    }
                } else {
                    $errors[] = "Vous devez séléctionnez un fichier jpg ou png";
                }
            } else {
                $errors[] = "Vous devez insérrez une image !";
            }

            /**
             * Vérification de si l'utilisateur a mal rempli ses informations et écriture de la liste de ces dernières.
             * S'il a bien rempli les informations, ajout des informations dans la BDD et redirection à la page d'acceuil.
             */
            if (empty($errors)) {
                $recipeData["name"] = $name;
                $recipeData["itemList"] = $itemList;
                $recipeData["preparation"] = $preparation;
                $recipeData["image"] = date("YmdHis") . $_FILES["image"]["name"];
                $recipeData["typedish"] = $typedish;
                $source = $_FILES["image"]["tmp_name"];
                $destination = "resources/images/" . date("YmdHis") . $_FILES["image"]["name"];
                $addRecipe = $database->InsertRecipe($recipeData);
                move_uploaded_file($source, $destination);
                header('Location: index.php');
                die();
            } else {
                $view = file_get_contents('view/page/home/errors.php');
            }
        } else {
            $view = file_get_contents('view/page/recipe/noSubmit.php');
        }

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }

    /**
     * Rechercher les données et les passe à la vue pour la modification d'informations
     *
     * @return string
     */
    private function updateRecipeAction()
    {
        #Check si l'utilisateur est connecté
        if (!isset($_SESSION['useLogin'])) {
            $view = file_get_contents('view/page/user/notLogged.php');
        }

        #Check si l'utilisateur a les droits suffisants
        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] != 1) {
            $view = file_get_contents('view/page/user/noRights.php');
        }

        #Check si l'ID de la recette à modifier a été correctment entré
        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] == 1 && !isset($_GET['id'])) {
            $view = file_get_contents('view/page/recipe/badRecipe.php');
        }

        #Check si la recette qui a été trouvée existe bien
        if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] == 1 && isset($_GET['id'])) { {
                $database = new Database();
                $recipes = $database->getOneRecipe($_GET['id']);

                if (!isset($recipes[0]) || empty($recipes[0])) {
                    $view = file_get_contents('view/page/recipe/badRecipe.php');
                }
            }

            if (!isset($view)) {
                $dishTypes = $database->getAllTypedish();
                // Charge le fichier pour la vue
                $view = file_get_contents('view/page/recipe/updateRecipe.php');
            }
            // Pour que la vue puisse afficher les bonnes données, il est obligatoire que les variables de la vue puisse contenir les valeurs des données
            // ob_start est une méthode qui stoppe provisoirement le transfert des données (donc aucune donnée n'est envoyée).
            ob_start();
            // eval permet de prendre le fichier de vue et de le parcourir dans le but de remplacer les variables PHP par leur valeur (provenant du model)
            eval('?>' . $view);
            // ob_get_clean permet de reprendre la lecture qui avait été stoppée (dans le but d'afficher la vue)
            $content = ob_get_clean();

            return $content;
        }
    }
    /**
     * Check si la modifiation a bien était faite
     */
    private function checkUpdateRecipeAction()
    {
        if (isset($_POST['btnSubmit'])) {
            $errors = array();
            $recipeData = array();

            $database = new Database();
            $name = htmlspecialchars($_POST["name"]);
            $itemList = htmlspecialchars($_POST["itemList"]);
            $preparation = htmlspecialchars($_POST["preparation"]);
            $id = $_POST["id"];
            $imagePath = "resources/images/" . $_POST["imagePath"];
            $typedish = $_POST["typedish"];
            /**
             * Vérification que l'utilisateur ait bien entré le nom de la recette
             */
            if (!isset($name)  || empty($name)) {
                $errors[] = "Vous devez choisir le nom de votre recette";
            }

            /**
             * Vérification que l'utilisateur ait bien entré la list des ingrédients
             */
            if (!isset($itemList)  || empty($itemList)) {
                $errors[] = "Vous devez entrer une liste d'ingrédients";
            }

            /**
             * Vérification que l'utilisateur ait bien entré la préparation de la recette
             */
            if (!isset($preparation) || empty($preparation)) {
                $errors[] = "Vous devez entrer la préparation de la recette";
            }

            /**
             * Vérification de si l'utilisateur a mal rempli ses informations et écriture de la liste de ces dernières.
             * S'il a bien rempli les informations, ajout des informations dans la BDD et redirection à la page d'acceuil.
             * Si l'utilisateur n'as pas entré d'image alors l'image reste la même
             */


            /**
             * Vérification que l'utilisateur ait bien entré une image ainsi que le bon format et pas trop lourde
             */
            

            #Vérifie que les champs ont bien tous été fournis (sans l'image)
            if (empty($errors)) {
                $recipeData["name"] = $name;
                $recipeData["itemList"] = $itemList;
                $recipeData["preparation"] = $preparation;
                $recipeData["typedish"] = $typedish;
                $recipeData["id"] = $id;

                #Vérifications que l'image qui a (pas forcément) été ajoutée fasse bien en dessous de 2 MB et soit une image du bon format
                if (!empty($_FILES["image"]['name'])) {

                    #Check que l'image soit un PNG ou un JPG / JPEG
                    if (
                        $_FILES["image"]["type"] == "image/jpeg"
                        || $_FILES["image"]["type"] == "image/png"
                        || $_FILES["image"]["type"] == "image/jpg"
                    ) 
                    {  
                        #Check que l'image fasse moins de 2MO
                        if ($_FILES["image"]["error"] == 1) {
                            $errors[] = "La taille est trop élévée, taille max 2MO";
                        } else {
                            #Changement du nom de l'image avec la date et l'heure
                            $recipeData["image"] = date("YmdHis") . $_FILES["image"]["name"];

                            #Déplacement de l'image dans le dossier d'images
                            $source = $_FILES["image"]["tmp_name"];
                            $destination = "resources/images/" . date("YmdHis") . $_FILES["image"]["name"];
                            move_uploaded_file($source, $destination);

                            #Modification des informations de l'image
                            $addRecipe = $database->modifyRecipe($recipeData);

                            unlink($imagePath);
                        }
                    } else {
                        $errors[] = "Vous devez séléctionnez un fichier jpg ou png";
                    }
                    #Si pas d'image, modification sans image
                } else {
                    $addRecipe = $database->modifyRecipeNoImage($recipeData);
                }
            } 
            
            #S'il n'y a pas eu d'erreurs après l'ajout de l'image, refresh de la page de détail
            if (empty($errors)){
                header('Location: index.php?controller=recipe&action=updateRecipe&id=' . $id);
                die;
            } else {
                #Affichage de toutes les erreurs
                $view = file_get_contents('view/page/home/errors.php');
            }
        } else {
            $view = file_get_contents('view/page/recipe/noSubmit.php');
        }
        
        #Affichage de la bonne page
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }

    /**
     * Va gérer la recherche via les informations rentrées par l'utilisateur
     */
    private function searchAction()
    {
        #Check si l'utilisateur a recherché via la barre de recherche
        if (isset($_POST['searchSubmit'])) {
            $database = new Database();

            $recipes = $database->searchRecipe(htmlspecialchars($_POST['searchbar']));

            $dishTypes = $database->getAllTypedish();

            /**
             * Check si des recettes ont été enregistrées
             */
            for ($x = 0; $x < count($recipes); $x++) {

                $recipeNote = $database->getRecipeNoteAverage($recipes[$x]['idRecipe']);

                if (isset($recipeNote[0]['AVG(notStars)'])) {
                    $note = round($recipeNote[0]['AVG(notStars)']);
                    $recipes[$x]['note'] = $note;
                }
            }
            $view = file_get_contents('view/page/recipe/list.php');
        } else {
            $view = file_get_contents('view/page/recipe/noSubmitSearch.php');
        }
        // Charge le fichier pour la vue
        // Pour que la vue puisse afficher les bonnes données, il est obligatoire que les variables de la vue puisse contenir les valeurs des données
        // ob_start est une méthode qui stoppe provisoirement le transfert des données (donc aucune donnée n'est envoyée).
        ob_start();
        // eval permet de prendre le fichier de vue et de le parcourir dans le but de remplacer les variables PHP par leur valeur (provenant du model)
        eval('?>' . $view);
        // ob_get_clean permet de reprendre la lecture qui avait été stoppée (dans le but d'afficher la vue)
        $content = ob_get_clean();

        return $content;
    }
}
