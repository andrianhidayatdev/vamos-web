function previewLogo(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById("logo");
            img.src = e.target.result;
            img.style.display = "block";
            img.parentNode.querySelector("span").style.display = "none";
        };
        reader.readAsDataURL(file);
    } else {
        alert("Silakan pilih file gambar.");
    }
}

function previewKartuMember(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById("kartuMember");
            img.src = e.target.result;
            img.style.display = "block";
            img.parentNode.querySelector("span").style.display = "none";
        };
        reader.readAsDataURL(file);
    } else {
        alert("Silakan pilih file gambar.");
    }
}
