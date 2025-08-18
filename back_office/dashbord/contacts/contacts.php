<?php
$req = $conn->prepare("UPDATE contacts SET lu = TRUE WHERE lu = FALSE;");
$req->execute();
$req->close();
$limit = 10;
$nb = isset($_GET['nb']) ? $_GET['nb'] : 1;
$offset = ($nb - 1) * $limit;
$req = $conn->prepare("SELECT * FROM contacts ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
$req->execute();
$contacts = $req->get_result();
$totalContacts = $conn->query("SELECT COUNT(*) AS total FROM contacts")->fetch_assoc()['total'];
$totalPages = ceil($totalContacts / $limit);
?>
<main class="flex-grow-1 bg-light vh-100" style="overflow-y: auto;">
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
  <div class="container pt-4 d-flex flex-column">
    <h1 class=" mb-4 fw-bold fs-2 border-bottom pb-2">
      Les Contacts
    </h1>
    <div class="card flex-grow-1 d-flex flex-column">
      <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th class="d-none d-md-table-cell" scope="col">Email</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($contacts as $row):
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['id']) . "</td>";
              echo "<td>" . htmlspecialchars($row['name']) . "</td>";
              echo "<td class=\"d-none d-md-table-cell\">" . htmlspecialchars($row['email']) . "</td>";
              echo "<td class=\"text-center \">
                <i class=\"fa-solid fa-message me-2 id-view pointer\" data-bs-toggle=\"modal\"data-bs-target=\"#modalContact\"
                data-msg=\"" . htmlspecialchars($row['message'], ENT_QUOTES) . "\"
                  data-email=\"" . htmlspecialchars($row['email'], ENT_QUOTES) . "\"
                   data-name=\"" . htmlspecialchars($row['name'], ENT_QUOTES) . "\" ></i>
                <i class=\"fa-solid fa-paper-plane pointer text-primary me-2 id-send\" data-bs-target=\"#sendModal\"
                  data-bs-toggle=\"modal\" data-email=\"" . htmlspecialchars($row['email'], ENT_QUOTES) . "\"></i>
                <form id=\"suppression\" action=\"contacts/supprimer_contact.php\" method = \"POST\" class=\"d-inline\">
                  <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                  <button type=\"submit\" class=\"btn btn-link text-danger p-0\" >
                    <i class=\"fa-solid fa-trash id-delete\"></i>
                  </button>
                </form>
              </td>
            </tr>";
            endforeach; ?>
          </tbody>
        </table>
        <!-- lire message -->
        <div
          class="modal fade "
          id="modalContact"
          tabindex="-1"
          data-bs-backdrop="false"
          data-bs-keyboard="true"
          role="dialog"
          aria-labelledby="modalTitleId"
          aria-hidden="false">
          <div
            class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-md"
            role="document">
            <div class="modal-content bg-light">
              <div class="modal-body d-flex flex-column gap-2">
                <div>Nom : <span id="modalname"></span></div>
                <div>E-mail : <span id="modalemail"></span></div>
                <h6>Message</h6>
                <textarea
                  class="form-control"
                  id="modalmsg"></textarea>
              </div>
              <div class="modal-footer">
                <button
                  class="btn btn-primary"
                  data-bs-target="#sendModal"
                  data-bs-toggle="modal">
                  Répondre
                </button>
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal">
                  Fermer
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- envoyer message -->
        <div
          class="modal fade"
          id="sendModal"
          data-bs-backdrop="false"
          data-bs-keyboard="true"
          aria-hidden="false"
          aria-labelledby="sendModalLabel"
          tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="sendModalLabel">
                  Envoyer un message
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h6>Aa : <span id="modalIdMsg"></span></h6>
                <label for="messageText">Message</label>
                <textarea
                  class="form-control"
                  id="messageText"
                  rows="3"
                  placeholder="Écrivez votre message ici..."></textarea>
              </div>
              <div class="modal-footer">
                <button
                  class="btn btn-primary"
                  data-bs-dismiss="modal">
                  Envoyer
                </button>
                <button
                  class="btn btn-primary"
                  data-bs-dismiss="modal"
                  data-bs-toggle="modal">
                  Annuler
                </button>
              </div>
            </div>
          </div>
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
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=contacts&nb=" . $i . "\">" . $i . "</a></li>";
              }
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
$req->close();
$conn->close();
?>