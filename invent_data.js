const deleteButton = document.getElementById('deleteButton');
          const popup = document.getElementById('popup');

          deleteButton.addEventListener('click', function() {
              popup.style.display = 'block';
          });

          function confirmDelete() {
              // Add your delete logic here
              alert('Item deleted!');
              closePopup();
          }

          function closePopup() {
              popup.style.display = 'none';
          }

          function confirmDelete() {
              // Check if the 'id' parameter exists in the URL
              const urlParams = new URLSearchParams(window.location.search);
              const itemId = urlParams.get('id');

              if (itemId !== null && !isNaN(itemId)) {
                  // 'itemId' is a valid numeric value
                  // Forward to delete_item.php with the item ID in the URL
                  window.location.href = `delete_item.php?id=${itemId}`;
              } else {
                  // 'id' parameter is missing or invalid
                  alert('Invalid item ID.');
              }
          }

          function closePopup() {
              document.getElementById('popup').style.display = 'none';
          }