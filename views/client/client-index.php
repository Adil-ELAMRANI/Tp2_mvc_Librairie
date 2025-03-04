<!-- client-index.php -->
<!-- Affichage de la liste des clients avec leurs informations -->
 
{{ include('layouts/header.php', {title:'client-index'})}}
<div>
    <h1>Liste des Clients</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Phone</th>
                <th>Ville</th>
            </tr>
        </thead>
        <tbody>
            {% for client in clients %}
            <tr>
                <td><a href="{{ path }}client/show/{{ client.id }}">{{ client.prenom }} {{ client.nom }}</a></td>
                <td>{{ client.adresse }}</td>
                <td>{{ client.code_postal }}</td>
                <td>{{ client.phone }}</td>
                <td>
                    {% for ville in villes %}
                    {% if client.ville_id == ville.id %}
                    {{ ville.nom }}
                    {% endif %}
                    {% endfor %}
                </td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
</div> 
{{ include('layouts/footer.php')}}