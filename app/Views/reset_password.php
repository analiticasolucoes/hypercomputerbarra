<!DOCTYPE html>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alterar Senha</title>
    <base href="https://hypercomputerbarra.com.br/">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<main class="container pt-3">
    <img class="mb-3" src="img/logo.webp" width="150" height="50" alt="logotipo hyper computer">
    <header class="text-center">
        <h2>Redefinir Senha</h2>
        <p class="lead">Utilize o formulário abaixo para cadastrar uma nova senha de acesso ao sistema.</p>
    </header>
    <form id="change-password-form-user" action="/reset_password/form" method="post" class="form-group d-flex row justify-content-center">
        <div class="col-12 py-1">
            <input type="text" id="token" name="token" value="<?php echo $_GET['token']; ?>" hidden>
        </div>
        <div class="col-8 py-1">
            <label class="form-label" for="new_password">Nova Senha:</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>
        <div class="col-8 py-1">
            <label class="form-label" for="confirm_password">Confirme a Nova Senha:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            <span id="erro-senha" style="color: red;"></span>
        </div>
        <div class="col-12 my-4 d-flex justify-content-center">
            <button class="btn btn-primary w-auto my-3" type="submit">Salvar</button>
        </div>
    </form>
</main>
</body>
</html>