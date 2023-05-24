<?php

require_once("pdo.php");

$nom = $_POST['nom_eleve'];
$prenom = $_POST['prenom_eleve'];
$datenaissance = $_POST['date_naissance'];
$mail = $_POST['mail_eleve'];
$telephone = $_POST['telephone_eleve'];
$adresse = $_POST['adresse_eleve'];
$codepostal = $_POST['codepostal_eleve'];
$ville = $_POST['ville_eleve'];
$classe = $_POST['nom_classe'];

class NouvelEleve
{
    private $nomEleve;
    private $prenomEleve;
    private $dateNaissanceEleve;
    private $mailEleve;
    private $telephoneEleve;
    private $adresseEleve;
    private $codepostalEleve;
    private $villeEleve;
    private $classeEleve;
    private $pdo;

    public function __construct($nom, $prenom, $datenaissance, $mail, $telephone, $adresse, $codepostal, $ville, $classe, $pdo)
    {
        $this->nomEleve = $nom;
        $this->prenomEleve = $prenom;
        $this->dateNaissanceEleve = $datenaissance;
        $this->mailEleve = $mail;
        $this->telephoneEleve = $telephone;
        $this->adresseEleve = $adresse;
        $this->codepostalEleve = $codepostal;
        $this->villeEleve = $ville;
        $this->classeEleve = $classe;
        $this->pdo = $pdo;

        echo "<p>Constructeur exécuté.</p><br>";
    }

    public function ajouterEleve()
    {
        $query = "SELECT id_classe FROM classe WHERE nom_classe = :classe";
        $ps = $this->pdo->prepare($query);
        $ps->bindParam(':classe', $this->classeEleve);
        $ps->execute();
        $idclasse = $ps->fetchColumn();

        $query2 = "INSERT INTO eleves(nom_eleve, prenom_eleve, date_naissance, mail_eleve, telephone_eleve, adresse_eleve, codepostal_eleve, ville_eleve, id_classe) VALUES (:nom, :prenom, :date_naissance, :mail, :telephone, :adresse, :codepostal, :ville, :idclasse)";
        $ps2 = $this->pdo->prepare($query2);
        $ps2->bindParam(':nom', $this->nomEleve);
        $ps2->bindParam(':prenom', $this->prenomEleve);
        $ps2->bindParam(':date_naissance', $this->dateNaissanceEleve);
        $ps2->bindParam(':mail', $this->mailEleve);
        $ps2->bindParam(':telephone', $this->telephoneEleve);
        $ps2->bindParam(':adresse', $this->adresseEleve);
        $ps2->bindParam(':codepostal', $this->codepostalEleve);
        $ps2->bindParam(':ville', $this->villeEleve);
        $ps2->bindParam(':idclasse', $idclasse);
        $ps2->execute();
    }
}

$newEleve = new NouvelEleve($nom, $prenom, $datenaissance, $mail, $telephone, $adresse, $codepostal, $ville, $classe, $pdo);

$newEleve->ajouterEleve();

header("Location:liste_eleves.php");
?>

