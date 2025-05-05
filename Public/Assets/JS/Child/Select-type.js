document.addEventListener('DOMContentLoaded', () => {
    const customSelectTrigger = document.querySelector('.custom-select-trigger');
    const customSelectContainer = document.querySelector('.custom-select-container');

    let dropdownTimeout;

    customSelectTrigger.addEventListener('click', (event) => {
        event.stopPropagation();
        customSelectContainer.classList.toggle('active');
    });

    const customOptions = document.querySelectorAll('.custom-option');

    customOptions.forEach(option => {
        option.addEventListener('click', function() {
            customSelectTrigger.innerHTML = `${this.innerText} <i class="fa fa-chevron-down"></i>`; // Update trigger text
            customSelectContainer.classList.remove('active');
        });
    });

    customSelectContainer.addEventListener('mouseenter', () => {
        clearTimeout(dropdownTimeout);
    });

    customSelectContainer.addEventListener('mouseleave', () => {
        dropdownTimeout = setTimeout(() => {
            customSelectContainer.classList.remove('active');
        }, 300);
    });
});