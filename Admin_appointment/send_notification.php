<?php 
include '../Homepage/config.php';
$appt_id = $_POST['notify_appt'];
//Get the user id using appointment id
$select = mysqli_query($conn, "SELECT * FROM appointmenttable WHERE appt_id = $appt_id") or die('query failed');
$get_userid = mysqli_fetch_all($select, MYSQLI_ASSOC);
foreach($get_userid as $value){
	$notif_userid =  $value['userid'];
    $appt_date = $value['appt_date'];
    $appt_time = $value['appt_time'];
    $guardian_name = $value['guardian_name'];
    $child_name = $value['child_name'];
}
//update is_notified column
$sql = "UPDATE usertable SET is_notified = 1 WHERE userid = $notif_userid";
mysqli_query($conn, $sql);


require_once '../vendor/autoload.php';

use Twilio\Rest\Client;

// Your Twilio phone number (bought from twilio.com/console)
$twilio_number = '+12568125860';

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = "AC82f1a8e171ff4800faeb0aae6d264101";
$token = "5cabe96f3a9aad5ef46523ad5cde7294";
$serviceSid = "IS2c1479644f3d239905261ce25fe290da"; 
$client = new Client($sid, $token);
//'+639279424856'
$to_number = '+639764029844';
//$content = 'Hello '.$guardian_name.' , welcome to Vaccuna! This message is to inform you that you have an upcoming appointment on '.$appt_date.' at '.$appt_time.'. Kindly bring the latest vaccination card of '.$child_name.' , you can download it on the view childs data tab in our application. This message is system generated. Please do not reply.';

$content = 'Welcome to Vaccuna, this message is to inform you that you have an upcoming appointment on '.$appt_date.' at '.$appt_time.'. This message is system generated. Please do not reply.';
// Create a notification
try {
    $notification = $client
        ->notify->v1->services($serviceSid)
        ->notifications->create([
            "toBinding" => '{"binding_type":"sms", "address":"' . $to_number . '"}',
            'body' => $content 
        ]);

    echo "Notification SID: " . $notification->sid;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
header('location: ../Admin/Appointment-TAB.php');

?>
