<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Alterar E-mail</title>
        <link rel="apple-touch-icon" sizes="180x180" href="../../favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../favicon/favicon-16x16.png">
        <link rel="manifest" href="../../favicon/site.webmanifest">
        <link rel="mask-icon" href="../../favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
<body>
    <main class="container pt-3">
        <header class="text-center">
            <h2>Alterar E-mail</h2>
            <p class="lead">Utilize o formulário abaixo para alterar o e-mail cadastrado.</p>
        </header>
        <form id="change-email-form-user" action="/user/change_email/form" method="post" class="form-group d-flex row">
            <div class="col-12 py-1">
                <label class="form-label" for="current_email">E-mail atual:</label>
                <input type="email" class="form-control" id="current_email" name="current_email" value="<?php echo $currentEmail; ?>" disabled>
            </div>
            <div class="col-12 py-1">
                <label class="form-label" for="new_email">Novo E-mail:</label>
                <input type="email" id="new_email" name="new_email" class="form-control" required>
            </div>
            <div class="col-12 py-1">
                <label class="form-label" for="confirm_email">Confirme o Novo E-mail:</label>
                <input type="email" id="confirm_email" name="confirm_email" class="form-control" required>
                <span id="erro-email" style="color: red;"></span>
            </div>
            <div class="col-12 my-4 d-flex justify-content-center">
                <a class="btn btn-outline-primary mx-4" href="/user/dashboard">Voltar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </main>
</body>
</html>