<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ti'])) {
  $allowedType = ['Basic' => 20, 'Standard' => 50, 'Premium' => 100];
  if (array_key_exists($_POST['ti'], $allowedType)) {
    $typeInscri = $_POST['ti'];
    $montant = $allowedType[$typeInscri];
  } else {
    $erreur = "Erreur : Type d'inscription invalide.";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobAide | Inscription</title>
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body class="bg-light">
  <?PHP if (!empty($erreur)): ?>
    <div id="popup" class="border border-red-700 rounded p-8 bg-red-50">
      <div class="text-red-700 text-1xl">
        <h2><i class="fa-solid fa-xmark me-2"></i><?= htmlspecialchars($erreur) ?></h2>
      </div>
    </div>
  <?php endif; ?>
  <?PHP if (!empty($_SESSION['success'])): ?>
    <div id="popup" class="border border-green-700 rounded p-8 bg-green-50">
      <div class="text-green-700 text-1xl">
        <h2><i class="fa-solid fa-check me-2"></i><?= htmlspecialchars($_SESSION['success']) ?></h2>
      </div>
    </div>
  <?php elseif (!empty($_SESSION['failure'])): ?>
    <div id="popup" class="border border-red-700 rounded p-8 bg-red-50">
      <div class="text-red-700 text-1xl">
        <h2><i class="fa-solid fa-xmark me-2"></i><?= htmlspecialchars($_SESSION['failure']) ?></h2>
      </div>
    </div>
  <?php endif; ?>
  <?php session_unset(); ?>
  <div id="popupSubmit" class="border border-red-700 rounded p-8 bg-red-50">
    <div class="text-red-700 text-1xl">
      <h2><i class="fa-solid fa-xmark me-2"></i>Merci de sélectionner un forfait afin d’accéder au paiement.</h2>
    </div>
  </div>
  <!-- Header -->
  <?php include '../front_end/header/header-inscrip.php'; ?>
  <!-- Formulaire d'inscription   -->
  <section>
    <div class="mb-32 mx-4" id="inscrip">
      <div class="bg-white border container mx-auto rounded-lg max-w-5xl md:h-[750px] shadow-lg">
        <h2 class=" mt-5 ml-16 text-2xl text-gray-700">Forfait choisi : <?= htmlspecialchars($typeInscri) . '-' . $montant . ' TND' ?></h2>
        <form
          id="formulaire"
          action="process-inscrip.php"
          class="  space-y-12 md:space-y-5 grid md:grid-cols-2 py-2 pl-16  " method="post" enctype="multipart/form-data">
          <input name="mnt" class="hidden" type="text" value="<?= $montant ?>">
          <input name="type_i" id="ti" class="hidden" type="text" value="<?= htmlspecialchars($typeInscri) ?>">
          <div class="pr-12 space-y-12">
            <div>
              <label class="block text-gray-700 mb-2" for="nom">Nom et Prénom : <span class="text-secondary">*</span>
              </label>
              <input
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:shadow-lg focus:scale-105 focus:shadow-orange-200 focus:border-transparent transition duration-300"
                required
                placeholder="Nom et Prénom"
                type="text"
                name="nom"
                id="nom" />
            </div>
            <div>
              <label class="block text-gray-700 mb-2" for="mail">E-mail : <span class="text-secondary">*</span></label>
              <input
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:shadow-lg focus:scale-105 focus:shadow-orange-200 focus:border-transparent transition duration-300"
                type="email"
                placeholder="nom@domaine.xyz"
                required
                name="mail"
                id="mail" />
            </div>
            <div>
              <label class="block text-gray-700 mb-2" for="tel">Téléphone : <span class="text-secondary">*</span></label>
              <input
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:shadow-lg focus:scale-105 focus:shadow-orange-200 focus:border-transparent transition duration-300"
                placeholder="+216 xx xxx xxx"
                required
                type="text"
                name="tel"
                id="tel" />
            </div>
          </div>
          <div class="pr-12 space-y-12">
            <div>
              <label class="block text-gray-700 mb-2" for="poste">type de postes visés :
                <span class="text-secondary">*</span></label>
              <input
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:shadow-lg focus:scale-105 focus:shadow-orange-200 focus:border-transparent transition duration-300"
                placeholder="Développeur"
                required
                type="text"
                name="poste"
                id="poste" />
            </div>
            <div>
              <label class="block text-gray-700 mb-2" for="local">Localisation :</label>
              <input
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:shadow-lg focus:scale-105 focus:shadow-orange-200 focus:border-transparent transition duration-300"
                placeholder="Monastir"
                type="text"
                name="local"
                id="local" />
            </div>
            <div>
              <label class="block text-gray-700" for="cv">Curriculum Vitae : <span class="text-secondary">*</span></label>
              <input
                class="w-full md:file:mr-14 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:shadow-lg focus:scale-105 focus:shadow-orange-200 focus:border-transparent transition duration-300 file:bg-secondary file:border-transparent file:text-gray-100 hover:file:bg-orange-500 file:transition file:duration-300 cursor-pointer file:cursor-pointer file:px-4 file:py-2 file:mr-4"
                type="file"
                name="cv"
                id="cv"
                required
                accept=".jpg,.docx,.doc,.pdf" />
            </div>
          </div>
          <div class="pr-12 md:col-span-2">
            <label class="block text-gray-700 mb-2" for="description">Description (Optionnel) :</label>
            <textarea
              class="w-full h-32 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:shadow-lg focus:scale-105 focus:shadow-orange-200 focus:border-transparent transition duration-300"
              placeholder="Ecrire votre message ici ..."
              name="description"
              id="description"></textarea>
          </div>
          <div
            class="pt-8 flex flex-col space-y-8 md:space-y-0 md:col-span-2 md:flex-row md:mx-24 pr-12 md:space-x-12 md:max-h-14 md:items-center">
            <input
              class="text-gray-100 bg-secondary rounded-lg w-full py-3 font-medium hover:shadow-lg hover:scale-105 hover:bg-orange-500 transition duration-300 cursor-pointer"
              type="submit"
              value="Procéder au paiement" />
            <a href="../index.php" class="text-gray-100 bg-secondary rounded-lg w-full py-3 font-medium hover:shadow-lg hover:scale-105 hover:bg-orange-500 transition duration-300 cursor-pointer text-center">Annuler</a>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php include '../front_end/footer/footer.php'; ?>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../assets/js/tailwind-config.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>