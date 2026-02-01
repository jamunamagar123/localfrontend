<?php
// booking.php - COMPLETE VERSION
session_start();

// Simple auth check
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo '<script>
        alert("Please login to book a tour.");
        window.location.href = "login.php";
    </script>';
    exit;
}

// Get user data from session
$user = [
    'user_id' => $_SESSION['user_id'],
    'first_name' => $_SESSION['first_name'] ?? 'User',
    'last_name' => $_SESSION['last_name'] ?? '',
    'name' => ($_SESSION['first_name'] ?? 'User') . ' ' . ($_SESSION['last_name'] ?? ''),
    'email' => $_SESSION['email'] ?? ''
];

// Database connection
require_once __DIR__ . '/../backend/connect.php';

// Get destination_id from URL
$destination_id = isset($_GET['destination_id']) ? intval($_GET['destination_id']) : 0;
$destination = null;

// Fetch destination details
if ($destination_id > 0) {
    $sql = "SELECT * FROM destination WHERE destination_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $destination_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $destination = $result->fetch_assoc();
        }
        $stmt->close();
    }
}

// Fetch only approved guides
$guides = [];
$guides_sql = "SELECT * FROM guiders WHERE role = 'guide' AND status = 'approved' ORDER BY first_name ASC";
$guides_result = $conn->query($guides_sql);

