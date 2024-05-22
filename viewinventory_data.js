const deleteButton = document.getElementById('deleteButton');
const popup = document.getElementById('popup');

deleteButton.addEventListener('click', function() {
    popup.style.display = 'block';
});

function confirmDelete() {
    
    alert('Item deleted!');
    closePopup();
}

function closePopup() {
    popup.style.display = 'none';
}

function confirmDelete() {
    
    const urlParams = new URLSearchParams(window.location.search);
    const itemId = urlParams.get('id');

    if (itemId !== null && !isNaN(itemId)) {
        
        
        window.location.href = `delete_moreitem.php?id=${itemId}`;
    } else {
        
        alert('Invalid item ID.');
    }
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}