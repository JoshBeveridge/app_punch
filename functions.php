<?php
/**
 * Created by Kyle Ramey
 * Date: 17/12/14, 3:34 PM
 */

/*
 * Database Connection Credentials
 */
$host = "localhost";
$database = "punch";
$username = "punch";
$password = "CorrectHorseBatteryStaple";
$conn = null;

// Attempt to connect to the database
try{
	$conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	//If we can't connect to the DB, we can't proceed
	die("Database connection error");
}


if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	switch ( $_GET['action'] ) {
		case 'changeStatus':
			if ( is_numeric( $_GET['userid'] ) && ( $_GET['dir'] == 'in' || $_GET['dir'] == 'out' ) ) {
				changeStatus( $_GET['userid'], $_GET['dir'] );
			}
			break;
		default:
			echoAndDie( "No action or invalid action specified." );
			break;
	}
}

/**
 * Changes the status of a user and logs it
 *
 * @param int $id The
 * id of the user
 *
 * @param string $dir
 * The direction (in/out)
 *
 * @return void
 */
function changeStatus($id, $dir){
	global $conn;

	//make sure we're in sync
	if($dir == getStatus($id)){
		echoAndDie('Out of sync');
	}

	//update user status
	$sql = "UPDATE users SET status = :dir WHERE id = :id";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array(':id' => (int)$id, ':dir' => $dir));

	//log the transaction
	$sql = "INSERT INTO logs (userid, direction) VALUES (:id, :dir)";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array(':id' => $id, ':dir' => $dir));

	echoAndDie("Success");
}

/**
 * Gets the current status of a user
 *
 * @param int $id
 * The id of the user
 *
 * @return string
 * The string representing the users's status
 */

function getStatus($id){
	global $conn;

	$sql = "SELECT status FROM users WHERE id = :id";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array(':id' => $id));

	$result = $stmt->fetch();

	return $result['status'];
}

/**
 * @return array
 * Returns an array of all users
 */
function getUsers(){
	global $conn;

	$users = array();

	$sql = "SELECT id, shortname, icon, status FROM users ORDER BY shortname ASC";

	foreach($conn->query($sql) as $row){
		$users[$row['id']] = $row;
	}

	return $users;
}

/**
 * @param mixed $message
 * The message to send to the client via json_encode
 *
 * @return void
 * The script ends after running this function
 */

function echoAndDie($message){
	echo json_encode($message);
	die();
}


/*
 * Markup functions
 */

/**
 * Prints a the user list
 */
function generateUserList(){
	$users = getUsers();

	foreach($users as $index => $user){
		$status = '';
		if($user['status'] == 'in'){
			$status = ' active';
		}
		?>

		<section class="person<?php echo $status ?>" data-userid="<?php echo $user['id']?>">

			<div class="in"></div>

			<div class="click-response"></div>

			<img class="img-in" src="assets/img/<?php echo $user['icon'] ?>">

			<h1><?php echo $user['shortname'] ?></h1>

		</section>

		<?php
	}
}