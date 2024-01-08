<?php
require '../utils/patients_functions.php';

    if (isset($_POST['prenom'], $_POST['nom'], $_POST['adresse'], $_POST['email'], $_POST['motdepasse'])) {
        $result = addPatient($_POST['prenom'], $_POST['nom'], $_POST['adresse'], $_POST['email'], $_POST['motdepasse']);
        $message = $result['message'];
    } else {
        $message = "Tous les champs sont requis.";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hôpital SoigneMoi de la région lilloise</title>
    <link rel="stylesheet" href="/front-end/css/style.css">
</head>
<body>
    <nav class="nav-bar-signup-page">
        <img class="logo_main" src="/front-end/assets/logo-soignemoi.png" alt="logo de l'hôpital SoigneMoi">
        <a href="/index.html" class="returntomain-button">Retour à l'accueil</a>
    </nav>  
    <div class="signup-confirmation-message-container">
    <p class="signup-confirmation-message confirmation-message">
    <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
    </p>
</div>
<script>
    const confirmationMessage = document.querySelector(".signup-confirmation-message");

    if(confirmationMessage.textContent.includes("Erreur") ) {
        confirmationMessage.style.color = "red";
    } 
</script>

</body>
</html>
