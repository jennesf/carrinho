<?php
// Inicializa $nome e $email com valores padrão
$nome = '';
$email = '';

// Verifica se a sessão de 'nomeusuario' e 'email' estão definidas
$nome = isset($_SESSION['nomeusuario']) ? $_SESSION['nomeusuario'] : $nome;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu do Usuário</title>
    <link rel="stylesheet" href="../css/Menu.css">
</head>
<body>
    <div class="menu">
        <div class="user-info dropdown">
            <div class="user-photo">
                <img src="../img/logo.jpeg" alt="Foto do Usuário">
            </div>
            <div class="user-name"><?php echo htmlspecialchars($nome); ?></div>
            <div class="dropdown-content">
                <form id="inicioForm" action="index.php" method="post" style="display: none;">
                    <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                    <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($nome); ?>">
                </form>
                <form id="adminForm" action="admin.php" method="post" style="display: none;">
                    <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                    <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($nome); ?>">
                </form>

                <!-- Verifica se o e-mail corresponde ao do admin -->
                <?php if ($email === 'abc@ifsp.edu.br'): ?>
                    <a class="dropdown-item" href="#" onclick="enviarParaAdmin();">Admin</a>
                <?php endif; ?>

                <a class="dropdown-item" href="#" onclick="logout();">Sair</a>
            </div>
        </div>
    </div>
    <script>
        function enviarParaAdmin() {
            document.getElementById('adminForm').submit();
        }

        function logout() {
            window.location.href = 'logout.php'; // Redireciona para a página de logout
        }
    </script>
</body>
</html>
