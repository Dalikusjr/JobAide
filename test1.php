<?php
$success = true; // Exemple : définir cette variable quand le popup doit s'afficher
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Popup Personnalisé</title>
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous" />
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<style>
#popup {
  position: fixed;
  top: 80px;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1050;
  display: none;
}

@keyframes fadeIn {
  from {opacity: 0; transform: translate(-50%, -60%);}
  to {opacity: 1; transform: translate(-50%, -50%);}
}

@keyframes fadeOut {
  from {opacity: 1; transform: translate(-50%, -50%);}
  to {opacity: 0; transform: translate(-50%, -60%);}
}

</style>
</head>
<body>
    <?php if(isset($success)&&$success):?>
    <div id="popup" class="card ">
  <div class="card-body">
    <p>Ceci est un popup personnalisé.</p>
  </div>
</div>
<?php endif;?>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam nesciunt, in deleniti nobis similique maxime magni dolor sunt, vel nostrum doloribus, rerum non repellat laboriosam debitis nulla excepturi tempora vero.
    
    
    <script>
 
</script>
</body>
</html>