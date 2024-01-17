<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-check {
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form action="#" method="POST">
<div class="form-group">
    <label class="form-label">CGPA</label><br>
    
    <div class="form-check">
        <input type="radio" class="form-check-input" name="cgpa" value="3.00" id="cgpa3Radio" onchange="toggleOptions()">
        <label class="form-check-label" for="cgpa3Radio">3.00</label>
    </div>
    
    <div class="form-check">
        <input type="radio" class="form-check-input" name="cgpa" value="3.50" id="cgpa3.5Radio" onchange="toggleOptions()">
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
<button type="submit" name="name">Submit</button>
</form>

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

</body>
</html>

<?php
include('db.php');

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

    
    header("Location:test.php");
    exit();
}
?>


?>
