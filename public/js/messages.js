window.onload = function () {
    // click on X in emoji menu
    $(".delete").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("href");
        let parent = $(this).parent();

        if (!confirm('Do you really want to delete selected emoji?\n(This action is not reversable)'))
            return false;

        $.ajax({
            url: `messages/emoji/${id}`,
            type: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content
            },
            success: function() {
              parent.remove();
            }
        });

        return false;
    });

    // click on emoji image in emoji menu
    $(".emoji").click(function (e) {
        e.preventDefault();
        let emoji = $(this).attr("href");
        $("#input").val($("#input").val() + emoji); // appends emoji into text
        return false;
    });
}
