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
    fetch(`/professional/get-demand-details?id=${demandId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const demand = data.data;
                const modalBody = document.getElementById('modalBody');
                
                modalBody.innerHTML = `
                    <div class="demand-details">
                        <div class="detail-row">
                            <span class="label">Référence:</span>
                            <span class="value">#${demand.id}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Client:</span>
                            <span class="value">${demand.client_name}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Email:</span>
                            <span class="value">${demand.client_email || 'N/A'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Téléphone:</span>
                            <span class="value">${demand.client_phone || 'N/A'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Date:</span>
                            <span class="value">${demand.formatted_date || demand.date}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Statut:</span>
                            <span class="value">
                                <span class="status-badge ${demand.validation_status}">${getStatusLabel(demand.validation_status)}</span>
                            </span>
                        </div>
                        ${demand.meet_link ? `
                        <div class="detail-row">
                            <span class="label">Lien de réunion:</span>
                            <span class="value">
                                <a href="${demand.meet_link}" target="_blank" class="meet-link">
                                    🔗 ${demand.meet_link}
                                </a>
                            </span>
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
            // Recharger la page après 1 seconde
            setTimeout(() => {
                location.reload();
            }, 1000);
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

// Add CSS for demand details
const style = document.createElement('style');
style.textContent = `
    .demand-details {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .detail-row {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 15px;
        padding: 12px;
        background: #f9fafb;
        border-radius: 8px;
    }
    
    .detail-row .label {
        font-weight: 600;
        color: #6b7280;
        font-size: 14px;
    }
    
    .detail-row .value {
        color: #1f2937;
        font-size: 14px;
    }
    
    .meet-link {
        color: #1e40af;
        text-decoration: none;
        word-break: break-all;
    }
    
    .meet-link:hover {
        text-decoration: underline;
    }
    
    .meetings-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .meeting-item {
        padding: 12px;
        background: #f9fafb;
        border-radius: 8px;
        border-left: 4px solid #1a2332;
    }
    
    .meeting-time {
        font-weight: 600;
        color: #1a2332;
        font-size: 14px;
    }
    
    .meeting-client {
        color: #6b7280;
        font-size: 13px;
        margin-top: 4px;
    }
`;
document.head.appendChild(style);

console.log('Professional Dashboard loaded successfully');