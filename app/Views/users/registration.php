<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background: #f0f2f5; */
             background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: bold;
        }
        button:hover {
            background: #218838;
        }
        .alert {
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 5px;
            font-size: 14px;
        }
        .success {
             background: #d4edda; 
            color: #155724;
         }
        .error {
             background: #f8d7da;
             color: #721c24; 
        }
        .login-link {
             text-align: center;
             margin-top: 15px;
         }
        .login-link a { 
            text-decoration: none;
             color: #007bff;
         }
        .login-link a:hover {
             text-decoration: underline; 
        }
    </style>
</head>
<body>

<div class="container">
<h2><?= $title ?></h2>
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if(isset($validation)): ?>
        <div class="alert error"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('users/registration') ?>">
        <?= csrf_field() ?>
        <input type="text" name="name" placeholder="Full Name" value="<?= set_value('name') ?>" required>
        <input type="text" name="user_name" placeholder="Username" value="<?= set_value('user_name') ?>" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="<?= base_url('users/login') ?>">Login</a>
    </div>
</div>

</body>
</html>
