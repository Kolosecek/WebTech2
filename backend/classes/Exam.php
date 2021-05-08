<?php
require_once "Database.php";

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
        return "<tr>
                <th scope='row'>$ID</th>
                <td>$title</td>
                <td>$code</td>
                <td>$time</td>
                <td><a class='btn btn-grad grow' href='exam.php?id=$ID'>Open</td>
                </tr>";
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
            $newQ = $q->duplicate($id);
            $Qid = $q->getId();
            $stmt3 = $conn->prepare("SELECT * FROM odpoved WHERE question_id=?");
            $stmt3->execute([$Qid]);
            $anss = $stmt3->fetchAll(PDO::FETCH_CLASS, "Answer");
            foreach ($anss as $a) {
                $a->duplicate($newQ);
            }
        }
    }

    public static function showExamToStudent($exam, $questions) {

        $string = "<h1>Exam</h1><br>";
        $string .= ("<h3>Test id: {$exam->getId()}</h3><br>");
        $string .= ("<h3>Test code: {$exam->getTestCode()}</h3><br>");
        $string .= "<form method='POST' action='...' id='examID{$exam->getId()}' enctype='multipart/form-data'>";

        foreach ($questions as $index => $question) {
            $question_id = $question->getId();
            $number = $index + 1;
            if ($question->getType() === "math") {
                $string .= "<br><h1>$number. Question: </h1><br><h3>{$question->getQuestion()}</h3>";
            } else {
                $string .= "<br><h1>$number. Question: </h1><br><h3>{$question->getQuestion()}</h3>";
            }


            $conn = (new database())->getConnection();
            $stmt = $conn->prepare("SELECT * FROM odpoved where question_id=?");
            $stmt->execute([$question_id]);
            $answers = $stmt->fetchAll(PDO::FETCH_CLASS, "Answer");

            foreach ($answers as $indexes => $answer) {

                if ($question->getType() === "short") {
                    $string .= "<input type='text' id='short-answer' name='short-answer'>";

                } else if ($question->getType() === "multi") {
                    $string .= "
                        <input type='radio' id='answer$indexes' name='question$index' value='{$answer->getText()}'>
                        <label for='answer$indexes'>Male</label><br>";

                } else if ($question->getType() === "math") {
                    $string .= '<div style="font-size: 32px; margin: 3em; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);" id="mathfield" smart-mode>
                    </div>
                    <input style="display: none" name="latex" id="latex" type="text" value="" class="form-control">';

                } else if ($question->getType() === "compare") {
                    $string .= '<div class="container" id="compare-question" style="display:none;">compare question
                
                <div class="row">
                    <div class="col">
                        <ul>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
                        </ul>
                    </div>
                    <div class="col"> <ul id="sortable">
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
                        </ul>
                    </div>
                </div>
            </div>';
                } else if ($question->getType() === "draw") {
                    $string .= '
                    <div id="draw-question" style="display:none;">
                        <canvas id="canvas" width="400" height="400" style="border:2px solid;"></canvas>
                        <div>Choose Color</div>
                        <div id="green" style="width:10px;height:10px;background:green;" onclick="switchColor(this)"></div>
                        <div id="blue" style="width:10px;height:10px; background:blue;" onclick="switchColor(this)"></div>
                        <div id="red" style="width:10px;height:10px; background:red;" onclick="switchColor(this)"></div>
                        <div id="yellow" style="width:10px;height:10px; background:yellow;" onclick="switchColor(this)"></div>
                        <div id="orange" style="width:10px;height:10px; background:orange;" onclick="switchColor(this)"></div>
                        <div id="black" style="width:10px;height:10px; background:black;" onclick="switchColor(this)"></div>
                        <div>Eraser</div>
                        <div id="white" onclick="switchColor(this)"></div>
                        <img id="canvasimg" style="display:none;">
                        <input type="button" value="clear" id="clr" size="23" onclick="erase()">
                        <button type="button" onclick="saveDrawing()">Save drawing</button>
                    </div>';
                }
                $string .= "<br>";
            }
        }

        $string .= ("<input type='submit' value='Submit completed exam' class='btn btn-primary'>" . "</form>");
        return $string;
    }
}