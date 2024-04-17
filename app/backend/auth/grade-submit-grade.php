<select name="user_id">
<?php
    $sql = "SELECT user_id, name FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['user_id'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        echo "No users found.";
    }
    ?>
</select>

<select name="subject"> 
    <?php
        $sql = "SELECT subjects FROM grades";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['subjects'] . "'>" . $row['subjects'] . "</option>";
            }
        } else { 
            echo "0 results";
        }
    ?>  
</select>