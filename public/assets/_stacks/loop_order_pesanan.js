// Function to add a new flower input row
function addFlowerRow() {
  var container = document.getElementById("card-body"); // Use the correct container
  var row = document.createElement("div");
  row.classList.add("row", "flower-input", "my-3");

  var col1 = document.createElement("div");
  col1.classList.add("col-6");
  var newFlowerSelect = createFlowerSelect(); // Create a new dropdown
  col1.appendChild(newFlowerSelect);

  var col2 = document.createElement("div");
  col2.classList.add("col-2");
  var totalInput = document.createElement("input");
  totalInput.setAttribute("type", "number");
  totalInput.setAttribute("name", "total[]");
  totalInput.classList.add("form-control", "total-input");
  totalInput.setAttribute("min", "0");
  totalInput.value = "";
  col2.appendChild(totalInput);

  var col3 = document.createElement('div');
  col3.classList.add('col-3'); // Adjust the column size for the additional field
  var additionalSelect = createAdditionalSelect(); // Create the Additional select
  col3.appendChild(additionalSelect);

  var col4 = document.createElement("div");
  col4.classList.add("col-1", "p-0");
  var deleteButton = document.createElement("button");
  deleteButton.setAttribute("type", "button");
  deleteButton.classList.add("btn", "btn-danger", "delete-flower");
  deleteButton.textContent = "Delete";
  col4.appendChild(deleteButton);

  row.appendChild(col3);
  row.appendChild(col1);
  row.appendChild(col2);
  row.appendChild(col4);
  container.appendChild(row);
}

// Create a new flower dropdown
function createFlowerSelect() {
  var newFlowerSelect = document.createElement("select");
  newFlowerSelect.setAttribute("name", "flower_id[]");
  newFlowerSelect.classList.add("form-select", "flower-select");
  newFlowerSelect.required = true;

  // Filter out already selected flowers
  var selectedFlowers = document.querySelectorAll(".flower-select");
  for (var i = 0; i < flowersData.length; i++) {
    var flowerId = flowersData[i].id;
    var isAlreadySelected = false;
    for (var j = 0; j < selectedFlowers.length; j++) {
      if (selectedFlowers[j].value == flowerId) {
        isAlreadySelected = true;
        break;
      }
    }
    if (!isAlreadySelected) {
      var option = document.createElement("option");
      option.value = flowerId;
      option.textContent = flowersData[i].name;
      newFlowerSelect.appendChild(option);
    }
  }

  return newFlowerSelect;
}

// Create the "Additional" select field
function createAdditionalSelect() {
    var additionalSelect = document.createElement('select');
    additionalSelect.setAttribute('name', 'additional[]');
    additionalSelect.classList.add('form-select', 'additional-select'); // Add a class to the select
    additionalSelect.required = false; // Remove the required attribute for this field

    // Add the "Masukan Additional" option by default
    var defaultOption = document.createElement('option');
    defaultOption.value = ''; // Empty value
    defaultOption.textContent = 'Masukan Additional';
    defaultOption.selected = true; // Make it selected by default
    additionalSelect.appendChild(defaultOption);

    // Check if 'additional' is defined and is an array
    if (typeof additional !== 'undefined' && Array.isArray(additional)) {
        // Add the additional flowers as options
        for (var i = 0; i < additional.length; i++) {
            var option = document.createElement('option');
            option.value = additional[i].id;
            option.textContent = additional[i].name;
            additionalSelect.appendChild(option);
        }
    }

    return additionalSelect;
}


// Add flower row when the "Tambah" button is clicked
document.getElementById("add-flower").addEventListener("click", function () {
  addFlowerRow();
});

// Delete button functionality
document.addEventListener("click", function (event) {
  if (event.target.classList.contains("delete-flower")) {
    var flowerRow = event.target.closest(".flower-input");
    flowerRow.remove();
  }
});
