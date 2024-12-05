export function getHeaderData(catalogueMeta, brand, askQuestionRecipient, emailLogoLink, lessonType) {
    const descriptions = {
      drumeo: "Tackle your next drumming goal with bite-sized courses from many of the world's best drummers.",
      pianote: "Tackle your next piano goal with bite-sized courses from many of the world's best pianists.",
      guitareo: "Tackle your next guitar goal with bite-sized courses from many of the world's best guitarists.",
      singeo: "Tackle your next singing goal with bite-sized courses from many of the world's best vocalists.",
    };
  
    const catalogueTypes = {
      'Courses': {
        type: 'courses',
        title: 'Courses',
        iconName: 'academic-cap',
        description: descriptions[brand],
      },
      'Play Alongs': {
        type: 'play-along',
        title: 'Play Alongs',
        iconName: 'eigth-notes',
        description: 'Add your drumming to high-quality drumless play-along tracks - with handy playback tools to help you create the perfect performance.',
      },
      'Songs': {
        type: 'song',
        title: 'Songs',
        iconName: 'headphones',
      },
      'Routines': {
        type: 'routine',
        title: 'Routines',
        iconName: 'routines',
      },
      'Quick Tips': {
        type: 'quick-tips',
        title: 'Quick Tips',
        iconName: 'light-bulb',
        description: "Only have 10 minutes? These short lessons are designed to inspire you with quick tips and exercises, even if you don't have lots of time to practice.",
      },
      'Bootcamps': {
        type: 'bootcamp',
        title: 'Bootcamps',
        iconName: 'keys',
      },
      'The Pianote Podcast': {
        type: 'podcast',
        title: 'The Pianote Podcast',
        iconName: 'podcast',
      },
      'Student Focus': {
        type: 'student-focus',
        title: 'Student Focus',
        iconName: 'person-plus',
        description: "Submit your playing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.",
        ctas: brand === 'drumeo' ? [
          {
            type: 'VideoModalCta',
            props: {
              text: 'What is Student Review?',
              faIconClass: 'fa-question-circle',
              iframeSrc: '//player.vimeo.com/video/450154189',
            },
          },
          {
            type: 'VideoModalCta',
            props: {
              text: 'How to Apply',
              faIconClass: 'fa-play-circle',
              iframeSrc: '//player.vimeo.com/video/450152568',
            },
          },
          {
            type: 'GoogleFormCta',
            props: {
              text: 'Apply Now',
              faIconClass: 'fa-chevrons-right',
              iframeSrc: 'https://docs.google.com/forms/d/e/1FAIpQLSdRzf0Wg4meObJi0ovKlUDgbBDYDpJP7MCguIDmPFDybchViQ/viewform?embedded=true',
            },
          },
        ] : null,
      },
      'Drumeo Monthly Collaborations': {
        type: 'student-collaborations',
        title: 'Drumeo Monthly Collaborations',
        iconName: 'academic-cap-filled',
        description: "Collaborate with the community with Drumeo Monthly Collaborations! Each month a new Play-Along is chosen and members are tasked to submit their videos playing along to the song. At the end of each month, every video is joined together to create a single performance!",
        ctas: brand === 'drumeo' ? [
          {
            type: 'VideoModalCta',
            props: {
              text: 'What is Student Collaboration?',
              faIconClass: 'fa-question-circle',
              iframeSrc: '//player.vimeo.com/video/448684113',
            },
          },
          {
            type: 'VideoModalCta',
            props: {
              text: 'How to Create Your Video?',
              faIconClass: 'fa-question-circle',
              iframeSrc: '//player.vimeo.com/video/448684140',
            },
          },
          {
            type: 'GoogleFormCta',
            props: {
              text: 'Submit A Video',
              faIconClass: 'fa-chevrons-right',
              iframeSrc: 'https://docs.google.com/forms/d/e/1FAIpQLSdRIO4-j89ItSXadApA5Q-70Nz1ZMIURvfPfrFZB0olOyYdmw/viewform?embedded=true',
            },
          },
        ] : null,
      },
      'Student Reviews': {
        type: 'student-review',
        title: 'Student Reviews',
        iconName: 'person-plus',
        description: "Submit your playing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.",
        ctas: brand === 'pianote' ? [
          {
            type: 'GoogleFormCta',
            props: {
              text: 'Apply Now',
              faIconClass: 'fa-chevrons-right',
              iframeSrc: 'https://docs.google.com/forms/d/e/1FAIpQLSe4Soy7CDxk9Aw9_kuJvK9f3FyojMfLkuqezIsvKNUFQPD51w/viewform?embedded=true',
            },
          },
        ] : brand === 'guitareo' ? [
          {
            type: 'VideoModalCta',
            props: {
              text: 'What is Student Review?',
              faIconClass: 'fa-question-circle',
              iframeSrc: '//player.vimeo.com/video/642883586',
            },
          },
          {
            type: 'VideoModalCta',
            props: {
              text: 'How to Apply',
              faIconClass: 'fa-play-circle',
              iframeSrc: '//player.vimeo.com/video/642900215',
            },
          },
          {
            type: 'GoogleFormCta',
            props: {
              text: 'Apply Now',
              faIconClass: 'fa-chevrons-right',
              iframeSrc: 'https://docs.google.com/forms/d/e/1FAIpQLSfqS5HTrmln2sd7QaNt9Er31fY2becXt4n6isN57HbGwVPHFg/viewform?embedded=true',
            },
          },
        ] : brand === 'singeo' ? [
          {
            type: 'VideoModalCta',
            props: {
              text: 'Tips For Applying',
              faIconClass: 'fa-play-circle',
              iframeSrc: '//player.vimeo.com/video/712150351',
            },
          },
          {
            type: 'GoogleFormCta',
            props: {
              text: 'Apply Now',
              faIconClass: 'fa-chevrons-right',
              iframeSrc: 'https://docs.google.com/forms/d/e/1FAIpQLSeWyMtqVuQjMdA7rrZMK2jCkAIaPLeycTr0zXUE6LEaD6OmyQ/viewform?embedded=true',
            },
          },
        ] : null,
      },
      'Q&A': {
        type: 'qanda',
        title: 'Q&A',
        iconName: 'question-mark-circle',
        description: 'Submit your questions using the "Ask A Question" button, in the Q&A thread in the forums, or live in the community chat.',
        ctas: [
          {
            type: 'AskAQuestionCta',
            props: {
              emailRecipient: askQuestionRecipient,
              emailLogo: emailLogoLink,
            },
          },
        ],
      },
      'Q & A': {
        type: 'qanda',
        title: 'Q&A',
        iconName: 'question-mark-circle',
        description: 'Submit your questions using the "Ask A Question" button, in the Q&A thread in the forums, or live in the community chat.',
        ctas: [
          {
            type: 'AskAQuestionCta',
            props: {
              emailRecipient: askQuestionRecipient,
              emailLogo: emailLogoLink,
            },
          },
        ],
      },
      'Chords & Scales': {
        type: 'chordsandscales',
        title: 'Chords & Scales',
        iconName: 'guitar-tabs',
      },
      'Archives': {
        type: 'archives',
        title: 'Archives',
        iconName: 'archives',
      },
      'Legacy Archives': {
        type: 'archives',
        title: 'Legacy Archives',
        iconName: 'archives',
        description: 'Legacy Resources are lessons or tools that are no longer added to or supported. Rather than remove them from the site completely you can access them here.'
      },
      'New Content': {
        type: 'newcontent',
        title: 'New Content',
        iconName: 'star',
      },
      'Subscribed': {
        type: 'subscribed',
        title: 'Subscribed',
        iconName: 'bell',
      },
      'Song Tutorials': {
        type: 'songtutorials',
        title: 'Song Tutorials',
        iconName: 'play-progress',
      },
      'Rudiments': {
        type: 'rudiments',
        title: 'Rudiments',
        iconName: 'drum',
        description: "The 40 drum rudiments are essential for any drummer, no matter the style, genre, or scenario. You can use the videos below to help you learn, practice, and perfect every single one.",
      },
      'Recommendation': {
        type: 'recommended',
        title: 'Inspired By Your Activity',
        iconName: 'recommendation',
        description: "Here's a list of items we think you'd be interested in! New content will be available twice a week, taking into account your activity and the preferences of other students with similar interests.",
      },
    };

    if (lessonType === 'Recommendation') {
      return catalogueTypes[lessonType];
    }
  
    return catalogueTypes[catalogueMeta.name] || {
      type: 'generic',
      title: catalogueMeta.name,
      description: catalogueMeta.description,
    };
  };
  