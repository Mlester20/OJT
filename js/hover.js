document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get("category");

    const facultyBtn = document.getElementById("facultyBtn");
    const nonFacultyBtn = document.getElementById("nonFacultyBtn");

    if (category === "faculty") {
        facultyBtn.classList.add("active");
    } else if (category === "non_academic") {
        nonFacultyBtn.classList.add("active");
    }
});