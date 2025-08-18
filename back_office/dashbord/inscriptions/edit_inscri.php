<?php
include __DIR__ . "/../../../config/config.php";


$id = intval($_GET['id']);
$sql = "SELECT inscription_ja.id AS inscription_id,
        inscription_ja.client_id AS client_id,
        inscription_ja.type_poste,
        inscription_ja.cv,
        inscription_ja.description
        FROM `inscription_ja` WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$inscri = $stmt->get_result()->fetch_assoc();
$sql = "SELECT client.id AS client_id,
        client.name,
        client.email,
        client.telnum,
        client.localisation
        FROM `client` WHERE client.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $inscri['client_id']);
$stmt->execute();
$client = $stmt->get_result()->fetch_assoc();

?>
<div
    class="modal-dialog modal-lg modal-dialog-centered"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">
                Informations de l'inscription
            </h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="inscriptions/update_inscri.php" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <input class="d-none" name="client_id" value="<?= htmlspecialchars($client['client_id']) ?>" type="text">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="inscri_id" class="form-label">ID d'inscription</label>
                        <input
                            type="text"
                            class="form-control"
                            name="inscri_id"
                            value="<?= htmlspecialchars($inscri['inscription_id']) ?>"
                            readonly>
                    </div>

                    <div class="mb-3 col-12 col-md-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nom"
                            id="nom"
                            value="<?= htmlspecialchars($client['name']) ?>">
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="mail" class="form-label">E-mail</label>
                        <input
                            type="email"
                            class="form-control"
                            name="mail"
                            id="mail"
                            value="<?= htmlspecialchars($client["email"]) ?>">
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="tel" class="form-label">Téléphone</label>
                        <input
                            type="text"
                            class="form-control"
                            name="tel"
                            id="tel"
                            value="<?= htmlspecialchars($client["telnum"]) ?>">
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="type_poste" class="form-label">Postes Visés</label>
                        <input
                            type="text"
                            class="form-control"
                            name="type_poste"
                            id="type_poste"
                            value="<?= htmlspecialchars($inscri["type_poste"]) ?>">
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
                    <div class="mb-3 col-12">
                        Curriculum Vitae
                        <div class="mb-3 border row gap-2 p-2 rounded">
                            <div class="row g-2 col-12 col-lg-6">
                                <div class="col-12 col-md-12 d-grid">
                                    <a
                                        href="../../includes/download.php?file=<?= htmlspecialchars(basename($inscri['cv'])) ?>"
                                        class="btn btn-primary d-inline-flex align-items-center gap-2">
                                        <i class="fa-solid fa-cloud-arrow-down"></i> Télécharger
                                    </a>
                                </div>
                            </div>


                            <div class="col-12 col-lg-6">
                                <label for="cv" class="form-label">Charger</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="cv"
                                    id="cv">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"><?= htmlspecialchars($inscri["description"]) ?></textarea>
                    </div>
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