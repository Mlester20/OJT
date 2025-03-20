document.addEventListener("DOMContentLoaded", function() {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const darkModeText = document.getElementById("darkModeText");
    const body = document.body;

    // check if the current settings are dark mode
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
        darkModeText.textContent = "Light Mode";
        darkModeToggle.innerHTML = "☀️ <span id='darkModeText'>Light Mode</span>";
    }

    darkModeToggle.addEventListener("click", function() {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            darkModeText.textContent = "Light Mode";
            darkModeToggle.innerHTML = "☀️ <span id='darkModeText'>Light Mode</span>";
            localStorage.setItem("darkMode", "enabled");
        } else {
            darkModeText.textContent = "Dark Mode";
            darkModeToggle.innerHTML = "🌙 <span id='darkModeText'>Dark Mode</span>";
            localStorage.setItem("darkMode", "disabled");
        }
    });
});

//animation for cards
document.addEventListener("DOMContentLoaded", function() {
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach((el, index) => {
        setTimeout(() => {
            el.style.animationDelay = `${index * 0.2}s`;
            el.classList.add("animated");
        }, index * 200);
    });
});
