<?php
require_once __DIR__ . '/../../core/db.php';

// Lấy bộ lọc từ URL, mặc định là 'customer'
$filter_role = isset($_GET['role_filter']) ? $_GET['role_filter'] : 'customer';

// Xây dựng câu lệnh SQL dựa trên bộ lọc
if ($filter_role === 'all') {
    $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
} else {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE role = ? ORDER BY id DESC");
    $stmt->execute([$filter_role]);
}
$users = $stmt->fetchAll();
?>

<div class="kayfood-admin-wrapper">
    <div class="table-header-section">
        <h3>User Management (Customers/Admins)</h3>
        
        <div class="header-actions">
            <select id="roleFilter" onchange="filterUsers(this.value)" class="filter-select">
                <option value="all" <?php echo ($filter_role == 'all') ? 'selected' : ''; ?>>All Roles</option>
                <option value="admin" <?php echo ($filter_role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="customer" <?php echo ($filter_role == 'customer') ? 'selected' : ''; ?>>User (Customer)</option>
            </select>

            <button class="btn-add-new" onclick="openUserModal('add')">
                <i class='bx bx-user-plus'></i> Add new user
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="main-dish-table">
            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th>USERNAME</th>
                    <th>FULL NAME</th>
                    <th>ROLE</th>
                    <th>CREATED AT</th>
                    <th class="col-action">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="dish-id"><?php echo $user['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($user['username']); ?></strong></td>
                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        <td>
                            <span class="badge <?php echo ($user['role'] == 'admin') ? 'role-admin' : 'role-customer'; ?>">
                                <?php echo strtoupper($user['role']); ?>
                            </span>
                        </td>
                        <td><?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                        <td class="col-action text-center">
                            <div class="action-group">
                                <button class="action-btn edit-btn" onclick="openUserModal('edit', <?php echo htmlspecialchars(json_encode($user)); ?>)">
                                    <i class='bx bx-edit-alt'></i>
                                </button>

                                <a href="../modules/user_process.php?delete_id=<?php echo $user['id']; ?>" 
                                   class="delete-btn" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center no-data">Không tìm thấy người dùng nào thuộc nhóm này.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="userModalTitle">Add New User</h3>
            <span class="close-modal" onclick="closeUserModal()">&times;</span>
        </div>
        
        <form action="../modules/user_process.php" method="POST" class="modern-form">
            <input type="hidden" name="user_id" id="u_user_id">
            <input type="hidden" name="action_type" id="u_action_type" value="add">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="u_username" required>
            </div>

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" id="u_full_name" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="u_password">
                <p class="file-hint" id="pw_hint">Mật khẩu sẽ được mã hóa tự động.</p>
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" id="u_role" class="role-select">
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeUserModal()">Cancel</button>
                <button type="submit" name="submit_user" class="btn-primary">Save Change</button>
            </div>
        </form>
    </div>
</div>

<script>
function filterUsers(role) {
    window.location.href = `admin.php?page=customers&role_filter=${role}`;
}

function openUserModal(mode, data = null) {
    document.getElementById('u_action_type').value = mode;
    if(mode === 'edit') {
        document.getElementById('userModalTitle').innerText = "Update User Info";
        document.getElementById('u_user_id').value = data.id;
        document.getElementById('u_username').value = data.username;
        document.getElementById('u_full_name').value = data.full_name;
        document.getElementById('u_role').value = data.role;
        document.getElementById('u_password').required = false;
        document.getElementById('pw_hint').innerText = "Chỉ nhập nếu muốn đổi mật khẩu mới.";
    } else {
        document.getElementById('userModalTitle').innerText = "Create New User";
        document.getElementById('u_username').value = "";
        document.getElementById('u_full_name').value = "";
        document.getElementById('u_password').value = "";
        document.getElementById('u_password').required = true;
        document.getElementById('pw_hint').innerText = "Mật khẩu khởi tạo.";
    }
    document.getElementById('userModal').style.display = "flex";
}

function closeUserModal() { 
    document.getElementById('userModal').style.display = "none"; 
}

window.onclick = function(e) {
    if (e.target == document.getElementById('userModal')) closeUserModal();
}
</script>