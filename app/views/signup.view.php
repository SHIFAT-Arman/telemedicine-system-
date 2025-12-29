<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor's Information</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/signup.css">
</head>
<body>
<div class="container">
    <h1>Doctor's Information</h1>

    <form>
        <div class="form-group">
            <label>Registration number (BMDC)</label>
            <input type="text" placeholder="Value">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" placeholder="Value">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" placeholder="Value">
            </div>
        </div>

        <div class="birthday-gender-row">
            <div class="birthday-field">
                <label>Birthday</label>
                <div class="input-wrapper">
                    <input type="date" placeholder="Birthday">
                    <span class="input-icon calendar-icon">📅</span>
                </div>
            </div>
            <div class="gender-field">
                <div class="gender-options">
                    <span class="gender-label">Gender:</span>
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" checked>
                        <label for="male">Male</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" id="female" name="gender">
                        <label for="female">Female</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Speciality / Department</label>
            <input type="text" placeholder="Value">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <div class="input-wrapper">
                    <input type="email" placeholder="example@gmail.com">
                    <span class="input-icon">✓</span>
                </div>
            </div>
            <div class="form-group">
                <label>Phone number</label>
                <div class="phone-row">
                    <select class="country-code">
                        <option>+ 880</option>
                        <option>+ 1</option>
                        <option>+ 44</option>
                    </select>
                    <input type="text" class="phone-input" placeholder="xxxxxxxxxx">
                </div>
            </div>
        </div>

        <div class="info-text">
            <span class="info-icon">i</span>
            <span>The phone number and birthday are only visible to you</span>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="input-wrapper">
                <input type="password" value="********">
                <span class="input-icon eye-icon">👁</span>
                <span class="input-icon" style="right: 40px;">✓</span>
            </div>
            <div class="password-requirements">
                <div>8+ characters</div>
                <div>at least one uppercase letter</div>
                <div>at least one lowercase letter</div>
                <div>include a number</div>
                <div>include special symbols.</div>
            </div>
        </div>

        <button type="submit" class="confirm-button">Confirm</button>
    </form>
</div>
</body>
</html>