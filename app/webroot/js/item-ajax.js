$( document ).ready(function() {
    $('.confirm-delete').click(function () {
        var user_id = $(this).val();
        if (confirm('Bạn có chắc chắc muốn xóa User')) {
            $('#form_detele_' + user_id).submit();
        } else {
            return false;
        }
    });

    $('.confirm-delete_order').click(function () {
        var user_id = $(this).val();
        if (confirm('Bạn có chắc chắc muốn xóa Order')) {
            $('#form_detele_order_' + user_id).submit();
        } else {
            return false;
        }
    });

    $(".edit_user").click(function(e){

        var user_id = $(this).val();
        if(user_id != ''){
            $.ajax({
                url: 'user/getUserById',
                async: false,
                data: {user_id: user_id},
                dataType: 'json',
                type: 'POST'
            }).done(function(data) {
                $("#edit-item").find("input[name='first_name']").val(data.data.firstname);
                $("#edit-item").find("input[name='last_name']").val(data.data.lastname);
                $("#edit-item").find("input[name='email']").val(data.data.email);
                $("#edit-item").find("input[name='address_2']").val(data.data.user_address.address_2);
                $("#edit-item").find("input[name='province']").val(data.data.user_address.province);
                $("#edit-item").find("input[name='locality']").val(data.data.user_address.locality);
                $("#edit-item").find("input[name='address']").val(data.data.user_address.address_1);
                $("#edit-item").find("input[name='zipcode']").val(data.data.user_address.zipcode);
                $("#edit-item").find("input[name='id']").val(data.data.id);
            });
        }else{
            alert('You are missing title or description.');
        }
    });

    $(".edit_order").click(function(e){

        var order_id = $(this).val();
        if(order_id != ''){
            $.ajax({
                url: 'order/getOrderById',
                async: false,
                data: {order_id: order_id},
                dataType: 'json',
                type: 'POST'
            }).done(function(data) {
                $("#edit-item_order").find("input[name='name_product']").val(data.data.name);
                $("#edit-item_order").find("input[name='description']").val(data.data.description);
                $("#edit-item_order").find("select[name='tinh_trang']").val(data.data.order_detail.status);
                $("#edit-item_order").find("input[name='order_id']").val(data.data.id);
            });
        }else{
            alert('You are missing title or description.');
        }
    });

});
