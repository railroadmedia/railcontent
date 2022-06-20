window.addEventListener('modalClose', function(){
    const { learningPathPreview } = window.Vuesora.$refs;

    learningPathPreview.mediaElement.pause();
});
