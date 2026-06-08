
<?php
include 'db.php';

// Fetch all customers
$query  = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);
$rows   = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
$total = count($rows);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Management</title>
  <link rel="stylesheet" href="nishu.css">
</head>
<body>

<div class="page-wrapper">

  <!-- Header -->
  <div class="page-header">
    <div class="header-left">
    <a href="index.php" class="back-link">← Back to Index</a>
      <p class="eyebrow">CRM</p>
      <h1>Customer Management</h1>
    </div>
    <a href="addnew.php" class="add-btn">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
      </svg>
      Add New Customer
    </a>
  </div>

  <!-- Stats Bar -->
  <div class="stats-bar">
    <div class="stat-item">
      <span class="stat-label">Total Customers</span>
      <span class="stat-value"><?php echo $total; ?></span>
    </div>
    <div class="stat-item">
      <span class="stat-label">Active</span>
      <span class="stat-value"><?php echo $total; ?></span>
    </div>
    <div class="stat-item">
      <span class="stat-label">Added This Month</span>
      <span class="stat-value">—</span>
    </div>
  </div>

  <!-- Table Card -->
  <div class="table-card">

    <!-- Toolbar -->
    <div class="table-toolbar">
      <span class="table-toolbar-title"><?php echo $total; ?> record<?php echo $total !== 1 ? 's' : ''; ?></span>
      <div class="search-wrap">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input
          class="search-input"
          type="text"
          placeholder="Search customers…"
          id="searchInput"
          onkeyup="filterTable()"
        >
      </div>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
      <table id="customerTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($rows)): ?>
            <tr>
              <td colspan="6">
                <div class="empty-state">
                  <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                  </svg>
                  <p>No customers found. <a href="addnew.php">Add the first one.</a></p>
                </div>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($rows as $row):
              $initials = '';
              $nameParts = explode(' ', trim(htmlspecialchars($row['name'])));
              $initials  = strtoupper(substr($nameParts[0], 0, 1));
              if (count($nameParts) > 1) $initials .= strtoupper(substr(end($nameParts), 0, 1));
            ?>
            <tr>
              <td>
                <span class="sno-badge"><?php echo (int)$row['id']; ?></span>
              </td>
              <td>
                <div class="name-cell">
                  <div class="avatar"><?php echo $initials; ?></div>
                  <span class="name-text"><?php echo htmlspecialchars($row['name']); ?></span>
                </div>
              </td>
              <td>
                <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="email-text">
                  <?php echo htmlspecialchars($row['email']); ?>
                </a>
              </td>
              <td>
                <span class="phone-text"><?php echo htmlspecialchars($row['phone']); ?></span>
              </td>
              <td>
                <span class="address-text" title="<?php echo htmlspecialchars($row['address']); ?>">
                  <?php echo htmlspecialchars($row['address']); ?>
                </span>
              </td>
              <td>
                <div class="actions-cell">
                  <a href="edit.php?id=<?php echo (int)$row['id']; ?>" class="action-link edit">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                      <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                      <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Edit
                  </a>
                  <a href="delete.php?id=<?php echo (int)$row['id']; ?>" class="action-link delete"
                     onclick="return confirm('Delete this customer? This cannot be undone.')">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                      <path d="M10 11v6M14 11v6"/>
                    </svg>
                    Delete
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div><!-- /.table-card -->

  <?php include 'footer.php'; ?>

</div><!-- /.page-wrapper -->

<script>
function filterTable() {
  var input  = document.getElementById('searchInput').value.toLowerCase();
  var rows   = document.querySelectorAll('#customerTable tbody tr');
  rows.forEach(function(row) {
    var text = row.innerText.toLowerCase();
    row.style.display = text.includes(input) ? '' : 'none';
  });
}
</script>

</body>
</html>