<?php

// ================================
// PHP FILE UPLOAD
// ================================

// Folder tempat file disimpan
$target_dir = "uploads/";

// Cek apakah tombol Upload ditekan
if (isset($_POST["submit"])) {

    // Nama file yang dipilih user
    $file_name = basename($_FILES["fileToUpload"]["name"]);

    // Lokasi lengkap file
    $target_file = $target_dir . $file_name;

    // Status upload
    $uploadOk = 1;

    // Mengambil ekstensi file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // ================================
    // 1. CEK APAKAH FILE BENAR-BENAR GAMBAR
    // ================================

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($check !== false) {
        echo "File adalah gambar: " . $check["mime"] . "<br>";
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.<br>";
        $uploadOk = 0;
    }


    // ================================
    // 2. CEK APAKAH FILE SUDAH ADA
    // ================================

    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.<br>";
        $uploadOk = 0;
    }


    // ================================
    // 3. BATASI UKURAN FILE
    // Maksimal 500 KB
    // ================================

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Maaf, ukuran file terlalu besar. Maksimal 500 KB.<br>";
        $uploadOk = 0;
    }


    // ================================
    // 4. BATASI JENIS FILE
    // ================================

    if (
        $imageFileType != "jpg" &&
        $imageFileType != "jpeg" &&
        $imageFileType != "png" &&
        $imageFileType != "gif"
    ) {
        echo "Maaf, hanya JPG, JPEG, PNG & GIF yang diperbolehkan.<br>";
        $uploadOk = 0;
    }


    // ================================
    // 5. PROSES UPLOAD
    // ================================

    if ($uploadOk == 0) {

        echo "File tidak berhasil di-upload.";

    } else {

        if (
            move_uploaded_file(
                $_FILES["fileToUpload"]["tmp_name"],
                $target_file
            )
        ) {

            echo "File " .
                htmlspecialchars(
                    basename($_FILES["fileToUpload"]["name"])
                ) .
                " berhasil di-upload.";

        } else {

            echo "Terjadi error saat meng-upload file.";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP File Upload</title>
</head>

<body>

    <h2>PHP File Upload</h2>

    <form
        action=""
        method="post"
        enctype="multipart/form-data"
    >

        <label>Pilih gambar:</label>

        <br><br>

        <input
            type="file"
            name="fileToUpload"
            id="fileToUpload"
        >

        <br><br>

        <input
            type="submit"
            value="Upload Image"
            name="submit"
        >

    </form>

</body>

</html>
