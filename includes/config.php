<?php 
    // Configuração do banco de dados
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'projeto_FULLSTACK');

    // Configuração do site	
    define('SITE_NAME', 'Projeto Fullstack');
    define('SITE_EMAIL', 'leonardogeorge30@gmail.com');     
    define('SITE_URL', 'http://localhost/projeto_FULLSTACK');

    // Inicia a sessão
    session_start();    

    // Conexão com o banco de dados
    try {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES utf8');
    } catch (PDOException $e) {
        echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
        exit;
    }

    // inclui funções
    include_once 'functions.php';

?>