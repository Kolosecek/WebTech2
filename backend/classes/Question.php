<?php
require_once "Database.php";
require_once "Answer.php";

class Question {
    private $id;
    private $question;
    private $type;
    private $test_id;
    private $ucitel_email;


    public function getUcitelEmail()
    {
        return $this->ucitel_email;
    }



    public function getId()
    {
        return $this->id;
    }


    public function getQuestion()
    {
        return $this->question;
    }


    public function getType()
    {
        return $this->type;
    }


    public function getTestId()
    {
        return $this->test_id;
    }



    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE otazka SET question=? AND type=? AND test_id=? AND ucitel_email=? WHERE id=?");
        $stmt->execute([$this->question,$this->type,$this->test_id,$this->id,$this->ucitel_email]);
    }

    public function getRow(){
        $q = $this->getQuestion();
        $type = $this->getType();
        $string = "";
        $string = $string."<h3>Question: $q Type: $type</h3><div>";
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("SELECT * FROM odpoved WHERE question_id=?");
        $stmt->execute([$this->id]);
        $answers = $stmt->fetchAll(PDO::FETCH_CLASS, "Answer");
        foreach ($answers as $a){
            $string=$string.$a->getRow();
        }
        $string=$string."</div>";
        return $string;
    }

    public function getTableRowTemplate(){
        $q = $this->getQuestion();
        $type = $this->getType();
        $ID = $this->getId();
        return "<tr>
                <td>$q</td>
                <td>$type</td>
                <td><a class='btn btn-grad grow' href='question.php?id=$ID'>Open</td>
                </tr>";
    }
    public function getTableRowTest(){
        $q = $this->getQuestion();
        $type = $this->getType();
        $ID = $this->getId();
        $test_ID = $this->getTestId();
        return "<tr>
                <td>$ID</td>
                <td>$q</td>
                <td>$type</td>
                <td>$test_ID</td>
                <td><a class='btn btn-grad grow' href='question.php?id=$ID'>Open</td>
                </tr>";
    }
    public function duplicate($test_id){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO otazka (question,type,test_id,ucitel_email) VALUES (?,?,?,?)");
        $stmt->execute([$this->question,$this->type,$test_id,$this->ucitel_email]);
        return $conn->lastInsertId();
    }
}