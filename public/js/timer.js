function timer() {
    var timeDisplay = document.getElementById('time');
    var timeInput = document.getElementById('timeInput');
    var minutes = 0, seconds = 0;

    function count() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
        }
        var timerValue = (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":";
            timerValue += (seconds > 9 ? seconds : "0" + seconds);
        timeDisplay.innerHTML = timerValue;
        timeInput.value = minutes * 60 + seconds;
        timeout();
    }

    function timeout() {
        setTimeout(count, 1000);
    }
    timeout();
}




