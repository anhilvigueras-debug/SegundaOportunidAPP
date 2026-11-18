document.addEventListener('submit', (event) => {
    const form = event.target.closest('form[data-confirmar]');

    if (form && !window.confirm(form.dataset.confirmar)) {
        event.preventDefault();
    }
});
