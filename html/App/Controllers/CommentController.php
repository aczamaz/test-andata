<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Utils\Response;

class CommentController extends BaseController
{
    use Response;

    private Comment $commentModel;
    
    public function __construct()
    {
        $this->commentModel = new Comment();
    }
    public function store(): string
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->commentModel->store($data);
        return $this->response($result,201);
    }
    public function get(): string
    {
        $result = $this->commentModel->get();
        return $this->response($result, 200);
    }
};