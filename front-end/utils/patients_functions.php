<?php
include_once '../utils/config.php';


// FONCTION POUR AJOUTER UN COMPTE PATIENT  - SIGNUP

function addPatient($prenom, $nom, $adresse, $email, $motdepasse) {
    try {
        $databaseHandler = getDatabaseConnection();

        $sql = "INSERT INTO patients (prenom, nom, adresse, email, motdepasse)
                VALUES (:prenom, :nom, :adresse, :email, :motdepasse)";
        $statement = $databaseHandler->prepare($sql);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':adresse', $adresse);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':motdepasse', $motdepasse);
        $statement->execute();

        return [
            'success' => true,
            'message' => "Votre compte patient a bien été créé! Vous pouvez désormais vous connecter et prendre rendez-vous."
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => "Erreur lors de la création du compte. Probleme : " . $e->getMessage()
        ];
    }
}

// FONCTION POUR SE CONNECTER - LOGIN

function loginPatient($email, $password) {
    try {
        $pdo = getDatabaseConnection();

        if ($email == "admin@soignemoi.fr" && $password == "Studi2022@") {
            return [
                'success' => true,
                'message' => "Connexion réussie en tant qu'administrateur",
                'role' => "administrateur"
            ];
        }

        $stmt = $pdo->prepare('SELECT id, email, motdepasse FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && $password == $user['motdepasse']) {
            return [
                'success' => true,
                'message' => "Connexion réussie",
                'user_id' => $user['id']
            ];
        } else {
            return [
                'success' => false,
                'message' => "Informations d'identification incorrectes."
            ];
        }

    } catch (PDOException $e) {
        return [
            'success' => false,
            'message' => "Erreur : " . $e->getMessage()
        ];
    }
}