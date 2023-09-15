<?php

// Mendefinisikan fungsi form_open
function form_open($action, $method = 'POST') {
    echo '<form action="' . $action . '" method="' . $method . '">';
}

// Mendefinisikan variabel $permohonan
$permohonan = [
    'id_permohonan' => 1,
    'status' => 'Pending', // Berikan nilai status dari database atau sumber data lainnya
];

// Mendefinisikan variabel $status_options
$status_options = [
    'Pending',
    'Disetujui',
    'Ditolak',
];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Status Permohonan Surat</title>
</head>
<body>

    <h2>Edit Status Permohonan Surat</h2>

    <?php form_open('PermohonanSurat/updateStatus/' . $permohonan['id_permohonan']); ?>

    <label>Status:</label>
    <select name="status">
        <?php foreach ($status_options as $option): ?>
            <option value="<?php echo $option; ?>" <?php echo ($permohonan['status'] === $option) ? 'selected' : ''; ?>><?php echo $option; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Simpan</button>

    </form>

</body>
</html>
