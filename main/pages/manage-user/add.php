<?php
// component
require '../components/input/input.php';
require '../components/select/select.php';
require '../components/textarea/textarea.php';

// get data
$listRole = getData('tb_role');
?>

<div class="border rounded-xl max-w-2xl mx-auto">
    <div class="px-6 py-2 flex justify-between items-center">
        <h1 class="font-semibold text-[#1d1d1d]">Create UPT</h1>
    </div>
    <hr>
    <div class="p-6">
        <form method="POST">
            <div class="space-y-4">
                <div class="">
                    <?= baseInput('Name', 'nama', true, 'text', '', 'Enter name', 'off') ?>
                </div>

                <div class="">
                    <?= baseInput('NIP', 'nip', true, 'text', '', 'Enter NIP', 'off') ?>
                </div>

                <div class="">
                    <?= baseSelect('Role', 'role_id', $listRole, 'id', 'nama', 'Select Role', '', true) ?>
                </div>

                <div class="">
                    <?= baseInput('username', 'username', true, 'text', '', 'Enter username', 'off') ?>
                </div>

                <div class="">
                    <?= baseInput('Password', 'password', true, 'text', '', 'Enter password', 'off') ?>
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
    $data = [
        'nama' => $_POST['nama'],
        'nip' => $_POST['nip'],
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Consider using password_hash() for security
        'role_id' => $_POST['role_id'],
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    $createData = createData('tb_user', $data);

    if ($createData) {
        echo "<script>
            alert('Success to create user');
            document.location.href='index.php?page=manage-user';
          </script>";
    } else {
        echo "<script>
            alert('Failed to create user');
          </script>";
    }
}
?>