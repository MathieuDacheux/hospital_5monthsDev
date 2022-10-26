<main class="flexCenterBetween">
    <section class="containerCentral">
        <div class="containerRecapIncome">
            <div class="containerTitle flexCenterCenter">
                <h3>Chiffre d'affaires</h3>
            </div>
            <div class="containerRecap">
            </div>
        </div>
        <div class="containerRecapBottom flexCenterBetween">
            <div class="containerRecapClients">
                <div class="containerTitle flexCenterCenter">
                    <h3>Nouveaux patients</h3>
                </div>
                <div class="containerClients flexCenterColumn">
                    <?php for ($i = 0; $i <= 5; $i++) : ?>
                        <?php if (isset($patients[$i])) : ?>
                            <div class="employeeRecap flexCenterBetween">
                                <div class="containerPicture flexCenterCenter">
                                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="Photo du patient">
                                </div>
                                <div class="containerName">
                                    <p><?= $patients[$i]->lastname ?> <?= $patients[$i]->firstname ?></p>
                                </div>
                                <div class="containerInformations flexCenterCenter">
                                    <div class="containerPlus flexCenterCenter">
                                        <a href="/profil?id=<?= $patients[$i]->id ?>"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>      
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="containerRecapEmployees">
                <div class="containerTitle flexCenterCenter">
                    <h3>Nouveau rendez-vous</h3>
                </div>
                <div class="containerEmployees flexCenterColumn">
                    <?php for ($i = 0; $i <= 5; $i++) : ?>
                        <?php if (isset($appointments[$i])) : ?>
                            <div class="employeeRecap flexCenterBetween">
                                <div class="containerPicture flexCenterCenter">
                                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="Photo du patient">
                                </div>
                                <div class="containerName">
                                    <p><?= $appointments[$i]->dateHour ?> <?= $appointment[$i]->idPatients ?></p>
                                </div>
                                <div class="containerInformations flexCenterCenter">
                                    <div class="containerPlus flexCenterCenter">
                                        <a href="/rendez_vous?id=<?= $appointment[$i]->id ?>"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>      
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>