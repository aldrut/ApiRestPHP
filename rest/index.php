<?php

include_once('Argon2.php');
include_once('DbManager.php');


$dbManager = new DbManager("account");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $_post = json_decode(file_get_contents('php://input'), true);
    //echo json_encode($_POST);

    $dbManager->validate($_post);


    $verifEmail = count($dbManager->getAll("email = '$_post[email]'"));

    if (!$verifEmail) {

        $_post['password'] = Argon2::hash($_post['password']);

        $validPost = $dbManager->insertOne($_post, true);

        $_post['token'] = Argon2::createToken(['email' => $validPost->email, 'token_date' => $validPost->updated_at]);

        //$validPost->token = $_post['token'];
        //TODO update insertedAccount with token
        // $validPost = $dbManager->getOne($validPost->id);
        //mail to $insertedAccount->email with the token
        // if($validPost != null)
        // {
        $validPost = $dbManager->updateOne(['id' => $validPost->id, 'token' => $_post['token']]);
        // }
        $response = ['token' => $_post['token']];
    } else {
        echo json_encode("email déjà existant");
    }

    if ($verifEmail || !$validPost) {
        $response = ['token' => false];
    }

    echo json_encode($response);
} else {
    echo json_encode("NO POST");
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
