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
        $data = $this->userModel->getAll();
        sendResponse([
            'success' => true,
            'data' => $data,
            'message' => 'Users retrieved successfully'
        ]);
    }
}
