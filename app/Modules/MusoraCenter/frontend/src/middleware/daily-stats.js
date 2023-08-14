export default {

    /**
     * A list of all the user IDs with access
     * Probably not the best way to handle this, but works for now
     *
     * Curtis, June 2019
     */
    userIdsWithAccess: [
        7, // Jared Falk
        8, // Dave Atkinson
        6885, // Jame Falk
        28224, // Chad Kettner
        96326, // Caleb Favor
        128762, // Curtis Conway
        153715, // Scott Bills
        4, // Jord Dick
        150250, // Randy Epp
        149630, // Lisa Witt
        164418, // Dylan R
    ],

    /**
     * Check if the user can view the daily stats
     */
    dailyStats(instance) {
        if (this.userIdsWithAccess.indexOf(instance.auth.currentUser.id) === -1) {
            instance.$router.push({ name: '401' });
        }
    },
};
