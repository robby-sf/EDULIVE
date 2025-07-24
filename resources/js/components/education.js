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

    const openModal = () => {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10); // delay kecil untuk transisi
    };

    const closeModal = () => {
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            form.reset();
            form.removeAttribute('data-id');
        }, 300);
    };


    document.getElementById('add-education-btn').addEventListener('click', () => {
        form.reset();
        modalTitle.textContent = 'Add Education History';
        submitButton.textContent = 'Save';
        form.action = storeUrl;
        methodField.value = 'POST';
        openModal();
    });

    container.addEventListener('click', function(e) {
        const editButton = e.target.closest('.edit-education-btn');
        if (editButton) {
            const id = editButton.dataset.id;
            modalTitle.textContent = 'Edit Education History';
            submitButton.textContent = 'Save Changes';
            form.action = `${baseUpdateUrl}/${id}`;
            methodField.value = 'PUT';


            document.getElementById('degree').value = editButton.dataset.degree;
            document.getElementById('institution_name').value = editButton.dataset.institution;
            document.getElementById('field_of_study').value = editButton.dataset.field;
            document.getElementById('start_year').value = editButton.dataset.start;
            document.getElementById('end_year').value = editButton.dataset.end;

            form.setAttribute('data-id', id);
            openModal();
        }
    });


    modal.addEventListener('click', e => {
        if (e.target === modal || e.target.closest('.close-education-modal') || e.target.closest('.cancel-education-modal')) {
            closeModal();
        }
    });


    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const url = this.action;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const result = await response.json();

            if (response.ok && result.success) {
                showNotification('Success!', result.message, true);
                setTimeout(() => location.reload(), 1500);
                closeModal();
            } else {

                const errorMessage = result.message || 'An error occurred.';
                showNotification('Woopsie!', errorMessage, false);
            }
        } catch (error) {
            console.error('Submit error:', error);
            showNotification('Error', 'An unexpected network error occurred.', false);
        }
    });

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
