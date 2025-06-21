<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Test</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- إذا كنت تستخدم Vite -->
    @livewireStyles
</head>
<body>
    <livewire:test />  <!-- ✅ استدعاء مكون Livewire الصحيح -->
    <script>
        window.livewire_token = document.querySelector('meta[name="csrf-token"]').content;
    </script>
    @livewireScripts


</body>
</html>
