<!-- Section Main -->
<main>
    <!-- Listage des patients -->
    <div class="containerPrincipal">
        <div class="patientProfil">
            <?php if (isset($patient)) :?>
                <?php foreach ($patient as $information) :?>
                    <div class="containerPatientName">
                        <p><?= $information->lastname ?></p>
                        <p><?= $information->firstname ?></p>
                    </div>
                    <div class="containerPatientPhone">
                        <p><?= $information->phone ?></p>
                    </div>
                    <div class="containerPatientMail">
                        <p><?= $information->mail ?></p>
                    </div>
                    <div class="containerLink">
                        <a href="profil?id=<?= $information->id ?>&amp;modify=true">Modifier le profil</a>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</main>