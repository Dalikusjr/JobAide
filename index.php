<?php
include_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="emploi Tunisie, offres d’emploi, postuler en ligne, candidature automatique, aide à l’emploi, recherche d’emploi, entretien d’embauche, CV en ligne, JobAide, recrutement Tunisie, jobs Tunisie, carrière, accompagnement emploi, services candidats, gestion candidatures">

  <title>JobAide | Service d’aide à la recherche d’emploi en Tunisie</title>
  <meta name="description" content="JobAide postule à votre place sur les offres d’emploi en Tunisie. Gagnez du temps et concentrez-vous sur vos entretiens pendant que nous gérons vos candidatures efficacement.">
  <script src="https://kit.fontawesome.com/f0233da9aa.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="canonical" href="http://localhost<?= $_SERVER['REQUEST_URI'] ?>" />

</head>

<body class="bg-light">
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

  <!-- header -->
  <header>
    <nav
      class="container mx-auto max-w-7xl flex flex-col md:flex-row items-center justify-between pt-2">
      <img class="w-64 sm:w-80" src="./assets/images/logo.png" alt="logo-JobAide" />
      <a
        class="bg-secondary mr-4 font-medium text-center text-white px-6 py-3 rounded-full hover:bg-orange-500 transition duration-300 shadow-md hidden md:block"
        href="#pricing">Choisir un Forfait</a>
    </nav>
  </header>
  <!-- Hero section -->
  <section class="bg-primary py-20 text-white">
    <div class="mx-auto px-6 flex flex-col md:flex-row items-center">
      <div class="md:w-1/2 mb-10 md:mb-0">
        <h1
          class="text-3xl text-center md:text-left md:text-5xl font-bold leading-tight mb-6">
          Trouve ton job en Tunisie sans perdre de temps
        </h1>
        <p class="text-2xl mb-8 text-center md:text-left">
          Nous postulons à ta place sur les offres qui te correspondent, tu te
          concentres sur les entretiens.
        </p>
        <div class="flex justify-center">
          <a
            class="bg-secondary text-center text-1xl md:text-2xl font-medium text-white px-6 py-4 rounded-full hover:bg-orange-500 transition duration-300 shadow-lg"
            href="#pricing">Choisir mon forfait maintenant</a>
        </div>
      </div>
      <div class="md:w-1/2 flex justify-center">
        <img
          src="https://plus.unsplash.com/premium_photo-1683121855240-5d3f67a5fdec?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
          alt="Deux hommes se serrant la main après une candidature réussie en Tunisie"
          class="rounded-lg shadow-2xl max-w-md w-full object-cover hidden sm:block" />
      </div>
    </div>
  </section>
  <!-- Nos Forfaits -->
  <section id="pricing" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-primary mb-4">
        Nos Forfaits
      </h2>
      <p class="text-xl text-center text-gray-600 mb-16">
        Choisissez l'option qui correspond à vos besoins
      </p>
      <div class="flex flex-col lg:flex-row justify-center gap-8">
        <div
          class="bg-white rounded-xl shadow-lg overflow-hidden flex-1 max-w-md mx-auto hover:scale-105 transition duration-300">
          <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Basic</h3>
            <div class="flex items-baseline mb-6">
              <span class="text-4xl font-bold text-primary">20 DT</span>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-center">
                <i class="fas fa-check text-secondary mr-3"></i>
                <span>20 candidatures ciblées</span>
              </li>
              <li class="flex items-center text-gray-400">
                <i class="fas fa-times mr-3"></i>
                <span>Optimisation de CV</span>
              </li>
              <li class="flex items-center text-gray-400">
                <i class="fas fa-times mr-3"></i>
                <span>Lettres de motivation</span>
              </li>
            </ul>
            <form action="inscription/inscription.php" method="post">
              <input name="ti" class="hidden" type="text" value="Basic">
              <button type="submit"
                class="block w-full bg-primary hover:bg-blue-800 text-white text-center py-3 px-6 rounded-lg font-medium transition duration-300">Commander maintenant</button>
            </form>
          </div>
        </div>
        <div
          class="bg-white rounded-xl shadow-2xl overflow-hidden flex-1 max-w-md mx-auto border-2 border-secondary hover:scale-105 transition duration-300">
          <div class="bg-secondary text-white text-center py-2">
            <span class="font-bold">LE PLUS POPULAIRE</span>
          </div>
          <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Standard</h3>
            <div class="flex items-baseline mb-6">
              <span class="text-4xl font-bold text-primary">50 DT</span>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-center">
                <i class="fas fa-check text-secondary mr-3"></i>
                <span>35 candidatures ciblées</span>
              </li>
              <li class="flex items-center">
                <i class="fas fa-check text-secondary mr-3"></i>
                <span>Optimisation complète de CV</span>
              </li>
              <li class="flex items-center text-gray-400">
                <i class="fas fa-times mr-3"></i>
                <span>Lettres de motivation</span>
              </li>
            </ul>
            <form action="inscription/inscription.php" method="post">
              <input class="hidden" name="ti" type="text" value="Standard">
              <button type="submit"
                class="block w-full bg-primary hover:bg-blue-800 text-white text-center py-3 px-6 rounded-lg font-medium transition duration-300">Commander maintenant</button>
            </form>
          </div>
        </div>
        <div
          class="bg-white rounded-xl shadow-lg overflow-hidden flex-1 max-w-md mx-auto hover:scale-105 transition duration-300">
          <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Premium</h3>
            <div class="flex items-baseline mb-6">
              <span class="text-4xl font-bold text-primary">100 DT</span>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-center">
                <i class="fas fa-check text-secondary mr-3"></i>
                <span>50 candidatures ciblées</span>
              </li>
              <li class="flex items-center">
                <i class="fas fa-check text-secondary mr-3"></i>
                <span>Optimisation complète de CV</span>
              </li>
              <li class="flex items-center">
                <i class="fas fa-check text-secondary mr-3"></i>
                <span>Lettres de motivation personnalisées</span>
              </li>
            </ul>
            <form action="inscription/inscription.php" method="post">
              <input class="hidden" name="ti" type="text" value="Premium">
              <button type="submit"
                class="block w-full bg-primary hover:bg-blue-800 text-white text-center py-3 px-6 rounded-lg font-medium transition duration-300">Commander maintenant</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- comment ça marche -->
  <section id="comment" class="bg-gray-50 py-20">
    <div class="mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-primary mb-16">
        3 étapes simples
      </h2>
      <div
        class="flex flex-col md:flex-row justify-between gap-6 space-y-12 md:space-y-0">
        <div class="rounded-lg flex flex-col items-center md:w-1/3 px-4">
          <div
            class="bg-primary w-16 h-16 rounded-full text-white flex items-center justify-center font-bold text-2xl mb-3">
            1
          </div>
          <h3 class="text-center font-bold text-xl mb-4">
            Choisis ton forfait.
          </h3>
          <p class="text-gray-600 text-center">
            Tu choisis ton pack selon le nombre de candidatures et le niveau
            d’accompagnement que tu souhaites.
          </p>
        </div>
        <div class="rounded-lg flex flex-col items-center md:w-1/3 px-4">
          <div
            class="bg-primary w-16 h-16 rounded-full text-white flex items-center justify-center font-bold text-2xl mb-3">
            2
          </div>
          <h3 class="text-center font-bold text-xl mb-4">
            Nous optimisons ton CV et postulons pour toi.
          </h3>
          <p class="text-gray-600 text-center">
            Notre équipe améliore ton CV et envoie des candidatures ciblées à
            ta place.
          </p>
        </div>
        <div class="rounded-lg flex flex-col items-center md:w-1/3 px-4">
          <div
            class="bg-primary w-16 h-16 rounded-full text-white flex items-center justify-center font-bold text-2xl mb-3">
            3
          </div>
          <h3 class="text-center font-bold text-xl mb-4">
            Tu reçois les réponses et prépares tes entretiens.
          </h3>
          <p class="text-gray-600 text-center">
            Tu suis les retours facilement et tu te prépares sereinement aux
            entretiens.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- Pourquoi nous choisir ? -->
  <section class="bg-white py-20">
    <div class="mx-auto px-6">
      <h2 class="text-5xl font-bold text-center text-primary mb-24">
        Pourquoi nous choisir ?
      </h2>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-gray-50 p-6 text-center rounded-lg">
          <div
            class="bg-gray-200 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-6">
            <i class="fas fa-clock text-secondary text-2xl"></i>
          </div>
          <h3 class="text-xl font-medium mb-4">Gain de temps</h3>
          <p class="text-gray-600">
            On postule à votre place. Vous gagnez des heures précieuses.
          </p>
        </div>
        <div class="bg-gray-50 p-6 text-center rounded-lg">
          <div
            class="bg-gray-200 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-6">
            <i class="fas fa-bullseye text-secondary text-2xl"></i>
          </div>
          <h3 class="text-xl font-medium mb-4">Candidatures ciblées</h3>
          <p class="text-gray-600">
            On sélectionne uniquement les offres qui correspondent à votre
            profil.
          </p>
        </div>
        <div class="bg-gray-50 p-6 text-center rounded-lg">
          <div
            class="bg-gray-200 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-6">
            <i class="fas fa-chart-line text-secondary text-2xl"></i>
          </div>
          <h3 class="text-xl font-medium mb-4">
            Augmentation des chances d’obtenir un entretien
          </h3>
          <p class="text-gray-600">
            Un CV optimisé + des offres pertinentes = plus de retours
            positifs.
          </p>
        </div>
        <div class="bg-gray-50 p-6 text-center rounded-lg">
          <div
            class="bg-gray-200 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-6">
            <i class="fas fa-lock text-secondary text-2xl"></i>
          </div>
          <h3 class="text-xl font-medium mb-4">Service discret et rapide</h3>
          <p class="text-gray-600">
            Vos candidatures sont envoyées en toute confidentialité, sous 48h.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- Section Témoignages -->
  <section id="avis" class="bg-primary">
    <div class="max-w-7xl mx-auto py-20">
      <h2 class="text-5xl font-bold text-center text-white mb-24">
        Témoignages clients
      </h2>
      <div class="flex flex-col px-4 md:px-0 md:flex-row gap-8">
        <div class="bg-gray-300 bg-opacity-10 rounded-lg p-8">
          <div class="flex items-center gap-8">
            <div
              class="bg-gray-300 w-16 h-16 flex items-center justify-center rounded-full">
              <i class="fas fa-user text-3xl"></i>
            </div>
            <span class="text-gray-400 text-2xl font-bold">Eric Garcia</span>
          </div>
          <p class="text-gray-400 py-4">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Architecto asperiores, sunt deleniti libero odit natus nesciunt at
            perspiciatis accusantium quam eaque assumenda repellendus ullam
            unde quae laboriosam ratione temporibus eum!
          </p>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
        </div>
        <div class="bg-gray-300 bg-opacity-10 rounded-lg p-8">
          <div class="flex items-center gap-8">
            <div
              class="bg-gray-300 w-16 h-16 flex items-center justify-center rounded-full">
              <i class="fas fa-user text-3xl"></i>
            </div>
            <span class="text-gray-400 text-2xl font-bold">dell pierro</span>
          </div>
          <p class="text-gray-400 py-4">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Architecto asperiores, sunt deleniti libero odit natus nesciunt at
            perspiciatis accusantium quam eaque assumenda repellendus ullam
            unde quae laboriosam ratione temporibus eum!
          </p>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
          <i class="fas fa-star text-yellow-300"></i>
        </div>
      </div>
    </div>
  </section>
  <!-- Questions fréquentes -->
  <section id="faq" class="bg-white">
    <div class="mx-auto py-20">
      <h2 class="text-5xl font-bold text-center mb-2">
        Questions fréquentes
      </h2>
      <p class="text-center text-gray-700 mb-20">
        Vous ne trouvez pas la réponse recherchée ? N’hésitez pas à nous
        <a class="text-primary underline" href="#contact">contacter</a>
      </p>

      <div class="space-y-1">
        <div
          class="text-center bg-white border border-1 faq-item mx-10 bg-gray-50 rounded-lg overflow-hidden transition-all">
          <button
            class="faq-question w-full p-4 flex justify-center gap-6 items-center text-2xl font-semibold text-gray-700">
            <span>Combien de temps pour postuler ?</span>
            <span class="faq-icon text-3xl">+</span>
          </button>
          <div
            class="faq-answer max-h-0 overflow-hidden transition-all duration-500 px-4">
            <p class="text-xl text-gray-700 pb-4 m-3">
              <i class="fas fa-comment"></i> Une fois votre commande et vos
              informations reçues, nous lançons les candidatures sous 48
              heures ouvrées maximum.
            </p>
          </div>
        </div>
        <div
          class="text-center bg-white border border-1 faq-item mx-10 bg-gray-50 rounded-lg overflow-hidden transition-all">
          <button
            class="faq-question w-full p-4 flex justify-center gap-6 items-center text-2xl font-semibold text-gray-700">
            <span>Est-ce confidentiel ?</span>
            <span class="faq-icon text-3xl">+</span>
          </button>
          <div
            class="faq-answer max-h-0 overflow-hidden transition-all duration-500 px-4">
            <p class="text-xl text-gray-700 pb-4 m-3">
              <i class="fas fa-comment"></i> Oui. Toutes vos informations et
              candidatures sont traitées avec la plus stricte confidentialité.
              Rien n’est partagé sans votre accord.
            </p>
          </div>
        </div>

        <div
          class="text-center bg-white border faq-item mx-10 bg-gray-50 rounded-lg overflow-hidden transition-all">
          <button
            class="faq-question w-full p-4 flex gap-6 justify-center items-center text-2xl font-semibold text-gray-700">
            <span>Comment envoyer mon CV ?</span>
            <span class="faq-icon text-3xl">+</span>
          </button>
          <div
            class="faq-answer max-h-0 overflow-hidden transition-all duration-500 px-4">
            <p class="text-xl text-gray-700 pb-4 m-3">
              <i class="fas fa-comment"></i> Une fois votre paiement effectué,
              vous recevrez un email avec un lien pour envoyer votre CV, vos
              préférences et autres informations utiles.
            </p>
          </div>
        </div>

        <div
          class="text-center faq-item mx-10 bg-white rounded-lg overflow-hidden transition-all border">
          <button
            class="faq-question w-full p-4 flex justify-center gap-6 items-center text-2xl font-semibold text-gray-700">
            <span>Puis-je choisir les offres ?</span>
            <span class="faq-icon text-3xl">+</span>
          </button>
          <div
            class="bg-white faq-answer max-h-0 overflow-hidden transition-all duration-500 px-4">
            <p class="text-xl text-gray-700 pb-4 m-3">
              <i class="fas fa-comment"></i> Oui. Vous pouvez nous indiquer
              vos préférences (secteur, poste, lieu, etc.) et nous ciblons
              uniquement les offres qui vous correspondent.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact -->
  <?php include './front_end/formulaire/form-contact.php'; ?>
  <!-- footer -->
  <?php include './front_end/footer/footer.php'; ?>
  <a
    href="#"
    id="back-to-top"
    class="fixed bottom-8 right-8 bg-opacity-80 bg-gray-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:bg-gray-900 duration-300 hover:shadow-neon transition transform hover:scale-110 z-50 hover:bg-opacity-100 transition-opacity duration-300 hidden"><i class="fas fa-arrow-up text-xl"></i></a>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/tailwind-config.js"></script>
</body>

</html>
<?php $conn->close(); ?>