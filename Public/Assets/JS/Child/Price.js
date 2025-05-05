document.addEventListener('DOMContentLoaded', function() {
    const numberInput = document.querySelector('.price');

    numberInput.addEventListener('input', function (e) {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 3) {
            this.value = this.value.slice(0, 3) + ',' + this.value.slice(3);
        }
    });

});