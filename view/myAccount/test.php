<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Switch</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* styles.css */

    .custom-file-upload {
        background-color: #007bff;
        color: #fff;
        padding: 8px 20px;
        border-radius: 5px;
        cursor: pointer;
        display: inline-block;
        margin-right: 10px;
    }

    .custom-file-upload:hover {
        background-color: #0056b3;
    }

    #file-name {
        vertical-align: middle;
    }
</style>

<body>
    <div class="photo">
        <label class="custom-file-upload" for="photo">Choisir un fichier</label>
        <input type="file" name="photo" id="photo" style="display: none;">
        <span id="file-name">Aucun fichier choisi</span>
    </div>

    <script>
        document.getElementById('photo').addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'Aucun fichier choisi';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>

</html>