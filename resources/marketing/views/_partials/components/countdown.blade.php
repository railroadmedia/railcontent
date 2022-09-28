const timer = () => {
    return {
        day: '00',
        dayText: 'days',
        hour: '00',
        hourText: 'hours',
        minute: '00',
        minuteText: 'minutes',
        second: '00',
        secondText: '',
        endTime: new Date().getTime(),
        startTime: new Date().getTime(),
        timeLeft: 0,
        countdown: () => {
            setInterval(() => {
                this.now = new Date().getTime();
                this.timeLeft = (this.endTime - this.startTime) / 1000;
                this.second = this.formatTime(this.timeLeft % 60);
                this.minute = this.formatTime(this.timeLeft / 60) % 60;
                this.hour = this.formatTime(this.timeLeft / (60 * 60)) % 24;
                this.days = this.formatTime(this.timeLeft / (60 * 60 * 24));
            }, 1000);
        },
        formatTime: (value) => {
            if(value < 10){
                return "0" + Math.floor(value);
            }

            return Math.floor(value);
        },
        formatText: (time, value)=>{

        }
    }
}
