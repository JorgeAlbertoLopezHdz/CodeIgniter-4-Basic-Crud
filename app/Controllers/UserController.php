<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use Exception;

class UserController extends BaseController
{


    public function index(): string
    {
        return view('users');
    }

    public function getUsers()
    {
        try {
            $db = db_connect();
            $users = $db->query("CALL get_all_users()")->getResult();

            return $this->response->setStatusCode(200)->setJSON([
                "success" => true,
                "message" => "Lista de usuarios.",
                "data" => $users
            ]);
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)->setJSON([
                "success" => false,
                "message" => "Ocurrió un error al solicitar la lista de usuarios.",
                "data" => null
            ]);
        }
    }

    public function create()
    {
        try {
            $user = $this->request->getPost();

            $rules = [
                'name' => 'required|max_length[50]',
                'email' => 'required|max_length[100]',
                'birthDate' => 'required',
                'roleId' => 'required',
                'status' => 'required',
            ];

            if (!$this->validateData($user, $rules)) {
                return $this->response->setStatusCode(400)->setJSON([
                    "success" => false,
                    "message" => $this->validator->getErrors(),
                    "data" => null
                ]);
            }

            $db = db_connect();
            $query = $db->query("CALL create_user(?, ?, ?, ?, ?)", [
                $user["name"], $user["email"], date("Y-m-d", strtotime($user["birthDate"])),
                $user["roleId"], $user["status"]
            ])->getResult();

            return $this->response->setStatusCode(201)->setJSON([
                "success" => true,
                "message" => "Usuario creado correctamente.",
                "data" => null
            ]);
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)->setJSON([
                "success" => false,
                "message" => "Ocurrió un error al crear al usuario.",
                "data" => null
            ]);
        }
    }

    public function read($id)
    {
        try {
            $db = db_connect();
            $query = $db->query("CALL get_user(?)", [$id])->getResult();

            if (empty($query)) {
                return $this->response->setStatusCode(404)->setJSON([
                    "success" => false,
                    "message" => "No se encontró al usuario solicitado.",
                    "data" => null
                ]);
            }

            return $this->response->setStatusCode(200)->setJSON([
                "success" => true,
                "message" => "Información del usuario solicitado.",
                "data" => $query[0]
            ]);
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)->setJSON([
                "success" => false,
                "message" => "Ocurrió un error al solicitar la información del usuario.",
                "data" => null
            ]);
        }
    }

    public function update($id)
    {
        try {
            $user = $this->request->getRawInput();

            $rules = [
                'name' => 'required|max_length[50]',
                'email' => 'required|max_length[100]',
                'birthDate' => 'required',
                'roleId' => 'required',
                'status' => 'required',
            ];

            if (!$this->validateData($user, $rules)) {
                return $this->response->setStatusCode(400)->setJSON([
                    "success" => false,
                    "message" => $this->validator->getErrors(),
                    "data" => null
                ]);
            }

            $db = db_connect();
            $query = $db->query(
                "CALL update_user(?, ?, ?, ?, ?, ?)",
                [
                    $id, $user["name"], $user["email"], date("Y-m-d", strtotime($user["birthDate"])),
                    $user["roleId"], $user["status"]
                ]
            )->getResult();

            return $this->response->setStatusCode(200)->setJSON([
                "success" => true,
                "message" => "Usuario actualizado correctamente",
                "data" => null
            ]);
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)->setJSON([
                "success" => false,
                "message" => "Ocurrió un error al actualizar al usuario.",
                "data" => null
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $db = db_connect();
            $query = $db->query("CALL delete_user(?)", [$id])->getResult();

            return $this->response->setStatusCode(200)->setJSON([
                "success" => true,
                "message" => "Usuario borrado correctamente.",
                "data" => null
            ]);
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)->setJSON([
                "success" => false,
                "message" => "Ocurrió un error al borrar al usuario.",
                "data" => null
            ]);
        }
    }
}
