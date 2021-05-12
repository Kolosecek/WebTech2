<?php
require_once "Database.php";

class Drag {
    private $id;
    private $question_id;
    private $text1;
    private $text2;


    public function getId()
    {
        return $this->id;
    }


    public function getQuestionId()
    {
        return $this->question_id;
    }


    public function getText1()
    {
        return $this->text1;
    }


    public function getText2()
    {
        return $this->text2;
    }


    public function update() {
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE drag SET question_id=? AND text1=? AND text2=? WHERE id=?");
        $stmt->execute([$this->question_id,$this->text1,$this->text2,$this->id]);
    }

    public function duplicate($q_id){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO drag (question_id,text1,text2) VALUES (?,?,?)");
        $stmt->execute([$q_id,$this->text1,$this->text2]);
    }
}