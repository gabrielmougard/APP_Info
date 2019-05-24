<?php

// on récupère les requêtes génériques
include('modeles/requetes.generiques.php');

/**
 * Inscription de l'utilisateur
 * @param PDO $bdd
 * @param string $nom
 * @param string $prenom
 * @param string $email
 * @param string $password
 * @param string $confirmPassword
 * @param Captcha $captcha
 * @return boolean
 */
function inscription($bdd,$nom,$prenom,$email,$password,$CGU) {


/*
    $isOK = true;
    //captcha
    if(empty($captcha['utilisateur']) || strtolower($captcha['utilisateur']) !== strtolower($captcha['session'])){

        $isOK = false;
    }
*/
    if(!$CGU) {
        return false;
    }


    $token = sha1(uniqid(mt_rand(), true));

    require('PHPMailer/src/PHPMailer.php');
    require('PHPMailer/src/SMTP.php');
    require('PHPMailer/src/Exception.php');
    require('PHPMailer/src/OAuth.php');
    require('PHPMailer/src/POP3.php');
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 4;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'quiescisteam@gmail.com';
    $mail->Password = 'G7Ddevteam';
    $mail->SMTPSecure = 'tls';
    $mail->port = 587;
    $mail->setFrom('quiescisteam@gmail.com');
    $mail->addAddress($email);
    $mail->WordWrap = 50;

    $mail->isHTML(true);

    $mail->Subject = "[Quiescis] Verification d'email";
    $confirmLink = "http://localhost/APP_Info-master/index.php?cible=authentification&fonction=confirmInscription&code=" . $token . "&email=" . $email;

    
    $body = <<<EX

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Email Confirmation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  
  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
 
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style="background-color: #e9ecef;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;width: 100% !important;height: 100% !important;padding: 0 !important;margin: 0 !important;">

 

  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">

    <!-- start logo -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
          <tr>
            <td align="center" valign="top" style="padding: 36px 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">

                
              
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;border-top: 3px solid #d4dadf;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Confirmez votre inscription</h1>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;line-height: 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Cliquez sur le bouton de confirmation pour finaliser votre inscription.</p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
                <tr>
                  <td align="center" bgcolor="#ffffff" style="padding: 12px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
                    <table border="0" cellpadding="0" cellspacing="0" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
                      <tr>
                        <td align="center" bgcolor="#34c13b" style="border-radius: 6px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
                          <a href="{$confirmLink}" target="_blank" style="display: inline-block;padding: 16px 36px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;color: #ffffff;text-decoration: none;border-radius: 6px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Je confirme !</a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;line-height: 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Si le bouton ne marche pas, veuillez copier/coller le lien suivant dans votre navigateur :</p>
              <p style="margin: 0;"><a href="{$confirmLink}" target="_blank" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #1a82e2;">{$confirmLink}</a></p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;line-height: 24px;border-bottom: 3px solid #d4dadf;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Cordialement,<br> Mila de la devteam Quiescis</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="padding: 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">

          <!-- start unsubscribe -->
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 14px;line-height: 20px;color: #666;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Fait par Quiescis Ltd 🙌</p>
            </td>
          </tr>
          <!-- end unsubscribe -->

        </table>
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>

EX;

    $mail->Body = $body;
    

    if(!$mail->send())
    {
        
        return false;
    }
    else
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $bdd->beginTransaction();
        $query = "INSERT INTO utilisateurs (nom, prenom, email, role, passwordHash, derniereVerificationEmail) ".
            "VALUES (:nom, :prenom, :email, :role,:passwordHash, :derniereVerificationEmail)";

        $sth=$bdd->prepare($query);
        $sth->bindValue(':nom', $nom, PDO::PARAM_STR);
        $sth->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $sth->bindValue(':email', $email,PDO::PARAM_STR);
        $sth->bindValue(':role', "user",PDO::PARAM_STR);
        $sth->bindValue(':passwordHash', $passwordHash,PDO::PARAM_STR);


        $sth->bindValue(':derniereVerificationEmail', time(),PDO::PARAM_INT);
        $sth->execute();
        $bdd->commit();
        
        //sauvegarde du token

        $bdd->beginTransaction();
        $query = "UPDATE utilisateurs SET emailToken = :emailToken";

        $sth=$bdd->prepare($query);
        $sth->bindValue(':emailToken', $token, PDO::PARAM_STR);
        $sth->execute();
        $bdd->commit();



        return true;
    }

}

/**
 * login
 *
 * @param string $email
 * @param string $password
 * @param bool   $rememberMe
 * @param string $ipUtilisateur
 * @param string $userAgent
 * @return array ==> array[0] boolean : array[1] int => userId which will be stored in the $_SESSION
 */

