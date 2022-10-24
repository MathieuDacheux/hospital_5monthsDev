<!-- Section Main -->
<main>
    <!-- Formulaire d'enregistrement d'un nouveau patient -->
    <div class="containerPrincipal">
        <form method="POST">
            <input type="datetime-local" name="datetime" id="datetime">
            <select name="id" id="id">
                <?php foreach($patientsList as $patient) : ?>
                    <option value="<?= $patient->id ?>"><?= $patient->lastname ?> <?= $patient->firstname ?></option>
                <?php endforeach; ?>
            </select>
            <button>SUBMIT</button>
        </form>
    </div>
</main>