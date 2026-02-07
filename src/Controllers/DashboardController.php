<?php

namespace ClassTest\Controllers;

use ClassTest\Models\Assessment;
use ClassTest\Database\Database;

class DashboardController {
    private $assessmentModel;
    private $db;
    
    public function __construct() {
        $this->assessmentModel = new Assessment();
        $this->db = Database::getInstance();
    }
    
    public function admin() {
        $stats = [
            'total_assessments' => $this->db->fetchOne("SELECT COUNT(*) as count FROM assessments")['count'],
            'published_assessments' => $this->db->fetchOne("SELECT COUNT(*) as count FROM assessments WHERE status = 'published'")['count'],
            'total_submissions' => $this->db->fetchOne("SELECT COUNT(*) as count FROM submissions WHERE status = 'submitted'")['count'],
            'total_students' => $this->db->fetchOne("SELECT COUNT(*) as count FROM users WHERE role = 'student'")['count']
        ];
        
        $recentAssessments = $this->assessmentModel->findAll();
        
        require __DIR__ . '/../Views/dashboard/admin.php';
    }
    
    public function student() {
        $assessments = $this->assessmentModel->getPublishedAssessments();
        require __DIR__ . '/../Views/dashboard/student.php';
    }
}
