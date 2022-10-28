<main>
    <div class="containerRecap">
        <div class="containerProfil">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Information du patient</h3>
            </div>
            <div class="containerContent">
                <?php if (isset($patient)) :?>
                    <?php foreach ($patient as $information) :?>
                    <div class="containerName">
                        <p>
                            Nom : <?= $information->lastname ?>
                        </p>
                        <p>
                            Prénom : <?= $information->firstname ?>
                        </p>
                    </div>
                    <p>
                        E-mail : <?= $information->mail ?>
                    </p>
                    <p>
                        Téléphone : <?= $information->phone ?>
                    </p>
                    <?php endforeach ?>
                <?php endif ?>
                <?php if (isset($appointments)) :?>
                    <?php foreach ($appointments as $appointment) :?>
                        <p><?= date_format(date_create($appointment->dateHour), 'd/m') ?> à <?= date_format(date_create($appointment->dateHour), 'H:i') ?>h</p>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <div class="containerButton flexCenterCenter">
                <a href="profil?id=<?= $information->id ?>&amp;modify=true"">Modifier le patient</a>
            </div>
        </div>
        <div class="containerForm">
            <div class="containerTitle flexCenterCenter">
                <h3 class="titleColor">Document du patient</h3>
            </div>
            <div class="formContent">
                <div class="containerBills">

                </div>
                <form method="POST" enctype="multipart/form-data" class="flexCenterCenter">
                    <label for="bills">Déposez un nouveau document</label>
                    <input type="file" name="bills" id="bills">
                    <button>Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</main>