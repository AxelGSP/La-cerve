document.querySelectorAll('.denied').forEach(element => {
    element.onclick = function() {
        alert("Tu q, ni admin eres");
    };
});

document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const loading = document.querySelector('.loading');
    const tableContent = document.querySelector('.table-content');

    let currentTableName = '';

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            loading.style.display = 'block';
            tableContent.style.display = 'none';

            currentTableName = tab.getAttribute('data-table');
            fetchTableContent(currentTableName);
        });
    });

    function fetchTableContent(tableName) {
        fetch(`getTables.php?table=${tableName}`)
            .then(response => response.json())
            .then(data => {
                loading.style.display = 'none';

                tableContent.innerHTML = generateTableHTML(data, tableName);
                tableContent.style.display = 'block';
            })
            .catch(error => {
                loading.innerText = 'Error loading data';
                console.error('Error fetching table content:', error);
            });
    }

    function generateTableHTML(data, tableName) {
        if (!data || data.length === 0) {
            return '<p>No data available</p>';
        }

        let html = '<table><thead><tr>';
        Object.keys(data[0]).forEach(key => {
            html += `<th>"${key}"</th>`;
        });
        html += '<th>Actions</th>';
        html += '</tr></thead><tbody>';

        data.forEach(row => {
            html += '<tr>';
            Object.entries(row).forEach(([key, value]) => {
                html += `<td><input type="text" value="${value}" data-column="${key}" data-id="${row.id}" class="edit-input"></td>`;
            });
            html += `
                <td>
                    <button class="save-btn" data-id="${row.id}" data-table="${tableName}">Guardar</button>
                    <button class="delete-btn" data-id="${row.id}" data-table="${tableName}">Eliminar</button>
                </td>`;
            html += '</tr>';
        });

        html += `
            <tr>
                <td colspan="${Object.keys(data[0]).length + 1}">
                    <button class="add-row-btn" data-table="${tableName}">Nuevo</button>
                </td>
            </tr>
        `;

        html += '</tbody></table>';
        return html;
    }

    tableContent.addEventListener('click', function(event) {
        if (event.target.classList.contains('save-btn')) {
            const id = event.target.getAttribute('data-id');
            const table = event.target.getAttribute('data-table');
            const row = event.target.closest('tr');
            const inputs = row.querySelectorAll('input');

            const data = {};
            inputs.forEach(input => {
                const column = input.getAttribute('data-column');
                data[column] = input.value;
            });

            saveTableData(table, id, data);
        } else if (event.target.classList.contains('delete-btn')) {
            const id = event.target.getAttribute('data-id');
            const table = event.target.getAttribute('data-table');
            deleteTableRow(table, id);
        } else if (event.target.classList.contains('add-row-btn')) {
            const table = event.target.getAttribute('data-table');
            addNewTableRow(table);
        }
    });

    function saveTableData(table, id, data) {
        fetch('setTables.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ table, id, data })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Data saved successfully.');
            } else {
                alert('Error saving data.');
            }
        })
        .catch(error => {
            console.error('Error saving table data:', error);
            alert('Error saving data.');
        });
    }

    function deleteTableRow(table, id) {
        fetch('deleteRow.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ table, id })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Row deleted successfully.');
                fetchTableContent(table);
            } else {
                alert('Error deleting row.');
            }
        })
        .catch(error => {
            console.error('Error deleting row:', error);
            alert('Error deleting row.');
        });
    }

    function addNewTableRow(table) {
        fetch('addRow.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ table })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('New row added successfully.');
                fetchTableContent(table);
            } else {
                alert('Error adding new row.');
            }
        })
        .catch(error => {
            console.error('Error adding new row:', error);
            alert('Error adding new row.');
        });
    }
});
