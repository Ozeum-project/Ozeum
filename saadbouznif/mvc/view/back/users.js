// Feather Icons Initialization
feather.replace();

// Sample User Data
const users = [
    { 
        id: 1, 
        name: 'John Doe', 
        email: 'john.doe@example.com', 
        status: 'Active', 
        registrationDate: '2023-01-15',
        lastLogin: '2024-03-04',
        orderCount: 5,
        totalSpent: '$450.00'
    },
    { 
        id: 2, 
        name: 'Jane Smith', 
        email: 'jane.smith@example.com', 
        status: 'Inactive', 
        registrationDate: '2023-05-22',
        lastLogin: '2024-02-15',
        orderCount: 2,
        totalSpent: '$150.00'
    }
];

// Populate User Table
function populateUserTable() {
    const tableBody = document.getElementById('userTableBody');
    tableBody.innerHTML = users.map(user => `
        <tr>
            <td style="padding: 12px;">${user.name}</td>
            <td style="padding: 12px;">${user.email}</td>
            <td style="padding: 12px;">
                <span style="
                    background-color: ${user.status === 'Active' ? '#27ae60' : '#e74c3c'}; 
                    color: white; 
                    padding: 4px 8px; 
                    border-radius: 4px;
                    font-size: 12px;
                ">
                    ${user.status}
                </span>
            </td>
            <td style="padding: 12px;">
                <button onclick="showUserDetails(${user.id})" class="btn btn-secondary" style="margin-right: 5px;">
                    <i data-feather="eye"></i>
                </button>
                <button class="btn btn-secondary">
                    <i data-feather="edit"></i>
                </button>
            </td>
        </tr>
    `).join('');
    feather.replace();
}

// Show User Details Modal
function showUserDetails(userId) {
    const user = users.find(u => u.id === userId);
    const modalContent = document.getElementById('userDetailsContent');
    modalContent.innerHTML = `
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Name</label>
                <input class="form-input" value="${user.name}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input class="form-input" value="${user.email}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Registration Date</label>
                <input class="form-input" value="${user.registrationDate}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Last Login</label>
                <input class="form-input" value="${user.lastLogin}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Order Count</label>
                <input class="form-input" value="${user.orderCount}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Total Spent</label>
                <input class="form-input" value="${user.totalSpent}" readonly>
            </div>
        </div>
        <div class="action-buttons">
            <button class="btn btn-secondary" onclick="toggleUserStatus(${user.id})">
                ${user.status === 'Active' ? 'Deactivate' : 'Activate'} Account
            </button>
            <button class="btn btn-primary">
                Reset Password
            </button>
        </div>
    `;
    document.getElementById('userDetailsModal').style.display = 'flex';
}

// Close User Details Modal
function closeUserModal() {
    document.getElementById('userDetailsModal').style.display = 'none';
}

// Toggle User Status
function toggleUserStatus(userId) {
    const user = users.find(u => u.id === userId);
    user.status = user.status === 'Active' ? 'Inactive' : 'Active';
    populateUserTable();
    closeUserModal();
}

// Initial Population
populateUserTable();