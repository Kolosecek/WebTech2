<?php
require_once "Database.php";
require_once "Question.php";
require_once "Answer.php";
require_once "Drag.php";
require_once "Odpoved_student.php";

class Exam
{
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


    public function update()
    {
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE test SET creator_id=? AND student_name=? AND time=? AND isActive=? 
        AND result=? AND student_id=? AND test_code=? AND title=? WHERE id=?");
        $stmt->execute([$this->creator_id, $this->student_name, $this->time, $this->isActive, $this->result, $this->student_id, $this->test_code, $this->title, $this->id]);
    }

    public function getRow()
    {
        $title = $this->getTitle();
        $time = $this->getTime();
        $ID = $this->getId();
        $code = $this->getTestCode();
        $bool = $this->getIsActive();
        if ($bool == "1") {
            return "<tr>
                <th scope='row'>$ID</th>
                <td>$title</td>
                <td>$code</td>
                <td>$time</td>
                <td><a class='btn btn-grad grow' href='teacher_active_exam.php?id=$ID'>Open</a></td>
                </tr>";
        } else {
                return "<tr>
                <th scope='row'>$ID</th>
                <td>$title</td>
                <td>$code</td>
                <td>$time</td>
                <td><a class='btn btn-grad grow' href='exam.php?id=$ID'>Open</a></td>
                </tr>";
        }
    }

