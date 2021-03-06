<?php
require_once "Database.php";

class Answer {
    private $id;
    private $text;
    private $correct;
    private $question_id;


    public function getId()
    {
        return $this->id;
    }


    public function getText()
    {
        return $this->text;
    }


    public function getCorrect()
    {
        return $this->correct;
    }


    public function getQuestionId()
    {
        return $this->question_id;
    }



    public function update() {
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE odpoved SET text=? AND correct=? AND question_id=? WHERE id=?");
        $stmt->execute([$this->text,$this->correct,$this->question_id,$this->id]);
    }

    public function getRow() {
        $t = $this->getText();
        $id = $this->getId();
        return "<span>$t </span><div style='display: flex; justify-content: flex-end; flex-grow: 3; align-items: center;'><a class='fas fa-trash-alt grow' ansID='$id' style='margin-left: 20px; cursor: pointer; color: white'></a></div>";
    }

    public function duplicate($q_id) {
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES ($this->text,$this->correct,$q_id)");
        $stmt->execute();
        return $conn->lastInsertId();
    }
}