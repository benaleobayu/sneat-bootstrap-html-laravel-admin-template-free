


// Populate select element with flowers data
var flowerSelect = document.querySelector('.flower-select');
for (var i = 0; i < flowersData.length; i++) {
    var option = document.createElement('option');
    option.value = flowersData[i].id;
    option.textContent = flowersData[i].name;
    flowerSelect.appendChild(option);
}

document.getElementById('add-flower').addEventListener('click', function() {
    var container = document.getElementById('flowers-container');
    var container = document.getElementById('card');
    var container = document.getElementById('card-body');
    var row = document.createElement('div');
    row.classList.add('row', 'flower-input', 'my-3');

    var col1 = document.createElement('div');
    col1.classList.add('col-6');
    var newFlowerSelect = flowerSelect.cloneNode(true);
    newFlowerSelect.required = true;
    col1.appendChild(newFlowerSelect);

    var col2 = document.createElement('div');
    col2.classList.add('col-5');
    var totalInput = document.createElement('input');
    totalInput.setAttribute('type', 'number');
    totalInput.setAttribute('name', 'total[]');
    totalInput.classList.add('form-control', 'total-input');
    totalInput.setAttribute('min', '0');
    totalInput.value = '0';
    col2.appendChild(totalInput);

    var col3 = document.createElement('div');
    col3.classList.add('col-1');
    var deleteButton = document.createElement('button');
    deleteButton.setAttribute('type', 'button');
    deleteButton.classList.add('btn', 'btn-danger', 'delete-flower');
    deleteButton.textContent = 'Delete';
    col3.appendChild(deleteButton);

    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);
    container.appendChild(row);
});

// Delete button functionality
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-flower')) {
        var flowerRow = event.target.closest('.flower-input');
        flowerRow.remove();
    }
});
