export const countdown = (targetDate) => {
        const now = new Date();
        const distance = new Date(targetDate) - now;

        if (distance <= 0) {
            return '00:00';
        }

        // Calculate remaining time
        let hours =  Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        return `${String(hours).padStart(2, '0')} : ${String(minutes).padStart(2, '0')}`;
}
