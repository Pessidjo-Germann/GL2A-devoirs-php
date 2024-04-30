<?php 
class AdminModel{
 
   private $db;
   
   public function __construct($db){
     
      $this->db = $db;
   }

   public function getAdminByUsername($pseudo) {
    // Préparation de la requête SQL pour récupérer l'admin par son nom d'utilisateur
    $stmt = $this->db->prepare("SELECT * FROM admin WHERE pseudo = ?");
    $stmt->execute([$pseudo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function verifyPassword($password, $hashedPassword) {
  // Vérification du mot de passe hashé
  return password_verify($password, $hashedPassword);
}

public function createAdmin($iddemande  ,$pseudo,$password) {
  // Hashage du mot de passe pour des raisons de sécurité
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  // Préparation de la requête SQL pour l'insertion d'un utilisateur dans la base de données
  $stmt = $this->db->prepare("INSERT INTO admin (iddemande,pseudo, password) VALUES (?, ?,?)");
  // Exécution de la requête avec les valeurs fournies
  return $stmt->execute([$iddemande,$pseudo, $hashedPassword]);
}
    
}
?>