const manageModal = document.querySelector('#manageModal');
const cancelModal = document.querySelector('#cancelManageModal');

// INITIALIZING MODAL TO BOOTSTARP
const manage = new bootstrap.Modal(manageModal);
const cancel = new bootstrap.Modal(cancelModal);

const btnCancel = document.querySelector('.btn-cancelappointment');

btnCancel.addEventListener('click', showCancelModal);

// SHOW CANCEL-MANAGE
function showCancelModal() {
    manage.hide();
    cancel.show();
}