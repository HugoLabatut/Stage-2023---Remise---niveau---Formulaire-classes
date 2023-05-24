<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Liste des élèves</title>
    </head>
    <body>
        <?php require_once("pdo.php");?>
        <main>
            <section class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>                           
                            <th scope="col">Classe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $requete = "SELECT * FROM eleves";
                            $result = $pdo->prepare($requete);
                            $result->execute();
                            if($result->rowCount() > 0)
                            {
                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<tr>";
                                    echo "<td>", $row["id_eleve"], "</td>";
                                    echo "<td>", $row["nom_eleve"], "</td>";
                                    echo "<td>", $row["prenom_eleve"], "</td>";
                                    $query = "SELECT nom_classe FROM classe WHERE id_classe = :idclasse";
                                    $ps = $pdo->prepare($query);
                                    $ps->bindParam(':idclasse', $row['id_classe']);
                                    $ps->execute();
                                    $nomclasse = $ps->fetchColumn();
                                    echo "<td>", $nomclasse, "</td>";
                                    echo "</tr>";
                                }
                            }
                            else
                            {
                                echo "Aucune donnée trouvée.";
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </body>
</html>