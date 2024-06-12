
function editGround(ground) {
    // alert(ground.lights == 'Available');
    document.getElementById('groundTable').style.display = 'none';
    document.getElementById('addNewGroundBtn').style.display = 'none';
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('formHeading').innerText = "Update Ground Details";

    document.getElementById('ground_id').value = ground.id;
    document.getElementById('ground_name').value = ground.ground_name;
    document.getElementById('price').value = ground.price;
    document.getElementById('times').value = ground.times;
    document.getElementById('width').value = ground.width;
    document.getElementById('length').value = ground.length;

    // Prameter 1 is given if available but it not working
    // echo ground.lights;
    document.getElementById('lights').checked = ground.lights == 'Available';
    document.getElementById('scoreboard').checked = ground.scoreboard == 'Available';
}


function addNewGround() {
    document.getElementById('groundTable').style.display = 'none';
    document.getElementById('addNewGroundBtn').style.display = 'none';
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('formHeading').innerText = "Add New Ground";

    document.getElementById('ground_id').value = '';
    document.getElementById('ground_name').value = '';
    document.getElementById('price').value = '';
    document.getElementById('times').value = '';
    document.getElementById('width').value = '';
    document.getElementById('length').value = '';
    document.getElementById('lights').checked = false;
    document.getElementById('scoreboard').checked = false;
}

function confirmDelete(groundId) {
    if (confirm("Do you really want to delete this ground?")) {
        document.getElementById('delete_ground_id').value = groundId;
        document.getElementById('deleteForm').submit();
    }
}

function cancelEdit() {
    document.getElementById('editForm').reset();
    document.getElementById('editForm').style.display = 'none';
    document.getElementById('addNewGroundBtn').style.display = 'block';
    document.getElementById('groundTable').style.display = 'table';
}
