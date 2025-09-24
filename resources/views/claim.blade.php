<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Claim License Code</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
      Claim Your License Code
    </h2>

    <form action="/api/claim" method="POST" class="space-y-5">
      @csrf

      <!-- Name -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" id="name" name="name" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Company -->
      <div>
        <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
        <input type="text" id="company" name="company" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Price -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
        <input type="number" id="price" name="price" min="0" step="0.01" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
    </div>



      <!-- Submit -->
      <button type="submit"
        class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
        Claim License
      </button>
    </form>
  </div>
</body>
</html>
