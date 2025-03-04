<!-- client-show.php -->
<!-- Affichage des détails d'un client -->

{{ include('layouts/header.php', {title:'client-showt'})}}
    <div class="container">
    <h1>Détails du client</h1>
        <p><strong>Prénom : </strong>{{ client.prenom }}</p>
        <p><strong>Nom : </strong>{{ client.nom }}</p>
        <p><strong>Adresse : </strong>{{ client.adresse }}</p>
        <p><strong>Code Postal : </strong>{{ client.code_postal }}</p>
        <p><strong>Phone : </strong>{{ client.phone }}</p>
        <p><strong>Ville : </strong>
            {% for ville in villes %}
                {% if client.ville_id == ville.id %}
                    {{ ville.nom }}
                {% endif %}
            {% endfor %}
        </p>
        <p><a href="{{ path }}client/edit/{{ client.id }}">Modifier</a></p>
    </div>
{{ include('layouts/footer.php')}}