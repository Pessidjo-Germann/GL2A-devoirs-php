<?php
 class AdminController{
    private $adminModel;
    public function __construct($adminModel){
        $this->adminModel = $adminModel;
    }
    public function login(){
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
         $username=$_POST['name'];
         $password=$_POST['password'];

         $admin=$this->adminModel->getAdminByUsername($username);

         if($admin && $this->adminModel->verifyPassword($password, $admin['password'])){
            echo "Connexion réussie en tant que " . $username;
            $_SESSION['username']=$_POST['username'];
            $_SESSION['idadmin']=$admin['idadmin'];
            $_SESSION['password']=$_POST['password'];
            // Rediriger l'utilisateur vers une page sécurisée, par exemple
             header("Location: ?action=acte");
         }else{
            echo 'Identifiants incorrect';
         }
        }
        require './vue/form.php';
    }

    public function register() {
        
        // Gestion de l'inscription
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $iddemande=$_POST['idemande'];
            $username=$_POST['username'];
            $password=$_POST['password'];

            //creation de l'utilisateur
            if (!empty($username)&& !empty($iddemande) && !empty($password)) {
               if($this->adminModel->createAdmin($username,$password,$iddemande)){
                echo 'Utilisateur '. $username .'crée avec succes';
                //Rediriger vers la page de connexion||home(acceuill)
                
                // Rediriger l'utilisateur vers une page sécurisée, par exemple
                 header("Location: ?action=login");
                //header('Location : login.php')
            }else{
                echo 'Erreur lors de la création ';
               }
            }else{
                echo 'les champs sont pas remplis';
            }
        }
        //Affichage du formulaire d'inscription
        require './vue/FormulaireConnexionAdmin.php';
    }
 }

?>