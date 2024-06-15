<?php
session_start();
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
?>

<style>
    /* CSS for semi-transparent overlay */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 1050;
        display: none;
    }

    /* Centering the modal vertically and horizontally */
    .modal {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    /* Additional styling for the modal content */
    .modal-content {
        padding: 20px;
        border-radius: 10px;
    }

    .modal-header {
        background-color: red;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .modal-footer {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>


<div class="container">
    <!-- Semi-transparent overlay -->
    <div class="modal-overlay" id="modalOverlay"></div>

    <!-- Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Access Additional Features</h4>
                    <button type="button" class="close" id="closeModalBtn">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-justify">
                    <p class="text-center text-dark">Welcome !! </p>
                    <p> To unlock additional features and services including Booking and Registration,
                        please log in to your account. Logging in ensures you have full access to all the
                        functionalities we offer, providing you with a seamless and personalized experience.</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="closeBtn">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Display the modal and overlay when the page is loaded if user is not logged in
    document.addEventListener("DOMContentLoaded", function () {
        var isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
        var modal = document.getElementById("myModal");
        var modalOverlay = document.getElementById("modalOverlay");

        if (!isLoggedIn) {
            modal.style.display = "flex";
            modalOverlay.style.display = "block";
        }

        // Close the modal and overlay when the close button is clicked
        var closeModalBtn = document.getElementById("closeModalBtn");
        var closeBtn = document.getElementById("closeBtn");
        closeModalBtn.addEventListener("click", closeModal);
        closeBtn.addEventListener("click", closeModal);

        // Close the modal and overlay when the user clicks outside of it
        modalOverlay.addEventListener("click", closeModal);

        function closeModal() {
            modal.style.display = "none";
            modalOverlay.style.display = "none";
        }
    });
</script>