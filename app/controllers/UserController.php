<?php
require_once 'app/models/User.php';
require_once 'app/utils/index.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function getAll()
    {
        try {
            $data = $this->userModel->read();
            sendResponse([
                'success' => true,
                'data' => $data,
                'message' => 'Users retrieved successfully'
            ]);
        } catch (Exception $e) {
            sendResponse([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
            return;
        }
    }

    public function register($res)
    {
        try {
            $data = $this->userModel->create($res['name'], $res['email'], $res['password']);
            sendResponse([
                'success' => true,
                'message' => 'Register user',
                'data'    => $data
            ]);
        } catch (Exception $e) {
            sendResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 200); // ép status code = 200
        }
    }

    public function login($res)
    {
        try {
            $data = $this->userModel->login($res['email'], $res['password']);
            sendResponse([
                'success' => true,
                'message' => 'Login successfully',
                'data'    => $data
            ]);
        } catch (Exception $e) {
            sendResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
