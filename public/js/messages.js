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
            success: function () {
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

    let activeGroup = $(".group_id").attr('id');
    let activeGroupElement = $(".group_id")[0];
    let latestId = -1;

    $(".group_id").click(function (e) {
        e.preventDefault();
        if ($(e.target).is('a'))
            location = e.target.href;
        if (!$(e.target.parentElement).is('li'))
            return;
        activeGroupElement.classList.remove('selected');
        activeGroupElement = e.target.parentElement;
        activeGroup = activeGroupElement.getAttribute("id");

        $('input[name="group_id"]').val(activeGroup);
        $('#audio').attr('href', `/messages/audio/create/${activeGroup}`);

        activeGroupElement.classList.add('selected');
        $('#group_name').text($(activeGroupElement).find('.user_info>span').text());
        loadMessages();
    });

    $(".group_id").children()[0].click(null);

    function loadMessages() {
        $.ajax({
            url: `messages/${activeGroup}`,
            type: 'get',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content
            },
            success: showMessages
        });
    }

    function checkForChanges() {
        let id = $.ajax({
            url: `messages/pulse/${activeGroup}`,
            type: 'get',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content
            },
            success: function (e) {
                console.log('check');
                if (e != latestId)
                    console.log('load');
                loadMessages();
            }
        })
    }


    function showMessages(messages) {
        $('#messages').empty();
        messages = JSON.parse(messages);
        let my_id = activeGroupElement.getAttribute('data-my_id');
        for (let message of messages) {
            html = messageHTML(message, my_id);
            $('#messages').append(html);
        }
        latestId = messages.pop().id;
    }

    function messageHTML(message, my_id) {
        switch (message.type) {
            case 'text':
                html = message.content;
                break;
            case 'audio':
                html = `<audio controls src="${message.content}">`
                break;
            case 'photo':
                html = `<a href="${message.content}"><img src="${message.content}" width="300px"></a>`
                break;
        }
        let placement, colour, x;
        if (my_id == message.group_member_id) {
            placement = 'end';
            colour = 'msg_cotainer_send';
            x = `<span class="delete-message" onclick="deleteMessage(${message.id})">X</span>`
        } else {
            placement = 'start'
            colour = 'msg_cotainer';
            x = '';
        }

        return $(`<div class="d-flex justify-content-${placement} mb-4">`).append('<div class="img_cont_msg"><img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg"></div>' +
            `<div class="${colour}">${html}` +
            `<span class="msg_time">8:40 AM, Today</span></div>${x}`);
    }


    $('#send').click(function (e) {
        let text = $('#input');
        let id = activeGroup;

        $.ajax({
            url:
    `messages/groups/${id}`
,
            type: 'post',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content
            },
            data: {"text": text.val()},
            success: loadMessages
        });

        text.val(''); // clear text
    });

    // setInterval(checkForChanges, 30000);
}

function deleteMessage(id) {
    if (confirm('Ar tikrai norite ištrinti šią žinutę?'))
    {
        $.ajax({
            url: `messages/${id}`,
            type: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content
            },
            success: function (e) {
                // parent.remove();
                document.write(e);
            }
        });

        return false;
    }
}
