<?php

namespace ClassTest\Controllers;

use ClassTest\Models\Submission;
use ClassTest\Models\Assessment;
use ClassTest\Models\Section;
use ClassTest\Models\Question;
use ClassTest\Helpers\Auth;
use ClassTest\Helpers\ExportHelper;

class SubmissionController {
    private $submissionModel;
    private $assessmentModel;
    private $sectionModel;
    private $questionModel;
    
    public function __construct() {
        $this->submissionModel = new Submission();
        $this->assessmentModel = new Assessment();
        $this->sectionModel = new Section();
        $this->questionModel = new Question();
    }
    
    public function show($id) {
        $submission = $this->submissionModel->findById($id);
        $assessment = $this->assessmentModel->findById($submission['assessment_id']);
        $sections = $this->sectionModel->findByAssessment($assessment['id']);
        
        foreach ($sections as &$section) {
            $section['questions'] = $this->questionModel->findBySection($section['id']);
        }
        
        require __DIR__ . '/../Views/submissions/take.php';
    }
    
    public function saveAnswer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $submissionId = $_POST['submission_id'];
            $questionId = $_POST['question_id'];
            $answer = $_POST['answer'];
            
            $this->submissionModel->saveAnswer($submissionId, $questionId, $answer);
            
            echo json_encode(['success' => true]);
        }
    }
    
    public function submit($id) {
        $this->submissionModel->submit($id);
        header("Location: /submission/result/$id");
        exit;
    }
    
    public function result($id) {
        $submission = $this->submissionModel->findById($id);
        $answers = $this->submissionModel->getAnswers($id);
        
        require __DIR__ . '/../Views/submissions/result.php';
    }
    
    public function results($assessmentId) {
        $assessment = $this->assessmentModel->findById($assessmentId);
        $submissions = $this->submissionModel->findByAssessment($assessmentId);
        $stats = $this->submissionModel->getStats($assessmentId);
        
        require __DIR__ . '/../Views/results/index.php';
    }
    
    public function exportResults($assessmentId) {
        $submissions = $this->submissionModel->findByAssessment($assessmentId);
        $assessment = $this->assessmentModel->findById($assessmentId);
        
        $data = [];
        foreach ($submissions as $submission) {
            $data[] = [
                'Student Name' => $submission['user_name'],
                'Email' => $submission['user_email'],
                'Score' => $submission['score'],
                'Total Marks' => $submission['total_marks'],
                'Percentage' => round(($submission['score'] / $submission['total_marks']) * 100, 2) . '%',
                'Submitted At' => $submission['submitted_at']
            ];
        }
        
        ExportHelper::toCSV($data, $assessment['title'] . '_results.csv');
    }
}
