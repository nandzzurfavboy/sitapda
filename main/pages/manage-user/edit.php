<?php
// component
require '../components/input/input.php';
require '../components/select/select.php';
require '../components/textarea/textarea.php';

// get data
$listRole = getData('tb_role');
$id = $_GET['id'];
$row = getData('tb_user', '*', '', 'id = ' . intval($id));
$value = $row[0];
?>

<div class="border rounded-xl max-w-2xl mx-auto">
    <div class="px-6 py-2 flex justify-between items-center">
        <h1 class="font-semibold text-[#1d1d1d]">Edit User</h1>
    </div>
    <hr>
    <div class="p-6">
        <form method="POST">
            <div class="space-y-4">
                <div class="">
                    <?= baseInput('Name', 'nama', true, 'text', $value['nama'], 'Enter name', 'off') ?>
                </div>

                <div class="">
                    <?= baseInput('NIP', 'nip', true, 'number', $value['nip'], 'Enter NIP', 'off') ?>
                </div>

                <div class="">
                    <?= baseSelect('Role', 'role_id', $listRole, 'id', 'nama', 'Select role', $value['role_id'], true) ?>
                </div>

                <div class="">
                    <?= baseInput('Username', 'username', true, 'text', $value['username'], 'Enter username', 'off') ?>
                </div>

                <div class="">
                    <?= baseInput('Password', 'password', true, 'text', '', 'Enter new password (kosongkan jika tidak diubah)', 'off') ?>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                        <span>Submit</span>
                    </button>
                    <a href="?page=manage-user" class="text-center py-2 px-6 inline-flex items-center gap-x-1 text-xs font-semibold rounded-lg border border-transparent bg-gray-200 text-gray-500 hover:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Siapkan data yang akan diupdate
    $data = [
        'nama' => $_POST['nama'],
        'nip' => $_POST['nip'],
        'username' => $_POST['username'],
        'role_id' => $_POST['role_id'],
        'updatedAt' => date('Y-m-d H:i:s')
    ];

    // Jika password diisi, update password dengan hash baru
    if (!empty($_POST['password'])) {
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $editData = updateData('tb_user', $data, 'id = ' . intval($id));

    if ($editData) {
        echo "<script>
                alert('Berhasil mengubah data user');
                document.location.href='index.php?page=manage-user';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah data user');
              </script>";
    }
}
?>