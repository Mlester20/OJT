$(document).ready(function () {
    function fetchNotifications() {
        $.ajax({
            url: "../controllers/fetch_notifications.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                console.log(response); // Debugging
                let notifList = $("#notifList");
                let notifCount = $("#notifCount");
                notifList.empty();

                if (response.status === "success" && response.notifications.length > 0) {
                    let unreadCount = 0;

                    response.notifications.forEach(function (notif) {
                        let notifClass = notif.is_read == 0 ? "fw-bold" : "text-muted";
                        if (notif.is_read == 0) unreadCount++;

                        notifList.append(`
                            <li>
                                <a class="dropdown-item ${notifClass}" href="#" data-id="${notif.id}">
                                    <strong>${notif.member_first}</strong>: ${notif.message} <br>
                                    <small class="text-muted">${notif.created_at}</small>
                                </a>
                            </li>
                        `);
                    });

                    notifCount.text(unreadCount > 0 ? unreadCount : ""); // Update badge count
                } else {
                    notifCount.text("");
                    notifList.append('<li><a class="dropdown-item text-muted">No new notifications</a></li>');
                }
            },
            error: function (xhr, status, error) {
                console.log("Error fetching notifications:", error);
            }
        });
    }

    // Mark notification as read when clicked
    $("#notifList").on("click", "a.dropdown-item", function () {
        let notifId = $(this).data("id");
        let notifItem = $(this);

        $.ajax({
            url: "../controllers/mark_notification_read.php",
            type: "POST",
            data: { id: notifId },
            success: function (response) {
                if (response.status === "success") {
                    notifItem.removeClass("fw-bold").addClass("text-muted");
                    fetchNotifications(); // Refresh notifications
                }
            },
            error: function (xhr, status, error) {
                console.log("Error marking notification as read:", error);
            }
        });
    });

    fetchNotifications(); // Fetch on page load
    setInterval(fetchNotifications, 30000); // Auto-refresh every 30 sec
});
