<?php
$allowed = array('doc', 'docx', 'pdf');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
                
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
		echo '{"status":"success"}';
                
                $filename = $_FILES['upl']['name'];

                /* Ettől a két sortól elromlik és nem vesz fel többet valamiért
                $employee_id = $this->uri->segment(3) ? $this->uri->segment(3) : $employee_id;
                $mission_id = $this->uri->segment(4) ? $this->uri->segment(4) : $mission_id;*/
                
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "rhexpat";
                    
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
         
                $employee_id = 45;
                $mission_id = 52;
                
                $sql = "INSERT INTO uploaded_files (id, created, name, employee_id, mission_id, deleted, type)
                VALUES (NULL, NOW(), '$filename', '$employee_id', '$mission_id', NULL, '1')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
		exit;
	}
}

echo '{"status":"error"}';
exit;