
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form action="../crud_process/create.php" onsubmit="return validateForm()" method="post">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name"><br>
        <label for="price">Harga</label>
        <input type="number" id="price" name="price"><br>
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description"></textarea><br>
        <label for="stock">Stok</label>
        <input type="number" id="stock" name="stock"><br>
        <input type="submit" value="tambah">
    </form>
    <script>
        function validateForm() {
            let name = document.getElementById('name').value;
            let price = document.getElementById('price').value;
            let description = document.getElementById('description').value;
            let stock = document.getElementById('stock').value;

            if (name === "" || price === "" || description === "" || stock === "") {
                alert("Semua field harus diisi!");
                return false;
            }
            if (isNaN(price) || isNaN(stock)) {
                alert("Harga dan stok harus berupa angka!")
                return false;
            }
            return true;
        }
    </script>
</body>
</html>