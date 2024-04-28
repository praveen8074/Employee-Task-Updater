<!DOCTYPE html>
<html>
<head>
    <title>Task section</title>
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times, serif, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 350px;
            margin: 140px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(1, 1, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="submit"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        #department:hover {
            background-color: #007bff;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: orange;
        }
        #department {
            margin-bottom: 10px;
            padding: 5px;
            border-radius: 5px;
        }
        p {
            text-align: center;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Task Section</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="task_id" placeholder="Enter Task ID" required><br> 
            <input type="text" name="Employee_Name" placeholder="Enter Your Name" required><br>
            <input type="email" name="email" placeholder="@gmail.com" required><br>
            <input type="text" name="task" placeholder="Enter Task" required><br>
            <input type="date" name="Assigned_Date" placeholder="Enter Date" required><br>
            <label for="department">Task Assigned to </label>
            <select id="department" name="department">
                <option value="Employee Number 1">Employee Number 1</option>
                <option value="Employee Number 2">Employee Number 2</option>
                <option value="Employee Number 3">Employee Number 3</option>
                <option value="Employee Number 4">Employee Number 4</option>
            </select>
            <input type="submit" name="add_task" value="Add Task">
            <input type="submit" name="update_task" value="Update Task">
            <input type="submit" name="delete_task" value="Delete Task">
        </form> 
        <?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'registration');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['add_task'])) {
     
        $employeename = $_POST['Employee_Name'];
        $email = $_POST['email'];
        $task = $_POST['task'];
        $assigned_date = $_POST['Assigned_Date'];
        $department = $_POST['department'];

        $stmt = $conn->prepare("INSERT INTO informationcontainer (employeename, email, task, assigneddate, department) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $employeename, $email, $task, $assigned_date, $department);

        if ($stmt->execute()) {
            echo "Task added successfully.";
        } else {
            echo "Error adding task: " . $conn->error;
        }
        $stmt->close();
    }

    elseif (isset($_POST['update_task'])) {
      
        $employeename = $_POST['Employee_Name'];
        $email = $_POST['email'];
        $task = $_POST['task'];
        $assigned_date = $_POST['Assigned_Date'];
        $department = $_POST['department'];
        $task_id = $_POST['task_id']; 

        $stmt = $conn->prepare("UPDATE informationcontainer SET employeename=?, email=?, task=?, assigneddate=?, department=? WHERE id=?");
        $stmt->bind_param("sssssi", $employeename, $email, $task, $assigned_date, $department, $task_id);

        if ($stmt->execute()) {
            echo "Task updated successfully.";
        } else {
            echo "Error updating task: " . $conn->error;
        }
        $stmt->close();
    }

    
    elseif (isset($_POST['delete_task'])) {
       
        $task_id = $_POST['task_id'];

        $stmt = $conn->prepare("DELETE FROM informationcontainer WHERE id=?");
        $stmt->bind_param("i", $task_id);

        if ($stmt->execute()) {
            echo "Task deleted successfully.";
        } else {
            echo "Error deleting task: " . $conn->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
<p>view Task <a href="viewtask.php">click Here</a></p>
    </div>
</body>
</html>
