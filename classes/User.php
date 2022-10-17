<?php
    class User{

        private $id_;
        private $isAdmin_ = false;
        private $login_;
        private $pdo_;

        public function __construct($id,$isAdmin,$login,$pdo){
            $this->id_ = $id;
            $this->isAdmin_ = $isAdmin;
            $this->login_ = $login;
            $this->pdo_ = $pdo;
        }
        public function getLogin(){
            return $this->login_;
        }
        public function getId(){
            return $this->id_;
        }
        public function seConnecter($Login,$pass){
            
            $sql = "SELECT * FROM `User` 
            WHERE `login` = '".$Login."' 
            AND `mdp` ='".$pass."'
            ";
            $resultat = $this->pdo_->query($sql);
            if ($tab = $resultat->fetch()){
                $this->login_ = $tab['login'];
                $this->id_ = $tab['id'];
                $this->isAdmin_ = $tab['isAdmin'];
                $_SESSION['idUser']=$tab['id'];
                $_SESSION['Connexion']=true;
                return true;
            }
        }

        public function seDeConnecter(){
            session_unset();
            session_destroy();
        }

        public function getUserById($id){
            $sql = "SELECT * FROM `User` 
            WHERE `id` = '".$id."'";
            $resultat = $this->pdo_->query($sql);
            if ($tab = $resultat->fetch()){
                $this->login_ = $tab['login'];
                $this->id_ = $tab['id'];
            }
        }

        public function isConnect(){
            if( isset( $_SESSION['idUser'])){
                $sql = "SELECT * FROM `User` 
                WHERE `id` = '".$_SESSION['idUser']."'";
                $resultat = $this->pdo_->query($sql);
                if ($tab = $resultat->fetch()){
                    $this->login_ = $tab['login'];
                    $this->id_ = $tab['id'];
                    return true;
                }
            }else{
                return false;
            }
        }

        public function CreateNewUser($login,$pass){

            $RequetSql = "SELECT * FROM `User` 
            WHERE 
            `login` = '".$login."'";
            $resultat = $GLOBALS["pdo"]->query($RequetSql); 
            if ( $resultat->rowCount()>0){
                $tab = $resultat->fetch();
                $this->id_ = $tab['id'];
                $this->isAdmin_ = $tab['isAdmin'];
                $this->login_ = $tab['login'];
                $pass =  $tab['pass'];
                
            }else{
                if(empty($pass)){
                    $temp= password_hash($login, PASSWORD_DEFAULT);
                    $pass=substr($temp, 13, 3).substr($temp, 23, 3).substr($temp, 33, 3).'!';
                }
                $requetSQL = "INSERT INTO `User`
                ( `login`, `pass`, `isAdmin`) 
                VALUES 
                ('" . $login . "','" . $pass . "','0')";
                $resultat = $GLOBALS["pdo"]->query($requetSQL);
                $this->id_ = $GLOBALS["pdo"]->lastInsertId();
                $this->isAdmin_ = 0;
                $this->login_ = $login;
            }
        }
    }

    try {
        $pdo  = $this->login_;

        mail($to, $subject, $message, implode("\r\n", $headers));
    } catch (Exception  $error) {
        $error->getMessage();
    }  
?> 
