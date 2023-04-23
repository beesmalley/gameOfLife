var startTime;
var endTime;
var timeInSeconds;
document.getElementById("start").addEventListener("click", function() {
    startTime = Date.now();
});

document.getElementById("stop").addEventListener("click", function() {
    endTime = Date.now();
    // calculate the time in seconds
    timeInSeconds = Math.floor((endTime - startTime) / 1000);
    // add the time to the score
});

document.getElementById("reset").addEventListener("click", function() {
    endTime = Date.now();
    timeInSeconds = Math.floor((endTime - startTime) / 1000);
});