<?php
$limit = 10;
$nb = isset($_GET['nb']) ? (int)$_GET['nb'] : 1;
$offset = ($nb - 1) * $limit;
$req = $conn->prepare("SELECT * FROM users LIMIT $limit OFFSET $offset");
$req->execute();
$users = $req->get_result();
$req->close();
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalPages = ceil($totalUsers / $limit);
$permis = ['admin' => 'Super-Administrateur', 'manager' => 'Administrateur', 'moderator' => 'Modérateur'];

?>
<main class="flex-grow-1 bg-light vh-100">
  <?PHP if (!empty($_SESSION['success'])): ?>
    <div id="popup" class="alert alert-success rounded">
      <div class="text-success">
        <p class="fs-5"><i class="fa-solid fa-square-check me-2"></i><?= htmlspecialchars($_SESSION['success']) ?></p>
      </div>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php elseif (!empty($_SESSION['failure'])): ?>
    <div id="popup" class="alert alert-danger rounded">
      <div class="text-danger">
        <p class="fs-5"><i class="fa-solid fa-circle-exclamation me-2"></i><?= htmlspecialchars($_SESSION['failure']) ?></p>
      </div>
    </div>
    <?php unset($_SESSION['failure']); ?>
  <?php endif; ?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs bg-dark" id="myTab" role="tablist">
    <li class="nav-item " role="presentation">
      <button
        class="nav-link active "
        id="users-tab"
        data-bs-toggle="tab"
        data-bs-target="#users"
        type="button"
        role="tab"
        aria-controls="users"
        aria-selected="true">
        Profiles
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button
        class="nav-link "
        id="profile-tab"
        data-bs-toggle="tab"
        data-bs-target="#profile"
        type="button"
        role="tab"
        aria-controls="profile"
        aria-selected="false">
        Ajouter un utilisateur
      </button>
    </li>
  </ul>

  <!-- Profiles -->
  <div class="tab-content">
    <div
      class="tab-pane active"
      id="users"
      role="tabpanel"
      aria-labelledby="users-tab">
      <div class="container pt-4 d-flex flex-column">
        <h1 class=" mb-4 fw-bold fs-2 border-bottom pb-2">
          Liste des utilisateurs
        </h1>
        <div class="card flex-grow-1 d-flex flex-column">
          <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Rôle</th>
                  <th class="d-none d-sm-table-cell" scope="col">Email</th>
                  <th class="d-none d-md-table-cell" scope="col">Téléphone</th>
                  <th class="d-none d-lg-table-cell" scope="col">Nom d'utilisateur</th>
                  <th class="d-none d-lg-table-cell" scope="col">Mot de passe</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $row):
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                  echo "<td>" . htmlspecialchars($permis[$row['role']]) . "</td>";
                  echo "<td class=\"d-none d-sm-table-cell\">" . htmlspecialchars($row['email']) . "</td>";
                  echo "<td class=\"d-none d-md-table-cell\">" . htmlspecialchars($row['telnum']) . "</td>";
                  echo "<td class=\"d-none d-md-table-cell\">" . htmlspecialchars($row['user_name']) . "</td>";
                  echo "<td class=\"d-none d-lg-table-cell\">" . htmlspecialchars($row['passwd']) . "</td>";
                  echo "<td class=\"text-center \">                
                  <i class=\"fa-regular fa-pen-to-square me-2 edit-user pointer\" data-bs-toggle=\"modal\"
                  data-id=\"" . htmlspecialchars($row['id']) . "\"></i>
                  <form id=\"suppression\" action=\"users/supprimer_utilisateur.php\" method=\"POST\" class=\"d-inline\">
                  <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                  <button type=\"submit\" class=\"btn btn-link text-danger p-0\">
                    <i class=\"fa-solid fa-trash\"></i>
                  </button>
                </form>
              </td>
            </tr>";
                endforeach; ?>
              </tbody>
            </table>
            <!-- informations-->
            <div
              class="modal fade"
              id="modalUser"
              tabindex="-1"
              data-bs-backdrop="false"
              data-bs-keyboard="true"
              role="dialog"
              aria-labelledby="modalTitleId"
              aria-hidden="true">
              <!-- ici l'affichage des informations -->
            </div>
            <!-- modal de confirmation -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    Êtes-vous sûr de vouloir continuer ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="confirmBtn">Confirmer</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- navigation -->
            <div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <?php
                  for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=users&nb=" . $i . "\">" . $i . "</a></li>";
                  }
                  ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="tab-pane"
      id="profile"
      role="tabpanel"
      aria-labelledby="profile-tab">
      <div class="container py-4">
        <h1 class="mb-4 fw-bold fs-2 border-bottom pb-2">
          Ajouter un utilisateur
        </h1>

        <div class="card">
          <div class="card-body">
            <form action="users/ajouter_utilisateur.php" method="POST">

              <div class="row g-3">
                <div class="col-md-6">
                  <label for="nom" class="form-label">Nom Complet :</label>
                  <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom complet" required>
                </div>

                <div class="col-md-6">
                  <label for="email" class="form-label">E-mail :</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Entrez l'adresse e-mail" required>
                </div>

                <div class="col-md-6">
                  <label for="tel" class="form-label">Téléphone :</label>
                  <input type="text" class="form-control" name="tel" id="tel" placeholder="Entrez le numéro" required>
                </div>

                <div class="col-md-6">
                  <label for="username" class="form-label">Nom d'utilisateur :</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Choisissez un nom d'utilisateur" required>
                </div>

                <div class="col-md-6">
                  <label for="password" class="form-label">Mot de passe :</label>
                  <input type="text" class="form-control" name="password" id="password" placeholder="Entrez le mot de passe" required>
                </div>
                <div class="col-md-6">
                  <label for="role" class="form-label">Rôle</label>
                  <select
                    class="form-select"
                    name="role"
                    id="role">
                    <option value="moderator" selected>Modérateur</option>
                    <option value="manager">Administrateur</option>
                    <option value="admin">Super-Administrateur</option>
                  </select>
                </div>

              </div>
              <div class="mt-3 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="liste_utilisateurs.php" class="btn btn-secondary">Annuler</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div
      class="tab-pane"
      id="messages"
      role="tabpanel"
      aria-labelledby="messages-tab">
      <div class="container py-4">
        <h1 class="mb-4 fw-bold fs-2 border-bottom pb-2">
          Ajouter un utilisateur
        </h1>

        <div class="card">
          <div class="card-body">
            <form action="ajouter_utilisateur.php" method="POST">

              <div class="row g-3">
                <div class="col-md-6">
                  <label for="nom" class="form-label">Nom Complet :</label>
                  <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom complet" required>
                </div>

                <div class="col-md-6">
                  <label for="email" class="form-label">E-mail :</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Entrez l'adresse e-mail" required>
                </div>

                <div class="col-md-6">
                  <label for="telephone" class="form-label">Téléphone :</label>
                  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Entrez le numéro" required>
                </div>

                <div class="col-md-6">
                  <label for="username" class="form-label">Nom d'utilisateur :</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Choisissez un nom d'utilisateur" required>
                </div>

                <div class="col-md-6">
                  <label for="password" class="form-label">Mot de passe :</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Entrez le mot de passe" required>
                </div>
              </div>
              <div class="mt-3 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="users.php" class="btn btn-secondary">Annuler</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>