<?php
require_once "Database.php";
class Exam {
    private $id;
    private $creator_id;
    private $question_id;
    private $student_name;
    private $time;
    private $isActive;
    private $result;
    private $student_id;
    private $test_code;

    /**
     * Exam constructor.
     * @param $creator_id
     * @param $test_code
     */
    public function __construct($creator_id, $test_code)
    {
        $this->creator_id = $creator_id;
        $this->test_code = $test_code;
        $this->isActive = false;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getCreatorId()
    {
        return $this->creator_id;
    }


    public function getQuestionId()
    {
        return $this->question_id;
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

    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE test SET creator_id=? AND question_id=? AND student_name=? AND time=? AND isActive=? 
        AND result=? AND student_id=? AND test_code=? WHERE id=?");
        $stmt->execute([$this->creator_id,$this->question_id,$this->student_name,$this->time,$this->isActive,$this->result,$this->student_id,$this->test_code,$this->id]);
    }
}