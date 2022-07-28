<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stranke.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
     #searchbar
    {
        position: inherit;
        width: 25%;
        font-size: 16px; 
        padding: 12px 20px 12px 40px; 
        border: 1px solid #ddd; 
        margin-bottom: 12px; 
        border-radius: 10px;
        
    }</style>
    <title>Document</title>
</head>
<body>
    <?php require 'header.php';
    
    $conn = OpenCon();
    $sql = "SELECT * FROM `stranke`";
    

    ?> 

    
    <div class="container">
    <div class="container-fluid p-0">
 
		<div class="row">
			<div class="col-xl-8">
				<div class="card">
					<div class="card-header pb-0">
                    <input id="searchbar" onkeyup="isci()" type="text" name="search" placeholder="Poišči stranko"> <br>
                    <input type="radio" name="kaj" checked="checked" id="ip" value="0"/>
                    <label for="ip">Ime in Priimek</label>

                    <input type="radio" name="kaj" id="em" value="1"/>
                    <label for="em">Email</label>

                    <input type="radio" name="kaj" id="tel" value="2"/>
                    <label for="tel">Telefon</label>
					</div>
					<div class="card-body">
                    <table id="izpis" class="display" style="width:100%">
							<thead>
								<tr>
									<th>Ime</th>
									<th>Email</th>
									<th>Telefon</th>
                                    <th>Ogled</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc())
                                {
                                echo "<tr>";
                                echo "<td>".$row['ime']." ".$row['priimek']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['telefon']."</td>";
                                echo "<td> <a href='vec_stranka.php?id=".$row['stranka_id']."'>Več</a> </td>";
                                echo "</tr>";
                                }
                                ?>
								
							
							</tbody>
						</table>
					</div>
				</div>
			</div>

	</div>
</div>

<script>
  $(document).ready(function () {
    $('#izpis').DataTable({
        pagingType: 'numbers',
        "searching":false
    });
    
});
</script>
<?php
CloseCon($conn);
?>
<script src="iskanje.js"></script>
</body>
</html>