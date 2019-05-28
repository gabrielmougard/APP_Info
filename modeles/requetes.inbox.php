<?php

include('modeles/requetes.generiques.php');

function retrieveMails($bdd,$idUtilisateur,$p) {

    $limit = 6;

    if(!isset($p)){
        $offset = 0;
    }else if($p == '1'){
        $offset = 0;
    }else if($p <= '0'){
        $offset = 0;
    }else {
        $offset = ($p - 1) * $limit;
    }

    //explaination : We want the first message of the different ticket started by the specified user
    $sth = $bdd->prepare("SELECT * FROM messagerie WHERE idUser = :idUtilisateur GROUP BY idTicket HAVING reply = 1 LIMIT :offset, 6");
    $sth->bindValue(":offset",$offset, PDO::PARAM_INT);
    //$sth->bindValue(":lim",$limit, PDO::PARAM_INT);
    $sth->bindValue(":idUtilisateur", $idUtilisateur);
    $sth->execute();

    $res = $sth->fetchAll();

    //return also the total number of different started tickets divided by the limit (for getting the number of pages)
    $total = ceil(count($res)/$limit);
    return array($res,$total,$limit);
}

function retrieveDiscussionThread($bdd,$idTicket) {

    //1) update the DB to mark the discussion as visited
    $sth = $bdd->prepare("UPDATE messagerie SET ouvert = '1' WHERE idTicket = :idTicket");
    $sth->bindValue(':idTicket',$idTicket);
    $sth->execute();

    //2) load the discussion thread
    // explanation : we select all the messages in the discussion thread with descending order as
    // we will pop the element and then we need the first message to be at the end of the array
    $req = $bdd->prepare("SELECT * FROM messagerie WHERE idTicket = :idTicket ORDER BY reply ASC");
    $req->bindValue(":idTicket",$idTicket,PDO::PARAM_INT);
    $req->execute();

    $res = $req->fetchAll();
    return $res;


}
function removeMessage($bdd,$idMessage) {
    $sth = $bdd->prepare("DELETE FROM messagerie WHERE idMessage = :idMessage");
    $sth->bindValue(':idMessage',$idMessage);
    $remove = $sth->execute();

    return $remove;
}


/**
 * @param $bdd
 * @param $data array containing content data
 * @param $newMessage boolean true if it's starting a new discussion thread, false if not.
 */
function writeMessage($bdd,$data) {

    $idTicket = 0;
    $reply = 0;


    //get the usermail with $data['id']
    $sth = $bdd->prepare("SELECT email FROM utilisateurs WHERE idUtilisateur = :id");
    $sth->bindValue(":id",$data['idUser']);
    $sth->execute();
    $emailUtilisateur = $sth->fetchAll();

    if ($data["newMessage"] == "true") {
        $sth = $bdd->prepare("SELECT COUNT(*) FROM messagerie");
        $sth->execute();
        $res = $sth->fetchAll()[0][0];
        if ($res == 0) { // si il n'y a pas encore de message dans la table
            $idTicket = 0;
        }
        else {
            $sth = $bdd->prepare("SELECT DISTINCT idTicket FROM messagerie");
            $sth->execute();
            $idTicket = count($sth->fetchAll())+1; //next idTicket
            $reply = 1;
        }
    }
    else { //the idTicket is present in $data because it's in SESSION passed in URL param
        $sth = $bdd->prepare("SELECT COUNT(*) FROM messagerie WHERE idTicket = :idTicket");
        $sth->bindValue(":idTicket", $data["idTicket"]);
        $sth->execute();
        $reply = $sth->fetchAll()[0][0]; //reply is 1-indexed.
        //var_dump($reply);
        $reply += 1;

    }

    $sth = $bdd->prepare("INSERT INTO messagerie (idUser,idTicket,emailUser,contenu,ouvert,reply,subject ) VALUES (:idUser,:idTicket,:emailUser,:content,:ouvert,:reply,:subject)");
    $sth->bindValue(':idUser',$data["idUser"]);
    $sth->bindValue(':subject',$data["subject"]);
    $sth->bindValue(':idTicket',$idTicket);
    $sth->bindValue(':emailUser',$emailUtilisateur[0]["email"]);
    $sth->bindValue(':content',$data["content"]);
    $sth->bindValue(':ouvert',$data["ouvert"]);
    $sth->bindValue(':reply',$reply);

    $res = $sth->execute();
    return $res;

}