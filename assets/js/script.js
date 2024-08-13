$(document).ready(function() {
    // Thêm hàng mới
    $('#add-row-btn').click(function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" placeholder="Tên"></td>
                <td><input type="text" class="form-control" placeholder="Số máy lẻ"></td>
                <td><input type="text" class="form-control" placeholder="Thành phố"></td>
                <td><input type="date" class="form-control"></td>
                <td><input type="text" class="form-control" placeholder="Hoàn thành"></td>
                <td>
                    <button class="btn btn-sm btn-primary save-btn">Lưu</button>
                    <button class="btn btn-sm btn-danger delete-btn">Xóa</button>
                </td>
            </tr>`;
        $('table tbody').append(newRow);
    });

    // Sửa hàng
    $(document).on('click', '.edit-btn', function() {
        let row = $(this).closest('tr');
        row.find('td').each(function() {
            if (!$(this).find('button').length) {
                let content = $(this).text();
                $(this).html('<input type="text" class="form-control" value="' + content + '">');
            }
        });
        $(this).text('Lưu').removeClass('edit-btn').addClass('save-btn');
    });

    // Lưu hàng
    $(document).on('click', '.save-btn', function() {
        let row = $(this).closest('tr');
        row.find('td').each(function() {
            if (!$(this).find('button').length) {
                let content = $(this).find('input').val();
                $(this).html(content);
            }
        });
        $(this).text('Sửa').removeClass('save-btn').addClass('edit-btn');
    });

    // Xóa hàng
    $(document).on('click', '.delete-btn', function() {
        if (confirm('Bạn có chắc chắn muốn xóa hàng này không?')) {
            $(this).closest('tr').remove();
        }
    });
});

$(document).ready(function() {
    $('#detailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Nút được nhấn
        var stt = button.data('stt');
        var temperature = button.data('temperature');
        var humidity = button.data('humidity');
        var windSpeed = button.data('wind-speed');
        var windDirection = button.data('wind-direction');
        var solarRadiation = button.data('solar-radiation');

        // Cập nhật thông tin trong modal
        var modal = $(this);
        modal.find('#modal-stt').text(stt);
        modal.find('#modal-temperature').text(temperature);
        modal.find('#modal-humidity').text(humidity);
        modal.find('#modal-wind-speed').text(windSpeed);
        modal.find('#modal-wind-direction').text(windDirection);
        modal.find('#modal-solar-radiation').text(solarRadiation);
    });
});