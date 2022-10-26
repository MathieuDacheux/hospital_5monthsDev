<!-- Section Main -->
<main>
    <!-- Formulaire d'enregistrement d'un nouveau patient -->
    <section class="containerCentral">
        <div class="containerForm newPatient">
            <div class="containerTitle">
                <h3>Information du patient</h3>
            </div>
            <?php if (isset($patient)) :?>
                <?php foreach ($patient as $information) :?>
                    <form method="POST" action="/profil?id=<?= $information->id ?>">
                        <div class="containerInputName">
                            <input type="text" name="lastName" id="lastName" placeholder="Nom" value="<?= $information->lastname ?>">
                            <input type="text" name="firstName" id="firstName" placeholder="Prénom" value="<?= $information->firstname ?>">
                        </div>
                        <input type="date" name="birthDate" id="birthDate" placeholder="Date" value="<?= $information->birthdate ?>">
                        <div class="containerInputContent">
                            <input type="tel" name="phone" id="phone" placeholder="Numéro" value="<?= $information->phone ?>">
                            <input type="text" name="mail" id="mail" placeholder="Mail" value="<?= $information->mail ?>">
                        </div>
                        <select name="gender" id="gender">
                            <option value="1">Homme</option>
                            <option value="2">Femme</option>
                        </select>
                        <button>Modifier</button>
                    </form>
                <?php endforeach ?>
            <?php endif ?>
            <p><?= (isset($confirmation)) ? $confirmation : '' ?></p>
            <p><?= (isset($error)) ? $error : '' ?></p>
        </div>
    </section>
</main>