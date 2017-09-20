<?php


	$conn = mysqli_connect('127.0.0.1', 'probins', 'M3tsiT3ch123') or trigger_error("SQL", E_USER_ERROR);
	$db = ((bool)mysqli_query($conn, "USE dbtest")) or trigger_error("SQL", E_USER_ERROR);

function get_accounts($conn, $db){
	
//Defining varibles 
	$myArray = array();
	
	//SQLcode
	$sql = "select * from tbl_account";
	
	//execute query and  put in result
	$result = mysqli_query($conn, $sql);
	
	//echo $sql;	
	
								
													
          if($result && mysqli_num_rows($result) > 0){
                  $numrecs = mysqli_num_rows($result);
								
		while($row = mysqli_fetch_array($result))
		   {
		$myArray[] = $row;
		   }
		return json_encode($myArray);
         }

}
//step 1 get RQ - request
$rq = $_GET['rq'];

if($rq == "get_accounts"){
	echo get_accounts($conn, $db);
}

if($rq == "add_account") {
	$firstname=$_GET['firstname'];
	$lastname=$_GET['lastname'];
	$phone=$_GET['phone'];
	$postcode=$_GET['postcode'];
	echo add_account($conn, $db, $firstname, $lastname, $phone, $postcode);
}
//step 1 -- manipulating the data in the db getting the request in the html page/javascript
if($rq == "del_account") {
	///step 2 -- get the value of accountid which was passed in that url with in the java script function
	////step 2 -- define the url and look below
				//var url="http://test/functions.php?rq=del_account&accountid=" + accountid;
				$accountid=$_GET['accountid'];
				//execute the php function called del_account passing the db connection variables definied at the top of this page and the value of account id
				//echo outputs the result to the screen, back to the javascript function 
				//echo will go back to javascript to getdata value in html var get_data = xmlHttp.responseText;
	echo del_account($conn, $db, $accountid);
}

//step 1 -- manipulating the data in the db getting the request in the html page/javascript
if($rq == "update_account") {
	///step 2 -- get the value of accountid which was passed in that url with in the java script function
	////step 2 -- define the url and look below
				//var url="http://test/functions.php?rq=del_account&accountid=" + accountid;
				$accountid=$_GET['accountid'];
				$firstname=$_GET['firstname'];
				$lastname=$_GET['lastname'];
				$phone=$_GET['phone'];
				//execute the php function called del_account passing the db connection variables definied at the top of this page and the value of account id
				//echo outputs the result to the screen, back to the javascript function 
				//echo will go back to javascript to getdata value in html var get_data = xmlHttp.responseText;
	echo update_account($conn, $db, $accountid,$firstname, $lastname, $phone);
}


function add_account($conn, $db, $firstname, $lastname, $phone, $postcode) {
		$sql = "insert into tbl_account (FirstName, Surname, Phone, Postcode) Values ('$firstname', '$lastname', '$phone', '$postcode')";
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		return '<div class="alert alert-success alert-dismissable"> record added</div>';

}

//step 1 create function, define function name, pass db values and account id
function del_account($conn, $db, $accountid) {
	//sql statement to be executed
		$sql = "delete from tbl_account where accountid=$accountid";
		//this executes the above sql statement
		$result = mysqli_query($conn, $sql);
		//return the success
		return '<div class="alert alert-success alert-dismissable"> record deleted</div>';

}

//step 1 create function, define function name, pass db values and account id
function update_account($conn, $db, $accountid, $firstname, $lastname, $phone) {
	//sql statement to be executed
		$sql = "update tbl_account set FirstName = '$firstname',Surname = '$lastname', Phone = '$phone' where accountid=$accountid";
		//this executes the above sql statement
		$result = mysqli_query($conn, $sql);
		//return the success
		return '<div class="alert alert-success alert-dismissable"> record updated</div>';

}





?>