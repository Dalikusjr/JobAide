<section id="contact" class="py-20 bg-secondary">
  <div class="mx-auto px-6">
    <div class="max-w-4xl shadow-xl mx-auto bg-gray-50 rounded-xl p-8 md:p-12 shadow-lg">

      <!-- Titre -->
      <h2 class="text-3xl font-bold text-primary mb-6">Contactez-nous</h2>

      <div class="grid md:grid-cols-2 gap-6">

        <!-- Informations de contact -->
        <div>
          <h3 class="text-xl font-semibold mb-4">Informations de contact</h3>
          <div class="space-y-4">

            <div class="flex items-start">
              <i class="fas fa-envelope text-secondary mt-1 mr-4"></i>
              <div>
                <p class="font-medium">Email</p>
                <a href="mailto:hello@jobaide.tn" class="text-gray-600 hover:text-primary">
                  hello@jobaide.tn
                </a>
              </div>
            </div>

            <div class="flex items-start">
              <i class="fas fa-phone-alt text-secondary mt-1 mr-4"></i>
              <div>
                <p class="font-medium">Téléphone</p>
                <p class="text-gray-600">+41 XX XXX XX XX</p>
              </div>
            </div>

            <div class="flex items-start">
              <i class="fas fa-clock text-secondary mt-1 mr-4"></i>
              <div>
                <p class="font-medium">Horaires</p>
                <p class="text-gray-600">Lundi-Vendredi: 9h-18h</p>
              </div>
            </div>

          </div>

          <!-- Réseaux sociaux -->
          <div class="mt-8">
            <h4 class="font-semibold mb-4">Suivez-nous</h4>
            <div class="flex space-x-4">
              <a href="#"
                 class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center hover:bg-blue-800 transition duration-300">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="#"
                 class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center hover:bg-blue-800 transition duration-300">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Formulaire -->
        <div>
          <form action="front_end/formulaire/ajouter_contact.php" method="post" class="space-y-4">
            
            <div>
              <label for="name" class="block text-gray-700 mb-2">Nom complet</label>
              <input required name="name" type="text" id="name"
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent" />
            </div>

            <div>
              <label for="email" class="block text-gray-700 mb-2">Email</label>
              <input required name="email" type="email" id="email"
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent" />
            </div>

            <div>
              <label for="message" class="block text-gray-700 mb-2">Message</label>
              <textarea required name="message" id="message" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"></textarea>
            </div>

            <button type="submit"
                    class="w-full bg-secondary hover:bg-orange-500 text-white py-3 px-6 rounded-lg font-medium transition duration-300">
              Envoyer le message
            </button>

          </form>
        </div>

      </div>
    </div>
  </div>
</section>
