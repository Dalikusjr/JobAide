<?php

require __DIR__ . "/../../config/config.php";
if (!isLoggedIn()) {
  redirect("../../admin.php");
}
$new = [];
$req = $conn->prepare("
    SELECT 
        (SELECT COUNT(*) FROM contacts WHERE lu = 0) as contact_nbr,
        (SELECT COUNT(*) FROM inscription_ja WHERE vu = 0) as inscrip_nbr,
        (SELECT COUNT(*) FROM client WHERE new = 0) as client_nbr
");
$req->execute();
$result = $req->get_result();
$new = $result->fetch_assoc();
$req->close();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DashBoard</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous">
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body class="overflow-hidden">
  <nav
    class="navbar navbar-expand navbar-light shadow"
    style="background-color: #e95501">
    <div class="container-fluid">
      <button
        class="btn btn-dark me-2 d-md-none"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu">
        <i class="fa-solid fa-bars"></i>
      </button>

      <h2 class="navbar-brand mb-0 d-flex align-items-center gap-2">
        <i class="fa-solid fa-briefcase"></i>
        <span class="text-white fw-bold fs-3" style="letter-spacing: 2px;">JobAide</span>
      </h2>
      <form action="#" class="d-flex ms-auto" role="search">
        <input
          type="text"
          class="form-control"
          placeholder="Chercher">
        <button type="submit" class="btn btn-dark">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
    </div>
  </nav>
  <div class="d-flex flex-column flex-md-row">
    <aside>
      <div
        style="width: 300px ;"
        class="offcanvas offcanvas-start offcanvas-sm"
        tabindex="-1"
        id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header d-md-none">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">
            Tableau de bord
          </h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="list-unstyled">
            <li>
              <a href="?page=accueil" class="nav-link  border rounded mb-2">Accueil</a>
            </li>
            <?php if ($_SESSION['role'] === 'admin'): ?>
              <li>
                <a href="?page=clients" class="nav-link  border rounded mb-2">Clients
                  <?php if ($new['client_nbr'] > 0): ?>
                    <span class="badge bg-info text-dark ms-2">+ <?= $new['client_nbr'] ?></span>
                  <?php endif; ?>
                </a>
              </li>
              <li>
                <a href="?page=inscriptions" class="nav-link  border rounded mb-2">Inscriptions
                  <?php if ($new['inscrip_nbr'] > 0): ?>
                    <span class="badge bg-warning text-dark ms-2">+ <?= $new['inscrip_nbr'] ?></span>
                  <?php endif; ?>
                </a>
              </li>
            <?php endif; ?>
            <li>
              <a href="?page=contacts" class="nav-link  border rounded mb-2">Contacts
                <?php if ($new['contact_nbr']  > 0): ?>
                  <span class="badge bg-success ms-2">+ <?= $new['contact_nbr']  ?></span>
                <?php endif; ?>
              </a>
            </li>
            <?php if ($_SESSION['role'] === 'admin'): ?>
              <li>
                <a href="?page=users" class="nav-link  border rounded mb-2">Utilisateus</a>
              </li>
              <li>
                <a href="?page=settings" class="nav-link  border rounded mb-2">Configuration</a>
              </li>
            <?php endif; ?>
            <li>
              <a href="../log/logout.php" class="nav-link bg-danger text-white border rounded ">Déconnexion</a>
            </li>
          </ul>
        </div>
      </div>
    </aside>
    <?php
    // page par défaut
    $page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

    // sécuriser les fichiers inclus
    $allowedPages = ['accueil', 'clients', 'inscriptions', 'contacts', 'settings', 'users'];

    if (in_array($page, $allowedPages)) {
      include "$page/$page.php";
    } else {
      include "introuvable.php";
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../../assets/js/main.js"></script>
</body>

</html>