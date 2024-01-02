// delete modal

const allModals = document.querySelectorAll('.modal-delete');

for (const modal of allModals) {
    const buttonOpen = modal.querySelector('.open-modal');
    const modalForm = modal.querySelector('.modal-form');
    buttonOpen.addEventListener('click', function () {
        console.log(buttonOpen);
        modalForm.classList.toggle('visible');
    });
}

// update/delete modal
