import TypeIt from "typeit";

export function initHomepage() {
    // EventListener Section 1 HOMEPAGE
    document.addEventListener("DOMContentLoaded", function () {
        const titleText = "EDULIVE";
        const taglineText = "Elevate Your Learning Experience With AI";
        const titleContainer = document.getElementById("animated-title");
        const taglineContainer = document.getElementById("animated-tagline");

        if (titleContainer && taglineContainer) {
            titleText.split("").forEach((char, index) => {
                const span = document.createElement("span");
                span.innerHTML = char === " " ? "&nbsp;" : char;
                span.style.transitionDelay = `${index * 0.05}s`;
                titleContainer.appendChild(span);
            });

            const words = taglineText.split(" ");
            words.forEach((word, index) => {
                const span = document.createElement("span");
                span.textContent = word;
                span.style.transitionDelay = `${
                    titleText.length * 0.05 + index * 0.1
                }s`;
                taglineContainer.appendChild(span);

                if (index < words.length - 1) {
                    const space = document.createElement("span");
                    space.innerHTML = "&nbsp;";
                    space.style.transitionDelay = `${
                        titleText.length * 0.05 + index * 0.1
                    }s`;
                    taglineContainer.appendChild(space);
                }
            });
            setTimeout(() => {
                titleContainer.classList.add("visible");
                taglineContainer.classList.add("visible");
            }, 100);
        }
    });

    //spline load section 1 HOMEPAGE (Not Affected For Spline Now)
    document.addEventListener("DOMContentLoaded", function () {
        const splineModel = document.getElementById("spline-model");

        if (splineModel) {
            splineModel.addEventListener("load", () => {
                splineModel.classList.add("spline-visible");
            });
        }
    });

    // EventListener Section 2 HOMEPAGE
    document.addEventListener("DOMContentLoaded", () => {
        const parallaxSection = document.getElementById("parallax-section");
        const revealTexts = document.querySelectorAll(".reveal-text");

        if (!parallaxSection || revealTexts.length === 0) return;

        revealTexts.forEach((textElement) => {
            textElement.addEventListener("mouseenter", () => {
                textElement.classList.add("visible");
            });
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const featuresSection = document.querySelector("#features-section");
        const featuresTitle = document.querySelector("#features-title");
        const featureCards = document.querySelectorAll(".feature-card");

        featuresTitle.textContent = "";

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        new TypeIt("#features-title", {
                            strings: "FEATURES",
                            speed: 150,
                            waitUntilVisible: true,
                            cursor: true,
                            afterComplete: async (instance) => {
                                featureCards.forEach((card, index) => {
                                    setTimeout(() => {
                                        card.classList.add("visible");
                                    }, index * 200);
                                });
                                instance.destroy();
                            },
                        }).go();

                        observer.unobserve(featuresSection);
                    }
                });
            },
            {
                threshold: 0.2,
            }
        );

        setTimeout(() => {
            observer.observe(featuresSection);
        }, 300);
    });

    // EventListener Section 4 HOMEPAGE
    document.addEventListener("DOMContentLoaded", () => {
        const teamSection = document.querySelector("#team-section");
        const teamCards = document.querySelectorAll(".team-card");

        if (!teamSection || teamCards.length === 0) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        teamCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add("is-visible");
                            }, index * 200); // Jeda 200ms
                        });
                        observer.unobserve(teamSection);
                    }
                });
            },
            {
                threshold: 0.2,
            }
        );

        observer.observe(teamSection);
    });

    // EventListener Section 5 HOMEPAGE
    document.addEventListener("DOMContentLoaded", () => {
        const section = document.querySelector("#get-ready-section");
        const words = document.querySelectorAll(".get-ready");

        if (!section || words.length === 0) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        words.forEach((word, index) => {
                            setTimeout(() => {
                                word.classList.add("visible");
                            }, index * 400);
                        });
                        observer.unobserve(section);
                    }
                });
            },
            {
                threshold: 0.5,
            }
        );

        observer.observe(section);
    });
}
