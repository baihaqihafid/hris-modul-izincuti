<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login' ?> - SIM Izin Cuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }
        .login-header {
            background: #1e3c72;
            color: #fff;
            padding: 2rem;
            text-align: center;
        }
        .login-header i {
            font-size: 2.5rem;
        }
        .login-body {
            padding: 2rem;
        }
        .btn-primary {
            background: #1e3c72;
            border: none;
        }
        .btn-primary:hover {
            background: #2a5298;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-building"></i>
            <h4 class="mt-2 mb-0">SIM Izin & Cuti</h4>
            <small>Sistem Informasi Pengajuan Izin dan Cuti Karyawan</small>
        </div>
        <div class="login-body">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>