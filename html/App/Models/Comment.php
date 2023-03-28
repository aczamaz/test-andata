<?php
namespace App\Models;

class Comment extends BaseModel 
{
    public function store(array $values): mixed
    {
        $id = $this->start()->insertInto('comments')->values($values)->execute();
        if($id !== 0)
            return $this->start()->from('comments',$id)->fetch();
        else
            return false;
    }
    public function get(): mixed
    {
        return $this->start()->from('comments')->fetchAll();
    }
}