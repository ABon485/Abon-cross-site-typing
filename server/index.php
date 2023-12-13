<?php
require_once 'templates/header.php';
echo "<script src='js/main.js'></script>";
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "practice_security";

try {
    $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['message'])) :
    $name =htmlspecialchars($_POST['username']);
    $message =htmlspecialchars($_POST['message']);
    $statement = $db->prepare("INSERT INTO posts (name, message) VALUES (:name, :message)");
    $statement->execute([
        ':name' => $name,
        ':message' => $message
    ]);
endif;
?>

<form id="form" action="" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username">
        </div>
    </div>

    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"></textarea>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Add new post</button>
    </div>
</form>

<?php
$statement = $db->query("SELECT name, message FROM posts");
$posts = $statement->fetchAll();

foreach ($posts as $post) :
?>
    <div class="card">
        <div class="card-header">
            <span><?php echo $post['name'] ?></span>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $post['message']; ?></p>
        </div>
    </div>
    <hr>
<?php
endforeach;
?>

<?php
require_once 'templates/footer.php';
?>