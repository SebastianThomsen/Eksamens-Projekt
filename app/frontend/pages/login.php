<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="background-container">
    <div class="background-image"></div>
    <div class="container">
      <div class="login-box">
        <h2>Login</h2>
        <form action="" method="post" onsubmit="return validateForm()">
          <div class="form-group">
            <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="Adgangskode" name="password" required>
          </div>
          <input type="submit" value="Log Ind">
          <a href="register.php"><input type="button" value="Registrer"></a> 
          <div class="form-group form-check">
            <label for="remember">
              <input type="checkbox" name="remember" id="remember">Husk mig
            </label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
        </form>
      </div>
    </div>
  </div>

  <script>
    function validateForm() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

      if (email == "" || password == "") {
        alert("Begge felter skal udfyldes!");
        return false; // Forhindrer formularen i at blive sendt
      }
      return true; // Sender formularen, hvis begge felter er udfyldt
    }
  </script>
</body>
</html>
