<?php
/**
 * Fonctions liées aux contrôleurs
 */


/**
 * Détermine si le paramètre est un entier ou non
 * @param mixed $int
 * @return bool
 */
function estUnEntier($int)
{
    return is_numeric($int);
}

/**
 * Détermine si le paramètre est une string ou non
 * 
 * @param mixed $chaine
 * @return bool
 */
function estUneChaine($chaine)
{
    if (empty($chaine)) {
        return false;

    } else {
        return is_string($chaine);
    }
}

/**
 * Vérifie la longueur du mot de passe
 *
 * @param $chaine
 * @return bool
 */
function estUnMotDePasse($chaine)
{
    if (empty($chaine) || strlen($chaine) < 3) {
        return false;
    } else {
        return is_string($chaine);
    }
}


/**
 * Vérifie si un mot de pass a au moins :
 * - une lettre en minuscule
 * - une lettre en majuscule
 * - un nombre
 * - un caractère spécial
 *
 *
 * @param  mixed   $valeur
 * @return bool
 * @see http://stackoverflow.com/questions/8141125/regex-for-password-php
 * @see http://code.runnable.com/UmrnTejI6Q4_AAIM/how-to-validate-complex-passwords-using-regular-expressions-for-php-and-pcre
 */
function password($valeur) {
    return preg_match_all('$\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $valeur);
}

/**
 * vérifie si une adresse email est valide d
 *
 * @param  string  $email
 * @return bool
 */
function email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);

}
/**
 * Supprime les doublon d'une array
 * @param array $array
 * @return array
 */
function uniqueArray($array){
    foreach ($array as $key=>$value){
        foreach ($array as $key2=>$value2){
            if($key>$key2) {
                if ($value == $value2) {

                    unset($array[$key2]);

                }
            }
        }
    }
    return $array;
}

