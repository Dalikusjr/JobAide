<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$req = $conn->prepare("UPDATE client SET new = TRUE WHERE new = FALSE;");
$req->execute();
$req->close();

$limit = 10;
$nb = isset($_GET['nb']) ? (int)$_GET['nb'] : 1;
$offset = ($nb-1) * $limit;
$req = $conn->prepare("SELECT 
    c.id AS client_id,
    c.name,
    c.email,
    c.telnum,
    c.localisation,
    c.created_at,
    COUNT(i.id) AS nb_inscris
    FROM `client` c
    LEFT JOIN `inscription_ja` i ON i.client_id = c.id
    GROUP BY c.id, c.name, c.email, c.telnum, c.localisation,c.created_at ORDER BY created_at DESC LIMIT $limit OFFSET $offset;");
$req->execute();
$clients = $req->get_result();
$req->close();
$totalClients = $conn->query("SELECT COUNT(*) AS total FROM client")->fetch_assoc()['total'];
$totalPages = ceil($totalClients / $limit);

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
            Listes des clients
        </h1>
        <div class="card flex-grow-1 d-flex flex-column">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th class="d-none d-sm-table-cell" scope="col">Email</th>
                            <th class="d-none d-md-table-cell" scope="col">Téléphone</th>
                            <th class="d-none d-md-table-cell" scope="col">Localisation</th>
                            <th class="d-none d-xl-table-cell scoppe=" col">Date d'ajout</th>
                            <th class="d-none d-xl-table-cell scoppe=" col">Nbrs d'inscris</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $row):
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['client_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) .  "</td>";
                            echo "<td class=\"d-none d-sm-table-cell\">" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td class=\"d-none d-md-table-cell\">" . htmlspecialchars($row['telnum']) . "</td>";
                            echo "<td class=\"d-none d-lg-table-cell\">" . htmlspecialchars($row['localisation']) . "</td>";
                            echo "<td class=\"d-none d-xl-table-cell text-center\">" . htmlspecialchars($row['created_at']) . "</td>
                            <td class=\"d-none d-xl-table-cell\">" .  htmlspecialchars($row['nb_inscris']) . "</td>
                            <td class=\"text-center \">
                                <i class=\"fa-regular fa-pen-to-square me-2 edit-client pointer\" data-bs-toggle=\"modal\"
                                     data-id=\"" . htmlspecialchars($row['client_id']) . "\"></i>                                    
                               <form id=\"suppression\" action=\"clients/supprimer_client.php\" method=\"post\" class=\"d-inline\">
                                    <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['client_id']) . "\">
                                    <button type=\"submit\" class=\"btn btn-link text-danger p-0\">
                                        <i class=\"fa-solid fa-trash\" ></i>
                                    </button>
                                </form>
                            </td>
                        </tr>";
                        endforeach; ?>
                    </tbody>
                </table>
                <!-- ------------------------------------------------------------------------ -->
                <!-- informations-->
                <div
                    class="modal fade"
                    id="modalClient"
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
                                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=clients&nb=".$i."\">".$i."</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>