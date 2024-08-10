<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Penghitung BMI</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: radial-gradient(circle, #ff4d4d, #fff);
      height: 100vh;
    }

    .container {
      width: 500px;
      margin: 0 auto;
      padding: 50px;
      border: 10px solid #ddd;
      border-radius: 5px;
      background-color: rgba(0, 0, 0, 0.5);
    }

    label {
      display: block;
      color: white;
      margin-bottom: 5px;
    }

    div {
      color: white;
    }

    input[type="number"],
    input[type="submit"],
    input[type="reset"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 5px;
    }

    /* Gaya untuk tombol submit */
    input[type="submit"] {
      background-color: #007bff;
      color: white;
      width: 30%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Gaya untuk tombol submit yang dinonaktifkan */
    input[type="submit"]:disabled {
      background-color: #6c757d;
      color: #fff;
      cursor: not-allowed;
    }

    /* Gaya untuk tombol reset */
    input[type="reset"] {
      background-color: #dc3545;
      color: white;
      width: 30%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Gaya untuk tombol reset yang dinonaktifkan */
    input[type="reset"]:disabled {
      background-color: #6c757d;
      color: #fff;
      cursor: not-allowed;
    }

    .result {
      text-align: center;
    }

    .gender-group {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .gender-group input[type="radio"] {
      margin-right: 10px;
    }

    .gender-group label {
      margin-right: 20px;
    }
  </style>
  <script>
    function validateNumberInput(event) {
      // Mengambil nilai yang telah diinputkan
      const input = event.target;
      // Menghapus inputan selain angka
      input.value = input.value.replace(/[^0-9]/g, '');
    }

    document.addEventListener('DOMContentLoaded', function() {
      const submitButton = document.querySelector('input[type="submit"]');
      const resetButton = document.querySelector('input[type="reset"]');
      const form = document.querySelector('form');
      const resultDiv = document.querySelector('.result');

      // Atur tombol reset untuk dinonaktifkan pada awal
      resetButton.disabled = true;

      submitButton.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah pengiriman form default
        submitButton.disabled = true; // Nonaktifkan tombol submit setelah diklik
        resetButton.disabled = false;

        // Ambil data dari form
        const berat = parseFloat(document.querySelector('#berat').value);
        const tinggi_cm = parseFloat(document.querySelector('#tinggi').value);
        const tinggi_meter = tinggi_cm / 100;
        const gender = document.querySelector('input[name="gender"]:checked');

        if (!gender) {
          resultDiv.innerHTML = '<h2>Silakan pilih jenis kelamin.</h2>';
          return;
        }

        if (!isNaN(berat) && !isNaN(tinggi_cm) && tinggi_cm > 0) { // Gunakan fungsi "!isNaN" untuk mengecek apakah inputan berupa angka
          submitButton.disabled = true; // Nonaktifkan tombol submit setelah diklik
          resetButton.disabled = false; // Aktifkan tombol reset

          const bmi = berat / (tinggi_meter * tinggi_meter);
          const roundedBmi = bmi.toFixed(2);
          let resultMessage = '';

          if (roundedBmi < 18.5) {
            resultMessage = `<h2>Berat Badan Kurang</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: red;'>Anda memiliki kekurangan berat badan</h2>`;
          } else if (roundedBmi >= 18.5 && roundedBmi < 24.9) {
            resultMessage = `<h2>Berat Badan Ideal</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: green;'>Anda memiliki berat badan normal (ideal)</h2>`;
          } else if (roundedBmi >= 25 && roundedBmi < 29.9) {
            resultMessage = `<h2>Berat Badan Kelebihan</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: yellow;'>Anda memiliki kelebihan berat badan, segera lakukan diet</h2>`;
          } else {
            resultMessage = `<h2>Berat Badan Kelebihan (Obesitas)</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: red;'>Anda mengalami Kegemukan (Obesitas) segera berolahraga dan makan makanan sehat</h2>`;
          }

          resultDiv.innerHTML = resultMessage;
        } else {
          resultDiv.innerHTML = '<h2>Silakan masukkan data yang valid.</h2>';
        }
      });

      resetButton.addEventListener('click', function() {
        resetButton.disabled = true;
        submitButton.disabled = false;
        resultDiv.innerHTML = '';
        form.reset();
      });
    });
  </script>
</head>

<body>
  <!-- Tampilan dashboard -->
  <div class="container">
    <h1>Penghitung BMI</h1>
    <form>
      <div class="gender-group">
        <input type="radio" id="pria" name="gender" value="pria">
        <label for="pria">Pria</label>
        <input type="radio" id="wanita" name="gender" value="wanita">
        <label for="wanita">Wanita</label>
      </div>

      <label for="berat">Berat Badan (kg):</label>
      <input type="number" id="berat" name="berat" placeholder="input berat badan" required oninput="validateNumberInput(event);">

      <label for="umur">Umur:</label>
      <input type="number" id="umur" name="umur" placeholder="input umur" required oninput="validateNumberInput(event);">

      <label for="tinggi">Tinggi Badan (cm):</label>
      <input type="number" id="tinggi" name="tinggi" placeholder="input tinggi badan" required oninput="validateNumberInput(event);">

      <input type="submit" value="Hitung BMI">
      <input type="reset" value="Reset">
    </form>
    <div class='result'></div>
  </div>
</body>

</html>