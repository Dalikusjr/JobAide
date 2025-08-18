<?php
include __DIR__ . "/../../../config/config.php";

$id = intval($_GET['id']);
$sql = "SELECT id AS user_id,
        users.name,
        users.role,
        users.email,
        users.telnum,
        users.user_name,
        users.passwd
        FROM `users` WHERE users.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();
$permis = ['admin' => 'Super-Administrateur', 'manager' => 'Administrateur', 'moderator' => 'Modérateur'];
?>
<div
    class="modal-dialog modal-lg modal-dialog-centered"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">
                Informations de d'utilisateur
            </h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="users/update_user.php" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="user_id" class="form-label">ID Utilisateur</label>
                        <input
                            type="text"
                            class="form-control"
                            name="user_id"
                            value="<?= htmlspecialchars($user['user_id']) ?>"
                            readonly>
                    </div>
                    
                <div class="mb-3 col-12 col-md-6">
                        <label for="role" class="form-label">Rôle</label>
                        <select
                            class="form-select"
                            name="role"
                            id="role">
                            <option value="$user['role']?>" selected><?= htmlspecialchars($permis[$user['role']]) ?></option>
                            <option value="moderator">Modérateur</option>
                            <option value="manager">Administrateur</option>
                            <option value="admin">Super-Administrateur</option>
                        </select>
                    </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nom"
                        id="nom"
                        value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="mail" class="form-label">E-mail</label>
                    <input
                        type="email"
                        class="form-control"
                        name="mail"
                        id="mail"
                        value="<?= htmlspecialchars($user["email"]) ?>" required>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="tel" class="form-label">Téléphone</label>
                    <input
                        type="text"
                        class="form-control"
                        name="tel"
                        id="tel"
                        value="<?= htmlspecialchars($user["telnum"]) ?>" required>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="user_n" class="form-label">Nom d'utilisateur</label>
                    <input
                        type="text"
                        class="form-control"
                        name="user_n"
                        id="user_n"
                        value="<?= htmlspecialchars($user["user_name"]) ?>">
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="passwd" class="form-label">Mot de passe</label>
                    <input
                        type="text"
                        class="form-control"
                        name="passwd"
                        id="passwd"
                        value="<?= htmlspecialchars($user["passwd"]) ?>">
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