<?php
require_once "Database.php";
require_once "Answer.php";

class Question {
    private $id;
    private $question;
    private $type;
    private $test_id;


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
    public function getTestId()
    {
        return $this->test_id;
    }



    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE otazka SET question=? AND type=? AND test_id=? WHERE id=?");
        $stmt->execute([$this->question,$this->type,$this->test_id,$this->id]);
    }

    public function getRow(){
        $q = $this->getQuestion();
        $type = $this->getType();
        $string = "";
        $string = $string."<h1>Question: $q Type: $type</h1><div>";
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
                <td><a class='btn btn-secondary' href='question.php?id=$ID'>Open</td>
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
                <td><a class='btn btn-secondary' href='question.php?id=$ID'>Open</td>
                </tr>";
    }
}