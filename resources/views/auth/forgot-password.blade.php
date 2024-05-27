<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Your Password?</title>
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
            margin: auto;
            margin-bottom: 80px;
        }

        /* Form title */
        .form-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-description {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }

        .primary-button {
            background-color: #4a90e2; 
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 14px 0;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .primary-button:hover {
            background-color: #357bd8; 
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-title">Forgot Your Password?</div>
        <div class="form-description">
            <p>Don't worry! Just enter your email address below, and we'll send you a link to reset your password.</p>
        </div>
      
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">
                <button type="submit" class="primary-button">Email Password Reset Link</button>
            </div>
        </form>
    </div>
</body>
</html>
