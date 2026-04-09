<nav class="navbar navbar-expand-lg bg-areia px-3">
<div class="container">
 
    <!-- LOGO -->
<a  href="<?php echo $base_url . 'index.php'?>"><img src="<?php echo $base_url ?>assets/img/logo.png" height="28"></a>  
 
    <!-- BOTÃO MOBILE -->
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>
 
    <!-- MENU -->
<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
<ul class="navbar-nav ms-auto mb-1 ms-lg-3 gap-4">
<li class="nav-item"><a class="nav-link" href="<?php echo $base_url . '#sobre' ?>">Sobre Nós</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base_url . '#aula' ?>">Aulas</a></li>
<li class="nav-item"><a class="nav-link" href="#contactos">Contactos</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base_url . 'pages/nav_horariopreco.php#title' ?>">Horários</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base_url . 'pages/nav_horariopreco.php#titlep' ?>">Preços</a></li>
</ul>
 
      <!-- BOTÃO + PERFIL -->
<div class="d-flex align-items-center ms-lg-5 gap-3">
<a type="button" class="btn btn-azul-outline btn-sm px-3" href="<?php echo $base_url . 'auth/nav_inscrever.php' ?>">Inscrever</a>
<a type="button" href="<?php echo $base_url . 'auth/nav_acessar.php' ?>"><img src="<?php echo $base_url ?>assets/img/perfil.png" height="28" class="rounded-rectangle perfil" ></a>
</div>
</div>
</div>
</nav>
 