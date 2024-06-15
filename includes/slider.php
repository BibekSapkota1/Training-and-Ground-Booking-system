<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Screen Carousel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <style>
        /* html,
        body {
            height: 100%;
            margin: 0;
        }

        .carousel,
        .carousel-inner,
        .carousel-item,
        .carousel-item img {
            height: 100%;
        }

        .carousel-item img {
            object-fit: cover;
        } */
    </style>
</head>

<body>
    <section class="">
        <div class="slider-wrapper">
            <div class="slider">
                <div class="slide">
                    <img src="Pictures/Bat.jpeg" alt="3D rendering of an imaginary orange planet in space" />
                    <div class="slide-text">
                        <h1 class="top">Cricket is for</h1>
                        <h1 class="middle">Everyone</h1>
                        <p class="bottom">... Making cricket accessible for all at Nepal Cricket Academy.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="Pictures/out.jpeg" alt="3D rendering of an imaginary green planet in space" />
                    <div class="slide-text">
                        <h1 class="top">We Offer High</h1>
                        <h1 class="middle">QUALITY</h1>
                        <p class="bottom">... but maintaining affordable pricing to ensure that high-quality coaching is
                            accessible to all.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="pictures/2.jpeg" alt="3D rendering of an imaginary blue planet in space" />
                    <div class="slide-text">
                        <h1 class="top">We can help </h1>
                        <h1 class="middle">players</h1>
                        <p class="bottom">... achieve their full potential and excel in every aspect of the game.</p>
                    </div>
                </div>
            </div>
            <div class="slider-nav">
                <a href="#slide-1" class="active"></a>
                <a href="#slide-2"></a>
                <a href="#slide-3"></a>
            </div>
        </div>
    </section>

    <script>
        const slides = document.querySelectorAll('.slide');
        const navLinks = document.querySelectorAll('.slider-nav a');
        const slider = document.querySelector('.slider');
        let currentIndex = 0;

        function showSlide(index, withTransition = true) {
            if (!withTransition) {
                slider.style.transition = 'none';
            } else {
                slider.style.transition = 'transform 0.5s ease-in-out';
            }
            const offset = index * -100;
            slider.style.transform = `translateX(${offset}%)`;
            navLinks.forEach((nav, i) => {
                nav.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            const nextIndex = (currentIndex + 1) % slides.length;
            if (nextIndex === 0) {
                showSlide(nextIndex, false); // Transition without animation
            } else {
                showSlide(nextIndex);
            }
            currentIndex = nextIndex;
        }

        setInterval(nextSlide, 5000);

        navLinks.forEach((nav, index) => {
            nav.addEventListener('click', (e) => {
                e.preventDefault();
                showSlide(index);
                currentIndex = index;
            });
        });

        showSlide(currentIndex);
    </script>


</body>

</html>