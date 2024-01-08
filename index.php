<?php 
ob_start();
session_start() ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau administration</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <p class="headerP">Panneau d'administration</p>
        <nav>
            <ul class="onglets">
                <a href="?page=accueil"><li>Accueil</li></a>
                <a href="?page=utilisateur"><li>Utilisateur</li></a>
                <a href="?page=parametre"><li>Paramètre</li></a>
                <?php 
                if (isset($_SESSION["id"])){
                    echo '<a href="?page=deconnexion"><li>Déconnexion</li></a>';
                }
                else {
                    echo '<a href="?page=connexion"><li>Connexion</li></a>';
                }
                ?>
                
            </ul>
        </nav>
    </header>    

    <?php 
        if (isset($_GET['page']) && $_GET['page'] == "connexion"){
            echo '<form method="POST">
            <label>Identifiant</label>
            <input type="text" name="inputId">
            <label>Mot de passe</label>
            <input type="password" name="inputPw">
            <input type="submit" name="submitConnect">
            </form>';
        }

        if (isset($_POST['submitConnect'])){

            if ($_POST["inputId"] == "thomas" && $_POST["inputPw"] == "123456"){
                echo "vous êtes connectée";
    
                $_SESSION["id"] = $_POST["inputId"];
                $_SESSION["nom"] = "Brandt";
                $_SESSION["prenom"] = "Thomas";
                $_SESSION["age"] = "35";
                $_SESSION["mail"] = "thomas.brandt@afci-formation.fr";
                header('Location: ?page=accueil');
            }
            
            else {
                echo "mauvais id ou mdp";
            }
            
        }
    
        if (isset($_GET['page']) && $_GET['page'] == "deconnexion"){
            session_destroy();
            header('Location: ?page=connexion');
        }

        if (isset($_GET['page']) && $_GET['page'] == "utilisateur"){

            if (isset($_SESSION['id'])){
                echo '<p>Nom : ' . $_SESSION["nom"] .'</p>
                <p>Prénom : ' . $_SESSION["prenom"] .'</p>
                <p>Age : ' . $_SESSION["age"] .'</p>
                <p>Email : ' . $_SESSION["mail"] .'</p>
            ';
            }
            else {
                echo "Vous n'êtes actuellement pas connecté";
            }

        }

        if (isset($_GET['page']) && $_GET['page'] == "accueil"){

            if (isset($_SESSION['id'])){
                echo '<p>Bonjour ' . $_SESSION["nom"] . " " . $_SESSION["prenom"] . '. Vous êtes actuellement connectés</p>';
            }
            else {
                echo "Vous n'êtes actuellement pas connecté";
            }
        }


        if (isset($_GET['page']) && $_GET['page'] == "parametre"){
            
            if (isset($_SESSION['id'])){
                echo '<form method="post" class="formModify">
                <label>Nom</label>
                <input type="text" name="lastNameModify" value="' . $_SESSION["nom"] . '">
                <label>Prénom</label>
                <input type="text" name="firstNameModify" value="' . $_SESSION["prenom"] . '">
                <label>Age</label>
                <input type="text" name="ageModify" value="' . $_SESSION["age"] . '">
                <label>email</label >
                <input type="text" name="emailModify" value="' . $_SESSION["mail"] . '">
                <input type="submit" value="Modifier les informations" name="submitModify">
            </form>';
            }

            else {
                echo "vous devez êtres connecté pour avoir accès aux modificaitons";
            }

            if (isset($_POST['submitModify'])){

                $_SESSION["nom"] = $_POST['lastNameModify'];
                $_SESSION["prenom"] = $_POST['firstNameModify'];
                $_SESSION["age"] = $_POST['ageModify'];
                $_SESSION["mail"] = $_POST['emailModify'];
                header('Location: ?page=parametre');
                echo "j'appuie sur bouton modifier";
            }

        }

    ?>




</body>
</html>