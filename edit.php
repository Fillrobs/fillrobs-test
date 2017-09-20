function edit_record($conn, $db, $firstname, $lastname, $phone) {
		$sql = "update into tbl_account (FirstName, Surname, Phone) Values ('$firstname', '$lastname', '$phone')";
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
{
$conn->close();

}