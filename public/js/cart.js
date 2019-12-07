$(function() {

    $('.qtyplus').click(function(e){
        e.preventDefault();
        fieldName = $(this).attr('field');

        //Fetch qty in the current elements context and since you have used class selector use it.
        var qty = $(this).closest('tr').find('.qty');
        var currentVal = parseInt(qty.val());
        if (!isNaN(currentVal)) {
            qty.val(currentVal + 1);
        } else {
            qty.val(0);
        }

        //Trigger change event
        //ajaxCall($(this).closest('tr').find('.qty'), 1).val();
        qty.trigger('change');
    });

    $(".qtyminus").click(function(e) {

        e.preventDefault();
        fieldName = $(this).attr('field');

        //Fetch qty in the current elements context and since you have used class selector use it.
        var qty = $(this).closest('tr').find('.qty');
        var currentVal = parseInt(qty.val());
        if(currentVal > 1)
        {
            if (!isNaN(currentVal)) {
                qty.val(currentVal - 1);
            } else {
                qty.val(0);
            }
        }
        //Trigger change event
        qty.trigger('change');
    });

    //Bind the change event
    $(".qty").change(function() {
        var sum = 0;
        var total = 0;
        $('.price_jq').each(function () {
            var price = $(this);
            var count = price.closest('tr').find('.qty');
            sum = (price.html() * count.val());
            total = total + sum;
            price.closest('tr').find('.cart_total_price').html(sum + " $");
        });
        $('#total').html("<h3>$ " + total + "</h3>");

    }).change(); //trigger change event on page load

});

$(document).ready(function(){
    $(".qty").change(function(){
        var id = $(this).parent().siblings().find('.clientval').val();
        var quantity = $(this).closest('tr').find('.qty').val();
        $.ajax({
            url: 'update_cart',
            type: 'get',
            dataType: 'json',
            data:
                {
                    'id': id,
                    'quantity': quantity,
                },
            success: function (response) {
            }, error: function (error) {
            }
        });
    });
});
