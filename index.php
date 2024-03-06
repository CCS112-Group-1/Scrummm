<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager</title>
  <link rel="stylesheet" href="student.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

  <h2>Task Manager</h2>
<input type="button" class="button button-add" value="Add Task" onclick="openAddModal()">
<table id="taskTable">
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Due Date</th>
      <th>Status</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody id="taskList">
    
  </tbody>
</table>

<div id="editFormModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeEditFormModal()">&times;</span>
    <h3>Edit Task</h3>
    <form id="taskFormEditModal">
      <input type="text" placeholder="Title" id="editTitleModal" required>
      <input type="text" placeholder="Description" id="editDescriptionModal" required>
      <input type="text" placeholder="Due Date" id="editDueDateModal" class="datepicker" required>
      <select id="editStatusModal">
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
      </select>
      <input type="button" class="button-update" value="Update" onclick="updateTask()">
    </form>
  </div>
</div>

<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeAddModal()">&times;</span>
    <h3>Add Task</h3>
    <form id="taskFormModal">
      <input type="text" placeholder="Title" id="titleModal" required>
      <input type="text" placeholder="Description" id="descriptionModal" required>
      <input type="text" placeholder="Due Date" id="dueDateModal" class="datepicker" required>
      <select id="statusModal">
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
      </select>
      <input type="button" class="button button-add" value="Add Task" onclick="addTask()">
    </form>
  </div>
</div>

<script>
var editRowIndex;

function openAddModal() {
  $("#addModal").show();
}

function closeAddModal() {
  $("#addModal").hide();
}

function openEditFormModal() {
  $("#editFormModal").show();
}

function closeEditFormModal() {
  $("#editFormModal").hide();
}

function addTask() {
  var taskData = {
    title: $("#titleModal").val(),
    description: $("#descriptionModal").val(),
    dueDate: $("#dueDateModal").val(),
    status: $("#statusModal").val(),
  };

  if (!taskData.title || !taskData.description || !taskData.dueDate) {
    alert("Please fill in all required fields.");
    return;
  }

  $("#taskList").append("<tr>" +
    "<td>" + taskData.title + "</td>" +
    "<td>" + taskData.description + "</td>" +
    "<td>" + taskData.dueDate + "</td>" +
    "<td>" + taskData.status + "</td>" +
    "<td><button class='button-edit' onclick='openEditForm(this)'>Edit</button></td>" +
    "<td><button class='button-delete' onclick='deleteTask(this)'>Delete</button></td>" +
    "</tr>");
  
  

  $("#taskFormModal")[0].reset();
  closeAddModal();
}



function openEditForm(button) {
  var row = $(button).closest("tr");
  editRowIndex = row.index();
  $("#editTitleModal").val(row.find("td:eq(0)").text());
  $("#editDescriptionModal").val(row.find("td:eq(1)").text());
  $("#editDueDateModal").val(row.find("td:eq(2)").text());
  $("#editStatusModal").val(row.find("td:eq(3)").text());

  openEditFormModal();
}

function updateTask() {
  var row = $("#taskList tr:eq(" + editRowIndex + ")");
  
  var editedTaskData = {
    title: $("#editTitleModal").val(),
    description: $("#editDescriptionModal").val(),
    dueDate: $("#editDueDateModal").val(),
    status: $("#editStatusModal").val(),
  };

  if (!editedTaskData.title || !editedTaskData.description || !editedTaskData.dueDate) {
    alert("Please fill in all required fields.");
    return;
  }

  row.find("td:eq(0)").text(editedTaskData.title);
  row.find("td:eq(1)").text(editedTaskData.description);
  row.find("td:eq(2)").text(editedTaskData.dueDate);
  row.find("td:eq(3)").text(editedTaskData.status);

  closeEditFormModal();
}

function deleteTask(button) {
  if (confirm("Are you sure you want to delete this task?")) {
    $(button).closest("tr").remove();
  }
}

$(function() {
  $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

</body>
</html>


  