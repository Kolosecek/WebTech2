<?php
require_once "Database.php";

class Exam {
    private $id;
    private $title;
    private $creator_id;
    private $student_name;
    private $time;
    private $isActive;
    private $result;
    private $student_id;
    private $test_code;


    public function getId()
    {
        return $this->id;
    }


    public function getCreatorId()
    {
        return $this->creator_id;
    }


    public function getStudentName()
    {
        return $this->student_name;
    }


    public function getTime()
    {
        return $this->time;
    }


    public function getIsActive()
    {
        return $this->isActive;
    }


    public function getResult()
    {
        return $this->result;
    }


    public function getStudentId()
    {
        return $this->student_id;
    }


    public function getTestCode()
    {
        return $this->test_code;
    }

    public function getTitle()
    {
        return $this->title;
    }



    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE test SET creator_id=? AND student_name=? AND time=? AND isActive=? 
        AND result=? AND student_id=? AND test_code=? AND title=? WHERE id=?");
        $stmt->execute([$this->creator_id,$this->student_name,$this->time,$this->isActive,$this->result,$this->student_id,$this->test_code,$this->title,$this->id]);
    }

    public function getRow(){
        $title = $this->getTitle();
        $time = $this->getTime();
        $ID = $this->getId();
        $code = $this->getTestCode();
        return "<tr>
                <th scope='row'>$ID</th>
                <td>$title</td>
                <td>$code</td>
                <td>$time</td>
                <td><a class='btn btn-secondary' href='exam.php?id=$ID'>Open</td>
                </tr>";
    }
}