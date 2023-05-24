<?php
    require_once("pdo.php");
    
    // Récupération des données de la bdd
    $requete = $pdo->prepare('SELECT * FROM classe WHERE nom_classe LIKE :keyword');

    $requete->bindValue('keyword', '%'.$_GET['search'].'%'); // Lie une valeur à un espace réservé nommé ou constitué de points d’interrogation dans l’instruction SQL.

    $requete->execute();
    $resultat = array(); // Création d'un tableau pour stocker les résultats

    while($nomclasse = $requete->fetch(PDO::FETCH_OBJ))
    {
        array_push($resultat, $nomclasse->nom_classe);
    }

    echo json_encode($resultat);
?>

