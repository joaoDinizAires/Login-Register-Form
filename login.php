<?php 
    require_once("config/connection.php");
    include_once("config/processLR.php");
    include_once("templates/header.php");
?>
<body>
    <div class="login-box">
        <h2><i class="fas fa-user me-2" id="login-icon"></i></h2>
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
            <input type="hidden" name="acao" value="login">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Usuário" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3" id="btn-login"><i class="fas fa-sign-in-alt"></i></button>
        </form>
        <a class="btn btn-secondary" href="register.php" id="btn-signup"><i class="fas fa-user-plus me-2"></i>Cadastrar-se</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>