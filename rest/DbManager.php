<?php

class DbManager
{
    public function __construct($table)
    {
        $this->table = $table;
        $this->bdd = null;
    }

    private function connect()
    {
        if($this->bdd === null)
        {

            $dsn = 'mysql:dbname=db_js;host=localhost;port=3307';
            $username = 'root';
            $password = '';
            //On établit la connexion à la base
            try 
            {
                $bdd = new PDO($dsn,$username,$password,array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ));
                // echo 'ok';
            }
            catch (PDOException $e) 
            {
                die('error'.$e->getMessage());
            }
            $this->bdd = $bdd;
        }
        return $this->bdd;
    }

    public function getAll($where = "1")
    {
        $sql = "SELECT * FROM $this->table WHERE $where";

        $response = $this->connect()->query($sql);
        $rows = $response->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE);
        if (count($rows) == 0) {
            return $rows;
        }
        return $rows;
    }

    public function getOne($id)
    {
        if($id == null){
            return null;
        }
        $sql = "SELECT * FROM $this->table WHERE id=$id";

        $response = $this->connect()->query($sql);

        $rows = $response->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE);

        $row = count($rows) == 1 ? $rows[0] : null;

        return $row;
    }

    public function getByEmail($email)
    {
        if($email == null){
            return null;
        }
        $sql = "SELECT * FROM $this->table WHERE email='$email'";

        $response = $this->connect()->query($sql);

        $rows = $response->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE);

        $row = count($rows) >= 1 ? $rows[0] : null;

        return $row;
    }

    public function insertOne($fields = [], $getInsertedRow = false)
    {
        $this->validate($fields);

        $columns = "";
        $values = "";
        if(isset($fields['id'])) 
        {
            unset($fields['id']);
        }
        $valuesToBind = array();
        foreach($fields as $k => $v)
        {
            //idenifier les colonnes
            $columns .= $k . ",";
            
            //reprend les valeurs à saisir
            $values .= "?,";
            array_push($valuesToBind,$v);
        }
        $columns = trim($columns,',');
        $values = trim($values,',');

        $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $statement = $this-> connect()->prepare($sql);
        $result = $statement->execute($valuesToBind);
        $test = $statement->rowCount() == 1;
        if($result && $test)
        {
            $insertedId = $this->bdd->lastInsertId();
            $fields['id'] = $insertedId;
            return $getInsertedRow ? $this->getOne($insertedId) : $insertedId;
            // $entityClass = $this->entity;
            // $entity = new $entityClass($fields);
            // return $entity;
        }

        return false;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    
    
    
     private function describe()
    {
        $sql = "DESCRIBE $this->table";
        $resp = $this->connect()->query($sql);
        $results = $resp->fetchAll(PDO::FETCH_ASSOC);
        $columns = [];
        foreach ($results as $result) {
            $columns[$result['Field']] = $result;
        }
        return $columns;
    }
        
    
    function validate(&$inputs)
    {
        //$errors = [];
        // On récupère les infos de la table pour vérifier que l'on est raccord
        $columns = $this->describe();

        foreach ($inputs as $k => $v) {
            $value = filter_var($v, FILTER_SANITIZE_STRING);
            $column = $columns[$k] ?? null;
            if (!isset($column) || $value == 'null') {
                //nettoyage des inputs contre les injections SQL et XSS
                unset($inputs[$k]);
                continue;
            }
            // //ON RECUPERE LE TYPE DE LA COLONNE EN BDD
            // $type = $column['Type'];
            // $type = explode('(', $type)[0];
            // // in_array verifie si une valeur existe dans le tableau
            // if (in_array($type, ["float"])) {
            //     $filtered = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            //     if ($filtered != $value || empty($filtered)) {
            //         $errors[$k] = true;
            //     }
            // }
            // if (in_array($type, ["int"])) {
            //     $filtered = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            //     if ($filtered != $value || empty($filtered)) {
            //         $errors[$k] = true;
            //     }
            // }
        }
        //return $errors;
    }
    function updateOne($fields)
    {
        $set = "";
        $valuesToBind = array();
        $id = $fields['id'];
        unset($fields['id']);

        foreach($fields as $k => $v)
        {
            $set .= $k."=?,";
            array_push($valuesToBind,$v);
        }
        $set = trim($set,",");
        $where = "id = ?";
        array_push($valuesToBind,$id);
        $sql = "UPDATE $this->table SET $set WHERE $where";
        $statment = $this->connect()->prepare($sql);
        $result = $statment->execute($valuesToBind);
        $test = $statment->rowCount()==1;
        if($result && $test)
        {
            //$entityClass = $this->entity;
            //$fields['id'] = $id;
            //$entity = new $entityClass($fields);
            //return $entity;

            return $test;
        }
        return false;
    }
}