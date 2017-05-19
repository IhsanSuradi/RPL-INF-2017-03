<?php

	if (isset($_GET["q"])){
		
		$qsrc = $_GET["q"];
		
		// Query barang2 yang tersedia di pasar
		$barang_result = mysqli_query($dbconn, "SELECT * FROM barang WHERE nama LIKE '%$qsrc%';");
		if (mysqli_num_rows($barang_result) > 0){
			while ($row_barang = mysqli_fetch_assoc($barang_result)){
				
				$id_barang = $row_barang["id_barang"];
				$nama_barang = $row_barang["nama"];
				$desc_barang = $row_barang["deskripsi"];
				
				// Query pada list barang yg dijual oleh tiap toko
				$lsb_result = mysqli_query($dbconn, "SELECT * FROM list_barang WHERE id_barang=$id_barang;");
				if (mysqli_num_rows($lsb_result) > 0){
					while ($row_lsb = mysqli_fetch_assoc($lsb_result)){
						
						$id_toko = $row_lsb["id_toko"];
						$harga = $row_lsb["harga"];
						$banyak = $row_lsb["banyak"];
						
						$toko_result = mysqli_query($dbconn, "SELECT * FROM toko WHERE id=$id_toko;");
						if (mysqli_num_rows($toko_result) > 0){
							$row_toko = mysqli_fetch_assoc($toko_result);
							$nama_toko = $row_toko["nama"];
							$status_toko = $row_toko["status"];
							if ($status_toko == 0){
								$status_str = "TUTUP";
							}
							else {
								$status_str = "BUKA";
							}
						}
						else {
							$nama_toko = "<unknown>";
							$status_str = "TUTUP";
						}
						
						// Cetak Hasilnya!
						echo "<tr>";
                        echo "<td>$nama_barang</td>";
                        echo "<td>$nama_toko</td>";
                        echo "<td class=\"text-center\"><strong>$banyak</strong></td>";
                        echo "<td class=\"text-center\"><strong>Rp. $harga <input type=\"submit\" name=\"Submit2\" value=\"PILIH\" align=\"right\"></strong></td>";
                        echo "<td class=\"active\"><input type=\"submit\" name=\"Submit2\" value=\"$status_str\" align=\"right\"></td>";
                        echo "</tr>";
						
					}
				}
				/*else {
					echo "Tidak ada toko yang menjual barang <b>$nama_barang</b> !";
				}*/
				
			}
		}
		else {
			echo "Tidak ada data <b>$qsrc</b> ditemukan!";
		}
		
	}
	else {
		echo "Query error: tidak ada data yg dimasukkan!";
	}

?>