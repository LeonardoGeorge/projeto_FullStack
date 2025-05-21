<?php
require_once '../includes/config.php';

if (isLoggedIn()) {
    redirect('admin/dashboard.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizeInput($_POST['email']);
    $senha = sanitizeInput($_POST['senha']);
    
    // Busca usuário no banco
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nome'];
        $_SESSION['user_email'] = $usuario['email'];
        redirect('admin/dashboard.php');
    } else {
        $error = "E-mail ou senha incorretos!";
    }
}

$pageTitle = "Login";
require_once '../includes/header.php';
?>

<div class="login-container">
    <div class="login-form">
        <h2>Acesso Administrativo</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>