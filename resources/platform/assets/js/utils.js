import axios from 'axios';

export const setEndpointPrefix = () => {
    const { origin } = window.location;
    if (origin.includes('dev')) {
        window.ENDPOINT_PREFIX = `https://${location.hostname}:${location.port}`
    } else {
        window.ENDPOINT_PREFIX = 'https://' + location.hostname
    }
};

export const searchCoaches = (brand, term) => {
    const coachesUrl = `${window.ENDPOINT_PREFIX}/railcontent/content?brand=${brand}&limit=18&statuses[]=published&sort=-published_on&required_fields[]=is_coach,1&page=1${term ? '&term=' + term : ''}`
    return axios.get(coachesUrl);
}

const getResultValue = (el, searchKey, searchObj) => {
    if (el[searchObj]) {
        const findResult = el[searchObj].find(({ key }) => key === searchKey);
        return findResult ? findResult.value : '';
    }
    return '';
};


export const transformCoachesCardData = (result) => {
    return result.data.data.map((coach) => {
        // console.log(coach)
        const img = getResultValue(coach, 'coach_card_image', 'data');
        const focusText = getResultValue(coach, 'focus_text', 'data');
        const name = getResultValue(coach, 'name', 'fields');
        const isFollowed = coach.current_user_is_subscribed;

        return {
            img,
            focusText,
            id: coach.id,
            url: coach.url,
            name,
            isFollowed
        }
    })
};

export function snakeToCapitalized (str) {
    return str
        .split('-')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
        .join(' ');
}

export const trapFocus = (element) => {
    var focusableEls = element.querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
    var firstFocusableEl = focusableEls[0];
    var lastFocusableEl = focusableEls[focusableEls.length - 1];
    var KEYCODE_TAB = 9;
    firstFocusableEl.focus();

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
    'learning-path-lesson': { singular: 'Method Lesson', plural: 'Method Lessons' },
    'learning-path-course': { singular: 'Course', plural: 'Courses' },
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
    'question-and-answer': { singular: 'Questions And Answers', plural: 'Questions And Answers' },
    'coach-stream': { singular: 'Coach Stream', plural: 'Coach Streams' },
    'course': { singular: 'Course', plural: 'Courses' },
    'course-part': { singular: 'Course Part', plural: 'Course Parts' },
    'song': { singular: 'Song', plural: 'Songs' },
    'chord-and-scale': { singular: 'Chord And Scale Lesson', plural: 'Chord And Scale Lessons' },
    'student-review': { singular: 'Student Review', plural: 'Student Reviews' },
    'unit-part': { singular: 'Unit Part', plural: 'Unit Parts' },
    'spotlight': { singular: 'Spotlight', plural: 'Spotlights' },
    'performances': { singular: 'Performance', plural: 'Performances' },
    'live': { singular: 'Live Stream', plural: 'Live Streams' },
    'archives': { singular: 'Archive', plural: 'Archives' },
    'recording': { singular: 'Recording', plural: 'Recordings' },
    'backstage-secrets': { singular: 'Backstage Secrets', plural: 'Backstage Secrets' },
    'challenge': { singular: 'Challenge', plural: 'Challenges' },
    'diy-drum-experiments': { singular: 'DIY Drum Experiment', plural: 'DIY Drum Experiments' },
    'drum-fest-international-2022': { singular: 'Drum Fest International 2022', plural: 'Drum Fest International 2022' },
    'exploring-beats': { singular: 'Exploring Beat', plural: 'Exploring Beats' },
    'gear-guides': { singular: 'Gear Guide', plural: 'Gear Guides' },
    'history-of-electronic-drums': { singular: 'History of Electronic Drums', plural: 'Histories of Electronic Drums' },
    'in-rhythm': { singular: 'In Rhythm Session', plural: 'In Rhythm Sessions' },
    'on-the-road': { singular: 'On the Road', plural: 'On the Road' },
    'paiste-cymbals': { singular: 'Paiste Cymbals', plural: 'Paiste Cymbals' },
    'rhythmic-adventures-of-captain-carson': { singular: 'Rhythmic Adventure of Captain Carson', plural: 'Rhythmic Adventures of Captain Carson' },
    'rhythms-from-another-planet': { singular: 'Rhythm from Another Planet', plural: 'Rhythms from Another Planet' },
    'sonor-drums': { singular: 'Sonor Drums', plural: 'Sonor Drums' },
    'student-collaborations': { singular: 'Student Collaboration', plural: 'Student Collaborations' },
    'study-the-greats': { singular: 'Study the Greats Session', plural: 'Study the Greats Sessions' },
    'tama-drums': { singular: 'Tama Drums', plural: 'Tama Drums' },
    'behind-the-scenes': { singular: 'Behind the Scenes', plural: 'Behind the Scenes' },
    'live-streams': { singular: 'Live Stream', plural: 'Live Streams' },
    'solos': { singular: 'Solo', plural: 'Solos' },
    'play-alongs': { singular: 'Play Along', plural: 'Play Alongs' },
    'recommended': { singular: 'Inspired By Your Activity', plural: 'Inspired By Your Activity' },
    'pack': { singular: 'Pack', plural: 'Packs' },
    'coach-lessons': { singular: 'Coach Lesson', plural: 'Coach Lessons' },
    'song-pdf': { singular: 'Song PDF', plural: 'Song PDFs' }
};

export const toKebabCase = (string) => {
    return string
        .replace(/([a-z])([A-Z])/g, "$1-$2")
        .replace(/[\s_]+/g, '-')
        .toLowerCase();
};

/**
 * Retrieve date in LLL d/yy format from timestamp
 * @param dateString
 * @returns {string|null}
 */
export const getDate = (dateString) => {
    // handle null
    if (!dateString) return null;

    // handle invalid
    const date = new Date(dateString);
    if (isNaN(date)) return null;

    const formatter = new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        year: '2-digit',
    });

    return formatter.format(date).replace(/, /g, '/');
};
