<?php
require "header.php";

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: index.php?error=notloggedin");
    exit();
}
?>

<style>
    .visiting-card-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        color: var(--text-secondary);
        margin-bottom: 10px;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
    }

    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 15px;
        background: var(--carbon-dark);
        border: 1px solid var(--metal-dark);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none;
        border-color: var(--accent-purple);
        box-shadow: 0 0 10px rgba(153, 69, 255, 0.2);
    }

    .card-shapes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .shape-option {
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .shape-option input {
        display: none;
    }

    .shape-preview {
        height: 150px;
        background: linear-gradient(135deg, var(--carbon-medium), var(--carbon-dark));
        border: 2px solid var(--metal-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .shape-1 .shape-preview { border-radius: 10px; }
    .shape-2 .shape-preview { border-radius: 20px; }
    .shape-3 .shape-preview { border-radius: 50% 20px 20px 20px; }
    .shape-4 .shape-preview { border-radius: 20px 20px 0 20px; }
    .shape-5 .shape-preview { 
        border-radius: 30px 0 30px 0;
        transform: skew(-2deg);
    }
    .shape-6 .shape-preview { 
        clip-path: polygon(0 0, 100% 0, 100% 80%, 80% 100%, 0 100%);
    }
   
    .shape-option input:checked + .shape-preview {
        border-color: var(--accent-purple);
        box-shadow: 0 0 20px rgba(153, 69, 255, 0.3);
        background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
        color: var(--text-primary);
    }

    .shape-name {
        text-align: center;
        margin-top: 10px;
        font-size: 12px;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

  .shape-option input:checked + .shape-preview {
    border-color: var(--accent-purple) !important;
    box-shadow: 0 0 20px rgba(153, 69, 255, 0.3) !important;
    background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue)) !important;
    color: var(--text-primary) !important;
}

.shape-option input:checked + .shape-preview + .shape-name {
    color: var(--accent-purple) !important;
    font-weight: 600 !important;
}
    .template-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin: 30px 0;
    }

    .template-option {
        border: 2px solid var(--metal-dark);
        padding: 15px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 180px;
    }

    .template-option:hover {
        border-color: var(--accent-purple);
    }

    .template-option.selected {
        border-color: var(--accent-purple);
        background: rgba(153, 69, 255, 0.1);
    }

    .template-preview-img {
        width: 100%;
        height: 100px;
        border-radius: 5px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 12px;
    }

    .template-1 .template-preview-img { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .template-2 .template-preview-img { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .template-3 .template-preview-img { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .template-4 .template-preview-img { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: #333; }

    .btn-submit {
        background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 20px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(153, 69, 255, 0.4);
    }

    .form-section {
        background: linear-gradient(135deg, rgba(42, 42, 42, 0.3), rgba(26, 26, 26, 0.5));
        border: 1px solid var(--metal-dark);
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        background: linear-gradient(135deg, var(--text-primary), var(--accent-purple));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .error {
        color: var(--accent-red);
        background: rgba(255, 51, 51, 0.1);
        border: 1px solid var(--accent-red);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
    }

    .success {
        color: var(--accent-green);
        background: rgba(0, 255, 136, 0.1);
        border: 1px solid var(--accent-green);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .card-shapes-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .template-preview {
            justify-content: center;
        }
        
        .template-option {
            width: 150px;
        }
    }
    
    .shape-1 .shape-preview { 
    border-radius: 10px; /* Standard */
}
.shape-2 .shape-preview { 
    border-radius: 20px; /* Rounded */
}
.shape-3 .shape-preview { 
    border-radius: 50% 20px 20px 20px; /* Modern */
}
.shape-4 .shape-preview { 
    border-radius: 20px 20px 0 20px; /* Angular */
}
.shape-5 .shape-preview { 
    border-radius: 30px 0 30px 0;
    transform: skew(-2deg); /* Skewed */
}
.shape-6 .shape-preview { 
    clip-path: polygon(0 0, 100% 0, 100% 80%, 80% 100%, 0 100%); /* Polygonal */
}
.shape-7 .shape-preview { 
    border-radius: 50%; /* Circle */
}
.shape-8 .shape-preview { 
    clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%); /* Diamond */
}
.shape-9 .shape-preview { 
    clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%); /* Hexagon */
}
.shape-10 .shape-preview { 
    border-radius: 20px;
    position: relative;
}
.shape-10 .shape-preview::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: 10px solid var(--carbon-medium);
}
.shape-11 .shape-preview { 
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%; /* Badge */
}
.shape-12 .shape-preview { 
    border-radius: 15px;
    position: relative;
    border: 2px dashed var(--metal-light);
}
</style>

<main>
    <div class="visiting-card-wrapper">
        <h1 style="text-align: center; margin-bottom: 40px; background: linear-gradient(135deg, var(--accent-cyan), var(--accent-purple)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            Design Your Visiting Card
        </h1>
        
<?php if (isset($_GET['error'])): ?>
    <div class="error">
        <?php
        switch ($_GET['error']) {
            case 'emptyfields': 
                echo "⚠️ Please fill in all required fields."; 
                break;
            case 'invalidemail': 
                echo "📧 Please enter a valid email address."; 
                break;
            case 'invalidmobile': 
                echo "📱 Please enter a valid mobile number (10 digits)."; 
                break;
            case 'notloggedin': 
                echo "🔒 Please log in to create a visiting card."; 
                break;
            case 'validation':
                if (isset($_GET['details'])) {
                    $errors = explode('|', $_GET['details']);
                    foreach ($errors as $error) {
                        echo "❌ " . htmlspecialchars($error) . "<br>";
                    }
                } else {
                    echo "❌ Please check your input fields.";
                }
                break;
            case 'dberror':
                echo "💾 Database error occurred. Please try again.";
                if (isset($_GET['message'])) {
                    echo "<br><small>Debug: " . htmlspecialchars($_GET['message']) . "</small>";
                }
                break;
            default: 
                echo "❗ An error occurred. Please try again."; 
                break;
        }
        ?>
    </div>
<?php elseif (isset($_GET['success'])): ?>
    <div class="success">
        ✅ Visiting card created successfully! 
        <a href="myprofile.php" style="color: var(--accent-green); text-decoration: underline; font-weight: bold;">
            View your profile
        </a>
    </div>
<?php endif; ?>

 <form action="includes/savecard.inc.php" method="post" enctype="multipart/form-data">
    <!-- Personal Information Section -->
    <div class="form-section">
        <h2 class="section-title">Personal Information</h2>
        
        <div class="form-group">
            <label for="full_name">Full Name *</label>
            <input type="text" id="full_name" name="full_name" required 
                   value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="designation">Designation *</label>
            <input type="text" id="designation" name="designation" required
                   value="<?php echo isset($_GET['designation']) ? htmlspecialchars($_GET['designation']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="company">Company/Organization *</label>
            <input type="text" id="company" name="company" required
                   value="<?php echo isset($_GET['company']) ? htmlspecialchars($_GET['company']) : '' ?>">
        </div>
    </div>

    <!-- Contact Information Section -->
    <div class="form-section">
        <h2 class="section-title">Contact Information</h2>
        
        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" required
                   value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="mobile">Mobile Number *</label>
            <input type="tel" id="mobile" name="mobile" required pattern="[0-9]{10}"
                   value="<?php echo isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : '' ?>">
            <small style="color: var(--text-dim); font-size: 12px;">Format: 10 digits without spaces</small>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="3"><?php echo isset($_GET['address']) ? htmlspecialchars($_GET['address']) : '' ?></textarea>
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" id="website" name="website"
                   value="<?php echo isset($_GET['website']) ? htmlspecialchars($_GET['website']) : '' ?>">
        </div>
    </div>

    <!-- Card Design Section -->
    <div class="form-section">
        <h2 class="section-title">Card Design</h2>
        
        <div class="form-group">
            <label>Choose Card Shape *</label>
            <div class="card-shapes-grid">
                <div class="shape-option shape-1">
                    <input type="radio" name="card_shape" value="1" checked>
                    <div class="shape-preview">Standard</div>
                    <div class="shape-name">Standard</div>
                </div>
                <div class="shape-option shape-2">
                    <input type="radio" name="card_shape" value="2">
                    <div class="shape-preview">Rounded</div>
                    <div class="shape-name">Rounded</div>
                </div>
                
                <div class="shape-option shape-3">
                <input type="radio" name="card_shape" value="3">
                <div class="shape-preview">Modern</div>
                <div class="shape-name">Modern</div>
            </div>
            <div class="shape-option shape-4">
                <input type="radio" name="card_shape" value="4">
                <div class="shape-preview">Angular</div>
                <div class="shape-name">Angular</div>
            </div>
            <div class="shape-option shape-5">
                <input type="radio" name="card_shape" value="5">
                <div class="shape-preview">Skewed</div>
                <div class="shape-name">Skewed</div>
            </div>
            <div class="shape-option shape-6">
                <input type="radio" name="card_shape" value="6">
                <div class="shape-preview">Polygonal</div>
                <div class="shape-name">Polygonal</div>
            </div>
            
            <!-- Creative Shapes -->
            <div class="shape-option shape-7">
                <input type="radio" name="card_shape" value="7">
                <div class="shape-preview">Circle</div>
                <div class="shape-name">Circle</div>
            </div>
            <div class="shape-option shape-8">
                <input type="radio" name="card_shape" value="8">
                <div class="shape-preview">Diamond</div>
                <div class="shape-name">Diamond</div>
            </div>
            <div class="shape-option shape-9">
                <input type="radio" name="card_shape" value="9">
                <div class="shape-preview">Hexagon</div>
                <div class="shape-name">Hexagon</div>
            </div>
            <div class="shape-option shape-10">
                <input type="radio" name="card_shape" value="10">
                <div class="shape-preview">Speech Bubble</div>
                <div class="shape-name">Speech Bubble</div>
            </div>
            
            <!-- Professional Shapes -->
            <div class="shape-option shape-11">
                <input type="radio" name="card_shape" value="11">
                <div class="shape-preview">Badge</div>
                <div class="shape-name">Badge</div>
            </div>
            <div class="shape-option shape-12">
                <input type="radio" name="card_shape" value="12">
                <div class="shape-preview">Ticket</div>
                <div class="shape-name">Ticket</div>
            </div>
                <!-- Add other shapes as needed -->
            </div>
        </div>

        <div class="form-group">
            <label>Choose Design Template *</label>
            <div class="template-preview">
                <div class="template-option template-1" onclick="selectTemplate(1)">
                    <div class="template-preview-img">Template 1</div>
                    <input type="radio" name="template" value="1" checked> Classic Blue
                </div>
                <div class="template-option template-2" onclick="selectTemplate(2)">
                    <div class="template-preview-img">Template 2</div>
                    <input type="radio" name="template" value="2"> Modern Pink
                </div>
            
                <!-- Add other templates as needed -->
            </div>
        </div>

        <div class="form-group">
            <label for="logo">Profile Picture / Logo (Optional)</label>
            <input type="file" id="logo" name="logo" accept="image/*">
            <small style="color: var(--text-dim); font-size: 12px;">Accepted formats: JPG, PNG, GIF. Max size: 2MB</small>
        </div>
    </div>

    <button type="submit" name="card-submit" class="btn-submit">Create Visiting Card & Save Profile</button>
</form>
    </div>
</main>

<script>
    function selectTemplate(templateNum) {
        // Remove selected class from all template options
        document.querySelectorAll('.template-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        // Add selected class to clicked template option
        event.currentTarget.classList.add('selected');
        
        // Check the corresponding radio button
        document.querySelector(`input[name="template"][value="${templateNum}"]`).checked = true;
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize first template as selected
        document.querySelector('.template-option').classList.add('selected');
        
        // Add click handlers for shape options
        document.querySelectorAll('.shape-option').forEach(option => {
            option.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                
                // Update visual selection for shapes
                document.querySelectorAll('.shape-option').forEach(opt => {
                    opt.classList.remove('selected');
                    const preview = opt.querySelector('.shape-preview');
                    const name = opt.querySelector('.shape-name');
                    
                    // Reset styles
                    preview.style.borderColor = 'var(--metal-dark)';
                    preview.style.background = 'linear-gradient(135deg, var(--carbon-medium), var(--carbon-dark))';
                    preview.style.color = 'var(--text-secondary)';
                    name.style.color = 'var(--text-secondary)';
                    name.style.fontWeight = 'normal';
                });
                
                // Highlight selected shape
                this.classList.add('selected');
                const selectedPreview = this.querySelector('.shape-preview');
                const selectedName = this.querySelector('.shape-name');
                
                selectedPreview.style.borderColor = 'var(--accent-purple)';
                selectedPreview.style.background = 'linear-gradient(135deg, var(--accent-purple), var(--accent-blue))';
                selectedPreview.style.color = 'var(--text-primary)';
                selectedName.style.color = 'var(--accent-purple)';
                selectedName.style.fontWeight = '600';
            });
        });

        // Add click handlers for template options
        document.querySelectorAll('.template-option').forEach(option => {
            option.addEventListener('click', function() {
                selectTemplate(this.querySelector('input[type="radio"]').value);
            });
        });

        // Initialize first shape as selected
        const firstShape = document.querySelector('.shape-option');
        if (firstShape) {
            firstShape.click(); // This will trigger the click handler
        }
    });
</script>

<?php
require "footer.php";
?>
