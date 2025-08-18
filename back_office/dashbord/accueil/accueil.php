<?php



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

$stats = [];
$req = $conn->prepare("
    SELECT 
        (SELECT COUNT(*) FROM contacts) as contact_tot,
        (SELECT COUNT(*) FROM inscription_ja) as inscrip_tot,
        (SELECT COUNT(*) FROM client) as client_tot
");
$req->execute();
$result = $req->get_result();
$stats = $result->fetch_assoc();
$req->close();

$contacts_rec = [];
if ($new['contact_nbr'] > 0) {
    $req = $conn->prepare("SELECT name, email, message, created_at FROM contacts WHERE lu = 0 ORDER BY created_at DESC LIMIT 5");
    $req->execute();
    $contacts_rec = $req->get_result()->fetch_all(MYSQLI_ASSOC);
    $req->close();
}
?>

<main class="flex-grow-1 bg-light vh-100 p-3 " style="overflow-y: auto;">
    <div class="row g-3" style="max-width: 1200px; margin: 0 auto;">
        <div class="col-12 welcome-container p-4 bg-dark text-light rounded-3 border border-secondary shadow">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h2 class="m-0 welcome-text">
                    Bienvenue <span class="username text-info"><?= htmlspecialchars($_SESSION['username'] ?? 'utilisateur') ?></span>
                </h2>
                <div class="datetime-display d-flex align-items-center mt-2 mt-md-0">
                    <i class="fa-solid fa-clock me-2"></i>
                    <span id="datetime" class="fs-5">--:-- --</span>
                    <span id="current-date" class="ms-3 text-muted"><?= date('d/m/Y') ?></span>
                </div>
            </div>
        </div>
        <div class="row g-0 stat-card bg-dark text-light rounded-4 overflow-hidden shadow-lg mb-4">
            <!-- En-tête -->
            <div class="col-12 p-4 d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05);">
                <h2 class="m-0 text-light fs-3 fw-normal">
                    <i class="fa-solid fa-chart-line me-2"></i>Statistiques Globales
                </h2>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    <i class="fa-solid fa-repeat me-2"></i>Mise à jour <?= date("H:i") ?>
                </span>
            </div>

            <!-- Cartes de stats -->
            <div class="col-12">
                <div class="row g-0">
                    <!-- Clients -->
                    <div class="col-md-4 stat-item p-4 position-relative" style="background: linear-gradient(135deg, rgba(23,162,184,0.15) 0%, rgba(23,162,184,0.05) 100%);">
                        <div class="stat-badge bg-info ">
                            <i class="fa-solid fa-people-group "></i>
                        </div>
                        <h5 class="text-center text-uppercase text-info mb-3 fw-light fs-6 mt-2">Clients</h5>
                        <h3 class="text-center display-4 mb-0 fw-bold"><?= $stats['client_tot'] ?></h3>
                        <div class="progress mt-3 mx-auto" style="height: 4px; width: 80%;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>

                    <!-- Contacts -->
                    <div class="col-md-4 stat-item p-4 position-relative" style="background: linear-gradient(135deg, rgba(40,167,69,0.15) 0%, rgba(40,167,69,0.05) 100%);">
                        <div class="stat-badge bg-success">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <h5 class="text-center text-uppercase text-success mb-3 fw-light fs-6 mt-2">Contacts</h5>
                        <h3 class="text-center display-4 mb-0 fw-bold"><?= $stats['contact_tot'] ?></h3>
                        <div class="progress mt-3 mx-auto" style="height: 4px; width: 80%;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>

                    <!-- Inscriptions -->
                    <div class="col-md-4 stat-item p-4 position-relative" style="background: linear-gradient(135deg, rgba(255,193,7,0.15) 0%, rgba(255,193,7,0.05) 100%);">
                        <div class="stat-badge bg-warning">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <h5 class="text-center text-uppercase text-warning mb-3 fw-light fs-6 mt-2">Inscriptions</h5>
                        <h3 class="text-center display-4 mb-0 fw-bold"><?= $stats['inscrip_tot'] ?></h3>
                        <div class="progress mt-3 mx-auto" style="height: 4px; width: 80%;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="stat-card h-100 p-4 bg-dark text-light rounded-3 border border-secondary shadow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="<?= $new['client_nbr'] > 0 ? 'text-info' : 'text-muted' ?> m-0">
                        <i class="fa-solid fa-people-group me-2"></i>Clients
                    </h5>
                    <?php if ($new['client_nbr'] > 0): ?>
                        <span class="badge bg-primary rounded-pill"><?= $new['client_nbr'] ?> nouveau</span>
                </div>
                <h3 class="text-white text-center display-5 mb-0"><?= $new['client_nbr'] ?></h3>
                <div class="progress mt-3" style="height: 5px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                </div>
                <a href="../dashbord/?page=clients" class="btn btn-sm btn-outline-info w-100 mt-3">Voir les nouvelles inscriptions</a>

            <?php else: ?>
                <span class="badge bg-secondary rounded-pill">Aucun nouveau</span>
            </div>
            <p class="text-muted text-center display-8 mb-0">Aucun nouveau client</p>
            <div class="progress mt-3" style="height: 5px;">
                <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
            </div>
        <?php endif; ?>
        </div>
    </div>


    <div class="col-md-6 col-xl-4">
        <div class="stat-card h-100 p-0 bg-dark text-light rounded-3 border border-secondary shadow overflow-hidden">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                <h5 class="<?= $new['contact_nbr'] > 0 ? 'text-success' : 'text-muted' ?> m-0">
                    <i class="fa-solid fa-envelope me-2"></i>Contacts
                </h5>
                <?php if ($new['contact_nbr'] > 0): ?>
                    <span class="badge bg-danger rounded-pill"><?= $new['contact_nbr'] ?> non lus</span>
                <?php else: ?>
                    <span class="badge bg-secondary rounded-pill">Aucun nouveau</span>
                <?php endif; ?>
            </div>

            <?php if ($new['contact_nbr'] > 0): ?>
                <div class="p-3">
                    <?php foreach ($contacts_rec as $row): ?>
                        <div class="message-preview bg-light text-dark rounded p-3 mb-2 shadow-sm">
                            <div class="d-flex justify-content-between">
                                <strong><?= htmlspecialchars($row['name']) ?></strong>
                                <small class="text-muted"><?= date('H:i', strtotime($row['created_at'])) ?></small>
                            </div>
                            <small class="d-block text-truncate"><?= htmlspecialchars($row['email']) ?></small>
                            <p class="mt-2 mb-0 small text-truncate"><?= htmlspecialchars($row['message']) ?></p>
                        </div>
                    <?php endforeach; ?>
                    <a href="../dashbord/?page=contacts" class="btn btn-sm btn-outline-success w-100 mt-2">Voir tous</a>
                </div>
            <?php else: ?>
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-envelope-open display-6 d-block mb-2"></i>
                    <span>Aucun nouveau message</span>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <div class="col-md-12 col-xl-4">
        <div class="stat-card h-100 p-4 bg-dark text-light rounded-3 border border-secondary shadow">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="<?= $new['inscrip_nbr'] > 0 ? 'text-warning' : 'text-muted' ?> m-0">
                    <i class="fa-solid fa-user-plus me-2"></i>Inscriptions
                </h5>
                <?php if ($new['inscrip_nbr'] > 0): ?>
                    <span class="badge bg-success rounded-pill"><?= $new['inscrip_nbr'] ?> nouvelles</span>
            </div>
            <h3 class="text-center display-5 mb-0"><?= $new['inscrip_nbr'] ?></h3>
            <div class="progress mt-3" style="height: 5px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
            </div>
            <a href="../dashbord/?page=inscriptions" class="btn btn-sm btn-outline-warning w-100 mt-3">Voir les nouvelles inscriptions</a>

        <?php else: ?>
            <span class="badge bg-secondary rounded-pill">Aucune nouvelle</span>
        </div>
        <p class="text-center text-muted mb-0">Aucune nouvelle inscription</p>
        <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
        </div>
    <?php endif; ?>
    </div>
</main>