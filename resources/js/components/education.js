export function initEducationModal() {
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("education-modal");
        const modalContent = document.getElementById("education-modal-content");
        const form = document.getElementById("education-form");
        const modalTitle = document.getElementById("education-modal-title");
        const submitButton = document.getElementById("education-submit-button");
        const methodField = document.getElementById("education-method-field");
        const educationList = document.getElementById("education-list");

        // --- Fungsi untuk membuka dan menutup modal ---
        const openModal = () => {
            modal.classList.remove("hidden");
            setTimeout(() => {
                modal.classList.remove("opacity-0");
                modalContent.classList.remove("scale-95", "opacity-0");
            }, 10);
        };

        const closeModal = () => {
            modal.classList.add("opacity-0");
            modalContent.classList.add("scale-95", "opacity-0");
            setTimeout(() => {
                modal.classList.add("hidden");
                form.reset(); // Bersihkan form setelah ditutup
                form.removeAttribute("data-id");
            }, 300);
        };

        // --- Event listener untuk membuka modal (ADD) ---
        document
            .getElementById("add-education-btn")
            .addEventListener("click", () => {
                form.reset();
                modalTitle.textContent = "Add Education History";
                submitButton.textContent = "Save";
                form.action = "{{ route('profile.education.store') }}";
                methodField.value = "POST";
                openModal();
            });

        // --- Event listener untuk membuka modal (EDIT) ---
        educationList.addEventListener("click", function (e) {
            const editButton = e.target.closest(".edit-education-btn");
            if (editButton) {
                const id = editButton.dataset.id;
                modalTitle.textContent = "Edit Education History";
                submitButton.textContent = "Save Changes";
                form.action = `/profile/education/${id}`; // URL dinamis
                methodField.value = "PUT";

                // Isi form dengan data yang ada
                document.getElementById("degree").value =
                    editButton.dataset.degree;
                document.getElementById("institution_name").value =
                    editButton.dataset.institution;
                document.getElementById("field_of_study").value =
                    editButton.dataset.field;
                document.getElementById("start_year").value =
                    editButton.dataset.start;
                document.getElementById("end_year").value =
                    editButton.dataset.end;

                form.setAttribute("data-id", id); // Simpan ID untuk update UI
                openModal();
            }
        });

        // --- Event listener untuk menutup modal ---
        modal.addEventListener("click", (e) => {
            if (
                e.target === modal ||
                e.target.closest(".close-education-modal") ||
                e.target.closest(".cancel-education-modal")
            ) {
                closeModal();
            }
        });

        // --- Event listener untuk submit form (AJAX) ---
        form.addEventListener("submit", async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.action;
            const method = document.getElementById(
                "education-method-field"
            ).value;

            // Tambahkan token CSRF secara manual ke header
            const headers = {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            };

            try {
                const response = await fetch(url, {
                    method: "POST", // Form method is always POST for AJAX, real method is in formData (_method)
                    headers: headers,
                    body: formData,
                });

                const result = await response.json();

                if (result.success) {
                    // Tampilkan notifikasi sukses (misal: menggunakan SweetAlert atau library notifikasi lainnya)
                    alert(result.message);
                    // Refresh halaman untuk melihat perubahan (cara simpel)
                    // location.reload();
                    // atau update UI secara dinamis (lebih baik)
                    updateEducationList();
                    closeModal();
                } else {
                    // Handle error (misal: tampilkan pesan error validasi)
                    alert(result.message || "An error occurred.");
                }
            } catch (error) {
                console.error("Error submitting form:", error);
                alert(
                    "An unexpected error occurred. Please check the console."
                );
            }
        });

        // --- Event listener untuk DELETE (AJAX) ---
        educationList.addEventListener("click", async function (e) {
            const deleteButton = e.target.closest(".delete-education-btn");
            if (deleteButton) {
                const id = deleteButton.dataset.id;

                // Konfirmasi sebelum menghapus
                if (
                    !confirm(
                        "Are you sure you want to delete this education history?"
                    )
                ) {
                    return;
                }

                const url = `/profile/education/${id}`;
                const headers = {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "X-Requested-With": "XMLHttpRequest",
                    Accept: "application/json",
                };

                try {
                    const response = await fetch(url, {
                        method: "DELETE",
                        headers: headers,
                    });

                    const result = await response.json();

                    if (result.success) {
                        alert(result.message);
                        // Hapus elemen dari DOM
                        deleteButton
                            .closest(".flex.items-start.gap-4")
                            .remove();
                    } else {
                        alert(result.message || "Failed to delete.");
                    }
                } catch (error) {
                    console.error("Error deleting education:", error);
                    alert("An unexpected error occurred.");
                }
            }
        });

        // Fungsi untuk me-refresh daftar pendidikan (contoh sederhana)
        // Untuk implementasi yang lebih canggih, Anda bisa membuat elemen baru dari response.data
        async function updateEducationList() {
            const response = await fetch("{{ route('profile.index') }}", {
                headers: {
                    Accept: "text/html",
                    "X-Requested-With": "XMLHttpRequest",
                },
            });
            const html = await response.text();
            const newDoc = new DOMParser().parseFromString(html, "text/html");
            const newEducationList =
                newDoc.getElementById("education-list").innerHTML;
            educationList.innerHTML = newEducationList;
        }
    });
}
