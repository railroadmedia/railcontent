export const countdown = (targetDate, addSeconds = false) => {
        const now = new Date();
        const distance = new Date(targetDate) - now;

        if (distance <= 0) {
            if(addSeconds) {
                return '00:00:00';
            } else {
                return '00:00';
            }

        }

        // Calculate remaining time
        let hours =  Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(addSeconds) {
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        } else {
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
        }
}
