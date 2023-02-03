<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <form id=url_process>
        <input type="file"  name="url_list" id="url_list">
        <input type="button" value="Proceed" onclick="process_data()">

        <div id="result"></div>
    </form>
    <script>
        function process_data(){
            
            var file_data = document.getElementById('url_list');
            console.log(file_data);
            var file = file_data.files[0];
            console.log(file);
            if(!file){
                alert('Empty file.');
                return;
            }
            if(file.type != 'text/plain'){
                alert('File must be a text file');
            }
            var reader = new FileReader();
            reader.onload = function(event) {
                var fileContents = event.target.result;
                var urls = fileContents.split('\n');
                console.log(urls);
                var result = document.getElementById('result');
                result.innerHTML = '';
                urls.forEach(function(url) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', url);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            var status = xhr.status;
                            var status_div = document.createElement('div');
                            status_div.innerHTML = url + ': ' + status + ' | '+xhr.responseText;
                            result.appendChild(status_div);
                        }
                    };
                    xhr.send();
                });
            };
            reader.readAsText(file);
        }
    </script>
</body>
</html>