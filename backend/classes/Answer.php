<?php
require_once "Database.php";
class Answer {
    private $id;
    private $text;
    private $correct;

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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE odpoved SET text=? AND correct=? WHERE id=?");
        $stmt->execute([$this->text,$this->correct,$this->id]);
    }
}