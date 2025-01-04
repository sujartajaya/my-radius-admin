<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table with Search and Pagination</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border: 1px solid #ddd;
    }
    th {
      background-color: #f4f4f4;
    }
    .pagination {
      display: flex;
      justify-content: center;
    }
    .pagination button {
      padding: 8px 16px;
      margin: 0 4px;
      border: 1px solid #ddd;
      background-color: #f9f9f9;
      cursor: pointer;
    }
    .pagination button.active {
      background-color: #007bff;
      color: #fff;
    }
    .pagination button:disabled {
      background-color: #e9ecef;
      cursor: not-allowed;
    }
    #searchBox {
      margin-bottom: 20px;
      width: 100%;
      padding: 8px;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <h1>Table with Search and Pagination</h1>
  <input type="text" id="searchBox" placeholder="Search...">
  <table id="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Age</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  <div class="pagination" id="pagination"></div>

  <script>
        const data = Array.from({ length: 40 }, (_, i) => ({
        no: i + 1,
        name: `Person ${i + 1}`,
        age: 20 + (i % 10),
        }));

        console.log(data);

        const rowsPerPage = 10;
        let currentPage = 1;
        let filteredData = [...data]; // Data untuk pencarian

        function renderTable(page) {
        const tableBody = document.querySelector("#data-table tbody");
        tableBody.innerHTML = "";

        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageData = filteredData.slice(start, end);

        pageData.forEach((item) => {
            const row = document.createElement("tr");
            row.innerHTML = `<td>${item['no']}</td>
                          <td>${item.name}</td><td>${item.age}</td>`;

            tableBody.appendChild(row);
        });

        renderPagination();
        }

        function renderPagination() {
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        const totalPages = Math.ceil(filteredData.length / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.classList.toggle("active", i === currentPage);
            button.disabled = i === currentPage;
            button.addEventListener("click", () => {
            currentPage = i;
            renderTable(currentPage);
            });
            pagination.appendChild(button);
        }
        }

        function handleSearch() {
        const searchQuery = document.getElementById("searchBox").value.toLowerCase();

        filteredData = data.filter((item) => 
            item.name.toLowerCase().includes(searchQuery) || 
            item.age.toString().includes(searchQuery)
        );

        currentPage = 1; // Reset ke halaman pertama
        renderTable(currentPage);
        }

        // Event listener untuk pencarian
        document.getElementById("searchBox").addEventListener("input", handleSearch);

        // Render tabel awal
        renderTable(currentPage);


  </script>
</body>
</html>
