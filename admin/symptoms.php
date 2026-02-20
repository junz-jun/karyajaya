<?php include 'header.php';

// Handle Add/Edit/Delete actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $code = $conn->real_escape_string($_POST['code']);
            $name = $conn->real_escape_string($_POST['name']);
            $category = $conn->real_escape_string($_POST['category']);

            $sql = "INSERT INTO symptoms (code, name, category) VALUES ('$code', '$name', '$category')";
            if ($conn->query($sql)) {
                echo "<script>alert('Gejala berhasil ditambahkan!'); window.location='symptoms.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan gejala: " . addslashes($conn->error) . "');</script>";
            }
        } elseif ($_POST['action'] == 'edit') {
            $id = (int)$_POST['id'];
            $code = $conn->real_escape_string($_POST['code']);
            $name = $conn->real_escape_string($_POST['name']);
            $category = $conn->real_escape_string($_POST['category']);

            $sql = "UPDATE symptoms SET code='$code', name='$name', category='$category' WHERE id=$id";
            if ($conn->query($sql)) {
                echo "<script>alert('Gejala berhasil diperbarui!'); window.location='symptoms.php';</script>";
            }
        } elseif ($_POST['action'] == 'delete') {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM symptoms WHERE id=$id";
            if ($conn->query($sql)) {
                echo "<script>alert('Gejala berhasil dihapus!'); window.location='symptoms.php';</script>";
            }
        }
    }
}
?>

<header class="flex items-center justify-between border-b border-[#29382e] bg-background-dark/95 backdrop-blur px-8 py-4 z-10">
    <h2 class="text-white text-xl font-bold tracking-tight">Manajemen Gejala</h2>
    <button onclick="openAddModal()" class="bg-primary text-black font-bold text-sm px-4 py-2 rounded-lg hover:bg-green-400 transition-all">+ Tambah Gejala</button>
</header>

<div class="flex-1 overflow-y-auto p-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-surface-dark rounded-xl border border-[#29382e] overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#233329] text-[#9db8a6] text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4 w-20">Kode</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Deskripsi Gejala</th>
                        <th class="px-6 py-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#29382e] text-sm text-white">
                    <?php
                    $symptoms = $conn->query("SELECT * FROM symptoms ORDER BY code ASC");
                    while ($s = $symptoms->fetch_assoc()):
                    ?>
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-mono text-primary font-medium"><?php echo $s['code']; ?></td>
                        <td class="px-6 py-4"><span class="px-2 py-1 rounded-full bg-border-dark text-xs"><?php echo $s['category']; ?></span></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($s['name']); ?></td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick='openEditModal(<?php echo json_encode($s); ?>)' class="text-blue-400 hover:text-blue-300"><span class="material-symbols-outlined text-lg">edit</span></button>
                                <button onclick="deleteSymptom(<?php echo $s['id']; ?>, '<?php echo addslashes($s['name']); ?>')" class="text-red-400 hover:text-red-300"><span class="material-symbols-outlined text-lg">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add/Edit -->
<div id="symptomModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-surface-dark border border-[#29382e] rounded-2xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="px-8 py-6 border-b border-[#29382e] flex items-center justify-between">
            <h3 id="modalTitle" class="text-white text-lg font-bold">Tambah Gejala</h3>
            <button onclick="closeModal()" class="text-[#9db8a6] hover:text-white"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form action="" method="POST" class="p-8 space-y-6">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="id" id="symptomId">

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-[#9db8a6]">Kode Gejala</label>
                    <input type="text" name="code" id="symptomCode" required placeholder="G001" class="w-full bg-[#1a261f] border border-[#29382e] rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-[#9db8a6]">Kategori</label>
                    <select name="category" id="symptomCategory" required class="w-full bg-[#1a261f] border border-[#29382e] rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors">
                        <option value="Daun">Daun</option>
                        <option value="Batang">Batang</option>
                        <option value="Buah">Buah</option>
                        <option value="Akar">Akar</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-[#9db8a6]">Nama/Deskripsi Gejala</label>
                <textarea name="name" id="symptomName" required rows="3" class="w-full bg-[#1a261f] border border-[#29382e] rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors resize-none"></textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeModal()" class="flex-1 px-6 py-3 rounded-xl border border-[#29382e] text-white font-semibold hover:bg-white/5 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-primary text-black font-bold hover:bg-green-400 transition-all shadow-lg shadow-primary/20">Simpan Gejala</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Delete Confirmation -->
<form id="deleteForm" action="" method="POST" class="hidden">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" id="deleteId">
</form>

<script>
function openAddModal() {
    document.getElementById('modalTitle').innerText = 'Tambah Gejala';
    document.getElementById('formAction').value = 'add';
    document.getElementById('symptomId').value = '';
    document.getElementById('symptomCode').value = '';
    document.getElementById('symptomName').value = '';
    document.getElementById('symptomCategory').value = 'Daun';
    document.getElementById('symptomModal').classList.remove('hidden');
}

function openEditModal(symptom) {
    document.getElementById('modalTitle').innerText = 'Edit Gejala';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('symptomId').value = symptom.id;
    document.getElementById('symptomCode').value = symptom.code;
    document.getElementById('symptomName').value = symptom.name;
    document.getElementById('symptomCategory').value = symptom.category;
    document.getElementById('symptomModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('symptomModal').classList.add('hidden');
}

function deleteSymptom(id, name) {
    if (confirm('Apakah Anda yakin ingin menghapus gejala "' + name + '"?')) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteForm').submit();
    }
}
</script>

<?php include 'footer.php'; ?>
