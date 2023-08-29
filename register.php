<?php 
    require_once("config/connection.php");
    include_once("config/processLR.php");
    include_once("templates/header.php");
?>
<body>
    <div class="login-box">
        <h2><i class="fas fa-user-plus me-2" id="login-icon"></i></h2>
        <?php
        if(isset($_SESSION['errorMessage'])) {
            echo '<p class="alert alert-danger form-control" id="alert-message">' . $_SESSION['errorMessage'] . '</p>';
            unset($_SESSION['errorMessage']);
        }elseif(isset($_SESSION['successMessage'])){
            echo '<p class="alert alert-sucess form-control" id="success-message">' . $_SESSION['successMessage'] . '</p>';
            unset($_SESSION['successMessage']);
        }
        ?>
        <form action="config/processLR.php" method="post">
            <input type="hidden" name="acao" value="register">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nome de usuário" name="name" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="E-mail" name="email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Senha" name="password" required title="A senha deve conter pelo menos 8 caracteres e incluir letras maiúsculas, minúsculas, números e caracteres especiais.">
            </div>
            <div class="mb-3">
            <input type="password" class="form-control" placeholder="Confirme sua senha" name="confirmpassword" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3" id="btn-register">Registrar</button>
        </form>
        <a href="login.php" class="btn btn-secondary" id="btn-back"><i class="fas fa-arrow-left me-2"></i></a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>