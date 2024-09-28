<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Rates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .pagination {
            text-align: center;
            margin: 20px auto;
        }
        .page-link {
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
        }
        .active {
            background-color: #007bff;
            color: white;
        }
        #searchInput {
            width: 80%;
            padding: 10px;
            margin: 20px auto;
            display: block;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Currency Rates</h1>
    <input type="text" id="searchInput" placeholder="Search for currencies..." onkeyup="searchCurrencies()" />
    <table>
        <thead>
            <tr>
                <th>Currency</th>
                <th>Rate</th>
                <th>Last Updated</th>
            </tr>
        </thead>
        <tbody id="currency-table"></tbody>
    </table>
    <div class="pagination" id="pagination"></div>

    <script>
        let currentPage = 1;
        let allCurrencies = []; // Store all currencies for searching

        async function fetchCurrencies(page = 1) {
            const response = await fetch(`/api/currencies?page=${page}`, {
                headers: {
                    'Authorization': 'Bearer YOUR_ACCESS_TOKEN' // Replace with your actual token
                }
            });
            const data = await response.json();
            allCurrencies = data.data; // Store the data for searching
            renderCurrencies(data);
            renderPagination(data);
        }

        function renderCurrencies(data) {
            const tableBody = document.getElementById('currency-table');
            tableBody.innerHTML = '';
            data.data.forEach(currency => {
                const row = `<tr>
                    <td>${currency.name}</td>
                    <td>${currency.rate}</td>
                    <td>${currency.updated_at}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        function renderPagination(data) {
            const paginationDiv = document.getElementById('pagination');
            paginationDiv.innerHTML = '';

            const totalPages = data.last_page;
            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement('a');
                pageLink.className = 'page-link' + (i === currentPage ? ' active' : '');
                pageLink.textContent = i;
                pageLink.href = '#';
                pageLink.onclick = (e) => {
                    e.preventDefault();
                    currentPage = i;
                    fetchCurrencies(currentPage);
                };
                paginationDiv.appendChild(pageLink);
            }
        }

        function searchCurrencies() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filteredCurrencies = allCurrencies.filter(currency => 
                currency.name.toLowerCase().includes(searchTerm)
            );

            const tableBody = document.getElementById('currency-table');
            tableBody.innerHTML = '';

            filteredCurrencies.forEach(currency => {
                const row = `<tr>
                    <td>${currency.name}</td>
                    <td>${currency.rate}</td>
                    <td>${currency.updated_at}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        fetchCurrencies();
    </script> 
</body>
</html>
