<?php

error_reporting(0); 


$to_email = "info@espacestudio.be"; 

$redirect_page = "inscription.html"; 


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type'])) {
    
    $form_type = $_POST['form_type'];
    $subject = "Nouveau Questionnaire Shooting Photo - " . ($form_type === 'particulier' ? "Particulier" : "Entreprise");
    $message = "Type de Formulaire : " . ($form_type === 'particulier' ? "Particulier" : "Entreprise") . "\n\n";


    // ⚠️ IMPORTANT : REMPLACEZ VOTRE_DOMAINE PAR VOTRE NOM DE DOMAINE RÉEL
    $headers = "From: webmaster@espacestudio.be\r\n"; 
    $headers .= "Reply-To: noreply@espacestudio.be\r\n"; 
    $headers .= "X-Mailer: PHP/" . phpversion();


    foreach ($_POST as $key => $value) {
        if ($key !== 'form_type') {

            $clean_key = str_replace("_", " ", $key); 
            $clean_key = ucwords($clean_key);       
            
            $message .= $clean_key . " : " . $value . "\n";
        }
    }



    if (mail($to_email, $subject, $message, $headers)) { 

        header("Location: " . $redirect_page . "?status=success");
        exit;
    } else {
 
        header("Location: " . $redirect_page . "?status=error");
        exit;
    }

} else {

    header("Location: " . $redirect_page);
    exit;
}
?>