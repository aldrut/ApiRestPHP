<?php

include_once 'DbManager.php';
include_once 'Argon2.php';

class BaseController
{
    function __construct($routeParts)
    {
        $this->method = $_SERVER["REQUEST_METHOD"];

        $firstParam = $routeParts[0] ?? null;
        $id = isset($firstParam) ? intval($firstParam) : 0;

        $this->body = $this->method == 'GET' ? $_GET : json_encode(file_get_contents('php://input'), true);



        $this->action = null;
        switch ($this->method) {
            case 'GET':
                $this->action = $id > 0 ? "getOne" : ($firstParam == "all" ? "getAll" : $firstParam);
                break;

            case 'POST':
                $this->action = $firstParam != null ? $firstParam : "create";
                break;

            case 'PUT':
                break;

            case 'DELETE':
                break;
        
        }

        if(!isset($this->action) || !method_exists(get_called_class(),$this->action))
        die(json_encode(false));

        $this->table = $this->table ?? str_replace("Controller","",lcfirst(get_called_class()));

        $this->connectBDD = new DbManager($this->table);
        $this->jsonResponse = json_encode($this->{$this->action}($routeParts));


    }

    public function sendResponse()
    {
        echo $this->jsonResponse;
    }

    protected function getAll($params)
    {
        array_shift($params);
        $where ="";
        foreach($params as $param)
        {
            $param = urlencode($param);
            $where .= " $param AND";
        }
        $where = substr($where,0,-3);
        if(!$where) $where =1;
        return $this->connectBDD->getAll($where);
    }
    protected function getOne($params){
        $id = array_shift($params);
        $where = "";
        foreach($params as $param){
            $param = urldecode($param);
            $where .= " $param AND";
        }
        $where = substr($where, 0, -3);
        if(!$where) $where = "1";

        return $this->db->getOne($id, $where);
    }

    protected function create(){
        return "create an account $this->table";
    }

    protected function update(){
        return "update an account $this->table";
    }

    protected function delete(){
        return "delete an account $this->table";
    }
}
