import { showNotification } from './notification.js';

export function initEducationModal() {
    const container = document.getElementById('education-list-container');
    if (!container) {
        return;
    }

    const storeUrl = container.dataset.storeUrl;
    const baseUpdateUrl = container.dataset.baseUpdateUrl;

    const modal = document.getElementById('education-modal');
    const modalContent = document.getElementById('education-modal-content');
    const form = document.getElementById('education-form');
    const modalTitle = document.getElementById('education-modal-title');
    const submitButton = document.getElementById('education-submit-button');
    const methodField = document.getElementById('education-method-field');

    /**
     * Fungsi untuk membuka modal dengan animasi.
     */
    const openModal = () => {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10); // delay kecil untuk transisi
    };

    /**
     * Fungsi untuk menutup modal dengan animasi.
     */
    const closeModal = () => {
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            form.reset();
            form.removeAttribute('data-id');
        }, 300);
    };

    /**
     * Menyiapkan modal untuk mode "ADD".
     */
    document.getElementById('add-education-btn').addEventListener('click', () => {
        form.reset();
        modalTitle.textContent = 'Add Education History';
        submitButton.textContent = 'Save';
        form.action = storeUrl; // Gunakan URL untuk 'store'
        methodField.value = 'POST';
        openModal();
    });

    /**
     * Menyiapkan modal untuk mode "EDIT" menggunakan event delegation.
     */
    container.addEventListener('click', function(e) {
        const editButton = e.target.closest('.edit-education-btn');
        if (editButton) {
            const id = editButton.dataset.id;
            modalTitle.textContent = 'Edit Education History';
            submitButton.textContent = 'Save Changes';
            form.action = `${baseUpdateUrl}/${id}`; // URL dinamis untuk 'update'
            methodField.value = 'PUT';

            // Isi form dengan data dari tombol yang diklik
            document.getElementById('degree').value = editButton.dataset.degree;
            document.getElementById('institution_name').value = editButton.dataset.institution;
            document.getElementById('field_of_study').value = editButton.dataset.field;
            document.getElementById('start_year').value = editButton.dataset.start;
            document.getElementById('end_year').value = editButton.dataset.end;

            form.setAttribute('data-id', id);
            openModal();
        }
    });

    /**
     * Event handler untuk menutup modal.
     */
    modal.addEventListener('click', e => {
        // Tutup jika klik di luar konten, tombol close, atau tombol cancel
        if (e.target === modal || e.target.closest('.close-education-modal') || e.target.closest('.cancel-education-modal')) {
            closeModal();
        }
    });

    /**
     * Meng-handle submit form (ADD dan EDIT) menggunakan Fetch API (AJAX).
     */
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const url = this.action;

        // Ambil token CSRF dari meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(url, {
                method: 'POST', // AJAX selalu 'POST', method asli (PUT/POST) dikirim via _method
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const result = await response.json();

            if (response.ok && result.success) {
                showNotification('Success!', result.message, true);
                setTimeout(() => location.reload(), 1500); // Reload setelah notifikasi terlihat
                closeModal();
            } else {
                 // Menampilkan error validasi atau error lainnya
                const errorMessage = result.message || 'An error occurred.';
                showNotification('Woopsie!', errorMessage, false);
            }
        } catch (error) {
            console.error('Submit error:', error);
            showNotification('Error', 'An unexpected network error occurred.', false);
        }
    });

    /**
     * Meng-handle aksi DELETE menggunakan event delegation.
     */
    container.addEventListener('click', async function(e) {
        const deleteButton = e.target.closest('.delete-education-btn');
        if (deleteButton) {
            const id = deleteButton.dataset.id;

            if (!confirm('Are you sure you want to delete this education history?')) {
                return;
            }

            const deleteUrl = `${baseUpdateUrl}/${id}`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                 const response = await fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showNotification('Deleted!', result.message, true);
                    // Hapus elemen dari tampilan tanpa reload
                    document.getElementById(`education-item-${id}`).remove();
                } else {
                    showNotification('Failed', result.message || 'Failed to delete.', false);
                }
            } catch (error) {
                console.error('Delete error:', error);
                showNotification('Error', 'An unexpected network error occurred.', false);
            }
        }
    });
}
