@extends('frontend.index')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Thêm liên kết đến Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Profile</h1>

        <form action="{{ route('profile.update') }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
            <!-- Token bảo mật CSRF -->
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label"><strong>Name:</strong></label>
                <input type="text" id="name" name="name" class="form-control" 
                       value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label"><strong>Email:</strong></label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label"><strong>Address:</strong></label>
                <input type="text" id="address" name="address" class="form-control" 
                       value="{{ old('address', $profile->address ?? '') }}" 
                       placeholder="Enter your address">
            </div>

            <!-- Birthplace -->
            <div class="mb-3">
                <label for="birthplace" class="form-label"><strong>Birthplace:</strong></label>
                <input type="text" id="birthplace" name="birthplace" class="form-control" 
                       value="{{ old('birthplace', $profile->birthplace ?? '') }}" 
                       placeholder="Enter your birthplace">
            </div>

            <!-- Birthdate -->
            <div class="mb-3">
                <label for="birthdate" class="form-label"><strong>Birthdate:</strong></label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" 
                       value="{{ old('birthdate', isset($profile) && $profile->birthdate ? \Carbon\Carbon::parse($profile->birthdate)->format('Y-m-d') : '') }}">
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="phone_number" class="form-label"><strong>Phone Number:</strong></label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" 
                       value="{{ old('phone_number', $profile->phone_number ?? '') }}" 
                       placeholder="Enter your phone number">
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="/" class="btn btn-secondary">Go to Home</a>
            </div>
        </form>
    </div>

    <!-- Thêm liên kết đến Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
