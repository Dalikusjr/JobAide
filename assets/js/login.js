document.querySelector("form").addEventListener("submit", function (event) {
  let error = false;
  const nom = document.getElementById("l_user");
  if (nom.value.trim().length === 0) {
    nom.value = "Champ obligatoire";
    nom.classList.add("text-danger");
    error = true;
  }
  const pass = document.getElementById("l_pass");
  if (pass.value.trim().length === 0) {
    pass.type = "text";
    pass.value = "Champ obligatoire";
    pass.classList.add("text-danger");
    error = true;
  }
  if (error) {
    event.preventDefault();
  }
});
document.getElementById("l_user").addEventListener("focus", function (event) {
  if (this.value == "Champ obligatoire") this.value = "";
  this.classList.remove("text-danger");
});
document.getElementById("l_pass").addEventListener("focus", function (event) {
  if (this.value == "Champ obligatoire") this.value = "";
  this.classList.remove("text-danger");
});
document.getElementById("eye").addEventListener("click", function () {
  const show = document.querySelector("i");
  const passWord = document.getElementById("l_pass");
  if (show.classList.contains("fa-eye")) {
    show.classList.remove("fa-eye");
    show.classList.add("fa-eye-slash");
    passWord.type = "text";
  } else {
    show.classList.remove("fa-eye-slash");
    show.classList.add("fa-eye");
    passWord.type = "password";
  }
});
document.getElementById("l_pass").addEventListener("input", function () {
  const show = document.getElementById("eye");
  if (this.value.length > 0) {
    show.classList.remove("eye-not-active");
    show.classList.add("eye-active");
  } else {
    show.classList.remove("eye-active");
    show.classList.add("eye-not-active");
    document.querySelector("i").classList.remove("fa-eye-slash");
    document.querySelector("i").classList.add("fa-eye");
  }
});