function connexion($bdd,$email,$password,$rememberMe){
    

    $etat=true;
    // on cherche dans la bdd

    $sth=$bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email AND emailActive = 1 LIMIT 1");
    $sth->bindValue(':email', $email);
    $sth->execute();
    $utilisateur = $sth->fetchAll();
    $idUtilisateur = isset($utilisateur[0]["idUtilisateur"]) ? $utilisateur[0]["idUtilisateur"] : null;
    $passwordHash = isset($utilisateur[0]["passwordHash"]) ? $utilisateur[0]["passwordHash"] : null;

    if (!password_verify($password,$passwordHash)){
        $etat=false;
    }
    if ($email != $utilisateur[0]['email']){
        $etat=false;
    }


    // Si remember me est cliqué, alors on modifie les cookies
    // Todo : Cookie avec remember me


    if($rememberMe && $etat){

        //sauvegarde des hash dans les cookies
        $cookie_expiration_time = 60*60*24;
        setcookie("email",$email,$cookie_expiration_time);
        setcookie("password",password_hash($password, PASSWORD_DEFAULT), $cookie_expiration_time);

    }

    $res = array();
    $res["connected"] = $etat;
    $res["id"] = $idUtilisateur;
    return $res;
    
}

function resetPasswordToken($bdd,$IdUtilisateur) {
    $query = "UPDATE utilisateurs SET passwordHash = NULL WHERE idUtilisateur = :idUtilisateur LIMIT 1";
    $sth=$bdd->prepare($query);
    $sth->bindValue(':id',$IdUtilisateur);
    $resultat = $sth->execute();
    if(!$resultat) {
        throw new Exception("Le token du mot de passe ne peut pas être réinitialisé");
    }
}

/**
 * Procédure d'oublie de mot de passe
 *
 * @param  string  $email
 * @param PDO $bdd
 * @return bool
 */
function passwordOublie($bdd,$email){
    

    //on génère une string unique
    $uniqidStr = bin2hex(random_bytes(4));
    $passwordHash = password_hash($uniqidStr, PASSWORD_DEFAULT);
    $connexion = "https://localhost/APP_Info-master/index.php?cible=authentification&fonction=connexion";

    require('PHPMailer/src/PHPMailer.php');
    require('PHPMailer/src/SMTP.php');
    require('PHPMailer/src/Exception.php');
    require('PHPMailer/src/OAuth.php');
    require('PHPMailer/src/POP3.php');
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPAuth = true;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'quiescisteam@gmail.com';
    $mail->Password = 'G7Ddevteam';
    $mail->SMTPSecure = 'tls';
    $mail->port = 587;
    $mail->setFrom('quiescisteam@gmail.com');
    $mail->addAddress($email);
    $mail->WordWrap = 50;

    $mail->isHTML(true);

    $mail->Subject = "[Quiescis] Nouveau mot de passe";


    $body = <<<EX
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Nouveau mot de passe</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  
  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
 
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style="background-color: #e9ecef;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;width: 100% !important;height: 100% !important;padding: 0 !important;margin: 0 !important;">

 

  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">

    <!-- start logo -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
          <tr>
            <td align="center" valign="top" style="padding: 36px 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">

                
              
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;border-top: 3px solid #d4dadf;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Voici votre nouveau Mot de passe</h1>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;line-height: 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Votre mot de passe "$uniqidStr"</p><br>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
                <tr>
                  <td align="center" bgcolor="#ffffff" style="padding: 12px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
                    <table border="0" cellpadding="0" cellspacing="0" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">
                      <tr>
                        <td align="center" bgcolor="#34c13b" style="border-radius: 6px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
                          <a href="{$connexion}" target="_blank" style="display: inline-block;padding: 16px 36px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;color: #ffffff;text-decoration: none;border-radius: 6px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Connectez Vous!</a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;line-height: 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Si le bouton ne marche pas, veuillez copier/coller le lien suivant dans votre navigateur :</p>
              <p style="margin: 0;"><a href="{$connexion}" target="_blank" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #1a82e2;">{$connexion}</a></p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;line-height: 24px;border-bottom: 3px solid #d4dadf;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Cordialement,<br> Mila de la devteam Quiescis</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="padding: 24px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;border-collapse: collapse !important;">

          <!-- start unsubscribe -->
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 14px;line-height: 20px;color: #666;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-rspace: 0pt;mso-table-lspace: 0pt;">
              <p style="margin: 0;">Fait par Quiescis Ltd 🙌</p>
            </td>
          </tr>
          <!-- end unsubscribe -->

        </table>
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>

EX;
        $mail->Body = $body;


        if(!$mail->send())
        {
            
            return false;
        }
        else
        {
           

            //sauvegarde du mdp

            $sth=$bdd->prepare("UPDATE utilisateurs SET passwordHash = :passwordHash WHERE email = :email");
            $sth->bindValue(':passwordHash',$passwordHash);
            $sth->bindValue(':email',$email);
            $sth->execute();

            return true;
        }

        

}



