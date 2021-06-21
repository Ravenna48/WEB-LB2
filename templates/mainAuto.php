

<?php

echo ('<section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Добро пожаловать</h1>
                <p class="lead text-muted">Система позволяет производить регистрацию участников на конференцию.</p>
                <p>
                    Добро пошаловать '.$_SESSION['email'].'</p>
                <p>
                    <a href="#" class="btn btn-primary my-2" onclick="location.href = \'templates/createApplication.php\';">Создать заявку</a>
                </p>
            </div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">');

        $viewController = new viewApplicationController();
        $viewController->viewAllApplications();

        echo ('</div>
            </div>
        </div>
    </section>
</main>');


?>
