<!DOCTYPE html>
<html>
<head>
    <title>
        2
    </title>
</head>
<body>


<script type="text/javascript">
        function UpladFile() {
            var fileObj = document.getElementById("file").files[0]; // js 获取文件对象
            var FileController = "../file/save";                    // 接收上传文件的后台地址
            // FormData 对象
            var form = new FormData();
            form.append("author", "hooyes");                        // 可以增加表单数据
            form.append("file", fileObj);                           // 文件对象
            // XMLHttpRequest 对象
            var xhr = new XMLHttpRequest();
            xhr.open("post", FileController, true);
            xhr.onload = function () {
                // alert("上传完成!");
            };
            xhr.upload.addEventListener("progress", progressFunction, false);
            xhr.send(form);
        }
        function progressFunction(evt) {
            var progressBar = document.getElementById("progressBar");
            var percentageDiv = document.getElementById("percentage");
            if (evt.lengthComputable) {
                progressBar.max = evt.total;
                progressBar.value = evt.loaded;
                percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";
            }
        }
    </script>
<progress id="progressBar" value="0" max="100">

</progress>

<span id="percentage"></span>

<br />

<input type="file" id="file" name="myfile" />

<input type="button" onclick="UpladFile()" value="上传" />

</body>

</html>