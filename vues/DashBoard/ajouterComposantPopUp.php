


<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    function valider(text){
        if(text===""){
            return false;
        }
        let isNumber=/^\d+$/.test(text);
        if(!isNumber){
            alert("Le numéro de série doit contenir seulement des nombres");
            return false;
        } else {
            return true;
        }
    }
    function modificationInformations(idPiece) {
        let fenetreAjout = prompt("Veuillez saisir le numéro de série du capteur à ajouter:");
        if (valider(fenetreAjout)) {
            let request;
            request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {// 4 = reponse prete / 200 = Ok
                    document.getElementsByClassName("conteneur_Cemac")[0].innerHTML += this.responseText;
                }
            };
            request.open("GET", "http://localhost/APP_Info-master/index.php?cible=ajout&idPiece=" + idPiece + "&numero_serie=" + fenetreAjout, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();
        }

    }
</script>

<button class="open-button" onclick="modificationInformations(<?php echo $_GET['idPiece']?>);">Ajouter un composant </button>
