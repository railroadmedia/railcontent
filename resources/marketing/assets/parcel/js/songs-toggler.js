document.addEventListener('DOMContentLoaded', function () {
    var timedToggle = document.querySelector('.timed-toggle'),
        songPoints = Array.from(timedToggle.querySelectorAll('.media-toggle')),
        songPointToggles = Array.from(timedToggle.querySelectorAll('.active-toggle')),
        currentSongPoint = 0,
        totalSongPoints = songPoints.length,
        autoplayInterval = 10000,
        autoplaySongPoints;

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

    function autoplayHandler() {
        currentSongPoint = (currentSongPoint + 1) % totalSongPoints;
        updateIndex(currentSongPoint);
    }

    autoplaySongPoints = setInterval(autoplayHandler, autoplayInterval);

    songPointToggles.forEach((toggle, index) => {
        toggle.addEventListener('click', function () {
            updateIndex(index);
            currentSongPoint = index;
            clearInterval(autoplaySongPoints);
        });
    });
});
