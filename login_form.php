<html>
<head>
<title>Login Page</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="site.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
<div>
    <div class="parent-container">
        <table width="100%" height="100%">
            <tr>
                <td align="center" valign="middle">
                    <div class="loginholder">
                        <table style="background-color:white;" class="table-condensed">
                            <tr>
                                <a href="./index.html"><img src="img/logo.png" alt="" width="180px"></a>
                            </tr>
                            <tr>
                                <td><b>User Id:</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="inputbox" id="username"/>
                                    <br>
                                    <p id="nameerror"></p>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Password:</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" class="inputbox" id="password"/>
                                    <br>
                                    <p id="passerror"></p>
                                    <div id="msg"></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><br />
                                    <button class="btn-normal" id="login">LOGIN</button>
                                </td>
                            </tr>
                            <tr>
                                <td align="left"><br />
                                    <span class="forgetpassword"><a href="forget_password.php">Forget your Password?</a></span>
                                </td>
                            </tr>
                            <td><a href="register_form.php">Register now</a></td>
                            <tr>
                                <td><hr style="background-color:blue;height:1px;margin:0px;"/></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- JavaScript to handle login -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#login").click(function(){
            var username = $("#username").val().trim();
            var password = $("#password").val().trim();
            
            // Basic validation for empty fields
            if (username == "") {
                document.getElementById("nameerror").innerHTML = "<font color='red'>!Username is required.</font>";
                return false;
            } else {
                document.getElementById("nameerror").innerHTML = ""; // Clear error if input is correct
            }
            
            if (password == "") {
                document.getElementById("passerror").innerHTML = "<font color='red'>!Password is required.</font>";
                return false;
            } else {
                document.getElementById("passerror").innerHTML = ""; // Clear error if input is correct
            }

            // AJAX call to login.php to validate the user credentials
            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: {username: username, password: password},
                success: function(response) {
                    if (response.trim() == "1") {
                        window.location = "index.php"; // Redirect on success
                    } else {
                        document.getElementById("msg").innerHTML = "<font color='red'>!Invalid UserId or Password.</font>";
                    }
                },
                error: function() {
                    document.getElementById("msg").innerHTML = "<font color='red'>Something went wrong. Please try again.</font>";
                }
            });
        });
    });
</script>
</body>
</html>
