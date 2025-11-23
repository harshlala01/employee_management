<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Employee</title>
<style>
    body { 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 0; 
        padding: 22px; 
    }

    /* Navbar fixed at top */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: #131313ff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        z-index: 1000;
    }

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1100px;
        margin: 0 auto;
        padding: 10px 20px;
    }

    .logo {
        font-size: 20px;
        font-weight: 600;
        color: #e3e3e3ff;
        text-decoration: none;
    }

    .nav-links a {
        margin-left: 15px;
        text-decoration: none;
        color: #fefefeff;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-links a:hover {
        color: #764ba2;
    }

    
   
     .card {
        background: white; 
        padding: 25px; 
        border-radius: 12px; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.1); 
        max-width: 400px; /* thoda chhota */
        width: 90%;       /* responsive */
        text-align: center;
        margin: 76px auto 40px auto; /* center & top margin kam kiya */
    }

    h2 { 
        text-align: center; 
        margin: 0 0 25px 0; 
        color: #2c3e50; 
        font-weight: 600;
        font-size: 24px;
        margin-bottom: 20px; 
    }

    input { 
        width: 100%; 
        padding: 10px 12px; 
        margin: 8px 0; 
        border: 1px solid #e1e8ed; 
        border-radius: 8px; 
        box-sizing: border-box; 
        font-size: 14px;
        transition: all 0.3s ease;
    }

    input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    button { 
        width: 100%; 
        padding: 12px; 
        background: #28a745; 
        color: white; 
        border: none; 
        border-radius: 8px; 
        cursor: pointer; 
        margin-top: 20px; 
        font-size: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    button:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .alert { 
        padding: 12px 15px; 
        margin: 15px 0; 
        border-radius: 8px; 
        text-align: center; 
        font-size: 14px; 
    }

    .success { 
        background: #d4edda; 
        color: #155724; 
        border: 1px solid #c3e6cb;
    }

    .error { 
        background: #f8d7da; 
        color: #721c24; 
        border: 1px solid #f5c6cb;
    }

    .link { 
        text-align: center; 
        margin-top: 20px; 
        font-size: 15px; 
    }

    .link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .link a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    /* Custom file input with preview */
    .file-input-container {
        position: relative;
        width: 100%;
        margin: 15px 0;
    }

    .file-input-wrapper {
        display: flex;
        align-items: center;
        border: 2px dashed #cbd5e0;
        border-radius: 10px;
        padding: 12px;
        background: #f8fafc;
        height: 100px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .file-input-wrapper:hover {
        border-color: #667eea;
        background: #f0f4f8;
    }

    .file-input-button {
        padding: 10px 20px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        margin-right: 15px;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .file-input-button:hover {
        background: #5a6fd8;
        transform: translateY(-1px);
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 3;
    }

    .file-preview {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        overflow: hidden;
        padding-left: 10px;
        position: relative;
    }

    .file-preview img {
        max-height: 60px;
        max-width: 100%;
        object-fit: contain;
        border-radius: 6px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .file-preview img:hover {
        transform: scale(1.05);
    }

    .preview-text {
        color: #718096;
        font-size: 14px;
        text-align: center;
        margin-top: 8px;
    }
</style>
</head>
<body>

<!-- Navigation Bar  -->
<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">Employee Management System</a>
        <div class="nav-links">
            <a href="<?= base_url('/employee') ?>">All Employee</a>
            <a href="<?= base_url('/employee/add') ?>">Add Employee</a>
            <a href="<?= base_url('users/logout') ?>">Logout</a>
        </div>
    </div>
</nav>

 <!-- Add Employee Card   -->
<div class="card">
    <h2>Add Employee</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/employee/store') ?>" method="post" enctype="multipart/form-data" id="employeeForm">
        <?= csrf_field() ?>
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="designation" placeholder="Designation" required>
        <input type="number" name="salary" placeholder="Salary" required>

      <!-- File input with preview  -->
        <div class="file-input-container">
            <div class="file-input-wrapper">
                <div class="file-input-button">Choose File</div>
                <div class="file-preview" id="filePreview">
                    <div class="preview-text">No file chosen</div>
                </div>
                <input type="file" name="picture" id="pictureInput" accept="image/*">
            </div>
        </div>

        <button type="submit">Save Employee</button>
    </form>

    <div class="link">
        <a href="<?= base_url('/employee') ?>">View Employees</a>
    </div>
</div>

<script>
    // File preview script
    const pictureInput = document.getElementById('pictureInput');
    const filePreview = document.getElementById('filePreview');

    pictureInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                filePreview.innerHTML = '';
                const img = document.createElement('img');
                img.src = this.result;
                img.alt = "Preview";
                const fileName = document.createElement('div');
                fileName.className = 'preview-text';
                fileName.textContent = file.name;
                filePreview.appendChild(img);
                filePreview.appendChild(fileName);
            });
            reader.readAsDataURL(file);
        } else {
            filePreview.innerHTML = '<div class="preview-text">No file chosen</div>';
        }
    });
</script>
</body>
</html>
