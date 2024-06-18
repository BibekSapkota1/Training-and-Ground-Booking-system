function confirmDelete(id) {
    if (confirm('Are you sure you want to remove this registration record?')) {
        document.getElementById('delete_id').value = id;
        document.getElementById('deleteForm').submit();
    } else {
        return false;
    }
}