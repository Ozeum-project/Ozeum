// Blog details modal functions
function showReclamationDetails(reclamation) {
    const modalContent = document.getElementById('reclamationDetailsContent');
    
    modalContent.innerHTML = `
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">ID</label>
                <input class="form-input" value="${reclamation.id}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Nom</label>
                <input class="form-input" value="${reclamation.name}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Titre</label>
                <input class="form-input" value="${reclamation.title}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input class="form-input" value="${reclamation.email}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Sujet</label>
                <input class="form-input" value="${reclamation.subject}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Statut</label>
                <input class="form-input" value="${reclamation.status}" readonly>
            </div>
        </div>
    `;
    document.getElementById('reclamationDetailsModal').style.display = 'flex';
}

function closeReclamationModal() {
    document.getElementById('reclamationDetailsModal').style.display = 'none';
}