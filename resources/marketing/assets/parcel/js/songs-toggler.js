document.addEventListener('DOMContentLoaded', function () {
    var timedToggle = document.querySelector('.timed-toggle'),
        songPoints = Array.from(timedToggle.querySelectorAll('.media-toggle')),
        songPointToggles = Array.from(timedToggle.querySelectorAll('.active-toggle')),
        currentSongPoint = 0,
        totalSongPoints = songPoints.length,
        autoplayInterval = 10000,
        autoplaySongPoints;

    // Function to update the active index
    function updateIndex(index) {
        songPoints.forEach((point, i) => {
            point.classList.toggle('active', i === index);
            const video = point.querySelector('video');
            if (video) {
                video.currentTime = 0;
                video.play();
            }
        });

        songPointToggles.forEach((toggle, i) => {
            toggle.classList.toggle('active', i === index);
        });
    }

    // Function to handle autoplay
    function autoplayHandler() {
        currentSongPoint = (currentSongPoint + 1) % totalSongPoints;
        updateIndex(currentSongPoint);
    }

    // Set up Intersection Observer
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                // Target section is in the viewport, start autoplay
                autoplaySongPoints = setInterval(autoplayHandler, autoplayInterval);
                observer.disconnect(); // Disconnect the observer after triggering the script
            }
        });
    });

    // Observe the target section
    observer.observe(timedToggle);

    // Add click event listeners to the toggles
    songPointToggles.forEach((toggle, index) => {
        toggle.addEventListener('click', function () {
            updateIndex(index);
            currentSongPoint = index;
            clearInterval(autoplaySongPoints);
        });
    });
});
