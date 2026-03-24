<?php include 'header.php';

// Handle Add/Edit/Delete actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $id_penyakit = (int)$_POST['id_penyakit'];
            $id_gejala = (int)$_POST['id_gejala'];
            $cf_pakar = (float)$_POST['cf_pakar'];

            // Check if rule already exists
            $check = $conn->query("SELECT id FROM aturan WHERE id_penyakit=$id_penyakit AND id_gejala=$id_gejala");
            if ($check->num_rows > 0) {
                echo "<script>alert('Aturan ini sudah ada!'); window.location='aturan.php';</script>";
            } else {
                $sql = "INSERT INTO aturan (id_penyakit, id_gejala, cf_pakar) VALUES ($id_penyakit, $id_gejala, $cf_pakar)";
                if ($conn->query($sql)) {
                    echo "<script>alert('Aturan berhasil ditambahkan!'); window.location='aturan.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan aturan: " . addslashes($conn->error) . "');</script>";
                }
            }
        } elseif ($_POST['action'] == 'edit') {
            $id = (int)$_POST['id'];
            $id_penyakit = (int)$_POST['id_penyakit'];
            $id_gejala = (int)$_POST['id_gejala'];
            $cf_pakar = (float)$_POST['cf_pakar'];

            $sql = "UPDATE aturan SET id_penyakit=$id_penyakit, id_gejala=$id_gejala, cf_pakar=$cf_pakar WHERE id=$id";
            if ($conn->query($sql)) {
                echo "<script>alert('Aturan berhasil diperbarui!'); window.location='aturan.php';</script>";
            }
        } elseif ($_POST['action'] == 'delete') {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM aturan WHERE id=$id";
            if ($conn->query($sql)) {
                echo "<script>alert('Aturan berhasil dihapus!'); window.location='aturan.php';</script>";
            }
        }
    }
}
?>

<header class="flex items-center justify-between border-b border-[#29382e] bg-background-dark/95 backdrop-blur px-8 py-4 z-10">
    <h2 class="text-white text-xl font-bold tracking-tight">Basis Pengetahuan (Rules)</h2>
    <button onclick="openAddModal()" class="bg-primary text-black font-bold text-sm px-4 py-2 rounded-lg hover:bg-green-400 transition-all">+ Hubungkan Gejala</button>
</header>

<div class="flex-1 overflow-y-auto p-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-surface-dark rounded-xl border border-[#29382e] overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#233329] text-[#9db8a6] text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">Penyakit</th>
                        <th class="px-6 py-4">Gejala</th>
                        <th class="px-6 py-4 w-32 text-center">Bobot Pakar (CF)</th>
                        <th class="px-6 py-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#29382e] text-sm text-white">
                    <?php
                    $rules = $conn->query("SELECT r.*, d.nama as nama_penyakit, s.nama as nama_gejala, s.kode as kode_gejala
                                         FROM aturan r
                                         JOIN penyakit d ON r.id_penyakit = d.id
                                         JOIN gejala s ON r.id_gejala = s.id
                                         ORDER BY d.nama, s.kode ASC");
                    while ($r = $rules->fetch_assoc()):
                    ?>
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 text-slate-300"><?php echo $r['nama_penyakit']; ?></td>
                        <td class="px-6 py-4 text-slate-400">
                            <span class="text-primary font-mono text-xs mr-2"><?php echo $r['kode_gejala']; ?></span>
                            <?php echo htmlspecialchars($r['nama_gejala']); ?>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-white"><?php echo $r['cf_pakar']; ?></td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick='openEditModal(<?php echo json_encode($r); ?>)' class="text-blue-400 hover:text-blue-300"><span class="material-symbols-outlined text-lg">edit</span></button>
                                <button onclick="deleteRule(<?php echo $r['id']; ?>, '<?php echo addslashes($r['nama_penyakit']); ?>', '<?php echo addslashes($r['nama_gejala']); ?>')" class="text-red-400 hover:text-red-300"><span class="material-symbols-outlined text-lg">delete</span></button>
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
<div id="ruleModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-surface-dark border border-[#29382e] rounded-2xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="px-8 py-6 border-b border-[#29382e] flex items-center justify-between">
            <h3 id="modalTitle" class="text-white text-lg font-bold">Hubungkan Gejala</h3>
            <button onclick="closeModal()" class="text-[#9db8a6] hover:text-white"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form action="" method="POST" class="p-8 space-y-6">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="id" id="ruleId">

            <div class="space-y-2">
                <label class="text-sm font-medium text-[#9db8a6]">Penyakit</label>
                <select name="id_penyakit" id="ruleDisease" required class="w-full bg-[#1a261f] border border-[#29382e] rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors">
                    <option value="">Pilih Penyakit</option>
                    <?php
                    $diseases = $conn->query("SELECT id, nama, kode FROM penyakit ORDER BY kode ASC");
                    while ($d = $diseases->fetch_assoc()):
                    ?>
                    <option value="<?php echo $d['id']; ?>"><?php echo $d['kode'] . ' - ' . $d['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-[#9db8a6]">Gejala</label>
                <select name="id_gejala" id="ruleSymptom" required class="w-full bg-[#1a261f] border border-[#29382e] rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors">
                    <option value="">Pilih Gejala</option>
                    <?php
                    $symptoms = $conn->query("SELECT id, nama, kode FROM gejala ORDER BY kode ASC");
                    while ($s = $symptoms->fetch_assoc()):
                    ?>
                    <option value="<?php echo $s['id']; ?>"><?php echo $s['kode'] . ' - ' . $s['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-[#9db8a6]">Bobot Pakar (Certainty Factor: 0 s/d 1.0)</label>
                <input type="number" step="0.01" min="0" max="1" name="cf_pakar" id="ruleCf" required placeholder="Contoh: 0.74" class="w-full bg-[#1a261f] border border-[#29382e] rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors">
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeModal()" class="flex-1 px-6 py-3 rounded-xl border border-[#29382e] text-white font-semibold hover:bg-white/5 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-primary text-black font-bold hover:bg-green-400 transition-all shadow-lg shadow-primary/20">Simpan Aturan</button>
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
    document.getElementById('modalTitle').innerText = 'Hubungkan Gejala';
    document.getElementById('formAction').value = 'add';
    document.getElementById('ruleId').value = '';
    document.getElementById('ruleDisease').value = '';
    document.getElementById('ruleSymptom').value = '';
    document.getElementById('ruleCf').value = '';
    document.getElementById('ruleModal').classList.remove('hidden');
}

function openEditModal(rule) {
    document.getElementById('modalTitle').innerText = 'Edit Hubungan Gejala';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('ruleId').value = rule.id;
    document.getElementById('ruleDisease').value = rule.id_penyakit;
    document.getElementById('ruleSymptom').value = rule.id_gejala;
    document.getElementById('ruleCf').value = rule.cf_pakar;
    document.getElementById('ruleModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('ruleModal').classList.add('hidden');
}

function deleteRule(id, disease, symptom) {
    if (confirm('Apakah Anda yakin ingin menghapus aturan untuk ' + disease + ' dengan gejala ' + symptom + '?')) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteForm').submit();
    }
}
</script>

<?php include 'footer.php'; ?>
