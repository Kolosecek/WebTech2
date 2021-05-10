<?php

class Odpoved_student
{
    private $id;
    private $question_id;
    private $test_id;
    private $odpoved;
    private $img_path;
    private $text1;
    private $text2;
    private $correct;

    public function getId()
    {
        return $this->id;
    }


    public function getQuestionId()
    {
        return $this->question_id;
    }


    public function getTestId()
    {
        return $this->test_id;
    }


    public function getOdpoved()
    {
        return $this->odpoved;
    }


    public function getImgPath()
    {
        return $this->img_path;
    }


    public function getText1()
    {
        return $this->text1;
    }


    public function getText2()
    {
        return $this->text2;
    }


    public function getCorrect()
    {
        return $this->correct;
    }




}
