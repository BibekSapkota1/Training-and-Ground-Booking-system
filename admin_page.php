// Assuming your PHP code correctly retrieves $result from the database

// Fetch all ground records from the database
$sql = "SELECT * FROM Ground";
$result = $conn->query($sql);

// Check if there is data to display
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// Output data from each row in your HTML table
echo '<tr>';
    echo '<td>' . $row['ID'] . '</td>';
    echo '<td>' . $row['groundName'] . '</td>';
    echo '<td>' . $row['price'] . '</td>';
    echo '<td>' . $row['time'] . '</td>';
    echo '<td>' . $row['width'] . '</td>';
    echo '<td>' . $row['length'] . '</td>';
    echo '<td>' . ($row['lights'] == 1 ? 'Available' : 'Not Available') . '</td>';
    echo '<td>' . ($row['scoreboard'] == 1 ? 'Available' : 'Not Available') . '</td>';
    echo '<td>';
        echo '<button class="bluebutton"
            onclick="editGround(' . htmlspecialchars(json_encode($row)) . ')">Edit</button>';
        echo '<button class="redbutton" onclick="confirmDelete(' . $row['ID'] . ')">Delete</button>';
        echo '</td>';
    echo '</tr>';
}
} else {
echo '<tr>
    <td colspan="9">No data found</td>
</tr>';
}

<style>
    function editGround(data) {
        console.log(data); // Check data in console
        document.getElementById('formHeading').textContent='Edit Ground';
        document.getElementById('ID').value=data.ID;
        document.getElementById('groundName').value=data.groundName;
        document.getElementById('price').value=data.price;
        document.getElementById('time').value=data.time;
        document.getElementById('width').value=data.width;
        document.getElementById('length').value=data.length;
        document.getElementById('lights').checked=data.lights==1;
        document.getElementById('scoreboard').checked=data.scoreboard==1;

        document.getElementById('editForm').style.display='block';
    }
</style>