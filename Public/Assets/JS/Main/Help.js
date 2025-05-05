document.addEventListener('DOMContentLoaded', function () {
    // image input of the needed help
    const imageInput = document.getElementById('image');
    const imagegroup = document.getElementById('image-group');
    const cancel = document.getElementById('cancel');
    const contactInput = document.getElementById('contact');
    const messageInput = document.getElementById('message');
    const back = document.getElementById('back');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagegroup.innerHTML = '';
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;

                const fileName = document.createElement('span');
                fileName.textContent = `File Name: ${file.name}`;

                const fileSize = document.createElement('span');
                fileSize.textContent = `Size: ${(file.size / 1024).toFixed(2)} KB`;

                imagegroup.appendChild(fileName);
                imagegroup.appendChild(document.createElement('br')); // Line break
                imagegroup.appendChild(fileSize);
                imagegroup.classList.add("custom-file-upload");
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '';
        }
    });

    cancel.addEventListener('click', function () {
        contactInput.value = '';
        messageInput.value = '';
        imageInput.value = '';

        console.log("Hi");
        imagegroup.innerHTML = ``;
        imagegroup.innerHTML = `
        <label for="image">Add image</label>
        <label class="custom-file-upload" for="image">+ Choose File</label>
    `;
        imagegroup.classList.remove("custom-file-upload");
    });

    back.addEventListener('click', function () {
        window.history.back();
    });
});