// hooks/useBuildHeader.js
import { ref } from 'vue';

export function useBuildHeader(progressPercent) {
    const buildHeader = (contentType, result, progressPercent) => {
        const header = {
            type: contentType,
            title: result.title,
            description: result.description,
            ctas: buildHeaderCTA(result),
            progress: progressPercent,
        };

        if (contentType !== 'learning-path-level' && contentType !== 'unit') {
            header.infoData = [
                `${result.child_count} ${contentType === 'pack-bundle' ? 'Packs' : 'Lessons'}`,
                `${result.total_xp} XP`
            ];
        }

        // Add additional custom fields based on contentType if needed
        if (contentType === 'pack') {
            header.thumbnail = result.thumbnail;
            header.image = result.image;
            header.darkLogo = result.light_logo;
            header.lightLogo = result.dark_logo;
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
