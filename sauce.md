<!-- * HIDDEN INPUTS * -->
<!-- The two hidden inputs you've mentioned (current_image and id) are typically used in forms for updating records in a
database. While it's true that you're fetching these values from the database when the page loads, it's still
necessary to include them in the form for a couple of reasons:

  Form Submission: When you submit the form for updating the food item, you need to send the current image name and the
  ID of the food item to the server. These hidden inputs ensure that these values are sent along with the other form
  data.

  Data Consistency: Including these hidden inputs ensures that the values associated with the food item remain
  consistent throughout the update process. Even though you've fetched these values initially, they could potentially
  change due to various reasons (e.g., another user updating the record simultaneously). By including them as hidden
  inputs, you're ensuring that the data being submitted is consistent with what was initially loaded.

  So yes, these hidden inputs are necessary for the proper functioning of your update form. They provide essential
  information needed to process the update operation accurately on the server side. -->
<!-- * HIDDEN INPUTS * -->

<!-- mysqli_real_escape_string($conn, $string_name) -->
