<!-- Section Main -->
<main>
    <!-- Listage des patients -->
    <div class="containerPrincipal">
        <form action="/profil?id=<?= $patient->id ?>" method="POST" class="patientProfil">
            <div class="containerPatientName">
                <p><?= $patient->lastname ?></p>
                <p><?= $patient->firstname ?></p>
            </div>
            <div class="containerPatientPhone">
                <input type="tel" name="phone" id="phone" value="<?= $patient->phone ?>">
            </div>
            <div class="containerPatientMail">
                <input type="text" name="mail" id="mail" value="<?= $patient->mail ?>">
            </div>
            <div class="containerGender">
                <p><?= ($patient->gender == 1) ? 'Homme' : 'Femme' ; ?></p>
            </div>
            <div class="containerLink">
                <button>Modifier</button>
            </div>
        </form>
    </div>
</main>