function validateNumberInput(event) {
  const input = event.target;
  input.value = input.value.replace(/[^0-9]/g, "");
}

document.addEventListener("DOMContentLoaded", function () {
  const submitButton = document.querySelector('input[type="submit"]');
  const resetButton = document.querySelector('input[type="reset"]');
  const form = document.querySelector("form");
  const resultDiv = document.querySelector(".result");

  // Menonaktifkan tombol reset saat awal
  resetButton.disabled = true;

  // Menambahkan event listener pada input angka
  document.querySelectorAll('input[type="number"]').forEach((input) => {
    input.addEventListener("input", validateNumberInput);
  });

  // Menangani klik pada tombol submit
  submitButton.addEventListener("click", function (event) {
    if (!form.checkValidity()) {
      // Memastikan semua input yang memiliki atribut required sudah diisi
      resultDiv.innerHTML = "<h2>Silakan isi semua field yang diperlukan.</h2>";
      return;
    }

    event.preventDefault(); // Mencegah pengiriman formulir jika validasi tidak berhasil

    // Mengambil nilai input
    const berat = parseFloat(document.querySelector("#berat").value);
    const usia = parseFloat(document.querySelector("#usia").value);
    const tinggi_cm = parseFloat(document.querySelector("#tinggi").value);
    const tinggi_meter = tinggi_cm / 100;
    const gender = document.querySelector('input[name="gender"]:checked');

    // Validasi input
    if (!gender) {
      resultDiv.innerHTML = "<h2>Silakan pilih jenis kelamin.</h2>";
      return;
    }

    if (
      isNaN(berat) ||
      isNaN(usia) ||
      isNaN(tinggi_cm) ||
      berat <= 0 ||
      usia <= 0 ||
      tinggi_cm <= 0
    ) {
      resultDiv.innerHTML = "<h2>Silakan masukkan data yang valid.</h2>";
      return;
    }

    // Menghitung BMI jika semua data valid
    submitButton.disabled = true;
    resetButton.disabled = false;

    const bmi = berat / (tinggi_meter * tinggi_meter);
    const roundedBmi = bmi.toFixed(2);
    let resultMessage = "";

    if (roundedBmi < 18.5) {
      resultMessage = `<h2>Berat Badan Kurang</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: red;'>Anda memiliki kekurangan berat badan</h2>`;
    } else if (roundedBmi >= 18.5 && roundedBmi < 24.9) {
      resultMessage = `<h2>Berat Badan Ideal</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: green;'>Anda memiliki berat badan normal (ideal)</h2>`;
    } else if (roundedBmi >= 25 && roundedBmi < 29.9) {
      resultMessage = `<h2>Berat Badan Kelebihan</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: yellow;'>Anda memiliki kelebihan berat badan, segera lakukan diet</h2>`;
    } else {
      resultMessage = `<h2>Berat Badan Kelebihan (Obesitas)</h2><p><b>BMI: ${roundedBmi}</b></p><h2 style='color: red;'>Anda mengalami Kegemukan (Obesitas) segera berolahraga dan makan makanan sehat</h2>`;
    }

    // Menambahkan saran khusus berdasarkan hasil BMI
    let additionalAdvice = "";
    if (roundedBmi < 18.5) {
      additionalAdvice =
        "<p>Pertimbangkan untuk berkonsultasi dengan ahli gizi atau dokter untuk menyusun rencana diet yang sehat.</p>";
    } else if (roundedBmi >= 18.5 && roundedBmi < 24.9) {
      additionalAdvice =
        "<p>Terus pertahankan gaya hidup sehat Anda dengan diet seimbang dan olahraga teratur.</p>";
    } else if (roundedBmi >= 25 && roundedBmi < 29.9) {
      additionalAdvice =
        "<p>Cobalah untuk meningkatkan aktivitas fisik Anda dan mengatur pola makan untuk mencapai berat badan ideal.</p>";
    } else {
      additionalAdvice =
        "<p>Segera konsultasikan dengan dokter untuk menentukan strategi penurunan berat badan yang aman dan efektif.</p>";
    }

    resultDiv.innerHTML = resultMessage + additionalAdvice;
  });

  // Menangani klik pada tombol reset
  resetButton.addEventListener("click", function () {
    resetButton.disabled = true;
    submitButton.disabled = false;
    resultDiv.innerHTML = "";
    form.reset();
  });
});
