<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Utils\Response;
use Rakit\Validation\Validator;

class CommentController extends BaseController
{
    use Response;

    private Comment $commentModel;
    private Validator $validator;

    public function __construct()
    {
        $this->commentModel = new Comment();
        $this->validator = new Validator;
    }
    public function store(): string
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $validation = $this->validator->make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'text' => 'required',
        ]);

        $validation->validate();
        
        if ($validation->fails()) {
            $errors = $validation->errors();
            return $this->response($errors->firstOfAll(), 400, false);
        } else {
            $result = $this->commentModel->store($data);
            return $this->response($result,201);
        }
    }
    public function get(): string
    {
        $result = $this->commentModel->get();
        return $this->response($result, 200);
    }
};