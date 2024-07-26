<?php
namespace load\controllers;
    class News { 
        private $newsconnect;

        public function __construct($newsconnect) {
        $this-> newsconnect = $newsconnect;
        }

        /*Using this function, you may locate every article in the news table. The articles are arranged descendingly, with the most recent one at the top.
 */

        //the items are returned to the main page.

        public function news() {
            $news = $this->newsconnect->findAllDESC('id');
            return [
                'template' => 'news.html.php',
                'variables' => ['news' => $news],
                'title' => 'jos jobs - Home',
                'class' => 'home'
            ];
        }

        /*This feature extracts all the data from the manage news page in the admin hub so that administrators may make changes to them.
 */

        /*The manage news page containing the articles is returned if the user is signed in.
        If not, the user is prompted to log in and sees a login error.  
*/
        public function managenews() {
            $news = $this->newsconnect->findAllDESC('id');
            if(isset($_SESSION['loggedin'])) {
                return [
                    'template' => 'managenews.html.php',
                    'variables' => ['news' => $news],
                    'title' => 'jos jobs - Manage News',
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

        /*This deletes the news article by using the ID from the record when it is called. 
        In order to provide the user with a visual cue that the article has been removed, the deletion page is restored. 
*/
        public function deletenewsarticleSubmit() {
            $news = $this ->newsconnect->delete($_POST['id']);
     
            return [
                'template' => 'delete.html.php',
                'variables' => ['news' => $news],
                'title' => 'jos jobs - Deleted Successfully',
                'class' => 'admin'
            ];
        
        }

        /*A new time is established on the add or update page when the submit button is pushed, and this date is then given to the dateposted property of the table.
        The username that was assigned during the login process is where the author attribute is obtained.
        These are utilised to obtain the page's author and date.
*/
        public function editaddnewsSubmit() {

            if(isset($_POST['submit'])) {
                
                $news = $_POST['news'];
                $date = new \DateTime();
			    $news['dateposted'] = $date->format('Y-m-d H:i:s');
                $news['author'] = $_SESSION['username'];

                //if there is no id then set the value to null
                if ($news['id'] == '') {
                    $news['id'] = null;
                }
    
                $this->newsconnect->save($news);

                //When an image is added, the record's id is used together with the.jpg image extension.
 
                //The file name is then appended, and the image is subsequently placed to the articles photo directory.

                if ($_FILES['image']['error'] == 0) {
                    $fileName = $this->newsconnect->lastInsertId() . '.jpg';
                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/articles/' . $fileName);

                }

                //When the user is returned, a popup notifies them that their changes have been made.

                return [
                    'template' => 'edit.html.php',
                    'variables' => ['news' => $news],
                    'title' => 'jos jobs - Edit and Add News',
                    'class' => 'admin'
                ];
    
            }
        }
    
        //The record with the title's matching ID is found when the editadd link is clicked.

        public function editaddnews() {
            if(isset($_GET['id'])) {
                $find = $this->newsconnect->find('id', $_GET['id']);
    
                $news = $find[0];
            }
    
            else {
                $news = false;
            }
    
            return [
                'template' => 'editaddnews.html.php',
                'variables' => ['news' => $news],
                'title' => 'jos jobs - Edit and Add News',
                'class' => 'admin'
            ];
        }
    }

?>
