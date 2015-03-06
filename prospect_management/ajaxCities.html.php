<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
?>

<select name = "city_id" id = "city_id">
          <option value =""> Select one </option>
          <?php foreach ($cities as $city):  ?>
          <option value = "<?php htmlout($city['id']); ?>" 
		
		<?php  		
		if ($city['id'] == $city_id)
		echo ' selected= "selected"'; ?> >
          <?php htmlout($city['name']); ?>
          </option>
          <?php endforeach; ?>
        </select>