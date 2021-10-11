<?php

include_once('Argon2.php');
include_once('DbManager.php');






$dbManager = new DbManager("account");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $_post = json_decode(file_get_contents('php://input'), true);

    $rstUser = $dbManager->getAll("email = '$_post[email]'");

    if($rstUser != null )
    {
        $rstUser = $rstUser[0];
        
        $verifPwd = Argon2::verify($_post['password'],$rstUser->password);

        if($verifPwd != false && $rstUser->active == true)
        {
            $u = ['id'=> $rstUser->id, 'email'=> $rstUser->email];
            // $response = ['auth' => "Authentification ok" ]; 
            $response = $u; 
        }
        else
        {
            $response = ['auth' => "Authentification Ko" ];
        }
    }
    else
    {
        $response = ['auth' => "Authentification Ko" ];

    }
    echo json_encode($response);

}