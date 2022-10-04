<?php

namespace App\Repositories;

class QuizRepository
{
    private $pathToQuizList = null;
    // private $quizList = [];
    private $quizData = [];

    public function __construct()
    {
        $this->pathToQuizList = sprintf('%s', ROOT_PATH . $_ENV['QUIZZ_LISTNAMES_PATH']);
    }

    public function __destruct()
    {
        
    }

    private function getDataFromJsonFile(string $filePath) : array
    {
        return json_decode(file_get_contents($filePath), true);
    }

    public function getQuizList() : ?array
    {   
        $result = [];

        if ($this->pathToQuizList) {
            $result = $this->getDataFromJsonFile($this->pathToQuizList);
        }

        return $result;
    }

    public function setQuizData(string $quizName, bool $setFromSession = false) : void
    {      
        if ($setFromSession) {
            // $this->quizData = $_SESSION[''];
        } else {
            $quizFilePath = sprintf('%s%s%s.json', ROOT_PATH, $_ENV['QUIZZ_QUESTIONS_PATH'], $quizName);

            $this->quizData = $this->getDataFromJsonFile($quizFilePath);
            $this->quizData['quizFilename'] = $quizName;
            $this->quizData['totalQCount'] = count($this->quizData['questions']);
        }
    }

    public function getQuizData() : array
    {
        return $this->quizData;
    }
}