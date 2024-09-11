// hooks/useBuildHeader.js
import { computed } from 'vue';

export function useBuildHeader(contentType, progressPercent) {
    const buildHeader = (result) => {
        const header = {
            type: contentType,
            title: result.title,
            description: result.description,
            ctas: buildHeaderCTA(result),
            progress: progressPercent,
        };

        if(contentType !== 'learning-path-level' && contentType !== 'unit') {
            header.infoData = [
                `${result.child_count} ${contentType === 'learning-path-course' ? 'Courses' : 'Lessons'}`,
                `${result.total_xp || result.xp } XP`
            ];
        }

        return header;
    };

    return { buildHeader };
}

// Helper function to build CTA buttons based on progress
const buildHeaderCTA = (method) => {
    const ctas = [];
    // Placeholder for now
    return ctas;
}
