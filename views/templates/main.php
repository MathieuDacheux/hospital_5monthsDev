<main>
    <div class="containerRecap">
        <div class="containerSubject flexCenterCenterColumn income">
            <div class="containerGraph">
                <canvas width="300" height="300" class="chartPatients"></canvas>
            </div>
        </div>
    </div>
    <div class="containerRecap flexCenterCenterBetween">
        <div class="containerSubject clients">
            <div class="containerTitle flexCenterCenter">
                <h3>Patients</h3>
            </div>
            <div class="containerContent flexCenterColumn">
                <?php for ($i = 0; $i <= 5; $i++) : ?>
                    <?php if (isset($patients[$i])) : ?>
                    <div class="listingRecap flexCenterBetween">
                        <div class="containerInformations">
                            <div class="containerPicture">
                                <img src="https://www.freeiconspng.com/uploads/patient-icon-png-19.png" alt="Icône représentant une personne avec un bandage sur le bras gauche">
                            </div>
                            <div class="containerName">
                                <p><?= $patients[$i]->lastname ?> <?= $patients[$i]->firstname ?></p>
                            </div>
                        </div>
                        <div class="containerMore flexCenterCenter">
                            <div class="containerPlus flexCenterCenter">
                                <a href="/profil?id=<?= $patients[$i]->id ?>"><i class="fa-regular fa-eye"></i></a>
                            </div>
                        </div>      
                    </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <div class="containerSubject employees">
            <div class="containerTitle flexCenterCenter">
                <h3>Rendez-vous</h3>
            </div>
            <div class="containerContent flexCenterColumn">
                <?php for ($i = 0; $i <= 5; $i++) : ?>
                    <?php if (isset($appointments[$i])) : ?>
                    <div class="listingRecap flexCenterBetween">
                        <div class="containerInformations">
                            <div class="containerPicture">
                                <img src="https://www.freeiconspng.com/uploads/patient-icon-png-19.png" alt="Icône représentant une personne avec un bandage sur le bras gauche">
                            </div>
                            <div class="containerName">
                                <p><?= $appointments[$i]->lastname ?> <?= $appointments[$i]->firstname ?> le <?= date_format(date_create($appointments[$i]->dateHour), 'd/m') ?> à <?= date_format(date_create($appointments[$i]->dateHour), 'H:i') ?>h</p>
                            </div>
                        </div>
                        <div class="containerMore flexCenterCenter">
                            <div class="containerPlus flexCenterCenter">
                                <a href="/profil?id=<?= $appointments[$i]->id ?>"><i class="fa-regular fa-eye"></i></a>
                            </div>
                        </div>      
                    </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php if (isset($patientsFromLastSevenDays)) : ?>
        <div class="hidden">
            <?= $patientsChart ?>
        </div>
    <?php endif; ?>
</main>