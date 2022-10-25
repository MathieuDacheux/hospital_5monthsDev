<!-- Section Main -->
<main>
    <!-- Formulaire d'enregistrement d'un nouveau patient -->
    <section class="containerCentral">
        <div class="containerForm newPatient">
            <div class="containerTitle">
                <h3>Information du rendez-vous</h3>
            </div>
            <form method="POST">
                <input type="date" name="birthDate" id="birthDate" placeholder="Date">
                <select name="id" id="id">
                <?php foreach($patientsList as $patient) : ?>
                    <option value="<?= $patient->id ?>"><?= $patient->lastname ?> <?= $patient->firstname ?></option>
                <?php endforeach; ?>
            </select>
                <button>Envoyer</button>
            </form>
            <p><?= (isset($confirmation)) ? $confirmation : '' ?></p>
            <p><?= (isset($error)) ? $error : '' ?></p>
        </div>
    </section>
</main>