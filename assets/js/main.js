// // Initialiser un modal Bootstrap sur l'élément avec l'id "modalId"
const modalElement = document.getElementById("modalContact");
let myModal = null;

if (modalElement) {
  myModal = new bootstrap.Modal(modalElement);
}
// Configuration personnalisée pour Tailwind CSS

// Ajouter un gestionnaire au clic pour chaque bouton avec la classe "faq-question"
document.querySelectorAll(".faq-question").forEach((button) => {
  button.addEventListener("click", () => {
    const faqItem = button.parentElement; // L'élément parent (la question + réponse)
    const answer = faqItem.querySelector(".faq-answer"); // L'élément réponse associé
    const icon = button.querySelector(".faq-icon"); // L'icône qui affiche + ou −

    // Fermer toutes les autres FAQ ouvertes avant d'ouvrir celle-ci
    document.querySelectorAll(".faq-item").forEach((item) => {
      if (item !== faqItem) {
        // Pour chaque FAQ sauf celle cliquée
        item.classList.remove("active"); // Enlever la classe active
        item.querySelector(".faq-answer").style.maxHeight = null; // Cacher la réponse
        item.querySelector(".faq-icon").textContent = "+"; // Remettre l'icône à "+"
      }
    });

    // Activer ou désactiver la FAQ cliquée (toggle)
    faqItem.classList.toggle("active");
    if (faqItem.classList.contains("active")) {
      // Si activée, afficher la réponse en ajustant sa hauteur max
      answer.style.maxHeight = answer.scrollHeight + "px";
      icon.textContent = "−"; // Changer l'icône en "−"
    } else {
      // Si désactivée, cacher la réponse
      answer.style.maxHeight = null;
      icon.textContent = "+"; // Changer l'icône en "+"
    }
  });
});

// Ajouter un gestionnaire d'événement au scroll pour afficher ou cacher un bouton "back to top"
const b = document.getElementById("back-to-top");
if (b) {
  window.addEventListener("scroll", () => {
    if (window.pageYOffset > 300) {
      b.classList.remove("hidden"); // Afficher le bouton si scroll > 300px
    } else {
      b.classList.add("hidden"); // Cacher sinon
    }
    // Ajuster l'opacité du bouton à chaque scroll (de 70% à 100%)
    b.classList.replace("bg-opacity-70", "bg-opacity-100");
  });
}
let modal = document.getElementById("modalContact");
if (modal) {
  modal.addEventListener("show.bs.modal", (evt) => {
    let btn = evt.relatedTarget;
    let nom = btn.getAttribute("data-name");
    let mail = btn.getAttribute("data-email");
    let msg = btn.getAttribute("data-msg");
    document.getElementById("modalname").textContent = nom;
    document.getElementById("modalemail").textContent = mail;
    document.getElementById("modalmsg").textContent = msg;
  });
}

let sendModal = document.getElementById("sendModal");
if (sendModal) {
  sendModal.addEventListener("show.bs.modal", (evt) => {
    let btn = evt.relatedTarget;
    let mail = btn.getAttribute("data-email");
    document.getElementById("modalIdMsg").textContent = mail;
  });
}
document.querySelectorAll(".edit-btn").forEach((btn) => {
  btn.addEventListener("click", function () {
    let id = this.getAttribute("data-id");

    fetch("inscriptions/edit_inscri.php?id=" + id)
      .then((response) => response.text())
      .then((html) => {
        const modalInscri = document.getElementById("modaliInscri");
        modalInscri.innerHTML = html;
        let modal = new bootstrap.Modal(
          document.getElementById("modaliInscri")
        );
        modal.show();
      })
      .catch((err) => console.error(err));
  });
});
let editList = document.querySelectorAll(".edit-client");
if (editList) {
  editList.forEach((btn) => {
    btn.addEventListener("click", function () {
      let id = this.getAttribute("data-id");
      fetch("clients/edit_client.php?id=" + id)
        .then((response) => response.text())
        .then((html) => {
          const modalClient = document.getElementById("modalClient");
          modalClient.innerHTML = html;
          let modal = new bootstrap.Modal(
            document.getElementById("modalClient")
          );
          modal.show();
        })
        .catch((err) => console.error(err));
    });
  });
}
let userList = document.querySelectorAll(".edit-user");
if (userList) {
  userList.forEach((btn) => {
    btn.addEventListener("click", function () {
      let id = this.getAttribute("data-id");
      fetch("users/edit_user.php?id=" + id)
        .then((response) => response.text())
        .then((html) => {
          const modalUser = document.getElementById("modalUser");
          modalUser.innerHTML = html;
          let modal = new bootstrap.Modal(document.getElementById("modalUser"));
          modal.show();
        })
        .catch((err) => console.error(err));
    });
  });
}
let clock = document.getElementById("datetime");
if (clock) {
  function updateDateTime() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, "0"); // heures sur 2 chiffres
    const minutes = now.getMinutes().toString().padStart(2, "0");
    const seconds = now.getSeconds().toString().padStart(2, "0"); // minutes sur 2 chiffres
    clock.textContent = `${hours}:${minutes}:${seconds}`;
  }

  setInterval(updateDateTime, 1000);
  updateDateTime();
}

// POPUP

function closePopup(ele) {
  ele.style.animation = "fadeOut 0.3s forwards";
  setTimeout(() => {
    ele.style.display = "none";
  }, 300);
}

function openPopup(ele) {
  ele.style.display = "block";
  ele.style.animation = "fadeIn 0.3s ease";
  setTimeout(() => closePopup(ele), 2000); // <-- fonction fléchée pour attendre 2s
}
const popup = document.getElementById("popup");
if (popup) {
  // Afficher automatiquement au chargement
  window.addEventListener("DOMContentLoaded", openPopup(popup));
}

let popupSubmit = document.getElementById("popupSubmit");
if (popupSubmit) {
  document.getElementById("formulaire").addEventListener("submit", (e) => {
    const ti = document.getElementById("ti").value.trim();
    console.log(ti);
    if (ti === "") {
      e.preventDefault();
      openPopup(popupSubmit);
    }
  });
}
// Modal Confirmation
let suppression = document.querySelectorAll("#suppression");
if (suppression) {
  const confirmModal = new bootstrap.Modal(
    document.getElementById("confirmModal")
  );
  const confirmBtn = document.getElementById("confirmBtn");
  let currentForm = null;
  suppression.forEach((form) => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      currentForm = form;
      confirmModal.show();
    });
  });
  confirmBtn.addEventListener("click", () => {
    currentForm.submit();
    currentForm = null;
  });
}
