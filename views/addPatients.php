<!-- Section Main -->
<main>
    <!-- Formulaire d'enregistrement d'un nouveau patient -->
    <div class="containerPrincipal">
        <form method="POST">
            <input type="text" name="lastName" id="lastName" placeholder="Nom">
            <input type="text" name="firstName" id="firstName" placeholder="Prénom">
            <input type="date" name="birthDate" id="birthDate" placeholder="Date">
            <input type="tel" name="phone" id="phone" placeholder="Numéro">
            <input type="text" name="mail" id="mail" placeholder="Mail">
            <select name="gender" id="gender">
                <option value="1">Homme</option>
                <option value="2">Femme</option>
                <option value="3">Autres</option>
            </select>
            <button>SUBMIT</button>
        </form>
    </div>
</main>