<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order cancel</title>
    <style>
    /* Reset styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Container styles */
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

/* Heading styles */
h2 {
    margin-bottom: 20px;
}

/* Label styles */
label {
    display: block;
    margin-bottom: 10px;
}

/* Textarea styles */
textarea {
    width: 100%;
    height: 100px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: vertical;
    margin-bottom: 20px;
}

/* Button styles */
button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Button hover effect */
button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <h2>Order Cancel  --{{$purchase->id}}</h2>
    <form action="{{ route('cancelOrder', $purchase->id) }}" method="post">
        @csrf
        <label for="reason">Reason for Cancel Order</label>
        <textarea name="reason" id="reason" placeholder="Enter a Reason for cancel order" required></textarea>
        <button type="submit">Submit</button>
    </form>
</body>
</html>