<?php

include_once('Argon2.php');
include_once('DbManager.php');


$dbManager = new DbManager("account");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $_post = json_decode(file_get_contents('php://input'), true);
    //echo json_encode($_POST);

    $dbManager->validate($_post);


    $verifEmail = $dbManager->getAll("email = '$_post[email]'");

    if ($verifEmail != null) {
        
        $rstUser = $verifEmail[0];
        $generatePassword = Argon2::generatePWD();
        $newPassword = Argon2::hash($generatePassword);
        $newDateUpdate = Argon2::generateDateHeure();
        $newToken = Argon2::createToken(['email'=> $rstUser->email, 'updated_at'=> $newDateUpdate]);
       

        $rstUser->passwordClear = $generatePassword; 
        $rstUser->password = ""; 
        $rstUser->password= $newPassword; 
        $rstUser->token = $newToken;
        $rstUser->updated_at = $newDateUpdate;


       
        $rstUpdateUser = $dbManager->updateOne([
            'id' => $rstUser->id, 
            'password' => $rstUser->password, 
            'active' => 0, 
            'token'=> $rstUser->token,
            'updated_at' => $rstUser->updated_at
        ]);

       if($rstUpdateUser)
       {
         
           $response = ['id'=> $rstUser->id, 'email'=>$rstUser->email, 'token'=>$rstUser->token, 'passwordClear'=>$rstUser->passwordClear];

       }
       else
       {
           $response = ['token'=> false];
       }
    }
    else
    {
        $response = ['NO POST'];

    }

    echo json_encode($response);
}
if ($_SERVER["REQUEST_METHOD"] === 'GET') { //Validate and active account
    $_get = $_GET;
    if (isset($_get['t'])) {
        $entries = Argon2::verifyToken($_get['t']);
        if ($entries) {
            $email = $entries->email;
            $accounts = $dbManager->getAll("email = '$email'");
            $existingAccount = count($accounts) > 0;
            if ($existingAccount) {
                $account = $accounts[0];
                //TODO verify token is the same in $account
                //TODO update active and remove token from account
                if ($account->token == isset($_get['t'])) {

                    $v = $dbManager->updateOne(['id' => $account->id, 'token' => null, 'active' => true ]);
                }
                //echo json_encode(true);
                header('Location: ../login.html');
                die;
            }
        }
    }
    echo json_encode(false);
}
?>