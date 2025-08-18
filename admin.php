<?php
require "config/config.php";
if (isLoggedIn()) {
  redirect("back_office/dashbord");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobAide | Dashboard</title>

  <!-- Bootstrap -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous" />

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/f0233da9aa.js" crossorigin="anonymous"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/styles.css">
  </style>
</head>

<body class="bg-light vh-100 d-flex">
  <div class="card w-100 w-md-75 m-auto shadow-lg" style="max-width: 500px">

    <?php if (!empty($_SESSION['erreur'])): ?>
      <div class="alert alert-danger">
        <i class="fa-solid fa-xmark me-3"></i>
        <?= htmlspecialchars($_SESSION['erreur']) ?>
      </div>
      <?php unset($_SESSION['erreur']); ?>
    <?php endif; ?>

    <img class="card-img-top" src="assets/images/logo.png" alt="Logo JobAide" />

    <div class="card-body">
      <h2 class="card-title text-center">Login</h2>
      <p class="card-text text-center">Merci d'entrer vos informations de connexion</p>

      <form action="back_office/log/login.php" method="post">
        <div class="mb-3 text-start">
          <label for="l_user" class="form-label">Nom d'utilisateur :</label>
          <input
            type="text"
            class="form-control"
            name="l_user"
            id="l_user"
            placeholder="Login" />
        </div>

        <label for="l_pass" class="form-label">Mot de passe :</label>
        <div class="mb-3 input-group">
          <input
            type="password"
            name="l_pass"
            id="l_pass"
            class="form-control"
            placeholder="*******" />
          <button
            type="button"
            id="eye"
            class="input-group-text eye-not-active"
            aria-label="Afficher ou masquer le mot de passe">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>

        <button type="submit" class="btn btn-primary d-flex mx-auto">Se connecter</button>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="assets/js/login.js"></script>
</body>

</html>