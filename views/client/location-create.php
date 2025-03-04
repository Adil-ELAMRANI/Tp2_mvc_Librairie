<!-- location-create.php -->
<!-- Formulaire pour créer une nouvelle location -->

{{ include('layouts/header.php', {title:'location-create'})}}
<div>
    <h2>Créer une nouvelle location</h2>
    <form action="{{ path }}location/store" method="post">
        <label>Client
            <select name="client_id">
                {% for client in clients %}
                <option value="{{ client.id }}">{{ client.prenom }} {{ client.nom }}</option>
                {% endfor %}
            </select>
        </label>
        <br>
        <label>Livre
            <select name="livre_id">
                {% for livre in livres %}
                <option value="{{ livre.id }}">{{ livre.titre }}</option>
                {% endfor %}
            </select>
        </label>
        <br>
        <label>Durée de location
            <select name="date_fin">
                <option value="{{ datefin7 }}">1 semaine</option>
                <option value="{{ datefin14 }}">2 semaines</option>
            </select>
        </label>
        <input type="hidden" name="date_debut" value="{{ date_debut }}">
        <input type="submit" value="Enregistrer" class="submit">
    </form>
</div>
{{ include('layouts/footer.php')}}