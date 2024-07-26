<?php
namespace load\controllers;
    class Login { 
        private $loginconnect;

        public function __construct($loginconnect) {
        $this-> loginconnect = $loginconnect;
        }

        /*The search function is utilised when the user clicks the login button to see whether the username they entered matches any existing ones. 
        The entered password is compared to the hashed passwords in the database to see whether there is a matching username.  
*/
        public function loginSubmit() {
            $admin = $this->loginconnect->find('username', $_POST['username']);
            if(isset($_POST['submit'])) {
               if (isset($admin[0])) {
                    if(password_verify($_POST['password'], $admin[0]['password'])) {
                        
                     /*On other pages, this is used to confirm that the administrator is logged in before allowing modifications. 
*/
                     $_SESSION['loggedin'] = true;
                     /*The admin ID and username are saved when the session logs in, allowing them to be utilised on subsequent pages. 

*/
                     $_SESSION['loggedin'] = $admin[0]['id'];
                     $_SESSION['username'] = $_POST['username'];

                     /*Upon logging in, users are directed to the main admin area, which makes the website easier to use. 
*/
                     return [
                        'template' => 'adminhub.html.php',
                        'title' => 'jos jobs  - Admin Hub',
                        'variables' => ['admin' => $admin],
                        'class' => 'admin'
                      ];
                  }
               }
            }
         
            /*If you don't do the aforementioned, the login form loads once again.
 */
            return [
               'template' => 'loginform.html.php',
               'title' => 'jos jobs - Admin Login',
               'variables' => ['admin' => $admin],
               'class' => 'login'
             ];
         }

        public function login() {
            /*login function returns the blank login page */
            return [
                'template' => 'loginform.html.php',
                'variables' => [''],
                'title' => 'jos jobs - Admin Login',
                'class' => 'admin'
            ];
        }

        /*The user is unset and unable to make any more changes to the admin hub after clicking the logout button. 
         

         The user sees a log out template, which serves as a visual cue that they are now logged out.
*/
        public function logout() {
            unset($_SESSION['loggedin']);

            return [
                'template' => 'logout.html.php',
                'variables' => [''],
                'title' => 'jos jobs - Admin Logout',
                'class' => 'logout'
            ];
        }

        /*The admin can access all admin functions via a subnavigation menu if the user is signed in and the adminhub page is fetched.
        
        When an administrator tries to visit the website while not signed in, they are redirected to an error page and prompted to log back in.
*/
        public function adminhub() {
            if(isset($_SESSION['loggedin'])) {
                return [
                    'template' => 'adminhub.html.php',
                    'variables' => [''],
                    'title' => 'jos jobs - Admin Hub',
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

        /*If the user is logged in, this method locates every admin in the database on the manageadmins page and presents them as a table. 
        The error notice appears and the user is unable to use the admin services if they are not signed in. 
*/
        public function manageadmins() {
            $admins = $this->loginconnect->findAll();
            if(isset($_SESSION['loggedin'])) {
                return [
                    'template' => 'manageadmin.html.php',
                    'variables' => ['admins' => $admins],
                    'title' => 'jos jobs - Manage Admin Logins',
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
         /*The admin's ID is obtained from the ID in the URL when a page's delete button is pressed, and it is used to delete that record from the database.
        The user receives a notification informing them that the record has been erased when it is deleted.
*/
        public function deleteadminSubmit() {
           $admins = $this ->loginconnect->delete($_POST['id']);

            return [
                'template' => 'delete.html.php',
                'variables' => ['admins' => $admins],
                'title' => 'jos jobs - Deleted Successfully',
                'class' => 'admin'
            ];
        }
        /*A prompt notifying the user of their changes is presented after selecting the edit or add button, which saves the changes to the record.
        The ID is set to none and will be established by the DBMS if there is no manufacturer ID.
*/

        public function editaddadminSubmit() {

            if(isset($_POST['submit'])) {
                $admins = $_POST['admins'];
                //Admin adding and editing is more secure and difficult to hack using password hashing.

                $admins['password'] = password_hash($admins['password'], PASSWORD_DEFAULT);

                if ($admins['id'] == '') {
                    $admins['id'] = null;
                }
    
                $this->loginconnect->save($admins);
                //The user receives a visual prompt back to let them know their modifications have been applied.

                return [
                    'template' => 'edit.html.php',
                    'variables' => ['admins' => $admins],
                    'title' => 'jos jobs - Edit and Add Admins',
                    'class' => 'admin'
                ];
    
            }
        }
    
        /*This function looks up the ID of the admin table in the URL to see which one matches the ID supplied there.
        This guarantees that the record the user intended to update is the one that can be altered. 
*/
        public function editaddadmin() {
            if(isset($_GET['id'])) {
                $find = $this->loginconnect->find('id', $_GET['id']);
    
                $admins = $find[0];
            }
    
            else {
                $admins = false;
            }
    
            return [
                'template' => 'editaddadmin.html.php',
                'variables' => ['admins' => $admins],
                'title' => 'jos jobs - Edit and Add Admins',
                'class' => 'admin'
            ];
        }
    }
?>
