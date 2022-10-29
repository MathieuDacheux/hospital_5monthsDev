<main>

    <!-- Modal ajout client -->
    <div class="formContent hidden">
        <div class="formContentTitle flexCenterCenter">
            <div class="containerAdd flexCenterCenter">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h3>Nouveau rendez-vous</h3>
        </div>
        <form method="POST" novalidate>
            <div class="formInput flexCenterCenterColumn">
                <div class="flexCenterColumn">
                    <input type="datetime-local" name="dateHour" value="<?= $_POST['dateHour'] ?? '' ?>" pattern="<?= REGEX_DATETIMELOCAL ?>" required>
                    <p class="errorMessage"><?= (array_key_exists('dateHour', $errorsRegistration)) ? $errorsRegistration['dateHour'] : '' ?></p>
                </div>
                <div class="flexCenterCenterColumn">
                    <select name="id" id="id">
                        <?php foreach($patientsAll as $patient) : ?>
                            <option value="<?= $patient->id ?>"><?= $patient->lastname ?> <?= $patient->firstname ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="errorMessage"><?= (array_key_exists('id', $errorsRegistration)) ? $errorsRegistration['dateHour'] : '' ?></p>
                </div>
            </div>
        
            <!-- Button to submit form -->
        
            <div class="registerButton flexCenterCenter">
                <button type="submit">Ajouter</button>
            </div>
        </form>
    </div>

    <?php if (isset($confirmation)) : ?>
        <?php if($confirmation == true) :?>
        <div class="showResult visible">
            <p class="resultFormText">Le données ont bien été ajoutées</p>
        </div>
        <?php elseif ($confirmation == false) : ?>
        <div class="showResult visible">
            <p class="resultFormText">Les données fournies ne sont pas conformes</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($isExist)) : ?>
        <?= ($isExist == true) ? '<div class="showResult visible"><p class="resultFormText">Les données sont déjà présents dans la base</p></div>' : '' ;?>
    <?php endif; ?>

    <!-- Listage des clients  -->
    <div class="containerSubject">
        <div class="containerTitle flexCenterCenter">
            <div class="containerAdd flexCenterCenter">
                <i class="fa-solid fa-plus"></i>
            </div>
            <h3>Rendez-vous</h3>
        </div>
        <div class="containerContent flexCenterColumn">
            <?php if (isset($patientsList)) :?>
                <?php foreach ($patientsList as $information) :?>
                <div class="listingRecap flexCenterBetween">
                    <div class="containerInformations">
                        <div class="containerPicture">
                            <img src="https://www.freeiconspng.com/uploads/patient-icon-png-19.png" alt="">
                        </div>
                        <div class="containerName">
                            <p><?= $information->firstname ?> <?= $information->lastname ?> le <?= date_format(date_create($information->dateHour), 'd/m') ?> à <?= date_format(date_create($information->dateHour), 'H:i') ?>h</p>
                        </div>
                    </div>
                    <div class="containerMore flexCenterCenter">
                        <div class="containerPlus flexCenterCenter">
                            <a href="/profil?id=<?= $information->id ?>"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>      
                </div>
                <?php endforeach ?>
            <?php endif ?>
            <div class="containerListingPages">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <?php if ($totalPages == 1 || $totalPages == 0) : ?>
                        <p></p>
                    <?php else : ?>
                        <?php if ($totalPages >= 2) : ?>
                            <?php if ($i == $page - 1) : ?>
                                <a href="/rendez-vous?page=<?= $i ?>" class="pageBefore"><?= $i ?></a>
                            <?php elseif ($i == $page) : ?>
                                <a href="/rendez-vous?page=<?= $i ?>" class="pageActive"><?= $i ?></a>
                            <?php elseif ($i == $page +1): ?>
                                <a href="/rendez-vous?page=<?= $i ?>" class="pageBefore"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</main>
