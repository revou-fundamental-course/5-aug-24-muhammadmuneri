<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Penghitung BMI</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <div class="form-section">
      <h1>Kalkulator BMI</h1>
      <p>Berat badan ideal adalah impian semua orang. Tidak hanya bentuk tubuh yang menunjang penampilan,
        berat badan ideal juga menandakan kondisi tubuh yang sehat. Bagaimana denganmu?
        Yuk, hitung sekarang di kalkulator BMI
      </p>
      <form>
        <label for="jen_kel"><b>Jenis Kelamin</b></label>
        <div class="gender-group">
          <input type="radio" id="pria" name="gender" value="pria">
          <label for="pria"><b>Pria</b></label>
          <input type="radio" id="wanita" name="gender" value="wanita">
          <label for="wanita"><b>Wanita</b></label>
        </div>

        <label for="berat"><b>Berat Badan (kg):</b></label>
        <input type="number" id="berat" name="berat" placeholder="input berat badan" oninput="validateNumberInput(event);">

        <label for="tinggi"><b>Usia (tahun):</b></label>
        <input type="number" id="usia" name="usia" placeholder="input usia" oninput="validateNumberInput(event);">

        <label for="tinggi"><b>Tinggi Badan (cm):</b></label>
        <input type="number" id="tinggi" name="tinggi" placeholder="input tinggi badan" oninput="validateNumberInput(event);">

        <input type="submit" value="Hitung BMI">
        <input type="reset" value="Reset">
      </form>
    </div>
    <div class="result-section">
      <p><b>HASIL</b></p>
      <div class='result'>Perhitungan BMI</div>
    </div>
  </div>
  <script src="script.js"></script>
</body>

</html>