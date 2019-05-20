<?php ?>
<button class="open-button" onclick="openForm()">Ajouter un composant</button>
<div class="form-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
    <h1>Ajout de composant</h1>

    <label for="Numéro de série"><b>Numéro de série</b></label>
    <input type="text" placeholder="1234" name="numero_serie" required>

    <button type="submit" class="btn">Valider</button>
    <button type="submit" class="btn cancel" onclick="closeForm()">Fermer</button>
  </form>
</div>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>