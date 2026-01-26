// Modal Management
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}

// Close buttons
document.querySelectorAll('.close').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.modal').style.display = 'none';
    });
});

// View Demand Details
function viewDemand(demandId) {
    fetch(`/professional/demand-details?id=${demandId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const demand = data.data;
                const modalBody = document.getElementById('modalBody');
                
                modalBody.innerHTML = `
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: grid; grid-template-columns: 150px 1fr; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b;">Référence:</strong>
                            <span>#${demand.id}</span>
                        </div>
                        <div style="display: grid; grid-template-columns: 150px 1fr; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b;">Client:</strong>
                            <span>${demand.client_name || 'N/A'}</span>
                        </div>
                        <div style="display: grid; grid-template-columns: 150px 1fr; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b;">Email:</strong>
                            <span>${demand.client_email || 'N/A'}</span>
                        </div>
                        <div style="display: grid; grid-template-columns: 150px 1fr; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b;">Téléphone:</strong>
                            <span>${demand.client_phone || 'N/A'}</span>
                        </div>
                        <div style="display: grid; grid-template-columns: 150px 1fr; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b;">Date:</strong>
                            <span>${demand.formatted_date || demand.date}</span>
                        </div>
                        <div style="display: grid; grid-template-columns: 150px 1fr; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b;">Statut:</strong>
                            <span class="status-badge ${demand.validation_status}">${getStatusLabel(demand.validation_status)}</span>
                        </div>
                        ${demand.message ? `
                        <div style="padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b; display: block; margin-bottom: 8px;">Message:</strong>
                            <p style="margin: 0; line-height: 1.6;">${demand.message}</p>
                        </div>
                        ` : ''}
                        ${demand.meet_link ? `
                        <div style="padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <strong style="color: #64748b; display: block; margin-bottom: 8px;">Lien de réunion:</strong>
                            <a href="${demand.meet_link}" target="_blank" style="color: #3b82f6;">${demand.meet_link}</a>
                        </div>
                        ` : ''}
                    </div>
                `;
                
                openModal('demandModal');
            } else {
                alert('Erreur lors du chargement des détails');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
}

// Update Status
function updateStatus(demandId) {
    document.getElementById('demandId').value = demandId;
    openModal('statusModal');
}

// Handle Status Form Submission
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/professional/update-status', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Statut mis à jour avec succès');
            closeModal('statusModal');
            location.reload();
        } else {
            alert(data.message || 'Erreur lors de la mise à jour');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    });
});

// Helper Functions
function getStatusLabel(status) {
    const labels = {
        'pending': 'En attente',
        'confirmed': 'Confirmée',
        'completed': 'Terminée',
        'cancelled': 'Annulée'
    };
    return labels[status] || status;
}

console.log('Professional Dashboard loaded successfully');