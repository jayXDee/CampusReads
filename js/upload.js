// JavaScript to display the cover image preview
const coverImageInput = document.getElementById('cover-image');
const coverImagePreview = document.getElementById('cover-image-preview');

coverImageInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function() {
        coverImagePreview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        coverImagePreview.src = 'https://www.iconpacks.net/icons/2/free-file-icon-1453-thumb.png';
    }
});
