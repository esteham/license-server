<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Claim purchase Code</title>
</head>
<body>
  <h2>Claim License Code</h2>

  <form action="/api/claim" method="POST">
    @csrf
    <p>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
    </p>
    <p>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
    </p>
    <p>
      <label>Company Name:</label>
      <input type="text" name="company" required>
    </p>
    <button type="submit">Claim</button>
  </form>
</body>
</html>
