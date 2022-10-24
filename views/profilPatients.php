<!-- Section Main -->
<main>
    <!-- Listage des patients -->
    <div class="containerPrincipal">
        <div class="patientProfil">
            <div class="containerPatientName">
                <p><?= $patient->lastname ?></p>
                <p><?= $patient->firstname ?></p>
            </div>
            <div class="containerPatientPhone">
                <p><?= $patient->phone ?></p>
            </div>
            <div class="containerPatientMail">
                <p><?= $patient->mail ?></p>
            </div>
            <div class="containerLink">
                <a href="profil?id=<?= $patient->id ?>&amp;modify=true">Modifier le profil</a>
            </div>
        </div>
    </div>
</main>