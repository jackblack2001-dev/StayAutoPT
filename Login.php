<?php
require_once('Public/config.php');
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
$Email = $Password = "";

$LBL_ERROR = $Email_ERROR = $Password_ERROR = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //ver email
    if (empty(trim($_POST["TXT_Email"]))) {
        $Email_ERROR = "Por favor insira o seu email";
    } else {
        $Email = trim($_POST['TXT_Email']);
    }

    //ver pass
    if (empty(trim($_POST["TXT_Password"]))) {
        $Password_ERROR = "Por favor insira a sua Palavra-passe";
    } else {
        $Password = trim($_POST['TXT_Password']);
    }

    if (empty($Password_ERROR) && empty($Email_ERROR)) {

        $sql = "SELECT User_Id, Email, Profile, Password FROM Users WHERE Email = '$Email'";

        if ($Result = $con->query($sql)) {
            if ($Result->num_rows == 1) {
                if ($row = $Result->fetch_array()) {

                    $HP = $row['Password'];

                    if (password_verify($Password, $HP)) {
                        session_start();
                        $_SESSION['Id'] = $row['User_Id'];
                        $_SESSION['Profile'] = $row['Profile'];
                        header("location: Index.php");
                        exit;
                    } else {
                        $LBL_ERROR = "Email ou Palavra-passe incorretos. (1)";
                    }
                }
            } else {
                $LBL_ERROR = "Email ou Palavra-passe incorretos.";
            }
        }
    }
}

include("includes/header.php");
include("includes/menu.php");
?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h3 class="display-4 text-center">Login</h3>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="container-fluid">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group has-error">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="TXT_Email" value="<?php echo $Email ?>">
                        <small class="form-text text-danger"><?php echo $Email_ERROR ?></small>
                    </div>
                    <div>
                        <label>Palavra-passe</label>
                        <input type="password" class="form-control" name="TXT_Password">
                        <small class="form-text text-danger"><?php echo $Password_ERROR ?></small>
                    </div>
                    <small class="form-text text-danger"><?php echo $LBL_ERROR ?></small>
                    <div class="row">
                        <div class="col">
                            <a href="Register.php">ainda não possui conta?</a>
                        </div>
                        <div class="col-sm-2" style="padding-right: 85px">
                            <button class="btn btn-info" type="submit">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <span class="border-left"></span>
        <div class="col">
            <div style="border: black"></div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>