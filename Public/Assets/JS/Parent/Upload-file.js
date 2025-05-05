document.addEventListener('DOMContentLoaded', function() {
    const paperclipBtn = document.getElementById('paperclip-btn');
    const uploadContainer = document.getElementById('upload-container');
    const cancelBtn = document.getElementById('cancel-btn');
    const dropArea = document.getElementById('drop-area');
    const uploadBtn = document.getElementById('upload-btn');
    const fileInput = document.getElementById('file-input');
    const uploadcontent = document.getElementById('file-upload')

    // Show upload container when paperclip icon is clicked
    paperclipBtn.addEventListener('click', () => {
        uploadContainer.classList.toggle('active');
    });

    // Hide upload container when cancel button is clicked
    cancelBtn.addEventListener('click', () => {
        uploadContainer.classList.remove('active');
    });

    document.addEventListener('click', (event) => {
        const isClickInside = uploadContainer.contains(event.target) || paperclipBtn.contains(event.target);
        if (!isClickInside) {
            uploadContainer.classList.remove('active');
        }
    });

    // Trigger hidden file input when browse button is clicked
    uploadBtn.addEventListener('click', function () {
        fileInput.click();
    });

    // Handle file selection through the file input
    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            alert("Selected file: " + fileInput.files[0].name);
        }
    });

    // Drag and drop functionality

    // Prevent default behavior (e.g., opening file in browser)
    const preventDefaults = (e) => {
        e.preventDefault();
        e.stopPropagation();
    };

    // Highlight the drop area when a file is dragged over it
    const highlight = () => {
        dropArea.classList.add('dragging');
    };

    // Remove highlight when the file is no longer dragged over the area
    const unhighlight = () => {
        dropArea.classList.remove('dragging');
    };

    // Handle the dropped files
    const handleDrop = (e) => {
        let dt = e.dataTransfer;
        let files = dt.files;
        handleFiles(files); // Process the files
    };

    // Process and handle the uploaded files (could be extended to display the files)
    const handleFiles = (files) => {
        const fileList = document.getElementById('file-list'); // Get the file list container
        fileList.innerHTML = ''; // Clear any previous files

        [...files].forEach(file => {
        const fileElement = document.createElement('div');
        fileElement.classList.add('file-item');
        fileElement.style.display = 'flex';
        fileElement.style.alignItems = 'center';
        fileElement.style.marginBottom = '10px';

        // Create a file icon or preview image
        const iconOrPreview = document.createElement('div');
        iconOrPreview.style.marginRight = '10px';

    // If it's an image, create a preview
        if (file.type.startsWith('image/')) {
            const imgPreview = document.createElement('img');
            imgPreview.src = URL.createObjectURL(file); // Create an image preview
            imgPreview.style.width = '150px';
            imgPreview.style.height = 'auto';
            imgPreview.style.objectFit = 'cover';
            imgPreview.style.borderRadius = '4px';
            iconOrPreview.appendChild(imgPreview);
        } else {
            // Otherwise, create a file icon based on the type
            const fileIcon = document.createElement('i');
            if (file.type === 'application/pdf') {
            fileIcon.classList.add('fas', 'fa-file-pdf');
            } else if (file.type === 'application/msword' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            fileIcon.classList.add('fas', 'fa-file-word');
            } else {
            fileIcon.classList.add('fas', 'fa-file-alt');
            }
            fileIcon.style.fontSize = '24px';
            iconOrPreview.appendChild(fileIcon);
        }
        const fileInfo = document.createElement('div');
        const fileName = document.createElement('p');
        fileName.textContent = file.name;
        fileName.style.margin = '0';
        const fileSize = document.createElement('small');
        fileSize.textContent = `${(file.size / 1024).toFixed(2)} KB`; // Convert size to KB
        fileInfo.appendChild(fileName);
        fileInfo.appendChild(fileSize);

        // Append the icon/preview and file info to the file item element
        fileElement.appendChild(iconOrPreview);
        fileElement.appendChild(fileInfo);

        // Append the file item element to the file list container
        fileList.appendChild(fileElement);

        uploadcontent.classList.toggle('active');
        });
    };

    // Add event listeners for drag-and-drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    // Add event listeners to highlight and unhighlight the drop area
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    // Add event listener to handle file drop
    dropArea.addEventListener('drop', handleDrop, false);
});