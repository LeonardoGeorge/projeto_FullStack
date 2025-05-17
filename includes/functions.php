<?php
/**
 * Funções úteis para o projeto Fullstack
 */

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($url) {
    header("Location: " . SITE_URL . '/' . $url);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getProjects($limit = null) {
    global $pdo;
    
    $sql = "SELECT * FROM projetos ORDER BY data_criacao DESC";
    if ($limit) {
        $sql .= " LIMIT :limit";
    }
    
    $stmt = $pdo->prepare($sql);
    
    if ($limit) {
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Verifica se o e-mail é válido
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Faz upload de arquivo
 */
function uploadFile($file, $destination) {
    $target_file = $destination . basename($file["name"]);
    
    // Verifica se é uma imagem real
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return ['success' => false, 'message' => 'Arquivo não é uma imagem.'];
    }
    
    // Verifica se o arquivo já existe
    if (file_exists($target_file)) {
        return ['success' => false, 'message' => 'Arquivo já existe.'];
    }
    
    // Verifica o tamanho do arquivo (5MB máximo)
    if ($file["size"] > 5000000) {
        return ['success' => false, 'message' => 'Arquivo muito grande. Máximo 5MB.'];
    }
    
    // Tenta fazer o upload
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['success' => true, 'file_path' => $target_file];
    } else {
        return ['success' => false, 'message' => 'Erro ao fazer upload.'];
    }
}
?>