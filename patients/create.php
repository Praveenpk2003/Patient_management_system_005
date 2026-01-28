<?php
include "../config/db.php";

// FETCH DOCTORS FOR DROPDOWN
$doctors = mysqli_query($conn, "SELECT * FROM doctors");

// HANDLE FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $patient_name = $_POST['name'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $age          = $_POST['age'];
    $gender       = $_POST['gender'];
    $diagnosis    = $_POST['diagnosis'];
    $doctor_id    = $_POST['doctor_id'];

    $sql = "INSERT INTO patients
            (patient_name, email, phone, age, gender, diagnosis, doctor_id)
            VALUES
            ('$patient_name', '$email', '$phone', '$age', '$gender', '$diagnosis', '$doctor_id')";

    if (mysqli_query($conn, $sql)) {
        header("Location: list.php");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}
?>

<?php include "../includes/header.php"; ?>

<h2 class="text-center mb-4">Add Patient</h2>

<div class="row justify-content-center">
    <div class="col-md-6">

        <form method="post" class="card p-4 shadow-sm">

            <div class="mb-3">
                <label class="form-label">Patient Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control"
                       pattern="[0-9]{10}"
                       title="Enter 10 digit mobile number"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosis</label>
                <input type="text" name="diagnosis" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Doctor</label>
                <select name="doctor_id" class="form-select" required>
                    <option value="">Select Doctor</option>
                    <?php while ($d = mysqli_fetch_assoc($doctors)) { ?>
                        <option value="<?= $d['id'] ?>">
                            <?= $d['doctor_name'] ?> (<?= $d['specialization'] ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">
                    Save Patient
                </button>
            </div>

        </form>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
