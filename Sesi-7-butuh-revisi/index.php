<?php

    $errors = [];
    $success_msg = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_produk = isset($_POST["nama_produk"]) ? trim ($_POST["nama_produk"]) : "";
        $harga = isset($_POST["harga"]) ? trim ($_POST["harga"]) : "";
        $deskripsi = isset($_POST["deskripsi"]) ? trim ($_POST["deskripsi"]) : "";
        $kategori = isset($_POST["kategori"]) ? trim ($_POST["kategori"]) : "";
        $stok = isset($_POST["stok"]) ? trim ($_POST["stok"]) : "";

        if (empty($nama_produk)) {
            $errors[] = "Nama Produk Harus Diisi";
        }

        if (empty($harga) || !is_numeric($harga) || $harga <= 0) {
            $errors[] = "Harga Harus Diisi";
        }

        if (empty($deskripsi)) {
            $errors[] = "Deskripsi Harus Diisi";
        }

        if (empty($kategori)) {
            $errors[] = "Pilih Kategori";
        }

        if ($stok === "" || !is_numeric($stok) || $stok <0) {
            $errors[] = "Jumlah Stok Harus Diisi";
        }

        if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        $file_name = $_FILES["gambar"]["name"];
        $file_size = $_FILES["gambar"]["size"];
        $file_tmp  = $_FILES["gambar"]["tmp_name"];
        }
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ["jpg", "jpeg", "png", "webp"];
        
        if (!in_array($file_ext, $allowed_extensions)) {
            $errors[] = "Format gambar tidak valid. Hanya menerima JPG, JPEG, PNG, dan WEBP.";
        }
        $max_size = 2 * 1024 * 1024;  
        if ($file_size > $max_size) {
            $errors[] = "Ukuran gambar terlalu besar. Maksimal ukuran file adalah 2MB.";
        }
        } else {
        $errors[] = "Wajib mengunggah gambar produk.";
        if (empty($errors)) {
        $success_msg = "Produk berhasil divalidasi dan disimpan di database!";
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Style -->
    <style>
        body {
            background-color: #30261c;
        }

        .font-pd {
            font-family: "Playfair Display", sans-serif;
        }

        .font-outfit {
            font-family: "Outfit", sans-serif;
        }

        .font-poppins {
            font-family: "Poppins", sans-serif;
        }

        .required::after {
            content: " *";
            color: red;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <main class="container bg-light p-4 p-md-5 my-5 rounded shadow-sm">

 <?php 
    
    if (!empty($errors)): ?>
            <div class="alert alert-danger font-outfit" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($success_msg)): ?>
            <div class="alert alert-success font-outfit" role="alert">
                <?php echo $success_msg; ?>
            </div>
        <?php endif; 
?>

    <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
        <section class="d-flex gap-3 justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="50" height="50" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:5.42683" viewBox="903.32 382.81 9104.39 8782.11"><path d="M9310.16 2560.9c245.302 249.894 419.711 539.916 565.373 845.231 47.039 98.872 36.229 215.514-28.2 304.05-64.391 88.536-172.099 134.676-280.631 120.28 0 .053-.039.053-.039.053" style="fill:gray;stroke:#000;stroke-width:206.41px"/><path d="M5401.56 487.044c-127.958 6.227-254.855 40.77-370.992 103.628-765.271 414.225-2397.45 1297.68-3193.03 1728.32-137.966 74.669-250.327 183.605-328.791 313.046l3963.09 2122.43s-249.048 416.428-470.593 786.926c-189.24 316.445-592.833 429.831-919.198 258.219l-2699.36-1419.32v2215.59c0 226.273 128.751 435.33 337.755 548.466 764.649 413.885 2620.97 1418.66 3385.59 1832.51 209.018 113.137 466.496 113.137 675.514 0 764.623-413.857 2620.94-1418.63 3385.59-1832.51 208.989-113.136 337.743-322.193 337.743-548.466v-3513.48c0-318.684-174.59-611.722-454.853-763.409-795.543-430.632-2427.75-1314.09-3193.02-1728.32-141.693-76.684-299.364-111.227-455.442-103.628" style="fill:#dadada;stroke:#000;stroke-width:206.42px"/><path d="M5471.83 4754.46V504.71c-127.958 6.226-325.127 23.1-441.264 85.958-765.271 414.225-2397.45 1297.68-3193.03 1728.32-137.966 74.669-250.327 183.605-328.791 313.046l3963.09 2122.43Z" style="fill:gray;stroke:#000;stroke-width:206.42px"/><path d="m1459.34 2725.96-373.791 715.667c-177.166 339.292-46.417 758 292.375 936.167l4.75 2.5m0 0 2699.37 1419.29c326.374 171.625 729.916 58.25 919.165-258.208 221.542-370.5 470.583-786.917 470.583-786.917l-3963.04-2122.42-2.167 3.458-47.25 90.458" style="fill:#dadada;stroke:#000;stroke-width:206.42px"/><path d="M5443.74 520.879v4149.79" style="fill:none;stroke:#000;stroke-width:153.5px"/><path d="M8951.41 4102.72c0-41.65-22.221-80.136-58.291-100.961s-80.51-20.825-116.58 0l-2439.92 1408.69c-36.07 20.825-58.29 59.311-58.29 100.961V7058c0 41.65 22.22 80.136 58.29 100.961s80.51 20.825 116.58 0l2439.92-1408.69c36.07-20.825 58.291-59.312 58.291-100.962v-1546.59Z" style="fill:#567f67"/><path d="M8951.41 4102.72c0-41.65-22.221-80.136-58.291-100.961s-80.51-20.825-116.58 0l-2439.92 1408.69c-36.07 20.825-58.29 59.311-58.29 100.961V7058c0 41.65 22.22 80.136 58.29 100.961s80.51 20.825 116.58 0l2439.92-1408.69c36.07-20.825 58.291-59.312 58.291-100.962v-1546.59ZM6463.98 5551.29v1387.06l2301.77-1328.92V4222.37z"/><path d="M5443.76 9041.74v-4278.4" style="fill:none;stroke:#000;stroke-width:206.44px;stroke-linejoin:miter"/><path d="m5471.79 4773.86 3829.35-2188.22" style="fill:none;stroke:#000;stroke-width:206.43px;stroke-linejoin:miter"/></svg>
            <h1 class="font-pd fw-bold">Form Input Produk</h1>        
        </section>

        <div class="mt-5 row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="namaProduk" class="form-label fw-bold font-outfit required">Nama Produk</label>
                    <input name="nama_produk" type="text" class="form-control rounded" placeholder="Masukkan Nama Produk" id="namaProduk" required>
                    <div class="invalid-feedback">Nama Produk Harus Diisi</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="harga" class="form-label fw-bold font-outfit required">Harga</label>
                    <input name="harga" type="number" class="form-control rounded" placeholder="Masukkan Harga" id="harga" required>
                    <div class="invalid-feedback">Harga Harus Diisi</div>
                </div>
            </div>
        </div>
        
        <div>
            <label for="deskripsi" class="form-label fw-bold font-outfit required">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control rounded" aria-label="With textarea" placeholder="Masukkan Deskripsi Produk" required></textarea>
            <div class="invalid-feedback">Deskripsi Harus Diisi</div>
        </div>
        
        <div class="mt-3 row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="kategori" class="form-label fw-bold font-outfit required">Kategori</label>
                    <select name="kategori" class="form-select" aria-label="Pilih kategori produk" id="kategori" required>
                        <option disabled <?php echo !isset($_POST['kategori']) ? 'selected' : ''; ?>>-- Pilih Kategori --</option>
                        <option value="1" <?php echo (isset($_POST['kategori']) && $_POST['kategori'] == '1') ? 'selected' : ''; ?>>Hot Coffee</option>
                        <option value="2" <?php echo (isset($_POST['kategori']) && $_POST['kategori'] == '2') ? 'selected' : ''; ?>>Cold Coffee</option>
                        <option value="3" <?php echo (isset($_POST['kategori']) && $_POST['kategori'] == '3') ? 'selected' : ''; ?>>Non Coffee</option>
                        <option value="4" <?php echo (isset($_POST['kategori']) && $_POST['kategori'] == '4') ? 'selected' : ''; ?>>Pastries</option>
                    </select>
                    <div class="invalid-feedback">Pilih Kategori</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="stok" class="form-label fw-bold font-outfit required">Stok</label>
                    <input name="stok" type="number" class="form-control rounded" placeholder="Masukkan Jumlah Stok" id="stok" required>
                    <div class="invalid-feedback">Jumlah Stok Harus Diisi</div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="gambarProduk" class="form-label fw-bold font-outfit required">Gambar Produk</label>
            <input name="gambar" type="file" class="form-control rounded" id="gambarProduk" accept="image/*" required>
            <div class="invalid-feedback">Silakan Upload Gambar</div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn font-outfit px-4" style="background-color: #e2d9c8;">Simpan Produk</button>
            <button type="reset" class="btn btn-outline-dark font-outfit px4">Reset Form</button>
        </div>
    </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
    </script>
</body>
</html>