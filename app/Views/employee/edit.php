<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Employee</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #667eea, #764ba2);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        width: 90%;
        max-width: 400px;
        text-align: center;
    }

    h2 {
        color: #2c3e50;
        margin-bottom: 20px;
        font-size: 24px;
    }

    input {
        width: 100%;
        padding: 10px 12px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
        transition: 0.3s;
    }
    input:focus {
         border-color: #667eea;
         box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
          outline: none; 
        }

    button {
        width: 100%;
        padding: 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 600;
        margin-top: 15px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
         background: #218838;
         transform: translateY(-1px); 
    }

    .back-btn {
         display: inline-block; 
        margin-top: 15px; 
        color: #667eea; 
        text-decoration: none; 
        font-size: 14px;
     }
    .back-btn:hover { 
        text-decoration: underline; 
    }

    /* File input with preview */
    .file-input-container {
         margin: 12px 0;
     }
    .file-input-wrapper {
        display: flex; align-items: center;
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        padding: 12px;
        background: #f8fafc;
        height: 100px;
        position: relative;
        overflow: hidden;
        transition: 0.3s;
    }
    .file-input-wrapper:hover {
         border-color: #667eea;
         background: #f0f4f8; 
    }
    .file-input-button {
         padding: 8px 16px;
          background: #667eea;
          color: white;
          border: none;
          border-radius: 6px; 
         cursor: pointer;
          margin-right: 12px;
          font-size: 13px; 
         font-weight: 500;
          z-index: 2; 
        }
    .file-input-button:hover {
         background: #5a6fd8; 
        }
    .file-input-wrapper input[type="file"] { 
        position: absolute;
         left: 0; 
        top: 0;
         width: 100%;
         height: 100%; 
        opacity: 0; 
        cursor: pointer;
     }

    .file-preview { 
        flex: 1;
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100%;
         overflow: hidden; 
        padding-left: 8px;
     }
    .file-preview img {
         max-height: 70px; 
        max-width: 100%;
         border-radius: 6px;
         box-shadow: 0 3px 8px rgba(0,0,0,0.1);
         transition: 0.3s; 
    }
    .file-preview img:hover {
         transform: scale(1.05);
         }
    .preview-text {
         color: #718096;
         font-size: 13px;
         margin-top: 6px;
         text-align: center;
     }
    .file-name {
         color: #2d3748;
         font-size: 13px; 
        margin-top: 4px;
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis; 
        max-width: 100%; 
    }

    .file-input-wrapper.has-image {
         border-style: solid;
     border-color: #cbd5e0;
     padding: 8px; 
    }
</style>
</head>
<body>
<div class="card">
    <h2>Edit Employee</h2>
    <form action="<?= base_url('/employee/update/'.$employee['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="text" name="name" value="<?= old('name', $employee['name']) ?>" placeholder="Name" required>
        <input type="text" name="address" value="<?= old('address', $employee['address']) ?>" placeholder="Address" required>
        <input type="text" name="designation" value="<?= old('designation', $employee['designation']) ?>" placeholder="Designation" required>
        <input type="number" name="salary" value="<?= old('salary', $employee['salary']) ?>" placeholder="Salary" required>

      <div class="file-input-container">
    <div class="file-input-wrapper" id="fileInputWrapper">
        <div class="file-input-button" id="fileButton">Choose New Photo</div>
        <div class="file-preview" id="filePreview">
            <div class="preview-text">New photo preview</div>
        </div>
        <input type="file" name="picture" id="pictureInput" accept="image/*">
    </div>
</div>

        <button type="submit">Update Employee</button>
    </form>
    <a href="<?= base_url('/employee') ?>" class="back-btn">← Back to Employees</a>
</div>

<script>
const pictureInput = document.getElementById('pictureInput');
const filePreview = document.getElementById('filePreview');
const fileInputWrapper = document.getElementById('fileInputWrapper');
const fileButton = document.getElementById('fileButton');

// Custom button click opens file dialog
fileButton.addEventListener('click', () => pictureInput.click());

// File preview
pictureInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            filePreview.innerHTML = '';
            
            const img = document.createElement('img');
            img.src = e.target.result; // <-- correct way
            img.alt = "Preview";

            const fileName = document.createElement('div');
            fileName.className = 'file-name';
            fileName.textContent = file.name;

            filePreview.appendChild(img);
            filePreview.appendChild(fileName);

            fileInputWrapper.classList.add('has-image');
        };
        reader.readAsDataURL(file);
    } else {
        filePreview.innerHTML = '<div class="preview-text">New photo preview</div>';
        fileInputWrapper.classList.remove('has-image');
    }
});
</script>