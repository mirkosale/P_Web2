<!--
ETML 
Author : Kandasamy Pruthvin
Date   : 28.02.2022
Description: les données sont traitées et affichées directement dans la page d’accueil.
 Mais, nous allons créer plusieurs pages avec des liaisons à la BD. A terme, nous ne voulons pas recopier toujours les mêmes instructions.
 De ce fait, nous allons créer une classe afin de regrouper les méthodes nécessaires à nos requêtes.
-->
<?php

class Database {
    // Variable de classe
    private $connector;
   
    /**
     *  methode permettant de se connecter a la base de donnée avec PDO
     */
    public function __construct(){
        require('config.php');
        
        try
        {
        $this->connector = new PDO("mysql:host=$DB_SERVER;dbname=$DB_NAME;charset=utf8" , $DB_USER, $DB_PASSWORD);
        }
        catch (PDOException $e)
        {
        die('Erreur : ' . $e->getMessage());
        }
        // Se connecter via PDO et utilise la variable de classe $connector
    }

    /**
     * permet de préparer et d’exécuter une requête de type simple (sans where)
     */
    private function querySimpleExecute($query){
        $req = $this -> connector->query($query);
        return $req;
    }

        /**
     * permet de préparer, de binder et d’exécuter une requête (select avec where ou insert, update et delete)
     */
    private function queryPrepareExecute($query, $binds){
        $req =  $this->connector->prepare($query);
        foreach($binds as $key => $value){
            $req->bindValue($value['name'], $value["value"], $value["type"]);
        }
        $req->execute();

        return $req;
    }