/**
 * Vérifie si l'email existe dans la base de données d
 *
 * @param  string  $email
 * @param PDO $bdd
 * @return boolean
 *
 */
function existeEmail($bdd,$email){

// AND emailActive = 1 LIMIT 1 Rejouter ca après   email = :email
    $sth=$bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email ");
    $sth->bindValue(':email', $email);
    $sth->execute();
    $result=$sth->fetch(PDO::FETCH_ASSOC);
    //var_dump($result);
    return !$result;
}

/**
 * Vérifie si le token de vérification de l'email est valide ou pas.
 *
 * @param PDO $bdd
 * @param  integer $IdUtilisateur
 * @param  string  $emailToken
 * @return boolean
 *
 */
function tokenEmailVerificationOK($bdd,$email, $emailToken){
    if (empty($email) || empty($emailToken)) {
        return false;
    }
    $sth=$bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email LIMIT 1");
    $sth->bindValue(':email', $email);
    $sth->execute();
    $utilisateur = $sth->fetchAll();
    //var_dump($utilisateur[0]["emailToken"]);
    $isTokenValid = ($utilisateur[0]["emailToken"] == $emailToken)? true: false;


    //remplir table 'appartement'
    $sth=$bdd->prepare("INSERT INTO appartement (adresse,superficie) VALUES (:adresse, :superficie)"); //0 because it's his first appartement and idAppart auto-increment
    $adresse = "adresse ".$utilisateur[0]["idUtilisateur"];
    $sup = rand(30,200);
    $sth->bindValue(":adresse", $adresse);
    $sth->bindValue(":superficie", $sup);
    $sth->execute();

    //get the id of the appartment
    $sth=$bdd->prepare("SELECT max(idAppartement) FROM appartement"); //select the last one
    $sth->execute();
    $idAppart = $sth->fetchAll()[0]["max(idAppartement)"];
   

    //modifier le role de l'utilisateur créé ( 'p' par défaut => pour principal) dans les autres cas c'est 's' pour 'secondaire'

    $sth = $bdd->prepare("INSERT INTO role (principal,secondaire,idAppart,idUser) VALUES (1,0,:idAppart,:idUser)");
    $sth->bindValue(":idUser",$utilisateur[0]["idUtilisateur"]);
    $sth->bindValue(":idAppart",$idAppart);
    $sth->execute();

    if(!empty($utilisateur[0]["emailActive"])){
        resetEmailVerificationToken($bdd,$email, true);
        return true;
    }

    $expiration = (60 * 60); //une heure
    $tempsEcoule = time() - $utilisateur[0]['derniereVerificationEmail'];

    if( $isTokenValid && $tempsEcoule < $expiration) {
        resetEmailVerificationToken($bdd,$email, true);
        return true;
    }else if($isTokenValid && $tempsEcoule > $expiration) {
        resetEmailVerificationToken($bdd,$email, false);
        return false;
    }else{

        resetEmailVerificationToken($bdd,$email, false);

        return false;
    }
}

/**
 * réinitialise le token de vérification de l'email

 *
 * @param PDO $bdd
 * @param  integer $IdUtilisateur
 * @param boolean $isValid
 * @throws Exception si la réinitialisation a échoué
 */
function resetEmailVerificationToken($bdd,$email, $isValid){

    if($isValid){
        $query = "UPDATE utilisateurs SET emailToken = NULL, " .
            "derniereVerificationEmail = NULL, emailActive = 1 ".
            "WHERE email = :email LIMIT 1";
    }else{
        $query = "DELETE FROM utilisateurs WHERE email = :email";
    }
    $sth=$bdd->prepare($query);
    $sth->bindValue(':email', $email);
    $resultat = $sth->execute();
    if(!$resultat){
        throw new Exception("Impossible de réinitialiser le token de vérification email");
    }
}

/**
 * déconnexion en supprimant session et cookies
 *
 * @param  integer $IdUtilisateur
 *
 */
function logOut($emailUser){
    setcookie("email", $emailUser, time()-3600);
    header("Location: http://localhost/APP_Info-master/index.php?cible=authentification&fonction=accueil");
}

/**
 * Récupère tous les enregistrements de la table users
 * @param PDO $bdd
 * @return array
 */
