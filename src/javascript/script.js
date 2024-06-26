$(document).ready(function () {
    $('.btn-update').click(function () {
        const postId = $(this).data('id');
        const postTitle = $(this).data('title');
        const postContent = $(this).data('content');

        $('#updatePostId').val(postId);
        $('#updateTitle').val(postTitle);
        $('#updateContent').val(postContent); 
    });

    $('#btnAdd').submit(function () {
        $("modaladd").modal("toggle");
        return false;
    });

    $("#addPostModal").submit(function (event) {
        event.preventDefault();

        const $form = $(this);
        const $inputs = $form.find("input, select, button");
        const serializedData = $form.serialize();
        console.log(serializedData);

        $inputs.prop("disabled", true);

        request = $.ajax({
            url: "views/posts/addPost.php",
            type: "post",
            data: serializedData,
        });

        request.done(function (response, textStatus, jqXHR) {
            if (response === "Success") {
                alert("Added a post");
                location.reload(true);
            } else console.log("Post wasn't added: " + response);
            console.log(response);
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error("The following error occurred: " + textStatus, errorThrown);
        });

        request.always(function () {
            $inputs.prop("disabled", false);
        });
    });
  

    
});


