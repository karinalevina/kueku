<html>
	<div class="form-group">
		<select name="kategori" class="form-control" required id="kategori">
			<option value=""> Pilih Kategori</option>
			<?php foreach ($kategori as $row) { ?>
				<option value="<?php echo $row->idkue; ?>"><?php echo $row->namakue; ?></option>
			<?php } ?>
		</select>
	</div>
</html>