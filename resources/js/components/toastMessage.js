document.addEventListener('DOMContentLoaded', function () {
    var toastSuccess = document.getElementById('toast-success');
    var toastError = document.getElementById('toast-error');

    if (toastSuccess) {
        var toast = new bootstrap.Toast(toastSuccess);
        toast.show();

        setTimeout(function() {
            toast.hide();
        }, 5000); 
    }

    if (toastError) {
        var toast = new bootstrap.Toast(toastError);
        toast.show();

        setTimeout(function() {
            toast.hide();
        }, 5000); 
    }
});