@extends('layouts/contentNavbarLayout')


@section('title', 'New Leave')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
  .text-left {
    text-align: left;
  }

  .text-success {
    color: green;
  }

  .text-warning {
    color: purple;
  }

  .text-danger {
    color: red;
  }

  .holiday {
    padding: 10px;
    margin: 5px;
    color: green;
  }

  .past {
    background-color: #FFF;
    /* Different color for past holidays */
    color: red;
    /* Optional: change text color for better readability */
  }
</style>
@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Expenses </span> </h4>

<div class="card">
  <h5 class="card-header" style="color:red;">Add Daily Expenses</h5>


  <form id="expenseForm" action="{{ route('expenses.store') }}" method="POST">
    @csrf
    <table class="table" id="expenseTable">
      <thead>
        <tr>
          <th>Expense Type</th>
          <th>Date</th>
          <th>Amount</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <select name="expenses[0][expense_type_id]" class="form-control" required>
              @foreach ($expenseTypes as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </td>
          <td><input type="date" name="expenses[0][date]" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></td>
          <td><input type="number" name="expenses[0][amount]" class="form-control" required></td>
          <td><input type="text" name="expenses[0][description]" class="form-control">
          <input type="hidden" class="form-control" id="location" name="expenses[0][location]"  value="{{ session('user_data')->location }}">
        </td>
          <td>
            <button type="button" class="btn btn-danger removeRow">X</button>

          </td>
        </tr>
      </tbody>
    </table>
    <div style="margin-left:20px;margin-top:20px;margin-right:20px;" align='right'>
      <button type="button" class="btn btn-primary" id="addRow">Add Row</button>

      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </form>

  <h5 class="mt-5" style='color:red;margin-left:25px;'>Existing Expenses - &nbsp;&nbsp; &#x20B9; ( {{ $totalAmount }} )</h5>
  <table class="table">
    <thead>
      <tr>
        <th>Expense Type</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($expenses as $expense)
      <tr data-id="{{ $expense->id }}">
        <td class="expense-type">{{ $expense->expenseType->name }}</td>
        <td class="date">{{ $expense->date }}</td>
        <td class="amount">{{ $expense->amount }}</td>
        <td class="description">{{ $expense->description }}</td>
        <td>
          <a href="javascript:void(0);" class="deleteExpense"><i class="bx bx-trash me-1" style=" color:red;"></i></a>
          <a href="javascript:void(0);" class="editRow" data-id="{{ $expense->id }}"><i class="bx bx-pencil me-1"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


</div>




<!-- Edit Modal-->

<!-- Edit Expense Modal -->
<!-- Edit Expense Modal -->
<div id="editExpenseModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editExpenseForm">
          <input type="hidden" id="editExpenseId">
          <div class="form-group">
            <label for="editExpenseType">Expense Type</label>
            <select id="editExpenseType" name="expense_type_id" class="form-control">
              @foreach($expenseTypes as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="editDate">Date</label>
            <input type="date" class="form-control" id="editDate" name="date">
          </div>
          <div class="form-group">
            <label for="editAmount">Amount</label>
            <input type="number" class="form-control" id="editAmount" name="amount">
          </div>
          <div class="form-group">
            <label for="editDescription">Description</label>
            <input type="text" class="form-control" id="editDescription" name="description">

            <input type="hidden" class="form-control" id="location" name="location" value="{{ session('user_data')->location }}">
          </div>
          <button type="button" class="btn btn-primary" id="saveEdit">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>








<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let rowIndex = 1;

    document.getElementById('addRow').addEventListener('click', function() {
      const tableBody = document.querySelector('#expenseTable tbody');
      const newRow = document.createElement('tr');

      newRow.innerHTML = `
            <td>
                <select name="expenses[${rowIndex}][expense_type_id]" class="form-control" required>
                    @foreach ($expenseTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="date" name="expenses[${rowIndex}][date]" value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
            <td><input type="number" name="expenses[${rowIndex}][amount]" class="form-control" required></td>
            <td><input type="text" name="expenses[${rowIndex}][description]" class="form-control">
            <input type="hidden"  name="expenses[${rowIndex}][location]" value="{{ session('user_data')->location }}" class="form-control"></td>

            <td><button type="button" class="btn btn-danger removeRow">X</button></td>
        `;

      tableBody.appendChild(newRow);
      rowIndex++;
    });

    document.getElementById('expenseTable').addEventListener('click', function(event) {
      if (event.target.classList.contains('removeRow')) {
        event.target.closest('tr').remove();
      }
    });

    document.querySelectorAll('.editRow').forEach(function(button) {
      button.addEventListener('click', function() {
        const expenseId = this.getAttribute('data-id');
        // Load the expense data via AJAX and populate the form for editing
        // You can use a modal to show the editing form
      });
    });

  });
</script>

<script>
  document.querySelectorAll('.deleteExpense').forEach(function(button) {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const expenseId = row.getAttribute('data-id');

      if (!expenseId) {
        console.error('Expense ID is null');
        return;
      }

      swal({
        title: 'Are you sure?',
        text: "Do you want to delete this expense?",
        icon: 'warning',
        buttons: {
          cancel: 'No',
          confirm: {
            text: 'Yes',
            value: true,
          }
        },
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '/expenses/' + expenseId,
            method: 'DELETE',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              row.remove();
              swal('Deleted!', response.message, 'success');
              location.reload();
            },
            error: function(xhr) {
              console.error('Error deleting expense:', xhr.responseText);
              swal('Error!', 'An error occurred while deleting the expense.', 'error');
            }
          });
        }
      });
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.editRow').forEach(function(button) {
      button.addEventListener('click', function() {
        const row = this.closest('tr');
        const expenseId = row.getAttribute('data-id');
        const expenseType = row.querySelector('.expense-type').getAttribute('data-type-id');
        const date = row.querySelector('.date').textContent.trim();
        const amount = row.querySelector('.amount').textContent.trim();
        const description = row.querySelector('.description').textContent.trim();

        document.getElementById('editExpenseId').value = expenseId;
        document.getElementById('editExpenseType').value = expenseType;
        document.getElementById('editDate').value = date;
        document.getElementById('editAmount').value = amount;
        document.getElementById('editDescription').value = description;

        $('#editExpenseModal').modal('show');
      });
    });

    document.getElementById('saveEdit').addEventListener('click', function() {
      const expenseId = document.getElementById('editExpenseId').value;
      const expenseType = document.getElementById('editExpenseType').value;
      const date = document.getElementById('editDate').value;
      const amount = document.getElementById('editAmount').value;
      const description = document.getElementById('editDescription').value;

      $.ajax({
        url: '/expenses/' + expenseId,
        method: 'PUT',
        data: {
          _token: $('meta[name="csrf-token"]').attr('content'),
          expense_type: expenseType,
          date: date,
          amount: amount,
          description: description
        },
        success: function(response) {
          const row = document.querySelector('tr[data-id="' + expenseId + '"]');
          row.querySelector('.expense-type').textContent = response.expense_type_name;
          row.querySelector('.date').textContent = date;
          row.querySelector('.amount').textContent = amount;
          row.querySelector('.description').textContent = description;

          $('#editExpenseModal').modal('hide');
          swal('Updated!', 'Expense has been updated.', 'success');
        },
        error: function(xhr) {
          console.error('Error updating expense:', xhr.responseText);
          swal('Error!', 'An error occurred while updating the expense.', 'error');
        }
      });
    });
  });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

@endsection
