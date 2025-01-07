<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Form with Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Contact Us</h2>
    <form>
      <!-- Name Input -->
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
        <input
          type="text"
          id="name"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          placeholder="Enter your name"
          required
        />
      </div>

      <!-- Email Input -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
        <input
          type="email"
          id="email"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          placeholder="Enter your email"
          required
        />
      </div>

      <!-- Message Input -->
      <div class="mb-4">
        <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
        <textarea
          id="message"
          rows="4"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          placeholder="Enter your message"
          required
        ></textarea>
      </div>

      <!-- Submit Button -->
      <div>
        <button
          type="submit"
          class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</body>
</html>
