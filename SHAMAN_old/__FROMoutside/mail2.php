<?php
$destinataire = 'vincseize@gmail.com';
// Pour les champs $expediteur / $copie / $destinataire, s�parer par une virgule s'il y a plusieurs adresses
$expediteur = 'vincseize@gmail.com';
$copie = 'vincseize@gmail.com';
$copie_cachee = 'vincseize@gmail.com';
$objet = 'Test'; // Objet du message
$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: "Nom_de_expediteur"<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
$headers .= 'Cc: '.$copie."\n"; // Copie Cc
$headers .= 'Bcc: '.$copie_cachee."\n\n"; // Copie cach�e Bcc        
$message = 'Un Bonjour de Developpez.com!';
if (mail($destinataire, $objet, $message, $headers)) // Envoi du message
{
    echo 'Votre message a bien �t� envoy� ';
}
else // Non envoy�
{
    echo "Votre message n'a pas pu �tre envoy�";
}
?>