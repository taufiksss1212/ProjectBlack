function startFlashSaleTimer() {
    const now = new Date();
    // Set timer berakhir jam 23:59:59 hari ini
    const endDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59).getTime();

    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = endDate - now;

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const h = document.getElementById("hours");
        if (h) {
            h.innerText = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;
        }

        if (distance < 0) clearInterval(timer);
    }, 1000);
}

document.addEventListener("DOMContentLoaded", function() {
    startFlashSaleTimer();
});