
<?php
    include '../fonction/fonction.php';
    include("connexion.php");
    $publication="Select * from publication JOIN membres on membres.IdMembres=publication.IdMembres;";
    $all_pub=mysqli_query($bdd,$publication);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Body.css">
    <link rel="stylesheet" href="../css/self-pub.css">
    <meta charset="UTF-8">
    <title>Karakory</title>
</head>
<body>
    
    <div id="body">
        <div class="my-profile">
            <a href="./publier.php"><i class="fas fa-pencil-alt"><span class="sap pub"> Publier</span></i></a>
            <div class="friends-disco">
                <!-- <a href="" class="message pro "><i class="fab fa-facebook-messenger"><span class="sap mess"> Message</span></i></a> -->
                <a href="liste_amis.php" class="friends pro"><i class="fas fa-user-friends"><span class="sap amis"> Amis</span></i></a>
                <a href="deconexion.php" class="disconnect pro"><i class="fas fa-power-off"><span class="sap deco"> Déconnexion</span></i></a>
            </div>
        </div>
        <div id="Publication">
            <?php while($p=mysqli_fetch_assoc($all_pub)){ ?>
            
            <div class="Publ_img">
                <div class="user">

                    <div class="profil-pic">

                    </div>
                    <div class="about">

                        <div class="profil-name" style="line-heigh receive 	index.php