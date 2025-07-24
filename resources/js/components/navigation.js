// menu toggle dll
export function initNavigation() {
    const menuToggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");
    const menuOverlay = document.getElementById("menu-overlay");

    if (menuToggle && menu && menuOverlay) {
        menuToggle.addEventListener("click", () => {
            menu.classList.toggle("hidden");
            menuOverlay.classList.toggle("hidden");
        });

        menuOverlay.addEventListener("click", () => {
            menu.classList.add("hidden");
            menuOverlay.classList.add("hidden");
        });
    }
    const dashboardToggle = document.getElementById("dashboard-toggle");
    const mobileDashboardMenu = document.getElementById(
        "mobile-dashboard-menu"
    );
    const desktopDashboardMenu = document.getElementById(
        "desktop-dashboard-menu"
    );
    const dashboardChevron = document.getElementById("dashboard-chevron");

    dashboardToggle.addEventListener("click", (event) => {
        event.stopPropagation();

        if (window.matchMedia("(min-width: 768px)").matches) {
            // Desktop view
            desktopDashboardMenu.classList.toggle("hidden");
        } else {
            // Mobile view
            mobileDashboardMenu.classList.toggle("hidden");
        }

        dashboardChevron.classList.toggle("rotate-180");
    });

    window.addEventListener("click", (event) => {
        if (!dashboardToggle.contains(event.target)) {
            mobileDashboardMenu.classList.add("hidden");
            desktopDashboardMenu.classList.add("hidden");
            dashboardChevron.classList.remove("rotate-180");
        }
    });

    // Profile Dropdown
    document.addEventListener("DOMContentLoaded", function () {
        const profileButton = document.getElementById("profile-menu-button");
        const profileDropdown = document.getElementById(
            "profile-menu-dropdown"
        );

        if (profileButton && profileDropdown) {
            profileButton.addEventListener("click", function (event) {
                event.stopPropagation();
                profileDropdown.classList.toggle("hidden");
                if (!profileDropdown.classList.contains("hidden")) {
                    setTimeout(() => {
                        profileDropdown.classList.add(
                            "opacity-100",
                            "scale-100"
                        );
                        profileDropdown.classList.remove(
                            "opacity-0",
                            "scale-95"
                        );
                    }, 10);
                } else {
                    profileDropdown.classList.remove(
                        "opacity-100",
                        "scale-100"
                    );
                    profileDropdown.classList.add("opacity-0", "scale-95");
                }
            });

            window.addEventListener("click", function (event) {
                if (
                    !profileDropdown.contains(event.target) &&
                    !profileButton.contains(event.target)
                ) {
                    if (!profileDropdown.classList.contains("hidden")) {
                        profileDropdown.classList.remove(
                            "opacity-100",
                            "scale-100"
                        );
                        profileDropdown.classList.add("opacity-0", "scale-95");

                        setTimeout(() => {
                            profileDropdown.classList.add("hidden");
                        }, 300);
                    }
                }
            });
        }
    });
}
