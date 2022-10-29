<main>

    <!-- Modal ajout client -->
    <div class="formContent hidden formAddPatient">
        <div class="formContentTitle flexCenterCenter">
            <div class="containerAdd flexCenterCenter">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h3>Ajout d'un patient</h3>
        </div>
        <form method="POST">
            <div class="formInput flexCenterCenterColumn">
                <div class="formName flexCenterBetween">
                    <div class="flexCenterCenterColumn">
                        <input type="text" placeholder="Prénom*" name="firstName" value="<?= $_POST['firstName'] ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('firstName', $errorsRegistration)) ? $errorsRegistration['firstName'] : '' ?></p>
                    </div>
                    <div class="flexCenterColumn">
                        <input type="text" placeholder="Nom*" name="lastName" value="<?= $_POST['lastName'] ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('lastName', $errorsRegistration)) ? $errorsRegistration['lastName'] : '' ?></p>
                    </div>
                </div>
                <input type="date" name="birthDate" value="<?= $_POST['birthDate'] ?? '' ?>" pattern="<?= REGEX_BIRTHDATE ?>">
                <p class="errorMessage"><?= (array_key_exists('birthDate', $errorsRegistration)) ? $errorsRegistration['birthDate'] : '' ?></p>
                <input type="tel" placeholder="Téléphone*" name="phone" value="<?= $_POST['phone'] ?? '' ?>" pattern="<?= REGEX_PHONE ?>" required>
                <p class="errorMessage"><?= (array_key_exists('phone', $errorsRegistration)) ? $errorsRegistration['phone'] : '' ?></p>
                <input type="text" placeholder="exemple@email.com" name="mail" value="<?= $_POST['mail'] ?? '' ?>" pattern="<?= REGEX_MAIL ?>" required>
                <p class="errorMessage"><?= (array_key_exists('mail', $errorsRegistration)) ? $errorsRegistration['mail'] : '' ?></p>
                <select name="gender" id="gender">
                    <?php if (isset($_POST['gender'])) : ?>
                        <?php if ($_POST['gender'] == 1) : ?>
                            <option value="1" selected>Homme</option>
                            <option value="2">Femme</option>
                        <?php else : ?>
                            <option value="1">Homme</option>
                            <option value="2" selected>Femme</option>
                        <?php endif; ?>
                    <?php else : ?>
                        <option value="1">Homme</option>
                        <option value="2">Femme</option>
                    <?php endif; ?>
                </select>
                <p class="errorMessage"><?= (array_key_exists('gender', $errorsRegistration)) ? $errorsRegistration['gender'] : '' ?></p>
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
            <p class="resultFormText">Le patient a bien été ajouté</p>
        </div>
        <?php elseif ($confirmation == false) : ?>
        <div class="showResult visible">
            <p class="resultFormText">Les données fournies ne sont pas conformes</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($isExist)) : ?>
        <?= ($isExist == true) ? '<div class="showResult visible"><p class="resultFormText">Le patient existe déjà</p></div>' : '' ;?>
    <?php endif; ?>

    <!-- Listage des clients  -->
    <div class="containerSubject">
        <div class="containerTitle flexCenterCenter">
            <div class="containerSearch hidden">
                <form action="patients?search=<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <input class="searchBar" type="text" name="search" value="<?= (isset($name)) ? $name : '' ?>" pattern="<?= REGEX_NAME ?>" placeholder="Rechercher un patient">
                </form>
            </div>
            <div class="containerAdd flexCenterCenter">
                <i class="fa-solid fa-plus"></i>
            </div>
            <h3>Patients</h3>
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
                            <p><?= $information->lastname ?> <?= $information->firstname ?></p>
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
                                <a href="/patients?page=<?= $i ?>" class="pageBefore"><?= $i ?></a>
                            <?php elseif ($i == $page) : ?>
                                <a href="/patients?page=<?= $i ?>" class="pageActive"><?= $i ?></a>
                            <?php elseif ($i == $page +1): ?>
                                <a href="/patients?page=<?= $i ?>" class="pageBefore"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <div class="renderResult hidden">

    </div>
</main>
