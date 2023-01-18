<?php
if (!isset($_COOKIE['token']) && empty($_COOKIE['token'])) {
    header('Location: /login.php');
}
$db = new mysqli('localhost', 'root', '', 'ecommerce');
if (isset($_POST['edit']) && $_POST['edit']){
    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $db->query("update users set firstname = '$name' , lastname = '$lastname' where id = $user_id");
    if ($db->error) {
        echo $db->error;
        die();
    }
    header('Location: /index.php');
}
$id = $_GET['id'] ?? 0;
$user = $db->query("select id , firstname , lastname from users where id = $id")->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1>View</h1>
            </div>
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <input type="hidden" name="edit" value="1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>First Name</h3>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="name" value="<?= $user['firstname'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Last Name</h3>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="lastname" value="<?= $user['lastname'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">save</button>
                </div>

            </form>

        </div>

    </div>
</div>

</body>
</html>
