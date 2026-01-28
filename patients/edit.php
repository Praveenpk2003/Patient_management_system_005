<?php
include "../config/db.php";

// VALIDATE ID
if (!isset($_GET['id'])) {
    header("Location: list.php");
    exit();
}

$id = (int)$_GET['id'];

// FETCH DOCTORS
$doctors = mysqli_query($conn, "SELECT * FROM doctors");

// HANDLE UPDATE
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $patient_name = $_POST['name'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $age          = $_POST['age'];
    $gender       = $_POST['gender'];
    $diagnosis    = $_POST['diagnosis'];
    $doctor_id    = $_POST['doctor_id']; // 🔴 THIS WAS MISSING / BROKEN

    $updateSql = "UPDATE patients SET
        patient_name = '$patient_name',
        email = '$email',
        phone = '$phone',
        age = '$age',
        gender = '$gender',
        diagnosis = '$diagnosis',
        doctor_id = '$doctor_id'
    WHERE id = $id";

    if (mysqli_query($conn, $updateSql)) {
        header("Location: list.php");
        exit();
    } else {
        die("Update failed: " . mysqli_error($conn));
    }
}

// FETCH PATIENT DATA
$patientResult = mysqli_query($conn, "SELECT * FROM patients WHERE id = $id");
$patient = mysqli_fetch_assoc($patientResult);

if (!$patient) {
    die("Patient not found");
}
?>

<?php include "../includes/header.php"; ?>

<h2 class="text-center mb-4">Edit Patient</h2>

<div class="row justify-content-center">
    <div class="col-md-6">

        <form method="post" class="card p-4 shadow-sm">

            <div class="mb-3">
                <label>Patient Name</label>
                <input type="text" name="name" class="form-control"
                       value="<?= htmlspecialchars($patient['patient_name']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($patient['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="<?= htmlspecialchars($patient['phone']) ?>"
                       pattern="[0-9]{10}" required>
            </div>

            <div class="mb-3">
                <label>Age</label>
                <input type="number" name="age" class="form-control"
                       value="<?= htmlspecialchars($patient['age']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-select" required>
                    <option <?= $patient['gender']=="Male"?"selected":"" ?>>Male</option>
                    <option <?= $patient['gender']=="Female"?"selected":"" ?>>Female</option>
                    <option <?= $patient['gender']=="Other"?"selected":"" ?>>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Diagnosis</label>
                <input type="text" name="diagnosis" class="form-control"
                       value="<?= htmlspecialchars($patient['diagnosis']) ?>">
            </div>

            <div class="mb-4">
                <label>Doctor</label>
                <select name="doctor_id" class="form-select" required>
                    <option value="">Select Doctor</option>
                    <?php while ($d = mysqli_fetch_assoc($doctors)) { ?>
                        <option value="<?= $d['id'] ?>"
                            <?= ($patient['doctor_id'] == $d['id']) ? 'selected' : '' ?>>
                            <?= $d['doctor_name'] ?> (<?= $d['specialization'] ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    Update Patient
                </button>
            </div>

        </form>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
