$(document).ready(function () {
    $('#stu_name').keyup(function (event) {
        event.preventDefault();

        var stu_name = $('#stu_name').val();

        if (stu_name !== '') {
            $.ajax({
                url: "<?=ROOT?>/Teacher/Students",
                method: "POST",
                data: {
                    action: 'SearchRecord', // 🔥 directly write it here
                    stu_name: stu_name
                },
                success: function (data) {
                    alert(data);
                }
            });
        }
    });
});
