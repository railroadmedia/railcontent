// import axios from 'axios';
// import Vue from 'vue';
// import MediaElement from 'vue/Libraries/Vuesora/src/Components/MediaElement';
// import VideoPlayer from 'vue/Libraries/Vuesora/src/Components/VideoPlayer';
// import Chat from '@musora/chatsora/src/Components/Chat';

// Vue.use(VideoPlayer);
// Vue.use(MediaElement);
// Vue.use(Chat);

window.addEventListener('lesson-complete', (event) => {
    if(event.detail.complete) {
        document.body.dispatchEvent(new CustomEvent('openModal', {
            detail: {
                target: 'lessonCompleteModal'
            },
        }));
    }
});

document.addEventListener('DOMContentLoaded', function(){
    const playButtons = document.querySelectorAll('.play-sbt');
    const sendAttendanceReport = document.getElementById('sendAttendanceReport');

    document.addEventListener('click', (event) => {
        const element = event.target;

        if(element.matches('#optInButton')){
            document.cookie = 'enableHlsPlayer=true;path=/;max-age=31536000;';
            location.reload();
        }

        if(element.matches('#optOutButton')){
            document.cookie = 'enableHlsPlayer=;path=/;expires=0;';
            location.reload();
        }
    });

    if(playButtons.length){
        Array.from(playButtons).forEach(button => {
            button.addEventListener('click', playSBT);
        });
    }

    // Send a request marking the user as attended on a live lesson after 5 minutes
    if(sendAttendanceReport){
        window.setTimeout(() => {
            axios.post('/laravel/public/members-area/live/mark-attended')
                .then(response => response)
                .catch(error => {console.error(error)});
        }, 300000);
    }
});

function playSBT(event){
    const thisButton = event.target;
    const videoId = thisButton.dataset['videoId'];
    const thisExercise = thisButton.dataset['exercise'];
    const thisExerciseImage = document.querySelector('.sbt-image[data-exercise="' + thisExercise + '"]');
    const allExerciseImages = document.querySelectorAll('.sbt-image');
    const videoElementToPlay = document.getElementById(videoId);
    const allVideos = document.querySelectorAll('.sbt-video');
    const allButtons = document.querySelectorAll('.play-sbt');
    const wasPlaying = thisButton.classList.contains('playing');

    // Stop All Videos
    Array.from(allVideos).forEach(video => {
        video.pause();
        video.classList.add('hide');
    });

    // Hide All Images
    Array.from(allExerciseImages).forEach(image => {
        image.classList.remove('hide');
    });

    // Remove Playing State from Buttons
    Array.from(allButtons).forEach(button => {
        button.classList.remove('playing');
    });

    // Only Play if the button you clicked didn't already have a playing state before we removed it
    if(!wasPlaying){
        videoElementToPlay.children[0].setAttribute(
            'src', videoElementToPlay.children[0].dataset['lazyLoadSource']
        );
        videoElementToPlay.classList.remove('hide');
        videoElementToPlay.load();
        videoElementToPlay.play();

        thisExerciseImage.classList.add('hide');
        thisButton.classList.add('playing');
    }
}
