<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="profilestyles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Profil oplysninger</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Navn :</td>
                                <td><?php echo escape($data->name); ?></td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td><?php echo escape($data->username); ?></td>
                            </tr>
                            <tr>
                                <td>Første adgang til siden :</td>
                                <td><?php echo escape($data->joined); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a href="update-account.php" class="btn btn-primary custom-btn custom-btn-primary" aria-label="Opdater brugeroplysninger" title="Opdater brugeroplysninger">
                            <i class="bi bi-person-up"></i>
                        </a>
                        <a href="delete-account.php" class="btn btn-danger custom-btn custom-btn-danger" aria-label="Slet brugerkonto" title="Slet brugerkonto"> 
                            <i class="bi bi-trash3"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Name :</td>
                        <td><?php echo escape($data->name); ?></td>
                      </tr>
                      <tr>
                        <td>Username :</td>
                        <td><?php echo escape($data->username); ?></td>
                      </tr>
                      <tr>
                        <td>Email :</td>
                        <td><?php echo escape($data->email); ?></td>
                      </tr>
                      <tr>
                        <td>Role :</td>
                        <td><?php echo escape($data->role); ?></td>
                      <tr>
                        <td>Date Joined :</td>
                        <td><?php echo escape($data->joined); ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="update-account.php" class="btn btn-primary">Update Information</a>
                  <a href="index.php" class="btn btn-primary">Back</a>
                  <a href="delete-account.php" class="btn btn-danger">Delete Account</a>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Rumdetajler</h3>
                </div>
                <div class="panel-body">
                    <!-- Room Details Content Goes Here -->
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