    public function duplicate($test_code, $student_name, $student_id){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO test (creator_id,student_name,time,isActive,result,student_id,test_code,title)
                                          VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$this->creator_id, $student_name, $this->time, 0, null, $student_id, $test_code, $this->title]);
        $id = $conn->lastInsertId();
        $stmt2 = $conn->prepare("SELECT * FROM otazka WHERE test_id=?");
        $stmt2->execute([$this->id]);
        $questions = $stmt2->fetchAll(PDO::FETCH_CLASS, "Question");
        foreach ($questions as $q) {
            if($q->getType() != "draw" && $q->getType() != "math"){
                $q->duplicate($id);
            }
        }
        return $id;

    }

    public static function showExamToTeacher($exam, $questions): string {

        $exam_ID = $exam->getId();
        $string = "<div id='student_active_exam'><h1>Exam</h1>";
        $string .= ("<h3>Test id: {$exam->getId()}</h3>");
        $string .= ("<h3>Test code: {$exam->getTestCode()}</h3>");
        $string .= "<form method='POST' action='...' id='examID{$exam->getId()}' enctype='multipart/form-data'>";

        foreach ($questions as $index => $question) {
            $number = $index + 1;

            $q_ID = $question->getId();
            $conn = (new Database())->getConnection();

            if ($question->getType() === "short") {
                $stmt = $conn->prepare("SELECT * FROM odpoved WHERE question_id=? AND correct=1");
                $stmt->execute([$q_ID]);
                $correct_answer = $stmt->fetchAll(PDO::FETCH_CLASS, "Answer");

                $stmt = $conn->prepare("SELECT * FROM odpoved_student WHERE question_id=? AND test_id=?");
                $stmt->execute([$q_ID, $exam_ID]);
                $student_answer = $stmt->fetchAll(PDO::FETCH_CLASS, "Odpoved_student");


                $string .= "<h1>$number. Short question: </h1><h3>{$question->getQuestion()}</h3>";
                $string .= "<p>Students answer: {$student_answer[0]->getOdpoved()}</p>";
                $string .= "<p>Correct answer: {$correct_answer[0]->getText()}</p>";
            } else if ($question->getType() === "multi") {
                $string .= "<br><h1>$number. Multi question: </h1><br><h3>{$question->getQuestion()}</h3>";
                $string .= "<p>Students answer:</p>";
                $string .= "<p>TU IDE SPRAVNA ODPOVED.</p>";
            } else if ($question->getType() === "math") {
                $string .= "<br><h1>$number. Math question: </h1><br><math-field read-only '>{$question->getQuestion()}</math-field>";
                $string .= "<p></p>";
                $string .= "<p>TU IDE SPRAVNA ODPOVED.</p>";
            } else if ($question->getType() === "compare") {
                $string .= "<br><h1>$number. Compare question: </h1><br><h3>{$question->getQuestion()}</h3>";
                $string .= "<p>TU IDE AKE STUDENT ZOVLIL PORADIE</p>";
                $string .= "<p>TU IDE SPRAVNE PORADIE</p>";
            } else if ($question->getType() === "draw") {
                $string .= "<br><h1>$number. Draw question: </h1><br><h3>{$question->getQuestion()}</h3>";
                $string .= "<p>TU IDE STUDENTOV OBRAZOK</p>s";
                $string .= "<p>TU IDE CHECKBOX KTORYM UCITEL PRIDELI BODY ZA OBRAZOK</p>";
            }
            $string .= "<br>";
        }
        $string .= "<input value='Submit completed exam' class='btn btn-primary' onclick='result()'></form></div>";
        return $string;
    }

    //STUDENT
    //STUDENT
    //STUDENT

    public static function showExamToStudent($exam, $questions): string {

        $string = "<div id='student_active_exam'>";
        $string .= ("<div id='activeExamInfo'><div style='display: flex; flex-direction: row'><h3 style='text-align: center; font-weight: bold; margin-right: 5px'># </h3><h3 style='text-align: center'>Test id: {$exam->getId()}</h3></div>");
        $string .= ("<div style='display: flex; flex-direction: row'><i class='fas fa-key fa-lg'></i><h3 style='text-align: center'>Test code: {$exam->getTestCode()}</h3></div></div>");
        $string .= "<div id='activeExamFormWrapper'><form method='POST' action='student_active_exam.php?id={$exam->getId()}' id='exam' enctype='multipart/form-data' style='width: 100%'>";

        foreach ($questions as $index => $question)
        {
            $qId = $question->getId();
            $number = $index + 1;

            // SHORT
            if ($question->getType() === "short")
            {
                $string .= "<div class='oneQuestionWrapper'><h1>$number. Short question: </h1><h3>{$question->getQuestion()}</h3>";
                $string .= "<input ansId='$qId' type='text' id='short-answer' name='short-answer'></div>";
            }

            // MULTI CHOICE
            else if ($question->getType() === "multi")
            {
                $string .= "<div class='oneQuestionWrapper'><h1>$number. Multi question: </h1><h3>{$question->getQuestion()}</h3>";

                $conn = (new Database())->getConnection();
                $stmt = $conn->prepare("SELECT * FROM odpoved WHERE question_id=?");
                $stmt->execute([$qId]);
                $answers = $stmt->fetchAll(PDO::FETCH_CLASS, "Answer");

                foreach ($answers as $indexes => $answer)
                {
                    $i = $indexes + 1;
                    $string .= "<div>
                                    <input ansId='$qId' type='radio' id='answer$i' name='question$index' value='{$answer->getText()}'>
                                    <label for='answer$i'>{$answer->getText()}</label>
                                </div>";
                }
                $string .= "</div>";
            }

            // MATH
            else if ($question->getType() === "math")
            {
                $string .= "<div class='oneQuestionWrapper'><h1>$number. Math question: </h1><br><math-field read-only '>{$question->getQuestion()}</math-field>";
                $string .= "<div ansId=$qId style='font-size: 32px; margin: 3em; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);' id='mathfield' smart-mode></div>";
                $string .= "</div>";
            }

            // COMPARE
            else if ($question->getType() === "compare")
            {
                $conn = (new Database())->getConnection();
                $stmt = $conn->prepare("SELECT * FROM drag WHERE question_id=?");
                $stmt->execute([$qId]);
                $answers = $stmt->fetchAll(PDO::FETCH_CLASS, "Drag");
                $string .= "<div class='oneQuestionWrapper'><h1>$number. Compare question: </h1><br><h3>{$question->getQuestion()}</h3>";
                $string .=" 
                    <div class='container' id='compare-question'>
                        <div class='row'>
                            <div class='col'>
                                <ul>";
                                    foreach ($answers as $answer)
                                    {
                                        $text1=$answer->getText1();
                                        $string .="<li class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>$text1</li>";
                                    }
                                    $string .="
                                </ul>
                            </div>
                            <div class='col'>
                                <ul id='sortable'>";
                                    foreach ($answers as $answer)
                                    {
                                        $text2=$answer->getText2();
                                        $string .="<li class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>$text2</li>";
                                    }
                                    $string .="
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>";

            }

            // DRAW
            else if ($question->getType() === "draw")
            {
                $tId = $exam->getId();
                $string .= "<div class='oneQuestionWrapper'><h1>$number. Draw question: </h1><br><h3>{$question->getQuestion()}</h3>";
                $string .= "
                <div id='draw-question'>
                    <canvas id='canvas' width='400' height='400' style='border:2px solid;'></canvas>
                    <div>Choose Color</div>
                    <div id='green' style='width:10px;height:10px;background:green;' onclick='switchColor(this)'></div>
                    <div id='blue' style='width:10px;height:10px; background:blue;' onclick='switchColor(this)'></div>
                    <div id='red' style='width:10px;height:10px; background:red;' onclick='switchColor(this)'></div>
                    <div id='yellow' style='width:10px;height:10px; background:yellow;' onclick='switchColor(this)'></div>
                    <div id='orange' style='width:10px;height:10px; background:orange;' onclick='switchColor(this)'></div>
                    <div id='black' style='width:10px;height:10px; background:black;' onclick='switchColor(this)'></div>
                    <div>Eraser</div>
                    <div id='white' onclick='switchColor(this)'></div>
                    <img id='canvasimg'>
                    <input type='button' value='clear' id='clr' size='23' onclick='erase()'>
                    <button type='button' tID='$tId' qID='$qId'>Save drawing</button>
                    <img src='' tID='$tId' qID='$qId' alt=''>
                </div>
                 </div>";
            }
            $string .= "<br>";
        }
        $string .= "<div style='display: flex; justify-content: center; align-content: center'><button type='submit' class='btn btn-grad'>Submit completed exam</button></form></div></div></div>";
        return $string;
    }
}