function recupereTousUtilisateurs($bdd)
{
    $query = 'SELECT * FROM utilisateurs';
    return $bdd->query($query)->fetchAll();
}

/**
 * Ajoute un nouvel utilisateur dans la base de données
 * @param array $utilisateur
 * @param PDO $bdd
 */
function ajouteUtilisateur($bdd,$utilisateur) {
    
    $query = ' INSERT INTO utilisateurs (nom, password) VALUES (:nom, :password)';
    $donnees = $bdd->prepare($query);
    $donnees->bindValue(":username", $utilisateur['nom'], PDO::PARAM_STR);
    $donnees->bindValue(":password", $utilisateur['password']);
    return $donnees->execute();
    
}

/**
 * Recupère l'IP de l'utilisateur
 *
 * @return string
 */
function recupIP()
{
    if ( isset ( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif ( isset ( $_SERVER['HTTP_CLIENT_IP'] ) )
    {
        $ip  = $_SERVER['HTTP_CLIENT_IP'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getEmailByEmailUser($emailUser, $bdd){
    $query = "Select * from utilisateur where utilisateur_email = ?";
    return $bdd->query($query,'s', array($emailUser));
}

function getTokenByEmailUser($bdd,$emailUser, $expired) {
    $query = "Select * from tbl_token_auth WHERE  emailUser = ? and is_expired = ?";
    return $bdd->query($query, 'si', array($emailUser, $expired));
}

function markAsExpired($tokenId, $bdd){
    $query = "UPDATE tbl_token_auth SET is_expired = ? Where id = ?";
    $expired = 1;
    return $bdd->update($query, 'ii', array($expired, $tokenId));
}

function insertToken($emailUser, $random_password_hash, $random_selector_hash, $expiry_date, $bdd){
    $query = "INSERT INTO tbl_token_auth (emailUser, password_hash, selector_hash, expiry_date) values (?, ?, ?, ?)";
    return $bdd->insert($query, 'ssss', array($emailUser, $random_password_hash, $random_selector_hash, $expiry_date));
}

function connexionWithoutHash($bdd,$email,$passwordWithHash,$rememberMe){


    $etat=true;
    // on cherche dans la bdd

    $sth=$bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email AND emailActive = 1 LIMIT 1");
    $sth->bindValue(':email', $email);
    $sth->execute();
    $utilisateur = $sth->fetchAll();

    $idUtilisateur = isset($utilisateur[0]["idUtilisateur"]) ? $utilisateur[0]["idUtilisateur"] : null;
    $passwordHash = isset($utilisateur[0]["passwordHash"]) ? $utilisateur[0]["passwordHash"] : null;

    if ($passwordHash != $passwordWithHash){
        $etat=false;
    }
    if ($email != $utilisateur[0]['email']){
        $etat=false;
    }


    $res = array();
    $res["connected"] = $etat;
    $res["id"] = $idUtilisateur;
    return $res;

}

function recupNom($idUser, $bdd){
    $statement = $bdd->prepare('SELECT nom FROM utilisateurs
    WHERE idUtilisateur=' . $idUser);
    $statement->execute();
    return $statement->fetchAll();
}

function recupPrenom($idUser, $bdd){
    $statement = $bdd->prepare('SELECT prenom FROM utilisateurs
    WHERE idUtilisateur=' . $idUser);
    $statement->execute();
    return $statement->fetchAll();
}

function recupEmail($idUser, $bdd){
    $statement = $bdd->prepare('SELECT email FROM utilisateurs
    WHERE idUtilisateur=' . $idUser);
    $statement->execute();
    return $statement->fetchAll();
}

function update($idUser, $bdd, $nom, $prenom, $email){
    $sth = $bdd->prepare('UPDATE utilisateurs SET nom = :nom ,prenom = :prenom, email = :email WHERE idUtilisateur='.$idUser );

    $sth->bindValue(':nom', $nom);
    $sth->bindValue(':prenom', $prenom);
    $sth->bindValue(':email', $email);

    $resultat = $sth->execute();
    if(!$resultat) {
        throw new Exception("Le token du mot de passe ne peut pas être réinitialisé");
    }
}


function updatePassword($idUser, $bdd, $newPassword){
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

    $sth = $bdd->prepare('UPDATE utilisateurs SET passwordHash = :newPasswordHash WHERE idUtilisateur='.$idUser );
    $sth->bindValue(':newPasswordHash', $newPasswordHash);
    $resultat = $sth->execute();

    if(!$resultat) {
        throw new Exception("Le token du mot de passe ne peut pas être réinitialisé");
    }
}


?>