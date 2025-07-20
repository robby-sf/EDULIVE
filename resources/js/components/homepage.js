import TypeIt from "typeit";

export function initHomepage() {
    // --- Animasi Title Section 1 ---
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
        // 1. Ambil elemen section pembungkus dan semua elemen teks
        const parallaxSection = document.getElementById("parallax-section");
        const revealTexts = document.querySelectorAll(".reveal-text");

        // Pastikan elemennya ada sebelum melanjutkan
        if (!parallaxSection || revealTexts.length === 0) return;

        // 2. Loop setiap elemen teks untuk menambahkan event 'mouseenter'
        revealTexts.forEach((textElement) => {
            textElement.addEventListener("mouseenter", () => {
                // Saat mouse masuk, tambahkan kelas 'visible' untuk memunculkannya
                textElement.classList.add("visible");
            });
            // Tidak ada 'mouseleave' di sini agar teks tetap terlihat
        });

        // // 3. Tambahkan satu event 'mouseleave' pada section pembungkus
        // parallaxSection.addEventListener("mouseleave", () => {
        //     // Saat mouse keluar dari seluruh section, reset semua teks
        //     revealTexts.forEach((el) => {
        //         el.classList.remove("visible");
        //     });
        // });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const featuresSection = document.querySelector("#features-section");
        const featuresTitle = document.querySelector("#features-title");
        const featureCards = document.querySelectorAll(".feature-card");

        if (!featuresSection || !featuresTitle || !featureCards.length) {
            console.error("Elemen untuk animasi fitur tidak ditemukan!");
            return;
        }

        // Kosongkan konten judul agar bisa diketik oleh TypeIt
        featuresTitle.textContent = "";

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // Jalankan TypeIt hanya sekali
                        new TypeIt("#features-title", {
                            strings: "FEATURES",
                            speed: 150,
                            waitUntilVisible: true,
                            cursor: true, // kamu bisa set ke false kalau tak ingin kursor
                            afterComplete: async (instance) => {
                                // Setelah efek ketik selesai, tampilkan kartu fitur
                                featureCards.forEach((card, index) => {
                                    setTimeout(() => {
                                        card.classList.add("visible");
                                    }, index * 200);
                                });
                                instance.destroy(); // Hentikan instance TypeIt
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
                            // Delay dibuat berbeda untuk setiap kartu agar muncul satu per satu
                            setTimeout(() => {
                                card.classList.add("is-visible");
                            }, index * 200); // Jeda 200ms
                        });
                        // Hentikan observasi setelah animasi berjalan agar tidak berulang
                        observer.unobserve(teamSection);
                    }
                });
            },
            {
                threshold: 0.2, // Animasi akan berjalan saat 20% dari section terlihat
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
                            }, index * 400); // Delay 400ms antar kata
                        });
                        observer.unobserve(section); // Hentikan observasi setelah animasi berjalan
                    }
                });
            },
            {
                threshold: 0.5, // Animasi berjalan saat 50% section terlihat
            }
        );

        observer.observe(section);
    });
}
