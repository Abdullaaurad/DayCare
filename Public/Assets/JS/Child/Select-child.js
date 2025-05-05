document.addEventListener('DOMContentLoaded', () => {
    // selecting child
    const customChildSelectTrigger = document.querySelector('.custom-child-select-trigger');
    const customChildSelectContainer = document.querySelector('.custom-child-select-container');

    customChildSelectTrigger.addEventListener('click', (event) => {
        event.stopPropagation();
        customChildSelectContainer.classList.toggle('active');
    });

    customChildSelectContainer.addEventListener('mouseenter', () => {
        clearTimeout(dropdownTimeout);
    });

    customChildSelectContainer.addEventListener('mouseleave', () => {
        dropdownTimeout = setTimeout(() => {
            customChildSelectContainer.classList.remove('active');
        }, 300);
    });

});