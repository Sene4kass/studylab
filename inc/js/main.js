function onEntry(entry) {
    entry.forEach(change => {
    if (change.isIntersecting) {
     change.target.classList.add('main_content_part_show');
    }
  });
}

options_ = {
  threshold: [0.3]
};
observer = new IntersectionObserver(onEntry, options);
elements = document.querySelectorAll('.main_content_part');


for (let elm of elements) {
  observer.observe(elm);
}

function positionWindow() {
    var buttonRect = toggleButton.getBoundingClientRect();
}

/*---------------------------------------------------------------*/

var toggleButton = document.getElementById('toggle-button');
var menuWindow = document.getElementById('window');

toggleButton.addEventListener('click', function() {
    if (menuWindow.style.display === 'none') {
      menuWindow.style.display = 'flex';
      positionWindow();
      document.getElementById('arrow_button_').classList.toggle("arrow_list");
      setTimeout(function() {
        menuWindow.style.opacity = '1';
      }, 10);
    } else {
      document.getElementById('arrow_button_').classList.toggle("arrow_list");
      menuWindow.style.opacity = '0';
      setTimeout(function() {
        menuWindow.style.display = 'none';
      }, 300);
    }
});


/*---------------------------------------------------------------*/

/* All checkboxes */

function toggleCheckboxes() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var masterCheckbox = document.getElementById('masterCheckbox');

    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = masterCheckbox.checked;
    }
}

/*---------------------------------------------------------------*/

/* Window edit */

function editWindow() {
    var block = document.getElementById("edit_modal");
    block.classList.toggle("hidden_block");
    block.classList.toggle("show_block");
}

/*---------------------------------------------------------------*/

/* Опция 1 2 3 */

function toggleDropdown(x) {
    var dropdownList = document.getElementById("dropdownList");
    dropdownList.classList.toggle("show");
    document.getElementById('arrow_button').classList.toggle(x);
}

/*---------------------------------------------------------------*/

function toggleBlockEdit(name,pos,id) {
  var block = document.getElementById("myBlock");
  block.classList.toggle("hidden_block");
  block.classList.toggle("show_block");
  document.getElementById("input_name").value=name;
  document.getElementById("input_position").value=pos;
  document.getElementById("id_module_input").value=id;
}

function toggleBlockEditCourse(name,desc,fulldesc,id) {
    var block = document.getElementById("myBlock");
    block.classList.toggle("hidden_block");
    block.classList.toggle("show_block");
    document.getElementById("input_name").value=name;
    document.getElementById("input_desc").value=desc;
    document.getElementById("input_fulldesc").value=fulldesc;
    document.getElementById("id_course_input").value=id;
}

/*---------------------------------------------------------------*/

function toggleBlockAdd() {
  // var block3 = document.getElementById("myBlock");
  // block3.classList.toggle("hidden_block");

  var block = document.getElementById("myBlockAdd");
  block.classList.toggle("hidden_block");
  block.classList.toggle("show_block");
}

/*---------------------------------------------------------------*/

document.getElementById('select-file-btn').addEventListener('click', function() {
  document.getElementById('file-input').click();
});

document.getElementById('file-input').addEventListener('change', function() {
  var selectedFile = this.files[0];
  document.getElementById('selected-file').value = selectedFile.name;
});