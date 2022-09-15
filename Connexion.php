<?php
    session_start();

    include ("User.php");

    highlight_file(__FILE__);

    try {
        $pdo = new PDO('mysql:host=192.168.65.152;dbname=GPS', 'UserWeb', 'UserWeb');
    } catch (Exception  $error) {
        $error->getMessage();
    }

    $User1 = new User(null,$pdo);

    if(isset($_POST["btnConnexion"])){
        $User1->seConnecter($_POST["login"],$_POST["mdp"]);
    }
    if(!$User1->isConnect()){
?>

    <form action="" method="post" >    
        <label for="login">Nom d'utilisateur : </label>
        <input type="text" name="login" id="login" required value="projet">

        <label for="vie">Mot de passe : </label>
        <input type="password" name="mdp" id="mdp" required value="projet">

        <input type="submit" name="btnConnexion" value="Connect toi">
    </form>
<?php 
    $User1 = null;
    }else{
        $User1->getUserByID($_SESSION['idUser']);
        $User1->afficheUser();
    }
?>