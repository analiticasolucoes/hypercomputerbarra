<?php
namespace App\Cronjobs;

require __DIR__ . '/../../autoload.php';
require __DIR__ . '/../../config/load_env.php';
require __DIR__ . '/../../config/db_connect.php';

use App\Repositories\ClienteRepository;
use App\Services\Email;
use \DateTime;

function happyBirthday()
{
    // Carrega as variáveis de ambiente
    loadEnv(__DIR__ . '/../../.env');

    $conn = dbConnect(); // Conecta ao banco de dados e retorna um objeto Database

    $today = new DateTime();

    $clienteRepository = new ClienteRepository($conn);

    $clienteList = $clienteRepository->all();

    foreach ($clienteList as $cliente) {
        $dataNascimento = DateTime::createFromFormat('d/m/Y', $cliente->getDataNascimento());

        if($dataNascimento->format('d/m') === $today->format('d/m')){
            $nome = ucwords(strtolower($cliente->getNome()));

            $email = new Email();

            $email->loadTemplateMessage(
                __DIR__ . "/../../app/Views/templates/aniversario.html",
                [
                    "cliente_nome" => $nome,
                ]);
            try {
                $email->sendEmail(
                    $cliente->getEmail(),
                    "Hyper Computer deseja a você um FELIZ ANIVERSÁRIO!"
                );
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
happyBirthday();