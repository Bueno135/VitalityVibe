document.getElementById("profileDropdown").addEventListener("click", function() {
        var dropdown = document.getElementById("profileInfo");
        var notificationDropdown = document.getElementById("notificationInfo");
        dropdown.classList.toggle("hidden");
        notificationDropdown.classList.add("hidden");
    });

    document.getElementById("notificationDropdown").addEventListener("click", function() {
        var dropdown = document.getElementById("notificationInfo");
        var profileDropdown = document.getElementById("profileInfo");
        dropdown.classList.toggle("hidden");
        profileDropdown.classList.add("hidden");
    });
