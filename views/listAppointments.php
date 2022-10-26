<!-- Section Main -->
<main>
    <!-- Information du patient choisi -->
    <section class="containerCentral flexCenterCenterColumn">
        <div class="containerListingPatients flexCenterColumn">
            <?php if (isset($patientsList)) :?>
                <?php foreach ($patientsList as $information) :?>
                    <div class="patientCard flexCenterCenterColumn">
                        <div class="containerPatient flexCenterBetween">
                            <div class="containerName">
                                <p><?= $information->firstname ?> <?= $information->lastname ?> le <?= date_format(date_create($information->dateHour), 'd/m') ?> à <?= date_format(date_create($information->dateHour), 'H:i') ?>h</p>
                            </div>
                            <div class="containerLinkList">
                                <a href="/profil?id=<?= $information->id ?>">Voir le profil</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
            <div class="containerListingPages">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <?php if ($i == $page - 1) : ?>
                        <a href="/rendez-vous?page=<?= $i ?>" class="pageBefore"><?= $i ?></a>
                    <?php elseif ($i == $page) : ?>
                        <a href="/rendez-vous?page=<?= $i ?>" class="pageActive"><?= $i ?></a>
                    <?php elseif ($i == $page +1): ?>
                        <a href="/rendez-vous?page=<?= $i ?>" class="pageAfter"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor ?>
            </div>
        </div>
    </section>
</main>