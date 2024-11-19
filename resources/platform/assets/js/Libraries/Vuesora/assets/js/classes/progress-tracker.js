import axios from 'axios';
import { recordWatchSession } from 'musora-content-services';

export default class ProgressTracker {
    constructor() {
        this.startTime = 0;
        this.endTime = 0;
        this.secondsWatched = 0;
        this.running = false;
        this.watchSessionToken = null;

        this.endpointPrefix = window.ENDPOINT_PREFIX || '';

        this.previousWatchPosition = 0;
    }

    /**
     * Start the timer
     */
    start() {
        this.startTime = performance.now();
        this.running = true;
    }

    /**
     * Stop the timer
     */
    stop() {
        this.calculateSecondsWatched();
    }

    /**
     * Calculate seconds watched
     */
    calculateSecondsWatched() {
        this.endTime = performance.now();
        this.running = false;

        const millisecondsWatched = this.endTime - this.startTime;
        const secondsWatched = millisecondsWatched / 1000;

        this.secondsWatched += secondsWatched;
    }

    /**
     * Reset the timer
     */
    reset() {
        this.secondsWatched = 0;
    }

    /**
     * Send a tracking request
     *
     * @param {Object} params - The parameters for the tracking request
     * @returns {Promise<string|null>} - Returns the session token or `null` on failure
     */
    async send({
        mediaType,
        mediaCategory,
        watchPosition,
        totalDuration,
        contentId = null
    }) {
        if (this.running) {
            this.calculateSecondsWatched();
        }

        this.secondsWatched = Math.round(this.secondsWatched);

        try {
            if(this.watchSessionToken && (this.previousWatchPosition === parseInt(watchPosition, 10))) {
                return;
            }

            this.previousWatchPosition = parseInt(watchPosition, 10);

            this.watchSessionToken = await recordWatchSession(
                contentId,
                mediaType,
                mediaCategory,
                parseInt(totalDuration, 10),
                parseInt(watchPosition, 10),
                parseInt(this.secondsWatched, 10),
                this.watchSessionToken
            );
            return this.watchSessionToken;
        } catch (error) {
            console.error('Error sending watch session:', error);
            return null;
        }
    }

    /**
     * Send an async tracking request
     *
     * @param {Object} params - The parameters for the tracking request
     * @returns {Promise<string|boolean>} - Returns the session token or `false` on failure
     */
    async sendAsync({
        mediaType,
        mediaCategory,
        watchPosition,
        totalDuration,
        contentId = null
    }) {
        if (this.secondsWatched == null) {
            return false;
        }

        if (this.running) {
            this.calculateSecondsWatched();
        }

        this.secondsWatched = Math.round(this.secondsWatched);
        
        if(this.watchSessionToken && (this.previousWatchPosition === parseInt(watchPosition, 10))) {
            return;
        }

        this.previousWatchPosition = parseInt(watchPosition, 10);

        try {
            this.watchSessionToken = await recordWatchSession(
                contentId,
                mediaType,
                mediaCategory,
                parseInt(totalDuration, 10),
                parseInt(watchPosition, 10),
                parseInt(this.secondsWatched, 10),
                this.watchSessionToken
            );
            return this.watchSessionToken;
        } catch (error) {
            console.error('Error in async watch session:', error);
            return false;
        }
    }
}
