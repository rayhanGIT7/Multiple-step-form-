

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <title>index</title>
</head>
<body>

<div class="container mt-5">
  <!-- Form Steps -->
  <form id="myForm" class="custom-form" action="#" method="POST" enctype="multipart/form-data">
    <div class="form-step" data-step="1">
      <div style="font-size: larger;"> <label>Step 1: Personal Information</label><br><br></div>
      <div class="form-group">
        <label class="form-label">Enter Name</label><br>
        <input type="text" class="form-control" id="name" name="name" required >
      </div>
      <div class="form-group">
        <label class="form-label">Enter Email Address</label><br>
        <input type="email" class="form-control" name="email" required>
      </div>

      <div class="form-group">
        <label class="form-label">Enter phone Number</label><br>
        <input type="number" class="form-control" name="number" required>
      </div>

      <div class="form-group">
        <label class="form-label">Enter Date Of Birth</label><br>
        <input type="date" class="form-control" name="date" required>
      </div>

      <div class="form-group">
    <label class="form-label">CGPA</label><br>
    
    <div class="form-check">
        <input type="radio" class="form-check-input" name="cgpa" value="3.00" id="cgpa3Radio" onchange="toggleOptions()" required>
        <label class="form-check-label" for="cgpa3Radio">3.00</label>
    </div>
    
    <div class="form-check">
        <input type="radio" class="form-check-input" name="cgpa" value="3.50" id="cgpa3.5Radio" onchange="toggleOptions()" required>
        <label class="form-check-label" for="cgpa3.5Radio">3.50</label>
    </div>
    
    <div class="form-check">
        <input type="radio" class="form-check-input" name="cgpa" value="4.00" id="cgpa4Radio" onchange="toggleOptions()">
        <label class="form-check-label" for="cgpa4Radio">4.00</label>
    </div>
    
   <!-- Text input for 3.00 -->
    <div id="textInputGroup" style="display:none">
        <textarea placeholder="Why cgpa down please explain" class="form-control" id="textInput" name="textInput"></textarea>
    </div>

    <!-- Select option for 4.00 -->
    <div id="selectInputGroup" style="display:none">
        <select class="form-control" id="selectOption" name="specialist">
            <!-- Add your options here -->
            <option selected>What is your specialist</option>
            <?php
            include('db.php');
            $check = "SELECT * FROM user_info";
            $result = mysqli_query($database_connection, $check);

            $row = mysqli_num_rows($result);

            if ($row > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $data['specialist']; ?>"><?php echo $data['specialist']; ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    
</div>

<script>
    function toggleOptions() {
        let cgpaValue = document.querySelector('input[name="cgpa"]:checked').value;
        let textInputGroup = document.getElementById('textInputGroup');
        let selectInputGroup = document.getElementById('selectInputGroup');

        textInputGroup.style.display = 'none';
        selectInputGroup.style.display = 'none';

        
        if (cgpaValue === '3.00') {
            textInputGroup.style.display = 'block';
        } else if (cgpaValue === '4.00') {
            selectInputGroup.style.display = 'block';
        }
    }
</script>

      <div class="form-group">
        <label class="form-label">Image</label><br>
        <input type="file" class="form-control" name="image" accept="image/*" >
      </div>
      
      <div style="margin-left: 700px;" class="d-flex justify-content-between">
      <button type="button" class="btn btn-primary next-step" onclick="firstStep()">Next</button>

      </div>
    </div>

    <div class="form-step" data-step="2">
      <div style="font-size: larger;"> <label>Step 2: Address Information</label><br><br></div>
      <div class="form-group">
        <label class="form-label">Country Name</label><br>
        <input type="text" class="form-control" name="country">
      </div>
      <div class="form-group">
        <label class="form-label">District Name</label><br>
        <input type="text" class="form-control" name="district">
      </div>
      <div class="form-group">
        <label class="form-label">Upazila Name</label><br>
        <input type="text" class="form-control" name="upazila">
      </div>
      <div class="form-group">
        <label class="form-label">Village Name</label><br>
        <input type="text" class="form-control" name="village" >
      </div>
      <div  style="margin-left: 600px;" class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary prev-step">Previous</button>
        <button type="button" name="submit" class="btn btn-primary next-step">Next</button>
      </div>
    </div>

    <div class="form-step" data-step="3">
      <div style="font-size: larger;"> <label>Step 3: Education Information</label><br><br></div>
      <div class="form-group">
        <label class="form-label">School Name</label><br>
        <input type="text" class="form-control" name="school">
      </div>
      <div class="form-group">
        <label class="form-label">Collage Name</label><br>
        <input type="text" class="form-control" name="college" >
      </div>
      <div class="form-group">
        <label class="form-label">University Name</label><br>
        <input type="text" class="form-control" name="university">
      </div>

      <div  style="margin-left: 600px;" class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary prev-step">Previous</button>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </div>
</form>
</div>


<script src="script.js"></script>

</body>
</html>

<?php
include('db.php');
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $date  = $_POST['date'];
    // $gender = $_POST['gender'];
    $country = $_POST['country'];
    $district = $_POST['district'];
    $upazila = $_POST['upazila'];
    $village = $_POST['village'];
    $school = $_POST['school'];
    $collage = $_POST['college']; 
    $university = $_POST['university'];

 
$image = '';
$imageData = ''; 

if(isset($_FILES['image']['name'])){
    $image = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    
    if (!empty($tmpName)) {
      
        $imageData = base64_encode(file_get_contents($tmpName));
    } else {
        echo "Error: File is empty or not uploaded.";
    }
}
$check = "SELECT * FROM user_info WHERE number = '$number' OR email = '$email'";
$result = mysqli_query($database_connection, $check);


$row = mysqli_num_rows($result);

if ($row > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        if ($data['number'] == $number) {
          
            echo "<script>alert('Number Already Exists. Try with another one!'); window.location.replace('index.php');</script>";
            exit();
            
        } elseif ($data['email'] == $email) {
            echo "<script>alert('Email Already Exists. Try with another one!'); window.location.replace('index.php');</script>";
            exit();
        }
    }
} else{

    // form validation
    if (empty($name) || !preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors= "Please enter a valid name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = "Please enter a valid email address";
        
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }

    if (empty($number) || !preg_match("/^[0-9]{11}$/", $number)) {
        $errors = "Please enter a valid phone number";
        
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }

    


    if (empty($date)) {
        $errors= "Please enter valid date";
        
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    
    // Validate that the date is not a future date
    $currentDate = date("Y-m-d");
    if (strtotime($date) > strtotime($currentDate)) {
        $errors= "Joining date cannot be in the future";
      
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
     
       if (empty($imageName) || !preg_match("/^.*\.(jpg|jpeg|png)$/i", $imageName)) {
        $errors= "Invalid image file name.";
       
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    if (empty($country) || !preg_match("/^[a-zA-Z ]*$/", $country)) {
        $errors= "Please enter a valid country name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    if (empty($district) || !preg_match("/^[a-zA-Z ]*$/", $district)) {
        $errors= "Please enter a valid District Name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    if (empty($upazila) || !preg_match("/^[a-zA-Z ]*$/", $upazila)) {
        $errors= "Please enter a valid Upazila Name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    if (empty($village) || !preg_match("/^[a-zA-Z ]*$/", $village)) {
        $errors= "Please enter a valid Village Name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    
    if (empty($school) || !preg_match("/^[a-zA-Z ]*$/", $school)) {
        $errors= "Please enter a valid School Name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    
    if (empty($collage) || !preg_match("/^[a-zA-Z ]*$/", $collage)) {
        $errors= "Please enter a valid Collage Name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    
    if (empty($university) || !preg_match("/^[a-zA-Z ]*$/", $university)) {
        $errors= "Please enter a valid University Name";
        echo "<script>alert('$errors'); window.location.replace('index.php');</script>";
        exit();
    }
    


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cgpaValue = $_POST['cgpa'];

    if ($cgpaValue === '3.00') {
        $textInputValue = $_POST['textInput'];
        
        $insertQuery = "INSERT INTO user_info (cgpa_info) VALUES ('$textInputValue')";
        mysqli_query($database_connection,$insertQuery);
    } elseif ($cgpaValue === '4.00') {
        $selectOptionValue = $_POST['specialist'];
        
        $insertQuery = "INSERT INTO user_info (cgpa_info) VALUES ('$selectOptionValue')";
     mysqli_query($database_connection,   $insertQuery);
    }

   
}





   
    $check = "INSERT INTO user_info (name, email, number,date,  image, country, district, upazila, village, school, collage, university)
              VALUES ('$name', '$email', '$number','$date', '$imageData', '$country', '$district', '$upazila', '$village', '$school', '$collage', '$university')";

  
    if (mysqli_query($database_connection, $check)) {
        ?>
        <script>
            alert("Successfully inserted data");
            window.location.replace("index.php");
        </script>
        <?php
    } else {
        echo "Something went wrong with the database insert: " . mysqli_error($database_connection);
    }
}


?>