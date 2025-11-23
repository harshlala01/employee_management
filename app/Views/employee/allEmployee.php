<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            min-height: 100vh;
        }
        /* Navbar */
        .navbar {
            background: #000;
            padding: 12px 110px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo { 
            font-weight: bold;
             font-size: 18px;
             color: white;
             text-decoration: none; 
        }
        .nav-links a {
             color: white;
             text-decoration: none;
             margin-left: 15px;
             font-weight: 500;
         }
        .nav-links a:hover { 
            color: #4CAF50;
         }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        h1 {
             text-align: center; 
            margin-bottom: 20px; 
            color: #333; 
        }

        /* Table */
        table {
             width: 100%;
             border-collapse: collapse;
             margin-top: 20px;
         }
        th, td {
             padding: 10px;
             border-bottom: 1px solid #eee;
             text-align: left;
         }
        th {
             background: #4CAF50;
             color: white; 
        }
        tr:hover { 
            background: #f8f9fa;
         }
        .employee-img {
             width: 40px; 
            height: 40px;
             border-radius: 50%;
             object-fit: cover;
         }

        /* Buttons */
        .actions a {
             text-decoration: none;
             padding: 6px 10px;
             border-radius: 4px; font-size: 12px;
             margin-right: 5px;
             color: white;
             display: inline-flex; 
            align-items: center;
             gap: 3px;
         }
        .edit-btn {
             background: #007bff;
         }
        .edit-btn:hover { 
            background: #0056b3; 
        }
        .delete-btn {
             background: #dc3545;
         }
        .delete-btn:hover { 
            background: #c82333;
         }

        /* Flash messages */
        .alert {
             padding: 10px;
             margin-bottom: 15px;
             border-radius: 6px;
             text-align: center; 
            font-size: 14px; 
        }
        .alert-success {
             background: #d4edda;
             color: #155724; 
            border: 1px solid #c3e6cb;
         }
        .alert-error {
             background: #f8d7da;
             color: #721c24;
             border: 1px solid #f5c6cb; 
        }

        /* No data */
        .no-data {
             text-align: center;
             padding: 30px;
             color: #666; 
        }
        .no-data i {
             font-size: 36px;
             margin-bottom: 10px;
             display: block;
             color: #ccc; }
        .btn {
             display: inline-block;
             padding: 10px 15px;
             background: #4CAF50;
             color: white;
             border-radius: 5px; 
            text-decoration: none;
             margin-top: 10px;
         }
        .btn:hover {
             background: #45a049;
         }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="#" class="logo">Employee Management System</a>
        <div class="nav-links">
            <a href="<?= base_url('/employee') ?>">All Employee</a>
            <a href="<?= base_url('/employee/add') ?>">Add Employee</a>
            <a href="<?= base_url('users/logout') ?>">Logout</a>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <h1><i class="fas fa-users"></i> Employee Dashboard</h1>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Employee Table / No Data -->
        <?php if (empty($employees)): ?>
            <div class="no-data">
                <i class="fas fa-users-slash"></i>
                <h3>No Employees Found</h3>
                <a href="<?= base_url('/employee/add') ?>" class="btn"><i class="fas fa-plus"></i> Add First Employee</a>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $emp): ?>
                    <tr>
                        <td>#<?= $emp['id'] ?></td>
                        <td>
                            <?php if(!empty($emp['picture'])): ?>
                                <img src="<?= base_url('uploads/'.$emp['picture']) ?>" class="employee-img" alt="Photo">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/40?text=NO+IMG" class="employee-img" alt="No Photo">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($emp['name']) ?></td>
                        <td><?= htmlspecialchars($emp['address']) ?></td>
                        <td><?= htmlspecialchars($emp['designation']) ?></td>
                        <td>₹<?= number_format($emp['salary'], 2) ?></td>
                        <td class="actions">
                            <a href="<?= base_url('/employee/edit/'.$emp['id']) ?>" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
                            <a href="<?= base_url('/employee/delete/'.$emp['id']) ?>" class="delete-btn"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>
