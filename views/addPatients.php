<!-- Section Main -->
<main>
    <!-- Formulaire d'enregistrement d'un nouveau patient -->
    <form method="POST">
        <input type="text" name="lastName" id="lastName" placeholder="Nom">
        <input type="text" name="firstName" id="firstName" placeholder="Prénom">
        <input type="date" name="birthDate" id="birthDate" placeholder="Date">
        <input type="text" name="phone" id="phone" placeholder="Numéro">
        <input type="text" name="mail" id="mail" placeholder="Mail">
        <select name="gender" id="gender">
            <option value="man">Homme</option>
            <option value="female">Femme</option>
            <option value="other">Autres</option>
        </select>
        
        <button>SUBMIT</button>
    </form>
</main>