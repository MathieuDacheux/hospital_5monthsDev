<!-- Section Main -->
<main>
    <!-- Formulaire d'enregistrement d'un nouveau patient -->
    <section class="containerCentral">
        <div class="containerForm newPatient">
            <div class="containerTitle">
                <h3>Information du patient</h3>
            </div>
            <form method="POST">
                <div class="containerInputName">
                    <input type="text" name="lastName" id="lastName" placeholder="Nom">
                    <input type="text" name="firstName" id="firstName" placeholder="Prénom">
                </div>
                <input type="date" name="birthDate" id="birthDate" placeholder="Date">
                <div class="containerInputContent">
                    <input type="tel" name="phone" id="phone" placeholder="Numéro">
                    <input type="text" name="mail" id="mail" placeholder="Mail">
                </div>
                <select name="gender" id="gender">
                    <option value="1">Homme</option>
                    <option value="2">Femme</option>
                </select>
                <button>Envoyer</button>
            </form>
            <p><?= (isset($confirmation)) ? $confirmation : '' ?></p>
            <p><?= (isset($error)) ? $error : '' ?></p>
        </div>
    </section>
</main>