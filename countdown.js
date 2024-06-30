const days = document.getElementById('days');
const hours = document.getElementById('hours');
const minutes = document.getElementById('minutes');
const seconds = document.getElementById('seconds');

const currentYear = new Date().getFullYear();
let targetDate = new Date(`November 15 ${currentYear} 00:00:00`); // default date

// Updating the Countdown
function updateCountdown() {
    const currentTime = new Date();
    const diff = targetDate - currentTime; // Calculates the difference in milliseconds

    const d = Math.floor(diff / 1000 / 60 / 60 / 24); // milliseconds to days
    const h = Math.floor(diff / 1000 / 60 / 60) % 24; // remaining differenceto hours
    const m = Math.floor(diff / 1000 / 60) % 60; // remaining difference to minutes
    const s = Math.floor(diff / 1000) % 60; // remaining difference to seconds

    // adding a leading zero if less than 10
    days.innerHTML = d;
    hours.innerHTML = h < 10 ? '0' + h : h;
    minutes.innerHTML = m < 10 ? '0' + m : m;
    seconds.innerHTML = s < 10 ? '0' + s : s;
}

setInterval(updateCountdown, 1000);

// edit countdown
const editButton = document.querySelector('.edit-button');
editButton.addEventListener('click', () => {
    const newDateStr = prompt('Enter new date for countdown (MM/DD/YYYY)', '11/15/' + currentYear);
    const newDate = new Date(newDateStr);


    if (!isNaN(newDate.getTime())) {
        targetDate = newDate;
        updateCountdown();
    } else {
        alert('Invalid date format! Please enter the date in MM/DD/YYYY format.');
    }
});

 document.querySelectorAll('.checkbox').forEach(item => {
    item.addEventListener('click', event => {
        item.classList.toggle('checked');
        const tickIcon = item.querySelector('i');
        tickIcon.classList.toggle('show');
        const nextElement = item.nextElementSibling;
        nextElement.classList.toggle('strikethrough');
    });
});

// edit checklist
document.addEventListener('DOMContentLoaded', function() {
   
    const editableCells = document.querySelectorAll('.editable');
    
    editableCells.forEach(cell => {
        cell.addEventListener('blur', function() {
            
            console.log('New value:', cell.textContent);
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const editIcons = document.querySelectorAll('.edit-icon');
    const addIcons = document.querySelectorAll('.add-icon');
    const descriptionCells = document.querySelectorAll('.description');
    const deleteIcons = document.querySelectorAll('.delete-row');

    let isEditable = false;

    editIcons.forEach(editIcon => {
        editIcon.addEventListener('click', function() {
            isEditable = !isEditable;
            descriptionCells.forEach(cell => {
                cell.contentEditable = isEditable;
                if (isEditable) {
                    cell.classList.add('editable');
                } else {
                    cell.classList.remove('editable');
                }
            });
            deleteIcons.forEach(icon => {
                if (isEditable) {
                    icon.style.display = 'table-cell';
                } else {
                    icon.style.display = 'none';
                }
            });
        });
    });

    addIcons.forEach(addIcon => {
        addIcon.addEventListener('click', function() {
            const totalRow = addIcon.closest('table').querySelector('tbody tr:last-child');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="checkbox" onclick="showSuccessPopup()"><i class="fas fa-check"></i></td>
                <td class="description" contenteditable="true"></td>
                <td contenteditable="true" class="editable"></td>
                <td contenteditable="true" class="editable"></td>
                <td class="delete-row"><i class="fas fa-trash-alt"></i></td>
            `;
            totalRow.parentNode.insertBefore(newRow, totalRow);
        });
    });
    
    deleteIcons.forEach(button => {
        button.addEventListener('click', function() {
            const row = button.closest('tr');
            row.remove();
        });
    });
});

document.querySelectorAll('.delete-row').forEach(cell => {
    cell.addEventListener('click', function() {
        deleteRow(this.parentNode);
    });
});

function deleteRow(row) {
    row.remove();
    mergeHeader(); 
}

let modalShown = false; 

function showSuccessPopup() {
    if (!modalShown) {
 
        const modal = document.createElement('div');
        modal.classList.add('custom-modal');
       
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>TASK COMPLETED SUCCESSFULLY</p>
                <i class="fas fa-check-circle fa-4x"></i>
            </div>
        `;

        document.body.appendChild(modal);

        modalShown = true;
        
        const closeButton = modal.querySelector('.close');
        closeButton.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }
}