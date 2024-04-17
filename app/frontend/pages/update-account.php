<?php
require_once 'app/backend/core/Init.php';

checkRole('administrator');

function checkRole($requiredRole) {
    $user = new User();
    if ($user->data()->role !== $requiredRole) {
        Redirect::to('profile.php');
    }
}
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
<h2>Opdater information</h2>
  <form action="" method="post">
    <div class="form-group">
      <label for="name">Navn :</label>
      <input type="text" class="form-control" id="name" placeholder="Skriv navn" name="name" value="<?php echo escape($user->data()->name); ?>">
    </div>
    <div class="form-group">
      <label for="username">Email :</label>
      <input type="text" class="form-control" id="username" placeholder="Skriv email" name="username" value="<?php echo escape($user->data()->username); ?>">
    </div>
    <div class="form-group">
      <label for="current_password">Nuværende adgangskode :</label>
      <input type="password" class="form-control" id="current_password" placeholder="Skriv nuværende adgangskode" name="current_password">
    </div>
    <div class="form-group">
      <label for="new_password">Ny adgangskode :</label>
      <input type="password" class="form-control" id="new_password" placeholder="Skriv ny adgangskode" name="new_password">
    </div>
    <div class="form-group">
      <label for="confirm_new_password">Bekræft adgangskode :</label>
      <input type="password" class="form-control" id="confirm_new_password" placeholder="Bekræft din nye adgangskode" name="confirm_new_password">
    </div>
    <div class="form-group">
  <label for="role">Rolle :</label>
  <select class="form-control" id="role" name="role">
    <option value="student">Elev</option>
    <option value="teacher">Lærer</option>
    <option value="administrator">Administrator</option>
  </select>
</div>
      </select>
    <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Opdater profil">
  </form>
</div>
