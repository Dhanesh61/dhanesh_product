<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       
        body {
            background-color: #f3f4f6; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: #ffffff; 
            border-radius: 20px; 
            padding: 40px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1); 
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .input-container {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #4a90e2; 
        }

        .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }

        .submit-button {
            background-color: #4a90e2;
            color: #ffffff; 
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #357bd8; 
        }

        .already-registered {
            text-align: center;
            margin-top: 10px;
        }

        .already-registered a {
            color: #4a90e2; 
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .already-registered a:hover {
            color: #357bd8; 
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
        }
        .register-icon{
            color: darkgray;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-title"><i class="fas fa-user-plus register-icon"></i>Registration</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

           
            <div class="input-container">
                <input id="name" type="text" name="name" class="input-field" placeholder="Name" value="{{ old('name') }}" required autofocus>
                
                <button type="button" class="toggle-password">
                    <i class="fas fa-user"></i>
                </button>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="input-container">
                <input id="email" type="email" name="email" class="input-field" placeholder="Email" value="{{ old('email') }}" required>
                
                <button type="button" class="toggle-password">
                    <i class="fas fa-envelope"></i>
                </button>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="input-container">
                <input id="password" type="password" name="password" class="input-field" placeholder="Password" required>
               
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </button>
                
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

           
            <div class="input-container">
                <input id="password_confirmation" type="password" name="password_confirmation" class="input-field" placeholder="Confirm Password" required>
                
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

          
            <button type="submit" class="submit-button">Register</button>
        </form>

        
        <div class="already-registered">
            <a href="{{ route('login') }}">Already registered?</a>
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var icon = document.querySelector(".toggle-password i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
