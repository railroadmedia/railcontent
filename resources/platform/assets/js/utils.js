export const trapFocus = (element) => {
    var focusableEls = element.querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
    var firstFocusableEl = focusableEls[0];
    var lastFocusableEl = focusableEls[focusableEls.length - 1];
    var KEYCODE_TAB = 9;
    firstFocusableEl.focus();
    console.log('trap focus');

    element.addEventListener('keydown', function (e) {
        var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

        if (!isTabPressed) {
            return;
        }

        if (e.shiftKey) /* shift + tab */ {
            if (document.activeElement === firstFocusableEl) {
                lastFocusableEl.focus();
                e.preventDefault();
            }
        } else /* tab */ {
            if (document.activeElement === lastFocusableEl) {
                firstFocusableEl.focus();
                e.preventDefault();
            }
        }
    });
}

export const contentTypes = {
    'learning-path-lesson': { singular: 'Learning Path Lesson', plural: 'Learning Path Lessons' },
    'pack-lesson': { singular: 'Pack Lesson', plural: 'Pack Lessons' },
    'quick-tips': { singular: 'Quick Tip', plural: 'Quick Tips' },
    'boot-camps': { singular: 'Boot Camp', plural: 'Boot Camps' },
    'play-along': { singular: 'Play Along', plural: 'Play Alongs' },
    'unit': { singular: 'Unit', plural: 'Units' },
    'student-focus': { singular: 'Student Focus Lesson', plural: 'Student Focus Lessons' },
    'song-part': { singular: 'Song Part', plural: 'Song Parts' },
    'podcasts': { singular: 'Podcast', plural: 'Podcasts' },
    'workout': { singular: 'Workout', plural: 'Workouts' },
    'rudiment': { singular: 'Rudiment', plural: 'Rudiments' },
    'pack-bundle-lesson': { singular: 'Pack Bundle Lesson', plural: 'Pack Bundle Lessons' },
    'semester-pack-lesson': { singular: 'Semester Pack Lesson', plural: 'Semester Pack Lessons' },
    'challenge-part': { singular: 'Challenge Part', plural: 'Challenge Parts' },
    'song-tutorial-children': { singular: 'Song Tutorial Lesson', plural: 'Song Tutorial Lessons' },
    'song-tutorial': { singular: 'Song Tutorial', plural: 'Song Tutorials' },
    'question-and-answer': { singular: 'Question And Answer', plural: 'Question And Answers' },
    'coach-stream': { singular: 'Coach Stream', plural: 'Coach Streams' },
    'course': { singular: 'Course', plural: 'Courses' },
    'course-part': { singular: 'Course Part', plural: 'Course Parts' },
    'song': { singular: 'Song', plural: 'Songs' },
    'chord-and-scale': { singular: 'Chord And Scale Lesson', plural: 'Chord And Scale Lessons' },
    'student-review': { singular: 'Student Review', plural: 'Student Reviews' },
    'unit-part': { singular: 'Unit Part', plural: 'Unit Parts' },
};
