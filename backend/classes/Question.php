<?php
require_once "Database.php";
require_once "Answer.php";

class Question {
    private $id;
    private $question;
    private $type;
    private $answer_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getAnswerId()
    {
        return $this->answer_id;
    }



    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE otazka SET question=? AND type=? AND answer_id=? WHERE id=?");
        $stmt->execute([$this->question,$this->type,$this->answer_id,$this->id]);
    }
}