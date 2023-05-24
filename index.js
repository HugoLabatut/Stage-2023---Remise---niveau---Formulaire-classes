// Autocomplétion
$(function () {
    // On prend l'id de notre input de notre recherche de nom de classe de BTS
    $("#nom_classe").autocomplete({
        source: function (request, response) {
            // Appel d'ajax
            $.ajax({
                url: 'autocomplete.php', // Appel du fichier
                type: 'get', // Méthode d'envoi
                dataType: "json", // Type de données -> JSON
                data: {
                    search: request.term // Terme recherché par l'utilisateur
                },
                success: function (data) {
                    response(data) // Réponse de notre requête
                }
            });
        },
        // Sélection des données de l'autocomplétion avec ces deux fonctions : select et focus
        select: function (event, ui) {
            $("#nom_classe").val(ui.item.label);
            return false;
        },
        focus: function (event, ui) {
            $("#nom_classe").val(ui.item.label);
            return false;
        },
    });
});


