<?php
namespace load\controllers;
    class Jobs { 
        private $jobsconnect;

        public function __construct($jobsconnect) {
        $this-> jobsconnect = $jobsconnect;
    }

    public function jobscareers() {
        $jobs = $this->jobsconnect->findAll();
        return [
            'template' => 'jobscareers.html.php',
            'variables' => ['jobs' => $jobs],
            'title' => 'Careers',
            'class' => 'jobs'
        ];
    }
    public function about(){
        return[
        'template' => 'about.html.php',
        'variables' => [''], 
        'title' => 'jos jobs- About',
        'class' => 'about'
        ];
    }
    
    public function managecareers() {
        $jobs = $this->jobsconnect->findAll();
        if(isset($_SESSION['loggedin'])) {
            return [
                'template' => 'managecareers.html.php',
                'variables' => ['jobs' => $jobs],
                'title' => 'jos jobs - Manage Careers',
                'class' => 'admin'
            ];
        }
        else {
            return [
                'template' => 'loginerror.html.php',
                'variables' => [''],
                'title' => 'jos jobs - Login Error',
                'class' => 'admin'
            ];
        }
    }

    public function deletejobpostingSubmit() {
        $jobs = $this ->jobsconnect->delete($_POST['id']);

        return [
            'template' => 'delete.html.php',
            'variables' => ['jobs' => $jobs],
            'title' => 'jos jobs - Deleted Successfully',
            'class' => 'admin'
        ];
    }

    public function editaddjobsSubmit() {

        if(isset($_POST['submit'])) {
            $jobs = $_POST['jobs'];
            
            if ($jobs['id'] == '') {
                $jobs['id'] = null;
            }

            $this->jobsconnect->save($jobs);
            return [
                'template' => 'edit.html.php',
                'variables' => ['jobs' => $jobs],
                'title' => 'jos jobs - Edit and Add Jobs',
                'class' => 'admin'
            ];

        }
    }

    public function editaddjobs() {
        if(isset($_GET['id'])) {
            $find = $this->jobsconnect->find('id', $_GET['id']);

            $jobs = $find[0];
        }

        else {
            $jobs = false;
        }

        return [
            'template' => 'editaddjobs.html.php',
            'variables' => ['jobs' => $jobs],
            'title' => 'jos jobs - Edit and Add Jobs',
            'class' => 'admin'
        ];
    }
}
?>
