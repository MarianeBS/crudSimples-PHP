<?php

namespace App;

require "../vendor/autoload.php";

use App\Model\Client;
use App\Model\Mega;
use App\Repository\ClientRepository;
use App\Repository\MegaRepository;

//***** HEADERS *****//
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//***** END HEADERS *****//

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

//***** ROUTE CONTROL *****//
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->action)) {
            switch ($data->action) {
                case 'registerClient':
                    registerClient($data);
                    break;

                case 'updateClient':
                    updateClient($data);
                    break;

                case 'deleteClient':
                    deleteClient($data);
                    break;
            }

            return;
        }

        registerMega($data);

        break;
    case 'GET':
        if(isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'listClients':
                    listClients();
                    break;
                case 'findClientById': {
                    findClientById($_GET);
                    break;
                }
            }
            return;
        }

        getMega($_GET);
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido."]);

        break;
}
//***** END ROUTE CONTROL *****//

//***** METHODS *****//
function getMega($request) {
    $mega       = new Mega();
    $repository = new MegaRepository();

    if (isset($request['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id === false) {
                http_response_code(400);
                echo json_encode(['error' => 'O valor do ID fornecido não é um inteiro válido.']);

                exit;
            } else {
                $mega       = new Mega();
                $repository = new MegaRepository();

                $mega->setId($id);
                $result = $repository->getById($mega);
            }
    } else {
        $result = $repository->getAll();
    }

    if ($result) {
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Nenhum dado encontrado."]);
    }
}

function registerMega($data) {
    if (!isValid($data)) {
        http_response_code(400);
        echo json_encode(["error" => "Dados de entrada inválidos."]);
        exit;
    }

    $mega = new Mega();

    $mega->setNum1(intval($data->num1))
    ->setNum2(intval($data->num2))
    ->setNum3(intval($data->num3))
    ->setNum4(intval($data->num4))
    ->setNum5(intval($data->num5))
    ->setNum6(intval($data->num6));

    $repository = new MegaRepository();
    $success = $repository->insertMega($mega);
    if ($success) {
        http_response_code(200);
        echo json_encode(["message" => "Dados inseridos com sucesso."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Falha ao inserir dados."]);
    }
}

function registerClient($data) {
    $client = new Client(
        $data->name,
        $data->email,
        $data->city,
        $data->state
    );

    $repository = new ClientRepository();
    $success = $repository->create($client);

    if ($success) {
        http_response_code(200);
        echo json_encode(["message" => "Cliente cadastrado com sucesso."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Falha ao cadastrar cliente."]);
    }

}

function updateClient($data) {
    $client = new Client(
        $data->name,
        $data->email,
        $data->city,
        $data->state
    );

    $client->setId($data->id);

    $repository = new ClientRepository();
    $success = $repository->update($client);

    if ($success) {
        http_response_code(200);
        echo json_encode(["message" => "Cliente atualizado com sucesso."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Falha ao atualizar cliente."]);
    }
}

function listClients() {
    $repository = new ClientRepository();
    $result = $repository->getAll();

    if ($result) {
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Nenhum dado encontrado."]);
    }
}

function findClientById($request) {
    $client = new Client();
    $client->setId($request['id']);

    $repository = new ClientRepository();
    $result = $repository->getById($client);

    if ($result) {
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Nenhum dado encontrado."]);
    }
}

function deleteClient($data) {
    $client = new Client();

    $client->setId(intval($data->id));

    $repository = new ClientRepository();
    $success = $repository->delete($client);

    if ($success) {
        http_response_code(200);
        echo json_encode(["message" => "Cliente deletado com sucesso."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Falha ao deletar cliente."]);
    }
}

function isValid($data) {
    $requiredFields = ['num1', 'num2', 'num3', 'num4', 'num5', 'num6'];
    foreach ($requiredFields as $field) {
        if (!isset($data->$field) || !is_numeric($data->$field)) {
            return false;
        }
    }
    return true;
}
//***** END METHODS *****//