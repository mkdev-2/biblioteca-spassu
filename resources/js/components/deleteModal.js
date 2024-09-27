let deleteUrl;

export function openDeleteModal(actionUrl) {
    deleteUrl = actionUrl; 
    const deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    deleteModal.show();
}

export function showToast() {
    const toastElement = document.getElementById('successToast');
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
}

window.openDeleteModal = openDeleteModal;
window.showToast = showToast;

document.addEventListener('DOMContentLoaded', function() {
    const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');
    if (deleteConfirmBtn) {
        deleteConfirmBtn.addEventListener('click', function() {
            if (!deleteUrl) {
                console.error('URL de exclusão não definida.');
                return; 
            }
            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao excluir o item.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const rowToRemove = document.querySelector(`tr[data-id='${deleteUrl.split('/').pop()}']`);
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                    showToast(); 
                    setTimeout(() => location.reload(), 2000); 
                } else {
                    console.error('Erro ao excluir o item:', data.error);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Ocorreu um erro ao tentar excluir o item. Por favor, tente novamente.');
            });
        });
    }

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const actionUrl = this.getAttribute('data-action-url');
            openDeleteModal(actionUrl);
        });
    });
});
