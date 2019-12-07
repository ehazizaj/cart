
function addToCart(id) {
    $.ajax({
        url: 'toCart',
        type: 'get',
        dataType: 'json',
        data:
            {
                'car': id,
                'quantity': 1,
            },
        success: function (response) {
            if (response.status === 'success') {
                $('#added' + id).prop("onclick", null).html('<i class="icon-basket position-left"></i> Added to cart')
                $('#basket').html('*');

            }
        }, error: function (error) {
        }
    });
}
