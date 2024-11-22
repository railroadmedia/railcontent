export function useBuildHeader(progressPercent) {
    const buildHeader = (contentType, result, progressPercent) => {
        const header = {
            type: contentType,
            title: result.title,
            description: result.description,
            ctas: buildHeaderCTA(result),
            progress: progressPercent,
            contentId: result.id,
        };

        if (contentType !== 'learning-path-level' && contentType !== 'unit') {
            let packType = 'Lessons';
            if(contentType === 'pack-bundle') packType = 'Packs';
            if(contentType === 'learning-path-course') packType = 'Courses';

            let lessonCount = contentType === 'course-part' ? result.child_count : result.lesson_count;
            if(contentType === 'learning-path-course' || contentType === 'learning-path-lesson') lessonCount = result.child_count;

            header.infoData = [
                `${lessonCount} ${packType}`,
                `${result.total_xp} XP`
            ];
        }

        // Add additional custom fields based on contentType if
        if (contentType === 'pack' || contentType === 'pack-bundle' || contentType === 'challenge') {
            header.thumbnail = result.thumbnail;
            header.image = result.image;
            header.darkModeLogo = result.light_logo;
            header.lightModeLogo = result.dark_logo;
        }

        return header;
    };

    // Helper function to build CTA buttons based on result
    const buildHeaderCTA = (result) => {
        const ctas = [];
        const primaryButton = {
            type: "PageHeaderPrimaryCta",
            props: {
                faIconClass: "fa-play",
                isPrimary: true,
                text: progressPercent === 0 ? "Start" :
                      progressPercent === 100 ? "Restart" : "Continue",
                url: result.web_url_path
            }
        };
        ctas.push(primaryButton);

        if (progressPercent !== 0) {
            const resetButton = {
                type: "ResetProgressCta",
                props: {
                    contentId: result.id,
                    progress: progressPercent
                }
            };
            ctas.push(resetButton);
        }

        if (result.resources) {
            const resourceButton = {
                type: "DownloadResourcesCta",
                props: {
                    resources: result.resources,
                }
            };
            ctas.push(resourceButton);
        }

        return ctas;
    };

    return { buildHeader };
}
