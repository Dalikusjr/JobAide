<?php
include __DIR__ . "/../../../config/config.php";


$id = intval($_GET['id']);
$sql = "SELECT client.id AS client_id,
        client.name,
        client.email,
        client.telnum,
        client.localisation
        FROM `client` WHERE client.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$client = $stmt->get_result()->fetch_assoc();
$stmt->close();
$stmt = $conn->prepare("SELECT COUNT(*) FROM inscription_ja WHERE client_id = ?;");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nbInscri);
$stmt->fetch();
$stmt->close();
$conn->close();

?>
<div
    class="modal-dialog modal-lg modal-dialog-centered"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">
                Informations de Client
            </h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="clients/update_client.php" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="client_id" class="form-label">ID client</label>
                        <input
                            type="text"
                            class="form-control"
                            name="client_id"
                            value="<?= htmlspecialchars($client['client_id']) ?>"
                            readonly>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="nbInscri" class="form-label">Nbr d'inscris</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nbInscri"
                            value="<?= $nbInscri ?>"
                            readonly>
                    </div>

                    <div class="mb-3 col-12 col-md-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nom"
                            id="nom"
                            value="<?= htmlspecialchars($client['name']) ?>" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="mail" class="form-label">E-mail</label>
                        <input
                            type="email"
                            class="form-control"
                            name="mail"
                            id="mail"
                            value="<?= htmlspecialchars($client["email"]) ?>" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="tel" class="form-label">Téléphone</label>
                        <input
                            type="text"
                            class="form-control"
                            name="tel"
                            id="tel"
                            value="<?= htmlspecialchars($client["telnum"]) ?>" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="local" class="form-label">localisation</label>
                        <input
                            type="text"
                            class="form-control"
                            name="local"
                            id="local"
                            value="<?= htmlspecialchars($client["localisation"]) ?>">
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="btn btn-primary">
                            Enregistrer
                        </button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Fermer
                        </button>
                    </div>
            </form>
        </div>

    </div>
</div>