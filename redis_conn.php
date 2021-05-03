<?php
//Connecting to Redis server on localhost 
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

if ($redis->ping()) {
    // echo "PONG";
} else {
    echo "Unable to connect to REDIS server";
}
$msg = "";

if (isset($_POST['submit'])) {

    $msg = $_POST['message'];
    // print_r($_POST);
    if ($msg != '') {
        $redis->lpush("messages", $msg);
    } else {
        echo "<br><h5>message is empty</h5><br>";
        exit;
    }
}
?>
<link rel="stylesheet" href="cust.css">
<button><a href="customer_message.html">Back to Messages</a></button>
<?php
$msg_list = $redis->lrange("messages", 0, -1);
echo "<div class='main'>";
echo "<br><br><h3>List of messages are: </h3>";
foreach ($msg_list as $msg) {
    echo $msg . "<br>";
}
echo "</div>";
?>