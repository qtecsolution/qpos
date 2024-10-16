const inputFile = document.getElementById("thumbnailInput");
const thumbnailPreview = document.getElementById("thumbnailPreview");
const uploadText = document.querySelector(".upload-text");

document
    .getElementById("imageUploadContainer")
    .addEventListener("click", function () {
        inputFile.click(); // Trigger the file input when the container is clicked
    });

inputFile.addEventListener("change", function () {
    const reader = new FileReader();
    reader.addEventListener("load", function () {
        thumbnailPreview.src = reader.result;
        thumbnailPreview.classList.remove("d-none"); // Show the preview
        uploadText.classList.add("d-none"); // Hide the upload text
    });
    if (this.files[0]) {
        reader.readAsDataURL(this.files[0]);
    }
});
