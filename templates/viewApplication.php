<?php

require_once '../dao/Dao.php';

session_start();
$DB = new Dao();

try{
    $applications=$DB->searchApplication($_GET['applicationId']);
    $application = null;
    foreach ($applications as $app){
        $application = $app;
    }
}
catch (Exception $ex){
    echo $ex->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Signin Template · Bootstrap v5.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body style="padding-left: 35%">

<main style="text-align: center;">
    <form method="get" action="../index.php">

        <h1 class="h3 mb-3 fw-normal">Информация по докладу:</h1>
        <div class="form-floating">
            <p>Название доклада: <?php echo $application['name']?></p>
            <p>О докладчике: <?php echo $application['user_description']?></p>
            <p>Тематика: <?php echo $application['subject']?></p>
            <p>Краткое описание: <?php echo $application['description']?></p>
            <p><a href="../performance/<?php echo $_SESSION['email']?>/<?php echo $application['performance']?>">Доклад</a></p>
            <p><a href="../presentation/<?php echo $_SESSION['email']?>/<?php echo $application['presentation']?>">Презентация</a></p>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Вернутся</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
</main>



</body>
</html>