if ($guides_result && $guides_result->num_rows > 0) {
    while($guide = $guides_result->fetch_assoc()) {

        // ADDITION: calculate total service amount for this guide from booking table
        $bookingSql = "SELECT IFNULL(SUM(total_amount), 0) AS total_service_amount 
                       FROM booking 
                       WHERE guider_id = ?";
        $stmtBooking = $conn->prepare($bookingSql);
        $stmtBooking->bind_param("i", $guide['guider_id']);
        $stmtBooking->execute();
        $resultBooking = $stmtBooking->get_result();
        $guide_price = 50; // default price
        if ($resultBooking && $resultBooking->num_rows > 0) {
            $bookingData = $resultBooking->fetch_assoc();
            $guide_price = (float)$bookingData['total_service_amount'];
        }
        $guide['guide_price'] = $guide_price; // add total service amount

        $guides[] = $guide;

        $stmtBooking->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Tour - Pokhara Tourism</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        /* --- KEEP ALL YOUR CSS AS IN ORIGINAL CODE --- */
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .user-info-box { background: linear-gradient(135deg, #0d6efd, #0a58ca); color: white; padding: 20px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .booking-form { background: white; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; }
        .form-header { text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #0d6efd; }
        .form-header h2 { color: #0d6efd; font-weight: 700; }
        .form-label { font-weight: 600; color: #495057; margin-bottom: 8px; }
        .form-label i { color: #0d6efd; width: 20px; margin-right: 8px; }
        .required { color: #dc3545; }
        .form-control, .form-select { border: 2px solid #dee2e6; border-radius: 8px; padding: 10px 15px; transition: all 0.3s; }
        .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); }
        .is-invalid { border-color: #dc3545 !important; }
        .invalid-feedback { display: none; color: #dc3545; font-size: 0.875em; margin-top: 5px; }
        .guide-section { background: #f8f9fa; border-radius: 10px; padding: 25px; margin: 25px 0; border: 2px solid #dee2e6; }
        .guide-options { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
        .guide-card { border: 2px solid #dee2e6; border-radius: 12px; padding: 20px; cursor: pointer; transition: all 0.3s ease; background: white; text-align: center; position: relative; height: 100%; display: flex; flex-direction: column; align-items: center; }
        .guide-card:hover { border-color: #0d6efd; transform: translateY(-5px); box-shadow: 0 10px 20px rgba(13, 110, 253, 0.1); }
        .guide-card.selected { border-color: #198754; background-color: #f0fff4; box-shadow: 0 5px 15px rgba(25, 135, 84, 0.1); }
        .guide-avatar { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 4px solid #0d6efd; }
        .avatar-placeholder { width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #0d6efd, #0a58ca); display: flex; align-items: center; justify-content: center; margin-bottom: 15px; border: 4px solid #0d6efd; color: white; font-size: 40px; }
        .guide-name { font-weight: 700; color: #212529; margin-bottom: 8px; font-size: 18px; }
        .guide-details { margin: 10px 0; flex-grow: 1; }
        .badge { font-size: 0.75em; font-weight: 500; padding: 5px 10px; margin: 2px; }
        .guide-price { color: #198754; font-weight: 700; font-size: 18px; margin-top: 10px; }
        .guide-price span { font-size: 14px; color: #6c757d; font-weight: normal; }
        .no-guide-option { background: #f8f9fa; border: 3px dashed #adb5bd; border-radius: 12px; padding: 25px; text-align: center; cursor: pointer; transition: all 0.3s; margin-top: 20px; }
        .no-guide-option:hover { background: #e9ecef; border-color: #0d6efd; }
        .no-guide-option.selected { background: #e7f1ff; border: 3px solid #0d6efd; }
        .no-guide-icon { font-size: 40px; color: #6c757d; margin-bottom: 15px; }
        .summary-box { background: #f8f9fa; border-radius: 10px; padding: 25px; margin-top: 25px; border-left: 5px solid #0d6efd; }
        .summary-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #dee2e6; }
        .summary-item:last-child { border-bottom: none; }
        .summary-total { font-weight: 800; color: #212529; font-size: 20px; margin-top: 15px; padding-top: 15px; border-top: 2px solid #adb5bd; }
        .alert-info { background-color: #e7f1ff; border-color: #b6d4fe; color: #084298; }
        .alert-success { background-color: #d1e7dd; border-color: #badbcc; color: #0f5132; }
        .btn-primary { background: linear-gradient(135deg, #0d6efd, #0a58ca); border: none; padding: 12px 30px; font-weight: 600; transition: all 0.3s; }
        .btn-primary:hover { background: linear-gradient(135deg, #0a58ca, #084298); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3); }
        .btn-outline-light { border-color: rgba(255, 255, 255, 0.5); }
        @media (max-width: 768px) { .guide-options { grid-template-columns: 1fr; } .booking-form { padding: 20px; } }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- User Info -->
        <div class="user-info-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-2"><i class="bi bi-person-circle me-2"></i>Welcome, <?php echo htmlspecialchars($user['name']); ?></h4>
                    <p class="mb-0"><i class="bi bi-envelope me-2"></i><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div>
                    <a href="home.php" class="btn btn-outline-light btn-sm me-2">
                        <i class="bi bi-house me-1"></i> Home
                    </a>
                    <a href="../backend/logout.php" class="btn btn-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Booking Form -->
        <div class="booking-form">
            <div class="form-header">
                <h2><i class="bi bi-calendar-check me-2"></i>Book Your Tour</h2>
                <p class="text-muted">Complete the form below to book your adventure</p>
            </div>
            
            <!-- Auto-selected Service Notice -->
            <?php if ($destination): ?>
            <div class="alert alert-success mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                You're booking: <strong><?php echo htmlspecialchars($destination['name']); ?></strong>
            </div>
            <?php endif; ?>
            
            <form id="bookingForm">
                <!-- Hidden fields -->
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id']; ?>">
                <input type="hidden" id="destination_id" name="destination_id" value="<?php echo $destination_id; ?>">
                <!-- CHANGED: guide_id to guider_id -->
                <input type="hidden" id="guider_id" name="guider_id" value="0">
                <input type="hidden" id="guider_price" name="guider_price" value="0">
                <input type="hidden" id="original_price" name="original_price" value="<?php echo $destination ? $destination['price'] : '0'; ?>">
                <input type="hidden" id="discounted_price" name="discounted_price" value="<?php echo $destination ? $destination['discount_price'] : '0'; ?>">
                <input type="hidden" id="total_amount" name="total_amount" value="0">
                <input type="hidden" id="savings" name="savings" value="0">
                
                <!-- Personal Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-person"></i> Full Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="full_name" name="full_name" 
                               value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        <div class="invalid-feedback">Please enter your full name</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-envelope"></i> Email <span class="required">*</span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <div class="invalid-feedback">Please enter a valid email address</div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-telephone"></i> Phone <span class="required">*</span>
                        </label>
                        <input type="tel" class="form-control" id="phone" name="phone" 
                               placeholder="Enter phone number" required>
                        <div class="invalid-feedback">Please enter your phone number</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-globe"></i> Country <span class="required">*</span>
                        </label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="">Select country</option>
                            <option value="Nepal" selected>Nepal</option>
                            <option value="India">India</option>
                            <option value="USA">USA</option>
                            <option value="UK">UK</option>
                            <option value="Australia">Australia</option>
                            <option value="Canada">Canada</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="invalid-feedback">Please select your country</div>
                    </div>
                </div>
                
                <!-- Service Details -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-geo-alt"></i> Service Name <span class="required">*</span>
                        </label>
                        <select class="form-select" id="service_name" name="service_name" required>
                            <option value="">Select service</option>
                            <?php
                            $services_sql = "SELECT destination_id, name FROM destination WHERE type != 'guide' ORDER BY name";
                            $services_result = $conn->query($services_sql);
                            
                            if ($services_result && $services_result->num_rows > 0) {
                                while($service = $services_result->fetch_assoc()) {
                                    $selected = ($destination && $destination['destination_id'] == $service['destination_id']) ? 'selected' : '';
                                    echo '<option value="' . htmlspecialchars($service['name']) . '" ' 
                                         . 'data-id="' . $service['destination_id'] . '" ' . $selected . '>' 
                                         . htmlspecialchars($service['name']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Please select a service</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-calendar-date"></i> Service Date <span class="required">*</span>
                        </label>
                        <input type="date" class="form-control" id="service_date" name="service_date" 
                               min="<?php echo date('Y-m-d'); ?>" required>
                        <div class="invalid-feedback">Please select a date</div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-clock"></i> Time Slot <span class="required">*</span>
                        </label>
                        <select class="form-select" id="time_slot" name="time_slot" required>
                            <option value="">Select time</option>
                            <option value="Morning (6 AM - 11 AM)">Morning (6 AM - 11 AM)</option>
                            <option value="Afternoon (11 AM - 4 PM)">Afternoon (11 AM - 4 PM)</option>
                            <option value="Evening (4 PM - 8 PM)">Evening (4 PM - 8 PM)</option>
                            <option value="Full Day">Full Day</option>
                        </select>
                        <div class="invalid-feedback">Please select a time slot</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-people"></i> Number of People <span class="required">*</span>
                        </label>
                        <select class="form-select" id="number_of_people" name="number_of_people" required>
                            <option value="">Select number</option>
                            <?php for($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?> Person<?php echo $i > 1 ? 's' : ''; ?></option>
                            <?php endfor; ?>
                        </select>
                        <div class="invalid-feedback">Please select number of people</div>
                    </div>
                </div>
                
                <!-- Pickup Location -->
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-pin-map"></i> Pickup Point (Optional)
                    </label>
                    <input type="text" class="form-control" id="pick_up_point" name="pick_up_point" 
                           placeholder="Enter pickup location">
                </div>
                
                <!-- GUIDE SELECTION SECTION -->
                 <div class="guide-section">
    <h4 class="mb-3">
        <i class="bi bi-person-walking"></i> Select a Guide (Optional)
    </h4>
    <p class="text-muted mb-4">
        Choose a professional guide for your tour. Guide fee will be added to the total cost.
    </p>
    
    <!-- Guide Options -->
    <div class="guide-options">
        <?php if (!empty($guides)): ?>
            <?php foreach($guides as $guide): ?>
                <?php
                // Use actual guide price from DB
                $guide_price = isset($guide['gprice']) ? (float)$guide['gprice'] : 50.00;

                $full_name = $guide['first_name'] . ' ' . $guide['last_name'];
                $languages = !empty($guide['language']) ? $guide['language'] : 'English';
                $nationality = !empty($guide['nationality']) ? $guide['nationality'] : 'Nepali';
                ?>
                
                <div class="guide-card" 
                     data-guide-id="<?php echo $guide['guider_id']; ?>"
                     data-guide-name="<?php echo htmlspecialchars($full_name); ?>"
                     data-guide-price="<?php echo $guide_price; ?>">
                    
                    <?php if (!empty($guide['guide_photo'])): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($guide['guide_photo']); ?>" 
                             alt="<?php echo htmlspecialchars($full_name); ?>" 
                             class="guide-avatar"
                             onerror="this.src='../uploads/default_avatar.jpg'; this.onerror=null;">
                    <?php else: ?>
                        <div class="avatar-placeholder">
                            <i class="bi bi-person"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="guide-name"><?php echo htmlspecialchars($full_name); ?></div>
                    
                    <div class="guide-details">
                        <?php if ($guide['gender']): ?>
                            <span class="badge bg-info mb-1"><?php echo htmlspecialchars($guide['gender']); ?></span>
                        <?php endif; ?>
                        
                        <?php if ($nationality): ?>
                            <span class="badge bg-secondary mb-1"><?php echo htmlspecialchars($nationality); ?></span>
                        <?php endif; ?>
                        
                        <div class="mt-2">
                            <small><i class="bi bi-translate me-1"></i> <?php echo htmlspecialchars($languages); ?></small>
                        </div>
                        
                        <?php if ($guide['preference']): ?>
                            <div>
                                <small><i class="bi bi-star me-1"></i> <?php echo htmlspecialchars($guide['preference']); ?> tours</small>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="guide-price mt-2">
                        $<?php echo number_format($guide_price, 2); ?>
                        <span class="text-muted">/ day</span>
                    </div>
                    
                    <input type="radio" name="guide_radio" class="d-none" value="<?php echo $guide['guider_id']; ?>">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    No guides are currently available.
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- No Guide Option -->
    <div class="no-guide-option mt-3 selected" id="noGuideOption">
        <div class="no-guide-icon">
            <i class="bi bi-signpost"></i>
        </div>
        <h5>No Guide Needed</h5>
        <p class="mb-2">I prefer to explore independently</p>
        <div class="guide-price">Free</div>
        <input type="radio" name="guide_radio" class="d-none" value="0" checked>
    </div>
</div>

                
                <!-- Price Information -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">
                            <i class="bi bi-tag"></i> Service Price (per person)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="service_price_per_person" 
                                   value="<?php echo $destination ? number_format($destination['discount_price'], 2) : '0.00'; ?>" 
                                   step="0.01" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <i class="bi bi-person-badge"></i> Guide Price
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="guide_price_display" 
                                   value="0.00" step="0.01" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <i class="bi bi-calculator"></i> Total (per person)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price_per_person" 
                                   value="<?php echo $destination ? number_format($destination['discount_price'], 2) : '0.00'; ?>" 
                                   step="0.01" readonly>
                        </div>
                    </div>
                </div>
                
                <!-- Special Requests -->
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-chat-left-text"></i> Special Requests (Optional)
                    </label>
                    <textarea class="form-control" id="special_requests" name="special_requests" 
                              rows="3" placeholder="Any special requests, dietary restrictions, accessibility needs, or additional notes..."></textarea>
                </div>
                
                <!-- Payment Information -->
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-cash"></i> Payment Information
                    </label>
                    <div class="alert alert-info p-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                            <div>
                                <h6 class="mb-1">Cash Payment Only</h6>
                                <p class="mb-0">Pay directly to the guide or service provider at the time of service.</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="payment_method" value="Cash">
                </div>
                
                <!-- Booking Summary -->
                <div class="summary-box">
                    <h5 class="mb-3">
                        <i class="bi bi-receipt"></i> Booking Summary
                    </h5>
                    
                    <div class="summary-item">
                        <span>Service:</span>
                        <span id="summaryService"><?php echo $destination ? htmlspecialchars($destination['name']) : '-'; ?></span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Date:</span>
                        <span id="summaryDate">-</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>People:</span>
                        <span id="summaryPeople">-</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Guide:</span>
                        <span id="summaryGuide">No Guide</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Service Cost:</span>
                        <span id="summaryServiceCost">$0.00</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Guide Cost:</span>
                        <span id="summaryGuideCost">$0.00</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Savings:</span>
                        <span id="summarySavings" style="color: #198754;">$0.00</span>
                    </div>
                    
                    <div class="summary-item summary-total">
                        <span>Total Amount:</span>
                        <span id="summaryTotal">$0.00</span>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="bi bi-check-circle me-2"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set tomorrow's date as default
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('service_date').value = tomorrow.toISOString().split('T')[0];

        // Initialize variables
        let selectedGuide = { id: 0, name: 'No Guide', price: 0 };
        let servicePrice = <?php echo $destination ? $destination['discount_price'] : 0; ?>;
        let originalPrice = <?php echo $destination ? $destination['price'] : 0; ?>;

        // Update summary initially
        updateSummary();

        // Guide selection
        document.querySelectorAll('.guide-card').forEach(card => {
            card.addEventListener('click', function() {
                selectGuide(this);
            });
        });

        // No guide option
        document.getElementById('noGuideOption').addEventListener('click', function() {
            selectNoGuide();
        });

        function selectGuide(card) {
            // Remove selection from all
            document.querySelectorAll('.guide-card').forEach(c => c.classList.remove('selected'));
            document.getElementById('noGuideOption').classList.remove('selected');

            // Select this card
            card.classList.add('selected');

            // Update selected guide
            selectedGuide = {
                id: card.dataset.guideId,
                name: card.dataset.guideName,
                price: parseFloat(card.dataset.guidePrice) || 0
            };

            // Update hidden fields - CHANGED: guide_id to guider_id
            document.getElementById('guider_id').value = selectedGuide.id;
            document.getElementById('guider_price').value = selectedGuide.price;
            document.getElementById('guide_price_display').value = selectedGuide.price.toFixed(2);

            // Update radio button
            const radioBtn = card.querySelector('input[type="radio"]');
            if (radioBtn) radioBtn.checked = true;

            // Update summary
            updateSummary();
        }

        function selectNoGuide() {
            // Remove selection from all guides
            document.querySelectorAll('.guide-card').forEach(c => c.classList.remove('selected'));
            document.getElementById('noGuideOption').classList.add('selected');

            // Update selected guide
            selectedGuide = { id: 0, name: 'No Guide', price: 0 };

            // Update hidden fields - CHANGED: guide_id to guider_id
            document.getElementById('guider_id').value = 0;
            document.getElementById('guider_price').value = 0;
            document.getElementById('guide_price_display').value = '0.00';

            // Update radio button
            const noGuideRadio = document.querySelector('input[name="guide_radio"][value="0"]');
            if (noGuideRadio) noGuideRadio.checked = true;

            // Update summary
            updateSummary();
        }

        function updateSummary() {
            const numberOfPeople = parseInt(document.getElementById('number_of_people').value) || 0;
            const serviceCost = servicePrice * numberOfPeople;
            const originalServiceCost = originalPrice * numberOfPeople;
            const guideCost = selectedGuide.price;
            const totalAmount = serviceCost + guideCost;
            const savings = originalServiceCost - serviceCost;

            // Update summary display
            document.getElementById('summaryService').textContent = document.getElementById('service_name').value || '-';
            document.getElementById('summaryDate').textContent = document.getElementById('service_date').value || '-';
            document.getElementById('summaryPeople').textContent = numberOfPeople + ' person' + (numberOfPeople !== 1 ? 's' : '');
            document.getElementById('summaryGuide').textContent = selectedGuide.name;
            document.getElementById('summaryServiceCost').textContent = '$' + serviceCost.toFixed(2);
            document.getElementById('summaryGuideCost').textContent = '$' + guideCost.toFixed(2);
            document.getElementById('summarySavings').textContent = '$' + savings.toFixed(2);
            document.getElementById('summaryTotal').textContent = '$' + totalAmount.toFixed(2);

            // Update hidden fields
            document.getElementById('total_amount').value = totalAmount.toFixed(2);
            document.getElementById('savings').value = savings.toFixed(2);
        }

        // Update summary when inputs change
        document.getElementById('number_of_people').addEventListener('change', updateSummary);

        // Form submission
        const bookingForm = document.getElementById('bookingForm');
        bookingForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validate form
            let isValid = true;
            const requiredFields = bookingForm.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    field.nextElementSibling.style.display = 'block';
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                    field.nextElementSibling.style.display = 'none';
                }
            });

            if (!isValid) {
                alert('Please fill in all required fields.');
                return;
            }

            // Prepare booking data - CHANGED: guide_id to guider_id
            const bookingData = {
                guider_id: parseInt(selectedGuide.id),
                destination_id: parseInt(document.getElementById('destination_id').value),
                full_name: document.getElementById('full_name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                country: document.getElementById('country').value,
                service_name: document.getElementById('service_name').value,
                service_date: document.getElementById('service_date').value,
                time_slot: document.getElementById('time_slot').value,
                pick_up_point: document.getElementById('pick_up_point').value,
                number_of_people: parseInt(document.getElementById('number_of_people').value),
                original_price: parseFloat(document.getElementById('original_price').value),
                discounted_price: parseFloat(document.getElementById('discounted_price').value),
                savings: parseFloat(document.getElementById('savings').value),
                total_amount: parseFloat(document.getElementById('total_amount').value),
                special_requests: document.getElementById('special_requests').value,
                payment_method: 'Cash'
            };

            // Submit booking
            try {
                const response = await fetch('../backend/submit_booking.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(bookingData)
                });

                const data = await response.json();

                if (data.success) {
                    // Success message
                    bookingForm.innerHTML = `
                        <div class="alert alert-success text-center p-5">
                            <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                            <h3 class="text-success mb-3">Booking Confirmed!</h3>
                            <p class="lead">Your booking has been successfully submitted.</p>
                            <p class="text-muted mt-2">
                                You will be notified via email once the guide accepts or rejects your booking.
                            </p>
                            <div class="bg-light p-4 rounded my-4">
                                <p><strong>Booking ID:</strong> ${data.booking_id}</p>
                                <p><strong>Total Amount:</strong> $${bookingData.total_amount.toFixed(2)}</p>
                            </div>
                            <a href="home.php" class="btn btn-primary">Return Home</a>
                        </div>
                    `;
                } else {
                    alert('Booking failed: ' + (data.message || 'Unknown error'));
                }
            } catch (error) {
                alert('Error submitting booking: ' + error.message);
            }
        });
    });
    </script>
</body>
</html>