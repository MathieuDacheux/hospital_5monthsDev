<main>

    <!-- Modal ajout client -->
    <div class="formContent hidden">
        <div class="formContentTitle flexCenterCenter">
            <div class="containerAdd flexCenterCenter">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h3>Nouveau rendez-vous</h3>
        </div>
        <form method="POST">
            <div class="formInput flexCenterCenterColumn">
                <div class="formName flexCenterColumn">
                    <div class="flexCenterColumn">
                        <input type="datetime-local" name="appointement" value="<?= $firstname ?? '' ?>" pattern="<?= '/'.REGEX_NAME.'/' ?>" required>
                    </div>
                    <select name="id" id="id">
                        <?php foreach($patientsAll as $patient) : ?>
                            <option value="<?= $patient->id ?>"><?= $patient->lastname ?> <?= $patient->firstname ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        
            <!-- Button to submit form -->
        
            <div class="registerButton flexCenterCenter">
                <button type="submit">Ajouter</button>
            </div>
        </form>
    </div>


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
                            <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
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
    </div>
</main>
