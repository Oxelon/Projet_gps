<?php include("session.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css\formulaire.css'>
    <script src='main.js'></script>
</head>
<body>

    <div class="wrapper">
        <section class="login-container">
            <div>
                <header>
                    <h2>Formulaire</h2>
                </header>

                <form action="" method="post">
            
                    <input type="text" name="username" placeholder="Nom d'utilisateur" required="required"/>
                    <input type="password" name="password" placeholder="Mot de passe" required="required"/>
                    <button type="submit">Connexion</button>


                </form>
            </div>
        </section>
    </div>
    
</body>
</html>