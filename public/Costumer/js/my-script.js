$(document).ready(function () {
    let jumlah = $('input[name="jumlah"]');

    let getHarga = $('input[name="harga"]');

    let x = jumlah.val() * getHarga.val();

    let totalHarga = $('input[name="total_harga"]');

    totalHarga.val(x);

    $('input[name="jumlah"]').change(function () {
        console.log($(this).val());

        let total_harga = $('input[name="total_harga"]');
        let getHarga = $('input[name="harga"]');

        let x = $(this).val() * getHarga.val();

        total_harga.val(x);
        console.log(x);
    });
});

function previewImage() {
    const image = document.querySelector("#image");

    const imgPreview = document.querySelector("#img-preview");

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}
