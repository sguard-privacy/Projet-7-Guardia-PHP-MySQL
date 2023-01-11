<?php

// Clé ReCAPTCHA V2
define('reCAPTCHAfront', '6LdLUO0jAAAAAJHpDx_LS5KpmUIrZPkc2FQ0R5Hq');
define('reCAPTCHAback', '6LdLUO0jAAAAAMuRUfp1gq_lEPx_lIBiHss9h9EQ');

function check_token($token,$secret_key) {
    $url_verif = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$token";
    $curl = curl_init($url_verif);
    
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $verif_response = curl_exec($curl);

    if ( empty($verif_response) ) return false;
    else {
        $json = json_decode($verif_response);
        return $json->success;
    }
}
?>