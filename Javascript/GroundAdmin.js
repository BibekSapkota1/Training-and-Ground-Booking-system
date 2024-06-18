function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        document.getElementById('delete_ground_id').value = id;
        document.getElementById('deleteForm').submit();
    } else {
        return false;
    }
}