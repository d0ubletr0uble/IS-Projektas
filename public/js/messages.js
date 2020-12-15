window.onload = function () {

    fetch('/messages/emoji/list').then(r => r.json()).then(s => {
            dict = {};
            s.forEach(e => dict[e.name] = `/storage/emoji/${e.link}`);
            window.emojis = dict;
            window.emoji_re = new RegExp( Object.keys(dict).join("|"), "g");
        }
    );

    // click on X in emoji menu
    $(".delete").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("href");
        let parent = $(this).parent();

        if (!confirm('Ar tikrai norite ištrinti pasirinktą emoji?'))
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
                html = $('<div/>').text(message.content).html();
                if (!emoji_re.toString().includes('?'))
                    html = html.replace(emoji_re, s => `<img src="${emojis[s]}">`);
                break;
            case 'audio':
                html = `<audio controls src="${$('<div/>').text(message.content).html()}">`
                break;
            case 'photo':
                html = `<a href="${$('<div/>').text(message.content).html()}"><img src="${message.content}" width="300px"></a>`
                break;
        }
        let placement, colour, x, tooltip;
        if (my_id == message.group_member_id) {
            let status = message.status;
            status = status == 'sent' ? 'Žinutė išsiųsta' : status;
            status = status == 'read' ? 'Žinutė perskaityta' : status;
            placement = 'end';
            colour = 'msg_cotainer_send';
            x = `<span class="delete-message" onclick="deleteMessage(${message.id})">X</span>`
            tooltip = `data-toggle="tooltip" data-placement="top" title="${status}"`
        } else {
            placement = 'start'
            colour = 'msg_cotainer';
            x = '';
            tooltip = '';
        }

        return $(`<div class="d-flex justify-content-${placement} mb-4">`).append('<div class="img_cont_msg"><img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg"></div>' +
            `<div class="${colour}" ${tooltip}>${html}` +
            `<span class="msg_time">${message.created_at.split('T')[0]}</span></div>${x}`);
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
    if (confirm('Ar tikrai norite ištrinti šią žinutę?')) {
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
