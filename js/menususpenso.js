document.addEventListener('DOMContentLoaded', function() {
    var profileDropdown = document.getElementById("profileDropdown");
    var profileInfo = document.getElementById("profileInfo");
    var notificationDropdown = document.getElementById("notificationDropdown");
    var notificationInfo = document.getElementById("notificationInfo");

    if (profileDropdown) {
        profileDropdown.addEventListener("click", function() {
            profileInfo.classList.toggle("hidden");
            if (notificationInfo) {
                notificationInfo.classList.add("hidden");
            }
        });
    }

    if (notificationDropdown) {
        notificationDropdown.addEventListener("click", function() {
            notificationInfo.classList.toggle("hidden");
            if (profileInfo) {
                profileInfo.classList.add("hidden");
            }
        });
    }
});
