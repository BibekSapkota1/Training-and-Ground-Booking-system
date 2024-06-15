function editGround(data) {
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('formHeading').innerText = 'Edit Ground';
    document.getElementById('ground_ID').value = data.ID;
    document.getElementById('groundName').value = data.groundName;
    document.getElementById('price').value = data.price;
    document.getElementById('time').value = data.time;
    document.getElementById('width').value = data.width;
    document.getElementById('length').value = data.length;
    document.getElementById('lights').checked = data.lights;
    document.getElementById('scoreboard').checked = data.scoreboard;
}

function addNewGround() {
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('formHeading').innerText = 'Add New Ground';
    document.getElementById('ground_ID').value = '';
    document.getElementById('groundName').value = '';
    document.getElementById('price').value = '';
    document.getElementById('time').value = '';
    document.getElementById('width').value = '';
    document.getElementById('length').value = '';
    document.getElementById('lights').checked = false;
    document.getElementById('scoreboard').checked = false;
}

function cancelEdit() {
    document.getElementById('editForm').style.display = 'none';
}

function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this ground?')) {
        document.getElementById('delete_ground_ID').value = id;
        document.getElementById('deleteForm').submit();
    }
}