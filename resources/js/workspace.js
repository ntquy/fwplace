$(document).ready(function () {
    $('.delete').click(function () {
        return confirm($(this).attr('message'));
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image-display').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#input-display").change(function () {
    readURL(this);
});
