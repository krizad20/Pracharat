<?php
include("system\headerCustomer.php");
//session_start()
?>
<div class="container-fluid">
  <div id="users">
    <div class="list row" id="display_item">
      <p></p>
    </div>

  </div>
</div>

</body>

<script>
  $(document).ready(function() {

    $.ajax({
      url: "TabAllProduct/getOrder.php",
      method: "POST",
      dataType: "json",
      success: function(data) {
        var json = $.parseJSON(data.data)
        let text = '';
        for (let i = 0; i < json.length; i++) {
          text += '<p> ' + json[i].pID + ' ' + json[i].pVal + ' </p><br>';

        }
        $('#display_item').html(text);

      }
    });


  });
</script>