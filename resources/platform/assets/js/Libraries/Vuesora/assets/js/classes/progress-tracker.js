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

    calculateSecondsWatched() {
        this.endTime = performance.now();
        this.running = false;

        let millisecondsToAddToSecondsWatched = this.endTime - this.startTime;
        let secondsToAddToSecondsWatched = millisecondsToAddToSecondsWatched/1000;

        this.secondsWatched = this.secondsWatched + secondsToAddToSecondsWatched;
    }

    /**
     * Reset the timer
     */
    reset() {
        this.secondsWatched = 0;
    }

    /**
     * Send a navigator beacon with a FormData object containing progress data
     *
     * @param {string} endpoint - the endpoint to send data to
     * @param {string|number} mediaId - The Media ID you wish to track progress for
     * @param {string} mediaType - Type type of media (video/assignment)
     * @param {string} mediaCategory - (vimeo/youtube or soundslice)
     * @param {string|number} watchPosition - Current watch position of the media
     * @param {string|number} totalDuration
     * @param {string} sessionToken - used to validate the current user
     */
    async send({
        mediaType,
        mediaCategory,
        watchPosition,
        totalDuration,
        contentId = null
    }) {
        const data = new FormData();
        if(this.running){
            this.calculateSecondsWatched();
        }

        this.secondsWatched = Math.round(this.secondsWatched);

        this.watchSessionToken = await recordWatchSession(contentId, mediaType, mediaCategory, parseInt(totalDuration, 10), parseInt(watchPosition, 10), parseInt(this.secondsWatched, 10), this.watchSessionToken);
    
        return this.watchSessionToken;
    }

    /**
     * Send an async tracking request on demand
     *
     * @param {string} endpoint - the endpoint to send data to
     * @param {string|number} mediaId - The Media ID you wish to track progress for
     * @param {string} mediaType - Type type of media (video/assignment)
     * @param {string} mediaCategory - (vimeo/youtube or soundslice)
     * @param {string|number} watchPosition - Current watch position of the media
     * @param {string|number} totalDuration
     * @param {string} sessionToken - used to validate the current user
     * @returns {Promise}
     */
    async sendAsync({
        mediaType,
        mediaCategory,
        watchPosition,
        totalDuration,
        contentId = null
    }) {
        if (this.secondsWatched == null) {
            return new Promise.resolve(false);
        }

        if(this.running){
            this.calculateSecondsWatched();
        }

        this.secondsWatched = Math.round(this.secondsWatched);

        this.watchSessionToken = await recordWatchSession(contentId, mediaType, mediaCategory, parseInt(totalDuration, 10), parseInt(watchPosition, 10), parseInt(this.secondsWatched, 10), this.watchSessionToken);
        return this.watchSessionToken;
    }
}
