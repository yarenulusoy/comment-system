<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="TR" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <link rel="stylesheet" href="style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body>
    <div>
        <div id="comments" class="comments">
            <div class="comment-form-container">
                <form action="" id="frm-comment" method="post">

                    <div class="input-row">
                        <label for="">Ad Soyad *</label> <br>
                        <input type="hidden" name="comment_id" id="commentId" /> <input class="input-field" type="text" name="name" id="name" required="required" />

                    </div>
                    <div class="input-row">
                        <label for="">E-posta * </label> <br>
                        <input class="input-field" type="email" name="mail" id="mail" required="required" />

                    </div>
                    <div class="input-row">
                        <label for="">Yorumunuz</label>
                        <textarea class="input-field-text" type="text" name="comment" id="comment" required="required"></textarea>
                    </div>
                    <div>
                        <input type="submit" class="btn-submit" id="submitButton" value="Gönder" />
                    </div>

                </form>

            </div>
            <div id="output"></div>

            <script>
                function postReply(commentId) {
                    $('#commentId').val(commentId);
                    $("#name").focus();
                }

                $("#submitButton").click(function() {
                    $("#comment-message").css('display', 'none');
                    var str = $("#frm-comment").serialize();


                    $.ajax({
                        url: "comments_add.php",
                        data: str,
                        type: 'post',

                        success: function(response) {
                            var result = eval('(' + response + ')');
                            if (response) {
                                alert("Mesajınız ulaştı !");
                                $("#comment-message").css('display', 'inline-block');
                                $("#name").val("");
                                $("#comment").val("");
                                $("#commentId").val("");
                                $("#mail").val("");
                                listComment();


                            } else {
                                alert("Tekrar deneyin !");
                                return false;
                            }
                        }
                    });
                });

                $(document).ready(function() {
                    listComment();
                });

                function listComment() {
                    $.post("comments_list.php", {

                        },
                        function(data) {
                            var data = JSON.parse(data);

                            var comments = "";
                            var replies = "";
                            var item = "";
                            var parent = -1;
                            var results = new Array();

                            var list = $("<ul class='outer-comment'>");
                            var item = $("<li>").html(comments);

                            for (var i = 0;
                                (i < data.length); i++) {
                                var commentId = data[i]['id'];
                                parent = data[i]['id_reply'];
                                comment_date = data[i]['comment_date'];
                                var newdate = comment_date.split("-").reverse().join("-");


                                if (parent == "0") {
                                    comments =
                                        "<div class='comment-row'>" +
                                        "<div class='comment-info'><span class='commet-row-label'></span> <span class='posted-by'>" + data[i]['name'] + " </span><div> </div><span class='commet-row-label'></span> <span class='posted-at'>" + newdate + "</span></div>" +
                                        "<div class='comment-text'>" + data[i]['comment'] + "</div>" +
                                        "<div><a class='btn-reply' onClick='postReply(" + commentId + ")'>Cevapla</a></div>" +
                                        "</div>"

                                    var item = $("<li>").html(comments);
                                    list.append(item);
                                    var reply_list = $('<ul>');
                                    item.append(reply_list);
                                    listReplies(commentId, data, reply_list);
                                }
                            }
                            $("#output").html(list);
                        });
                }

                function listReplies(commentId, data, list) {
                    for (var i = 0;
                        (i < data.length); i++) {
                        comment_date = data[i]['comment_date'];
                        var newdate = comment_date.split("-").reverse().join("-");
                        if (commentId == data[i].id_reply) {

                            var comments =
                                "<div class='comment-row'>" +
                                "<div class='comment-info'><span class='commet-row-label'></span> <span class='posted-by'>" + data[i]['name'] + " </span> <span class='commet-row-label'></span><div></div> <span class='posted-at'>" + newdate + "</span></div>" +
                                "<div class='comment-text'>" + data[i]['comment'] + "</div>" +
                                "<div style='display:none'><a class='btn-reply' onClick='postReply(" + data[i]['id'] + ")'>Cevapla</a></div>" +

                                "</div>";
                            var item = $("<li>").html(comments);
                            var reply_list = $('<ul>');
                            list.append(item);
                            item.append(reply_list);
                            listReplies(data[i].id, data, reply_list);
                        }
                    }
                }
            </script>

        </div>
    </div>
    </div>
</body>

</html>
