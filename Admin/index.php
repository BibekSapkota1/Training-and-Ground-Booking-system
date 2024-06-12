<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homapage</title>
</head>

<body>

    <?php
    @include 'NavbarAdmin.php';
    ?>
    <div class="main p-3">
        <div class="text-center">
            <div class="main-content">
                <h1>Welcome to the Admin Page</h1>
                <p>Use the sidebar to navigate through different sections.</p>
                <p id="datetime"></p>
            </div>


            <script>

                function updateDateTime() {
                    const dateTimeElement = document.getElementById('datetime');
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
                    const currentDateTime = new Date().toLocaleDateString('en-US', options);
                    dateTimeElement.textContent = currentDateTime;
                }
                updateDateTime();

                setInterval(updateDateTime, 1000);
            </script>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>

</html>