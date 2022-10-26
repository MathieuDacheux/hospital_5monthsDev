<!-- Section Main -->
<main>
    <!-- Information du patient choisi -->
    <section class="containerCentral flexCenterCenter">
        <div class="patientProfil flexCenterCenterColumn">
            <?php if (isset($patient)) :?>
                <?php foreach ($patient as $information) :?>
                    <div class="containerPatientName">
                        <p>Nom : <?= $information->lastname ?></p>
                        <p>Prénom : <?= $information->firstname ?></p>
                    </div>
                    <div class="containerPatientPhone">
                        <p>Téléphone : <?= $information->phone ?></p>
                    </div>
                    <div class="containerPatientMail">
                        <p>E-mail : <?= $information->mail ?></p>
                    </div>
                    <div class="containerApointment">
                        <?php if (isset($appointments)) :?>
                            <?php foreach ($appointments as $appointment) :?>
                                <div class="containerApointmentDate">
                                    <p><?= date_format(date_create($appointment->dateHour), 'd/m') ?> à <?= date_format(date_create($appointment->dateHour), 'H:i') ?>h</p>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    <div class="containerLink">
                        <a href="profil?id=<?= $information->id ?>&amp;modify=true">Modifier le profil</a>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </section>
</main>