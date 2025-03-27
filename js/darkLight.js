document.addEventListener("DOMContentLoaded", function() {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const darkModeText = document.getElementById("darkModeText");
    const toggleIcon = darkModeToggle.querySelector(".toggle-icon");
    const body = document.body;

    // Check if the current settings are dark mode
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
        darkModeText.textContent = "Light Mode";
        toggleIcon.textContent = "☀️";
    }

    darkModeToggle.addEventListener("click", function() {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            darkModeText.textContent = "Light Mode";
            toggleIcon.textContent = "☀️";
            localStorage.setItem("darkMode", "enabled");
        } else {
            darkModeText.textContent = "Dark Theme";
            toggleIcon.textContent = "🌙";
            localStorage.setItem("darkMode", "disabled");
        }
    });
});