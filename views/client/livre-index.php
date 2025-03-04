<!-- livre-index.php -->
<!-- Affichage de la liste des livres disponibles -->

{{ include('layouts/header.php', {title:'livre-index'})}}
<div>
    <h1>Liste des livres</h1>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Nombre de pages</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            {% for livre in livres %}
            <tr>
                <td>{{ livre.titre }}</td>
                <td>{{ livre.auteur }}</td>
                <td>{{ livre.nombre_pages }}</td>
                <td>
                    {% for categorie in categories %}
                    {% if livre.categorie_id == categorie.id %}
                    {{ categorie.nom }}
                    {% endif %}
                    {% endfor %}
                </td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
</div>
{{ include('layouts/footer.php')}}