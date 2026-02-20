<?php include 'header.php';

// Handle Add/Edit/Delete actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $name = $conn->real_escape_string($_POST['name']);
            $description = $conn->real_escape_string($_POST['description']);
            $solution = $conn->real_escape_string($_POST['solution']);
            $prevention = $conn->real_escape_string($_POST['prevention']);

            $sql = "INSERT INTO diseases (name, description, solution, prevention) VALUES ('$name', '$description', '$solution', '$prevention')";
            if ($conn->query($sql)) {
                echo "<script>alert('Penyakit berhasil ditambahkan!'); window.location='diseases.php';</script>";
            }
        } elseif ($_POST['action'] == 'edit') {
            $id = (int)$_POST['id'];
            $name = $conn->real_escape_string($_POST['name']);
            $description = $conn->real_escape_string($_POST['description']);
            $solution = $conn->real_escape_string($_POST['solution']);
            $prevention = $conn->real_escape_string($_POST['prevention']);

            $sql = "UPDATE diseases SET name='$name', description='$description', solution='$solution', prevention='$prevention' WHERE id=$id";
            if ($conn->query($sql)) {
                echo "<script>alert('Penyakit berhasil diperbarui!'); window.location='diseases.php';</script>";
            }
        } elseif ($_POST['action'] == 'delete') {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM diseases WHERE id=$id";
            if ($conn->query($sql)) {
                echo "<script>alert('Penyakit berhasil dihapus!'); window.location='diseases.php';</script>";
            }
        }
    }
}
?>

<header class="flex items-center justify-between border-b border-[#29382e] bg-background-dark/95 backdrop-blur px-8 py-4 z-10">
    <h2 class="text-white text-xl font-bold tracking-tight">Manajemen Penyakit</h2>
    <button onclick="openModal('add')" class="bg-primary text-black font-bold text-sm px-4 py-2 rounded-lg hover:bg-green-400 transition-all">+ Tambah Penyakit</button>
</header>

<div class="flex-1 overflow-y-auto p-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-surface-dark rounded-xl border border-[#29382e] overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#233329] text-[#9db8a6] text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">Nama Penyakit</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#29382e] text-sm text-white">
                    <?php
                    $diseases = $conn->query("SELECT * FROM diseases ORDER BY name ASC");
                    while ($d = $diseases->fetch_assoc()):
                    ?>
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-bold text-primary"><?php echo $d['name']; ?></td>
                        <td class="px-6 py-4"><p class="line-clamp-2 text-slate-400"><?php echo htmlspecialchars($d['description']); ?></p></td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick='openModal("edit", <?php echo json_encode($d); ?>)' class="text-blue-400 hover:text-blue-300"><span class="material-symbols-outlined text-lg">edit</span></button>
                                <button onclick='confirmDelete(<?php echo $d["id"]; ?>, "<?php echo addslashes($d["name"]); ?>")' class="text-red-400 hover:text-red-300"><span class="material-symbols-outlined text-lg">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Penyakit -->
<div id="diseaseModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-surface-dark border border-[#29382e] rounded-2xl w-full max-w-2xl overflow-hidden shadow-2xl">
        <div class="flex items-center justify-between p-6 border-b border-[#29382e]">
            <h3 id="modalTitle" class="text-xl font-bold text-white">Tambah Penyakit</h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" class="p-6 space-y-4">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="id" id="diseaseId">

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-400">Nama Penyakit</label>
                <input type="text" name="name" id="diseaseName" required class="w-full bg-[#111813] border border-[#29382e] rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-400">Deskripsi</label>
                <textarea name="description" id="diseaseDescription" rows="3" required class="w-full bg-[#111813] border border-[#29382e] rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-400">Solusi</label>
                    <textarea name="solution" id="diseaseSolution" rows="4" class="w-full bg-[#111813] border border-[#29382e] rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all"></textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-400">Pencegahan</label>
                    <textarea name="prevention" id="diseasePrevention" rows="4" class="w-full bg-[#111813] border border-[#29382e] rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModal()" class="px-6 py-2.5 rounded-lg border border-[#29382e] text-slate-300 font-bold hover:bg-white/5 transition-all">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary text-black font-bold hover:bg-green-400 transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(mode, data = null) {
    const modal = document.getElementById('diseaseModal');
    const title = document.getElementById('modalTitle');
    const action = document.getElementById('formAction');

    // Clear form
    document.getElementById('diseaseId').value = '';
    document.getElementById('diseaseName').value = '';
    document.getElementById('diseaseDescription').value = '';
    document.getElementById('diseaseSolution').value = '';
    document.getElementById('diseasePrevention').value = '';

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Penyakit';
        action.value = 'edit';
        document.getElementById('diseaseId').value = data.id;
        document.getElementById('diseaseName').value = data.name;
        document.getElementById('diseaseDescription').value = data.description;
        document.getElementById('diseaseSolution').value = data.solution;
        document.getElementById('diseasePrevention').value = data.prevention;
    } else {
        title.innerText = 'Tambah Penyakit';
        action.value = 'add';
    }

    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('diseaseModal').classList.add('hidden');
}

function confirmDelete(id, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus penyakit "${name}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="${id}">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?php include 'footer.php'; ?>
