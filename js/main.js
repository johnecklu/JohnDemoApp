$(document).ready(function(){
    $(".btn-add-product").click(function(){
        var formData = new FormData($(".add-product")[0]);

        $.ajax({
            url: 'addProduct.php',
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
                alert(returndata);
            },
            error: function () {
                alert("error in ajax form submission");
            }
        });

        return false;
    });
});
