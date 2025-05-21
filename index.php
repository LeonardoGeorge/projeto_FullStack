<?php 
    require_once 'includes/config.php';
    $pageTitle = "Home | " . SITE_NAME;
    require_once 'includes/header.php';

    // Bucando os projetos no banco de dados
    $projetos = getProjects(3); 
?>

<section class="hero">
    <div class="hero-content">
        <h1>Bem-vindo ao <?php echo SITE_NAME; ?></h1>
        <p>Seu portal para projetos incríveis!</p>
        <a href="#projetos" class="btn">Ver Projetos</a>
        
    </div>
</section>



