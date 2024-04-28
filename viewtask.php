<!DOCTYPE html>
<html>
<head>
    <title>information</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Task Information</h2>
        <table border="1">
            <tr>
                <th>Task ID</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Task</th>
                <th>Assigned Date</th>
                <th>Department</th>
            </tr>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'registration');
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }

            // Fetch data from the database
            $sql = "SELECT * FROM informationcontainer";
            $result = $conn->query($sql);

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["employeename"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["task"] . "</td>";
                    echo "<td>" . $row["assigneddate"] . "</td>";
                    echo "<td>" . $row["department"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No tasks found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>
        <p> Go To Task Section <a href="task.php">click Here</a></p>
    </div>
</body>
</html>
