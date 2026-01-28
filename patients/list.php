<?php
include "../config/db.php";
include "../includes/header.php";

$doctors = mysqli_query($conn, "SELECT * FROM doctors");

// ================= PAGINATION =================
$limit = 8;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$sort = $_GET['sort'] ?? '';

$orderBy = "patient_name ASC"; // default

switch ($sort) {
    case 'name_asc':
        $orderBy = "patient_name ASC";
        break;
    case 'name_desc':
        $orderBy = "patient_name DESC";
        break;
    case 'age_asc':
        $orderBy = "age ASC";
        break;
    case 'age_desc':
        $orderBy = "age DESC";
        break;
    case 'gender':
        $orderBy = "gender ASC";
        break;
}

$sql = "SELECT * FROM patients
        ORDER BY $orderBy
        LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);

$totalRes = mysqli_query($conn, "SELECT COUNT(*) AS total FROM patients");
$total = mysqli_fetch_assoc($totalRes)['total'];
$totalPages = ceil($total / $limit);
?>

<h1>Hospital Patient Management</h1>

<div class="top-bar">
    <a href="create.php" class="add-btn">+ Add Patient</a>

    <div style="display:flex; gap:12px; align-items:center;">

        <!-- SORT DROPDOWN -->
        <form method="get">
            <select name="sort" onchange="this.form.submit()" class="form-select">
                <option value="">Sort By</option>
                <option value="name_asc">Name A–Z</option>
                <option value="name_desc">Name Z–A</option>
                <option value="age_asc">Age ↑</option>
                <option value="age_desc">Age ↓</option>
                <option value="gender">Gender</option>
            </select>
        </form>

        <!-- SEARCH -->
        <div class="search-container">
            <img src="../assets/search.png" alt="Search" class="search-icon">
            <input type="text" id="searchInput" placeholder="Search patient name...">
        </div>

    </div>
</div>

<div class="table-responsive">
    <table>

    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Diagnosis</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="patientTable">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['age']) ?></td>
                <td><?= htmlspecialchars($row['gender']) ?></td>
                <td><?= htmlspecialchars($row['diagnosis']) ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= $row['id'] ?>">
                        <img src="../assets/pencil.png">
                    </a>
                    <a href="delete.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Delete patient?')">
                        <img src="../assets/dustbin.png">
                    </a>
                </td>
            </tr>
        <?php } ?>
    <?php else: ?>
        <tr>
            <td colspan="7" style="text-align:center;">No patients found</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
    </div>
<!-- ================= PAGINATION ================= -->
<div class="pagination">
<?php if ($page > 1): ?>
    <a href="?page=<?= $page - 1 ?>&sort=<?= $sort ?>">Previous</a>

<?php endif; ?>

<?php if ($page < $totalPages): ?>
    <a href="?page=<?= $page + 1 ?>">Next</a>
<?php endif; ?>
</div>

<!-- ================= SEARCH SCRIPT ================= -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll("#patientTable tr");

    rows.forEach(row => {
        const nameText = row.cells[0].textContent.toLowerCase();
        row.style.display = nameText.includes(filter) ? "" : "none";
    });
});
</script>

<?php include "../includes/footer.php"; ?>
