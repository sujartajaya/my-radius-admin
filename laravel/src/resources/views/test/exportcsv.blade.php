<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Export JSON to CSV</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .export-button {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
    }
    .export-button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <h1>Export JSON Data to CSV</h1>
  <button class="export-button" onclick="exportJSONToCSV('data.csv')">Export to CSV</button>

  <script>
    // Sample JSON data
    const jsonData = [
      { "Name": "John Doe", "Age": 28, "City": "New York" },
      { "Name": "Jane Smith", "Age": 34, "City": "Los Angeles" },
      { "Name": "Michael Brown", "Age": 22, "City": "Chicago" }
    ];

    function exportJSONToCSV(filename) {
      if (jsonData.length === 0) {
        alert("No data available to export!");
        return;
      }

      // Extract headers from JSON keys
      const headers = Object.keys(jsonData[0]);
      const rows = jsonData.map(obj => headers.map(header => `"${obj[header] || ''}"`).join(','));

      // Combine headers and rows into a single CSV string
      const csvContent = [headers.join(','), ...rows].join('\n');

      // Create a Blob with CSV content
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = filename;

      // Trigger download
      link.style.display = 'none';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  </script>
</body>
</html>
