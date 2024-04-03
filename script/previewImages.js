
        function previewImages(input) {
            var preview = document.getElementById('imagesPreview');
            preview.innerHTML = '';
            if (input.files && input.files.length) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.width = 150; // Adjust width as needed
                        img.height = 150; // Adjust height as needed
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
