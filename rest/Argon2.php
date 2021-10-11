<?php

class Argon2
{

    private static $prefix = '$argon2id$v=19$m=1024,t=2,p=2$';
    public static function hash($password)
    {
        $options = ['memory_cost' => 1024, 'time_cost' => 2, 'threads' => 2];
        $password = str_replace(self::$prefix, "", password_hash($password, PASSWORD_ARGON2ID, $options));
        return $password;
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, self::$prefix . $hash);
    }

    public static function createToken($entries)
    {
        $json = json_encode($entries);
        $payload = base64_encode($json);
        $signature = self::hash($payload);
        return $payload . '$' . $signature;
    }

    public static function verifyToken($token, $verifyExpired = true)
    {
        $tokenEntries = self::decodeToken($token);
        if ($tokenEntries) {
            $json = base64_decode($tokenEntries['payload']);
            $entries = json_decode($json);
            if ($verifyExpired) {
                date_default_timezone_set('Europe/Paris');
                $diff = time() - strtotime($entries->token_date);
                if ($diff < 60 * 60 * 24) { //24h
                    return $entries;
                }
            }
            return $entries;
        }
        return false;
    }

    public static function decodeToken($token)
    {
        $exploded = explode('$', $token);
        $payload = $exploded[0];
        $signature = str_replace($payload . '$', "", $token);
        $isValid = self::verify($payload, $signature);
        if ($isValid) {
            return ['payload' => $payload, 'signature' => $signature];
        }
        return false;
    }

    public static function generatePWD()
    {
        $tabChiffre = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $tabMinuscule = ['a', 'z', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'q', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'w', 'x', 'c', 'v', 'b', 'n'];
        $tabMajuscule = ['N', 'B', 'V', 'C', 'X', 'W', 'Q', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'P', 'O', 'I', 'U', 'Y', 'T', 'R', 'E', 'Z', 'A'];
        $tabSpeciaux = ['~', '{', '&', '(', '[', ')', ']', '^', '$', '£', 'µ', '%','?', '!', ':', ';', '=', '+', '-'];


        $pwd = [];

        for ($i = 0; $i < 3; $i++) {
            array_push($pwd, $tabChiffre[random_int(0, count($tabChiffre) - 1)]);
        }
        for ($j = 0; $j < 3 ; $j++) {
            array_push($pwd, $tabMinuscule[random_int(0, count($tabMinuscule) - 1)]);
        }
        for ($k = 0; $k < 3; $k++) {
            array_push($pwd, $tabMajuscule[random_int(0, count($tabMajuscule) - 1)]);
        }
        for ($l = 0; $l < 9; $l++) {
            array_push($pwd, $tabSpeciaux[random_int(0, count($tabSpeciaux) - 1)]);
        }

        shuffle($pwd);
        $newPWD = "";
        foreach ($pwd as $rowPwd) {
            $newPWD .= $rowPwd;
        }


        return $newPWD;
    }


    public static function generateDateHeure()
    {
        date_default_timezone_set('Europe/Paris');
        $date = new DateTime();
        $rstDate = (date_format($date,'y-m-d H:i:s'));

        return $rstDate;
    }




}
