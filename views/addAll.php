    <main>
        <div class="formContent hidden formAddPatient">
            <div class="formContentTitle flexCenterCenter">
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
                    <input type="datetime-local" name="dateHour" value="<?= $_POST['dateHour'] ?? '' ?>" pattern="<?= REGEX_DATETIMELOCAL ?>" required>
                    <p class="errorMessage"><?= (array_key_exists('dateHour', $errorsRegistration)) ? $errorsRegistration['dateHour'] : '' ?></p>
                </div>
            
                <!-- Button to submit form -->
            
                <div class="registerButton flexCenterCenter">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </main>