<?php
$gaber= $_POST['gaber'];
$gapok= $_POST['prod_name'];
$iuran=$_POST['iuran'];
$absensi=$_POST['absensi'];
if (isset($_POST['hitung'])) 
{
	$gaber=(($gapok-$iuran)-$absensi);
} else {
	# code...
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="gaji.php" method="POST" name="">
	<table align="center" border="1">
		<tr>
			<td>No Gaji</td>
			<td><input type="text" name=""></td>
		</tr>
		<tr>
			<td>Tgl Gaji</td>
			<td><input type="date" name=""></td>
		</tr>

		<tr>
			<td>Karyawan</td>
			<td>
				<select>
					<?php
					$sql=mysqli_connect("localhost","root","","db_gaji");
					$tampil=mysqli_query($sql,"SELECT * From tbl_karyawan");
					while ($row=mysqli_fetch_array($tampil)) 
					{
						echo "<option>$row[nik] => $row[nama]</option>";
					}
					?>

				</select>
			</td>
		</tr>


		<tr>
		<td>Jabatan</td>
			<?php 
			$konek=mysqli_connect("localhost","root","","db_21010026");
			$result = mysqli_query($konek, "select * from tbl_jabatan"); 
			$jsArray = "var kusriyo = new Array();\n"; 
			echo '<td><select name="kode_jabatan" onchange="changeValue(this.value)">'; 
			while ($row = mysqli_fetch_array($result)) 
			{ 
				echo '<option value="' . $row['kode'] . '">' . $row['jabatan'] . '</option>'; 
				$jsArray .= "prdName['" . $row['kode'] . "'] = {name:'" . addslashes($row['gapok']) . "',name1:'" . addslashes($row['tj_beras']) . "',name2:'" . addslashes($row['tj_anak']) . "',name3:'" . addslashes($row['tj_trans']) . "'};\n"; 
			} 
			echo '</select></td>'; 
			?> 
			
		</tr>
		<tr>
			<td>Gaji Pokok</td>
			<td align="right"><input type="text" name="prod_name" id="gapok" value="<?php echo $gapok;?>" /></td>
		</tr>
		<tr>
			<td>Tunjangan Beras</td>
			<td><input type="text" name="prod_name" id="tj_beras"/></td>
		</tr>
		<tr>
			<td>Tunjangan Anak</td>
			<td><input type="text" name="prod_name" id="tj_anak"/></td>
		</tr>
		<tr>
			<td>Tunjangan Transportasi</td>
			<td><input type="text" name="prod_name" id="tj_trans"/></td>
		</tr>

		<script type="text/javascript"> 
			<?php echo $jsArray; ?>
			function changeValue(id)
			{
				document.getElementById('gapok').value = prdName[id].name;
			};
		</script>

		<tr>
			<td>Iuran</td>
			<td><input type="text" name="iuran" value="<?php echo $iuran?>"></td>
		</tr>
		<tr>
			<td>Potongan Absensi</td>
			<td><input type="text" name="absensi" value="<?php echo $absensi?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="hitung" value="Hitung"></td>
		</tr>
		<tr>
			<td>Gaji Bersih</td>
			<td><input type="text" name="gaber" value="<?php echo $gaber?>"></td>
		</tr>
	</table>
	</form>
</body>
</html>