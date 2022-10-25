<!-- Section Main -->
<main>
    <!-- Modification du patient choisi -->
    <section class="containerCentral flexCenterCenter">
        <div class="patientProfil flexCenterCenterColumn">
            <?php if (isset($patient)) :?>
                <?php foreach ($patient as $information) :?>
                    <form action="/profil?id=<?= $information->id ?>" method="POST" class="flexCenterCenterColumn">
                        <div class="containerPatientName">
                            <p>Nom : <?= $information->lastname ?></p>
                            <p>Prénom : <?= $information->firstname ?></p>
                        </div>
                        <div class="containerPatientPhone">
                            <input type="tel" name="phone" id="phone" value="<?= $information->phone ?>">
                        </div>
                        <div class="containerPatientMail">
                            <input type="text" name="mail" id="mail" value="<?=$information->mail ?>">
                        </div>
                        <div class="containerLinkButton">
                            <button>Modifier</button>
                        </div>
                    </form>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </section>
</main>