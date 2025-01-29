<!-- resources/views/users/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết người dùng</title>
</head>
<body>
    <h1> Thông tin chi tiết người dùng </h1>
    
    <p>ID: {{ $user->id }}</p>
    <p>Họ và tên: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Ngày tạo: {{ $user->created_at }}</p>
    <p>Ngày cập nhật: {{ $user->updated_at }}</p>

    <a href="{{ route('users.index') }}">Trở lại danh sách</a>
</body>
</html>
