<main>
    <div class="containerRecap">
        <div class="containerSubject income">
            <div class="containerTitle flexCenterCenter">
                    <h3>Chiffre d'affaires</h3>
            </div>
            <div class="containerIncome">
        
            </div>
        </div>
    </div>
    <div class="containerRecap flexCenterCenterBetween">
        <div class="containerSubject clients">
            <div class="containerTitle flexCenterCenter">
                <h3>Clients</h3>
            </div>
            <div class="containerContent flexCenterColumn">
                <?php for ($i = 0; $i <= 5; $i++) : ?>
                    <?php if (isset($patients[$i])) : ?>
                    <div class="listingRecap flexCenterBetween">
                        <div class="containerInformations">
                            <div class="containerPicture">
                                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
                            </div>
                            <div class="containerName">
                                <p><?= $patients[$i]->lastname ?> <?= $patients[$i]->firstname ?></p>
                            </div>
                        </div>
                        <div class="containerMore flexCenterCenter">
                            <div class="containerPlus flexCenterCenter">
                                <a href="/profil?id=<?= $patients[$i]->id ?>"><i class="fa-regular fa-eye"></i></a>
                            </div>
                        </div>      
                    </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <div class="containerSubject employees">
            <div class="containerTitle flexCenterCenter">
                <h3>Employées</h3>
            </div>
            <div class="containerContent flexCenterColumn">
                <?php for ($i = 0; $i <= 5; $i++) : ?>
                    <?php if (isset($appointments[$i])) : ?>
                    <div class="listingRecap flexCenterBetween">
                        <div class="containerInformations">
                            <div class="containerPicture">
                                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
                            </div>
                            <div class="containerName">
                                <p><?= $appointments[$i]->lastname ?> <?= $appointments[$i]->firstname ?> le <?= date_format(date_create($appointments[$i]->dateHour), 'd/m') ?> à <?= date_format(date_create($appointments[$i]->dateHour), 'H:i') ?>h</p>
                            </div>
                        </div>
                        <div class="containerMore flexCenterCenter">
                            <div class="containerPlus flexCenterCenter">
                                <a href="/profil?id=<?= $appointments[$i]->id ?>"><i class="fa-regular fa-eye"></i></a>
                            </div>
                        </div>      
                    </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</main>