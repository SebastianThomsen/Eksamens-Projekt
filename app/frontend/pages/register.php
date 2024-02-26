<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Form</title>
  <link rel="stylesheet" href="register.css"> <!-- Link til din CSS-fil for registreringssiden -->
</head>
<body>
  <div class="background-container">
    <div class="background-image"></div>
    <div class="container">
      <div class="login-box"> <!-- Her bruger vi samme klasse som login-siden for konsistens -->
        <h2>Register</h2>
        <form action="" method="post" onsubmit="return validateForm()">
          <div class="form-group">
            <input type="text" class="form-control" id="name" placeholder="Fornavn" name="name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="efternavn" placeholder="Efternavn" name="efternavn" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="fødselsdag" placeholder="Fødselsdag" name="fødselsdag" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="telefonnummer" placeholder="Telefonnummer" name="telefonnummer" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="adresse" placeholder="Adresse" name="adresse" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="postnummer" placeholder="Postnummer" name="postnummer" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="skole" placeholder="Skole" name="skole" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="username" placeholder="Email" name="username" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="Adgangskode" name="password" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password_again" placeholder="Gentag adgangskode" name="password_again" required>
          </div>
          <div class="button-group">
            <input type="submit" class="btn-register" value="Registrer"> <!-- Her bruger vi samme klasse som login-siden for konsistens -->
            <a href="index.php"><input type="button" class="btn-login" value="Log Ind"></a> <!-- Tilføjet Log Ind-knap med link til log ind-siden -->
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
        </form>
      </div>
    </div>
  </div>

  <script>
    function validateForm() {
      var navn = document.getElementById("navn").value;
      var efternavn = document.getElementById("efternavn").value;
      var fødselsdag = document.getElementById("fødselsdag").value;
      var telefonnummer = document.getElementById("telefonnummer").value;
      var adresse = document.getElementById("adresse").value;
      var postnummer = document.getElementById("postnummer").value;
      var skole = document.getElementById("skole").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var password_again = document.getElementById("password_again").value;

      // Regular expression for at validere e-mail med domænet '@gmail.com'
      var emailPattern = /\b[A-Za-z0-9._%+-]+@gmail\.com\b/;

      // Regular expression for at validere telefonnummer med dansk format
      var phonePattern = /^\d{8}$/;

      if (
        navn == "" ||
        efternavn == "" ||
        fødselsdag == "" ||
        !phonePattern.test(telefonnummer) || // Validerer telefonnummeret
        adresse == "" ||
        postnummer == "" ||
        skole == "" ||
        email == "" ||
        password == "" ||
        password_again == ""
      ) {
        alert("All fields are required!");
        return false; // Forhindrer formularen i at blive sendt
      } else if (!emailPattern.test(email)) {
        alert("Please enter a valid email address ending with '@gmail.com'.");
        return false; // Forhindrer formularen i at blive sendt
      }
      return true; // Sender formularen, hvis alle felter er udfyldt og e-mailen er gyldig
    }
  </script>
</body>
</html>
