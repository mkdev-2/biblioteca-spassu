let deleteUrl;

export function openDeleteModal(actionUrl) {
    deleteUrl = actionUrl; 
    const deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    deleteModal.show();
}

export function showToast(message = 'Exclusão realizada com sucesso!') {
    const toastElement = document.getElementById('successToast');
    const toastBody = toastElement.querySelector('.toast-body');
    
    // Atualiza a mensagem do toast se fornecida
    if (toastBody && message) {
        toastBody.textContent = message;
    }

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
                return response.json().then(data => {
                    if (!response.ok) {
                        throw new Error(data.error || 'Erro ao excluir o item.');
                    }
                    return data;
                });
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
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                location.reload();
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
