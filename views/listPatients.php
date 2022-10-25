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
                                <p><?= $information->lastname ?> <?= $information->firstname ?></p>
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
                        <a href="/patients?page=<?= $i ?>" class="pageBefore"><?= $i ?></a>
                    <?php elseif ($i == $page) : ?>
                        <a href="/patients?page=<?= $i ?>" class="pageActive"><?= $i ?></a>
                    <?php elseif ($i == $page +1): ?>
                        <a href="/patients?page=<?= $i ?>" class="pageAfter"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor ?>
            </div>
        </div>
    </section>
</main>