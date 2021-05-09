<?php
require_once "Database.php";

class Ucitel {
    private $name;
    private $surname;
    private $email;
    private $password_hash;
    private $id;


    public function getName()
    {
        return $this->name;
    }


    public function getSurname()
    {
        return $this->surname;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE ucitel SET name=? AND surname=? AND email=? WHERE id=?");
        $stmt->execute([$this->name,$this->surname,$this->email,$this->id]);
    }

    public static function getStats($id, $email): string {

        //EXAMS
        $conn = (new database())->getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM `test` WHERE creator_id=?");
        $stmt->execute([$id]);
        $exams = $stmt->fetch();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM `test` WHERE creator_id=? AND isActive=1");
        $stmt->execute([$id]);
        $active_exams = $stmt->fetch();

        //QUESTIONS
        $stmt = $conn->prepare("SELECT COUNT(*) FROM `otazka` WHERE ucitel_email=?");
        $stmt->execute([$email]);
        $questions = $stmt->fetch();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM `otazka` WHERE ucitel_email=? AND type='short'");
        $stmt->execute([$email]);
        $short = $stmt->fetch();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM `otazka` WHERE ucitel_email=? AND type='multi'");
        $stmt->execute([$email]);
        $multi = $stmt->fetch();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM `otazka` WHERE ucitel_email=? AND type='draw'");
        $stmt->execute([$email]);
        $draw = $stmt->fetch();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM `otazka` WHERE ucitel_email=? AND type='math'");
        $stmt->execute([$email]);
        $math = $stmt->fetch();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM `otazka` WHERE ucitel_email=? AND type='compare'");
        $stmt->execute([$email]);
        $compare = $stmt->fetch();

        return "<div id='profileInfo'>                   
                    <div>
                        <h4>Exams</h4>
                        <p>All created: $exams[0]</p>
                        <p>Active: $active_exams[0]</p>
                    </div>
                    <div>
                        <h4>Questions</h4>
                        <p>All created: $questions[0]</p>
                        <p>Short: $short[0]</p>
                        <p>Multi: $multi[0]</p>
                        <p>Draw: $draw[0]</p>
                        <p>Math: $math[0]</p>
                        <p>Compare: $compare[0]</p>
                    </div>
                ";
    }
}