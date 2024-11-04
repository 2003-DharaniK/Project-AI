<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <div id="google_translate_element"></div>
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .settings-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .setting-item {
            margin-bottom: 20px;
        }
        .btn-toggle {
            background-color: #007bff;
            color: white;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="settings-container">
        <h2 id="settings-title">Settings</h2>

        <!-- Language Preference -->
        <div class="setting-item">
            <label class="form-label" id="language-label">Language Preference:</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="languageToggle">
                <label class="form-check-label" id="language-option">Switch to Tamil</label>
            </div>
        </div>

        <!-- Profile Settings -->
        <div class="setting-item">
            <h5 id="profile-title">Profile Settings</h5>
            <label class="form-label" id="name-label">Name:</label>
            <input type="text" class="form-control" placeholder="Enter your name">
        </div>

        <!-- Notification Preferences -->
        <div class="setting-item">
            <h5 id="notification-title">Notification Preferences</h5>
            <label class="form-label" id="notify-label">How would you like to receive notifications?</label>
            <select class="form-select">
                <option value="email" id="email-option">Email</option>
                <option value="sms" id="sms-option">SMS</option>
            </select>
        </div>

        <!-- Account Security -->
        <div class="setting-item">
            <h5 id="security-title">Account Security</h5>
            <label class="form-label" id="password-label">Change Password:</label>
            <input type="password" class="form-control" placeholder="Enter new password">
        </div>

        <!-- Dashboard Customization -->
        <div class="setting-item">
            <h5 id="customization-title">Dashboard Customization</h5>
            <label class="form-label" id="widget-label">Enable/Disable Widgets:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="enableWidget">
                <label class="form-check-label" id="widget-option">Enable Widgets</label>
            </div>
        </div>

        <!-- Theme Preferences -->
        <div class="setting-item">
            <h5 id="theme-title">Theme Preferences</h5>
            <label class="form-label" id="theme-label">Select Theme:</label>
            <select class="form-select">
                <option value="light" id="light-option">Light Mode</option>
                <option value="dark" id="dark-option">Dark Mode</option>
            </select>
        </div>
    </div>
</div>

<!-- Google Translate Widget -->
<div id="google_translate_element" style="display: none;"></div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Google Translate Script -->
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- Language Toggle Script -->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        const languageToggle = document.getElementById('languageToggle');

        // Function to toggle the language display
        function toggleLanguage(isTamil) {
            if (isTamil) {
                document.getElementById('settings-title').innerText = "அமைப்புகள்";
                document.getElementById('language-label').innerText = "மொழி விருப்பம்:";
                document.getElementById('language-option').innerText = "ஆங்கிலத்திற்கு மாற்றவும்";
                document.getElementById('profile-title').innerText = "சுயவிவரம் அமைப்புகள்";
                document.getElementById('name-label').innerText = "பெயர்:";
                document.querySelector('input[placeholder="Enter your name"]').placeholder = "உங்கள் பெயரை உள்ளிடவும்";
                document.getElementById('notification-title').innerText = "அறிவிப்பு விருப்பங்கள்";
                document.getElementById('notify-label').innerText = "நீங்கள் அறிவிப்புகளை எவ்வாறு பெற விரும்புகிறீர்கள்?";
                document.getElementById('email-option').innerText = "மின்னஞ்சல்";
                document.getElementById('sms-option').innerText = "எஸ்.எம்.எஸ்";
                document.getElementById('security-title').innerText = "கணக்கு பாதுகாப்பு";
                document.getElementById('password-label').innerText = "கடவுச்சொல்லை மாற்றவும்:";
                document.querySelector('input[placeholder="Enter new password"]').placeholder = "புதிய கடவுச்சொல்லை உள்ளிடவும்";
                document.getElementById('customization-title').innerText = "கட்டமைப்பு ஒழுங்கமைப்பு";
                document.getElementById('widget-label').innerText = "விதிகள் செயல்படுத்த/செயலிழக்கச் செய்யவும்:";
                document.getElementById('widget-option').innerText = "விதிகளை செயல்படுத்தவும்";
                document.getElementById('theme-title').innerText = "தீம் விருப்பங்கள்";
                document.getElementById('theme-label').innerText = "தீமையை தேர்வு செய்யவும்:";
                document.getElementById('light-option').innerText = "ஒளி முறை";
                document.getElementById('dark-option').innerText = "கருப்பு முறை";
            } else {
                // Set English text
                document.getElementById('settings-title').innerText = "Settings";
                document.getElementById('language-label').innerText = "Language Preference:";
                document.getElementById('language-option').innerText = "Switch to Tamil";
                document.getElementById('profile-title').innerText = "Profile Settings";
                document.getElementById('name-label').innerText = "Name:";
                document.querySelector('input[placeholder="Enter your name"]').placeholder = "Enter your name";
                document.getElementById('notification-title').innerText = "Notification Preferences";
                document.getElementById('notify-label').innerText = "How would you like to receive notifications?";
                document.getElementById('email-option').innerText = "Email";
                document.getElementById('sms-option').innerText = "SMS";
                document.getElementById('security-title').innerText = "Account Security";
                document.getElementById('password-label').innerText = "Change Password:";
                document.querySelector('input[placeholder="Enter new password"]').placeholder = "Enter new password";
                document.getElementById('customization-title').innerText = "Dashboard Customization";
                document.getElementById('widget-label').innerText = "Enable/Disable Widgets:";
                document.getElementById('widget-option').innerText = "Enable Widgets";
                document.getElementById('theme-title').innerText = "Theme Preferences";
                document.getElementById('theme-label').innerText = "Select Theme:";
                document.getElementById('light-option').innerText = "Light Mode";
                document.getElementById('dark-option').innerText = "Dark Mode";
            }
        }

        // Event listener for the language toggle
        languageToggle.addEventListener('change', () => {
            toggleLanguage(languageToggle.checked);
            // Save the language preference in localStorage
            localStorage.setItem('language', languageToggle.checked ? 'tamil' : 'english');
        });

        // Check for saved language preference in localStorage
        const savedLanguage = localStorage.getItem('language') === 'tamil';
        languageToggle.checked = savedLanguage;
        toggleLanguage(savedLanguage);
    });
</script>


<script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,ta',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
      }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>
