<?php session_start();

    include("classes/User.php");

    $TheUser = new User(null, null, null,null, $pdo);

    try {
        // ---------------Connexion à la BDD et récupération et traitement du formulaire
        $pdo = new PDO('mysql:host=192.168.65.152;dbname=projet_gps', 'root', 'root');
    } catch (Exception  $error) {
        $error->getMessage();
    }

    if (isset($_POST['connexion'])) {
        $TheUser->seConnecter($_POST['login'], $_POST['pass']);
    }

    if (isset($_POST['deconnexion'])) {
        $TheUser->seDeConnecter();
    }

    if (isset($_SESSION['Connexion']) && $_SESSION['Connexion'] == true) {
        $TheUser->getUserById($_SESSION['id']);
        
        $htmlformdeco = '<form action="" method="post" class="form-inline my-2 my-lg-0">
        <input class="btn btn-outline-dark bg-light" type="submit" name="deconnexion" value="Se déconnecter">
        </form>';
        $htmllinkCompte = '<li class="nav-item"><a class="nav-link active" aria-current="page" href="compte.php">Compte</a></li>';

        header('Location: site.html');
        die();
    } else {
        
        $htmlformdeco = '';
        $htmllinkCompte = '';
    ?>
    <div class="imageDeFond">
            <div class="container">
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-header">
                            <h3>Sign In</h3>
                        </div>
                        <form action="" method="post">
                        <div class="card-body">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input required="le mail est obligatoire pour s'inscrire ou se connecter" type="text" class="form-control" placeholder="E-mail" name="login">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="password" name="pass">
                                </div>
                                <div class="row align-items-center remember">
                                    <input type="checkbox" checked>Se souvenir de moi
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Login" class="btn float-right login_btn" name="connexion">
                                </div>
                        </div>
                        <div class="card-footer">
                            <?php
                            if (isset($_POST['Inscription']) && isset($_POST['login'])) {
                                $TheUser->CreateNewUser($_POST['login'],$_POST['pass']);
                                ?>
                                <div class="d-flex justify-content-center links">
                                    Un mot de passe temporaire à été envoyé dans votre boite Mail ;)
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="d-flex justify-content-center links">
                                    <input type="submit" name="Inscription" class="lienBouton" value="Inscrivez vous ?"></input>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" name="PassOublie" class="lienBouton" value="Mots de pass oublié ?"></input>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }


    if (isset($_SESSION['Connexion'])) {
    ?><nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Voir Tous les Films</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <?= $htmllinkCompte; ?>
                    </ul>

                    <form class="form-inline my-2 my-lg-0 mr-1" action="index.php">
                        <button class="btn btn-outline-dark bg-light" type="submit">
                            <i class="bi bi-person-fill"></i>
                            <?php echo $TheUser->getLogin() ?>
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                    <?= $htmlformdeco ?>
                
                </div>
            </div>
        </nav>
    <?php
    }
?>