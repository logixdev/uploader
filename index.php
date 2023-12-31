<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5LR0N8KNYB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5LR0N8KNYB');
    </script>
    <meta name="robots" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploader</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/solar/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        input[type="file"] {
            width: calc(100% - 12px);
        }

        footer {
            margin-top: auto;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Uploader</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targetDir = __DIR__;
            $fileName = basename($_FILES['file']['name']);
            $targetFilePath = $targetDir . '/' . $fileName;
            $fileSize = $_FILES['file']['size'];

            if ($fileSize > 500 * 1024 * 1024) {
                echo '<div class="alert alert-danger" role="alert">Plik jest zbyt duży. Maksymalny rozmiar to 500 MB.</div>';
            } else {
                if (file_exists($targetFilePath)) {
                    echo '<div class="alert alert-danger" role="alert">Plik o tej nazwie już istnieje. Wybierz inną nazwę pliku.</div>';
                } else {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                        $fileUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/' . $fileName;
                        echo '<div class="alert alert-success" role="alert">Plik został pomyślnie przesłany. Adres URL pliku: <a href="' . $fileUrl . '" target="_blank">' . $fileUrl . '</a></div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Wystąpił błąd podczas przesyłania pliku.</div>';
                    }
                }
            }
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Wybierz plik do przesłania:</label>
                <input type="file" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Prześlij plik</button>
        </form>
    </div>

    <footer>
        <p>&copy; Michał Kansy</p>
    </footer>
</body>
</html>