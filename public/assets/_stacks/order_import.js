document.getElementById('importButton').addEventListener('click', function () {
    Swal.fire({
        title: 'Select a Day to Import',
        html: '<select class="form-select" id="importDropdown">' +
            '<option value="Senin">Senin</option>' +
            '<option value="Selasa">Selasa</option>' +
            '<option value="Rabu">Rabu</option>' +
            '<option value="Kamis">Kamis</option>' +
            '<option value="Jumat">Jumat</option>' +
            '<option value="Sabtu">Sabtu</option>' +
            '<option value="Minggu">Minggu</option>' +
            // Add more options as needed
            '</select>',
        confirmButtonText: 'Import',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        focusConfirm: false,
        preConfirm: () => {
            const selectedValue = document.getElementById('importDropdown').value;

            // You can use AJAX or fetch to send the selected value to your server
            // and perform the import based on the selected day.
            // Example:
            // fetch(`/import-data/${selectedValue}`)
            //     .then(response => {
            //         if (response.ok) {
            //             return response.json();
            //         }
            //         throw new Error('Network response was not ok');
            //     })
            //     .then(data => {
            //         // Handle success
            //     })
            //     .catch(error => {
            //         // Handle error
            //     });

            // For this example, we'll just display an alert.
            Swal.fire(`Importing data for ${selectedValue}`);
        }
    });
});