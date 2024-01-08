<?php
session_start();
include_once '../utils/patients_functions.php';

if (isset($_POST['email'], $_POST['motdepasse'])) {
    $result = loginPatient($_POST['email'], $_POST['motdepasse']);
    
    if ($result['success']) {
        if ($result['role'] == "administrateur") {
            $_SESSION["role"] = "administrateur";
            header("Location: /pages/admin_web.php");
            exit;
        } else {
            $_SESSION['user_id'] = $result['user_id'];
            header('Location: /pages/dashboard.php');
            exit;
        }
    } else {
        echo $result['message'];
    }
}
?>
