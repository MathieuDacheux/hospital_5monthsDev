<!-- Section Main -->
<main>
    <!-- Listage des patients -->
    <div class="containerPrincipal">
        <div class="containerListingPatients">
            <?php foreach ($patientsList as $patient) : ?>
                <div class="containerPatient">
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
                        <a href="/profil?id=<?= $patient->id ?>">Voir le profil</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="containerListingPages">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <?php if ($i == $page - 1) : ?>
                    <a href="/patients?page=<?= $i ?>" class="pageBefore"><?= $i ?></a>
                <?php elseif ($i == $page) : ?>
                    <a href="/patients?page=<?= $i ?>" class="pageActive"><?= $i ?></a>
                <?php elseif ($i == $page +1): ?>
                    <a href="/patients?page=<?= $i ?>" class="pageAfter"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor ?>
        </div>
    </div>
</main>