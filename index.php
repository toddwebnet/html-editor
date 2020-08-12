<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>A Simple Page with CKEditor 4</title>
    <!-- Make sure the path to CKEditor is correct. -->
<!--    <script src="ckeditor/ckeditor.js"></script>-->
    <script src="https://cdn.ckeditor.com/4.14.1/standard-all/ckeditor.js"></script>
</head>
<body>
<form>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor 4.
            </textarea>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        // CKEDITOR.replace( 'editor1', {
        //     extraPlugins: 'uploadimage,image2',
        //     uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
        //     filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
        //     filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
        //     filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        //     filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        //     image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
        //     image2_disableResizer: true
        //
        // });


        var roxyFileman = '/fileman/index.html';

            CKEDITOR.replace( 'editor1',{
                filebrowserBrowseUrl:roxyFileman,
                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                removeDialogTabs: 'link:upload;image:upload'
            });
        s
    </script>
</form>
</body>
</html>