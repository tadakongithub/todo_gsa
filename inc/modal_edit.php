<div id="edit_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit todo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="edit_todo_id" />
          <input type="text" id="edit_todo" />
          <p id="err"></p>
          <button id="submit-edit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#submit-edit').click(function(e){
    e.preventDefault()
    let todo_id = $('#edit_todo_id').val()
    let todo = $('#edit_todo').val()
    console.log(todo_id)
    console.log(todo)

    $.post(
      "edit.php",
      {
        todo_id: todo_id,
        todo: todo
      },
      function(res){
        console.log(res)
        if(res == 'success'){
          location.reload()
        } else {
          $('#err').text('something went wrong')
        }
      },
      'text'
    )
  })

</script>