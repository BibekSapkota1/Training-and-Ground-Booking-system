function addNewTraining() {
    document.getElementById("formHeading").textContent = "Add New Training Session";
    document.getElementById("editForm").style.display = "block";
    document.getElementById("training_id").value = "";
    document.getElementById("training_duration").value = "";
    document.getElementById("training_time").value = "";
    document.getElementById("starting_date").value = "";
    document.getElementById("description").value = "";
    document.getElementById("submit").textContent = "Save Training Session";
}

function editTraining(row) {
    document.getElementById("formHeading").textContent = "Edit Training Session";
    document.getElementById("editForm").style.display = "block";
    document.getElementById("training_id").value = row.ID;
    document.getElementById("training_duration").value = row.trainingDurations;
    document.getElementById("training_time").value = row.tranningTime;
    document.getElementById("starting_date").value = row.startingDate;
    document.getElementById("description").value = row.description;
    document.getElementById("submit").textContent = "Update Training Session";
}

function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this training session?")) {
        document.getElementById("delete_training_id").value = id;
        document.getElementById("deleteForm").submit();
    }
}

function cancelEdit() {
    document.getElementById("editForm").style.display = "none";
}