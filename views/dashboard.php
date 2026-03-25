<?php
    session_start();

    require '../classes/User.php';

    $user      = new User;
    $all_users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
<!--Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!--FontAwesome --->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--CSS-->
<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px;">
        <div class="container">
            <a href="dashboard.php" class="navbar-brand">
                <h3>The Company</h3>
            </a>
            <div class="navbar-nav">
                <span class="navbar-text"><?php echo $_SESSION['fullname'] ?></span>
                <form action="../actions/logout.php" class="d-flex ms-2">
                    <button type="submit" class="text-danger bg-transparent border-0">Log out</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="row justify-content-center">
        <div class="col-6">
            <h2 class="text-center">USER LIST</h2>

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th><!--FOR PHOTO--></th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th><!--For action buttons --></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($user = $all_users->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                    if ($user['photo']) {
                                        ?>
                                    <img src="../assets/images/<?php echo $user['photo'] ?>" alt="<?php echo $user['photo'] ?>" class="d-block mx-auto dashboard-photo">
                                    <?php
                                        } else {
                                     ?>
                                        <i class="fas fa-user text secondary d-block mx-auto text-center dashboard-icon"></i>
                                    <?php
                                        }
                                    ?>
                            </td>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['first_name'] ?></td>
                            <td><?= $user['last_name'] ?></td>
                            <td><?= $user['username'] ?></td>

                            <td>
                                <?php
                                if($_SESSION['id'] == $user['id']){
                                ?>
                                 <a href="edit-user.php" class="btn btn-outline-warning" title="Edit">
                                    <i class="far fa-pen-to-square"></i>
                                 </a> 

                                 <a href="delete-user.php" class="btn btn-outline-danger" title="Delete">
                                    <i class="far fa-trash-can"></i>
                                 </a>
                                <?php    
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>