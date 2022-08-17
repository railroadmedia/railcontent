document.addEventListener('DOMContentLoaded', () => {
    const questionSuccess = document.getElementById('questionSuccess');
    const youtubeLessonModal = document.getElementById('youtubeLessonModal');
    const youtubeLessonIframe = document.getElementById('youtubeLessonIframe');

    if(questionSuccess){
        setTimeout(() => {
            questionSuccess.classList.add('hidden');

            setTimeout(() => {
                questionSuccess.classList.add('hide');
            }, 300);
        }, 3000);
    }

    if(youtubeLessonModal){
        youtubeLessonModal.addEventListener('modalOpen', (event) => {
            const buttonClicked = event.detail.trigger;
            const youtubeId = buttonClicked.dataset['youtubeId'];

            youtubeLessonIframe.src = `https://www.youtube.com/embed/${youtubeId}`;
        });

        window.addEventListener('modalClose', () => {
            youtubeLessonIframe.src = '';
        });
    }
});