    /**
     * traiter les données pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
     */
    private function formatData($req){
        $result = $req->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * vider le jeu d’enregistrement
     */
    private function unsetData($req){
        $req->closeCursor();
    }

    /**
     * methode permettant de récupèrer tout les recettes
     */
    public function getAllRecipe(){
        //récupère la liste de tous les recettes de la BD
        //avoir la requête sql
        //appeler la méthode pour executer la requête
        //appeler la méthode pour avoir le résultat sous forme de tableau
        //retour tous les recettes
        $queryRecipe = "SELECT *  FROM t_recipe";
        $reqRecipe = $this->querySimpleExecute($queryRecipe);
         
        $returnRecipe=$this->formatData($reqRecipe);
        $this -> unsetData($reqRecipe);
        return $returnRecipe;
    }

    public function getAllRecipeSort($id){
        //récupère la liste de tous les recettes de la BD où le type de plat correspond à celui demandé
        //avoir la requête sql
        //appeler la méthode pour executer la requête
        //appeler la méthode pour avoir le résultat sous forme de tableau
        //retour tous les recettes
        $queryOneRecipe
         = "SELECT * FROM t_recipe WHERE fkTypeDish = :varId";
        $bindReceipe = array(
            array("name" => "varId" , "value" => $id, "type"=> PDO::PARAM_INT)
        );
        $reqRecipe = $this->queryPrepareExecute($queryOneRecipe ,$bindReceipe);
        $returnRecipe=$this->formatData($reqRecipe);
        $this -> unsetData($reqRecipe);
        return $returnRecipe;
    }
    
    public function getLatestRecipe(){
        //récupère la liste de tous les recettes de la BD
        //avoir la requête sql
        //appeler la méthode pour executer la requête
        //appeler la méthode pour avoir le résultat sous forme de tableau
        //retour tous les recettes
        $queryRecipe = "SELECT idRecipe, recName,recListOfItems,recPreparation,recImage  FROM t_recipe ORDER BY idRecipe desc limit 1";
        $reqRecipe = $this->querySimpleExecute($queryRecipe);
         
        $returnRecipe=$this->formatData($reqRecipe);
        $this -> unsetData($reqRecipe);
        return $returnRecipe;
    }
    /**
     * methode permettant de récupèrer un recette
     */
    public function getOneRecipe($id){
        // récupère la liste des informations pour 1 recette b 
        // avoir la requête sql pour 1 recette (utilisation de l'id)
        // appeler la méthode pour executer la requête
        // appeler la méthode pour avoir le résultat sous forme de tableau
        // retour l'recette
        $queryOneRecipe
         = "SELECT recName,recListOfItems,recPreparation,recImage,typName FROM t_recipe INNER JOIN t_typedish ON t_recipe.fkTypeDish = t_typedish.idTypeDish WHERE idRecipe=:varId";
        $bindReceipe = array(
            array("name" => "varId" , "value" => $id, "type"=> PDO::PARAM_INT)
        );
        $reqRecipe = $this->queryPrepareExecute($queryOneRecipe ,$bindReceipe);
        $returnRecipe=$this->formatData($reqRecipe);
        $this -> unsetData($reqRecipe);
        return $returnRecipe;
    }

    /**
     * methode permettant d'ajouter un recette
     */
    public function InsertRecipe($recipeData)
    {
        // insert les informations
        // avoir la requête sql
        // appeler la méthode pour executer la requête
        $query = "INSERT INTO t_recipe (recName, fkTypeDish, recListOfItems, recPreparation, recImage) 
                  VALUES (:name, :typedish, :itemList, :preparation, :image)";

        $binds = [
            ["name" => 'name', 'value' => $recipeData['name'], 'type' => PDO::PARAM_STR],
            ["name" => 'itemList', 'value' => $recipeData['itemList'], 'type' => PDO::PARAM_STR],
            ["name" => 'preparation', 'value' => $recipeData['preparation'], 'type' => PDO::PARAM_STR],
            ["name" => 'image', 'value' => $recipeData['image'], 'type' => PDO::PARAM_LOB],
            ["name" => 'typedish', 'value' => $recipeData['typedish'], 'type' => PDO::PARAM_INT]
        ];

        $this->queryPrepareExecute($query, $binds);
    }

     /**
     * methode permettant de modifier un recette
     */
    public function modifyRecipe($recipeData)
    {
        //modifie les informations du teacher
        //avoir la requête sql
        // appeler la méthode pour executer la requête.
        $query = "UPDATE t_recipe SET recName =  :name, recListOfItem = :itemList, recPreparation = :preparation,
                     recImage = :image, fkTypeDish = :typedish WHERE t_recipe.idRecipe = :id";

        $binds = [
            ["name" => 'name', 'value' => $recipeData['name'], 'type' => PDO::PARAM_STR],
            ["name" => 'itemList', 'value' => $recipeData['itemList'], 'type' => PDO::PARAM_STR],
            ["name" => 'preparation', 'value' => $recipeData['preparation'], 'type' => PDO::PARAM_STR],
            ["name" => 'image', 'value' => $recipeData['image'], 'type' => PDO::PARAM_LOB],
            ["name" => 'typedish', 'value' => $recipeData['typedish'], 'type' => PDO::PARAM_INT],
            ["name" => 'id', 'value' => $recipeData['id'], 'type' => PDO::PARAM_INT]
        ];

        $this->queryPrepareExecute($query, $binds);
    }

    /**
     * methode permettant de delete un recette
     */
    public function deleteRecipe($idRecipe)
    {
        //supprime l'recette
        //avoir la requête sql 
        //appeler la méthode pour executer la requête
        //appeler la méthode pour avoir le résultat sous forme de tableau.
        $query = 'DELETE FROM t_recipe WHERE idRecipe = :idRecipe';

        //avoir la requête sql pour le delete.
        $binds = [
            ["name" => "idRecipe", "value" => $idRecipe, "type" => PDO::PARAM_INT]
        ];
        $req = $this->queryPrepareExecute($query, $binds);

        return $this->formatData($req);
    }

    /**
     * methode permettant de récupérer les sections
     */
    public function getTypes()
    {
        //récupère la liste de toutes les section de la BD
        //appeler la méthode pour executer la requête 
        $query = 'SELECT * FROM t_typedish';
        $req = $this->querySimpleExecute($query);

        // Retour les sections sous forme de tableau associatif
        return $this->formatData($req);
    }

    public function getAllUsers()
    {
        //récupère un utilisateur de la BD
        //avoir la requête sql
        //appeler la méthode pour executer la requête
        $query = 'SELECT * FROM t_user';

        $req = $this->querySimpleExecute($query);

        $result = $this->formatData($req);

        return $result;   
    }

    /**
     * methode permettant de récupérer un utilisateur selon son ID
     */
    public function getUser($idUser){
        //récupère la liste de tous les utilisateur de la BD
        //avoir la requête sql
        //appeler la méthode pour executer la requête
        $query = 'SELECT * FROM t_user WHERE idUser = :idUser';
        $binds = [
            ["name" => "idUser","value" => $idUser, "type" => PDO::PARAM_INT]
        ];
        $req = $this->queryPrepareExecute($query, $binds);

        // Retour les sections sous forme de tableau associatif
        return $this->formatData($req);
    }

    /*
     * methode permettant de r
     * cupèrer l'ID d'une session en fonction d'un idUser ; Retourne null si pas de résultats ; sinon retourne l'idSession
     */
    private function getIdSessionByUserId($idUser)
    {
        $query = "SELECT idSession FROM t_session WHERE fkUser = :idUser";
        $binds = [
            ["name" => 'idUser', 'value' => $idUser, 'type' => PDO::PARAM_STR]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $result = $this->formatData($req);

        return $result ? $result[0]['idSession'] : null;
    }

    /**
     * methode permettant de Récupèrer une session avec l'id donné et si elle existe retoune la session sinon null
     */
    public function getOneSession($idSession)
    {
        $query = "SELECT * FROM t_session WHERE idSession = :idSession";
        $binds = [
            ["name" => 'idSession','value' => $idSession, 'type' => PDO::PARAM_INT]
        ];

        $req = $this->queryPrepareExecute($query, $binds);
        $session = $this->formatData($req);

        return !$session ? null : $session[0];
    }

    /**
     * Méthode permettant d'avoir tous les types de plats
     */
    public function getAllTypedish()
    {
        $query = "SELECT * FROM t_typedish";

        $req = $this->querySimpleExecute($query);
        $session = $this->formatData($req);

        $this->unsetData($req);

        return $session;
    }

    public function SearchRecipe()
    {
        $query="SELECT * FROM `t_recette` WHERE recName LIKE "%"";
    }
 }

?>