<?php
require 'function.php';

class Auth
{
    private $conn;
    private $email;
    private $password;
    private $errorStack = [];

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function login()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM login WHERE email='$this->email' AND password='$this->password'");
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $_SESSION['log'] = 'True';
            return true;
        } else {
            array_push($this->errorStack, "salah");
            return false;
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['log']);
    }

    public function redirect($location)
    {
        header("Location: $location");
        exit;
    }
}

$auth = new Auth($conn);

if (isset($_POST['login'])) {
    $auth->setEmail($_POST['email']);
    $auth->setPassword($_POST['password']);

    if ($auth->login()) {
        $auth->redirect("index.php");
    } else {
        $auth->redirect("login.php");
    }
}

if ($auth->isLoggedIn()) {
    $auth->redirect("index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login Page</title>
    <link rel="icon" href="assets/img/robot_logo-removebg-preview.png">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body style="background-image: url('assets/img/hitammm.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card2 shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4" id="logincuy">Website Inventaris Toko IoT<br>Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" autocomplete="off">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress" id="emailcuy">Email : </label>
                                            <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword" id="passwordcuy">Password : </label>
                                            <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" required />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>