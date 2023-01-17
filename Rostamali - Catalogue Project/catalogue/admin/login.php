<?php
//include("/home/username/data/data.php");
include("/home/mrostamali1/data/data.php");
$msg = "";
if (isset($_POST['submit'])) {

    $username = strip_tags(trim($_POST['username']));
    $password = strip_tags(trim($_POST['password']));
    //echo "<p>submitted</p>";
    //echo "$username, $password";


    if (($username == $username_good) && (password_verify($password, $pw_enc))) {
        //$msg = "GOOD";
        // SUCCESS: USers has successfully logged in. redirect them to the secure part of the site, and record a session to be checked there.

        // Start a session 
        session_start();
        $_SESSION['your-random-session-helloyou'] = session_id();

        //redirect: remember we must set the action of the form to REQUEST_URI
        if (isset($_GET['refer'])) {
            if ($_GET['refer'] == "edit") {
                //echo "refer is welcome";
                header("Location:edit.php");
            } else {
                //echo "refer is insert";
                header("Location:insert.php");
            }
        } else {
            header("Location:../index.php");
        }
    } else {
        //$msg = "BAD";
        if ($username != "" && $password != "") {
            $msg = "Invalid Login";
        } else {
            $msg = "Please enter a Username/Password";
        }
    }
}

include("../includes/header.php");
?>
<style>
    :root {
        --black: #11151f;
        --white: #fcfcfc;
        --mid-grey: #f1f1f1;
        --dark-grey: #d4d4d4;
        --yellow: #e5b261;
        --grey-blue: #374456;
        --grey-blue-hover: #283040;
    }

    /* Universal Styles & Helper Classes */

    body {
        font-family: 'Work Sans', sans-serif;
        color: var(--black);
        background-color: var(--white);
    }

    h2 {
        font-size: 3rem;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    p{
        margin-bottom: 1.5rem;
    }

    section {
        min-height: 100vh;
    }

    section > div:first-of-type {
        margin-top: 1rem;
        min-height: 40rem;
        /* TO DO: Optimise both bakground images with Squoosh. */
        background: url('<?php echo BASE_URL ?>/img/login2.jpg') center / cover;
    }

    .wide-flex {
        padding: 1rem;
    }

    /* Signup Form */

    .login-form {
        background-color: var(--mid-grey);
        border-radius: 5px;
    }

    form p:first-of-type {
        text-align: center;
        font-size: 1.25rem;
        color: var(--white);
        background-color: #4E6E5D;
        padding: 1rem;
        border-radius: 5px 5px 0 0;
    }

    fieldset {
        border: none;
        padding: 0 0.75rem;
    }

    label {
        display: block;
    }

    input {
        width: 100%;
        height: 2.5rem;
        background-color: var(--white);
        border-radius: 5px;
        border: 1px solid var(--dark-grey);
    }

    form p:last-of-type,
    input[type="submit"] {
        margin: 0 0.75rem;
    }

    input[type="submit"] {
        width: calc(100% - 1.5rem);
        color: var(--white);
        background-color: var(--grey-blue);
    }

    input[type="submit"]:hover {
        background-color: var(--grey-blue-hover);
        cursor: pointer;
    }

    form div,
    form p:last-of-type{
        padding-bottom: 1.5rem;
    }

    form a {
        color: var(--grey-blue);
    }

    /* Media Queries */

    /* This media query switches just the form to a two-column layout. */
    @media screen and (min-width: 700px){
        .wide-flex {
            padding: 2rem;
        }

        fieldset {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        fieldset > div {
            flex-basis: 49%;
            /* these two are the same */
            /* width: 49%; */
        }
    }

    /* This media query flexes everything and changes the background images. */
    @media screen and (min-width: 1000px){
        section {
            display: flex;
            /* Using flexbox, align the flex items vertically. */
            align-items: center;
        }

        .wide-flex {
            padding:0 4rem;
            width: 49%;
            min-width: 44rem;
            /* align-self: center; */
        }

        section > div:first-of-type {
            width: 49%;
            /* margin-top: -0.1rem; */
            /* TO DO: Optimise both bakground images with Squoosh. */
            background: url('<?php echo BASE_URL ?>/img/login1.jpg') center / cover;
            /* min-height: 50rem; */
            height: 100vh;
        }
    }

    /* This stops everything from growing any furthur. */
    @media screen and (min-width: 1600px){
        section {
            max-width: 100rem;
        }
    }
</style>

<main role="main" class="container">
    
    <!--Section: Content-->
    <section class="mb-5">
        <div>
            <!-- This is a placeholder <div> for the background image. -->
        </div>
        <div class="wide-flex">
            <div>
                <h2>Login to The Top Universities of The World.</h2>
                <p>Our website helps you choose the best place for your future education. Login now to add and update universities information.</p>
            </div>
            <form class="login-form" id="myform" name="myform" method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <p>It is Free</p>
                <fieldset>
                    <div>
                        <label for="f-name">Username:</label>
                        <input id="f-name" name="username" type="text">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input id="password" name="password" type="text">
                    </div>
                </fieldset>
                <div>
                    <input type="submit" name="submit" value="Login &#9656;">
                </div>
                <p>By Login, you can add, update and delete universities information.</p>
            </form>
        </div> <!-- End of .wide-flex -->
    </section>
    <!--Section: Content-->


<?php
    if ($msg) {
        echo "<div class=\"alert alert-info\">$msg</div>";
    }
?>

<?php
    include("../includes/footer.php");
?>