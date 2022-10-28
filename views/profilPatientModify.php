<main>
    <div class="formContent">
        <div class="formContentTitle flexCenterCenter">
            <h3>Modification du patient</h3>
        </div>
        <?php if (isset($patient)) :?>
            <?php foreach ($patient as $information) :?>
            <form method="POST" action="/profil?id=<?= $information->id ?>">
                <div class="formInput flexCenterCenterColumn">
                    <div class="formName flexCenterBetween">
                        <div class="flexCenterCenterColumn">
                            <input type="text" placeholder="Nom*" name="lastName" value="<?= $information->lastname ?>" pattern="<?= REGEX_NAME ?>" required>
                        </div>
                        <div class="flexCenterColumn">
                            <input type="text" placeholder="Prénom*" name="firstName" value="<?= $information->firstname ?>" pattern="<?= REGEX_NAME ?>" required>
                        </div>
                    </div>
                    <input type="date" name="birthDate" value="<?= $information->birthdate ?>" pattern="<?= REGEX_BIRTHDATE ?>">
                    <input type="tel" placeholder="Téléphone*" name="phone" value="<?= $information->phone ?>" pattern="<?= REGEX_PHONE ?>" required>
                    <input type="text" placeholder="exemple@email.com" name="mail" value="<?= $information->mail ?>" pattern="<?= REGEX_MAIL ?>" required>
                    <select name="gender" id="gender">
                        <option value="1">Homme</option>
                        <option value="2">Femme</option>
                    </select>
                </div>
            
                <!-- Button to submit form -->
            
                <div class="registerButton flexCenterCenter">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
            <?php endforeach ?>
        <?php endif ?>
        <p><?= (isset($confirmation)) ? $confirmation : '' ?></p>
        <p><?= (isset($error)) ? $error : '' ?></p>
    </div>
</main>